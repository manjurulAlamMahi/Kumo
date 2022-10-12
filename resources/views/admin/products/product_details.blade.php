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
                        {{-- ProductImage --}}
                        <div class="col-lg-6">
                            <div class="product_image_slider mb-2">
                                <div class="product_image_item">
                                    <img class="w-100 image-fluid" src="{{ asset('frontend/assets/img/product/previews') }}/{{ $products->first()->product_preview }}" alt="">
                                </div>
                                @foreach ($thumb as $thumbnails_preview)
                                <div class="product_image_item">
                                    <img class="w-100 image-fluid" src="{{ asset('frontend/assets/img/product/thumbnails') }}/{{ $thumbnails_preview->product_thumbnail }}" alt="">
                                </div>
                                @endforeach
                            </div>
                            <div class="edit_buttton">
                                <a href="{{ route('product_image_list' , $products->first()->id) }}" class="btn btn-dark">EDIT IMAGES <i class="fas fa-pencil"></i></a>
                            </div>
                        </div>
                        <style>
                            .Product_image_nav .slick-current{
                                border: 3px solid #35b8e0;
                            }
                        </style>
                        {{-- Product Content --}}
                        <div class="col-lg-6">
                            <div class="title mb-3">
                                <h4 style="font-weight: 700; font-size:20px;" class="text-primary">Product Thumbnails --</h4>
                            </div>
                            <div class="row mb-3 Product_image_nav">
                                <div style="margin: 0 5px; cursor:pointer;" class="col">
                                    <img class="w-100 image-fluid" src="{{ asset('frontend/assets/img/product/previews') }}/{{ $products->first()->product_preview }}" alt="">
                                </div>
                                @foreach ($thumb as $thumbnails)
                                <div style="margin: 0 5px; cursor:pointer;" class="col">
                                    <img class="w-100 image-fluid" src="{{ asset('frontend/assets/img/product/thumbnails') }}/{{ $thumbnails->product_thumbnail }}" alt="">
                                </div>
                                @endforeach
                            </div>
                            <div class="title mb-3">
                                <h4 style="font-weight: 700; font-size:20px;" class="text-primary">Product Information --</h4>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">Product Name : 
                                    <span class="text-info" >{{ $products->first()->product_name }}</span> 
                                    <a href="{{ route('product_edit_name', $products->first()->id) }}" style="margin-left: 5px;" class="text-dark"><i class="fas fa-pencil"></i></a>
                                <label>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">Product Category : 
                                    <span class="text-info" >{{ $products->first()->rel_to_category->category_name }}</span> 
                                    <a href="{{ route('product_edit_category', $products->first()->id) }}" style="margin-left: 5px;" class="text-dark"><i class="fas fa-pencil"></i></a>
                                <label>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">Product Sub-Category : 
                                    <span class="text-info" >{{ ($products->first()->subcategory_id == null?"N/A":$products->first()->rel_to_subcategory->subcategory_name) }}</span> 
                                    <a href="{{ route('product_edit_subcategory', $products->first()->id) }}" style="margin-left: 5px;" class="text-dark"><i class="fas fa-pencil"></i></a>
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
                                    <a href="{{ route('product_edit_price', $products->first()->id) }}" style="margin-left: 5px;" class="text-dark"><i class="fas fa-pencil"></i></a>
                                <label>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">Short Desciption : <label>
                                <p class="text-info">{{ $products->first()->short_desp }}<a href="{{ route('product_edit_short_desp', $products->first()->id) }}" style="margin-left: 5px;" class="text-dark"><i class="fas fa-pencil"></i></a></p>
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
                        <div class="mb-2">
                            <a href="{{ route('product_edit_long_desp', $products->first()->id) }}" class="btn btn-dark">Edit long description <i class="fas fa-pencil"></i></a></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
    <script>
        $(document).ready(function(){
            $('.product_image_slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '.Product_image_nav',
                nextArrow: '<i class="fas fa-chevron-circle-right food_next"></i>',
                prevArrow: '<i class="fas fa-chevron-circle-left food_prev"></i>',
                draggable : false,
            });
            $('.Product_image_nav').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                asNavFor: '.product_image_slider',
                dots: false,
                centerMode: false,
                focusOnSelect: true,
                arrows: false,
                draggable: false,
            });
        });
         
    </script>
@endsection