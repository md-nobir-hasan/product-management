@extends('backend.layouts.master')
@push('title')
    Others Settings
@endpush
@section('main-content')
    <div class="card">
        @include('backend.layouts.notification')
        <h5 class="card-header">Edit Others setting</h5>
        <div class="card-body">
            <form method="post" action="{{ route('setting.os.update') }}">
                @csrf

                   <div class="form-group">
                        <label for="color_id">Default Branch<span class="text-danger">*</span></label>
                        <select name="branch_id" class="form-control">
                            <option value="">--Select Branch--</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}" @selected($branch->id == $data->branch_id)>{{ $branch->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('branch_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                <div class="form-group">
                    <label for="fb" class="col-form-label">Facebook</label>
                    <input id="fb" type="url" name="fb" placeholder="Enter Facebook"
                        value="{{ $data->fb }}" class="form-control">
                    @error('fb')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="youtube" class="col-form-label">Youtube</label>
                    <input id="youtube" type="url" name="youtube" placeholder="Enter YouTube"
                        value="{{ $data->youtube }}" class="form-control">
                    @error('youtube')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="twitter" class="col-form-label">Twitter</label>
                    <input id="twitter" type="url" name="twitter" placeholder="Enter Twitter"
                        value="{{ $data->twitter }}" class="form-control">
                    @error('twitter')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="linkedin" class="col-form-label">LinkedIn</label>
                    <input id="linkedin" type="url" name="linkedin" placeholder="Enter LinkedIn"
                        value="{{ $data->linkedin }}" class="form-control">
                    @error('linkedin')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 form-group">
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/summernote/summernote-lite.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{ asset('backend/summernote/summernote-lite.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
        $('#lfm').filemanager('image');
        $('#lfm1').filemanager('image');
        $(document).ready(function() {
            $('#summary').summernote({
                placeholder: "Write short description.....",
                tabsize: 2,
                height: 150
            });
        });

        $(document).ready(function() {
            $('#quote').summernote({
                placeholder: "Write short Quote.....",
                tabsize: 2,
                height: 100
            });
        });
        $(document).ready(function() {
            $('#description').summernote({
                placeholder: "Write detail description.....",
                tabsize: 2,
                height: 150
            });
        });
    </script>
@endpush
