@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card">
                    @php
                        $created_at = $subcategoires->created_at->format("Y-M-d");
                        if($subcategoires->updated_at != null)
                        {
                            $updated_at = $subcategoires->updated_at->format("Y-M-d");      
                        }
                    @endphp
                    <div class="card-header">
                        UPDATE SUB-CATEGORY
                        <p class="text-secondary float-end">last updated at <span class="text-dark">{{ ($subcategoires->updated_at == null?$created_at:$updated_at) }}</span></p>
                    </div>
                    <form action="{{ route('subcategory_update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label">Category Name*</label>
                                <select class="form-control" name="category_id">
                                    <option value="">-- Select Category --</option>
                                    @foreach ($categories as $category)
                                        <option {{ ($category->id == $subcategoires->category_id?"selected":"") }} 
                                        value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" class="form-control" name="subcategory_id" value="{{ $subcategoires->id }}">
                                @error('category_id')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Sub-Category Name*</label>
                                <input type="text" class="form-control" name="subcategory_name" value="{{ $subcategoires->subcategory_name }}">
                                @error('subcategory_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">UPDATE SUB-CATEGORY</button>
                            <a class="btn btn-danger float-end" href="{{ route('subCategory_list') }}">Go Back <i class="fas fa-arrow-right"></i></a>
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