<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Requirement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage(){
        return view('auth.login');
    }
    
    public function login(Request $request){
        $data = $request->validate([
            'id' => 'required',
            'password' => 'required'
        ]);

        $users = User::where('id', $data['id'])->get();
        if(count($users) > 0 && Hash::check($data['password'], $users[0]->password)){
            Auth::login($users[0]);
            return redirect('/');
        }

        session()->flash('error', 'اطلاعات نادرست است.');
        return redirect()>back();
    }
    
    public function registerPage(){
        return view('auth.register');
    }
    
    public function register(Request $request){
        $data = $request->validate([
            'id' => 'required|unique:users|integer',
            'first_name' => 'required',
            'last_name' => 'required',
            'national_code' => 'required|unique:users|size:10',
            'email' => 'required|unique:users|email',
            'phone' => 'required|unique:users|size:11',
            'password' => 'required',
            'role' => 'required',
            'max_units' => 'required|integer|min:0',
        ]);

        if(!ctype_digit($data['national_code'])) {
            session()->flash('error', 'کد ملی باید عددی باشد.');
            return redirect()->back();
        }

        if(!ctype_digit($data['phone'])) {
            session()->flash('error', 'شماره موبایل باید عددی باشد.');
            return redirect()->back();
        }

        $user = User::create([
            'id' => $data['id'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'national_code' => $data['national_code'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'max_units' => $data['max_units'],
        ]);

        if($data['role'] === 'student' && $request->input('passed_units') && $request->input('passed_units') !== ''){
            foreach(explode(',', $request->input('passed_units')) as $passedUnit){
                Requirement::create([
                    'course_id' => Course::where('code', $passedUnit)->pluck('id')->toArray()[0],
                    'user_id' => $user->id,
                    'status' => 'done'
                ]);
            }
        }

        Auth::login($user);
        return redirect('/');
    }
    
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    public function resetPasswordPage(){
        return view('auth.resetPassword');
    }

    public function resetPassword(Request $request){
        $data = $request->validate([
            'id' => 'required',
            'password' => 'required',
        ]);

        User::where('id', $data['id'])->update([
            'password' => Hash::make($data['password'])
        ]);

        session()->flash('ok', 'رمز جدید ذخیره شد.');
        return redirect('/login');
    }
}
