<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use CArbon\Carbon;

use App\Models\Conversion;

class getCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-currencies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {    
        $fecha = Carbon::now();
        $fecha = $fecha->format('d-m-Y');
        $mxn = 'MXN';
        $usd = 'USD';
        $xau = 'XAU';
        $xag = 'XAG';

        // Mensaje si sobrepasan las peticiones mensuales gratuitas.
        $msg = "You have exceeded your daily/monthly API rate limit. Please review and upgrade your subscription plan at https://promptapi.com/subscriptions to continue.";

        $currencies = Conversion::find(1);

        if(!$currencies){

            $dolar = getExchangeRates($mxn, $usd);
            $au = getExchangeRates($usd, $xau);
            $ag = getExchangeRates($usd, $xag);

            Conversion::create([
                'usd' => 0,
                'au' => 0,
                'ag' => 0
            ]);
            $currencies = Conversion::find(1);

        }else{
            $fecha_db = $currencies['updated_at'];
            $fecha_db = $fecha_db->format('d-m-Y');
            print("Fecha de hoy {$fecha}  Fecha en la DB {$fecha_db}\n");

            if($fecha != $fecha_db){
                //Obtener el costo del dolar hoy

                $dolar = getExchangeRates($mxn, $usd);
                $au = getExchangeRates($usd, $xau);
                $ag = getExchangeRates($usd, $xag);
                print($dolar);
                /*
                $dolar = $dolar['result'];
                $au = $au['result'];
                $ag = $ag['result'];
                */

                if($dolar == null || (isset($dolar['message']) == $msg)){
                    print('Nulo o '.$msg);
                }else{
                    $dolar = $dolar['result'];
                    $au = $au['result'];
                    $ag = $ag['result'];

                    Conversion::query()->where(['id' => 1])->update(['dolar' => $dolar, 'au' => $au, 'ag' => $ag]);
                }          

            }else{
                print('Sin actualización de datos');
            }
        }        
    }
}
