<?php

declare(strict_types=1);

/**
 * |------
 * | ! Generated code !
 * | Altering this code will result in changes being overwritten |
 * |-------------------------------------------------------------|.
 */

namespace Paddle\SDK\Entities\PricingPreview;

use Paddle\SDK\Entities\Entity;

class PricePreviewItem implements Entity
{
    public function __construct(
        public string $priceId,
        public int $quantity,
    ) {
    }

    public static function from(array $data): self
    {
        return new self(
            $data['price_id'],
            $data['quantity'],
        );
    }
}
