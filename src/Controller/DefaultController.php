<?php

namespace App\Controller;

use App\Providers\Mapping\AkeneoProvider;
use App\Providers\Mapping\ShopifyProductProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DefaultController extends AbstractController
{
     protected $akeneoClient;
     protected $httpClient;
     protected $mapShopifyToAkeneo = [

         "product" => [
             "identifier" => "id",
             "family" =>"product_type",
             "categories" => [],
         ]

     ];


    public function __construct(HttpClientInterface $httpClient) {
        $this->httpClient = $httpClient;
        $clientBuilder = new \Akeneo\Pim\ApiClient\AkeneoPimClientBuilder('http://localhost:8080');
        $this->akeneoClient =  $clientBuilder->buildAuthenticatedByPassword('1_5k5q0w5ycesc0og08woc480so88ccgw4ksk4sko000c08soc44', '2lkogpe2ey80ow0kogs4s08s408o0wogwc884oso0swco8s8kk', 'testphpclient_2830', 'c6841febe');

    }

    /**
     * @Route("/")
     */

    public function index(Request $request): Response {

        $form = $this->createFormBuilder()
            ->add('product_url', TextType::class,['required'=>'true'])
            ->add('save', SubmitType::class, ['label' => 'Create Task'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $form = $form->getData();
            $url = isset($form['product_url'])? $form['product_url']:'https://testingstore855.myshopify.com/products/test.json';
            $response = $this->httpClient->request(
                'GET',
                $url
            );
            $shopify_product         = $response->toArray()['product'];
            $shopifyProductProvider  = new shopifyProductProvider($shopify_product);

            $akeneo = new AkeneoProvider($shopifyProductProvider);
            $akeneo->setAttribute();
            $akeneo->setFamily();
            $akeneo->setFamilyVariants();

            echo "Family Code:".$akeneo->family_code;

            $final_products = $akeneo->setProducts($shopifyProductProvider->extractProducts());
            $akeneo_total_final_products = count($final_products);

            return $this->render('result.html.twig', [
                'shopify_product'  => json_encode($shopify_product),
                'akeneo_attributes'=> json_encode($akeneo->getAttributes('shopify')),
                'akeneo_family'         => json_encode($akeneo->getFamily()),
                'akeneo_family_variants'=>json_encode($akeneo->getFamilyVariants()),
                'shopify_simple_product'=>json_encode($shopifyProductProvider->extractProducts()[0]),
                'akeneo_final_products' =>json_encode($final_products),
                'akeneo_total_final_products' =>$akeneo_total_final_products,
            ]);
        }// end if handling form
        return $this->renderForm('index.html.twig', [
            'form' => $form,
        ]);


    }




}
