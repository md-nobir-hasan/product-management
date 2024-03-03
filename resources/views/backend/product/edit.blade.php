@extends('backend.layouts.master')
@push('title')
    Edit Product
@endpush
@section('main-content')
    <div class="card">
        <h5 class="card-header">Edit Product</h5>
        <div class="card-body">
            <form method="post" action="{{ route('product.update', [$product->id]) }}">
                {{ csrf_field() }}
                @method('PUT')

                <div>
                    <div class="form-group">
                        <label for="inputTitle" class="col-form-label">Title<span class="text-danger">*</span></label>
                        <input id="inputTitle" type="text" name="title" placeholder="Exp:- Enter title"
                            value="{{ $product->title }}" class="form-control">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="code" class="col-form-label">Code<span class="text-danger">*</span></label>
                        <input id="code" type="text" name="code" placeholder="Exp:- Enter Manufacture Name"
                            value="{{ $product->code }}" class="form-control">
                        @error('code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="inventory_cost" class="col-form-label">Buying Price<span
                                class="text-danger">*</span></label>
                        <input id="inventory_cost" type="number" name="inventory_cost" min="0" max="9999999"
                            placeholder="Exp:- Enter the Buying Price of the product"
                            value="{{ $product->inventory_cost }}" class="form-control">
                        @error('inventory_cost')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="dollar_cost" class="col-form-label">Dollar Cost</label>
                        <input id="dollar_cost" type="number" name="dollar_cost" min="0" max="9999999"
                            placeholder="Exp:- Enter the Buying Price of the product"
                            value="{{ $product->dollar_cost }}" class="form-control">
                        @error('dollar_cost')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="other_cost" class="col-form-label">Other Cost</label>
                        <input id="other_cost" type="number" name="other_cost" min="0" max="9999999"
                            placeholder="Exp:- Enter the Buying Price of the product"
                            value="{{ $product->other_cost }}" class="form-control">
                        @error('other_cost')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price" class="col-form-label">Selling Price(BDT)<span
                                class="text-danger">*</span>
                        </label>
                        <input id="price" type="text" name="price" placeholder="Exp:- Enter price" step=".1"
                            value="{{ $product->price }}" class="form-control" min="0" max="999999">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="discount" class="col-form-label">Discount(BDT)</label>
                        <input id="discount" type="number" name="discount" min="0" max="9999999"
                            placeholder="Exp:- Enter discount" value="{{ $product->discount }}"
                            class="form-control">
                        @error('discount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group" id="final_price_div">
                        <label for="final_price" class="col-form-label">Final Price(tk)<span
                                class="text-danger">*</span></label>
                        <input id="final_price" type="number" name="final_price" min="0" max="9999999"
                            placeholder="Exp:- Enter Final Price" value="{{ $product->final_price }}" class="form-control">
                        @error('final_price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="color_id">Branch<span class="text-danger">*</span></label>
                        <select name="branch_id" class="form-control">
                            <option value="">--Select Branch--</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}" @selected($branch->id == $product->branch_id)>{{ $branch->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('branch_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="size_id">Size</label>
                        <select name="size_id" class="form-control">
                            <option value="">--Select Size--</option>
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id }}" @selected($size->id == $product->size_id)>{{ $size->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('size_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="color_id">Color</label>
                        <select name="color_id" class="form-control">
                            <option value="">--Select color--</option>
                            @foreach ($colors as $color)
                                <option value="{{ $color->id }}" @selected($color->id == $product->color_id)>{{ $color->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('color_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock<span class="text-danger">*</span></label>
                        <input id="quantity" type="number" name="stock" min="1" step="1"
                            max="99999" placeholder="Exp:- Enter quantity"
                            value="{{ $product->stock }}" class="form-control">
                        @error('stock')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPhoto" class="col-form-label">Photo<span class="text-danger">*</span> </label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Choose
                            </a>
                        </span>
                        <input id="thumbnail" class="form-control" type="text" name="photo"
                            value="{{ $product->photo }}">
                    </div>
                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    @error('photo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status" class="col-form-label">Status </label>
                    <select name="status" class="form-control">
                        <option value="active" @selected('active' == $product->status)>Active</option>
                        <option value="inactive" @selected('inactive' == $product->status)>Inactive</option>
                    </select>
                    @error('status')
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
{{--
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/summernote/summernote-lite.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush --}}
@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    {{-- <script src="{{ asset('backend/summernote/summernote-lite.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script> --}}

    <script>
        $('#lfm').filemanager('image');

       $(document).ready(function() {

            $('#final_price_div').hide();

            $('#price').on('keyup', function() {

                let price = $('#price').val() ? $('#price').val() : '0';
                let discount = $('#discount').val() ? $('#discount').val() : 0;
                let final_price = Number(price) - Number(discount);

                $('#final_price').val(final_price);
                $('#final_price_div').show();
            });

            $('#discount').on('keyup', function() {
                let price = $('#price').val() ? $('#price').val() : '0';
                let discount = $('#discount').val() ? $('#discount').val() : 0;
                let final_price = Number(price) - Number(discount);

                $('#final_price').val(final_price);
                $('#final_price_div').show();
            });

            // $('#cat_id').change(function() {
            //     var cat_id = $(this).val();
            //     // alert(cat_id);
            //     if (cat_id != null) {
            //         // Ajax call
            //         $.ajax({
            //             url: "/admin/category/" + cat_id + "/child",
            //             data: {
            //                 _token: "{{ csrf_token() }}",
            //                 id: cat_id
            //             },
            //             type: "POST",
            //             success: function(response) {
            //                 if (typeof(response) != 'object') {
            //                     response = $.parseJSON(response)
            //                 }
            //                 // console.log(response);
            //                 var html_option =
            //                     "<option value=''>----Select sub category----</option>"
            //                 if (response.status) {
            //                     var data = response.data;
            //                     // alert(data);
            //                     if (response.data) {
            //                         $('#child_cat_div').removeClass('d-none');
            //                         $.each(data, function(id, title) {
            //                             html_option += "<option value='" + id + "'>" +
            //                                 title +
            //                                 "</option>"
            //                         });
            //                     } else {}
            //                 } else {
            //                     $('#child_cat_div').addClass('d-none');
            //                 }
            //                 $('#child_cat_id').html(html_option);
            //             }
            //         });
            //     } else {}
            // });

        });
    </script>
@endpush
