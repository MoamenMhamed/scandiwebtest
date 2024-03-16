<?php

class ProductController
{
    public static function index()
    {
        $products = AbstractProduct::all();
        $component = "/../components/AllProducts.php";
        require_once __DIR__ . "/../frontend/layouts/app.php";
    }

    public static function create()
    {
        $component = "/../components/AddProduct.php";
        require_once __DIR__ . "/../frontend/layouts/app.php";
    }

    public static function add()
    {
        $data = AddProductRequest::validate([
            "sku" => [
                "required" => [],
                "unique" => ["products"],
            ],
            "name" => [
                "required" => [],
                "regular_expression" => ['/[a-zA-Z].*[0-9]|[0-9].*[a-zA-Z]+$/'],
            ],
            "price" => [
                "required" => [],
                "digit" => [],
            ],
            "type" => [
                "required" => [],
                "required_without_all" => [
                    "size",
                    "weight",
                    "height",
                    "width",
                    "length",
                ],
            ],
            "size" => [
                "prohibited_if" => ["DVD"],
                "digit" => [],
            ],
            "weight" => [
                "prohibited_if" => ["Book"],
                "digit" => [],
            ],
            "height" => [
                "prohibited_if" => ["Furniture"],
                "digit" => [],
                "required_with" => ["width", "length"],
            ],
            "width" => [
                "prohibited_if" => ["Furniture"],
                "digit" => [],
                "required_with" => ["height", "length"],
            ],
            "length" => [
                "prohibited_if" => ["Furniture"],
                "digit" => [],
                "required_with" => ["height", "width"],
            ],
        ]);

        if (count(AddProductRequest::getErrors()) == 0) {
            $product = new DVD($data);
            $product->add();
            header(
                "location: " .
                    (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on"
                        ? "https"
                        : "http") .
                    "://" .
                    $_SERVER["SERVER_NAME"] .
                    ":" .
                    $_SERVER["SERVER_PORT"]
            );
        } else {
            $errors = AddProductRequest::getErrors();
            $e = json_encode($errors);
            header("HTTP/1.0 422 $e", true, 422);
        }
    }

    public static function delete()
    {
        if (isset($_POST["products"])) {
            foreach ($_POST["products"] as $product) {
                $id = substr($product, 7, strlen($product) - 7);
                AbstractProduct::delete(intval($id));
                header(
                    "location: " .
                        (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on"
                            ? "https"
                            : "http") .
                        "://" .
                        $_SERVER["SERVER_NAME"] .
                        ":" .
                        $_SERVER["SERVER_PORT"]
                );
            }
        } else {
            header(
                "location: " .
                    (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on"
                        ? "https"
                        : "http") .
                    "://" .
                    $_SERVER["SERVER_NAME"] .
                    ":" .
                    $_SERVER["SERVER_PORT"]
            );
        }
    }
}
