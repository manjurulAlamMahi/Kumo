@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    Size list
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>Sl.</td>
                                <td>Size Name</td>
                                <td>Size Short Name</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventorySize as $key => $size)
                            <tr>
                                <td class="align-middle">{{ $key+1 }}</td>
                                <td class="align-middle">{{ $size->size_name }}</td>
                                <td class="align-middle">{{ $size->size_short_name }}</td>
                                <td>
                                    <a href="{{ route('remove_ineventory_size', $size->id) }}" class="btn btn-danger">Delete Size</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    Add Size
                </div>
                <form action="{{ route('inventory_add_size') }}" method="POST">
                @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Size Name</label>
                            <input type="text" class="form-control" name="size_name">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Size Short Name</label>
                            <input type="text" class="form-control" name="size_short_name">
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
@endsection