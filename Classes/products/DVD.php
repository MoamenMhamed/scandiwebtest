<?php

class DVD extends AbstractProduct
{
    public function __construct($data)
    {
        parent::__construct($data);
    }

    public function getData()
    {
        $spec = "Size: " . $this->getSize() . " MB";

        $jsonList = [
            "sku" => $this->getSku(),
            "name" => $this->getName(),
            "price" => $this->getPrice(),
            "spec" => $spec,
        ];

        return $jsonList;
    }
}
