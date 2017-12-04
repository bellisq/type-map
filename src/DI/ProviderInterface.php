<?php

namespace Bellisq\TypeMap\DI;

use Bellisq\TypeMap\DI\Registers\ObjectRegister;


interface ProviderInterface
{

    public static function registerObjects(ObjectRegister $objectRegister);
    public function getInstance(string $type);

}
