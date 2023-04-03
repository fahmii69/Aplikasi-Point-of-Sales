<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\Product\StoreProductRequest;
use App\Models\Products\Tag;
use App\Models\Products\Attribute;
use App\Models\Products\Brand;
use App\Models\Products\Category;
use App\Models\Products\Modifier;
use App\Models\Products\Product;
use App\Models\Products\ProductAttribute;
use App\Models\Products\ProductAttributeDetail;
use App\Models\Products\ProductModifier;
use App\Models\Products\ProductTag;
use App\Models\Products\ProductVariant;
use App\Models\Stocks\Stock;
use App\Models\Stocks\Supplier;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\View as FacadesView;

class ProductController extends Controller
{
    /**
     * Constructor
     * 
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
        $category  = Category::get();
        $brand     = Brand::get();
        $supplier  = Supplier::get();
        $modifier  = Modifier::get();
        $attribute = Attribute::get();
        $tag       = Tag::get();
        // $html = "";
        // foreach ($pengembalian->getDetail as $item) {
        $html = FacadesView::make('components.product.add-attribute', compact('attribute'));
        $option1 = FacadesView::make('components.product.kolom-option1', compact('attribute'));
        // }

        return view($this->routeView . "create", [
            'title'     => "Add {$this->title}",
            'product'   => new Product(),
            'supplier'  => $supplier,
            'category'  => $category,
            'brand'     => $brand,
            'modifier'  => $modifier,
            'attribute' => $attribute,
            'tag'       => $tag,
            'html'      => $html,
            'option1'   => $option1,
            'action'    => route('product.store'),
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
        $response = [
            'success' => false,
        ];

        DB::beginTransaction();

        $karakter = "ABCDEVGHIJKLMNOPQRSTUVWXYZ";
        $pin = rand(0, 9999999) . $karakter[rand(0, strlen($karakter) - 1)];
        $string = str_shuffle($pin);
        $code = "PDT-" . $string;

        // dd($request->all());
        try {

            $product = new Product($request->safe(
                ['product_name', 'product_price', 'brand_code', 'supplier_code', 'category_code', 'options']
            ));

            // $image = "";
            if ($request->product_picture === "undefined") {

                $image = "";
            } else {

                $image = "data:image/png;base64," .
                    base64_encode(file_get_contents($request->file('product_picture')->path()));
            }

            $product->product_code    = $code;
            $product->product_picture = $image;
            $product->save();

            // dd(123);

            if ($request->tag_code) {
                foreach ($request->tag_code as $item => $value) {

                    if (!is_numeric($value)) {

                        $tag = new Tag;
                        $tag->tag_name = $value;
                        $tag->save();

                        $value = $tag->id;
                    }

                    ProductTag::create([
                        "product_code" => $code,
                        "tag_id" => $value,
                    ]);
                };
            }

            // dd(123);
            if ($request->modifier_code) {
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
            }

            $arrayProductAttributeCode = [];

            if ($request->level_attribute) {
                foreach ($request->level_attribute as $item => $v) {
                    $karakter = "ABCDEVGHIJKLMNOPQRSTUVWXYZ";
                    $pin = mt_rand(0, 9999999) . $karakter[rand(0, strlen($karakter) - 1)];
                    $string = str_shuffle($pin);
                    $product_attributeCode = "PA-" . $string;
                    $arrayProductAttributeCode[] = $product_attributeCode;
                    $decode = json_decode($v);

                    ProductAttribute::create([
                        'product_attributeCode' => $product_attributeCode,
                        'product_code'          => $code,
                        'attribute_code'        => $decode,
                    ]);
                }
            }

            if ($request->detail_attribute) {

                foreach ($request->detail_attribute as $key => $v) {
                    $decode = json_decode($v);
                    // dd($key);
                    foreach ($decode as $k1 => $v1) {
                        ProductAttributeDetail::create([
                            'product_attributeCode' => $arrayProductAttributeCode[$key],
                            'detail_attribute'      => $v1,
                        ]);
                    }
                }
            }
            // dd(123);
            if ($request->options == 1) {
                foreach ($request->variant_list as $item) {
                    $varKarakter = "ABCDEVGHIJKLMNOPQRSTUVWXYZ";
                    $varPin = mt_rand(0, 9999999) . $varKarakter[rand(0, strlen($varKarakter) - 1)];
                    $varString = str_shuffle($varPin);
                    $varCode = "PROD-" . $varString;

                    $decode = json_decode($item, true);

                    $variantName = str_replace(",", " / ", $decode['ValueCheck']);
                    // dd(123);
                    ProductVariant::create([
                        "variant_code" => $varCode,
                        "product_code" => $code,
                        "variant_list" => $decode['ValueCheck'],
                        "variant_name" => $variantName,
                        "product_buyPrice" => $decode['product_buyPrice'],
                        "product_barcode" => $decode['product_barcode'],
                        "product_price" => $decode['product_price'],
                        "reorder_quantity" => $decode['reorder_quantity'],
                        "product_taxRate" => $decode['product_tax'],
                    ]);

                    $karakter = "ABCDEVGHIJKLMNOPQRSTUVWXYZ";
                    $pin = mt_rand(0, 9999999) . $karakter[rand(0, strlen($karakter) - 1)];
                    $string = str_shuffle($pin);
                    $stockCode = "STK-" . $string;

                    $stock = new Stock;
                    $stock->stock_code = $stockCode;
                    // $stock->shop_code = session('globalShop');
                    $stock->product_code = $code;
                    $stock->variant_code = $varCode;
                    $stock->stock_quantity = $decode['current_inventory'];
                    // $stock->Synchronized = 'No';
                    $stock->save();
                }

                // dd(890);
            } else {

                $karakter = "ABCDEVGHIJKLMNOPQRSTUVWXYZ";
                $pin = mt_rand(0, 9999999) . $karakter[rand(0, strlen($karakter) - 1)];
                $string = str_shuffle($pin);
                $stockCode = "STK-" . $string;

                $stock = new Stock();
                $stock->stock_Code = $stockCode;
                // $Stock->Shop_Code = session('globalShop');
                $stock->product_code = $code;
                // $Stock->variant_code = $varCode;
                $stock->stock_quantity = $request->current_inventory;
                // $Stock->Synchronized = 'No';
                $stock->save();
            };

            $response['success'] = true;
            $response['message'] = " Success Add New Product! ";
        } catch (Exception $e) {
            DB::rollBack();

            $response['message'] = $e->getMessage();

            return response()->json($response);
        }

        DB::commit();

        return response()->json($response);
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
        $brand    = Brand::get();
        $supplier = Supplier::get();
        $modifier = Modifier::get();
        $tag      = Tag::get();

        $attribute  = Attribute::get();
        $levelAttribute = ProductAttribute::first();
        $productVariant = ProductVariant::query()
            ->leftjoin('stocks', 'stocks.variant_code', 'product_variants.variant_code')
            ->select('product_variants.*', 'stocks.stock_quantity as current_inventory')
            // ->where('variant_product.Product_Code', $id)
            ->get();

        $listTag = $product->tag->pluck('tag_id');
        $listModifier = $product->modifier->pluck('modifier_code');

        // foreach ($pengembalian->getDetail as $item) {
        //     $html .= FacadesView::make('components.pengembalian_buku', compact('item', 'status'));
        // }

        return view($this->routeView . "edit", [
            'title'          => "Edit {$this->title}",
            'product'        => $product,
            'supplier'       => $supplier,
            'category'       => $category,
            'brand'          => $brand,
            'modifier'       => $modifier,
            'attribute'      => $attribute,
            'tag'            => $tag,
            'productVariant' => $productVariant,
            'levelAttribute' => $levelAttribute,
            'action'         => route($this->route . "update", $product),
            'listTag'        => $listTag,
            'listModifier'        => $listModifier,
        ]);
    }

    public function getModifier($id)
    {
        $data = DB::table('product_modifiers as a')
            ->leftjoin('modifiers as b', 'a.Modifier_Code', 'b.modifier_code')
            ->where('a.Product_Code', $id)
            ->get();

        return $data;
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
     * @param  Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        Product::destroy($product->id);

        return response()->json(['success' => true, 'message' => 'Product Data has been DELETED !']);
    }
}
