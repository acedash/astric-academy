@extends('layouts.admin')

@section('header', 'Enrolled Courses')

@section('header_actions')
<button class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium shadow-[0_2px_10px_rgb(37,99,235,0.2)] hover:bg-blue-700 transition flex items-center gap-2 text-sm">
    <i class="fas fa-file-export"></i> Export
</button>
@endsection

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
    <div class="bg-white rounded-xl shadow-[0_2px_10px_rgb(0,0,0,0.02)] border border-gray-100 p-5">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                <i class="fas fa-graduation-cap text-lg"></i>
            </div>
            <div>
                <p class="text-[11px] font-semibold text-gray-500 mb-0.5 tracking-wide uppercase">Total Enrollments</p>
                <p class="text-xl font-bold text-gray-900 leading-none">{{ $totalEnrollments }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-[0_2px_10px_rgb(0,0,0,0.02)] border border-gray-100 p-5">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-green-50 text-green-600 flex items-center justify-center shrink-0">
                <i class="fas fa-users text-lg"></i>
            </div>
            <div>
                <p class="text-[11px] font-semibold text-gray-500 mb-0.5 tracking-wide uppercase">Active Enrollments</p>
                <p class="text-xl font-bold text-gray-900 leading-none">{{ $activeEnrollments }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-[0_2px_10px_rgb(0,0,0,0.02)] border border-gray-100 p-5">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                <i class="fas fa-check-circle text-lg"></i>
            </div>
            <div>
                <p class="text-[11px] font-semibold text-gray-500 mb-0.5 tracking-wide uppercase">Completed</p>
                <p class="text-xl font-bold text-gray-900 leading-none">{{ $completed }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-[0_2px_10px_rgb(0,0,0,0.02)] border border-gray-100 p-5">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center shrink-0">
                <i class="far fa-clock text-lg"></i>
            </div>
            <div>
                <p class="text-[11px] font-semibold text-gray-500 mb-0.5 tracking-wide uppercase">Expired</p>
                <p class="text-xl font-bold text-gray-900 leading-none">{{ $expired }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-[0_2px_10px_rgb(0,0,0,0.02)] border border-gray-100 p-5">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-red-50 text-red-600 flex items-center justify-center shrink-0">
                <i class="far fa-times-circle text-lg"></i>
            </div>
            <div>
                <p class="text-[11px] font-semibold text-gray-500 mb-0.5 tracking-wide uppercase">Cancelled</p>
                <p class="text-xl font-bold text-gray-900 leading-none">{{ $cancelled }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="bg-white rounded-xl shadow-[0_2px_10px_rgb(0,0,0,0.02)] border border-gray-100 p-4 mb-6 flex flex-col xl:flex-row gap-4 items-center justify-between">
    <div class="flex-1 flex flex-col sm:flex-row gap-4 w-full">
        <!-- Search -->
        <div class="relative w-full sm:w-64 shrink-0">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400 text-sm"></i>
            </div>
            <input type="text" class="w-full pl-9 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400 focus:bg-white" placeholder="Search by student name, email or course...">
        </div>
        
        <!-- Course Select -->
        <div class="w-full sm:w-48">
            <select class="w-full border border-gray-200 rounded-lg text-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 text-gray-600 outline-none">
                <option>All Courses</option>
            </select>
        </div>
        
        <!-- Status Select -->
        <div class="w-full sm:w-32">
            <select class="w-full border border-gray-200 rounded-lg text-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 text-gray-600 outline-none">
                <option>All Status</option>
            </select>
        </div>
    </div>
    
    <div class="flex items-center gap-3 w-full xl:w-auto shrink-0 justify-end">
        <!-- Date Range -->
        <div class="hidden sm:flex items-center border border-gray-200 rounded-lg px-3 py-1.5">
            <span class="text-xs font-medium text-gray-500 mr-3">Enrollment Date</span>
            <input type="text" class="text-sm bg-transparent border-none p-0 focus:ring-0 w-20 text-gray-600 outline-none" placeholder="Start date">
            <span class="text-xs text-gray-300 mx-1">to</span>
            <input type="text" class="text-sm bg-transparent border-none p-0 focus:ring-0 w-20 text-gray-600 outline-none text-right" placeholder="End date">
            <i class="far fa-calendar-alt text-gray-400 ml-3"></i>
        </div>
        
        <button class="px-4 py-2 border border-gray-200 text-gray-600 rounded-lg font-medium hover:bg-gray-50 transition flex items-center gap-2 text-sm whitespace-nowrap bg-white shadow-sm">
            <i class="fas fa-filter text-gray-400"></i> Filters
        </button>
    </div>
</div>

<!-- Data Table -->
<div class="bg-white rounded-xl shadow-[0_2px_10px_rgb(0,0,0,0.02)] border border-gray-100 overflow-hidden">
    <div class="p-0 overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-max">
            <thead>
                <tr class="bg-gray-50/50 text-gray-500 text-xs font-semibold uppercase tracking-wider border-b border-gray-100">
                    <th class="px-6 py-4 w-12">#</th>
                    <th class="px-6 py-4">Student</th>
                    <th class="px-6 py-4">Course</th>
                    <th class="px-6 py-4">Enrollment Date</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4">Access Valid Till</th>
                    <th class="px-6 py-4">Progress</th>
                    <th class="px-6 py-4 text-center">Payment</th>
                    <th class="px-6 py-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @php $count = ($students->currentPage() - 1) * $students->perPage(); @endphp
                @forelse($students as $student)
                    @foreach($student->courses as $course)
                    @php $count++; @endphp
                    <tr class="hover:bg-gray-50/80 transition group">
                        <td class="px-6 py-4 text-gray-400 text-xs font-medium">{{ $count }}</td>
                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-900 leading-tight mb-1">{{ $student->name }}</p>
                            <p class="text-xs text-gray-500">{{ $student->email }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-800 leading-tight mb-1">{{ $course->title }}</p>
                            <p class="text-[11px] text-blue-600 font-medium">+ 4 Tools Program</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-900 leading-tight mb-1">{{ \Carbon\Carbon::parse($course->pivot->created_at)->format('d F Y') }}</p>
                            <p class="text-[11px] text-gray-500 uppercase tracking-wider">{{ \Carbon\Carbon::parse($course->pivot->created_at)->format('h:i A') }}</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex px-2.5 py-1 rounded bg-[#e8f5e9] text-[#2e7d32] text-xs font-medium">
                                Active
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-900 leading-tight mb-1">{{ \Carbon\Carbon::parse($course->pivot->created_at)->addYear()->format('d M Y') }}</p>
                            <p class="text-[11px] text-[#2e7d32] font-medium">365 days left</p>
                        </td>
                        <td class="px-6 py-4 w-32">
                            <div class="flex items-center gap-3">
                                <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden shrink-0">
                                    <div class="h-full bg-blue-600 rounded-full" style="width: 5%"></div>
                                </div>
                                <span class="text-xs text-gray-500 font-medium shrink-0">5%</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex px-2.5 py-1 rounded bg-[#e8f5e9] text-[#2e7d32] text-xs font-medium">
                                Paid
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-1 opacity-100 sm:opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="w-7 h-7 rounded flex items-center justify-center text-gray-400 hover:text-blue-600 hover:bg-blue-50 transition" title="View Details">
                                    <i class="far fa-eye text-sm"></i>
                                </button>
                                <button class="w-7 h-7 rounded flex items-center justify-center text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition">
                                    <i class="fas fa-ellipsis-v text-sm"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="9" class="px-6 py-12 text-center">
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-50 mb-3 text-gray-400">
                                <i class="fas fa-laptop-code text-xl"></i>
                            </div>
                            <p class="text-gray-500 font-medium">No enrollments found.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($students->hasPages())
    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/30">
        {{ $students->links() }}
    </div>
    @endif
</div>
@endsection
