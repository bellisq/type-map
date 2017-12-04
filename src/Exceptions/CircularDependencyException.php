<?php

namespace Bellisq\TypeMap\Exceptions;

use LogicException;


/**
 * [ Exception ] Circular Dependency Found
 * 
 * Circular dependency is impossible to solve.
 * Clarify and refactor dependency.
 *
 * @author 4kizuki <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 1.0.0
 */
class CircularDependencyException extends LogicException
{

    public function __construct()
    {
        parent::__construct('Circular Dependency Found');
    }

}
