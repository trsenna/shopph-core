<?php

namespace Shopph\Contract\Foundation\Event;

interface DispatcherInterface
{
    public function dispatch(EventInterface $event);
}
