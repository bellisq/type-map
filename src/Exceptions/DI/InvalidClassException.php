<?php

namespace Bellisq\TypeMap\Exceptions\DI;

use LogicException;


/**
 * [Exception] Invalid Class Exception
 *
 * Any provider classes must be subclasses of `DI\Provider`.
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 2.0.0
 */
class InvalidClassException
    extends LogicException
{

}