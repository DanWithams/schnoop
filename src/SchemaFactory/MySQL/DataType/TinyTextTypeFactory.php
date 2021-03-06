<?php

namespace MilesAsylum\Schnoop\SchemaFactory\MySQL\DataType;

use MilesAsylum\Schnoop\SchemaFactory\MySQL\DataType\DataTypeFactoryInterface;
use MilesAsylum\SchnoopSchema\MySQL\DataType\DataTypeInterface;
use MilesAsylum\SchnoopSchema\MySQL\DataType\TinyTextType;

class TinyTextTypeFactory implements DataTypeFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createType($typeStr, $collation = null)
    {
        if (!$this->doRecognise($typeStr)) {
            return false;
        }

        $tinyTextType = new TinyTextType();
        $tinyTextType->setCollation($collation);

        return $tinyTextType;
    }

    /**
     * {@inheritdoc}
     */
    public function doRecognise($typeStr)
    {
        return preg_match('/^tinytext$/i', $typeStr) === 1;
    }
}
