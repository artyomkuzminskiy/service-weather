<?php

declare(strict_types=1);

namespace App\Console\Commands\Weather;

use App\DTO\Weather\WeatherDTO;
use App\Repositories\Weather\WeatherDecorator;
use App\UseCase\Weather\WeatherUseCase;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Http\Client\RequestException;

class WeatherCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather {provider} {location} {send_to?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function handle(WeatherUseCase $weatherUseCase): int
    {

        $response =$weatherUseCase->execute(WeatherDTO::fromArray([
            'provider' => $this->argument('provider'),
            'location' => $this->argument('location'),
            'send_to' => $this->argument('send_to'),
        ]));

        if ($this->argument('send_to') == null) {
            $this->info($response);
        }

        return self::SUCCESS;
    }
}
