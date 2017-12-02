<?php

namespace Bellisq\TypeMap\Exceptions;

use LogicException;


class CircularDependencyException extends LogicException
{

    public function __construct()
    {
        parent::__construct('Circular Dependency Found');
    }

}
