@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    Filter
                </div>
                <div class="card-body">
                    <form action="{{ route('inventory_add_size_type') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Add Size Type</label>
                        <input type="text" class="form-control" name="size_type_name">
                        @error('size_type_name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">ADD SIZE TYPE</button>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Edit
                        </button>
                    </div>
                    </form>
                    <div class="mb-3">
                        <label for="" class="form-label">Search By Size Type</label>
                        <select name="" id="size_type" class="form-control">
                            <option value="">-- Select Type --</option>
                            @foreach ($inventorySizeType as $szt)
                            <option
                            @if (isset($_GET['size_type']))
                                @if ($_GET['size_type'] == $szt->id)
                                    Selected
                                @endif
                            @endif
                            value="{{ $szt->id }}">{{ $szt->size_type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- Remove Size Type Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Size Type's Added</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td>Size Type</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inventorySizeType as $szt)
                                        <tr>
                                            <td>{{ $szt->size_type }}</td>
                                            <td><a class="text-danger" href="{{ route('remove_size_type', $szt->id) }}">Delete</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Size list
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>Sl.</td>
                                <td>Size Type</td>
                                <td>Size Name</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventorySize as $key => $size)
                            <tr>
                                <td class="align-middle">{{ $inventorySize->firstitem()+$key }}</td>
                                <td class="align-middle">{{ $size->rel_to_size_type->size_type }}</td>
                                <td class="align-middle">{{ $size->size_name }}</td>
                                <td>
                                    <a href="{{ route('remove_ineventory_size', $size->id) }}" class="btn btn-danger">Delete Size</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $inventorySize->links(); }}
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card mb-3">
                <div class="card-header">
                    Add Size
                </div>
                <form action="{{ route('inventory_add_size') }}" method="POST">
                @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Size Type*</label>
                            <select name="size_type" class="form-control">
                                <option value="">-- Select Size Type --</option>
                                @foreach ($inventorySizeType as $sizetype) 
                                <option value="{{ $sizetype->id }}">{{ $sizetype->size_type }}</option>
                                @endforeach
                            </select>
                            @error('size_type')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Size Name*</label>
                            <input type="text" class="form-control" name="size_name">
                            @error('size_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">ADD SIZE</button>
                    </div>
                </form>
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

<script>
    $('#size_type').change(function(c){
        let size_type = $(this).val();
        let url = "{{ route('inventory_size') }}?"+"size_type="+size_type;
        window.location.href = url;
    })
</script>
@endsection