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


/**
 * [ Container ] DI Container
 * 
 * DI Container with Provider Class Model.
 * 
 * @author 4kizuki <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 1.0.0
 * @see ProviderInterface
 */
abstract class DIContainer implements ContainerInterface
{

    abstract public function registerProviders(ProviderRegister $providerRegister);

    /** @var ProviderInterface[] providerType => providerInstance(nullable) */
    private $providers = [];

    /** @var string[] objectType => providerType */
    private $objectProviderRelation = [];

    /** @var bool[] objectType => isSingleton */
    private $objectIsSingleton = [];

    /** @var array objectType => object */
    private $singletonObjects = [];

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

            foreach ($ordt->get() as list($objectType, $isSingleton)) {
                if (isset($this->objectProviderRelation[$objectType])) {
                    throw new DuplicateObjectTypeException;
                }
                $this->objectProviderRelation[$objectType] = $providerType;
                $this->objectIsSingleton[$objectType]      = $isSingleton;
            }
        }

        $this->diInst = new DIInstantiator($this);
    }

    public function get(string $type)
    {
        if (!$this->has($type)) {
            throw new ObjectNotFoundException($type);
        }

        if (isset($this->singletonObjects[$type])) {
            return $this->singletonObjects[$type];
        }

        if (isset($this->req[$type])) {
            throw new CircularDependencyException;
        }
        $this->req[$type] = true;

        $prov = $this->objectProviderRelation[$type];
        $this->loadProvider($prov);

        unset($this->req[$type]);
        $instance = $this->providers[$prov]->getInstance($type);

        if ($this->objectIsSingleton[$type]) {
            $this->singletonObjects[$type] = $instance;
        }

        return $instance;
    }

    public function has(string $type): bool
    {
        return isset($this->objectProviderRelation[$type]);
    }

    private function loadProvider(string $providerName)
    {
        assert(array_key_exists($providerName, $this->providers));

        if (is_null($this->providers[$providerName])) {
            $this->providers[$providerName] = $this->diInst->get($providerName);
        }
    }

}
