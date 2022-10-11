@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Products List's 
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <td>Sl.</td>
                                <td>Preview</td>
                                <td>Name</td>
                                <td>Category</td>
                                <td>Price</td>
                                <td>Discount</td>
                                <td>SKU</td>
                                <td class="text-center">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $key => $product)
                            <tr>
                                <td class="align-middle">{{ $key+1 }}</td>
                                <td class="align-middle"><img width="60" height="60" src="{{ asset('frontend/assets/img/product/previews') }}/{{ $product->product_preview }}" alt="1"></td>
                                <td class="align-middle">{{ $product->product_name }}</td>
                                <td class="align-middle">{{ $product->rel_to_category->category_name }}</td>
                                <td class="align-middle">
                                    @if ($product->product_discount != null)
                                        <del>{{ $product->product_price }}</del>
                                    @endif
                                    <span>{{ $product->discount_price }}</span>
                                </td>
                                <td class="align-middle">{{ ($product->product_discount == null?"No discount":$product->product_discount."%") }}</td>
                                <td class="align-middle">{{ $product->sku }}</td>
                                <td class="text-center">
                                    <a href="{{ route('product_details', $product->slug) }}" class="btn btn-primary mb-2">VIEW DETAILS</a>
                                    <br>
                                    <a href="#" class="btn btn-danger mb-2">INVENTORY</a>
                                    <br>
                                    <a href="#" class="btn btn-success">ACTIVE</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">No Data Found</td>
                            </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection