<?php

declare(strict_types=1);

namespace App\DTO\Weather;

final class WeatherDTO
{
    public function __construct(
        private readonly string $provider,
        private readonly string $location,
        private readonly ?string $sendTo
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new static(
            provider: (string) $data['provider'],
            location: (string) $data['location'],
            sendTo: $data['send_to'] != null ? (string) $data['send_to'] : null
        );
    }

    /**
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @return string|null
     */
    public function getSendTo(): ?string
    {
        return $this->sendTo;
    }
}
