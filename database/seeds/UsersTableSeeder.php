<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $users = array(
            array(
                'id' => 1,
                'username' => 'koordinatorthesis',
                'email' => 'koordinator@mail.ugm.ac.id',
                'password' => bcrypt('koordinator'),
                'role' => 'administrator'
            ),
            array(
                'id' => 2,
                'username' => 'lecturersatu',
                'email' => 'ridif@live.com',
                'password' => bcrypt('ridif'),
                'role' => 'lecturer'
            ),
            array(
                'id' => 3,
                'username' => 'studentsatu',
                'email' => 'ridi@ugma.ac.id',
                'password' => bcrypt('ridi'),
                'role' => 'student'
            ),
            array(
                'id' => 4,
                'username' => 'lecturersatu',
                'email' => 'lecturersatu@mail.ugm.ac.id',
                'password' => bcrypt('lecturersatu'),
                'role' => 'lecturer'
            ),
            array(
                'id' => 5,
                'username' => 'studentsatu',
                'email' => 'studentsatu@mail.ugm.ac.id',
                'password' => bcrypt('studentsatu'),
                'role' => 'student'
            )
        );

        foreach ($users as $user) {
            App\User::create($user);
        }
//
//        //UserStudents Faker
//
//        $user_students = factory(\App\User::class, 'UserStudents', 30)->create();

    }
}
