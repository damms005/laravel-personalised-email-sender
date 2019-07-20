<?php

use App\JobAdvert;
use Illuminate\Database\Seeder;

class JobAdvertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(JobAdvert::class, 10)->create();
    }
}