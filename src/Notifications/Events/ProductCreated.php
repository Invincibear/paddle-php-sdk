<?php

declare(strict_types=1);

namespace Paddle\SDK\Notifications\Events;

use Paddle\SDK\Entities\Event;
use Paddle\SDK\Entities\Event\EventTypeName;
use Paddle\SDK\Entities\ProductWithIncludes;

final class ProductCreated extends Event
{
    public function __construct(
        string $eventId,
        EventTypeName $eventType,
        \DateTimeInterface $occurredAt,
        ProductWithIncludes $data,
    ) {
        parent::__construct($eventId, $eventType, $occurredAt, $data);
    }
}
