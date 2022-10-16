@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    {{ $product_details->first()->product_name }} inventory
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>SL.</td>
                                <td>Size</td>
                                <td>Color</td>
                                <td>Quantity</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($productInventory as $key => $pi)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ ($pi->size_id == null?'N/A':$pi->rel_to_size->size_name) }}</td>
                                <td>
                                    @if ($pi->color_id != null)
                                    <div class="align-middle" style="display:inline-block; width:20px; height:20px; border-radius:50%; background:{{ $pi->rel_to_color->color_code }}; border:1px solid #000;"></div>
                                    @endif
                                    {{ ($pi->color_id == null?'N/A':$pi->rel_to_color->color_name) }}</td>
                                <td>{{ $pi->quantity }}</td>
                                <td><a href="{{ route('remove_product_inventory',$pi->id) }}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No Data Found</td>
                            </tr>  
                            @endforelse
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    ADD Inventory of {{ $product_details->first()->product_name }}
                </div>
                <form action="{{ route('store_inventory') }}" method="POST">
                @csrf
                    <div class="card-body">
                        <div class="mb-2">
                            <label for="" class="form-label">Product Color</label>
                            <select class="form-control" name="color_id">
                                <option value="">-- Select Color --</option>
                                @foreach ($colors as $clr)
                                <option value="{{ $clr->id }}">{{ $clr->color_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Product Size</label>
                            <select class="form-control" name="size_type" id="size_type">
                                <option value="">-- Select Size Type --</option>
                                @foreach ($inventorySizeType as $size_type)
                                    <option value="{{ $size_type->id }}">{{ $size_type->size_type }}</option>
                                @endforeach
                            </select>
                            <div class="select_size">
                                <br>
                                <input checked name="size_id[]" type="checkbox" value=""> No Size Available
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="form-label" for="">Quantity</label>
                            <input type="text" name="quantity" class="form-control">
                            @error('quantity')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <input type="hidden" name="product_id" value="{{ $product_details->first()->id }}">
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script') 
<script>
    // Ajax
    $('#size_type').change(function(){
        size_type = $(this).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : 'POST',
            url  : '/getsizeinventory',
            data :{'size_type':size_type},
            success: function(data){
                $('.select_size').html(data);
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

@endsection