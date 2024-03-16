<?php

class Book extends AbstractProduct
{
    public function __construct($data)
    {
        parent::__construct($data);
    }

    public function getData()
    {
        $spec = "Weight: " . $this->getWeight() . " KG";
        $jsonList = [
            "sku" => $this->getSku(),
            "name" => $this->getName(),
            "price" => $this->getPrice(),
            "spec" => $spec,
        ];

        return $jsonList;
    }
}
