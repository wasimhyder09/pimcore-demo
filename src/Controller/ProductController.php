<?php

namespace App\Controller;

use Pimcore\Model\DataObject\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController {
  /**
   * @Route("/product/{id}", name="product_show")
   */
  public function showProduct($id): Response {
    $product = Product::getById($id);

    if (!$product) {
      throw $this->createNotFoundException('The product does not exist');
    }

    return $this->render('product.html.twig', [
      'product' => $product
    ]);
  }

  /**
   * @Route("/products", name="product_list")
   */
  public function listProducts(): Response {
    // Fetch all products
    $products = new Product\Listing();
    $products->setOrderKey("name");
    $products->setOrder("asc");

    return $this->render('products.html.twig', [
      'products' => $products
    ]);
  }
}
