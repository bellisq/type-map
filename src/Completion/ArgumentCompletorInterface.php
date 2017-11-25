<?php
namespace Bellisq\TypeMap\Completion;

interface ArgumentCompletorInterface {
    public function complete(\ReflectionFunctionAbstract $rfa): array;
}
