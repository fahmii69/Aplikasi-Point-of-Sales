@extends('layouts.master')
@section('content')
<!-- Default box -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ $action }}" method="POST">
                @csrf
                @if ($supplier->id)
                    @method('put')
                @endif
                <div class="form-group">
                    <label for="supplier_name">Supplier Name</label>
                    <input type="text" id="supplier_name" name="supplier_name" value="{{ old('supplier_name' , $supplier->supplier_name) }}"
                        class="form-control @error('supplier_name') is-invalid @enderror">
                        @error('supplier_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="supplier_address">Supplier Address</label>
                    <input type="text" id="supplier_address" name="supplier_address" value="{{ old('supplier_address' , $supplier->supplier_address) }}"
                        class="form-control @error('supplier_address') is-invalid @enderror">
                        @error('supplier_address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="supplier_phone">Supplier Phone</label>
                    <input type="text" id="supplier_phone" name="supplier_phone" value="{{ old('supplier_phone' , $supplier->supplier_phone) }}"
                        class="form-control @error('supplier_phone') is-invalid @enderror">
                        @error('supplier_phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                </div>
                <div class="row">
                    <div class="col-12">
                        <input type="submit" value="Submit" class="btn btn-success float-right">
                        <a href="/supplier" class="btn btn-secondary float-right mr-2">Cancel</a>
                    </div>
            </form>
        </div>
    </div>
</div>
<!-- /.card -->
@endsection
@push('js')
@endpush
