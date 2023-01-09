@extends('layouts.master')
@section('content')
<!-- Default box -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <form action="{{ $action }}" method="POST" id="form" enctype="multipart/form-data">
            @csrf
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
                                    <label for="my-input"> Product Name</label>
                                    <input type="text" id="product_name" name="product_name"
                                        value="{{ old('product_name' , $product->product_name) }}" 
                                        placeholder="Enter Product Name..."
                                        class="form-control @error('product_name') is-invalid @enderror">
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
                                    <select name="brand_code" id="brand_code"
                                        class="form-control input-value input-select">
                                        @foreach ($brand as $item)
                                        <option value="{{$item->brand_code}}"
                                            {{ $item->brand_code == $product->brand_code ? 'selected' : '' }}>
                                            {{$item->brand_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="my-input">Product Type</label>
                                    <select name="category_code"  id="category_code"
                                        class="form-control input-value input-select @error('category_code') is-invalid @enderror">
                                        @foreach ($category as $item)
                                        <option value="{{$item->category_code}}"
                                            {{ $product->category_code === $item ? 'selected' : '' }}
                                            data-isModifier="{{$item->isModifier}}">{{$item->category_name}}</option>
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
                                    <select class="select2bs4 form-control" id="modifier_code" name="modifier_code[]"
                                        multiple="multiple">
                                        @foreach ($modifier as $item)
                                        <option value="{{$item->modifier_code}}">{{$item->modifier_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tag_code">Tag</label>
                                        <select multiple class="form-control" class="tag" name="tag_code[]" id="tag_code" data-role="tagsinput" >
                                            @forelse ($tag as $item)
                                                <option value="{{ $item->id }}"
                                                    >{{ $item->tag_name }}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                    <small class="text-muted">Type and enter to add a tag.</small>
                                </div>
                                    <i class="fa fa-folder-open"></i><input type="file" name="product_picture" id="product_picture"
                                        multiple>
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
                            <label class="btn bg-white active" style="width:50%;" id="option0">
                                <input type="radio" name="options" value="0" />
                                Standard Product
                                <hr>
                                <p style="font-weight: 100;">This product has one Barcode Code with its own inventory.
                                </p>

                            </label>
                            <label class="btn bg-white" style="width:50%;" id="option1">
                                <input type="radio" name="options" value="1" />
                                Product with Variants
                                <hr>
                                <p style="font-weight: 100;">
                                    These products have different attributes, like size or color. Each variant has a
                                    unique Barcode Code and inventory level.
                                </p>
                            </label>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="my-input">Supplier</label>
                                    <select name="supplier_code"  id="supplier_code"
                                        class="form-control input-value input-select">
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

                                    <input type="number"  value="0" name="product_buyPrice"
                                        id="product_buyPrice" class="form-control input-number input-value"
                                        onkeypress="return isNumberKey(event)">
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
                                                <input type="number" class="input-value input-noVariant form-control"
                                                     name="current_inventory" id="current_inventory"
                                                    onkeypress="return isNumberKey(event)" value="0">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" class="input-value input-noVariant form-control"
                                                     name="reorder_quantity" id="reorder_quantity"
                                                    onkeypress="return isNumberKey(event)" value="0">
                                            </div>
                                        </td>
                                    </tbody>
                                </table>
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
                                                    <input type="number"
                                                        class="form-control input-number input-value input-noVariant"
                                                        onkeypress="return isNumberKey(event)" id="product_tax"
                                                        name="product_tax" value="0">
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
                                                <td><input type="number"
                                                        class="form-control input-value input-noVariant input-number"
                                                        id="markup_price"></td>
                                            </tr>
                                            <tr>
                                                <td style="border-top:1px solid #dee2e6;">Retail Price</td>
                                                <td style="border-top:1px solid #dee2e6;">
                                                    <input type="number"
                                                        class="form-control input-value input-noVariant input-number"
                                                        name="product_price"  id="product_price" value=""
                                                        onkeypress="return isNumberKey(event)">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kolomVariant" id="kolomVariant">
                    
                </div>
                @include('master_data.product.modalVariant')
            </div>
        </form>
    </div>
</div>
<!-- /.card -->
@endsection
@push('js')
<script>
    // INPUT TYPE FILE
    $(document).on('change', '.btn-file :file', function () {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    $(document).ready(function () {
        $('.btn-file :file').on('fileselect', function (_event, numFiles, label) {
            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;

            if (input.length) {
                input.val(log);
            } else {
                // if( log ) alert(log);
            }
        });
    });

</script>
@include('master_data.product.js-create')
@include('master_data.product.js-variant')

@endpush
