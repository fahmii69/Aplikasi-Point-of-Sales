<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Products\Category;
use App\Models\Products\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Constructor
     */
    public function __construct(
        protected string $title = "Product",
        protected string $route = "product.",
        protected string $routeView = "master_data.product.",
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->routeView . "index", [
            'title'    => $this->title,
        ]);
    }

    public function getProduct(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::latest('id');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $route = "/product/$data->id/edit";
                    return view('components.action-button', compact('data', 'route'));
                })
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::get();
        // $model=DB::table('model')->get();
        // $brand=DB::table('brand')->get();
        $supplier = Supplier::get();
        // $modifier=DB::table('modifier')->get();
        // $attribute=DB::table('attribute')
        // ->orderBy('Attribute_Name')
        // ->get();

        // return view('admin.product.product',compact('category','model','brand','supplier','attribute','modifier'));
        return view($this->routeView . "form", [
            'title'    => "Add {$this->title}",
            'product' => new Product(),
            'supplier' => $supplier,
            'category' => $category,
            'action'   => route($this->route . "create"),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
