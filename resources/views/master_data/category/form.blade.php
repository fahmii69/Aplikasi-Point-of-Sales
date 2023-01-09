@extends('layouts.master')
@section('content')
<!-- Default box -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ $action }}" method="POST">
                @csrf
                @if ($category->id)
                    @method('put')
                @endif
                <div class="form-group">
                    <label for="category_name">Category Name</label>
                    <input type="text" id="category_name" name="category_name" value="{{ old('category_name' , $category->category_name) }}"
                        class="form-control @error('category_name') is-invalid @enderror">
                        @error('category_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="category_address">Category Address</label>
                    <input type="text" id="category_address" name="category_address" value="{{ old('category_address' , $category->category_address) }}"
                        class="form-control @error('category_address') is-invalid @enderror">
                        @error('category_address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="category_phone">Category Phone</label>
                    <input type="text" id="category_phone" name="category_phone" value="{{ old('category_phone' , $category->category_phone) }}"
                        class="form-control @error('category_phone') is-invalid @enderror">
                        @error('category_phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                </div>
                <div class="row">
                    <div class="col-12">
                        <input type="submit" value="Submit" class="btn btn-success float-right">
                        <a href="/category" class="btn btn-secondary float-right mr-2">Cancel</a>
                    </div>
            </form>
        </div>
    </div>
</div>
<!-- /.card -->
@endsection
@push('js')
@endpush
