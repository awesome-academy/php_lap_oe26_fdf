<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepositoryInterface;

class PageController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getIndex()
    {
        $products = $this->productRepository->getIndex();

        return view('client.page.index', compact('products'));
    }

    public function getAbout()
    {
        return view('client.page.about');
    }

    public function getContact()
    {
        return view('client.page.contact');
    }
}
