<?php

namespace App\Models\Shopify;

class Product
{

    // any attributes you wish to have it in the products, you must add it as an attribute to the family
    public $id;
    public $product_id;
    public $sku;
    public $title;
    public $description;
    public $vendor;
    public $family;
    public $created_at;
    public $updated_at;
    public $published_at;
    public $handle;
    public $tags;
    public $variants;
    public $options;

    public function __construct($data) {
        $this->id           = $data['id'];
        $this->title        = $data['title'];
        $this->vendor       = $data['title'];
        $this->description  = $data['body_html'];
        $this->family       = $data['product_type'];
        $this->tags         = $data['tags'];

        $this->variants     = $data['variants'];
        $this->options      = $data['options'];
    }





}
