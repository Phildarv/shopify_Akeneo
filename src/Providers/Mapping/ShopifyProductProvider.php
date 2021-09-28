<?php

namespace App\Providers\Mapping;


use App\Models\Shopify\Product;
use App\Models\Shopify\SimpleProduct;

class ShopifyProductProvider
{

    public $shopify_product;
    public $akeneo_product;
    public $data;

    //*todo remove product object*/
    public function __construct($data) {
        $this->shopify_product = new Product($data);
        $this->data =$data;
    }

    public function getFamily() {
        return ($this->data['product_type']!='')? $this->data['product_type']:'Default';
    }

    public function toArray(): array {
        return (array) get_object_vars($this->akeneo_product);
    }

    public function isSimple(): bool {
        return (count($this->shopify_product->options) == 1 && count($this->shopify_product->variants)==1);
    }

    public function getProductAttributes(): array {
        $attributes =  [
            /*"sku",
            "name",
            "description",
            "price",
            "picture",

            "title",
            "body_html",
            "vendor",
            "handle",
            "published_scope",
            "tags",
            "images",
            "image",
            "position",
            "compare_at_price",
            "fulfillment_service",
            "inventory_management",
            "taxable",
            "barcode",
            "grams",
            "weight",
            "weight_unit",
*/
            "shopify_sku"=> [
                "s_type" => "pim_catalog_text"
            ],
            "shopify_name"=> [
                "s_type" => "pim_catalog_text"
            ],
            "shopify_description"=> [
                "s_type" => "pim_catalog_text"
            ],
            "shopify_price"=> [
                "s_type" => "pim_catalog_text"
            ],
            "shopify_picture"=> [
                "s_type" => "pim_catalog_image"
            ],

            "shopify_title"=> [
                "s_type" => "pim_catalog_text"
            ],
            "shopify_body_html"=> [
                "s_type" => "pim_catalog_text"
            ],
            "shopify_vendor"=> [
                "s_type" => "pim_catalog_text"
            ],
            "shopify_handle"=> [
                "s_type" => "pim_catalog_text"
            ],
            "shopify_published_scope"=> [
                "s_type" => "pim_catalog_text"
            ],
            "shopify_tags"=> [
                "s_type" => "pim_catalog_text"
            ],
            "shopify_images"=> [
                "s_type" => "pim_catalog_image"
            ],
            "shopify_image"=> [
                "s_type" => "pim_catalog_image"
            ],
            "shopify_position"=> [
                "s_type" => "pim_catalog_text"
            ],
            "shopify_compare_at_price"=> [
                "s_type" => "pim_catalog_text"
            ],
            "shopify_fulfillment_service"=> [
                "s_type" => "pim_catalog_text"
            ],
            "shopify_inventory_management"=> [
                "s_type" => "pim_catalog_text"
            ],
            "shopify_taxable"=> [
                "s_type" => "pim_catalog_text"
            ],
            "shopify_barcode"=> [
                "s_type" => "pim_catalog_text"
            ],
            "shopify_grams"=> [
                "s_type" => "pim_catalog_text"
            ],
            "shopify_weight"=> [
                "s_type" => "pim_catalog_text"
            ],
            "shopify_weight_unit"=> [
                "s_type" => "pim_catalog_text"
            ]
        ];
        $options = [];//todo change to array_filter
        foreach (array_keys($this->getProductOptions()) as $option) {
            $options[$option] = [
                "s_type" => "pim_catalog_simpleselect"
            ];
        }

       return array_merge($attributes,$options);
    }
    /* get product options values >> match variants in family*/
    public function getProductOptions() {
        $options = [];
        if (is_array($this->shopify_product->options)) {
            foreach ($this->shopify_product->options as $option ) {
                    if(strtolower($option['name'])=='title') {
                        $options["shopify_option_1"] = $option['values'];
                    } else {
                        $options["shopify_".strtolower($option['name'])] = $option['values'];
                    }
            }
        }

            return $options;
    }


    // todo use factory pattern
    // return array of products
    public function extractProducts() {
        if ($this->isSimple()) {
            $dd[] = get_object_vars(new SimpleProduct($this->data));
        } else {
          // echo '<pre>'; print_r($this->data);
            for($i=0; $i<count($this->data['variants']); $i++) {


                $dd[] = get_object_vars(new SimpleProduct($this->data, $i));
            }
        }
        return $dd;
    }




}

