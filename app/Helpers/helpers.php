<?php

if(!function_exists('getExchangeRates')) {
    /**
     * Fetch exchange rates from an external API.
     *
     * @param array $currencies List of currency codes to fetch rates for.
     * @param string $source The source currency code.
     * @return array The exchange rates data.
     */
    function getExchangeRates($currencies, $source) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.apilayer.com/currency_data/convert?to=".$currencies."&from=".$source."&amount=1",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: text/plain",
            "apikey: E0GpUZknWn12mNBs7iwlUvPoZ2qJS8NO"
        ),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET"
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $exchangeRates = json_decode($response, true);
        return $exchangeRates;
    }
}

if(!function_exists('getDemanda')) {
    /**
     * Fetch KW data from an external device.
     *
     * @return string The KW data.
     */
    function getDemanda($ip, $port) {
        $pf = 0;
        $demanda = 0;

        // Realizar la solicitud al dispositivo externo
        $ch = curl_init($ip);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $datos = curl_exec($ch);
        $conexion = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Recibimos la respuesta en XML
        if($conexion == '200'){
            $url = 'http://'.$ip.'/realtime.xml';
            $xmlString = file_get_contents($url);
            $xml = new SimpleXMLElement($xmlString);
            $xml_arreglo = $xml->Page->Item;
            print_r($xml_arreglo);            
    
            foreach($xml_arreglo as $arreglo){
                $imp = 'h --> '.$arreglo['h'].', l --> '.$arreglo['l'].', v --> '.$arreglo['v'].'<br>';    

                //Obtener el factor de Potencia
                if($arreglo['h'] == '22555'){
                    $pf = (double)$arreglo['v'];
                    print("El factor de Potencia viene del XML $pf\n");
                }else{
                    print("El factor de Potencia NO viene del XML $pf\n");
                }

                //Obtener los KW Totales
                if($arreglo['h'] == '22543'){    
                    $demanda = (int)$arreglo['v']; 
                    print("Los Kw's vienen del XML $demanda\n");
                }else{
                    print("Los Kw's NO vienen del XML $demanda\n");
                }
                          
            }
            $data = [
                'ip' => $ip,
                'pf' => $pf,
                'demanda' => $demanda,
            ];
            return $data;
            
        }else{
            $data = [
                'ip' => $ip,
                'demanda' => 'No hay conexión',
                'pf' => 'No hay conexión',
            ];

            return $data;            
        }
    }
}

if(!function_exists('getWebId')){
    function getWebId($tag, $ip_pi, $ip_af, $user, $password){
            
        $pi_user = 'duxcontrol';
        $pi_password = 'Jp02k23dux';
        //$ip = '10.74.101.43';
        //$ip_pi = '10.74.16.35';
        
        $servidor_pi = 'https://'.$ip_af.'/piwebapi/points?path=\\\\'.$ip_pi.'\\'.$tag;        

        $url = $servidor_pi;  

        $ch = curl_init($ip_af);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $datos = curl_exec($ch);
        $conexion = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);   
        //return $conexion;     

        if($conexion == '200'){
            //Funcion global para la consulta al pi de todos los metodos
            $ch = curl_init();
        
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);  
            curl_setopt($ch, CURLOPT_USERNAME, $pi_user);
            curl_setopt($ch, CURLOPT_PASSWORD, $pi_password);

            $response = curl_exec($ch);
            curl_close($ch);
            $json = json_decode($response, true);
        }
        //return $json;


        if(isset($json['Errors'])){            
            print('The specified path was not found. If more details are needed, please contact your PI Web API administrator for help in enabling debug mode.');

            return $error;
        }else{
            print("Se creó el tag $tag\n");

            $tag = Tags::query('tag', $tag)
                ->update([
                    'webid' => $json['WebId'],
                ]);
            
            print("WebId obtenido exitosamente \n");
        }
    }
}