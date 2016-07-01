<?php
/**
 * Created by PhpStorm.
 * User: courtney
 * Date: 26/06/16
 * Time: 5:12 PM
 */

namespace MilesAsylum\Schnoop\Schema\MySQL\DataType;

class VarBinaryType extends AbstractBinaryType
{
    /**
     * @return string
     */
    public function getType()
    {
        return self::TYPE_VARBINARY;
    }

    public function allowDefault()
    {
        return true;
    }
}