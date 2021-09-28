<?php

namespace App\Providers\Mapping;

use App\Models\Akeneo\AkeneoProduct;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

//* todo rename to AkeneoCatalogProvider*/
class AkeneoProvider
{
    protected $akeneoClient;
    protected $httpClient;
    public $attributes;
    public $family_code;
    public $shopifyProductProvider;
    public $akeneo_variant_sufix = 'variant';
    public $shopify_attribute_prefix = 'shopify_';

    public function __construct(ShopifyProductProvider $shopifyProductProvider) {
        $this->shopifyProductProvider = $shopifyProductProvider;
        $clientBuilder = new \Akeneo\Pim\ApiClient\AkeneoPimClientBuilder('http://localhost:8080');
        $this->akeneoClient =  $clientBuilder->buildAuthenticatedByPassword('1_5k5q0w5ycesc0og08woc480so88ccgw4ksk4sko000c08soc44', '2lkogpe2ey80ow0kogs4s08s408o0wogwc884oso0swco8s8kk', 'testphpclient_2830', 'c6841febe');

        $this->refreshAkeneoAttributes();
        $this->family_code = "Shopify_".$this->shopifyProductProvider->getFamily();
    }
    /**
     * get all attributes
     * @return array of attributes => types
     **/
    private function refreshAkeneoAttributes() {

        $items = $this->akeneoClient->getAttributeApi()->listPerPage(100, true);
        foreach ($items->getItems() as $item) {
            $this->attributes[$item['code']] = $item['type'];
        }

    }

    public function setFamily() {
        echo $this->family_code;
        $data = [
            "labels" =>  [
                "en_US" => $this->family_code,
            ],
            "attributes" => array_merge(array_keys($this->shopifyProductProvider->getProductAttributes()), ['picture','name']),
            "attribute_as_label" => "name",
            "attribute_as_image" => "picture",
            "attribute_requirements" => [
                "ecommerce" =>  [
                    "shopify_price",
                    "shopify_sku"
                ]
            ]
        ];
        $this->akeneoClient->getFamilyApi()->upsert($this->family_code, $data);
    }
   public function setFamilyVariants() {

       if (count($this->shopifyProductProvider->getProductOptions())>=1) {
           $i = 0;
           $variants = [];
           $variant_name = '';
           foreach ($this->shopifyProductProvider->getProductOptions() as $key => $variant) {
               $i++;
               $variants[] = [
                   'level' => $i,
                   'axes' => array($key),
                   'attributes' => array($key),
               ];
               $variant_name .= $this->cleanVariantName($key).'_';
           }
           $variant_name.='variant';
           $data = [
               "labels" => [
                   "en_US" =>$variant_name,
               ],
               "variant_attribute_sets" => $variants
           ];
           $response =  $this->akeneoClient->getFamilyVariantApi()->upsert($this->family_code, $variant_name, $data);
           return $data;

       }
       return [];
   }

   public function setAttribute() {
       $this->akeneoClient->getAttributeGroupApi()->get('shopify');
       $list = [];
       foreach ($this->shopifyProductProvider->getProductAttributes() as $shopify_attribute_key => $shopify_attribute_value){
          // echo '<pre>';print_r(  $shopify_attribute_value);
               $list[] =  [
                   'code'                   => $shopify_attribute_key,
                   'type'                   => is_array($shopify_attribute_value) && $shopify_attribute_value['s_type']? $shopify_attribute_value['s_type']: 'pim_catalog_text' ,
                   'group'                  => 'shopify',
                   'unique'                 => false,
                   'useable_as_grid_filter' => true,
                   'allowed_extensions'     => [],
                   'metric_family'          => null,
                   'default_metric_unit'    => null,
                   'reference_data_name'    => null,
                   'available_locales'      => [],
                   'max_characters'         => null,
                   'validation_rule'        => null,
                   'validation_regexp'      => null,
                   'wysiwyg_enabled'        => null,
                   'number_min'             => null,
                   'number_max'             => null,
                   'decimals_allowed'       => null,
                   'negative_allowed'       => null,
                   'max_file_size'          => null,
                   'minimum_input_length'   => null,
                   'sort_order'             => 1,
                   'localizable'            => false,
                   'scopable'               => false,
                   'labels'                 => [
                       'en_US' => $shopify_attribute_key,
                       'fr_FR' => $shopify_attribute_key,
                   ]
               ];

       }

       $this->akeneoClient->getAttributeApi()->upsertList($list);

       $options =[];
       foreach ($this->shopifyProductProvider->getProductOptions() as $option_key => $option_value) {
           foreach ($option_value as $value) {
               $options[] = [
                   'code'       => $option_key,
                   'attribute'  => $value,
                   'sort_order' => 2,
                   'labels'     => [
                       'en_US' =>  $option_key
                   ]
               ];
           }
           $this->akeneoClient->getAttributeOptionApi()->upsertList($option_key, $options);
       }

    $this->refreshAkeneoAttributes();
   }

   public function getAttributes($code) {
       $searchBuilder = new \Akeneo\Pim\ApiClient\Search\SearchBuilder();
       $searchBuilder
           ->addFilter('code', 'IN', [$code]);
       $searchFilters = $searchBuilder->getFilters();

       // get a cursor with a page size of 50, apply a search
       return  $this->akeneoClient->getAttributeGroupApi()->listPerPage(100, true, ['search' => $searchFilters])->getItems();

   }



    public function getFamily() {

        return $this->akeneoClient->getFamilyApi()->get($this->family_code);
    }
    public function getFamilyVariants(): array {
        $variant_code = $this->generateVariantCode();
        if ($variant_code)
            return $this->akeneoClient->getFamilyVariantApi()->get($this->family_code, $this->generateVariantCode());
        return [];
    }





    public function dataMapping() {
        return [
            "identifier" => "id",
            "enabled" => true,
            "family"=> "shopify_vendor",
            "categories"=> [
                "summer_collection"
            ],
            "groups"=> [],
            "parent"=> "product_id",
            //"values"=>

        ];
    }
    /**
     * @param products array: shopify variants
     **/
    public function setProducts($shopify_products) {
        $attributes = $this->getFamily()['attributes'];
        $options = array_keys($this->shopifyProductProvider->getProductOptions());
        foreach ($shopify_products as $shopify_product) {
           // echo '<pre>';print_r($shopify_product);
            foreach ($attributes as $key) {
                if(isset($shopify_product[$key])) {
                    $dd[$key] = [
                        "data" => $shopify_product[$key],
                        "locale" => "en_US",
                        "scope" => null
                    ];
                }
            }
            $i=0;
            foreach ($options as $str) {
                $option = 'option'.($i+1);
                    $dd[$options[$i]] = [
                        "data" => $shopify_product[$option],
                        "locale" => "en_US",
                        "scope" => null
                    ];
                    $i+=1;

            }
            $products[] = [
                "identifier" => $shopify_product['shopify_id'],// replace with data map
                "enabled" => true,
                "family"=> $this->family_code,
                "categories"=> [
                    "summer_collection"
                ],
                "groups"=> [],
                "parent"=> $shopify_product['shopify_product_id'],
                "values"=> $dd

            ];

        }
        return $products;
    }
    private function generateVariantCode() {

        $variant_name = '';
        foreach (array_keys($this->shopifyProductProvider->getProductOptions()) as $kk) {
            $variant_name .= $this->cleanVariantName($kk).'_';
        }
        $variant_name .= $this->akeneo_variant_sufix;
        return $variant_name;
    }
    private function cleanVariantName($key) {
        return str_replace($this->shopify_attribute_prefix,'',$key);
    }
}
