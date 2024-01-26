<?php

declare(strict_types=1);

namespace App\Repositories\Weather\OpenWeather;

use App\Repositories\Weather\WeatherRepositoryInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class OpenWeatherHttpRepository implements WeatherRepositoryInterface
{

    /**
     * @param string $city
     * @return string
     * @throws RequestException
     */
    public function getWeather(string $city): string
    {
        $response =  $this->baseRequest()
            ->get('/data/2.5/weather?q=' . $city . '&appid=' .  config('services.open_weather.api_key'))
            ->throw()
            ->json();

        return (string) $response['weather'][0]['main'];
    }

    private function baseRequest(): PendingRequest
    {
        return Http::baseUrl(config('services.open_weather.domain'));
    }
}
