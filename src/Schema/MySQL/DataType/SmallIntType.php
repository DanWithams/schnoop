<?php
/**
 * Created by PhpStorm.
 * User: courtney
 * Date: 19/06/16
 * Time: 9:21 AM
 */

namespace MilesAsylum\Schnoop\Schema\MySQL\DataType;

class SmallIntType extends AbstractIntType
{
    public function __construct($displayWidth, $signed)
    {
        $minRange = $signed ? -32768 : 0;
        $maxRange = $signed ? 32767 : 65535;

        parent::__construct($displayWidth, $signed, $minRange, $maxRange);
    }

    public function getType()
    {
        return self::TYPE_SMALLINT;
    }
}