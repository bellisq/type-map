<?php

namespace Bellisq\TypeMap\DI;

use Bellisq\TypeMap\Base\StaticTypeMapAbstract;
use Bellisq\TypeMap\DI\Storage\TypeDefinition;
use Bellisq\TypeMap\DI\Transport\TypeRegister;


/**
 * [Class] Provider
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 2.0.0
 */
abstract class Provider
    extends StaticTypeMapAbstract
{
    /**
     * Register types this class supports using TypeRegister.
     *
     * @param TypeRegister $typeRegister
     */
    abstract protected static function registerTypes(TypeRegister $typeRegister): void;

    /**
     * Instantiate object. If the type is registered as singleton, this method is called only once.
     *
     * @param string $type
     * @return object
     */
    abstract protected function instantiateObject(string $type): object;

    /**
     * @inheritdoc
     */
    protected static function generatePredefinedList(): array
    {
        $typeDefinition = new TypeDefinition;
        static::registerTypes(new TypeRegister($typeDefinition));

        self::$typeDefinitions[static::class] = $typeDefinition;
        return $typeDefinition->getList();
    }

    /** @var TypeDefinition[] */
    private static $typeDefinitions = [];

    /**
     * Provider constructor.
     */
    public function __construct()
    {
        parent::__construct();
        assert(isset(self::$typeDefinitions[static::class]));
        $this->typeDefinition = self::$typeDefinitions[static::class];
    }

    /**
     * @inheritdoc
     */
    protected function getObject(string $type): object
    {
        if ($this->typeDefinition->isSingleton($type)) {
            if (isset($this->singletonObjects[$type])) {
                return $this->singletonObjects[$type];
            }
            return $this->singletonObjects[$type] = $this->instantiateObject($type);
        }
        return $this->instantiateObject($type);
    }

    /** @var TypeDefinition */
    private $typeDefinition;

    /** @var object[] */
    private $singletonObjects = [];
}