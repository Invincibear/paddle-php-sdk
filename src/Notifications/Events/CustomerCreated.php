<?php

declare(strict_types=1);

namespace Paddle\SDK\Notifications\Events;

use Paddle\SDK\Entities\Customer;
use Paddle\SDK\Entities\Event;
use Paddle\SDK\Entities\Event\EventTypeName;

final class CustomerCreated extends Event
{
    public function __construct(
        string $eventId,
        EventTypeName $eventType,
        \DateTimeInterface $occurredAt,
        Customer $data,
    ) {
        parent::__construct($eventId, $eventType, $occurredAt, $data);
    }
}
