<?php

namespace Bellisq\TypeMap\Exceptions;

use LogicException;


class ObjectNotFoundException extends LogicException
{

    public function __construct(string $type)
    {
        parent::__construct(
            "Object of the type \"{$type}\" is not found."
        );
    }

}
