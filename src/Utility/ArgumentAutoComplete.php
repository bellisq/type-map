<?php

namespace Bellisq\TypeMap\Utility;

use Bellisq\TypeMap\Exceptions\ClassNotFoundException;
use Bellisq\TypeMap\Exceptions\IncompletableArgumentException;
use Bellisq\TypeMap\TypeMapInterface;
use Closure;
use ReflectionClass;
use ReflectionFunction;
use ReflectionFunctionAbstract;


/**
 * [Class] Argument Auto Complete
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 2.0.0
 */
class ArgumentAutoComplete
{
    /**
     * ArgumentAutoComplete constructor.
     *
     * @param TypeMapInterface $typeMap Type-map to complete arguments.
     */
    public function __construct(TypeMapInterface $typeMap)
    {
        $this->typeMap = $typeMap;
    }

    /**
     * @param ReflectionFunctionAbstract $rfa
     * @return object[] arguments
     *
     * @throws IncompletableArgumentException
     */
    public function complete(ReflectionFunctionAbstract $rfa): array
    {
        $args = [];

        $params = $rfa->getParameters();
        foreach ($params as $rParam) {
            if (!$rParam->hasType() || $rParam->isVariadic()) {
                throw new IncompletableArgumentException;
            }
            $rType = $rParam->getType();
            $type = $rType->getName();
            if ($rType->isBuiltin() || !$this->typeMap->supports($type)) {
                throw new IncompletableArgumentException;
            }
            $args[] = $this->typeMap->get($type);
        }

        return $args;
    }

    /**
     * @param string $type
     * @return object
     *
     * @throws ClassNotFoundException
     * @throws IncompletableArgumentException
     */
    public function instantiate(string $type): object
    {
        if (!class_exists($type)) {
            throw new ClassNotFoundException;
        }

        $rClass = new ReflectionClass($type);
        $rConst = $rClass->getConstructor();
        if (is_null($rConst)) {
            return $rClass->newInstance();
        }

        return $rClass->newInstanceArgs($this->complete($rConst));
    }

    /**
     * @param callable $function
     * @return mixed
     *
     * @throws IncompletableArgumentException
     */
    public function call(callable $function)
    {
        $closure = Closure::fromCallable($function);
        return $closure(...$this->complete(new ReflectionFunction($closure)));
    }

    /** @var TypeMapInterface */
    private $typeMap;
}