@extends('backend.layouts.master')
@push('title')
    Update Size
@endpush
@section('main-content')
    <div class="card">
        <h5 class="card-header">Update Size</h5>
        <div class="card-body">
            <form method="post" action="{{ route('pa.size.update', $datum->id) }}">
                {{ csrf_field() }}
                @method('PUT')
                <div class="form-group">
                    <label for="name" class="col-form-label">Name</label>
                    <input id="name" type="text" name="name" placeholder="Enter size name"
                        value="{{ $datum->name }}" class="form-control">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="measurement" class="col-form-label">Size (inch)</label>
                    <input id="measurement" step=".1" type="number" name="measurement" placeholder="Enter measurement"
                        value="{{ $datum->measurement }}" class="form-control">
                    @error('measurement')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 form-group">
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
