<?php

namespace Shopph\Foundation\Contract\Event;

interface DispatcherInterface
{
    public function dispatch(EventInterface $event);
}
