<?php

namespace Shopph\Contract\Shared\Event;

interface DispatcherInterface
{
    public function dispatch(EventInterface $event);
}
