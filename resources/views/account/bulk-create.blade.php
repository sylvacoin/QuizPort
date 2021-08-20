<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Teacher List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4 flex justify-between items-center">
                        <div class="flex-1 pr-4">

                        </div>
                        <div>
                            <div class="shadow rounded-lg flex">
                                <div class="relative">
                                    <x-link-button :href="route('teachers.index')">
                                        {{ __('Back') }}
                                    </x-link-button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(session('status'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                            <p>{{session('status')}}</p>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                            <p>{{session('error')}}</p>
                        </div>
                    @endif
                    <form action="{{route('teachers.save')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                <input type="file" accept=".xls, .xlsx, .csv" name="teacherList" >
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <x-button>
                                    Upload List
                                </x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
