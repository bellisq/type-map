<?php

namespace Bellisq\TypeMap\DI;

use Bellisq\TypeMap\DI\Registers\ObjectRegister;


interface ProviderInterface
{

    public static function RegisterObjects(ObjectRegister $or);
    public function getInstance(string $type);

}
