@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4">
                                <h4>Category List</h4>
                            </div>
                            <div class="col-lg-3">
                                <select class="form-control text-center" name="" id="">
                                    <option value="">--- Search Category ---</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-5">
                                <a class="btn btn-primary float-end" href="{{ route('subCategory_add') }}"><i class="fas fa-plus"></i>ADD SUB-CATEGORY</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>SL.</td>
                                    <td class="text-success">Category Name</td>
                                    <td>Sub-Category Name</td>
                                    <td>Created by</td>
                                    <td>Created at</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subcategories as $index => $subcategory)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td class="text-success">{{ $subcategory->rel_to_category->category_name }}</td>
                                        <td>{{ $subcategory->subcategory_name }}</td>
                                        <td>{{ $subcategory->rel_to_user->name }}</td>
                                        <td>{{ $subcategory->created_at->format('Y-M-d') }}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{ route('category_edit', $subcategory->id) }}"><i class="fa-solid fa-pencil"></i></a>
                                            <a class="btn btn-danger" href="{{ route('subcategory_soft_delete', $subcategory->id) }}"><i class="fa-solid fa-trash"></i></a>
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