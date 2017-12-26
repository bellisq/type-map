<?php

namespace Bellisq\TypeMap\DI;

use Bellisq\TypeMap\Base\TypeMapAbstract;
use Bellisq\TypeMap\TypeMapInterface;
use Bellisq\TypeMap\Utility\ArgumentAutoComplete;


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
     */
    public function __construct(TypeMapInterface $typeMap)
    {
        $this->aComplete = new ArgumentAutoComplete($typeMap);
    }

    /**
     * @param string $type
     * @return object
     */
    final protected function getObject(string $type): object
    {
        return $this->aComplete->instantiate($type);
    }

    /** @var ArgumentAutoComplete */
    private $aComplete;
}