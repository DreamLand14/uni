<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseSession;
use App\Models\Enrollment;
use App\Models\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index(){
        return redirect('/student/courses');
    }
    
    public function courses(Request $request){
        $courses = Course::orderBy('id', 'DESC');

        if($request->has('search') && $request->input('search') && $request->input('search') !== ''){
            $courses = $courses->where('name', 'LIKE', '%'.$request->input('search').'%')->orWhere('code', 'LIKE', '%'.$request->input('search').'%');
        }

        if($request->has('department') && $request->input('department') && $request->input('department') !== 'all'){
            $courses = $courses->where('department', $request->input('department'));
        }

        return view('student.courses', [
            'courses' => $courses->get(),
            'departments' => Course::select('department')->distinct()->pluck('department')->toArray(),
            'oldSearch' => $request->input('search', ''),
            'oldDepartment' => $request->input('department', 'all'),
            'enrolledUnits' => Course::whereIn('id', Enrollment::where('user_id', Auth::id())->where('status', 'ongoing')->pluck('course_id')->toArray())->sum('units')
        ]);
    }

    private function canEnroll($courseId){
        $course = Course::findOrFail($courseId);

        if(Enrollment::where('course_id', $course->id)->where('status', 'ongoing')->count() > $course->capacity){
            return [false, 'ظرفیت درس پر شده است.'];
        }

        if((Course::whereIn('id', Enrollment::where('user_id', Auth::id())->where('status', 'ongoing')->pluck('course_id')->toArray())->sum('units') + $course->units) > Auth::user()->max_units){
            return [false, 'تعداد واحد های اخذ شده از محدودیت واحد های شما بیشتر است.'];
        }

        foreach(Requirement::where('course_id', $course->id)->get() as $requirement){
            if($requirement->type === 'pre'){
                if(Enrollment::where('user_id', Auth::id())->where('course_id', $requirement->required_id)->where('status', 'done')->count() == 0){
                    return [false, Course::find($requirement->required_id)->name.' پیشنیاز این درس است و شما آن را نگذرانده اید.'];
                }
            } else if($requirement->type === 'co'){
                if(Enrollment::where('user_id', Auth::id())->where('course_id', $requirement->required_id)->count() == 0){
                    return [false, Course::find($requirement->required_id)->name.' همنیاز این درس است و شما آن را اخذ نکرده اید.'];
                }
            }
        }

        foreach(Auth::user()->ongoingEnrollments as $oge){
            $ogeCourse = $oge->course;

            $conflictingExam = Course::where('exam_date', $ogeCourse->exam_date)
                ->whereBetween('exam_start_hour', [$ogeCourse->exam_start_time, $ogeCourse->exam_end_time])
                ->orWhereBetween('exam_end_hour', [$ogeCourse->exam_start_time, $ogeCourse->exam_end_time])
                ->whereNot('id', $courseId)->exists();
            
            if($conflictingExam){
                return [false, 'زمان امتحان این درس با درس های اخذ شده شما تداخل دارد.'];
            }

            foreach(CourseSession::where('course_id', $courseId)->get() as $cs){
                $conflictingSession = CourseSession::where('day', $cs->day)
                    ->whereBetween('hour', [$cs->hour, $cs->hour + 2])
                    ->whereNot('course_id', $courseId)->exists();
                
                if($conflictingSession){
                    return [false, 'جلسات این درس با درس های دیگر شما تداخل دارد.'];
                }
            }
        }

        return [true, null];
    }

    public function showCourse($course){
        return view('student.showCourse', [
            'course' => Course::where('id', $course)->with(['sessions', 'requirements.required'])->firstOrFail(),
            'enrolled' => Enrollment::where('user_id', Auth::id())->where('course_id', $course)->where('status', 'ongoing')->count() > 0,
            'canEnroll' => $this->canEnroll($course)
        ]);
    }
    
    public function toggleEnrollment(Course $course){
        if(Enrollment::where('user_id', Auth::id())->where('course_id', $course->id)->where('status', 'ongoing')->count() == 0){
            $canEnroll = $this->canEnroll($course->id);
            if(!$canEnroll[0]){
                session()->flash('error', $canEnroll[1]);
                return redirect()->back();
            }
            
            Enrollment::create([
                'user_id' => Auth::id(),
                'course_id' => $course->id,
                'status' => 'ongoing'
            ]);

            session()->flash('ok', 'درس اخذ شد.');
            return redirect()->back();
        }
        
        Enrollment::where('user_id', Auth::id())->where('course_id', $course->id)->where('status', 'ongoing')->delete();
        session()->flash('ok', 'درس از برنامه شما حذف شد.');
        return redirect()->back();
    }
    
    public function schedule(){
        $courseIds = Enrollment::where('user_id', Auth::id())->where('status', 'ongoing')->pluck('course_id')->toArray();

        $sessions = CourseSession::whereIn('course_id', $courseIds)
            ->orderBy('hour')
            ->get();

        $daysOfWeek = ['شنبه', 'یکشنبه', 'دوشنبه', 'سه شنبه', 'چهارشنبه', 'پنجشنبه', 'جمعه'];
        $timeSlots = range(0, 22, 2);

        $schedule = [];
        foreach ($timeSlots as $hour) {
            foreach ($daysOfWeek as $day) {
                $schedule[$hour][$day] = null;
            }
        }

        foreach ($sessions as $session) {
            $startHour = $session->hour;
            $endHour = $startHour + 2;
            $day = $session->day;

            $schedule[$startHour][$day] = $session->course->name;
        }

        return view('student.schedule', compact('schedule', 'daysOfWeek', 'timeSlots'));
    }
    
    public function exams(){
        $courseIds = Enrollment::where('user_id', Auth::id())->where('status', 'ongoing')->pluck('course_id')->toArray();
        
        return view('student.exams', [
            'courses' => Course::whereIn('id', $courseIds)->orderBy('exam_date')->orderBy('exam_start_time')->get()
        ]);
    }
}
