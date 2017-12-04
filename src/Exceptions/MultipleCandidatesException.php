<?php

namespace Bellisq\TypeMap\Exceptions;

use Bellisq\TypeMap\Exceptions\TypeMapException;


/**
 * [ Exception ] Multiple Candidates
 * 
 * TypeMapAggregate does not check Object Type Duplication at construction.
 * If multiple type-maps returns true for `has` method, this exception will be thrown.
 *
 * @author 4kizuki <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/type-map
 * @since 1.0.0
 */
class MultipleCandidatesException extends TypeMapException
{

    public function generateMessage(string $type): string
    {
        return "Multiple candidates are found for the type {$type}.";
    }

}
