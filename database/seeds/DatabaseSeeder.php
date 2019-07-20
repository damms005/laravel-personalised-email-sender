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
        $this->call(PlaceholderInTemplateSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(EmailTemplateSeeder::class);
        $this->call(JobPositionSeeder::class);
        $this->call(JobAdvertSeeder::class);
    }
}