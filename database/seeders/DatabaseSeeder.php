<?php

namespace Database\Seeders;

use App\Models\Collection;
use App\Models\Farm;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $this->call([
            RoleSeeder::class,
            PaymentMethodSeeder::class,
            UserSeeder::class,
            FarmSeeder::class,
            CollectionSeeder::class,
            PaymentSeeder::class
        ]);

        User::factory(6)->owner()->create();
        User::factory(4)->owner()->inactive()->create();
        User::factory(40)->picker()->create();
        User::factory(10)->picker()->inactive()->create();

        Farm::factory(6)->create();

        Collection::factory(100)->create();

        Payment::factory(40)->cash()->create();
        Payment::factory(15)->bank()->create();
        Payment::factory(15)->mobile()->create();

        Schema::enableForeignKeyConstraints();
    }
}
