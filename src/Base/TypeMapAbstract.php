<?php

namespace Bellisq\TypeMap\Base;

use Bellisq\TypeMap\Exceptions\UnavailableTypeException;
use Bellisq\TypeMap\TypeMapInterface;
use TypeError;


/**
 * [Abstract Class] Type-map Abstract
 *
 * DO NOT use this class for type-hinting. Use TypeMapInterface instead.
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 2.0.0
 */
abstract class TypeMapAbstract
    implements TypeMapInterface
{
    /**
     * Get an object of the type.
     *
     * The type is limited to supported types.
     * So, the assertion of `$this->supports($type)` must result in success.
     *
     * @param string $type
     * @return object
     */
    abstract protected function getObject(string $type): object;

    /**
     * Get an object of the type.
     *
     * Check if the type is supported.
     * If the type is supported, call getObject.
     * If not, throw an exception.
     *
     * @param string $type
     * @return object
     *
     * @throws TypeError
     * @throws UnavailableTypeException
     */
    final public function get(string $type): object
    {
        if ($this->supports($type)) {
            $ret = $this->getObject($type);
            if ($ret instanceof $type) {
                return $ret;
            }
            throw new TypeError;
        }

        throw new UnavailableTypeException;
    }
}