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
        $this->api();
        return view('livewire.api.weather');
    }
}
