@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Products Inventory List's 
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <td>Sl.</td>
                                <td>Preview</td>
                                <td>Name</td>
                                <td>Category</td>
                                <td>Total Quantity</td>
                                <td>Alert</td>
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
                                <td class="align-middle">{{ App\Models\productInventory::where('product_id' , $product->id)->sum('quantity') }}</td>
                                <td class="text-center">
                                    @if (App\Models\productInventory::where('product_id' , $product->id)->exists())
                                        @if (App\Models\productInventory::where('product_id' , $product->id)->sum('quantity') > 0)
                                            <div class="alert alert-success">
                                                Stored ({{ App\Models\productInventory::where('product_id' , $product->id)->sum('quantity') }} left)
                                            </div>
                                        @else
                                            <div class="alert alert-warning">
                                                Stock Out !!
                                            </div>
                                        @endif
                                    @else
                                        <div class="alert alert-danger">
                                            <p>Haven't Store Yet</p>
                                        </div>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <a href="{{ route('product_inventory', $product->slug) }}" class="btn btn-info mb-2">VIEW INVENTORY</a>
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

@section('footer_script')
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