<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\Supplier\StoreSupplierRequest;
use App\Http\Requests\Master\Supplier\UpdateSupplierRequest;
use App\Models\Stocks\Supplier;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class SupplierController extends Controller
{
    /**
     * Constructor
     */
    public function __construct(
        protected string $title = "Supplier",
        protected string $route = "supplier.",
        protected string $routeView = "master_data.supplier.",
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view($this->routeView . "index", [
            'title'    => $this->title,
        ]);
    }

    public function getSupplier(Request $request)
    {
        if ($request->ajax()) {
            $data = Supplier::latest('id');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $route = "/supplier/$data->id/edit";
                    return view('components.action-button', compact('data', 'route'));
                })
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view($this->routeView . "form", [
            'title'    => "Add {$this->title}",
            'supplier' => new Supplier(),
            'action'   => route($this->route . 'create')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSupplierRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSupplierRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        $character = "ABCDEVGHIJKLMNOPQRSTUVWXYZ";
        $pin = mt_rand(0, 9999999) . $character[rand(0, strlen($character) - 1)];
        $string = str_shuffle($pin);
        $code = "SUP-" . $string;

        try {
            $supplier = new Supplier($request->safe(
                ['supplier_name', 'supplier_address', 'supplier_phone']
            ));
            $supplier->supplier_code = $code;

            $supplier->save();

            $notification = array(
                'message'    => 'Supplier data has been added!',
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
     * @param  Supplier $supplier
     * @return View
     */
    public function edit(Supplier $supplier): View
    {
        return view($this->routeView . "form", [
            'title'          => "Edit {$this->title}",
            'supplier' => $supplier,
            'action'   => route($this->route . 'edit', $supplier)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSupplierRequest $request
     * @param  Supplier $supplier
     * @return RedirectResponse
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $supplier->fill($request->safe(
                ['supplier_name', 'supplier_address', 'supplier_phone']
            ));

            $supplier->update();

            $notification = array(
                'message'    => 'Supplier data has been updated!',
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
     * Delete data.
     *
     * @param Supplier $supplier
     * @return JsonResponse
     */
    public function destroy(Supplier $supplier): JsonResponse
    {
        Supplier::destroy($supplier->id);

        return response()->json(['success' => true, 'message' => 'Supplier Data has been DELETED !']);
    }
}
