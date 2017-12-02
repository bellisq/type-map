<?php

namespace Bellisq\TypeMap\Exceptions;

use LogicException;


class DuplicateProviderException extends LogicException
{

    public function __construct()
    {
        parent::__construct('Duplicate Provider.');
    }

}
