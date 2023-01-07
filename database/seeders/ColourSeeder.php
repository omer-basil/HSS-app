<?php

namespace Database\Seeders;

use App\Models\Staff\Item;
use App\Models\Staff\Colour;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ColourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Colour::factory(10)->create();

        foreach(Colour::all() as $colour) {
            $items = Item::inRandomOrder()->take(rand(1,20))->pluck('id');
            $colour->items()->attach($items);
        }
    }
}
