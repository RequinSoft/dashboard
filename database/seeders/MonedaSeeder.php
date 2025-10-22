<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

use App\Models\Conversion;

class MonedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 

        $fecha = Carbon::now();
        $fecha = $fecha->format('d-m-Y');
        $mxn = 'MXN';
        $usd = 'USD';
        $xau = 'XAU';
        $xag = 'XAG';

        $dolar = getExchangeRates($mxn, $usd);
        $au = getExchangeRates($usd, $xau);
        $ag = getExchangeRates($usd, $xag);

        Conversion::create([
            'usd' => $dolar ? $dolar['result'] : 0,
            'au' => $au ? $au['result'] : 0,
            'ag' => $ag ? $ag['result'] : 0
        ]);
    }
}
