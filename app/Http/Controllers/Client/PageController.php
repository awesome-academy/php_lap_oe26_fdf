<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class PageController extends Controller
{
    public function getIndex()
    {
        $products = Product::with('images')->orderBy('id', 'desc')->paginate(config('config.paginate'));

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
