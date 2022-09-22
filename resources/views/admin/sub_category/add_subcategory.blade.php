@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card">
                    <div class="card-header">
                        ADD CATEGORY
                        <a class="btn btn-primary float-end" href="{{ route('category_view') }}"><i class="fas fa-list"></i> View CATEGORY</a>
                    </div>
                    <form action="{{ route('category_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label">Category Name*</label>
                                <input type="text" class="form-control" name="category_name">
                                @error('category_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Category Icon</label>
                                <input type="text" class="form-control" name="category_icon" id="icon_name">
                                <p class="text-info mt-1">Write Icon Class Name (Font Awesome 5 Icon Only)</p>
                            </div>
                            <div class="mb-2 text-center">
                                <i id="show_icon" style="font-size: 42px;"></i>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Category Image*</label>
                                <input type="file" class="form-control" name="category_image" oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                                @error('category_image')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <img src="{{ asset('/dashboard/assets/images/category/No-Image.jpg') }}" id="pic" />
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">ADD CATEGORY</button>
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
    $('#icon_name').on('keyup', function(){
        showIcon();
    });

    $('#icon_type').change(function(){
        showIcon();
    });

    function showIcon(){
        var icon_type = $('#icon_type').val();
        var icon_name = $('#icon_name').val();
        $('#show_icon').attr('class', icon_type+" "+icon_name);
    }
</script>

@endsection