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
                                    <a class="btn btn-primary" href="">Change Image</a>
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
                                    <a class="btn btn-danger" href="">Remove Thumbnail</a>
                                </td>
                            </tr> 
                            @endforeach
                            @if ($product_thumbnails->count() < 4)
                            <tr>
                                <td colspan="3" class="text-center align-middle"><a class="text-info" href=""><i class="fa-solid fa-plus"></i> Add more thumbnails</a></td>
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