<?php

namespace Bellisq\TypeMap\Exceptions;

use LogicException;


/**
 * [ Exception ] Invalid Provider Registered
 *
 * @author 4kizuki <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 1.0.0
 */
class InvalidProviderException extends LogicException
{

    public function __construct()
    {
        parent::__construct('Invalid provider is registered.');
    }

}
