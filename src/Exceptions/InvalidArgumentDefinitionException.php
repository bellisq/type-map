<?php

namespace Bellisq\TypeMap\Exceptions;

use LogicException;


/**
 * [ Exception ] Invalid Constructor Argument Definition
 *
 * @author katayose <katayose.goodlife@gmail.com>
 * @author 4kizuki <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 1.0.0
 */
class InvalidArgumentDefinitionException extends LogicException
{

    public function __construct()
    {
        parent::__construct('Argument does not have type hint or is variadic. Completor can not complete arguments automatically.');
    }

}
