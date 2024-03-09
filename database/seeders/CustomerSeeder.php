<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Invoice;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Customer::factory(25)
            ->has(Invoice::factory()->count(10))
            ->create();

        Customer::factory(100)
            ->has(Invoice::factory()->count(5))
            ->create();

            Customer::factory(100)
            ->has(Invoice::factory()->count(3))
            ->create();


            Customer::factory(5)
            ->create();







    }
}
