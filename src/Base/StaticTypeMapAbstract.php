<?php

namespace Bellisq\TypeMap\Base;

use Bellisq\TypeMap\Base\FiniteTypeMapAbstract;
use Bellisq\TypeMap\StaticTypeMapInterface;


/**
 * [Abstract Class] Static Type-map Abstract
 *
 * DO NOT use this class for type-hinting. Use StaticTypeMapInterface instead.
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 2.0.0
 */
abstract class StaticTypeMapAbstract
    extends FiniteTypeMapAbstract
    implements StaticTypeMapInterface
{
    /**
     * StaticTypeMapAbstract constructor.
     *
     * Call getPredefinedList to initialize FiniteTypeMapAbstract.
     */
    public function __construct()
    {
        parent::__construct(...static::getPredefinedList());
    }

    /**
     * Returns consistent result for a class.
     *
     * @inheritdoc
     */
    final public static function getPredefinedList(): array
    {
        if (!isset(self::$predefinedList[static::class])) {
            self::$predefinedList[static::class] = static::generatePredefinedList();
        }
        return self::$predefinedList[static::class];
    }

    /**
     * Generate the predefined (static) list of supported types.
     *
     * This method will be called only once for a class.
     *
     * @return string[]
     */
    abstract protected static function generatePredefinedList(): array;

    /**
     * @var array[] typeMapName => predefinedList
     */
    private static $predefinedList = [];
}