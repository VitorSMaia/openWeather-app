<?php

namespace App\Http\Livewire\Api;

use App\Service\ApiWeather;
use Livewire\Component;
use StdClass;

class Weather extends Component
{
    public function api()
    {
        $apiWeather = new ApiWeather;
        $returnApiWeather =  $apiWeather->consultForCity();
        if ($returnApiWeather['status'] != 'error') {
            return $returnApiWeather['data'];
        } else if ($returnApiWeather['status'] != 'success') {
            return [];
        }
    }
    public function render()
    {
        $response = new StdClass();
        $response->weather = $this->api();
        $response->jv = '$this->api();';
//        dd($response->weather['cord']);


        return view('livewire.api.weather', ['response' => $response]);
    }
}
