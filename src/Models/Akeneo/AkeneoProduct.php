<?php

namespace App\Models\Akeneo;

class AkeneoProduct
{

    public $identifier;
    public $code;
    public $enabled;
    public $family;

    public $categories;
    public $groups;
    public $parent;
    public $values;// define as an object of fixed values


    public function __construct(\App\Models\Shopify\Product $shopifyProduct) {

        $this->identifier = $shopifyProduct->id;
        $this->enabled    = true;
        $this->parent     = $shopifyProduct-> product_id; //product model
        $this->code       = $shopifyProduct->id; //remove
        $this->values = [
            "name"        => ["data"=> $shopifyProduct->title, "local"=>"en_US", "scope"=>null],
            "description" => ["data"=> $shopifyProduct->description, "local"=>"en_US", "scope"=>null],
            "price"       => ["data"=> [
                [
                    "amount" => $shopifyProduct->price,
                    "currency" => "EUR", //todo define currency as constant
                ]
            ], "local"=>"en_US", "scope"=>null],
        ];

    }



}
