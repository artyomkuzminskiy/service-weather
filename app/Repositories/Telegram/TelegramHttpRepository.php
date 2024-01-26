<?php

declare(strict_types=1);

namespace App\Repositories\Telegram;

use GuzzleHttp\Client;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class TelegramHttpRepository implements TelegramRepositoryInterface
{

    public function sendMessage(string $message, string $chatId): void
    {
        $this->baseRequest()
            ->post('sendMessage', [
                'chat_id' => $chatId,
                'text' => $message,
            ]);
    }

    private function baseRequest(): PendingRequest
    {
        return Http::baseUrl(config('services.telegram.domain') . config('services.telegram.token') . '/')
            ->contentType('application/json')
            ->acceptJson();
    }
}
