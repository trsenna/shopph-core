<?php

namespace Shopph\Contract\Foundation\Domain\Event;

interface DispatcherInterface
{
    public function dispatch(EventInterface $event);
}
