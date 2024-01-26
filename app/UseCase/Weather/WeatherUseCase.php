<?php

declare(strict_types=1);

namespace App\UseCase\Weather;

use App\DTO\Weather\WeatherDTO;
use App\Mail\GmailNotification;
use App\Repositories\Telegram\TelegramRepositoryInterface;
use App\Repositories\Weather\WeatherDecorator;
use Exception;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Mail;

class WeatherUseCase
{
    public function __construct(
        private readonly TelegramRepositoryInterface $telegramRepository,
    ) {
    }

    /**
     * @param WeatherDTO $weatherDTO
     * @return string|null
     * @throws RequestException
     * @throws Exception
     */
    public function execute(WeatherDTO $weatherDTO): ?string
    {
        $weatherDecorator = new WeatherDecorator($weatherDTO->getProvider());
        $response = $weatherDecorator->getWeather($weatherDTO->getLocation());

        if ($weatherDTO->getSendTo() !== null) {
            $sendTo = explode(':', $weatherDTO->getSendTo());

            match ($sendTo[0]) {
                'telegram' => $this->telegramRepository->sendMessage($response, $sendTo[1]),
                'mail' => '',
                default => throw new Exception('Wrong type to send'),
            };
        }

        return  $response;
    }
}
