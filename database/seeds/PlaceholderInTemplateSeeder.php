<?php

use App\PlaceholderInTemplate;
use Illuminate\Database\Seeder;

class PlaceholderInTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PlaceholderInTemplate::class, 10)->create();
    }
}