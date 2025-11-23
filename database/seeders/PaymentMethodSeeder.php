<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentMethod::truncate();

        $cash = new PaymentMethod();
        $cash->name = 'cash';
        $cash->description = "Payment made to tea picker directly in cash";
        $cash->save();

        $bank = new PaymentMethod();
        $bank->name = 'bank';
        $bank->description = "Payment made to tea picker's bank account";
        $bank->save();

        $mobile = new PaymentMethod();
        $mobile->name = 'mobile';
        $mobile->description = "Payment made to tea picker's mobile money account";
        $mobile->save();
    }
}
