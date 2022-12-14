@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <style>
                        .hide{
                            display: none;
                        }
                    </style>
                    <form action="{{ route('category_delete_mark') }}" method="POST">
                    @csrf
                        <div class="card-header">
                            Category Trashed List <button id="marked_btn" class="btn btn-danger float-end hide" type="submit">Delete Marked</button>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>Mark All <input id="checkall" type="checkbox"></td>
                                        <td>SL.</td>
                                        <td>Category Name</td>
                                        <td>Category Icon</td>
                                        <td>Category Image</td>
                                        <td>deleted at</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $index => $category)
                                        <tr>
                                            <td><input id="mark" class="mark" value="{{ $category->id }}" type="checkbox" name="mark[]"></td>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ $category->category_name }}</td>
                                            <td><i class="{{ $category->category_icon }}"></i></td>
                                            <td><img width="20" height="20" src="{{ asset('/frontend/assets/img/categories') }}/{{ $category->category_image }}" alt="{{ $category->category_image }}"></td>
                                            <td>{{ $category->deleted_at->format('Y-M-d') }}</td>
                                            <td>
                                                <a class="btn btn-success" href="{{ route('category_restore', $category->id) }}"><i class="fa-solid fa-trash-can-arrow-up"></i></a>
                                                <a class="btn btn-danger" href="{{ route('category_delete', $category->id) }}"><i class="fab fa-x"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="7">No Data Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')

@if (session('restore'))
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
    title: '{{ session('restore') }}',
  })
</script>
@endif

@if (session('delete'))
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
    title: '{{ session('delete') }}',
  })
</script>
@endif

<script>

    $('#checkall').on('click', function()
    {
        if(document.getElementById("checkall").checked){
            $('.mark').each(function(){
                this.checked = true;
                $('#marked_btn').attr('class', 'btn btn-danger float-end');
            })
        }
        else{
            $('.mark').each(function(){
                this.checked = false;
                $('#marked_btn').attr('class', 'btn btn-danger float-end hide');
            })
        }
    });

    let mark_arr = document.querySelectorAll('.mark');
    let arr = Array.from(mark_arr);

    arr.map(item =>{
        item.addEventListener('click', function(e){
            if($(this).prop('checked') == true)
            {
                $('#marked_btn').attr('class', 'btn btn-danger float-end');
            }
            else{
                $('#marked_btn').attr('class', 'btn btn-danger float-end hide');
            }
        })
    });

</script>

@endsection