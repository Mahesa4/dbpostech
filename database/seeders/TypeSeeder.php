<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $types = [
        ["PC"],
        ["Accessories PC"],
        ["Smart Phone"],
        ["Accessories Phone"],
        ["Tools"],
    ];

    public function run(): void
    {
        foreach ($this->types as $type) {
            \App\Models\ProductType::create([
                "product_type_name" => $type[0],
            ]);
        }
    }
}
