

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between flex-wrap">
                <div class="md:w-1/2 lg:w-1/4 p-2">
                    <div class="shadow-md p-5 md:py-10 bg-white">
                        <div class="flex flex-col">
                            <div class="flex flex-row">
                                <div class="flex-1">
                                    <div class="uppercase text-sm text-gray-400">
                                        Teachers
                                    </div>
                                    <div class="mt-1">
                                        <div class="flex flex-row justify-start items-center">
                                            <div class="text-2xl">
                                                @if(isset($teacher_count))
                                                    {{$teacher_count}}
                                                @else
                                                    0
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <svg class="h-16 w-20 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2 lg:w-1/4 p-2">
                    <div class="shadow-md p-5 md:py-10 bg-white">
                        <div class="flex flex-col">
                            <div class="flex flex-row">
                                <div class="flex-1">
                                    <div class="uppercase text-sm text-gray-400">
                                        Students
                                    </div>
                                    <div class="mt-1">
                                        <div class="flex flex-row justify-start items-center">
                                            <div class="text-2xl">
                                                @if(isset($student_count))
                                                    {{$student_count}}
                                                @else
                                                    0
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <svg class="h-16 w-20 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2 lg:w-1/4 p-2">
                    <div class="shadow-md p-5 md:py-10 bg-white">
                        <div class="flex flex-col">
                            <div class="flex flex-row justify-between">
                                <div class="">
                                    <div class="uppercase text-sm text-gray-400">
                                        Classrooms
                                    </div>
                                    <div class="mt-1">
                                        <div class="flex flex-row justify-start items-center">
                                            <div class="text-2xl">
                                                @if(isset($classroom_count))
                                                    {{$classroom_count}}
                                                @else
                                                    0
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <svg stroke="currentColor" fill="currentColor" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" viewBox="0 0 512 512" xml:space="preserve" class="text-gray-300 h-16 w-20"><g>
                                            <path xmlns="http://www.w3.org/2000/svg" d="m150 60c0-33.085938-26.914062-60-60-60s-60 26.914062-60 60 26.914062 60 60 60 60-26.914062 60-60zm-60 30c-16.542969 0-30-13.457031-30-30s13.457031-30 30-30 30 13.457031 30 30-13.457031 30-30 30zm0 0" /><path xmlns="http://www.w3.org/2000/svg" d="m300 347c0-24.8125-20.1875-45-45-45s-45 20.1875-45 45 20.1875 45 45 45 45-20.1875 45-45zm-45 15c-8.269531 0-15-6.730469-15-15s6.730469-15 15-15 15 6.730469 15 15-6.730469 15-15 15zm0 0" /><path xmlns="http://www.w3.org/2000/svg" d="m420 347c0-24.8125-20.1875-45-45-45s-45 20.1875-45 45 20.1875 45 45 45 45-20.1875 45-45zm-45 15c-8.269531 0-15-6.730469-15-15s6.730469-15 15-15 15 6.730469 15 15-6.730469 15-15 15zm0 0" /><path xmlns="http://www.w3.org/2000/svg" d="m497 0h-302c-8.285156 0-15 6.714844-15 15v105h-105c-41.355469 0-75 33.644531-75 75v302c0 8.285156 6.714844 15 15 15h420c8.285156 0 15-6.714844 15-15v-30c0-41.355469-33.644531-75-75-75-24.507812 0-46.304688 11.816406-60 30.050781-13.695312-18.234375-35.492188-30.050781-60-30.050781s-46.304688 11.816406-60 30.050781c-13.695312-18.234375-35.492188-30.050781-60-30.050781-41.355469 0-75 33.644531-75 75v15h-30v-287c0-24.8125 20.1875-45 45-45h180c8.269531 0 15 6.730469 15 15s-6.730469 15-15 15h-120c-8.285156 0-15 6.714844-15 15v109.578125c-17.460938 6.195313-30 22.867187-30 42.421875 0 24.8125 20.1875 45 45 45s45-20.1875 45-45c0-19.554688-12.539062-36.226562-30-42.421875v-94.578125h30v46c0 8.285156 6.714844 15 15 15h302c8.285156 0 15-6.714844 15-15v-241c0-8.285156-6.714844-15-15-15zm-122 422c24.8125 0 45 20.1875 45 45v15h-90v-15c0-24.8125 20.1875-45 45-45zm-120 0c24.8125 0 45 20.1875 45 45v15h-90v-15c0-24.8125 20.1875-45 45-45zm-165 45c0-24.8125 20.1875-45 45-45s45 20.1875 45 45v15h-90zm45-105c-8.269531 0-15-6.730469-15-15s6.730469-15 15-15 15 6.730469 15 15-6.730469 15-15 15zm347-121h-272v-31h45c24.8125 0 45-20.1875 45-45 0-1.882812-.128906-3.730469-.355469-5.550781l142.0625-71.03125c7.410157-3.707031 10.414063-12.714844 6.707031-20.125-3.703124-7.410157-12.714843-10.414063-20.125-6.707031l-142.082031 71.039062c-8.097656-7.808594-19.097656-12.625-31.207031-12.625h-45v-90h272zm0 0" class="text-gray-300"/>
                                        </g></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2 lg:w-1/4 p-2">
                    <div class="shadow-md p-5 md:py-10 bg-white">
                        <div class="flex flex-col">
                            <div class="flex flex-row justify-between">
                                <div class="">
                                    <div class="uppercase text-sm text-gray-400">
                                        Lessons
                                    </div>
                                    <div class="mt-1">
                                        <div class="flex flex-row justify-start items-center">
                                            <div class="text-2xl">
                                                @if(isset($lesson_count))
                                                    {{$lesson_count}}
                                                @else
                                                    0
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" stroke="currentColor" fill="currentColor" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" viewBox="0 0 512 512" xml:space="preserve" class="h-16 w-20 text-gray-300">
<g><g xmlns="http://www.w3.org/2000/svg">
        <path d="m88 456c-8.837 0-16-7.164-16-16v-374c0-36.393 29.607-66 66-66h286c8.837 0 16 7.164 16 16v368c0 8.836-7.163 16-16 16s-16-7.164-16-16v-352h-270c-18.748 0-34 15.252-34 34v374c0 8.836-7.163 16-16 16z" />
        <path d="m424 512h-280c-39.701 0-72-32.299-72-72s32.299-72 72-72h280c8.837 0 16 7.164 16 16s-7.163 16-16 16h-280c-22.056 0-40 17.944-40 40s17.944 40 40 40h280c8.837 0 16 7.164 16 16s-7.163 16-16 16z" />
        <path d="m424 456h-280c-8.837 0-16-7.164-16-16s7.163-16 16-16h280c8.837 0 16 7.164 16 16s-7.163 16-16 16z" />
        <path d="m160 400c-8.837 0-16-7.164-16-16v-368c0-8.836 7.163-16 16-16s16 7.164 16 16v368c0 8.836-7.163 16-16 16z" />
    </g>
</g>
</svg>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
