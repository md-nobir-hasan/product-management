@extends('backend.layouts.master')
@push('title')
    Add Size
@endpush
@section('main-content')
    <div class="card">
        <h5 class="card-header">Add Size</h5>
        <div class="card-body">
            <form method="post" action="{{ route('pa.size.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name" class="col-form-label">Name</label>
                    <input id="name" type="text" name="name" placeholder="Enter size name"
                        value="{{ old('name') }}" class="form-control">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="measurement" class="col-form-label">measurement (inch)</label>
                    <input id="measurement" step=".1" type="number" name="measurement of the size" placeholder="Enter measurement of the size"
                        value="{{ old('measurement of the size') }}" class="form-control">
                    @error('measurement of the size')
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
