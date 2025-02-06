@extends('layout.admin')
@section('content')
    <div class="flex justify-center">
        <div
            class="w-full bg-white rounded-lg shadow-sm dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <form class="space-y-4" action="/admin/course/{{ $course->id }}/session/store" method="post">
                    @csrf
                    <div>
                        <label for="day" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">روز</label>
                        <select name="day" id="day"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                            <option value="شنبه">شنبه</option>
                            <option value="یکشنبه">یکشنبه</option>
                            <option value="دوشنبه">دوشنبه</option>
                            <option value="سه شنبه">سه شنبه</option>
                            <option value="چهارشنبه">چهارشنبه</option>
                            <option value="پنجشنبه">پنجشنبه</option>
                            <option value="جمعه">جمعه</option>
                        </select>
                    </div>
                    <div>
                        <label for="hour" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ساعت
                            شروع</label>
                        <select name="hour" id="hour"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                            @for ($i = 0; $i <= 22; $i += 2)
                                <option value="{{ $i }}">{{ $i }}:00</option>
                            @endfor
                        </select>
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-hidden focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ذخیره</button>
                </form>
            </div>
        </div>
    </div>
@endsection
