<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProductRequest;
use App\Interfaces\BrandRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AddProductRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    private $productRepository;
    private $categoryRepository;
    private $brandRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository,
        BrandRepositoryInterface $brandRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->brandRepository = $brandRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->getAllCategories();
        $brands = $this->brandRepository->getAllBrands();
        $products = $this->productRepository->searchUserProducts();

        return view('user.products.index', compact('categories', 'brands', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands  = $this->brandRepository->getAllBrands();
        $categories = $this->categoryRepository->getAllCategories();

        return view("user.products.add", compact('brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddProductRequest $request)
    {
        $nameImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->images as $img) {
                $nameImages[] = $nameImage = strtotime(date('Y-m-d H:i:s')) . "_" . $img->getClientOriginalName();
                $img = Image::make($img->getRealPath());
                $img->resize(140, 180, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->stream();
                Storage::disk('product')->put($nameImage, $img, 'public');
            }
        }
        $request['image'] = json_encode($nameImages);
        $request['category_id'] = $request->category;
        $request['brand_id'] = $request->brand;
        $request['user_id'] = Auth::id();
        $newDetails = $request->only(['name', 'price', 'user_id', 'category_id', 'brand_id', 'image', 'description', 'quantity']);
        $this->productRepository->createProduct($newDetails);

        return back()->with('success', __('messages.create.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->getProductById($id);
        if (Gate::allows('edit-delete-product', $product)) {
            return view("user.products.edit", [
                'product' => $product,
                'brands' => $this->brandRepository->getAllBrands(),
                'categories' => $this->categoryRepository->getAllCategories()
            ]);
        }

        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $oldImages = $this->productRepository->getProductById($id)->image;
        $totalImage = count($oldImages);
        $newImages = [];
        if (!empty($request->imageDelete)) {
            $totalImage -= count($request->imageDelete);
        } else {
            $request->imageDelete = [''];
        }
        if ($request->hasFile('imageNew')) {
            $totalImage += count($request->imageNew);
        }
        if ($totalImage <= config('image.max') && $totalImage >= config('image.min')) {
            $oldImages = array_diff($oldImages, $request->imageDelete);
            foreach ($request->imageDelete as $item) {
                Storage::delete('/public/products/' . $item);
            }
            if ($request->hasFile('imageNew')) {
                foreach ($request->imageNew as $item) {
                    $newImages[] = $nameImage = strtotime(date('Y-m-d H:i:s')) . "_" . $item->getClientOriginalName();
                    $img = Image::make($item->getRealPath());
                    $img->resize(140, 180, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->stream();
                    Storage::disk('product')->put($nameImage, $img, 'public');
                }
            }
            $request['image'] = json_encode(array_merge($newImages, $oldImages));
            $request['category_id'] = $request->category;
            $request['brand_id'] = $request->brand;
            $newDetails = $request->only(['name', 'price', 'category_id', 'brand_id', 'image', 'description', 'quantity']);
            $this->productRepository->updateProduct($id, $newDetails);

            return back()->with('success', __('messages.update.success'));
        }

        return back()->with('error', __('messages.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->getProductById($id);
        if (Gate::allows('edit-delete-product', $product)) {
            foreach ($product->image as $item) {
                Storage::delete('/public/products/' . $item);
            }
            $this->productRepository->deleteProduct($id);

            return redirect()->back()->with('message', __('messages.delete.success'));
        }

        return abort(404);
    }
}
