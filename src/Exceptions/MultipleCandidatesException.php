<?php

namespace Bellisq\TypeMap\Exceptions;

use Bellisq\TypeMap\Exceptions\TypeMapException;


class MultipleCandidatesException extends TypeMapException
{

    public function generateMessage(string $type): string
    {
        return "Multiple candidates are found for the type {$type}.";
    }

}
