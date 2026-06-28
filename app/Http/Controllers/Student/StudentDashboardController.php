<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Fetch courses the student is enrolled in with their lesson counts
        $courses = $user->courses()->withCount('lessons')->get();
        
        return view('student.dashboard', compact('courses'));
    }
}
