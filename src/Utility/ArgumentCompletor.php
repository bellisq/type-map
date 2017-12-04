<?php

namespace Bellisq\TypeMap\Utility;

use ReflectionFunctionAbstract;
use Bellisq\TypeMap\Exceptions\InvalidArgumentDefinitionException;
use Bellisq\TypeMap\Exceptions\UnsupportedArgumentTypeException;
use Bellisq\TypeMap\TypeMapInterface;


/**
 * [ Utility ] Argument Completor
 *
 * @author katayose
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 1.0.0
 */
class ArgumentCompletor
{

    /** @var TypeMapInterface */ private $typeMap;

    public function __construct(TypeMapInterface $typeMap)
    {
        $this->typeMap = $typeMap;
    }

    public function complete(ReflectionFunctionAbstract $rfa): array
    {
        $parameters = $rfa->getParameters();
        $args       = [];

        foreach ($parameters as $parameter) {
            if (!$parameter->hasType() || $parameter->isVariadic()) {
                throw new InvalidArgumentDefinitionException;
            }

            $type = $parameter->getType();

            if (!$this->typeMap->has($type)) {
                throw new UnsupportedArgumentTypeException;
            }
            $args[] = $this->typeMap->get($type);
        }
        return $args;
    }

}
