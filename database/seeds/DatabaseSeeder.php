<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(LecturersTableSeeder::class);
         $this->call(StudentsTableSeeder::class);
         $this->call(FilesTableSeeder::class);
         $this->call(ThesesTableSeeder::class);
         $this->call(ProposalsTableSeeder::class);
    }
}
