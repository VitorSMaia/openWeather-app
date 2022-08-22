<?php

namespace App\Service;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ApiWeather
{
    public function consultForCity($city = null)
    {
        try {
            $weath = Http::get("https://api.openweathermap.org/data/2.5/weather?q=$city&units=metric&lang=pt_br&appid=b47cfe3932dfbe8c4238d44c8e2f4bb0");
            $arr = [];

            if ($weath->successful()) {
                $weathJson = $weath->json();
//                dd($weathJson);
//dd($weathJson);
                foreach($weathJson['weather'] as $itemWeath) {
                    $arr['temp']['description'] = $itemWeath['description'];
                    $arr['temp']['icon'] = $this->configIcon($itemWeath['icon']);
                }

                $arr['temp']['wind'] = $weath['wind'];
                $arr['temp']['main'] = $weath['main'];
                $arr['temp']['city'] = $weath['name'];
                $data = Carbon::now() ;
                $arr['data'] = $data->formatLocalized('%d,%h %Y') ;
                $arr['time'] = $weath['timezone'];
                foreach($weath['coord'] as $key => $coord) {
                    if ($key == 'lon') {
                        $arr['cord']['Longitude'] = $coord;
                    } else if ($key == 'lat') {
                        $arr['cord']['Latitude'] = $coord;
                    }
                }
            }

            return [
                'status' => 'success',
                'code' => $weath->status(),
                'data' => $arr,
            ];
        }catch(\Exception $exception) {
            dd($exception);
            return [
                'status' =>  'error',
                'code' => $exception->getCode()
            ];
        }
    }

    public function configDescription($description)
    {
        $descriptions = [
            'light rain' => 'chuva leve',
            'heavy intensity rain' => 'chuva de forte intensidade',
            'moderate rain' => 'chuva moderada',
            'overcast clouds' => 'nuvens nubladas',
            'nublado' => 'nublado',
            'nuvens dispersas' => 'nuvens dispersas',
        ];

        return $descriptions[$description];
    }

    public function configIcon($icon)
    {
        $icons = [
            '10n' => 'rainy',
            '04d' => 'rainy',
            '10d' => 'rainy',
            '03n' => 'rainy',
            '03d' => 'rainy',
            '01d' => 'rainy',
            '01n' => 'rainy',
            '04n' => 'rainy',
        ];

        return $icons[$icon];
    }
}
