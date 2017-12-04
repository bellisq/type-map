<?php

namespace Bellisq\TypeMap\Exceptions;

use LogicException;


class ObjectNotFoundException extends LogicException
{

    final public function __construct(string $type)
    {
        parent::__construct($this->generateMessage($type));
    }

    protected function generateMessage(string $type)
    {
        return "Object of the type \"{$type}\" is not found.";
    }

}
