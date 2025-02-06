<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseSession;
use App\Models\Requirement;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return redirect('/admin/courses');
    }

    public function courses(Request $request){
        $courses = Course::with(['sessions', 'ongoingEnrollments'])->orderBy('id', 'DESC');

        if($request->has('search') && $request->input('search') && $request->input('search') !== ''){
            $courses = $courses->where('name', 'LIKE', '%'.$request->input('search').'%')->orWhere('code', 'LIKE', '%'.$request->input('search').'%');
        }

        if($request->has('department') && $request->input('department') && $request->input('department') !== 'all'){
            $courses = $courses->where('department', $request->input('department'));
        }

        return view('admin.course.index', [
            'courses' => $courses->get(),
            'departments' => Course::select('department')->distinct()->pluck('department')->toArray(),
            'oldSearch' => $request->input('search', ''),
            'oldDepartment' => $request->input('department', 'all'),
        ]);
    }
    
    public function createCourse(){
        return view('admin.course.create');
    }
    
    public function storeCourse(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'units' => 'required|integer|min:1',
            'department' => 'required',
            'instructor' => 'required',
            'exam_date' => 'required',
            'exam_start_time' => 'required|integer|min:0',
            'exam_end_time' => 'required|integer|min:0',
            'capacity' => 'required|integer|min:1',
        ]);

        $course = Course::create([
            'name' => $data['name'],
            'code' => $data['code'],
            'units' => $data['units'],
            'department' => $data['department'],
            'instructor' => $data['instructor'],
            'exam_date' => $data['exam_date'],
            'exam_start_time' => $data['exam_start_time'],
            'exam_end_time' => $data['exam_end_time'],
            'capacity' => $data['capacity'],
        ]);

        session()->flash('ok', 'درس ذخیره شد. لطفا جلسات درس را اضافه کنید.');
        return redirect('/admin/course/'.$course->id.'/session/create');
    }
    
    public function editCourse(Course $course){
        return view('admin.course.edit', [
            'course' => $course
        ]);
    }
    
    public function updateCourse(Request $request, Course $course){
        $data = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'units' => 'required|integer|min:1',
            'department' => 'required',
            'instructor' => 'required',
            'exam_date' => 'required',
            'exam_start_time' => 'required|integer|min:0',
            'exam_end_time' => 'required|integer|min:0',
            'capacity' => 'required|integer|min:1',
        ]);

        $course->name = $data['name'];
        $course->code = $data['code'];
        $course->units = $data['units'];
        $course->department = $data['department'];
        $course->instructor = $data['instructor'];
        $course->exam_date = $data['exam_date'];
        $course->exam_start_time = $data['exam_start_time'];
        $course->capacity = $data['capacity'];
        $course->save();

        session()->flash('ok', 'تغییرات ذخیره شد.');
        return redirect('/admin/course/'.$course->id);
    }
    
    public function deleteCourse(Course $course){
        $course->delete();
        session()->flash('ok', 'درس حذف شد.');
        return redirect('/admin/courses');
    }
    
    public function showCourse($course){
        return view('admin.course.show', [
            'course' => Course::where('id', $course)->with(['sessions', 'ongoingEnrollments.user', 'requirements.required'])->firstOrFail(),
        ]);
    }

    public function createSession(Course $course){
        return view('admin.course.session.create', [
            'course' => $course
        ]);
    }
    
    public function storeSession(Request $request, Course $course){
        $data = $request->validate([
            'day' => 'required',
            'hour' => 'required',
        ]);

        CourseSession::create([
            'course_id' => $course->id,
            'day' => $data['day'],
            'hour' => $data['hour'],
        ]);

        session()->flash('ok', 'جلسه ذخیره شد.');
        return redirect('/admin/course/'.$course->id);
    }
    
    public function deleteSession(CourseSession $courseSession){
        $courseSession->delete();
        session()->flash('ok', 'جلسه حذف شد.');
        return redirect('/admin/course/'.$courseSession->course_id);
    }
    
    public function createRequirement(Course $course){
        return view('admin.course.requirement.create', [
            'course' => $course,
            'courses' => Course::whereNotIn('id', [...Requirement::where('course_id', $course->id)->pluck('id')->toArray(), $course->id])->orderBy('id', 'DESC')->get()
        ]);
    }
    
    public function storeRequirement(Request $request, Course $course){
        $data = $request->validate([
            'required_id' => 'required',
            'type' => 'required',
        ]);

        if($data['required_id'] == $course->id){
            session()->flash('error', 'یک درس نمی تواند نیازمند خودش باشد.');
            return redirect()->back();
        }

        Requirement::create([
            'course_id' => $course->id,
            'required_id' => $data['required_id'],
            'type' => $data['type'],
        ]);

        session()->flash('ok', 'نیازمندی اضافه شد.');
        return redirect('/admin/course/'.$course->id);
    }
    
    public function deleteRequirement(Requirement $requirement){
        $requirement->delete();
        session()->flash('ok', 'نیازمندی حذف شد.');
        return redirect('/admin/course/'.$requirement->course_id);
    }
}
