<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1 pr-4">
                {{ __('Create Quiz for '. $lesson->title?? 'Course') }}
            </h2>
            <div>
                <x-link-button href="{{ route('course.show', $lesson->id) }}">
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


                                @if(session('error'))
                                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                                        <p>{{session('error')}}</p>
                                    </div>
                                @endif
                                    <form method="post" action="{{route('quiz.save', $lesson->id)}}">
                                        @csrf
                                        <div class="flex flex-wrap -mx-3 mb-6">
                                            <div class="w-full px-3 mb-6 md:mb-0">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                                    Question
                                                </label>
                                                <input name="question" class="appearance-none block w-full bg-gray-200 border border-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text">
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap -mx-3 mb-6">
                                            <div class="w-full px-3">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                                    Option Type
                                                </label>
                                                <select id="optionType" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="option_type">
                                                    <option value="1">Multichoice</option>
{{--                                                    <option value="2">Subjective</option>--}}
                                                    <option value="3">True or False</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div id="optionSelector">
                                            <x-button onClick="addOption()" type="button"> Add Option</x-button>
                                            <div class="flex flex-wrap -mx-3 mb-6 opt" id="row1">
                                                <div class="w-full px-3">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                                        Option 1
                                                    </label>
                                                    <div class="relative flex w-full items-stretch">
                                                        <input name="options[]" class="appearance-none block w-full bg-gray-200 border border-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text">
                                                        <span class="z-10 h-full leading-snug font-normal absolute text-center text-blueGray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 right-0 pr-3 py-3">
                                                                <i class="icofont-warning-alt" onClick="deleteOption('1')"></i>
                                                            </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="multichoiceAnswerSelector_section">
                                            <div class="flex flex-wrap -mx-3 mb-6">
                                                <div class="w-full px-3">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                                        Answer
                                                    </label>
                                                    <div class="relative flex w-full items-stretch">
                                                        <select name="answer[1]" id="multichoiceAnswerSelector" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                                                            <option value="A">A</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
{{--                                        <div id="subjectiveAnswerSelector_section">--}}
{{--                                            <div class="flex flex-wrap -mx-3 mb-6">--}}
{{--                                                <div class="w-full px-3">--}}
{{--                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">--}}
{{--                                                        Answer--}}
{{--                                                    </label>--}}
{{--                                                    <div class="relative flex w-full items-stretch">--}}
{{--                                                        <input name="answer[2]" class="appearance-none block w-full bg-gray-200 border border-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div id="booleanAnswerSelector_section">
                                            <div class="flex flex-wrap -mx-3 mb-6" >
                                                <div class="w-full px-3">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                                        Answer
                                                    </label>
                                                    <div class="relative flex w-full items-stretch">
                                                        <label class="inline-flex items-center">
                                                            <input type="radio" class="form-radio" name="answer[3]" value="true">
                                                            <span class="ml-2">Yes</span>
                                                        </label>
                                                        <label class="inline-flex items-center ml-6">
                                                            <input type="radio" class="form-radio" name="answer[3]" value="false">
                                                            <span class="ml-2">No</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex -mx-3 mb-2 justify-end">
                                            <x-button>
                                                {{ __('Add Question') }}
                                            </x-button>
                                        </div>
                                    </form>
                                <script>
                                    $(document).ready(function () {
                                        const optionType = $('#optionType').val();

                                        if (optionType == 1)
                                        {
                                            $('#optionSelector').show();
                                            $('#multichoiceAnswerSelector_section').show();
                                            $('#subjectiveAnswerSelector_section').hide();
                                            $('#booleanAnswerSelector_section').hide()
                                        }else if (optionType == 2)
                                        {
                                            $('#optionSelector').hide();
                                            $('#multichoiceAnswerSelector_section').hide();
                                            $('#subjectiveAnswerSelector_section').show();
                                            $('#booleanAnswerSelector_section').hide()

                                        }else if(optionType == 3)
                                        {
                                            $('#optionSelector').hide();
                                            $('#multichoiceAnswerSelector_section').hide();
                                            $('#subjectiveAnswerSelector_section').hide();
                                            $('#booleanAnswerSelector_section').show()
                                        }
                                    });

                                    $(document).on('change', '#optionType', function () {
                                        const optionType = $(this).val();

                                        if (optionType == 1)
                                        {
                                            $('#optionSelector').show();
                                            $('#multichoiceAnswerSelector_section').show();
                                            $('#subjectiveAnswerSelector_section').hide();
                                            $('#booleanAnswerSelector_section').hide()
                                        }else if (optionType == 2)
                                        {
                                            $('#optionSelector').hide();
                                            $('#multichoiceAnswerSelector_section').hide();
                                            $('#subjectiveAnswerSelector_section').show();
                                            $('#booleanAnswerSelector_section').hide()

                                        }else if(optionType == 3)
                                        {
                                            $('#optionSelector').hide();
                                            $('#multichoiceAnswerSelector_section').hide();
                                            $('#subjectiveAnswerSelector_section').hide();
                                            $('#booleanAnswerSelector_section').show()
                                        }
                                    });

                                    const addOption = () => {
                                        const count = $('.opt').length + 1;
                                        const val = numToSSColumn(count);

                                        const row = `<div class="flex flex-wrap -mx-3 mb-6 opt" id="row${count}">
                                                    <div class="w-full px-3">
                                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                                            Option ${count}
                                                        </label>
                                                        <div class="relative flex w-full items-stretch">
                                                            <input name="option[]" class="appearance-none block w-full bg-gray-200 border border-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text">
                                                            <span class="z-10 h-full leading-snug font-normal absolute text-center text-blueGray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 right-0 pr-3 py-3">
                                                                <i class="icofont-warning-alt" onClick="deleteOption(${count})"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>`;
                                        const optionSelector = $('#optionSelector');
                                        const answerSelector = $('#multichoiceAnswerSelector');

                                        optionSelector.append(row);
                                        answerSelector.append(`<option value="${val}">${val}</option>`);
                                        return false;
                                    }

                                    const deleteOption = (id) => {
                                        $('#row'+id).remove();
                                        const val = numToSSColumn(id);
                                        const answerSelector = $("#multichoiceAnswerSelector option[value='"+ val+"']");
                                        answerSelector.remove();
                                    }

                                    const numToSSColumn = (num) => {
                                        let s = '', t;

                                        while (num > 0) {
                                            t = (num - 1) % 26;
                                            s = String.fromCharCode(65 + t) + s;
                                            num = (num - t)/26 | 0;
                                        }
                                        return s || undefined;
                                    }

                                </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
