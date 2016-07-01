<?php
/**
 * Created by PhpStorm.
 * User: courtney
 * Date: 19/06/16
 * Time: 10:25 AM
 */

namespace MilesAsylum\Schnoop\Schema\MySQL\DataType;

class FloatType extends AbstractNumericPointType
{
    public function getType()
    {
        return self::TYPE_FLOAT;
    }
    
    public function cast($value)
    {
        return (float)$value;
    }
}