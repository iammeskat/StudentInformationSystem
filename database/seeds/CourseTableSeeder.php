<?php

use Illuminate\Database\Seeder;
use App\Models\Courses;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *'course_code',
        'name',
        'semester',
        'credit',
        'type',
     * @return void
     */
    public function run()
    {
        $courses = [
            [	'course_code' => 'CSE 103', 'name' => 'Discrete Mathematics',
            	'semester' => '2nd', 'credit' => '3.0', 'type' => 'theory'],

            [	'course_code' => 'CSE 111', 'name' => 'Structured Programming',
            	'semester' => '2nd', 'credit' => '3.0', 'type' => 'theory'],

            [	'course_code' => 'CSE 112', 'name' => 'Structured Programming Lab.',
            	'semester' => '2nd', 'credit' => '3.0', 'type' => 'lab'],

            [	'course_code' => 'EEE 211', 'name' => 'Electronics I',
            	'semester' => '2nd', 'credit' => '3.0', 'type' => 'theory'],

            [	'course_code' => 'EEE 212 ', 'name' => 'Electronics I Lab',
            	'semester' => '2nd', 'credit' => '3.0', 'type' => 'lab'],

            [	'course_code' => 'ENG 103', 'name' => 'Developing English Skills',
            	'semester' => '2nd', 'credit' => '3.0', 'type' => 'theory'],

            [	'course_code' => 'MAT 107', 'name' => 'Engineering Mathematics II',
            	'semester' => '2nd', 'credit' => '3.0', 'type' => 'theory'],

            [	'course_code' => 'PHY 103', 'name' => 'Engineering Physics II',
            	'semester' => '2nd', 'credit' => '3.0', 'type' => 'theory'],

            [	'course_code' => 'CSE 211', 'name' => 'Object Oriented Programming',
            	'semester' => '3rd', 'credit' => '3.0', 'type' => 'theory'],

            [	'course_code' => 'CSE 212', 'name' => 'Object Oriented Programming Lab',
            	'semester' => '3rd', 'credit' => '3.0', 'type' => 'lab'],
            
        ];

        foreach ($courses as $course) {
            Courses::create(array(
                'course_code' => $course['course_code'],
                'name' => $course['name'],
                'semester' => $course['semester'],
                'credit' => $course['credit'],
                'type' => $course['type'],
                'created_at' => now(),
                'updated_at' => now(),
            ));
        }
    }
}
