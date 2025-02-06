<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseSession;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Course::create([
            'name' => 'طراحی کامپایلر',
            'code' => 'ENG0001',
            'units' => 5,
            'department' => 'مهندسی',
            'instructor' => 'محمد',
            'exam_date' => '1403-01-01',
            'exam_start_time' => '12',
            'exam_end_time' => '14',
            'capacity' => 1
        ]);

        Course::create([
            'name' => 'سیگنال ها و سیستم ها',
            'code' => 'ENG0002',
            'units' => 5,
            'department' => 'مهندسی',
            'instructor' => 'عادل',
            'exam_date' => '1403-01-02',
            'exam_start_time' => '12',
            'exam_end_time' => '14',
            'capacity' => 1
        ]);

        Course::create([
            'name' => 'داده کاوی',
            'code' => 'ENG0003',
            'units' => 4,
            'department' => 'کامپیوتر',
            'instructor' => 'پارسا',
            'exam_date' => '1403-01-01',
            'exam_start_time' => '13',
            'exam_end_time' => '15',
            'capacity' => 1
        ]);

        CourseSession::create([
            'course_id' => 1,
            'day' => 'شنبه',
            'hour' => 8,
        ]);

        CourseSession::create([
            'course_id' => 1,
            'day' => 'دوشنبه',
            'hour' => 8,
        ]);

        CourseSession::create([
            'course_id' => 2,
            'day' => 'یکشنبه',
            'hour' => 10,
        ]);

        CourseSession::create([
            'course_id' => 2,
            'day' => 'سه شنبه',
            'hour' => 10,
        ]);

        CourseSession::create([
            'course_id' => 3,
            'day' => 'شنبه',
            'hour' => 12,
        ]);

        CourseSession::create([
            'course_id' => 3,
            'day' => 'دوشنبه',
            'hour' => 12,
        ]);
    }
}
