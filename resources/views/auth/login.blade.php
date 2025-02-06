@extends('layout.auth')
@section('content')
    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
        ورود
    </h1>
    <form class="space-y-4" action="/login" method="post">
        @csrf
        <div>
            <label for="id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">شماره دانشجویی/نام
                کاربری</label>
            <input type="number" name="id" id="id"
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>
        <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">رمز</label>
            <input type="password" name="password" id="password"
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>
        <button type="submit"
            class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-hidden focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ورود</button>
        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
            حساب کاربری ندارید؟ <a href="/register" class="font-medium text-blue-600 hover:underline dark:text-blue-500">ثبت
                نام</a>
        </p>
        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
            رمز خود را فراموش کردید؟ <a href="/reset-password"
                class="font-medium text-blue-600 hover:underline dark:text-blue-500">بازنشانی رمز</a>
        </p>
    </form>
@endsection
