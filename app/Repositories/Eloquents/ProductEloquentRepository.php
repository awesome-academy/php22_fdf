<?php

namespace App\Repositories\Eloquents;

use App\Models\Image;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;


class ProductEloquentRepository extends EloquentRepository implements ProductRepositoryInterface{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Product::class;
    }

    public function storeImage($request, $product, $check)
    {
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

        return true;
    }

    public function trashed()
    {
        $products = Product::onlyTrashed()->paginate(config('setting.default_value_page'));

        return $products;
    }

    public function kill($id)
    {
        $product = Product::withTrashed()->where('id', $id)->first();
        $product->forceDelete();

        return true;
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->where('id', $id)->first();
        $product->restore();

        return true;
    }

}
