@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Edit Product <span class="text-primary">({{ $product_information->first()->product_name }})</span>
                </div>
                <form action="">
                    <div class="card-body">
                        {{-- EDIT NAME PART START --}}
                        @if ($edit_type == 1)    
                        <div class="mb-2">
                            <label for="" class="form-label">Product Old Name</label>
                            <input readonly type="text" class="form-control" value="{{ $product_information->first()->product_name }}">
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Product New Name</label>
                            <input name="product_name" type="text" class="form-control">
                        </div>
                        @endif
                        {{-- EDIT NAME PART END --}}

                        {{-- EDIT Category PART START --}}
                        @if ($edit_type == 2)    
                        <div class="mb-2">
                            <label for="" class="form-label">Product Old Category</label>
                            <input readonly type="text" class="form-control" value="{{ $product_information->first()->rel_to_category->category_name }}">
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Product New Category</label>
                            <select class="form-control" name="" id="">
                                <option value="">-- Select Category --</option>
                                @foreach ($category as $cate)
                                    <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        {{-- EDIT Category PART END --}}
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection