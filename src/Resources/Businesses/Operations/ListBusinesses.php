<?php

declare(strict_types=1);

namespace Paddle\SDK\Resources\Businesses\Operations;

use Paddle\SDK\Entities\Shared\Status;
use Paddle\SDK\Exceptions\SdkExceptions\InvalidArgumentException;
use Paddle\SDK\HasParameters;
use Paddle\SDK\Resources\Shared\Operations\List\Pager;

class ListBusinesses implements HasParameters
{
    /**
     * @param array<string> $ids
     * @param array<Status> $statuses
     *
     * @throws InvalidArgumentException On invalid array contents
     */
    public function __construct(
        private readonly ?Pager $pager = null,
        private readonly array $ids = [],
        private readonly array $statuses = [],
        private readonly ?string $search = null,
    ) {
        if ($invalid = array_filter($this->ids, fn ($value): bool => ! is_string($value))) {
            throw InvalidArgumentException::arrayContainsInvalidTypes('ids', 'string', implode(', ', $invalid));
        }

        if ($invalid = array_filter($this->statuses, fn ($value): bool => ! $value instanceof Status)) {
            throw InvalidArgumentException::arrayContainsInvalidTypes('statuses', Status::class, implode(', ', $invalid));
        }
    }

    public function getParameters(): array
    {
        $enumStringify = fn ($enum) => $enum->value;

        return array_merge(
            $this->pager?->getParameters() ?? [],
            array_filter([
                'id' => implode(',', $this->ids),
                'status' => implode(',', array_map($enumStringify, $this->statuses)),
                'search' => $this->search,
            ]),
        );
    }
}
