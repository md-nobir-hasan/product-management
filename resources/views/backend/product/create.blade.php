@extends('backend.layouts.master')
@push('title')
    Add Product
@endpush
@section('main-content')
    <div class="card">
        <h5 class="card-header">Add Product</h5>
        <div class="card-body">
            <form method="post" action="{{ route('product.store') }}">
                {{ csrf_field() }}
                <div>
                    <div class="form-group">
                        <label for="inputTitle" class="col-form-label">Title<span class="text-danger">*</span></label>
                        <input id="inputTitle" type="text" name="title" placeholder="Exp:- Enter title"
                            value="{{ old('title') }}" class="form-control">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="code" class="col-form-label">Code<span class="text-danger">*</span></label>
                        <input id="code" type="text" name="code" placeholder="Exp:- Enter Manufacture Name"
                            value="{{ old('code') }}" class="form-control">
                        @error('code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="inventory_cost" class="col-form-label">Buying Price<span class="text-danger">*</span></label>
                        <input id="inventory_cost" type="number" name="inventory_cost" min="0" max="1000000"
                            placeholder="Exp:- Enter the Buying Price of the product"
                            value="{{ old('inventory_cost') ?? '0' }}" class="form-control">
                        @error('inventory_cost')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="dollar_cost" class="col-form-label">Dollar Cost</label>
                        <input id="dollar_cost" type="number" name="dollar_cost" min="0" max="9999999"
                            placeholder="Exp:- Enter the Buying Price of the product"
                            value="{{ old('dollar_cost') ?? '0' }}" class="form-control">
                        @error('dollar_cost')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="other_cost" class="col-form-label">Other Cost</label>
                        <input id="other_cost" type="number" name="other_cost" min="0" max="9999999"
                            placeholder="Exp:- Enter the Buying Price of the product"
                            value="{{ old('other_cost') ?? '0' }}" class="form-control">
                        @error('other_cost')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price" class="col-form-label">Selling Price(BDT)<span class="text-danger">*</span>
                        </label>
                        <input id="price" type="text" name="price" placeholder="Exp:- Enter price" step="1"
                            value="{{ old('price') }}" class="form-control">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="discount" class="col-form-label">Discount(BDT)</label>
                        <input id="discount" type="number" name="discount" min="0" max="9999999"
                            placeholder="Exp:- Enter discount" value="{{ old('discount') ? old('discount') : 0 }}"
                            class="form-control">
                        @error('discount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group" id="final_price_div">
                        <label for="final_price" class="col-form-label">Final Price(tk)<span
                                class="text-danger">*</span></label>
                        <input id="final_price" type="number" name="final_price" min="0" max="9999999"
                            placeholder="Exp:- Enter Final Price" value="{{ old('final_price') }}" class="form-control">
                        @error('final_price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="color_id">Branch<span class="text-danger">*</span></label>
                        <select name="branch_id" class="form-control">
                            <option value="">--Select Branch--</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}" @selected($branch->id == old('branch_id'))>{{ $branch->name }}
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
                                <option value="{{ $size->id }}" @selected($size->id == old('size_id'))>{{ $size->name }}
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
                                <option value="{{ $color->id }}" @selected($color->id == old('color_id'))>{{ $color->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('color_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- <div class="form-group">
                        <label for="summary" class="col-form-label">Summary</label>
                        <textarea class="form-control" id="summary" name="summary">{{ old('summary') }}</textarea>
                        @error('summary')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    {{-- <div class="form-group">
                        <label for="description" class="col-form-label">Description</label>
                        <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}
                    {{--
                    <div class="form-group">
                        <label for="brand_id">Brand</label>
                        <select name="brand_id" class="form-control">
                            <option value="">--Select Brand--</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" @selected($brand->id == old('brand_id'))>{{ $brand->title }}
                                </option>
                            @endforeach
                        </select>
                    </div> --}}

                    {{-- {{$categories}} --}}
                    {{-- <div class="form-group">
                        <label for="cat_id">Category </label>
                        <select name="cat_id" id="cat_id" class="form-control">
                            <option value="">--Select any category--</option>
                            @foreach ($categories as $key => $cat_data)
                                <option value='{{ $cat_data->id }}' @selected($cat_data->id == old('cat_id'))>{{ $cat_data->title }}
                                </option>
                            @endforeach
                        </select>
                    </div> --}}

                    {{-- <div class="form-group d-none" id="child_cat_div">
                        <label for="child_cat_id">Sub Category</label>
                        <select name="child_cat_id" id="child_cat_id" class="form-control">
                            <option value="">--Select any category--</option>

                        </select>
                    </div> --}}

                    {{-- <div class="form-group">
                        <label for="is_featured">Is Featured</label><br>
                        <input type="checkbox" name='is_featured' @checked(old('is_featured')) id='is_featured'
                            value='1'>
                        <label for="is_featured">Yes</label>
                    </div> --}}

                    {{-- <div class="form-group">
                        <label for="upcomming_toggler">Up Comming</label><br>
                        <input type="checkbox" name='upcomming_toggler' @checked(old('upcomming_toggler'))
                            id='upcomming_toggler' value='1'>
                        <label for="upcomming_toggler">Yes</label>
                        <div class="ml-3" id="div_lunch_date">
                            <label for="upcomming" class="col-form-label">Product Lunch Date </label>
                            <input id="upcomming" type="date" name="upcomming"
                                placeholder="Exp:- Enter Product Lunch Date" value="{{ old('upcomming') }}"
                                class="form-control">
                            @error('upcomming')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> --}}

                    {{-- <div class="form-group">
                        <label for="isOfferToggler">Is Offer Products</label><br>
                        <input type="checkbox" name='isOfferToggler' @checked(old('isOfferToggler')) id='isOfferToggler'
                            value='1'>
                        <label for="isOfferToggler">Yes</label>
                        <div class="ml-3" id="div_product_offer">
                            <label for="product_offer_id" class="col-form-label">Select an offer </label>
                            <select name="product_offer_id" class="form-control" id="product_offer_id">
                                <option value="" hidden>Choose....</option>
                                @foreach ($product_offers as $poffer)
                                    <option value="{{ $poffer->id }}" @selected($poffer->id == old('product_offer_id'))>
                                        {{ $poffer->title . ' (' . $poffer->dis }}%)
                                    </option>
                                @endforeach
                            </select>
                            @error('product_offer_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> --}}

                    {{-- <div class="form-group">
                        <label for="speacial_feature">Special Features </label>
                        <select name="special_feature[]" class="form-control selectpicker" id="speacial_feature"
                            multiple>
                            <option value="" hidden>Choose....</option>
                            @foreach ($special_features as $sp)
                                <option value="{{ $sp->name }}" @selected($sp->name == old('speacial_feature'))>{{ $sp->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('speacial_feature')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    <div class="form-group">
                        <label for="stock">Stock<span class="text-danger">*</span></label>
                        <input id="quantity" type="number" name="stock" min="1" step="1" max="99999"
                            placeholder="Exp:- Enter quantity" value="{{ old('stock') ? old('stock') : 1 }}" class="form-control">
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
                            value="{{ old('photo') }}">
                    </div>
                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    @error('photo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status" class="col-form-label">Status </label>
                    <select name="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
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

{{-- @push('styles')

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <link rel="stylesheet" href="{{ asset('backend/summernote/summernote-lite.css') }}">
@endpush --}}
@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('backend/summernote/summernote-lite.js') }}"></script> --}}

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
