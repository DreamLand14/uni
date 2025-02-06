<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function index(){
        if(Auth::check()){
            if(Auth::user()->role === 'student'){
                return redirect('/student');
            }
            return redirect('/admin');
        }
        return redirect('/login');
    }
}
