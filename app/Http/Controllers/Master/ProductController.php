<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\Product\StoreProductRequest;
use App\Models\Products\Brand;
use App\Models\Products\Category;
use App\Models\Products\Modifier;
use App\Models\Products\Product;
use App\Models\Products\ProductModifier;
use App\Models\Products\ProductTag;
use App\Models\Stocks\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $data = Product::latest('id')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('supplier_code', function ($data) {
                    return $data->supplier->supplier_name;
                })
                ->editColumn('category_code', function ($data) {
                    // dd($data->category);
                    return $data->category->category_name;
                })
                ->editColumn('brand_code', function ($data) {
                    // dd($data->brand);
                    return $data->brand->brand_name;
                })
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
        $brand    = Brand::get();
        $supplier = Supplier::get();
        $modifier = Modifier::get();
        // $attribute=DB::table('attribute')
        // ->orderBy('Attribute_Name')
        // ->get();

        return view($this->routeView . "form", [
            'title'    => "Add {$this->title}",
            'product'  => new Product(),
            'supplier' => $supplier,
            'category' => $category,
            'brand'    => $brand,
            'modifier' => $modifier,
            'action'   => route($this->route . "store"),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        DB::beginTransaction();

        $karakter = "ABCDEVGHIJKLMNOPQRSTUVWXYZ";
        $pin = rand(0, 9999999) . $karakter[rand(0, strlen($karakter) - 1)];
        $string = str_shuffle($pin);
        $code = "PDT-" . $string;

        try {

            $product = new Product($request->safe(
                ['product_name', 'product_price', 'brand_code', 'supplier_code', 'category_code', 'type_product']
            ));
            $product->product_code = $code;

            // dd($product);
            if (isset($request->tag_code)) {
                foreach ($request->tag_code as $item) {
                    ProductTag::create([
                        "product_code" => $code,
                        "tag_name" => $item,
                    ]);
                };
            }
            if (isset($request->modifier_code)) {
                foreach ($request->modifier_code as $item) {
                    $karakter = "ABCDEVGHIJKLMNOPQRSTUVWXYZ";
                    $pin = mt_rand(0, 9999999) . $karakter[rand(0, strlen($karakter) - 1)];
                    $string = str_shuffle($pin);
                    $modifierCode = "MPDT-" . $string;

                    ProductModifier::create([
                        'product_modifierCode' => $modifierCode,
                        'product_code' => $code,
                        'modifier_code' => $item,
                        'status' => 'No',
                    ]);
                }

                // $karakter = "ABCDEVGHIJKLMNOPQRSTUVWXYZ";
                //         $pin = mt_rand(0, 9999999) . $karakter[rand(0, strlen($karakter) - 1)];
                //         $string = str_shuffle($pin);
                //         $stockCode = "STK-" . $string;

                //         $Stock = new Stock;
                //         $Stock->Stock_Code = $stockCode;
                //         $Stock->Shop_Code = session('globalShop');
                //         $Stock->Product_Code = $code;
                //         $Stock->Variant_Code = $varCode;
                //         $Stock->Stock_Quantity = $item['Current_Inventory'];
                //         $Stock->Synchronized = 'No';
                //         $Stock->save();

                // if ($request->Options == 1) {
                //     $listVariant = $request->listVariant;
                //     foreach ($listVariant as $item) {
                //         $varKarakter = "ABCDEVGHIJKLMNOPQRSTUVWXYZ";
                //         $varPin = mt_rand(0, 9999999) . $varKarakter[rand(0, strlen($varKarakter) - 1)];
                //         $varString = str_shuffle($varPin);
                //         $varCode = "PROD-" . $varString;
                //         $variantName = str_replace(",", " / ", $item['ValueCheck']);
                //         VariantProduct::create([
                //             "Variant_Code" => $varCode,
                //             "Product_Code" => $code,
                //             "ListVariant" => $item['ValueCheck'],
                //             "Variant_Name" => $variantName,
                //             "Product_BuyPrice" => $item['Product_BuyPrice'],
                //             "Product_BarCode" => $item['Product_Barcode'],
                //             "Product_Price" => $item['Product_Price'],
                //             "Reorder_Quantity" => $item['Reorder_Quantity'],
                //             "Product_TaxRate" => $item['Product_Tax'],
                //             "Synchronized" => "No",
                //         ]);

                //         $karakter = "ABCDEVGHIJKLMNOPQRSTUVWXYZ";
                //         $pin = mt_rand(0, 9999999) . $karakter[rand(0, strlen($karakter) - 1)];
                //         $string = str_shuffle($pin);
                //         $stockCode = "STK-" . $string;

                //         $Stock = new Stock;
                //         $Stock->Stock_Code = $stockCode;
                //         $Stock->Shop_Code = session('globalShop');
                //         $Stock->Product_Code = $code;
                //         $Stock->Variant_Code = $varCode;
                //         $Stock->Stock_Quantity = $item['Current_Inventory'];
                //         $Stock->Synchronized = 'No';
                //         $Stock->save();
                //     }
                // } else {
                //     $varKarakter = "ABCDEVGHIJKLMNOPQRSTUVWXYZ";
                //     $varPin = mt_rand(0, 9999999) . $varKarakter[rand(0, strlen($varKarakter) - 1)];
                //     $varString = str_shuffle($varPin);
                //     $varCode = "PROD-" . $varString;
                //     VariantProduct::create([
                //         "Variant_Code" => $varCode,
                //         "Product_Code" => $code,
                //         "Variant_Name" => $request->Product_Name,
                //         "Product_BuyPrice" => $request->Product_BuyPrice,
                //         // "Product_BarCode"=>$request->Product_Barcode,
                //         "Product_Price" => $request->Product_Price,
                //         "Reorder_Quantity" => $request->Reorder_Quantity,
                //         "Product_TaxRate" => $request->Product_Tax,
                //         "Synchronized" => "No",
                //     ]);

                //     $karakter = "ABCDEVGHIJKLMNOPQRSTUVWXYZ";
                //     $pin = mt_rand(0, 9999999) . $karakter[rand(0, strlen($karakter) - 1)];
                //     $string = str_shuffle($pin);
                //     $stockCode = "STK-" . $string;

                //     $Stock = new Stock;
                //     $Stock->Stock_Code = $stockCode;
                //     $Stock->Shop_Code = session('globalShop');
                //     $Stock->Product_Code = $code;
                //     $Stock->Variant_Code = $varCode;
                //     $Stock->Stock_Quantity = $request->Current_Inventory;
                //     $Stock->Synchronized = 'No';
                //     $Stock->save();'
                // };
            }

            $product->save();

            $notification = array(
                'message'    => 'Product data has been added!',
                'alert-type' => 'success'
            );
        } catch (Exception $e) {
            DB::rollBack();
            $notification = array(
                'message'    => $e->getMessage(),
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification)->withInput();
        }
        DB::commit();
        return redirect()
            ->route($this->route . "index")
            ->with($notification);
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
    public function edit(Product $product)
    {
        $category = Category::get();
        // $model=DB::table('model')->get();
        $brand    = Brand::get();
        $supplier = Supplier::get();
        $modifier = Modifier::get();

        // dd($product);
        // $attribute=DB::table('attribute')
        // ->orderBy('Attribute_Name')
        // ->get();

        return view($this->routeView . "form", [
            'title'    => "Add {$this->title}",
            'product'  => $product,
            'supplier' => $supplier,
            'category' => $category,
            'brand'    => $brand,
            'modifier' => $modifier,
            'action'   => route($this->route . "update", $product),
        ]);
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
