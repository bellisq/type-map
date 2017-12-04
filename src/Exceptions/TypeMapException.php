<?php

namespace Bellisq\TypeMap\Exceptions;

use LogicException;


abstract class TypeMapException extends LogicException
{

    final public function __construct(string $type)
    {
        parent::__construct($this->generateMessage($type));
    }

    abstract protected function generateMessage(string $type): string;

}
