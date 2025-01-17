<?php

declare(strict_types=1);

namespace Paddle\SDK\Resources\Shared\Operations\List;

use Paddle\SDK\Entities\DateTime;

class DateComparison
{
    public function __construct(
        public readonly \DateTimeInterface $date,
        public readonly ?Comparator $comparator = null,
    ) {
    }

    public function comparator(): string
    {
        return isset($this->comparator) ? sprintf('[%s]', $this->comparator->value) : '';
    }

    public function formatted(): string
    {
        return DateTime::from($this->date)?->format() ?? '';
    }
}
