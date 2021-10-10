<?php

namespace Shopph\Shared\Contract\Event;

interface DispatcherInterface
{
    public function dispatch(EventInterface $event);
}
