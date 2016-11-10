<?php

use Illuminate\Database\Seeder;

class LecturersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lecturers')->delete();

        $lecturers = array(
            array(
                'id' => 1,
                'user_id' => 2,
                'name' => 'Lecturer Satu',
                'nik' => '103',
                'nidn' => '10367',
                'bornplace' => 'Tulungagung',
                'borndate' => '07-03-1992',
                'stay' => 'Jl. Kaliurang KM 20 No 7 Ngaglik, Sleman',
                'address' => 'Jl. Kaliurang KM. 7 Sleman, DIY',
                'phoneI' => '085746532910',
                'phoneII' => '085746532910',
                'sex' => '1',
                'blood' => 'AB',
                'motto' => 'Hemat pangkal Kaya'
            ),
            array(
                'id' => 2,
                'user_id' => 4,
                'name' => 'Lecturer Dua',
                'nik' => '104',
                'nidn' => '10368',
                'bornplace' => 'Klaten',
                'borndate' => '07-03-1992',
                'stay' => 'Jl. Kaliurang KM 20 No 7 Ngaglik, Sleman',
                'address' => 'Jl. Magelang KM. 19 Sleman DIY',
                'phoneI' => '085746532910',
                'phoneII' => '085746532910',
                'sex' => '1',
                'blood' => 'AB',
                'motto' => 'Rajin pangkal Pandai'
            )
        );

        foreach ($lecturers as $lecturer) {

            App\Lecturer::create($lecturer);

        }

    }
}
