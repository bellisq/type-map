<?php

namespace Bellisq\TypeMap\DI;

use Bellisq\TypeMap\ContainerInterface;
use Bellisq\TypeMap\DI\DIInstantiator;
use Bellisq\TypeMap\DI\ProviderInterface;
use Bellisq\TypeMap\DI\Registers\ObjectRegister;
use Bellisq\TypeMap\DI\Registers\ObjectRegisterDataTransport;
use Bellisq\TypeMap\DI\Registers\ProviderRegister;
use Bellisq\TypeMap\DI\Registers\ProviderRegisterDataTransport;
use Bellisq\TypeMap\Exceptions\CircularDependencyException;
use Bellisq\TypeMap\Exceptions\DuplicateObjectTypeException;
use Bellisq\TypeMap\Exceptions\DuplicateProviderException;
use Bellisq\TypeMap\Exceptions\ObjectNotFoundException;
use Strict\Validator\General\SubclassOfValidator;


abstract class DIContainer implements ContainerInterface
{

    abstract public function registerProviders(ProviderRegister $pr);

    /** @var ProviderInterface[] providerType => providerInstance(nullable) */
    private $providers = [];

    /** @var string[] objectType => providerType */
    private $objects = [];

    /** @var bool[] objectType => isRequiring to detect circular dependencies. */
    private $req = [];

    /** @var DIInstantiator */
    private $diInst;

    public function __construct()
    {
        $prdt = new ProviderRegisterDataTransport;
        $this->registerProviders(new ProviderRegister($prdt, new SubclassOfValidator(ProviderInterface::class, false)));

        foreach ($prdt->get() as $providerType) {
            if (array_key_exists($providerType, $this->providers)) {
                throw new DuplicateProviderException;
            }
            $this->providers[$providerType] = null;

            $ordt = new ObjectRegisterDataTransport;
            [$providerType, 'RegisterObjects'](new ObjectRegister($ordt));

            foreach ($ordt->get() as $objectType) {
                if (isset($this->objects[$objectType])) {
                    throw new DuplicateObjectTypeException;
                }
                $this->objects[$objectType] = $providerType;
            }
        }

        $this->diInst = new DIInstantiator($this);
    }

    public function get(string $type)
    {
        if (!$this->has($type)) {
            throw new ObjectNotFoundException($type);
        }

        if (isset($this->req[$type])) {
            throw new CircularDependencyException;
        }
        $this->req[$type] = true;

        $prov = $this->objects[$type];
        $this->loadProvider($prov);

        unset($this->req[$type]);
        return $this->providers[$prov]->getInstance($type);
    }

    public function has(string $type): bool
    {
        return isset($this->objects[$type]);
    }

    private function loadProvider(string $providerName)
    {
        assert(array_key_exists($providerName, $this->providers));

        if (is_null($this->providers[$providerName])) {
            $this->providers[$providerName] = $this->diInst->get($providerName);
        }
    }

}
