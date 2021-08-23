<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(in_array('administrator', auth()->user()->getRoles()))
        @include('admin.dashboard')
    @elseif(in_array('teacher', auth()->user()->getRoles()))
        @include('teacher.dashboard')
    @elseif(in_array('student', auth()->user()->getRoles()))
        @include('student.dashboard')
    @endif

</x-app-layout>
