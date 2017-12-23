<?php

namespace Bellisq\TypeMap\Utility;

use Bellisq\TypeMap\Base\TypeMapAbstract;
use Bellisq\TypeMap\TypeMapInterface;


/**
 * [Class] Type Map Aggregate
 *
 * Note: This class follows first-in-last-out principle.
 * Assume there are two type-maps --`$typeMapA` and `$typeMapB`-- supporting `ClassC`.
 * The statement `(new TypeMapAggregate($typeMapA, $typeMapB))->get('ClassC');` will call `$typeMapB->get('ClassC');`.
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 2.0.0
 */
class TypeMapAggregate
    extends TypeMapAbstract
{
    /**
     * TypeMapAggregate constructor.
     *
     * @param TypeMapInterface[] ...$typeMaps
     */
    public function __construct(TypeMapInterface ...$typeMaps)
    {
        $newTypeMaps = [];

        foreach (array_reverse($typeMaps) as $typeMap) {
            if ($typeMap instanceof self) {
                $newTypeMaps = array_merge($newTypeMaps, $typeMap->typeMaps);
            } else {
                $newTypeMaps[] = $typeMap;
            }
        }

        $this->typeMaps = $newTypeMaps;
    }

    /**
     * @inheritdoc
     */
    final protected function getObject(string $type): object
    {
        assert(isset($this->providerMap[$type]));
        return $this->providerMap[$type]->get($type);
    }

    /**
     * @inheritdoc
     */
    final public function supports(string $type): bool
    {
        foreach ($this->typeMaps as $typeMap) {
            if ($typeMap->supports($type)) {
                $this->providerMap[$type] = $typeMap;
                return true;
            }
        }
        return false;
    }

    /** @var TypeMapInterface[] [type => provider] */
    private $providerMap = [];

    /** @var TypeMapInterface[] */
    private $typeMaps;
}