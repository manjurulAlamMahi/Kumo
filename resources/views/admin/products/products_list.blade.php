@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div id="custom-accordion-one" class="col-lg-12 mb-2 accordion custom-accordion">
            <div class="card mb-0">
                <div class="card-header" id="headingNine">
                    <h5 class="m-0 position-relative">
                        <a class="custom-accordion-title text-reset d-block"
                            data-bs-toggle="collapse" href="#collapseNine"
                            aria-expanded="true" aria-controls="collapseNine">
                            Filter's 
                            <i class="mdi mdi-chevron-down accordion-arrow"></i>
                        </a>
                    </h5>
                </div>

                <div id="collapseNine" class="collapse show"
                    aria-labelledby="headingFour"
                    data-bs-parent="#custom-accordion-one">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Category</label>
                                    <select class="form-control" name="" id="category_id">
                                        <option value="">-- Select Category --</option>
                                        @foreach ($category as $cate)
                                            <option value="{{ $cate->id }}">{{ $cate->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Status</label>
                                    <select class="form-control" name="" id="status_id">
                                        <option value="">-- Select Category --</option>
                                        <option value="act">Active</option>
                                        <option value="dct">Deactive</option>
                                        <option value="invt">Not Added On Inventory</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label for="example-date" class="form-label">Date</label>
                                <input class="form-control" id="example-date" type="date" name="date">
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="form-label">Search</label>
                                </div>
                                <div class="input-group app-search-box">
                                    <input type="text" class="form-control" placeholder="Search Product..." id="search" value="">
                                    <button class="btn input-group-text" id="serach_btn" type="submit">
                                        <i class="fe-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                    <a href="{{ route('product_inventory', $product->slug) }}" class="btn btn-danger mb-2">INVENTORY</a>
                                    <br>
                                    @if (App\Models\productInventory::where('product_id' , $product->id)->exists())
                                        @if (App\Models\productInventory::where('product_id' , $product->id)->sum('quantity') > 0)
                                            <a href="{{ route('product_active_deactive', $product->id) }}" class="btn {{ ($product->status == 0?'btn-secondary':'btn-success') }}">{{ ($product->status == 0?'Deactive':'Active') }}</a>
                                        @else
                                            <div class="alert alert-success">
                                                Stock Out !! <br>(ADD INVENTORY)
                                            </div>
                                        @endif
                                        
                                    @else
                                        <div class="alert alert-warning">
                                            (ADD INVENTORY) <br> before activation
                                        </div>
                                    @endif
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
                <div class="card-footer">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')

<script>
    $('#category_id').change(function(){
        let search = $('#search').val();
        let category_id = $('#category_id').val();
        let status = $('#status_id').val();
        let date = $('#example-date').val();
        let url = "{{ route('product_list') }}?"+"q="+search+"&c="+category_id+"&s="+status+"&d="+date;
        window.location.href = url;
    })

    $('#status_id').change(function(){
        let search = $('#search').val();
        let category_id = $('#category_id').val();
        let status = $('#status_id').val();
        let date = $('#example-date').val();
        let url = "{{ route('product_list') }}?"+"q="+search+"&c="+category_id+"&s="+status+"&d="+date;
        window.location.href = url;
    })

    $('#example-date').change(function(){
        let search = $('#search').val();
        let category_id = $('#category_id').val();
        let status = $('#status_id').val();
        let date = $('#example-date').val();
        let url = "{{ route('product_list') }}?"+"q="+search+"&c="+category_id+"&s="+status+"&d="+date;
        window.location.href = url;
    })

    $('#serach_btn').click(function(){
        let search = $('#search').val();
        let category_id = $('#category_id').val();
        let status = $('#status_id').val();
        let date = $('#example-date').val();
        let url = "{{ route('product_list') }}?"+"q="+search+"&c="+category_id+"&s="+status+"&d="+date;
        window.location.href = url;
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
@endsection