<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(InstitutionSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(ExamTitleSeeder::class);
        $this->call(CoachingSubjectListSeeder::class);
        $this->call(SectionSeeder::class);
    }
}
