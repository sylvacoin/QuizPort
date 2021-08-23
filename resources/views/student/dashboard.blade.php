

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @php echo auth()->user()->getRole() @endphp
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
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4">
                <div class="p-6 bg-white border-b border-gray-200 md:col-span-2 md:row-span-2">
                    <div class="font-bold text-xl mb-2">Subscribe to classroom</div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                S/N
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Classroom
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tutor
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Action</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @if(isset($courses) && !empty($courses) && $courses->count())
                            @php $i = 1; @endphp
                            @foreach($courses as $course)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap" >
                                <p> {{$i++}}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap" >
                                <p> {{$course->title ?? 'N/A'}} </p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap" >
                                <p> {{$course->owner->name ?? 'N/A'}} </p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap" >
                                <x-link-button :href="route('course.subscribe', $course->id)" class="text-xs">
                                    <i class="fa fa-eye"></i>
                                    {{ __('Subscribe') }}
                                </x-link-button>
                            </td>

                        </tr>
                            @endforeach
                        @else
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap" colspan="4">
                                <p class="text-red-300 text-center"> No classroom exists at the moment.</p>
                            </td>
                        </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="p-6 bg-white border-b border-gray-200 ">
                    <div class="font-bold text-xl mb-2">LeaderBoard</div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Classroom
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ranking
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap" >
                                <p> PHP </p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap" >
                                100th
                            </td>

                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap" colspan="4">
                                <p class="text-red-300 text-center"> No ranking at the moment.</p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-6 bg-white border-b border-gray-200 ">
                    <div class="font-bold text-xl mb-2">Active classrooms</div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                S/N
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Classroom
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Action</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap" >
                                <p> 1</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap" >
                                <p> PHP </p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap" >
                                <x-link-button href="#" class="text-xs">
                                    <i class="fa fa-eye"></i>
                                    {{ __('Join') }}
                                </x-link-button>
                            </td>

                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap" colspan="4">
                                <p class="text-red-300 text-center"> No active classroom at the moment.</p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>


