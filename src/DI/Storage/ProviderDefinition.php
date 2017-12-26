<?php

namespace Bellisq\TypeMap\DI\Storage;

use Bellisq\TypeMap\DI\Provider;
use Bellisq\TypeMap\Exceptions\DI\InvalidClassException;
use Bellisq\TypeMap\Exceptions\DI\UnqualifiedClosureException;
use Bellisq\TypeMap\Exceptions\DuplicateSupportedTypeException;
use Bellisq\TypeMap\Utility\ArgumentAutoComplete;
use Closure;
use ReflectionFunction;


/**
 * [Class] Provider Definition
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 2.0.0
 */
class ProviderDefinition
{
    public const PROVIDER_FACTORY = 1;
    public const PROVIDER_SINGLETON = 2;
    public const PROVIDER_CLASS = 3;

    /**
     * @param Closure $closure
     *
     * @throws DuplicateSupportedTypeException
     * @throws UnqualifiedClosureException
     */
    public function addFactory(Closure $closure): void
    {
        $this->addClosure($closure, self::PROVIDER_FACTORY);
    }

    /**
     * @param Closure $closure
     *
     * @throws DuplicateSupportedTypeException
     * @throws UnqualifiedClosureException
     */
    public function addSingleton(Closure $closure): void
    {
        $this->addClosure($closure, self::PROVIDER_SINGLETON);
    }

    /**
     * @param string $className
     *
     * @throws DuplicateSupportedTypeException
     * @throws InvalidClassException
     */
    public function addClass(string $className): void
    {
        if (!is_subclass_of($className, Provider::class, true)) {
            throw new InvalidClassException;
        }

        /** @var string[] $typeList */
        $typeList = $className::getPredefinedList();

        foreach ($typeList as $type) {
            if (isset($this->providerType[$type])) {
                throw new DuplicateSupportedTypeException;
            }
            $this->providerType[$type] = self::PROVIDER_CLASS;
            $this->classes[$type] = $className;
        }
    }

    /**
     * @return string[]
     */
    public function getList(): array
    {
        return array_keys($this->providerType);
    }

    /**
     * Only `DI\Container` can call this function.
     * So, `DI\Container` is responsible to the assertion.
     *
     * @param string $type
     * @return int
     */
    public function getProviderType(string $type): int
    {
        assert(isset($this->providerType[$type]));
        return $this->providerType[$type];
    }

    /**
     * Only `DI\Container` can call this function.
     * So, `DI\Container` is responsible to the assertion.
     *
     * @param string $type
     * @return Closure
     */
    public function getFactory(string $type): Closure
    {
        assert(isset($this->closures[$type]));
        return $this->closures[$type];
    }

    /**
     * Only `DI\Container` can call this function.
     * So, `DI\Container` is responsible to the assertion.
     *
     * @param string $type
     * @return string
     */
    public function getClassName(string $type): string
    {
        assert(isset($this->classes[$type]));
        return $this->classes[$type];
    }

    /** @var int[] */
    private $providerType = [];

    /** @var Closure[] */
    private $closures = [];

    /** @var string[] */
    private $classes = [];
    
    /**
     * @param Closure $closure
     * @param int $providerType
     *
     * @throws UnqualifiedClosureException
     * @throws DuplicateSupportedTypeException
     */
    private function addClosure(Closure $closure, int $providerType): void
    {
        $type = self::validateClosure($closure);
        if (isset($this->providerType[$type])) {
            throw new DuplicateSupportedTypeException;
        }

        $this->providerType[$type] = $providerType;
        $this->closures[$type] = $closure;
    }

    /**
     * @param Closure $closure
     * @return string
     *
     * @throws UnqualifiedClosureException
     */
    private static function validateClosure(Closure $closure): string
    {
        $rFunc = new ReflectionFunction($closure);
        foreach ($rFunc->getParameters() as $rParam) {
            if (!ArgumentAutoComplete::isCompletable($rParam)) {
                throw new UnqualifiedClosureException;
            }
        }

        $rType = $rFunc->getReturnType();
        if (is_null($rType) || $rType->isBuiltin()) {
            throw new UnqualifiedClosureException;
        }

        return $rType->getName();
    }
}