<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Image;
use App\Http\Requests\CreateProductResquest;
use App\Http\Requests\EditProductRequest;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Str;
use Session;

class ProductController extends Controller
{
    private $productRepository;
    private $categoryRepository;

    public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productRepository->getAllWithPaginate();

        return view('admin.include.product')->with('products', $products)
                                                  ->with('index', true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =  $this->categoryRepository->getCategoryChildrens();
        if (count($categories) == config('setting.default_value_0')) {
            Session::flash('info', @trans('message.info.category.create_category'));

            return redirect()->back();
        }

        return view('admin.products.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductResquest $request)
    {
        $attribute = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'quantity' => $request->quantity,
            'category_id' => $request->categories,
            'rating' => config('setting.default_value_0'),
            'slug' => Str::slug($request->name),
        ];
        $product = $this->productRepository->create($attribute);

        $this->storeImage($request, $product, true);
        Session::flash('success', @trans('message.success.product.store_product'));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $product = $this->categoryRepository->getById($id);
        } catch (\Exception $e) {
            Session::flash('fail', @trans('message.fail.product.edit_product'));

            return redirect()->back();
        }
        $categories =  $this->categoryRepository->getCategoryChildrens();

        return view('admin.products.edit')->with('product', $product)
                                                ->with('categories', $categories);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditProductRequest $request, $id)
    {
        try {
            $product = $this->categoryRepository->getById($id);
            $this->storeImage($request, $product, false);

            $attribute = [
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'discount' => $request->discount,
                'quantity' => $request->quantity,
                'category_id' => $request->categories,
                'rating' => $request->quantity,
                'slug' => Str::slug($request->name),
            ];

            $product = $this->productRepository->update($id, $attribute);
        } catch (\Exception $e) {
            Session::flash('fail', @trans('message.fail.product.edit_product'));

            return redirect()->back();
        }
        Session::flash('success', @trans('message.success.product.update_product'));

        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->productRepository->delete($id)){
            Session::flash('success',  @trans('message.success.product.trashed_product'));

            return redirect()->route('admin.product.index');
        }
        Session::flash('fail', @trans('message.fail.product.edit_product'));

        return redirect()->route('admin.product.index');
    }

    public function trashed()
    {
        $products = $this->productRepository->trashed();

        return view('admin.include.product')->with('products', $products)
                                                   ->with('index', false);
    }

    public function kill($id)
    {
        if ($this->productRepository->kill($id)){
            Session::flash('success',  @trans('message.success.product.delete_product'));
        }

        return redirect()->back();
    }

    public function restore($id)
    {
        if ($this->productRepository->restore($id)){
            Session::flash('success', @trans('message.success.product.restore_product'));
        }

        return redirect()->route('product.trashed');
    }

    public function storeImage($request, $product, $check){

        $this->productRepository->storeImage($request, $product, $check);
    }
}
