<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminEnrollmentController extends Controller
{
    public function index(Request $request)
    {
        // For now, we will get all students who have enrolled in at least one course
        $students = User::where('role', 'student')->whereHas('courses')->with('courses')->paginate(10);
        
        $totalEnrollments = DB::table('course_user')->count();
        $activeEnrollments = $totalEnrollments; // Placeholder mapping
        $completed = 0; // Placeholder
        $expired = 0; // Placeholder
        $cancelled = 0; // Placeholder

        return view('admin.enrollments.index', compact(
            'students',
            'totalEnrollments',
            'activeEnrollments',
            'completed',
            'expired',
            'cancelled'
        ));
    }
}
