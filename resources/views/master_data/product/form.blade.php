@extends('layouts.master')
@section('content')
<!-- Default box -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ $action }}" method="POST">
                @csrf
                @if ($product->id)
                    @method('put')
                @endif
                <div class="sticky-top mb-3">
                    <div class="card" style="width:100%;">
                        <div class="card-body">
                            <div class="container">
                                <div class="btn-group float-right" role="group" aria-label="Button group">
                                    <button class="btn btn-lg btn-secondary" type="button" href="/product">Cancel</button>
                                    <button type="submit" class="btn btn-lg btn-success btn-submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- /.content-header -->
                </div>
                <strong>General</strong>
                <div class="row">
                    <div class="col-md-4">
                        <p>Change general information for this product. </p>
                        <br>
                    </div>
                    <div class="col-md-8">
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="my-input"> Product Name</label>
                                        <input type="text" id="product_name" name="product_name" value="{{ old('product_name' , $product->product_name) }}"
                                        required placeholder="Enter Product Name..." class="form-control @error('product_name') is-invalid @enderror">
                                        @error('product_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="my-input">Brand</label>
                                        <select name="brand_code" id="brand_code" class="form-control input-value input-select">
                                            @foreach ($brand as $item)
                                                <option value="{{$item->brand_code}}">{{$item->brand_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="my-input">Product Type</label>
                                        <select name="category_code" required id="category_code" class="form-control input-value input-select @error('category_code') is-invalid @enderror">
                                            @foreach ($category as $item)
                                            <option value="" selected>-- Select Category --</option>
                                            <option value="{{$item->category_code}}" data-isModifier="{{$item->isModifier}}">{{$item->category_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group select-modifier">
                                        <label for="">Choose Modifier</label>
                                        <select class="select2bs4 form-control" id="Modifier" name="Modifier[]" multiple="multiple">
                                            {{-- @foreach ($modifier as $item)
                                                <option value="{{$item->modifier_code}}">{{$item->modifier_name}}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tag_code">Tag</label>
                                        <select multiple class="form-control tag" name="tag_code[]" id="tag_code" data-role="tagsinput" ></select>
                                        <small class="text-muted">Type and enter to add a tag.</small>
                                    </div>
                                    <input type="file" name="Product_Picture" id="Product_Picture" >
                                </div>
                            </div>
                    </div>
                </div>
                <hr>

                <strong>Inventory</strong>
                <div class="row">
                    <div class="col-md-4">
                        <p>The type of product we choose determines how we manage inventory and reporting. </p>
                        <br>
                    </div>
                    <div class="col-md-8">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn bg-white active" style="width:50%;" id="option1">
                                <input type="radio" name="options" value="1"/>
                                Standard Product
                                <hr>
                                <p style="font-weight: 100;">This product has one Barcode Code with its own inventory.</p>
        
                            </label>
                            <label class="btn bg-white" style="width:50%;" id="option2">
                                <input type="radio" name="options" value="2"/>
                                Product with Variants
                                <hr>
                                <p style="font-weight: 100;">
                                    These products have different attributes, like size or color. Each variant has a unique Barcode Code and inventory level.
                                </p>
                            </label>
                        </div>      
        
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="my-input">Supplier</label>
                                    <select name="supplier_code" required  id="supplier_code" class="form-control input-value input-select">
                                        @foreach ($supplier as $item)
                                            <option value="" selected>-- Select Supplier --</option>
                                            <option value="{{$item->supplier_code}}">{{$item->supplier_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="my-input">Supply Price</label>
                                    {{-- onkeypress="return isNumberKey(event)" --}}
                                    <input type="number"  required value="0" name="Product_BuyPrice" id="Product_BuyPrice" class="form-control input-number input-value">
                                </div>
                            </div>
                            <div class="col-md-12 kolomNoVariant" id="kolomNoVariant">
                                <table class="table" width="100%">
                                    <thead>
                                        <th>Outlet</th>
                                        <th>Current Inventory</th>
                                        <th>Re-order Quantity</th>
                                    </thead>
                                    <tbody>
                                        <td>Main Outlet</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" class="input-value input-noVariant form-control" required name="Current_Inventory" id="Current_Inventory" onkeypress="return isNumberKey(event)" value="0">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" class="input-value input-noVariant form-control" required name="Reorder_Quantity" id="Reorder_Quantity" onkeypress="return isNumberKey(event)" value="0">
                                            </div>
                                        </td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
        
                        <hr>            
                        <strong>Price</strong>
                        <div class="row">
                            <div class="col-md-4">
                                <p>Determine the price for each item.</p>
                                <br>
                            </div>
                            <div class="col-md-4">
                                <table class="table" id="tablePrice" width="100%">
                                    <tbody>
                                        <tr>
                                            <td>Supply Price</td>
                                            <td class="text-right" id="textSupplyPrice">Rp. 0</td>
                                        </tr>
                                        <tr>
                                            <td>Markup Price (%)</td>
                                            <td><input type="number" class="form-control input-value input-noVariant input-number" id="Markup_Price"></td>
                                        </tr>
                                        <tr>
                                            <td style="border-top:1px solid #dee2e6;">Retail Price</td>
                                            <td style="border-top:1px solid #dee2e6;">
                                                {{-- onkeypress="return isNumberKey(event)"  --}}
                                                <input type="number" class="form-control input-value input-noVariant input-number" name="product_price" required id="product_price" value="0">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.card -->
@endsection
@push('js')
<script>
    // $('#category_code').select2({
    //     placeholder: "-- Select Category --",
    //     allowClear: true
    // });
    // $('#supplier_code').select2({
    //     placeholder: "-- Select Supplier --",
    //     allowClear: true
    //     });
</script>
@include('master_data.product.js-create')
@endpush
