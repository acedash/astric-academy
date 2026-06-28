@extends('layouts.student')

@section('header', 'Welcome back, ' . explode(' ', Auth::user()->name)[0] . '!')

@section('content')
<div class="mb-8">
    <p class="text-gray-500 text-base">Here is an overview of your active courses. Pick up right where you left off.</p>
</div>

@if($courses->isEmpty())
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-12 text-center max-w-3xl mx-auto mt-12">
        <div class="w-24 h-24 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-box-open text-4xl text-indigo-300"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-2">No active enrollments yet</h3>
        <p class="text-gray-500 mb-8 max-w-md mx-auto">You haven't been enrolled in any courses yet. When an administrator grants you access, your courses will appear here.</p>
        <a href="https://astryxacademy.com/#courses" class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition shadow-sm">
            <span>Explore Course Catalog</span>
            <i class="fas fa-arrow-right text-sm"></i>
        </a>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($courses as $course)
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-md border border-gray-200 overflow-hidden transition-all duration-300 flex flex-col group relative">
            <!-- Status Badge -->
            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur text-emerald-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider shadow-sm z-10 flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                Active
            </div>
            
            <!-- Course Image Placeholder / Gradient -->
            <div class="h-48 bg-gradient-to-br from-indigo-500 to-purple-600 relative overflow-hidden flex-shrink-0 flex items-center justify-center p-6 text-center">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="absolute -right-10 -top-10 w-32 h-32 rounded-full bg-white/10 blur-2xl"></div>
                
                <h3 class="text-white text-2xl font-bold relative z-10 leading-tight drop-shadow-md">
                    {{ $course->title }}
                </h3>
            </div>
            
            <!-- Course Details -->
            <div class="p-6 flex-1 flex flex-col">
                @if($course->tools_count > 0)
                    <div class="mb-3">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-indigo-50 text-indigo-700 text-[10px] font-bold uppercase tracking-widest border border-indigo-100">
                            <i class="fas fa-tools"></i> {{ $course->tools_count }} Tools Program
                        </span>
                    </div>
                @endif
                
                <p class="text-gray-600 text-sm mb-6 line-clamp-3">
                    {{ $course->description ?? 'Start mastering the skills required for ' . $course->title . ' with our comprehensive curriculum.' }}
                </p>
                
                <!-- Progress placeholder -->
                <div class="mt-auto mb-6">
                    <div class="flex items-center justify-between text-xs font-semibold text-gray-500 mb-2">
                        <span>Course Progress</span>
                        <span class="text-indigo-600">0%</span>
                    </div>
                    <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-indigo-500 rounded-full" style="width: 0%"></div>
                    </div>
                    <div class="text-xs text-gray-400 mt-2 font-medium flex items-center gap-1.5">
                        <i class="fas fa-list-ul"></i> {{ $course->lessons_count }} Lessons total
                    </div>
                </div>
                
                <!-- Action Button -->
                <a href="{{ route('student.courses.show', $course->id) }}" class="block w-full text-center py-3 px-4 bg-gray-50 hover:bg-indigo-600 text-gray-700 hover:text-white font-semibold rounded-xl transition-colors duration-300 border border-gray-200 hover:border-indigo-600">
                    Start Learning
                </a>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection
