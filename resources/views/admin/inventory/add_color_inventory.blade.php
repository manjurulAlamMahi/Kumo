@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    Color list
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>Sl.</td>
                                <td>Color Name</td>
                                <td>Color Code</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventoryColors as $key => $clr)
                            <tr>
                                <td class="align-middle">{{ $key+1 }}</td>
                                <td class="align-middle" style="color: {{ $clr->color_code }};">{{ $clr->color_name }}</td>
                                <td class="align-middle"><div class="align-middle" style="border-radius:50%; display:inline-block; width: 20px; height:20px; background:{{ $clr->color_code }};" class="circle"></div> {{ $clr->color_code }}</td>
                                <td class="align-middle">
                                    <a href="{{ route('remove_ineventory_color', $clr->id) }}" class="btn btn-danger">Delete Color</a>
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
                    Add color
                </div>
                <form action="{{ route('inventory_add_color') }}" method="POST">
                @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Color name</label>
                            <input type="text" class="form-control" name="color_name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Color Code</label>
                            <input type="text" name="color_code" class="form-control" id="colorpicker-default" value="">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">ADD COLOR</button>
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