<?php

namespace Bellisq\TypeMap\Utility;

use Bellisq\TypeMap\Base\FiniteTypeMapAbstract;
use Bellisq\TypeMap\Exceptions\DuplicateSupportedTypeException;
use InvalidArgumentException;


/**
 * [Class] Object Container
 *
 * Contains multiple objects.
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 2.0.0
 */
class ObjectContainer
    extends FiniteTypeMapAbstract
{
    /**
     * @inheritdoc
     */
    final protected function getObject(string $type): object
    {
        assert(isset($this->typeMap[$type]));
        return $this->typeMap[$type];
    }

    /**
     * ObjectContainer constructor.
     *
     * Give object or array.
     * If an object is given, the type to access the object is considered as `get_class($object)`.
     * If an array is given, the array is considered as `[object, type]`.
     *
     * Here is an example.
     * `new ObjectContainer(new ClassA, new ClassB, [new ChildClass, ParentClass::class])`
     *
     * @param array ...$objects
     * @throws DuplicateSupportedTypeException
     * @throws InvalidArgumentException
     */
    public function __construct(...$objects)
    {
        $typeMap = [];
        $types = [];

        foreach ($objects as $object) {
            if (is_object($object)) {
                $type = get_class($object);
                $value = $object;
            } else if (is_array($object) && self::validateArray($object)) {
                list($value, $type) = $object;
            } else {
                throw new InvalidArgumentException;
            }
            $typeMap[$type] = $value;
            $types[] = $type;
        }

        $this->typeMap = $typeMap;
        parent::__construct(...$types);
    }

    /** @var object[] */
    private $typeMap;

    /**
     * Validate array.
     *
     * @param array $object
     * @return bool
     */
    private static function validateArray(array $object): bool
    {
        return (count($object) === 2)
            && (isset($object[0]))
            && (is_object($object[0]))
            && (isset($object[1]))
            && (is_string($object[1]))
            && ($object[0] instanceof $object[1]);
    }
}