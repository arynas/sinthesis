<?php

use Illuminate\Database\Seeder;

class FilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('files')->delete();

        $files = array(
            array(
                'id' => 1,
                'user_id' => 3,
                'name' => 'proposal_1.pdf',
                'path' => '/var/www/sinthesis/storage/app/proposals/1'
            )
        ,
            array(
                'id' => 2,
                'user_id' => 4,
                'name' => 'proposal_2.pdf',
                'path' => '/var/www/sinthesis/storage/app/proposals/2'
            )
        );

        foreach ($files as $file) {

            \App\File::create($file);

        }
    }
}
