<?php

class Furniture extends AbstractProduct
{
    public function __construct($data)
    {
        parent::__construct($data);
    }

    public function getData()
    {
        $spec =
            "Dimension: " .
            $this->getHeight() .
            "X" .
            $this->getWidth() .
            "X" .
            $this->getLength();

        $jsonList = [
            "sku" => $this->getSku(),
            "name" => $this->getName(),
            "price" => $this->getPrice(),
            "spec" => $spec,
        ];

        return $jsonList;
    }
}
