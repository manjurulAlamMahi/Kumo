@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Product Details Of <span class="text-primary" >{{ $products->first()->product_name }}</span></h4>
                    <p>SKU : <span>{{ $products->first()->sku }}</span></p>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        {{-- Product Image --}}
                        <div class="col-lg-6">
                            <div class="product_image">
                                <img class="w-100 image-fluid" src="{{ asset('frontend/assets/img/product/previews') }}/{{ $products->first()->product_preview }}" alt="">
                            </div>
                        </div>
                        {{-- Product Content --}}
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label for="" class="form-label">Product Name : 
                                    <span class="text-info" >{{ $products->first()->product_name }}</span> 
                                    <a href="#" style="margin-left: 5px;" class="text-dark"><i class="fas fa-pencil"></i></a>
                                <label>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">Product Category : 
                                    <span class="text-info" >{{ $products->first()->rel_to_category->category_name }}</span> 
                                    <a href="#" style="margin-left: 5px;" class="text-dark"><i class="fas fa-pencil"></i></a>
                                <label>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">Product Sub-Category : 
                                    <span class="text-info" >{{ ($products->first()->subcategory_id == null?"N/A":$products->first()->rel_to_subcategory->subcategory_name) }}</span> 
                                    <a href="#" style="margin-left: 5px;" class="text-dark"><i class="fas fa-pencil"></i></a>
                                <label>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">Product Stars : 
                                    <span class="text-info" >
                                        <i class="fas fa-star"></i>   
                                        <i class="fas fa-star"></i>   
                                        <i class="fas fa-star"></i>   
                                        <i class="fas fa-star"></i>   
                                        <i class="fas fa-star"></i>
                                        (0 stars) 
                                    </span>
                                <label>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">Product Reviews : 
                                    <span class="text-info" >(0 Reviews)</span> 
                                <label>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">Product Discount : 
                                    <span class="text-info" >{{ ($products->first()->product_discount == null?"No discount":$products->first()->product_discount) }}%</span>
                                <label>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">Product Price :
                                    @if ($products->first()->product_discount != null)
                                        <del class="text-dark">{{ $products->first()->product_price }}</del>
                                        <span class="text-info" >{{ $products->first()->discount_price }}</span> 
                                    @else
                                        <span class="text-info" >{{ $products->first()->discount_price }}</span> 
                                    @endif
                                    <a href="#" style="margin-left: 5px;" class="text-dark"><i class="fas fa-pencil"></i></a>
                                <label>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">Short Desciption : <label>
                                <p class="text-info">{{ $products->first()->short_desp }}<a href="#" style="margin-left: 5px;" class="text-dark"><i class="fas fa-pencil"></i></a></p>
                            </div>
                        </div>
                    </div>
                    {{-- Long Description --}}
                    <div class="row">
                        <div class="mb-2">
                            <label for="" class="form-label">Long Description</label>
                        </div>
                        <div class="mb-2 text-info">
                            {!! $products->first()->long_desp !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection