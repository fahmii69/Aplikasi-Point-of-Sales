@extends('layouts.master')
@section('content')
<!-- Default box -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <form action="{{ $action }}" method="POST" id="form" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="sticky-top mb-3">
                <div class="card" style="width:100%;">
                    <div class="card-body">
                        <div class="container">
                            <div class="btn-group float-right" role="group" aria-label="Button group">
                                <a class="btn btn-lg btn-secondary" type="button" href="/product">Cancel</a>
                                <button type="button" class="btn btn-lg btn-success btn-submit">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.content-header -->
            </div>
            <div class="container">
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
                                        <label for="my-input">Name</label>
                                        <input type="text" name="product_name" class="form-control input-value" id="product_name" value="{{$product->product_name}}" placeholder="Enter Product Name...">
                                        <input type="hidden" id="product_code" value="{{$product->product_code}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="my-input">Brand</label>
                                        <select name="brand_code" id="brand_code" class="form-control input-value input-select">
                                            @foreach ($brand as $item)
                                                <option value="{{$item->brand_code}}"
                                                    @selected($product->brand_code == $item->brand_code)
                                                    >{{$item->brand_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="my-input">Product Type</label>
                                        <select name="category_code" id="category_code" class="form-control input-value input-select">
                                            @foreach ($category as $item)
                                                <option value="{{$item->category_code}}" data-isModifier="{{$item->isModifier}}"
                                                    @selected($product->category_code == $item->category_code)
                                                    >{{$item->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12" id="kolomModifier">
                                    <div class="form-group select-modifier">
                                        <label for="">Choose Modifier</label>
                                        <select class="select2bs4 form-control" id="modifier" name="modifier[]" multiple="multiple">
                                            @foreach ($modifier as $item)
                                                <option value="{{$item->modifier_code}}"
                                                    @selected(in_array($item->id, $listModifier->toArray()))
                                                    >{{$item->modifier_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tag_code">Tagsss</label>
                                        <select multiple class="form-control" class="tag" name="tag_code[]" id="tag_code" data-role="tagsinput" >
                                            @forelse ($tag as $item)
                                                <option value="{{ $item->id }}"
                                                    @selected(in_array($item->id, $listTag->toArray()))
                                                    >{{ $item->tag_name }}</option>
                                            @empty
                                            @endforelse
                                            <option value="Green">Green</option>
                                        </select>
                                        <small class="text-muted">Type and enter to add a tag.</small>
                                    </div>
                                    <input type="file" name="product_picture" id="product_picture" >
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="my-input">Supplier</label>
                                    <select name="supplier_code" id="supplier_code" class="form-control input-value input-select">
                                        @foreach ($supplier as $item)
                                            <option value="{{$item->supplier_code}}"
                                                @selected($product->supplier_code == $item->supplier_code)
                                                >{{$item->supplier_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="my-input">Supply Price</label>
                                    <input type="number" onkeypress="return isNumberKey(event)" value="0" name="product_buyPrice" id="product_buyPrice" class="form-control input-value">
                                </div>
                            </div>
                            <div class="col-md-12 kolomNoVariant" id="kolomNoVariant">
        
                            </div>
                        </div>
        
                    </div>
                </div>
        
                <div class="">
                    <hr>
                    <strong>Tax</strong>
                    <div class="row">
                        <div class="col-md-4">
                            <p>Specify tax for each item.</p>
                            <br>
                        </div>
                        <div class="col-md-4">
                            <table class="table" width="100%">
                                <thead>
                                    <th>Outlet</th>
                                    <th>Tax</th>
                                </thead>
                                <tbody>
                                    <td>Main Outlet</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="number" class="form-control input-value input-noVariant" onkeypress="return isNumberKey(event)" id="product_tax" name="product_tax" value="0">
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
                                        <td>Markup Price</td>
                                        <td><input type="number" class="form-control input-value input-noVariant" id="markup_price"></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top:1px solid #dee2e6;">Retail Price</td>
                                        <td style="border-top:1px solid #dee2e6;">
                                            <input type="number" class="form-control input-value input-noVariant" name="product_price" id="product_price" onkeypress="return isNumberKey(event)" value="0">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
            
                        </div>
                    </div>
        
                </div>
        
                <div class="kolomVariant" id="kolomVariant">
                    <hr>
        
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /.card -->
@endsection
@push('js')
{{-- @include('master_data.product.js-create') --}}
{{-- @include('master_data.product.js-variant') --}}
@include('master_data.product.js-edit')

@endpush
