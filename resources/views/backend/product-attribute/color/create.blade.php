@extends('backend.layouts.master')

@push('styles')
    <style>
        .color {
            width: 60px;
        }
    </style>
@endpush

@push('title')
    Add Color
@endpush

@section('main-content')
    <div class="card">
        <h5 class="card-header">Add Color</h5>
        <div class="card-body">
            <form method="post" action="{{ route('pa.color.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Name</label>
                    <input id="inputTitle" type="text" name="name" placeholder="Enter Name of Color"
                        value="{{ old('name') }}" class="form-control">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="code" class="col-form-label">Color Code <span class="text-danger">*</span></label>
                    <input id="code" type="color" name="code" placeholder="Enter The Color Code"
                        value="{{ old('code') ? old('code') : '#000000'}}" class="form-control color">
                    @error('code')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 form-group">
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button class="btn btn-success" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
