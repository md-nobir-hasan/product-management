@extends('backend.layouts.master')
@push('title')
    Product Selling
@endpush

@section('main-content')
    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="row">
            <div class="col-md-12">
                {{-- @dd(session('error')) --}}
                @include('backend.layouts.notification')
            </div>
        </div>
        <div class="py-3 card-header d-flex justify-content-between">
            <h6 class="float-left m-0 font-weight-bold text-primary">Product Lists</h6>
            {{-- <h6 class="font-weight-bold text-primary">Total: {{ count($count) }} || Active:
                {{ count($count->where('status', 'active')) }} || Inactive: {{ count($count->where('status', 'inactive')) }}
            </h6> --}}
            {{-- @can('Create Product')
                <a href="{{ route('product.create') }}" class="float-right btn btn-primary btn-sm" data-toggle="tooltip"
                    data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Product</a>
            @endcan --}}
        </div>
        <div class="card-body p-3">
            <div class="table-responsive">
                @if (count($products) > 0)
                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf
                        <table class="table table-bordered table-striped text-center" id="product-dataTable" width="100%"
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Title</th>
                                    <th>Code</th>
                                    <th>Branch</th>
                                    <th>Total Buying Cost</th>
                                    <th>Final selling Price</th>
                                    <th>Stock</th>
                                    <th>Photo</th>
                                    @canany('Can Sell')
                                        <th>
                                            <button
                                                class="btn btn-primary d-flex p-0  justify-content-center align-items-center w-80 m-auto fz-20">
                                                <span> Go</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="h-25">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                            </button>
                                        </th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Title</th>
                                     <th>Code</th>
                                    <th>Branch</th>
                                    <th>Total Buying Cost</th>
                                    <th>Final selling Price</th>
                                    <th>Stock</th>
                                    <th>Photo</th>
                                    @canany('Can Sell')
                                        <th>
                                            <button
                                                class="btn btn-primary d-flex p-0  justify-content-center align-items-center w-80 m-auto fz-20">
                                                <span> Go</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="h-25">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                            </button>
                                        </th>
                                    @endcanany
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <a target="_black"
                                                href="{{ route('product.show', $product->id) }}">{{ $product->title }}</a>
                                        <td>{{ $product->code }}</td>
                                        <td>{{ $product->Branch->name }}</td>
                                        <td>৳{{ $product->inventory_cost + $product->dollar_cost + $product->other_cost }}
                                        </td>
                                        <td>৳{{ $product->final_price }}</td>
                                        <td>
                                            @if ($product->stock > 0)
                                                <span class="badge badge-info">{{ $product->stock }}</span>
                                            @else
                                                <span class="badge badge-danger">Out of Stock</span>
                                            @endif
                                        </td>
                                        <td>

                                            @if ($product->photo)
                                                @php
                                                    $photo = explode(',', $product->photo);
                                                    // dd($photo);
                                                @endphp
                                                <img src="{{ $photo[0] }}" class="img-fluid zoom" style="max-width:80px"
                                                    alt="{{ $product->photo }}">
                                            @else
                                                <img src="{{ asset('backend/img/thumbnail-default.jpg') }}"
                                                    class="img-fluid" style="max-width:80px" alt="avatar.png">
                                            @endif
                                        </td>

                                        <td>
                                            <input type="number" name="product[{{ $loop->iteration }}][qty]"
                                                class="text-center w-100 form-control m-auto" value="{{ old('qty') ? old('qty') : 0 }}">
                                                @error("product.$loop->iteration.qty")
                                                    <span class="text-danger">Check the value is possitive, 0 or a integer</span>
                                                @enderror
                                            <input type="hidden" name="product[{{ $loop->iteration }}][id]"
                                                value="{{ $product->id }}">
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                    {{-- <span>{{ $products->links('vendor.pagination.bootstrap-5') }}</span> --}}
                @else
                    <h6 class="text-center">No Products found!!! Please create Product</h6>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        /*   */

        .zoom {
            transition: transform .2s;
            /* Animation */
        }

        .zoom:hover {
            transform: scale(5);
        }

        .display-none {
            display: none;
        }

        .w-100 {
            width: 100px !important;
        }

        .w-80 {
            width: 80px !important;
        }

        .fz-20 {
            font-size: 20px !important;
        }

        .h-25 {
            height: 25px !important;
        }

        .p-0 {
            padding: 0px !important;
        }

        .m-0 {
            margin: 0px !important;
        }
    </style>
@endpush

@push('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $('#product-dataTable').DataTable({
            "scrollX": false,
            "columnDefs": [{
                "orderable": false,
                "targets": [2, 3, 4, 5, 6]
            }]
        });
    </script>
@endpush
