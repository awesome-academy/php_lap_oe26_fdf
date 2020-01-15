<?php
namespace App\Repositories\Product;

use App\Repositories\EloquentRepository;

class ProductRepository extends EloquentRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Product::class;
    }

    public function getProductCategory($id)
    {
        return $this->model->with('images')->where('category_id', $id)->orderBy('id', 'desc')->paginate(config('config.paginate'));
    }

    public function getSearch($request)
    {
        return $this->model->where('name', 'like', '%' . $request->search . '%')
                            ->orWhere('price', $request->search)
                            ->paginate(config('config.paginate'));
    }

    public function getIndex()
    {
        return $this->model->with('images')->orderBy('id', 'desc')->paginate(config('config.paginate'));
    }

    public function getProductDetail($id)
    {
        return $this->model->with('images')->where('id', $id)->first();
    }

    public function getproductSimilar()
    {
        $product = $this->model->first();
        return $this->model->with('images')->where('category_id', $product->category_id)->get();
    }
}
?>
