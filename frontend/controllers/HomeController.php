<?php

    require_once 'controllers/Controller.php';
    require_once 'models/Product.php';

    class HomeController extends Controller {

      public function index() {

//        $product_model = new Product();
//        $products_new = $product_model->getProductNew();
//
//        echo "<pre>";
//        print_r($products_new);
//          echo "</pre>";


        $this->content = $this->render('views/homes/index.php');

        require_once 'views/layouts/main.php';
      }
}