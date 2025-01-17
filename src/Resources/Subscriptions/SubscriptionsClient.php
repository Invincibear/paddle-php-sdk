<?php

declare(strict_types=1);

/**
 * |------
 * | ! Generated code !
 * | Altering this code will result in changes being overwritten |
 * |-------------------------------------------------------------|.
 */

namespace Paddle\SDK\Resources\Subscriptions;

use Paddle\SDK\Client;
use Paddle\SDK\Entities\Collections\Paginator;
use Paddle\SDK\Entities\Collections\SubscriptionWithIncludesCollection;
use Paddle\SDK\Entities\SubscriptionPreview;
use Paddle\SDK\Entities\SubscriptionWithIncludes;
use Paddle\SDK\Entities\TransactionWithIncludes;
use Paddle\SDK\Exceptions\ApiError;
use Paddle\SDK\Exceptions\SdkExceptions\InvalidArgumentException;
use Paddle\SDK\Exceptions\SdkExceptions\MalformedResponse;
use Paddle\SDK\Resources\Subscriptions\Operations\CancelSubscription;
use Paddle\SDK\Resources\Subscriptions\Operations\CreateOneTimeCharge;
use Paddle\SDK\Resources\Subscriptions\Operations\Get\Includes;
use Paddle\SDK\Resources\Subscriptions\Operations\ListSubscriptions;
use Paddle\SDK\Resources\Subscriptions\Operations\PauseSubscription;
use Paddle\SDK\Resources\Subscriptions\Operations\PreviewOneTimeCharge;
use Paddle\SDK\Resources\Subscriptions\Operations\PreviewUpdateSubscription;
use Paddle\SDK\Resources\Subscriptions\Operations\ResumeSubscription;
use Paddle\SDK\Resources\Subscriptions\Operations\UpdateSubscription;
use Paddle\SDK\ResponseParser;

class SubscriptionsClient
{
    public function __construct(
        private readonly Client $client,
    ) {
    }

    /**
     * @throws ApiError          On a generic API error
     * @throws MalformedResponse If the API response was not parsable
     */
    public function list(ListSubscriptions $listOperation = new ListSubscriptions()): SubscriptionWithIncludesCollection
    {
        $parser = new ResponseParser(
            $this->client->getRaw('/subscriptions', $listOperation),
        );

        return SubscriptionWithIncludesCollection::from(
            $parser->getData(),
            new Paginator($this->client, $parser->getPagination(), SubscriptionWithIncludesCollection::class),
        );
    }

    /**
     * @param Includes[] $includes
     *
     * @throws ApiError          On a generic API error
     * @throws MalformedResponse If the API response was not parsable
     */
    public function get(string $id, array $includes = []): SubscriptionWithIncludes
    {
        if ($invalid = array_filter($includes, fn ($value): bool => ! $value instanceof Includes)) {
            throw InvalidArgumentException::arrayContainsInvalidTypes('includes', Includes::class, implode(', ', $invalid));
        }

        $params = $includes === []
            ? []
            : ['include' => implode(',', array_map(fn ($enum) => $enum->value, $includes))];

        $parser = new ResponseParser(
            $this->client->getRaw("/subscriptions/{$id}", $params),
        );

        return SubscriptionWithIncludes::from($parser->getData());
    }

    /**
     * @throws ApiError                      On a generic API error
     * @throws ApiError\SubscriptionApiError On a subscription specific API error
     * @throws MalformedResponse             If the API response was not parsable
     */
    public function update(string $id, UpdateSubscription $operation): SubscriptionWithIncludes
    {
        $parser = new ResponseParser(
            $this->client->patchRaw("/subscriptions/{$id}", $operation),
        );

        return SubscriptionWithIncludes::from($parser->getData());
    }

    public function pause(string $id, PauseSubscription $operation): SubscriptionWithIncludes
    {
        $parser = new ResponseParser(
            $this->client->postRaw("/subscriptions/{$id}/pause", $operation),
        );

        return SubscriptionWithIncludes::from($parser->getData());
    }

    public function resume(string $id, ResumeSubscription $operation): SubscriptionWithIncludes
    {
        $parser = new ResponseParser(
            $this->client->postRaw("/subscriptions/{$id}/resume", $operation),
        );

        return SubscriptionWithIncludes::from($parser->getData());
    }

    public function cancel(string $id, CancelSubscription $operation): SubscriptionWithIncludes
    {
        $parser = new ResponseParser(
            $this->client->postRaw("/subscriptions/{$id}/cancel", $operation),
        );

        return SubscriptionWithIncludes::from($parser->getData());
    }

    public function getPaymentMethodChangeTransaction(string $id): TransactionWithIncludes
    {
        $parser = new ResponseParser(
            $this->client->getRaw("/subscriptions/{$id}/update-payment-method-transaction"),
        );

        return TransactionWithIncludes::from($parser->getData());
    }

    public function activate(string $id): SubscriptionWithIncludes
    {
        $parser = new ResponseParser(
            $this->client->postRaw("/subscriptions/{$id}/activate"),
        );

        return SubscriptionWithIncludes::from($parser->getData());
    }

    public function createOneTimeCharge(string $id, CreateOneTimeCharge $operation): SubscriptionWithIncludes
    {
        $parser = new ResponseParser(
            $this->client->postRaw("/subscriptions/{$id}/charge", $operation),
        );

        return SubscriptionWithIncludes::from($parser->getData());
    }

    public function previewUpdate(string $id, PreviewUpdateSubscription $operation): SubscriptionPreview
    {
        $parser = new ResponseParser(
            $this->client->patchRaw("/subscriptions/{$id}/preview", $operation),
        );

        return SubscriptionPreview::from($parser->getData());
    }

    public function previewOneTimeCharge(string $id, PreviewOneTimeCharge $operation): SubscriptionPreview
    {
        $parser = new ResponseParser(
            $this->client->postRaw("/subscriptions/{$id}/charge/preview", $operation),
        );

        return SubscriptionPreview::from($parser->getData());
    }
}
