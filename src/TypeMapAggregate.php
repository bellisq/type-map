<?php

namespace Bellisq\TypeMap;

use Bellisq\TypeMap\TypeMapInterface;
use Bellisq\TypeMap\Exceptions\ObjectNotFoundException;
use Bellisq\TypeMap\Exceptions\TooManyCandidatesException;


class TypeMapAggregate implements TypeMapInterface
{

    /** @var TypeMapInterface[] */
    private $typeMaps;

    public function __construct(TypeMapInterface ...$it)
    {
        $this->typeMaps = $it;
    }

    public function get(string $type)
    {
        if (0 === $this->countNum($type)) {
            throw new ObjectNotFoundException($type);
        }
        if (1 === $this->countNum($type)) {
            return $this->typeMapCache[$type]->get($type);
        }
        throw new TooManyCandidatesException($type);
    }

    public function has(string $type): bool
    {
        return $this->countNum($type) === 1;
    }

    /** @var int[] */
    private $countCache = [];

    /** @var TypeMapInterface[] */
    private $typeMapCache = [];

    private function countNum(string $type): bool
    {

        if (isset($this->countCache[$type])) {
            return $this->countCache[$type];
        }

        $c = 0;
        foreach ($this->typeMaps as $typeMap) {
            if ($typeMap->has($type)) {
                $this->typeMapCache[$type] = $typeMap;
                $c++;
            }
        }

        return $this->countCache[$type] = $c;
    }

}
