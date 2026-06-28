<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentCourseController extends Controller
{
    public function show(Course $course, Lesson $lesson = null)
    {
        // 1. Verify the student is enrolled in this course
        $user = Auth::user();
        
        if (!$user->courses()->where('courses.id', $course->id)->exists()) {
            abort(403, 'You are not enrolled in this course.');
        }

        // 2. Load all lessons for this course, ordered
        $lessons = $course->lessons()->orderBy('order')->get();

        // 3. Determine the active lesson
        if ($lesson) {
            // Verify this lesson actually belongs to this course
            if ($lesson->course_id !== $course->id) {
                abort(404, 'Lesson not found in this course.');
            }
            $activeLesson = $lesson;
        } else {
            // Default to the first lesson if none provided
            $activeLesson = $lessons->first();
        }

        return view('student.courses.show', compact('course', 'lessons', 'activeLesson'));
    }
}
