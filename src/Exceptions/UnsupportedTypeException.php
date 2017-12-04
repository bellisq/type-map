<?php

namespace Bellisq\TypeMap\Exceptions;

use Bellisq\TypeMap\Exceptions\TypeMapException;


class UnsupportedTypeException extends TypeMapException
{

    public function generateMessage(string $type): string
    {
        return "Failed to instantiate type {$type}.";
    }

}
