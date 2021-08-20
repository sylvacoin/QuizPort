<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1 pr-4">
                {{ __('My Courses') }}
            </h2>
            <div>

            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-2 bg-white border-b border-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-wrap mb-4">
                    <div class="w-full md:w-1/4 lg:w-1/4">
                        <form class="px-8 pt-6 pb-8 mb-4" method="post" action="{{route('course.create')}}">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                    Course Title
                                </label>
                                <x-input id="password" class="block mt-1 w-full"
                                         type="text"
                                         name="title"
                                         required />
                            </div>

                            <x-button>
                                Create Course
                            </x-button>

                        </form>
                    </div>
                    <div class="w-full md:w-3/4 lg:w-3/4">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                @if(session('success'))
                                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                                        <p>{{session('success')}}</p>
                                    </div>
                                @endif

                                @if(session('error'))
                                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                                        <p>{{session('error')}}</p>
                                    </div>
                                @endif
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            S/N
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Course Title
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Action</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">

                                    @if($courses->count() > 0)
                                        @php $i = 1; @endphp
                                        @foreach($courses as $course)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $i++ }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <a href="{{route('course.show', $course->id)}}" >
                                                            {{ $course->title }}
                                                        </a>
                                                    </div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                                                    <form method="POST" action="{{ route('course.destroy', $course->id) }}">
                                                        @csrf

                                                        <x-link-button :href="route('course.destroy', $course->id)"
                                                                         onclick="event.preventDefault();
                                                this.closest('form').submit();" class="">
                                                            <i class="fa fa-trash"></i>
                                                            {{ __('Delete') }}
                                                        </x-link-button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap" colspan="3">
                                                <p class="text-red-300 text-center"> No courses exists at the moment. create a course</p>
                                            </td>
                                        </tr>
                                    @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="py-2 px-2">
                        {{ $courses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
