<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1 pr-4">
                {{ __('Create Lesson for '. $course->title?? 'Course') }}
            </h2>
            <div>
                <x-link-button href="{{ route('course.show', $course->id) }}">
                    {{ __('Back') }}
                </x-link-button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-2 bg-white border-b border-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-wrap mb-4">
                    <div class="w-full">
                        <div class="py-6 align-middle inline-block min-w-full sm:px-6 lg:px-8">

                                @if(session('success'))
                                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                                        <p>{{session('success')}}</p>
                                    </div>
                                @endif

                                @if(session('error'))
                                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                                        <p>{{session('error')}}</p>
                                    </div>
                                @endif
                                    <form method="post" action="{{route('lesson.save', $course->id)}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="flex flex-wrap -mx-3 mb-6">
                                            <div class="w-full px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                                    Lesson Subject / Title
                                                </label>
                                                <input name="title" class="appearance-none block w-full bg-gray-200 border border-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text">
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-6">
                                            <div class="w-full px-3">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                                    Summary / Short Description
                                                </label>
                                                <textarea class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="description" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-6">
                                            <div class="w-full px-3">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                                    Lesson Note
                                                </label>
                                                <textarea class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="note" rows="7"></textarea>
                                                <p class="text-gray-600 text-xs italic">Make it as long and as crazy as you'd like</p>
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-2">
                                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                                                    Upload Note Attachments
                                                </label>
                                                <input class="appearance-none block w-full bg-white-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight" name="attachments[]"  multiple type="file" placeholder="upload attachments">
                                            </div>
                                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                                                    Lesson Status
                                                </label>
                                                <div class="relative">
                                                    <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="status">
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">

                                            </div>
                                        </div>
                                        <div class="flex -mx-3 mb-2 justify-end">
                                            <x-button>
                                                {{ __('Create Lesson') }}
                                            </x-button>
                                        </div>
                                    </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
