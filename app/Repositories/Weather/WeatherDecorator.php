<?php

declare(strict_types=1);

namespace App\Repositories\Weather;

use App\Repositories\Weather\AccuWeather\AccuWeatherHttpRepository;
use App\Repositories\Weather\OpenWeather\OpenWeatherHttpRepository;
use Exception;
use Illuminate\Http\Client\RequestException;

class WeatherDecorator implements WeatherRepositoryInterface
{
    private WeatherRepositoryInterface $weatherRepository;

    /**
     * @param string $weatherProvider
     * @throws Exception
     */
    public function __construct(
        private readonly string $weatherProvider
    ) {
        match ($this->weatherProvider) {
            'open-weather-map' => $this->weatherRepository = (new OpenWeatherHttpRepository()),
            'accu-weather' => $this->weatherRepository = (new AccuWeatherHttpRepository()),
            default => throw new Exception('Set wrong provider'),
            };
    }

    /**
     * @param string $city
     * @return string
     * @throws RequestException
     */
    public function getWeather(string $city): string
    {
        return $this->weatherRepository->getWeather($city);
    }
}
