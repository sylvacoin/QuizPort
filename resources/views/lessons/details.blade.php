<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1 pr-4">
                {{ __($lesson->name . ' Lesson Details') }}
            </h2>
            <div>
                <x-button onClick="window.history.back()">
                    {{ __('Back') }}
                </x-button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

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
                    <div class="font-bold text-xl mb-2">Questions</div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                S/N
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" colspan="4">
                                Question
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
{{--                        @if(isset($classrooms) && !empty($classrooms) && $classrooms->count())--}}
{{--                            @php $i = 1; @endphp--}}
{{--                            @foreach($classrooms as $classroom)--}}
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        1
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap" colspan="3">
                                        <p>Question here and its very long?</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap" >
                                        <x-link-button href="#" class="text-xs">
                                            <i class="fa fa-eye"></i>
                                            {{ __('Ask') }}
                                        </x-link-button>
                                        <x-link-button href="#" class="text-xs row-trigger" data-row="1">
                                            <i class="fa fa-eye"></i>
                                            {{ __('Stats') }}
                                        </x-link-button>
                                    </td>
                                </tr>
                                <tr class="stats row1">
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p class="font-bold">Options</p>
                                        <p class="text-xs">A.) Option 1</p>
                                        <p class="text-xs">B.) Option 2</p>
                                        <p class="text-xs">C.) Option 3</p>
                                        <p class="text-xs">D.) Option 4</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap" >
                                        <p><span class="font-bold">Answer : </span> Answer</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap" colspan="2">
                                        <p class="font-bold">Stats</p>
                                        <p class="text-xs">Number answered: 12/14</p>
                                        <p class="text-xs">Correct answers: 5/14</p>
                                        <p class="text-xs">Wrong answers: 7/14</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        1
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap" colspan="3">
                                        <p>Question here and its very long?</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap" >
                                        <x-link-button href="#" class="text-xs">
                                            <i class="fa fa-eye"></i>
                                            {{ __('Ask') }}
                                        </x-link-button>
                                        <x-link-button href="#" class="text-xs row-trigger" data-row="2">
                                            <i class="fa fa-eye"></i>
                                            {{ __('Stats') }}
                                        </x-link-button>
                                    </td>
                                </tr>
                                <tr class="stats row2">
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p class="font-bold">Options</p>
                                        <p class="text-xs">A.) Option 1</p>
                                        <p class="text-xs">B.) Option 2</p>
                                        <p class="text-xs">C.) Option 3</p>
                                        <p class="text-xs">D.) Option 4</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap" >
                                        <p><span class="font-bold">Answer : </span> Answer</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap" colspan="2">
                                        <p class="font-bold">Stats</p>
                                        <p class="text-xs">Number answered: 12/14</p>
                                        <p class="text-xs">Correct answers: 5/14</p>
                                        <p class="text-xs">Wrong answers: 7/14</p>
                                    </td>
                                </tr>
{{--                            @endforeach--}}
{{--                        @else--}}
{{--                            <tr>--}}
{{--                                <td class="px-6 py-4 whitespace-nowrap" colspan="4">--}}
{{--                                    <p class="text-red-300 text-center"> No classroom exists at the moment.</p>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endif--}}
                        </tbody>
                    </table>
                </div>
                <div class="p-6 bg-white border-b border-gray-200 ">
                    <div class="font-bold text-md mb-2 uppercase">Live Chat</div>
                    <!-- MESSAGES -->
                    <div class="overflow-y-auto h-64 flex flex-wrap">

                            <!-- SINGLE MESSAGE -->
                            <div class="justify-start">
                                <div
                                    class="bg-gray-300 w-3/4 mx-4 my-2 p-2 rounded-lg"
                                >this is a basic mobile chat layout, build with tailwind css</div>
                            </div>

                            <!-- SINGLE MESSAGE 2 -->
                            <div class="justify-start">
                                <div
                                    class="bg-gray-300 w-3/4 mx-4 my-2 p-2 rounded-lg clearfix"
                                >It will be used for a full tutorial about building a chat app with vue, tailwind and firebase.</div>
                            </div>

                            <!-- SINGLE MESSAGE 3 -->
                            <div class="justify-end">
                                <div
                                    class="bg-green-300 float-right w-3/4 mx-4 my-2 p-2 rounded-lg clearfix"
                                >check my twitter to see when it will be released.</div>
                            </div>

                            <!-- SINGLE MESSAGE 4 -->
                            <div class="justify-start">
                                <div
                                    class="bg-gray-300 w-3/4 mx-4 my-2 p-2 rounded-lg clearfix"
                                >It will be used for a full tutorial about building a chat app with vue, tailwind and firebase.</div>
                            </div>
                    </div>
                </div>
                <div class="p-6 bg-white border-b border-gray-200 ">
                    <div class="font-bold text-md mb-2 uppercase">Class LeaderBoard</div>
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

            </div>
        </div>
    </div>
    <script>
        $('.stats').hide();
        $(document).on('click', '.row-trigger', function () {
            const id = $(this).data('row');
            console.log(id)
            $('.row'+id).toggle('slow');
        })
    </script>
</x-app-layout>

