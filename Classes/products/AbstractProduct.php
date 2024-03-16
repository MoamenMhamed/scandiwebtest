<?php

abstract class AbstractProduct
{
    private $data;
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    abstract public function getData();
    public function getSku()
    {
        return $this->data["sku"];
    }
    public function setSku($sku)
    {
        $this->data["sku"] = $sku;
    }

    public function getName(): string
    {
        return $this->data["name"];
    }
    public function setName($name)
    {
        $this->data["name"] = $name;
    }

    public function getPrice()
    {
        return $this->data["price"];
    }
    public function setPrice()
    {
        $this->data["price"] = $price;
    }
    public function getSize()
    {
        return $this->data["size"];
    }
    public function setSize()
    {
        $this->data["size"] = $size;
    }
    public function getWeight()
    {
        return $this->data["weight"];
    }
    public function setWeight($weight)
    {
        $this->data["weight"] = $weight;
    }
    public function getHeight()
    {
        return $this->data["height"];
    }
    public function setHeight($height)
    {
        $this->data["height"] = $height;
    }
    public function getWidth()
    {
        return $this->data["width"];
    }
    public function setWidth($width)
    {
        $this->data["width"] = $width;
    }
    public function getLength()
    {
        return $this->data["length"];
    }
    public function setLength($length)
    {
        $this->data["length"] = $length;
    }

    public static function all()
    {
        return Database::query("SELECT * FROM products ORDER BY id ASC");
    }

    public function add()
    {
        $sql = "INSERT INTO products (sku, name, price, size, weight, height, width, length)
         VALUES (:sku, :name, :price, :size, :weight, :height, :width, :length)";
        $params = [
            ":sku" => $this->getSku(),
            ":name" => $this->getName(),
            ":price" => $this->getPrice(),
            ":size" => $this->getSize(),
            ":weight" => $this->getWeight(),
            ":height" => $this->getHeight(),
            ":width" => $this->getWidth(),
            ":length" => $this->getLength(),
        ];

        return Database::query($sql, $params);
    }
    public static function delete($id)
    {
        return Database::query("DELETE FROM products WHERE id=:id", [
            ":id" => $id,
        ]);
    }
}
