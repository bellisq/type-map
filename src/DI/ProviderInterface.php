<?php

namespace Bellisq\TypeMap\DI;

use Bellisq\TypeMap\DI\Registers\ObjectRegister;


/**
 * [ Interface ] Provider Interface
 * 
 * All providers must implement this.
 * Arguments of constructors of providers are injected automatically.
 * 
 * @author 4kizuki <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 1.0.0
 * @see DIContainer
 */
interface ProviderInterface
{

    public static function registerObjects(ObjectRegister $objectRegister);
    public function getInstance(string $type);

}
