<?php

declare(strict_types=1);

namespace App\Repositories\Telegram;

interface TelegramRepositoryInterface
{
    public function sendMessage(string $message, string $chatId): void;
}
