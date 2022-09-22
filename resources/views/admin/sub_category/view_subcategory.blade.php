@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-middle">
                        Category List
                        <a class="btn btn-primary float-end" href="{{ route('category_add') }}"><i class="fas fa-plus"></i>ADD CATEGORY</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>SL.</td>
                                    <td>Category Name</td>
                                    <td>Category Icon</td>
                                    <td>Category Image</td>
                                    <td>Created by</td>
                                    <td>Created at</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $index => $category)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td><i class="{{ $category->category_icon }}"></i></td>
                                        <td><img width="20" height="20" src="{{ asset('/frontend/assets/img/categories') }}/{{ $category->category_image }}" alt="{{ $category->category_image }}"></td>
                                        <td>{{ $category->rel_to_user->name }}</td>
                                        <td>{{ $category->created_at->format('Y-M-d') }}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{ route('category_edit', $category->id) }}"><i class="fa-solid fa-pencil"></i></a>
                                            <a class="btn btn-danger" href="{{ route('category_soft_delete', $category->id) }}"><i class="fa-solid fa-trash"></i></a>
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
@if (session('soft_delete'))
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
    title: '{{ session('soft_delete') }}',
  })
</script>
@endif
@endsection