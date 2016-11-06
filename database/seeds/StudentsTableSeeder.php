<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->delete();

        $students = array(
            array(
                'id' => 1,
                'user_id' => 3,
                'lecturer_id' => 1,
                'name' => 'Student Satu',
                'nim' => '103456321',
                'bornplace' => 'Klaten',
                'borndate' => '09-07-1992',
                'stay' => 'Jl. Kaliurang KM 20 No 7 Ngaglik, Sleman',
                'address' => 'Jl. Jend. Sudirman KM 20 No 7 Depok',
                'phoneI' => '085746532910',
                'phoneII' => '085746532910',
                'sex' => '1',
                'blood' => 'AB'
            )
        );

        foreach ($students as $student) {

            App\Student::create($student);

        }

    }
}
