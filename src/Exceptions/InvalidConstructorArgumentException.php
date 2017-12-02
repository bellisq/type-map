<?php

namespace Bellisq\TypeMap\Exceptions;

use LogicException;


/**
 * [ Exception ] Invalid Constructor Argument Definition
 *
 * @author katayose
 * @author 4kizuki <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 1.0.0
 */
class InvalidConstructorArgumentException extends LogicException
{

    public function __construct()
    {
        parent::__construct('Argument does not have type hint or variadic. Completor can not complete arguments automatically.');
    }

}
