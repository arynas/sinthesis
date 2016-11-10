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
                'email' => 'ahmad.nugroho@mail.ugm.ac.id',
                'password' => bcrypt('ahmad.nugroho'),
                'role' => 'administrator'
            ),
            array(
                'id' => 2,
                'username' => 'lecturersatu',
                'email' => 'wenda.novayani@mail.ugm.ac.id',
                'password' => bcrypt('wenda.novayani'),
                'role' => 'lecturer'
            ),
            array(
                'id' => 3,
                'username' => 'studentsatu',
                'email' => 'aulia.zikri.r@mail.ugm.ac.id',
                'password' => bcrypt('aulia.zikri.r'),
                'role' => 'student'
            ),
            array(
                'id' => 4,
                'username' => 'lecturerdua',
                'email' => 'wenda@pcr.ac.id',
                'password' => bcrypt('wenda'),
                'role' => 'lecturer'
            ),
            array(
                'id' => 5,
                'username' => 'studentdua',
                'email' => 'azikrirahman@gmail.com',
                'password' => bcrypt('azikrirahman'),
                'role' => 'student'
            )
        );

        foreach ($users as $user) {
            App\User::create($user);
        }

    }
}
