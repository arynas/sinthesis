<?php

use Illuminate\Database\Seeder;

class ProposalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('proposals')->delete();

        $proposals = array(
            array(
                'id' => 1,
                'student_id' => 1,
                'file_id' => 1,
                'title' => 'Perbandingan Penggunaan Metode A dan Metode B.',
                'theses_id' => 1, //for accept proposal
                'is_check' => '1' //for accept proposal
            )
//        ,
//            [
//                'id' => 2,
//                'student_id' => 2,
//                'theses_id' =>2,
//                'file_id' => 2,
//                'title' => 'Tinjauan Kritis Skripsi Saya terhadap Saya.',
//                'is_check' => 1
//            ]
        );

        foreach ($proposals as $proposal) {

            \App\Proposal::create($proposal);

        }
    }
}
