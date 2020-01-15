<?php
namespace App\Repositories\Product;

interface ProductRepositoryInterface
{
    public function getProductCategory($id);

    public function getSearch($request);

    public function getIndex();

    public function getProductDetail($id);

    public function getproductSimilar();
}
?>
