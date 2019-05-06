<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Image;
use App\Http\Requests\CreateProductResquest;
use App\Http\Requests\EditProductRequest;
use Illuminate\Support\Str;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(config('setting.default_value_page'));

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
        $categories = Category::where('parent_id', '>', config('setting.default_value_0'))->pluck('name', 'id')->toArray();
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
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'quantity' => $request->quantity,
            'category_id' => $request->categories,
            'rating' => config('setting.default_value_0'),
            'slug' => Str::slug($request->name),
        ]);
        $product->save();

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
            $product = Product::findOrFail($id);
        } catch (\Exception $e) {
            Session::flash('fail', @trans('message.fail.product.edit_product'));

            return redirect()->back();
        }
        $categories =  Category::where('parent_id', '>', config('setting.default_value_0'))->pluck('name', 'id')->toArray();

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
            $product = Product::findOrFail($id);
            $this->storeImage($request, $product, false);

            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->discount = $request->discount;
            $product->quantity = $request->quantity;
            $product->category_id = $request->categories;
            $product->discount = $request->discount;
            $product->quantity = $request->quantity;
            $product->slug = Str::slug($request->name);
            $product->save();
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
        try {
            $product = Product::findOrFail($id);
            $product->delete();
        } catch (\Exception $e) {
            Session::flash('fail', @trans('message.fail.product.edit_product'));

            return redirect()->route('admin.product.index');
        }
        Session::flash('success',  @trans('message.success.product.trashed_product'));

        return redirect()->route('admin.product.index');
    }

    public function trashed()
    {
        $products = Product::onlyTrashed()->paginate(config('setting.default_value_page'));

        return view('admin.include.product')->with('products', $products)
                                                   ->with('index', false);
    }

    public function kill($id)
    {
        $product = Product::withTrashed()->where('id', $id)->first();
        $product->forceDelete();
        Session::flash('success',  @trans('message.success.product.delete_product'));

        return redirect()->back();
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->where('id', $id)->first();
        $product->restore();
        Session::flash('success', @trans('message.success.product.restore_product'));

        return redirect()->route('product.trashed');
    }

    public function storeImage($request, $product, $check){
        if ($request->hasFile('image')) {
            if (!$check){
                $images_old = $product->images;
                foreach ($images_old as $image_old) {
                    $file = 'app/public/uploads/cover_images/' . $image_old->url;
                    if (file_exists(storage_path($file))) {
                        unlink(storage_path($file));
                    }
                }
                Image::where('product_id', $product->id)->delete();
            }
            foreach ($request->file('image') as $image) {
                $filenameWithExt = $image->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $image->storeAs('public/uploads/cover_images', $fileNameToStore);

                $image = new Image([
                    'product_id' => $product->id,
                    'url' => $fileNameToStore,
                ]);
                $image->save();
            }
        }
        elseif ($check){
            $fileNameToStore = 'noimage.png';
            $image = new Image([
                'product_id' => $product->id,
                'url' => $fileNameToStore,
            ]);
            $image->save();
        }
    }
}
