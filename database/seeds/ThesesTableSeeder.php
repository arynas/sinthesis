<?php

use Illuminate\Database\Seeder;

class ThesesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('theses')->delete();

        $theses = array(
            array(
                'id' => 1,
                'student_id' => 1,
                'lecturer_id' => 1,
                'title' => 'Perbandingan Metode A dengan Metode B',
                'semester' => 'Genap',
                'starts_at' => '2016-11-24',
                'ends_at' => '2017-05-24'
            )
//        ,
//            array(
//                'id' => 2,
//                'student_id' => 2,
//                'lecturer_id' => 15,
//                'title' => 'Tinjauan Kritis Skripsi Saya terhadap Saya.',
//                'semester' => 'Genap',
//                'starts_at' => date('2016-02-25'),
//                'ends_at' => date('2016-08-25')
//            )
        );

        foreach ($theses as $thesis) {

            \App\Thesis::create($thesis);

        }
    }
}
