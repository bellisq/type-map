<?php

namespace Bellisq\TypeMap\Base;

use Bellisq\TypeMap\Base\TypeMapAbstract as TypeMapAbstract;
use Bellisq\TypeMap\Exceptions\DuplicateSupportedTypeException;
use Bellisq\TypeMap\FiniteTypeMapInterface;


/**
 * [Abstract Class] Finite Type-map Abstract
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 2.0.0
 */
abstract class FiniteTypeMapAbstract
    extends TypeMapAbstract
    implements FiniteTypeMapInterface
{
    /**
     * FiniteTypeMapAbstract constructor.
     *
     * Duplication of type is not allowed.
     * If there exists a duplicate type, an exception will be thrown.
     *
     * @param string[] ...$types
     * @throws DuplicateSupportedTypeException
     */
    protected function __construct(string ...$types)
    {
        $typesReversed = [];
        foreach ($types as $type) {
            if (isset($typesReversed[$type])) {
                throw new DuplicateSupportedTypeException;
            }
            $typesReversed[$type] = true;
        }

        $this->types = $types;
        $this->typesReversed = $typesReversed;
    }

    /**
     * @inheritdoc
     */
    final public function list(): array
    {
        return $this->types;
    }

    /**
     * @inheritdoc
     */
    final public function supports(string $type): bool
    {
        return isset($this->typesReversed[$type]);
    }

    /**
     * Supported types.
     * @var string[] [$type, ...]
     */
    private $types = [];

    /**
     * Reversed supported types.
     * @var bool[] [$type => true, ...]
     */
    private $typesReversed = [];
}