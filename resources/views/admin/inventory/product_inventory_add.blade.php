@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8"></div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    ADD Inventory
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <label for="" class="form-label">Product Color</label>
                        <select class="form-control" name="color_id">
                            <option value="">-- Select Color --</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Product Size</label>
                        <select class="form-control" name="color_id">
                            <option value="">-- Select Size Type --</option>
                        </select>
                        <input type="checkbox"> No Size Available
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</div>
@endsection