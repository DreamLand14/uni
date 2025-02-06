@extends('layout.auth')
@section('content')
    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
        ثبت نام
    </h1>
    <form class="space-y-4" action="/register" method="post">
        @csrf
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">نام</label>
            <input type="text" name="first_name" id="first_name"
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>
        <div>
            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">نام خانوادگی</label>
            <input type="text" name="last_name" id="last_name"
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>
        <div>
            <label for="national_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">کد ملی</label>
            <input type="text" name="national_code" id="national_code"
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ایمیل</label>
            <input type="email" name="email" id="email"
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>
        <div>
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">شماره تلفن</label>
            <input type="text" name="phone" id="phone"
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>
        <div>
            <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">نقش کاربری</label>
            <select name="role" id="role"
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
                <option value="student">دانشجو</option>
                <option value="admin">مدیر</option>
            </select>
        </div>
        <div>
            <label id="idLabel" for="id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">شماره
                دانشجویی</label>
            <input type="number" name="id" id="id"
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>
        <div id="max_unitsContainer">
            <label for="max_units" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">حداکثر واحد
                مجاز</label>
            <input type="number" name="max_units" id="max_units"
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required value="0">
        </div>
        <div id="passed_unitsContainer">
            <label for="passed_units" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">درس های پاس شده
                (کد درس ها را با , جدا کنید)</label>
            <input type="text" name="passed_units" id="passed_units"
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">رمز</label>
            <input dir="ltr" type="password" name="password" id="password"
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>
        <button type="submit"
            class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-hidden focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ثبت
            نام</button>
        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
            حساب کاربری دارید؟ <a href="/login"
                class="font-medium text-blue-600 hover:underline dark:text-blue-500">ورود</a>
        </p>
    </form>
    <script>
        document.getElementById('role').addEventListener('change', function(e) {
            if (e.target.value === 'student') {
                document.getElementById('idLabel').innerHTML = 'شماره دانشجویی';
                document.getElementById('max_unitsContainer').hidden = false;
                document.getElementById('passed_unitsContainer').hidden = false;
            } else {
                document.getElementById('idLabel').innerHTML = 'نام کاربری (فقط عدد)';
                document.getElementById('max_unitsContainer').hidden = true;
                document.getElementById('passed_unitsContainer').hidden = true;
            }
        });
    </script>
@endsection
