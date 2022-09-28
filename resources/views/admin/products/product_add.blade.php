@extends('layouts.dashboard')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    ADD PRODUCTS
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Category*</label>
                                <select class="form-control" name="" id="">
                                    <option value="">-- Select Category --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Sub-Category</label>
                                <select class="form-control" name="" id="">
                                    <option value="">-- Select Sub-Category --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Name*</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Price*</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Discount</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label for="" class="form-label">Discount Price*</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Short Description*</label>
                                <textarea style="resize: none;" class="form-control" name="" id="" cols="5" rows="3"></textarea>
                            </div>
                        </div>
                        <style>
                            #long_desp .note-editor .note-editing-area .note-editable{
                                height: 150px;
                            }
                        </style>
                        <div class="col-lg-12">
                            <div class="mb-3" id="long_desp">
                                <label for="" class="form-label">Long Description</label>
                                <textarea cols="5" rows="3" id="summernote"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Image*</label>
                                <input type="file" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Image Thumbnails <span class="text-primary">(Only 4 Thumbnail Can be Added)</span></label>
                                <input type="file" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-primary">SUBMIT</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_script')
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>
@endsection