<?php

declare(strict_types = 1);

namespace App\Api\Listener;

use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\Serializer\SerializerInterface;

final class ResponseListener implements EventSubscriberInterface
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function onControllerResponse(ViewEvent $event): void
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        if (!$this->isApiRequest($event)) {
            return;
        }

        $event->setResponse(
            JsonResponse::fromJsonString(
                $this->serializer->serialize($event->getControllerResult(), 'json')
            )
        );
    }

    #[ArrayShape([ViewEvent::class => "string"])]
    public static function getSubscribedEvents(): array
    {
        return [
            ViewEvent::class => 'onControllerResponse',
        ];
    }

    private function isApiRequest(ViewEvent $event): bool
    {
        return stripos($event->getRequest()->getPathInfo(), '/api') === 0;
    }
}
