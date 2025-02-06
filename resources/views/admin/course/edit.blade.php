@extends('layout.admin')
@section('content')
    <link type="text/css" rel="stylesheet" href="/assets/jalalidatepicker.min.css" />
    <script type="text/javascript" src="/assets/jalalidatepicker.min.js"></script>
    <div class="flex justify-center">
        <div
            class="w-full bg-white rounded-lg shadow-sm dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <form class="space-y-4" action="/admin/course/{{ $course->id }}/update" method="post">
                    @csrf
                    <div>
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">نام</label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required value="{{ $course->name }}">
                    </div>
                    <div>
                        <label for="code"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">کد</label>
                        <input type="text" name="code" id="code"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required value="{{ $course->code }}">
                    </div>
                    <div>
                        <label for="units"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">واحد</label>
                        <input type="number" name="units" id="units"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            min="1" required value="{{ $course->units }}">
                    </div>
                    <div>
                        <label for="department"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">دانشکده</label>
                        <input type="text" name="department" id="department"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required value="{{ $course->department }}">
                    </div>
                    <div>
                        <label for="instructor"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">استاد</label>
                        <input type="text" name="instructor" id="instructor"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required value="{{ $course->instructor }}">
                    </div>
                    <div>
                        <label for="exam_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">تاریخ
                            امتحان</label>
                        <input data-jdp type="text" name="exam_date" id="exam_date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required value="{{ $course->exam_date }}">
                    </div>
                    <div>
                        <label for="exam_start_time"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ساعت شروع امتحان</label>
                        <select name="exam_start_time" id="exam_start_time"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                            @for ($i = 0; $i <= 24; $i++)
                                <option @if ($course->exam_start_time == $i) selected @endif value="{{ $i }}">
                                    {{ $i }}:00</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label for="exam_end_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ساعت
                            پایان امتحان</label>
                        <select name="exam_end_time" id="exam_end_time"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required value="{{ $course->exam_end_time }}">
                            @for ($i = 0; $i <= 24; $i++)
                                <option @if ($course->exam_end_time == $i) selected @endif value="{{ $i }}">
                                    {{ $i }}:00</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label for="capacity"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ظرفیت</label>
                        <input type="number" name="capacity" id="capacity"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            min="1" required value="{{ $course->capacity }}">
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-hidden focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ذخیره</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        jalaliDatepicker.startWatch({
            separatorChars: {
                date: '-',
                between: ' ',
                time: ':'
            }
        });
    </script>
@endsection
