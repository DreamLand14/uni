@extends('layout.student')
@section('content')
    <form class="flex flex-wrap items-center justify-center gap-1 mb-3">
        <label for="simple-search" class="sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="text" id="search" name="search" value="{{ $oldSearch }}"
                class="bg-gray-50 border min-w-[17rem] border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="جستجو درس بر اساس کد یا نام..." />
        </div>
        <select name="department" id="department"
            class="bg-gray-50 border min-w-[9rem] border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="all">همه دانشکده ها</option>
            @foreach ($departments as $department)
                <option @if ($department === $oldDepartment) selected @endif value="{{ $department }}">{{ $department }}
                </option>
            @endforeach
        </select>
        <button type="submit"
            class="p-[11px] text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
            <span class="sr-only">Search</span>
        </button>
    </form>

    <div class="mb-3 text-center">واحدهای اخذ شده: {{ $enrolledUnits }}</div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                        کد درس
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                        نام درس
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                        واحد
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                        زمان کلاس
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                        زمان امتحان
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                        نام استاد
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                        ظرفیت
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                        عملیات
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $course->code }}
                        </th>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $course->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $course->units }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @foreach ($course->sessions as $idx => $s)
                                {{ $s->day . ' ' . $s->hour . ':00' }}@if ($idx != count($course->sessions) - 1)
                                    -
                                @endif
                            @endforeach
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap" dir="ltr">
                            {{ $course->exam_date . ' ' . $course->exam_start_time . ':00-' . $course->exam_end_time . ':00' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $course->instructor }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap" dir="ltr">
                            {{ count($course->ongoingEnrollments) }}/{{ $course->capacity }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="/student/course/{{ $course->id }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">مشاهده</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
