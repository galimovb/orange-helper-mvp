<?php

namespace App\Listener;


use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use App\Entity\User;

class JwtCreatedListener
{
    public function onJWTCreated(JWTCreatedEvent $event): void
    {
        /** @var User $user */
        $user = $event->getUser();

        $payload = $event->getData();

        $payload['id'] = $user->getId();
        $payload['roles'] = $user->getRoles();
        $payload['phoneNumber'] = $user->getPhoneNumber();

        $event->setData($payload);
    }
}