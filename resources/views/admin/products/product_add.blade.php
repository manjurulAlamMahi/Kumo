@extends('layouts.dashboard')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    ADD PRODUCTS
                </div>
                <form action="{{ route('product_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            {{-- Category --}}
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Product Category*</label>
                                    <select class="form-control" name="category_id" id="category_id">
                                        <option value="">-- Select Category --</option>
                                        @foreach ($catrgories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            {{-- Sub-Category --}}
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Product Sub-Category</label>
                                    <select id="subcategory_list" class="form-control" name="subcategory_id" id="">
                                        <option value="">-- Select Sub-Category --</option>
                                    </select>
                                </div>
                            </div>
                            {{-- Product Name --}}
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Product Name*</label>
                                    <input type="text" class="form-control" name="product_name" placeholder="Product Title">
                                    @error('product_name')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            {{-- Product Price --}}
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Product Price*</label>
                                    <input id="product_price" type="text" class="form-control" name="product_price" placeholder="Price">
                                    @error('product_price')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            {{-- Product Discount --}}
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Product Discount</label>
                                    <input name="product_discount" id="product_discount" type="text" class="form-control" placeholder="0%">
                                </div>
                            </div>
                            {{-- Discount Price --}}
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Discount Price</label>
                                    <input readonly id="discount_price" type="text" class="form-control" value="No Discount">
                                </div>
                            </div>
                            {{-- Short Desp --}}
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Short Description*</label>
                                    <textarea placeholder="Write short desciption about product in 100 words!" style="resize: none;" class="form-control" name="short_desp" cols="5" rows="3"></textarea>
                                    @error('short_desp')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            {{-- Long Desp --}}
                            <style>
                                #long_desp .note-editor .note-editing-area .note-editable{
                                    height: 150px;
                                }
                            </style>
                            <div class="col-lg-12">
                                <div class="mb-3" id="long_desp">
                                    <label for="" class="form-label">Long Description</label>
                                    <textarea cols="5" rows="3" id="summernote" name="long_desp"></textarea>
                                    @error('long_desp')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            {{-- Product Preview --}}
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Product Preview*</label>
                                    <input type="file" class="form-control" name="product_preview">
                                    @error('product_preview')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            {{-- Product Thumbnail --}}
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Product Image Thumbnails <span class="text-primary">(Only 4 Thumbnail Can be Added)</span></label>
                                    <input id="product_thumbnail" multiple name="product_thumbnail[]" type="file" class="form-control">
                                    <strong id="Thumbnail_error" class="text-danger"></strong>
                                    @if (session('error'))
                                        <strong class="text-danger">{{ session('error') }}</strong>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <style>
                        .display-none{
                            display: none;
                        }
                    </style>
                    <div id="cardfooter" class="card-footer text-center">
                        <button id="submit" class="btn btn-primary">SUBMIT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_script')
<script>
    // Summer Note
    $(document).ready(function() {
        $('#summernote').summernote();
    });
    // Caluculate Dicount Price Start
    $('#product_price').on('keyup',function(){
        discountprice();
    });
    $('#product_discount').on('keyup',function(){
        discountprice();
    });
    
    function discountprice(){
        var price = $('#product_price').val();
        var discount = $('#product_discount').val();
        var discount_price = price - (price * discount/100);
        
        if(price != '' && discount != ''){
            $('#discount_price').val(Math.round(discount_price));
        }
        else{
            $('#discount_price').val('No Discount');
        }
    }
    // Caluculate Dicount Price End
    
    // Ajax

    $('#category_id').change(function(){
        category_id = $(this).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : 'POST',
            url  : '/getsubcategory',
            data :{'category_id':category_id},
            success: function(data){
                $('#subcategory_list').html(data);
            }
        });
    })
</script>

@if (session('success'))
<script>
    const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  
  Toast.fire({
    icon: 'success',
    title: '{{ session('success') }}',
  })
</script>
@endif

<script>
    $("#product_thumbnail").on('change',function(){
        if ($("#product_thumbnail")[0].files.length > 4) {
            $('#Thumbnail_error').html('You can select only 4 images!');
            $('#cardfooter').attr('class','display-none');
        }
        else{
            $('#cardfooter').attr('class','card-footer text-center');
            $('#Thumbnail_error').html('');
        }
    }); 
</script>

@endsection