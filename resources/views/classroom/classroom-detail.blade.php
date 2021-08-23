<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1 pr-4">
                {{ __(($classroom->title??'').' Lessons') }}
            </h2>
            <div>
                <x-link-button :href="route('lesson.create', $classroom->id)">
                    {{ __('Create a Lesson') }}
                </x-link-button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-2 bg-white border-b border-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-wrap mb-4">
                    <div class="w-full">
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
                                            Lesson Title
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Room ID
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Action</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">

                                    @if($lessons->count() > 0)
                                        @php $i = 1; @endphp
                                        @foreach($lessons as $lesson)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $i++ }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">

                                                            {{ $lesson->title }}

                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">

                                                        {{ strtoupper($lesson->classroom->room_id) }}

                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">

                                                        @if($lesson->status == 1)
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  Active
                </span>
                                                        @else
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-pink-100 text-pinl-800">
                  Inactive
                </span>
                                                        @endif

                                                    </div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                                                        <div class="flex flex-wrap justify-end">
                                                            <x-link-button href="{{ route('quiz.index', $lesson->id)  }}" title="Quiz Menu" class="mx-1">
                                                                <i class="icofont-learn"></i>
                                                                Quiz
                                                            </x-link-button>
                                                            <x-link-button href="{{ route('lesson.show', $lesson->id)  }}" title="View details" class="mx-1">
                                                                <i class="icofont-exclamation-circle"></i>
                                                                View
                                                            </x-link-button>
                                                            <form method="POST" action="{{ route('lesson.destroy', $lesson->id) }}">
                                                                @csrf
                                                                <x-button :href="route('lesson.destroy', $lesson->id)"
                                                                            onclick="event.preventDefault();
                                                this.closest('form').submit();" class="mx-1">
                                                                    <i class="icofont-bin"></i>
                                                                    Delete
                                                                </x-button>
                                                            </form>
                                                        </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap" colspan="5">
                                                <p class="text-red-300 text-center"> No lessons exists at the moment. create a lesson</p>
                                            </td>
                                        </tr>
                                    @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="py-2 px-2">
                        {{ $lessons->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
