<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\FeedbackRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    private $categoryRepository;
    private $productRepository;
    private $feedbackRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository, ProductRepositoryInterface $productRepository, FeedbackRepositoryInterface $feedbackRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->feedbackRepository = $feedbackRepository;
    }
    public function index(){

        return view('index')->with('categories', $this->categoryRepository->getAll())
                                  ->with('products', $this->productRepository->getAllWithPaginate());
    }

    public function singleProduct($slug){
        try {
            $product = $this->productRepository->getBySlug($slug);
            $category = $this->categoryRepository->getById($product->category_id);
        } catch (\Exception $e) {
            Session::flash('fail', $e);

            return redirect()->back();
        }
        $popular_products = $this->productRepository->whereAdvanced('rating', '>' , config('setting.default_value_star'));;
        $feedbacks = $this->feedbackRepository->where('product_id', $product->id);

        return view('single')->with('categories', $this->categoryRepository->getAll())
                                   ->with('category', $category)
                                   ->with('popular_products', $popular_products)
                                   ->with('product', $product)
                                   ->with('feedbacks', $feedbacks);
    }

    public function singleCategory($slug){
        try {
            $category = $this->categoryRepository->getBySlug($slug);
            $products = $category->products;
        } catch (\Exception $e) {
            Session::flash('fail', $e);

            return redirect()->back();
        }

        return view('category')->with('categories', $this->categoryRepository->getAll())
                                     ->with('category', $category)
                                     ->with('products', $products);

    }

    public function feedback($id , $rating, Request $request)
    {
        $content = $request->input('content');
        $attribute = [
            'user_id' => auth()->id(),
            'product_id' => $id,
            'content' => $content,
            'rating' => $rating,
        ];
        $feedback = $this->feedbackRepository->create($attribute);
        try {
            $data = [
                'rating' => $this->feedbackRepository->calStar($id),
                ];
            $product = $this->productRepository->update($id, $data);
        } catch (\Exception $e) {

        }
        return response()->json([
            'user_name' => auth()->user()->name,
            'feedback' => $feedback,
        ]);
    }
}
