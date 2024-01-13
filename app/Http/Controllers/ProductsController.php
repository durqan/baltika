<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddEditProductRequest;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function view()
    {
        return view('products', ['products' => Products::get()]);
    }

    public function addEditProduct(AddEditProductRequest $request)
    {
        try {
            $validated = $request->validated();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        $checkArticleUnique = Products::where('article', $validated['article'])->first();

        if(!empty($checkArticleUnique))
            return 'Артикул должен быть уникальным';

        $data = null;

        if(isset($validated['nameData']))
            $data = json_encode(array_combine($validated['nameData'], $validated['valueData']));

        $newProduct =
            [
                'article' => $validated['article'],
                'name' => $validated['name'],
                'status' => $request['status'],
                'data' => $data
            ];

        Products::addEdit($newProduct, $request['productsId']);

        return 'success';
    }

    public function getProduct(Request $request)
    {
        $product = Products::find($request['id']);
        $product->attributes = '';
        $product->manager_role = env('MANAGER_ROLE');

        foreach ($product['data'] as $key => $value) {
            $product->attributes .= $key . ' : ' . $value . ', ';
        }

        $product->attributes = substr($product->attributes, 0, -2);

        return json_encode($product);
    }

    public function deleteProduct(Request $request)
    {
        Products::destroy($request['id']);
        return $request['id'];
    }
}
