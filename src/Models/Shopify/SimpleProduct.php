<?php

namespace App\Models\Shopify;

class SimpleProduct
{
    public $shopify_id;
    public $shopify_product_id;// match parent_id
    public $shopify_sku;
    public $shopify_title;
    public $shopify_description;
    public $shopify_vendor;
    public $shopify_family;
    public $shopify_published_scope;
    public $shopify_created_at;
    public $shopify_updated_at;
    public $shopify_published_at;
    public $shopify_handle;
    public $shopify_tags;
    public $shopify_taxable;
    public $shopify_barcode;
    public $shopify_grams;
    public $shopify_image_id;
    public $shopify_weight;
    public $shopify_weight_unit;
    public $shopify_requires_shipping;
    public $shopify_image;

    public $option1;
    public $option2;
    public $option3;


    public function __construct($data, $index=0) {

        $this->shopify_id           = $data['variants'][$index]['id'];
        $this->shopify_sku           = $data['variants'][$index]['sku'];
        $this->shopify_product_id   = $data['id'];
        $this->shopify_title        = $data['title'];
        $this->shopify_vendor       = $data['title'];
        $this->shopify_description  = $data['body_html'];
        $this->shopify_family       = $data['product_type'];
        $this->shopify_tags         = $data['tags'];
        $this->shopify_handle       = $data['handle'];
        $this->shopify_image        = $data['image']['src'];
        $this->shopify_published_scope         = $data['published_scope'];
        $this->shopify_requires_shipping       = $data['variants'][$index]['requires_shipping'];

        $this->shopify_taxable     = $data['variants'][$index]['taxable'];
        $this->shopify_barcode     = $data['variants'][$index]['barcode'];
        $this->shopify_grams       = $data['variants'][$index]['grams'];
        $this->shopify_weight      = $data['variants'][$index]['weight'];
        $this->shopify_weight_unit = $data['variants'][$index]['weight_unit'];

        $this->option1 = $data['variants'][$index]['option1'];
        $this->option2 = $data['variants'][$index]['option2'];
        $this->option3 = $data['variants'][$index]['option3'];


        return $this;
    }
    // load attributes from family



}
