<?php

declare(strict_types=1);

namespace App\Repositories\Weather;

interface WeatherRepositoryInterface
{
    public function getWeather(string $city): string;
}
