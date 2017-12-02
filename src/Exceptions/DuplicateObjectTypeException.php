<?php

namespace Bellisq\TypeMap\Exceptions;

use LogicException;


class DuplicateObjectTypeException extends LogicException
{

    public function __construct()
    {
        parent::__construct('Duplicate Object Type.');
    }

}
