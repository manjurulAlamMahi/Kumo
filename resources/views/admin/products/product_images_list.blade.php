@extends('layouts.dashboard')

@section('content')
<div class="container">

    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Product Preview 
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td class="text-center align-middle">SL.</td>
                                <td class="text-center align-middle">Product Preview</td>
                                <td class="text-center align-middle">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center align-middle">01</td>
                                <td class="text-center align-middle"><img width="80" height="80" src="{{ asset('frontend/assets/img/product/previews') }}/{{ $product_information->product_preview }}" alt=""></td>
                                <td class="text-center align-middle">
                                    <a class="btn btn-primary" href="{{ route('product_edit_preview', $product_information->id) }}">Change Image</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Product Thumbnail <span class="text-info">(Only 4 Thumbnail can be added)</span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td class="text-center align-middle">SL.</td>
                                <td class="text-center align-middle">Product Thumnails</td>
                                <td class="text-center align-middle">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product_thumbnails as $key=>$pthumb)
                            <tr>
                                <td class="text-center align-middle">{{ $key+1 }}</td>
                                <td class="text-center align-middle"><img width="80" height="80" src="{{ asset('frontend/assets/img/product/thumbnails') }}/{{ $pthumb->product_thumbnail }}" alt="{{ $pthumb->product_thumbnail }}"></td>
                                <td class="text-center align-middle">
                                    <button type="button" name="/product/remove/thumbnail/{{ $pthumb->id }}" class="btn btn-danger remove_thumbnail" href="">Remove Thumbnail</button>
                                </td>
                            </tr> 
                            @endforeach
                            @if ($product_thumbnails->count() < 4)
                            <tr>
                                <td colspan="3" class="text-center align-middle">
                                    <form action="{{ route('insert_new_thumbnail') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                        <label style="cursor: pointer;" class="form-label text-info" for="insert_thumbnail"><i class="fa-solid fa-plus"></i> Add more thumbnails</label>
                                        <input style="display: none;" type="file" id="insert_thumbnail" name="insert_thumbnail" oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                                        <input type="hidden" value="{{ $product_information->id }}" name="product_id">
                                        <style>
                                            .hiddn_div{
                                                display: none;
                                            }
                                        </style>
                                        <div id="show_insert_button" class="hiddn_div">
                                            <div class="mb-1">
                                                <img width="70" height="70" id="pic" />
                                            </div>
                                            <button type="submit" class="btn btn-primary">ADD <i class="fa-solid fa-plus"></i></button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td colspan="3" class="text-center align-middle"><p class="text-success">Maximum thumbnails have been added</p></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
    
<script>
    $("#insert_thumbnail").on('change',function(){
        if ($("#insert_thumbnail")[0].files.length > 0) {
            $('#show_insert_button').attr('class','show');
        }
    }); 
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
    $(".remove_thumbnail").click(function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var link = $(this).attr("name");
                window.location.href = link;
            }
        })
    })
</script>

@endsection