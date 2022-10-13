@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Edit Product <span class="text-primary">({{ $product_information->product_name }})</span>
                </div>
                <form action="{{ route('product_update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="card-body">
                        {{-- EDIT NAME PART START --}}
                        @if ($edit_type == 1)    
                        <div class="mb-2">
                            <label for="" class="form-label">Product Old Name</label>
                            <input readonly type="text" class="form-control" value="{{ $product_information->product_name }}">
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Product New Name</label>
                            <input name="product_name" type="text" class="form-control">
                            @error('product_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        @endif
                        {{-- EDIT NAME PART END --}}

                        {{-- EDIT Category PART START --}}
                        @if ($edit_type == 2)    
                        <div class="mb-2">
                            <label for="" class="form-label">Product Old Category</label>
                            <input readonly type="text" class="form-control" value="{{ $product_information->rel_to_category->category_name }}">
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Product New Category</label>
                            <select class="form-control" name="category_id" id="">
                                <option value="">-- Select Category --</option>
                                @foreach ($category as $cate)
                                    <option value="{{ $cate->id }}">{{ $cate->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        @endif
                        {{-- EDIT Category PART END --}}

                        {{-- EDIT Sub-Category PART START --}}
                        @if ($edit_type == 3)    
                        <div class="mb-2">
                            <label for="" class="form-label">Product Category</label>
                            <input readonly type="text" class="form-control" value="{{ $product_information->rel_to_category->category_name }}">
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Product Old Sub-Category</label>
                            <input readonly="" type="text" class="form-control" value="{{ ($product_information->subcategory_id == null?"NULL":$product_information->rel_to_subcategory->subcategory_name) }}">
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Product New Sub-Category</label>
                            <select class="form-control" name="subcategory_id" id="">
                                <option value="">-- Select Category --</option>
                                @foreach ($subcategory as $subcate)
                                    <option value="{{ $subcate->id }}">{{ $subcate->subcategory_name }}</option>
                                @endforeach
                            </select>
                            @error('subcategory_id')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        @endif
                        {{-- EDIT Sub-Category PART END --}}

                        {{-- EDIT Price PART START --}}
                        @if ($edit_type == 4)    
                        <div class="mb-2">
                            <label for="" class="form-label">Product Sub-Price</label>
                            <input id="product_price" type="text" name="product_price" class="form-control" value="{{ $product_information->product_price }}">
                            @error('product_price')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Product Discount %</label>
                            <input id="product_discount" name="product_discount" type="text" class="form-control" value="{{ ($product_information->product_discount == null?"0":$product_information->product_discount) }}">
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Product after Price</label>
                            <input id="discount_price" readonly type="text" class="form-control" value="{{ $product_information->discount_price }}">
                        </div>
                        @endif
                        {{-- EDIT Price PART END --}}

                        {{-- EDIT Short Desp PART START --}}
                        @if ($edit_type == 5)    
                        <div class="mb-2">
                            <label for="" class="form-label">Product Old Short Desciption</label>
                            <p>{{ $product_information->short_desp }}</p>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Product New Short Desciption</label>
                            <textarea style="resize: none;" class="form-control" name="short_desp" id="" cols="8" rows="7"></textarea>
                            @error('short_desp')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        @endif
                        {{-- EDIT Short Desp PART END --}}

                        {{-- EDIT Short Desp PART START --}}
                        @if ($edit_type == 6)    
                        <div class="mb-2">
                            <label for="" class="form-label">Product Old Long Desciption</label>
                            <p>{!! $product_information->long_desp !!}</p>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Product New Long Desciption</label>
                            <textarea cols="5" rows="3" id="summernote" name="long_desp"></textarea>
                            @error('long_desp')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        @endif
                        {{-- EDIT Short Desp PART END --}}

                        {{-- EDIT Preview PART START --}}
                        @if ($edit_type == 7)    
                        <div class="mb-2">
                            <label for="" class="form-label">Insert New Product Image*</label>
                            <input type="file" class="form-control" name="product_preview" oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                            @error('product_preview')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <img width="150" height="150" src="{{ asset('frontend/assets/img/product/previews') }}/{{ $product_information->product_preview }}" id="pic" />
                        </div>
                        @endif
                        {{-- EDIT Preview PART END --}}

                        <input type="hidden" name="edit_type" value="{{ $edit_type }}">
                        <input type="hidden" name="product_id" value="{{ $product_information->id }}">

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
            if(price != '' && discount != ''){
                var price = $('#product_price').val();
                var discount = $('#product_discount').val();
                var discount_price = price - (price * discount/100);

                $('#discount_price').val(Math.round(discount_price));
            }
            else{
                var price = $('#product_price').val();
                var discount = 0;
                var discount_price = price - (price * discount/100);

                $('#discount_price').val(Math.round(discount_price));
            }
        }
        // Caluculate Dicount Price End
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


@endsection