@extends('layout.admin')
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
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings"
                    aria-selected="false">دانشجویان</button>
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
            <div class="flex">
                <a href="/admin/course/{{ $course->id }}/edit"
                    class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">ویرایش</a>
                <a href="/admin/course/{{ $course->id }}/delete"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">حذف</a>
            </div>
            </p>
        </div>
        <div class="hidden p-4 pt-0" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
            <a href="/admin/course/{{ $course->id }}/session/create"
                class="block w-max text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-3 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">افزودن
                جلسه</a>
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
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                عملیات
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
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="/admin/session/{{ $s->id }}/delete"
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline">حذف</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="hidden p-4 pt-0" id="req" role="tabpanel" aria-labelledby="req-tab">
            <a href="/admin/course/{{ $course->id }}/requirement/create"
                class="block w-max text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-3 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">افزودن
                نیازمندی</a>
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
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                عملیات
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
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="/admin/requirements/{{ $r->id }}/delete"
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline">حذف</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="hidden p-4 pt-0" id="settings" role="tabpanel" aria-labelledby="settings-tab">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                نام
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                نام خانوادگی
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                شماره دانشجویی
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($course->ongoingEnrollments as $er)
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $er->user->first_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $er->user->last_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $er->user->id }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
