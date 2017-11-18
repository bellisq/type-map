<?php

namespace Bellisq\TypeMap\Exceptions;

use Bellisq\TypeMap\Exceptions\ObjectNotFoundException;


class TooManyCandidatesException extends ObjectNotFoundException
{

    public function __construct(string $type)
    {
        parent::__construct(
            "Many candidates are found for the type {$type}."
        );
    }

}
