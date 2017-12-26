<?php

namespace Bellisq\TypeMap\Exceptions\DI;

use LogicException;


/**
 * [Exception] Unqualified Closure Exception
 *
 * Any provider closures must have return types and completable arguments sets.
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 2.0.0
 */
class UnqualifiedClosureException
    extends LogicException
{

}