<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            MtTimeOffTypes::class,
            MtLocations::class,
            MtHolidays::class,
            MtShifts::class,
            MtBankAccounts::class,
            MtReligions::class,
            MtDepartments::class,
            MtPositions::class,
            MtStatus::class,
            TxTimeOffs::class,
            MtSchedules::class,
            MtEmployee::class
        ]);
    }
}
