<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Rating\RatingRepositoryInterface;
use DB;

class ProductDetailController extends Controller
{
    private $ratingRepository;
    private $productRepository;

    public function __construct(
        RatingRepositoryInterface $ratingRepository,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->ratingRepository = $ratingRepository;
        $this->productRepository = $productRepository;
    }

    public function getProductDetail($id)
    {
        $product = $this->productRepository->getProductDetail($id);
        $productSimilars = $this->productRepository->getproductSimilar();
        $rate = count($this->ratingRepository->getProductId($id));
        $sumrate = $this->ratingRepository->sumRating($id);
        if ($rate == config('config.zero')) {
            $tbrate = config('config.zero');
        } else {
            $tbrate = (int)($sumrate / $rate);
        }
        $rates = $this->ratingRepository->getWithUser($id);

        return view('client.product.detail', compact('product', 'productSimilars', 'tbrate', 'rates'));
    }
}
