<?php

namespace Bellisq\TypeMap\Utility;

use Bellisq\TypeMap\Base\FiniteTypeMapAbstract;
use Bellisq\TypeMap\FiniteTypeMapInterface;


/**
 * [Class] Finite Type-map Aggregate
 *
 * Note: This class follows first-in-last-out principle.
 * Assume there are two finite type-maps --`$typeMapA` and `$typeMapB`-- supporting `ClassC`.
 * Thus, the statement `(new FiniteTypeMapAggregate($typeMapA, $typeMapB))->get('ClassC');`
 * will call `$typeMapB->get('ClassC');`.
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 2.0.0
 */
class FiniteTypeMapAggregate
    extends FiniteTypeMapAbstract
{
    /**
     * FiniteTypeMapAggregate constructor.
     *
     * @param FiniteTypeMapInterface[] ...$typeMaps
     */
    public function __construct(FiniteTypeMapInterface ...$typeMaps)
    {
        $providerMap = [];

        foreach ($typeMaps as $typeMap) {
            if ($typeMap instanceof self) {
                $providerMap = array_merge($providerMap, $typeMap->providerMap);
            } else {
                /** @var string $type */
                foreach ($typeMap->list() as $type) {
                    $providerMap[$type] = $typeMap;
                }
            }
        }

        $this->providerMap = $providerMap;
        parent::__construct(...array_keys($providerMap));
    }

    /**
     * @inheritdoc
     */
    final protected function getObject(string $type): object
    {
        assert(isset($this->providerMap[$type]));
        return $this->providerMap[$type]->get($type);
    }

    /** @var FiniteTypeMapInterface[] */
    private $providerMap;
}