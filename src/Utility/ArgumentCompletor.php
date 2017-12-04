<?php

namespace Bellisq\TypeMap\Utility;

use ReflectionFunctionAbstract;
use Bellisq\TypeMap\TypeMapInterface;
use Bellisq\TypeMap\Exceptions\InvalidConstructorArgumentException;


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
                throw new InvalidConstructorArgumentException;
            }
            $type = $parameter->getType();
            if (!$this->typeMap->has($type)) {
                throw new InvalidConstructorArgumentException;                  // !
            }
            $args[] = $this->typeMap->get($type);
        }
        return $args;
    }

}
