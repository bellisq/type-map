<?php

namespace Bellisq\TypeMap\Completion;

use ReflectionFunctionAbstract;


/**
 * [ Interface ] Argument Completor Interface
 *
 * @author katayose
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq\type-map
 * @since 1.0.0
 */
interface ArgumentCompletorInterface
{

    public function complete(ReflectionFunctionAbstract $rfa): array;

}
