<?php

namespace Bellisq\TypeMap\Exceptions;

use LogicException;


/**
 * [ Abstract Exception ] Type Map Exception
 *
 * @author 4kizuki <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 1.0.0
 */
abstract class TypeMapException extends LogicException
{

    final public function __construct(string $type)
    {
        parent::__construct($this->generateMessage($type));
    }

    abstract protected function generateMessage(string $type): string;

}
