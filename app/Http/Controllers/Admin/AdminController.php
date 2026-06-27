<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalStudents = User::where('role', 'student')->count();
        $totalCourses = Course::count();
        
        $recentStudents = User::where('role', 'student')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalStudents', 'totalCourses', 'recentStudents'));
    }
}
