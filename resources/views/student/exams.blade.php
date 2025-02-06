@extends('layout.student')
@section('content')
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">درس</th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">روز</th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">زمان</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $course->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $course->exam_date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ sprintf('%02d:00 - %02d:00', $course->exam_start_time, $course->exam_end_time) }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
