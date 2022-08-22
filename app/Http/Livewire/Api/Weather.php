<?php

namespace App\Http\Livewire\Api;

use App\Service\ApiWeather;
use Livewire\Component;
use StdClass;

class Weather extends Component
{
    public $city = 'Fortaleza';

    public function updatedCity()
    {
        $this->api($this->city);
    }

    public function api($city = null)
    {
        $apiWeather = new ApiWeather;
        $returnApiWeather =  $apiWeather->consultForCity($city);
        if ($returnApiWeather['status'] != 'error') {
            return $returnApiWeather['data'];
        } else if ($returnApiWeather['status'] != 'success') {
            return [];
        }
    }
    public function render()
    {
        $response = new StdClass();
        $response->weather = $this->api($this->city);

        return view('livewire.api.weather', ['response' => $response]);
    }
}
