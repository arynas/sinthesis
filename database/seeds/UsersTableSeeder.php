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
                'email' => 'koordinator@sinthesis.ac.id',
                'password' => bcrypt('koordinator'),
                'role' => 'administrator'
            ),
            array(
                'id' => 2,
                'username' => 'lecturersatu',
                'email' => 'lecturersatu@sinthesis.ac.id',
                'password' => bcrypt('lecturersatu'),
                'role' => 'lecturer'
            ),
            array(
                'id' => 3,
                'username' => 'studentsatu',
                'email' => 'studentsatu@sinthesis.ac.id',
                'password' => bcrypt('studentsatu'),
                'role' => 'student'
            )
        );

        foreach ($users as $user) {
            App\User::create($user);
        }

    }
}
