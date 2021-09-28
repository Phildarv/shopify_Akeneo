<?php

namespace App\Models\Shopify;

class Family
{
    private $id;
    private $title;
    private $body_html;
    private $vendor;
    private $product_type;
    private $created_at;
    private $updated_at;
    private $published_at;
    private $handle;
    private $tags;
    private $variants;
    public $options;

    public $identifier;
    public $code;
    public $description;
    public $family;

    public $categories;
    public $groups;
    public $parent;
    public $values;


    public function __construct($data) {
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->body_html = $data['body_html'];
        $this->product_type = $data['product_type'];
        $this->variants = $data['variants'];
        $this->options = $data['options'];

        // product mapping
        $this->identifier = $data['id'];
        $this->code = $data['title'];
        $this->description = $data['body_html'];
        $this->family = $data['product_type'];

    }

    private function mapOptionsShopifyToVariantsAkeneo() {

    }

}
