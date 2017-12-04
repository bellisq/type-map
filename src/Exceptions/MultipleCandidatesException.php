<?php

namespace Bellisq\TypeMap\Exceptions;

use Bellisq\TypeMap\Exceptions\ObjectNotFoundException;


class MultipleCandidatesException extends ObjectNotFoundException
{

    public function generateMessage(string $type)
    {
        return "Multiple candidates are found for the type {$type}.";
    }

}
