<?php

declare(strict_types=1);

namespace App\Repositories\Weather\AccuWeather;

use App\Repositories\Weather\WeatherRepositoryInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class AccuWeatherHttpRepository implements WeatherRepositoryInterface
{
    /**
     * @param string $city
     * @return string
     * @throws RequestException
     */
    public function getWeather(string $city): string
    {
        $cityKey = $this->getLocationKey($city);

        $response =  $this->baseRequest()
            ->get('/forecasts/v1/daily/1day/' . $cityKey .'?apikey=' .  config('services.acc_weather.api_key'))
            ->throw()
            ->json();

        return (string) $response['Headline']['Category'];
    }

    /**
     * @param string $city
     * @return int
     * @throws RequestException
     */
    private function getLocationKey(string $city): int
    {
        $response =  $this->baseRequest()
            ->get('/locations/v1/cities/search?q=' . $city . '&apikey=' .  config('services.acc_weather.api_key'))
            ->throw()
            ->json();

        return (int) $response[0]['Key'];
    }

    private function baseRequest(): PendingRequest
    {
        return Http::baseUrl(config('services.acc_weather.domain'));
    }
}
