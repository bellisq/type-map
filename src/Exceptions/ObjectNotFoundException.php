<?php

namespace Bellisq\TypeMap\Exceptions;

use Bellisq\TypeMap\Exceptions\TypeMapException;


class ObjectNotFoundException extends TypeMapException
{

    protected function generateMessage(string $type): string
    {
        return "Object of the type \"{$type}\" is not found.";
    }

}
