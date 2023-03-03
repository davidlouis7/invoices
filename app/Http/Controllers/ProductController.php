<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends AppBaseController
{
    /**
     * @var ProductRepository
     */
    public $productRepository;

    /**
     * @param  ProductRepository  $productRepo
     */
    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepository = $productRepo;
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|View
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new ProductDataTable())->get())->make(true);
        }

        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->toArray();

        return view('products.create', compact('categories'));
    }

    /**
     * @param  CreateProductRequest  $request
     * @return RedirectResponse
     */
    public function store(CreateProductRequest $request): RedirectResponse
    {
        $input = $request->all();
        $this->productRepository->store($input);
        Flash::success('Product created successfully.');

        return redirect()->route('products.index');
    }

    /**
     * @param  Product  $product
     * @return Application|Factory|View
     */
    public function edit(Product $product)
    {
        $categories = Category::pluck('name', 'id')->toArray();
        $product->load('category');

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * @param  UpdateProductRequest  $request
     * @param  Product  $product
     * @return RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $input = $request->all();
        $this->productRepository->update($input, $product->id);
        Flash::success('Product updated   successfully.');

        return redirect()->route('products.index');
    }

    /**
     * @param  Product  $product
     * @return JsonResponse
     */
    public function destroy(Product $product)
    {
        $invoiceModels = [
            InvoiceItem::class,
        ];
        $result = canDelete($invoiceModels, 'product_id', $product->id);
        if ($result) {
            return $this->sendError(__('messages.flash.product_cant_deleted'));
        }
        $product->delete();

        return $this->sendSuccess('Product Deleted successfully.');
    }

    /**
     * @param  Product  $product
     * @return Application|Factory|View
     */
    public function show(Product $product)
    {
        $product->load('category');

        return view('products.show', compact('product'));
    }
}
