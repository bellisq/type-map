<?php

namespace Bellisq\TypeMap\Completion;

use ReflectionFunctionAbstract;


interface ArgumentCompletorInterface
{

    public function complete(ReflectionFunctionAbstract $rfa): array;

}
