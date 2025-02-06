@extends('layout.student')
@section('content')
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
            data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="false">اطلاعات</button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard"
                    aria-selected="false">جلسات</button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="req-tab" data-tabs-target="#req" type="button" role="tab" aria-controls="req"
                    aria-selected="false">نیازمندی ها</button>
            </li>
        </ul>
    </div>
    <div id="default-tab-content">
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-900" id="profile" role="tabpanel"
            aria-labelledby="profile-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">
            <div class="text-2xl mb-3">{{ $course->name }}</div>
            <div class="mb-1">کد درس: {{ $course->code }}</div>
            <div class="mb-1">دانشکده: {{ $course->department }}</div>
            <div class="mb-1">واحد: {{ $course->units }}</div>
            <div class="mb-1">روز امتحان: <span dir="ltr">{{ $course->exam_date }}</span></div>
            <div class="mb-1">زمان امتحان: <span
                    dir="ltr">{{ $course->exam_start_time . ':00-' . $course->exam_end_time . ':00' }}</span></div>
            <div class="mb-1">نام استاد: {{ $course->instructor }}</div>
            <div class="mb-1">ظرفیت کل: {{ $course->capacity }}</div>
            <div class="mb-3">ظرفیت مانده: {{ $course->capacity - count($course->ongoingEnrollments) }}</div>
            <form action="/student/course/{{ $course->id }}/enrollment/toggle" method="post">
                @csrf
                @if ($enrolled)
                    <button type="submit"
                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">حذف
                        درس</button>
                @else
                    @if ($canEnroll[0])
                        <button type="submit"
                            class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">اخذ
                            درس</button>
                    @else
                        <div class="flex items-center p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>{{ $canEnroll[1] }}</div>
                        </div>
                    @endif
                @endif
            </form>
            </p>
        </div>
        <div class="hidden p-4 pt-0" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                روز
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                ساعت شروع
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($course->sessions as $s)
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $s->day }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $s->hour . ':00' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="hidden p-4 pt-0" id="req" role="tabpanel" aria-labelledby="req-tab">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                درس
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                نوع
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($course->requirements as $r)
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $r->required->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $r->type === 'pre' ? 'پیشنیاز' : 'همنیاز' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
