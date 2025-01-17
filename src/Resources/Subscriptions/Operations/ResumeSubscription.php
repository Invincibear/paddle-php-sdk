<?php

declare(strict_types=1);

namespace Paddle\SDK\Resources\Subscriptions\Operations;

use Paddle\SDK\Entities\DateTime;
use Paddle\SDK\Entities\Subscription\SubscriptionEffectiveFrom;

class ResumeSubscription implements \JsonSerializable
{
    public function __construct(
        public readonly SubscriptionEffectiveFrom|\DateTimeInterface|null $effectiveFrom = null,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'effective_from' => $this->effectiveFrom instanceof \DateTimeInterface
                ? DateTime::from($this->effectiveFrom)?->format()
                : $this->effectiveFrom,
        ];
    }
}
