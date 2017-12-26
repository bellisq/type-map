<?php

namespace Bellisq\TypeMap\DI;

use Bellisq\TypeMap\Base\StaticTypeMapAbstract;
use Bellisq\TypeMap\DI\Storage\ProviderDefinition;
use Bellisq\TypeMap\DI\Transport\ProviderRegister;
use Bellisq\TypeMap\Exceptions\DI\CircularDependencyException;
use Bellisq\TypeMap\FiniteTypeMapInterface;
use Bellisq\TypeMap\TypeMapInterface;
use Bellisq\TypeMap\Utility\ArgumentAutoComplete;
use Bellisq\TypeMap\Utility\FiniteTypeMapAggregate;


/**
 * [Class] Container
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 2.0.0
 */
abstract class Container
    extends StaticTypeMapAbstract
{
    /**
     * Container constructor.
     *
     * @param TypeMapInterface $injection
     */
    public function __construct(?TypeMapInterface $injection = null)
    {
        parent::__construct();
        $this->providerDefinition = self::$definitions[static::class];

        if (!is_null($injection)) {
            if ($injection instanceof FiniteTypeMapInterface) {
                $comp = new FiniteTypeMapAggregate($injection, $this);
            } else {
                $comp = new TypeMapAggregate($injection, $this);
            }
        } else {
            $comp = $this;
        }

        $this->complete = new ArgumentAutoComplete($comp);
    }

    /** @var ProviderDefinition */
    private $providerDefinition;

    /** @var ArgumentAutoComplete */
    private $complete;

    /** @var object[] */
    private $singletonObjects = [];

    /** @var bool[] */
    private $obtaining = [];

    /** @var Provider[] */
    private $providers = [];

    /**
     * @inheritdoc
     */
    protected function getObject(string $type): object
    {
        if (isset($this->obtaining[$type])) {
            throw new CircularDependencyException;
        }
        $this->obtaining[$type] = true;

        $ret = null;
        switch ($this->providerDefinition->getProviderType($type)) {
            case ProviderDefinition::PROVIDER_FACTORY:
                $closure = $this->providerDefinition->getFactory($type);
                $ret = $this->complete->call($closure);
                break;
            case ProviderDefinition::PROVIDER_SINGLETON:
                if (!isset($this->singletonObjects[$type])) {
                    $closure = $this->providerDefinition->getFactory($type);
                    $this->singletonObjects[$type] = $this->complete->call($closure);
                }
                $ret = $this->singletonObjects[$type];
                break;
            case ProviderDefinition::PROVIDER_CLASS:
                $providerName = $this->providerDefinition->getClassName($type);
                if (!isset($this->providers[$providerName])) {
                    $this->providers[$providerName] = $this->complete->instantiate($providerName);
                }
                $ret = $this->providers[$providerName]->get($type);
                break;
        }

        unset($this->obtaining[$type]);
        return $ret;
    }

    /**
     * @inheritdoc
     */
    protected static function generatePredefinedList(): array
    {
        $providerDefinition = new ProviderDefinition;
        static::registerProviders(new ProviderRegister($providerDefinition));

        self::$definitions[static::class] = $providerDefinition;
        return $providerDefinition->getList();
    }

    /** @var ProviderDefinition[] */
    private static $definitions = [];

    /**
     * Register providers using ProviderRegister
     *
     * @param ProviderRegister $providerRegister
     */
    abstract protected static function registerProviders(ProviderRegister $providerRegister): void;
}