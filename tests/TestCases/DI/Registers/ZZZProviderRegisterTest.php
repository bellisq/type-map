<?php

namespace Bellisq\TypeMap\Tests\DI\Registers;

use PHPUnit\Framework\TestCase;
use Strict\Validator\General\AlwaysPassValidator;
use Strict\Validator\General\AlwaysFailValidator;
use Bellisq\TypeMap\DI\Registers\ProviderRegister;
use Bellisq\TypeMap\DI\Registers\ProviderRegisterDataTransport;
use Bellisq\TypeMap\Exceptions\InvalidProviderException;


class ZZZProviderRegisterTest extends TestCase
{

    public function testBehavior()
    {
        $prdt = new ProviderRegisterDataTransport;
        $pr   = new ProviderRegister($prdt, new AlwaysPassValidator);
        $pr->register('a')->register('b');
        $this->assertEquals(['a', 'b'], $prdt->get());
    }

    public function testValidation()
    {
        $this->expectException(InvalidProviderException::class);
        $pr = new ProviderRegister(new ProviderRegisterDataTransport, new AlwaysFailValidator);
        $pr->register('a');
    }

}
