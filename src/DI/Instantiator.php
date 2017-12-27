<?php

namespace Bellisq\TypeMap\DI;

use Bellisq\TypeMap\Base\TypeMapAbstract;
use Bellisq\TypeMap\Exceptions\DI\CircularDependencyException;
use Bellisq\TypeMap\TypeMapInterface;
use Bellisq\TypeMap\Utility\ArgumentAutoComplete;
use Bellisq\TypeMap\Utility\TypeMapAggregate;


/**
 * [Class] Instantiator
 *
 * Specify what kind of class to instantiate by `supports` method.
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 2.0.0
 */
abstract class Instantiator
    extends TypeMapAbstract
{
    /**
     * Instantiator constructor.
     *
     * @param TypeMapInterface $typeMap
     * @param bool $recursive
     */
    public function __construct(TypeMapInterface $typeMap, bool $recursive = false)
    {
        $this->recursive = $recursive;
        if ($recursive) {
            $typeMap = new TypeMapAggregate($typeMap, $this);
        }
        $this->aComplete = new ArgumentAutoComplete($typeMap);
    }

    /**
     * @param string $type
     * @return object
     */
    final protected function getObject(string $type): object
    {
        if ($this->recursive) {
            if (isset($this->circularDetector[$type])) {
                throw new CircularDependencyException;
            }
            $this->circularDetector[$type] = true;
        }
        $ret = $this->aComplete->instantiate($type);

        if ($this->recursive) {
            unset($this->circularDetector[$type]);
        }

        return $ret;
    }

    /** @var bool[] */
    private $circularDetector = [];

    /** @var ArgumentAutoComplete */
    private $aComplete;

    /** @var bool */
    private $recursive;
}