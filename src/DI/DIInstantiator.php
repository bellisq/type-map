<?php

namespace Bellisq\TypeMap\DI;

use ReflectionClass;
use Bellisq\TypeMap\InstantiatorInterface;
use Bellisq\TypeMap\TypeMapInterface;
use Bellisq\TypeMap\Utility\ArgumentCompletor;
use Bellisq\TypeMap\Exceptions\ObjectNotFoundException;


/**
 * [ Utility ] DI Instantiator
 *
 * Instantiate a class using ArgumentCompletor.
 *
 * @author katayose
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 1.0.0
 */
class DIInstantiator implements InstantiatorInterface
{

    private $typeMap;

    public function __construct(TypeMapInterface $typeMap)
    {
        $this->typeMap = $typeMap;
    }

    public function get(string $type)
    {
        if ($this->has($type)) {
            $refClass = new ReflectionClass($type);
            $ac       = new ArgumentCompletor($this->typeMap);
            $refConst = $refClass->getConstructor();
            if (is_null($refConst)) {
                $args = [];
            } else {
                $args = $ac->complete($refClass->getConstructor());
            }
            return $refClass->newInstanceArgs($args);
        }
        throw new ObjectNotFoundException($type);
    }

    public function has(string $type): bool
    {
        return class_exists($type);
    }

}
