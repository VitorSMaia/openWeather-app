<?php

namespace App\Service;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ApiWeather
{
    public function consultForCity($city = null)
    {
        try {
            $weath = Http::get("https://api.openweathermap.org/data/2.5/weather?lat=35&lon=139&appid=b47cfe3932dfbe8c4238d44c8e2f4bb0");
            $arr = [];

            if ($weath->successful()) {
                $weath = $weath->json();

                foreach($weath['weather'] as $itemWeath) {
//                    dd($this->configIcon($itemWeath['icon']));
                    $arr['temp']['description'] = $this->configDescription($itemWeath['description']);
                    $arr['temp']['icon'] = $this->configIcon($itemWeath['icon']);
                }

                $arr['temp']['wind'] = $weath['wind'];
                $data = Carbon::now() ;
                $arr['data'] = $data->formatLocalized('%d,%h %Y') ;
                $arr['time'] = $weath['timezone'];
                $arr['cord'] = $weath['coord'];
            }
dd($arr);

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
            'moderate rain' => 'chuva moderada'
        ];

        return $descriptions[$description];
    }

    public function configIcon($icon)
    {
//        dd($icon);
        $icons = [
            '10n' => 'rainy'
        ];

        return $icons[$icon];
    }
}
