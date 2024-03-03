@extends('backend.layouts.master')

@push('title')
    Product Details
@endpush

@section('main-content')
    <div class="card">
        <div class="card-header" style="display: flex !important ; justify-content: space-between; align-items: center">
            <h2>Product</h2>
            <a href="{{ url()->previous() }}" class="shadow-sm d btn btn-sm btn-primary" style="display: inline-block">
                Back
            </a>
        </div>
        <div class="card-body">
            @if ($product)
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Quantity</th>
                            <th>Branch</th>
                            <th>Total Buying Cost</th>
                            <th>Final selling Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->Branch->name }}</td>
                            <td>৳{{ $product->inventory_cost + $product->dollar_cost + $product->other_cost }}</td>
                            <td>৳{{ $product->final_price }}</td>
                            <td>
                                @if ($product->status == 'active')
                                    <span class="badge badge-success">{{ $product->status }}</span>
                                @else
                                    <span class="badge badge-warning">{{ $product->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('product.edit', $product->id) }}"
                                    class="float-left mr-1 btn btn-primary btn-sm"
                                    style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit"
                                    data-placement="bottom"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('product.destroy', [$product->id]) }}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm dltBtn" data-id={{ $product->id }}
                                        style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                        data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <section class="confirmation_part section_padding">
                    <div class="order_boxes">
                        <div class="row">
                            <div class="col-lg-6 col-lx-4">
                                {{-- Product's main attributes  --}}
                                <div class="order-info">
                                    <h4 class="pb-4 text-center">Product Attributes</h4>
                                    {{-- <h5 class="pb-4 text-center">Main Attributes</h5> --}}

                                    <table class="table">
                                        <tr class="">
                                            <td>Code</td>
                                            <td> : {{ $product->code }}</td>
                                        </tr>
                                        <tr class="">
                                            <td>Inventory Cost</td>
                                            <td> : {{ $product->inventory_cost }}</td>
                                        </tr>
                                        <tr class="">
                                            <td>Dollar cost</td>
                                            <td> : {{ $product->dollar_cost }}</td>
                                        </tr>
                                        <tr class="">
                                            <td>Other Cost</td>
                                            <td> : {{ $product->other_cost }}</td>
                                        </tr>
                                        <tr>
                                            <td>Selling Pirce</td>
                                            <td> : {{ $product->price }} </td>
                                        </tr>
                                        <tr>
                                            <td>Discount</td>
                                            <td> : {{ $product->discount }}</td>
                                        </tr>
                                        <tr>
                                            <td>Stock</td>
                                            <td> : {{ $product->stock }}</td>
                                        </tr>
                                        <tr>
                                            <td>Branch</td>
                                            <td> : {{ $product->Branch->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Size</td>
                                            <td> : {{ $product->Size->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Color</td>
                                            <td> :
                                                {{ $product->Color->name }})
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>

                            <div class="col-lg-6 col-lx-4">
                                <div>
                                    {{-- Buying Calculation  --}}
                                    <div class="shipping-info">
                                        <h4 class="pb-4 text-center">Buying Calculation</h4>
{{--
                                        <table class="table">
                                            <tr>
                                                <td>Processor Model</td>
                                                <td> : {{ $product->ProcessorModel?->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Processor Generation</td>
                                                <td> : {{ $product->ProcessorGeneration?->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Processor Brand</td>
                                                <td> : {{ $product->p_brand }}</td>
                                            </tr>
                                            <tr>
                                                <td>Processor Speed</td>
                                                <td> : {{ $product->c_speed }}</td>
                                            </tr>
                                            <tr>
                                                <td>L1 Cache</td>
                                                <td> : {{ $product->l1_cache }}</td>
                                            </tr>
                                            <tr>
                                                <td>L2 Cache</td>
                                                <td> : {{ $product->l2_cache }}</td>
                                            </tr>
                                            <tr>
                                                <td>L3 Cache</td>
                                                <td> : {{ $product->l3_cache }}</td>
                                            </tr>
                                            <tr>
                                                <td>Processor Core</td>
                                                <td> : {{ $product->p_core }}</td>
                                            </tr>
                                            <tr>
                                                <td>Processor Core</td>
                                                <td> : {{ $product->p_thread }}</td>
                                            </tr>
                                            <tr>
                                                <td>Others Info</td>
                                                <td> : {{ $product->p_other }}</td>
                                            </tr>

                                        </table> --}}
                                    </div>

                                    {{-- Selling Calculation  --}}
                                    <div class="">
                                        <div class="shipping-info">
                                            <h4 class="pb-4 text-center">Selling Calculation</h4>
                                            {{-- <table class="table">
                                                <tr>
                                                    <td>Display Type</td>
                                                    <td> : {{ $product->DisplayType?->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Display Size</td>
                                                    <td> : {{ $product->DisplaySize?->size }}
                                                        inch</td>
                                                </tr>
                                                <tr>
                                                    <td>Display Resolutioin</td>
                                                    <td> : {{ $product->d_resolution }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Display</td>
                                                    <td> : {{ $product->d_resolution }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Display Touch</td>
                                                    <td> : {{ $product->touch_screen ? 'Yes' : 'No' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Other Features</td>
                                                    <td> : {{ $product->d_other }}</td>
                                                </tr>
                                            </table> --}}
                                        </div>
                                    </div>

                                    {{-- Loss/Profit Calculation  --}}
                                    <div class="">
                                        <div class="shipping-info">
                                            <h4 class="pb-4 text-center">Loss Profit Calculation</h4>
                                            {{-- <table class="table">
                                                <tr>
                                                    <td>Keyboard Type</td>
                                                    <td> : {{ $product->k_type }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Backlight</td>
                                                    <td> : {{ $product->k_backlight ? 'Yes' : 'No' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Touchpad</td>
                                                    <td> : {{ $product->touchpad ? 'Yes' : 'No' }}</td>
                                                </tr>

                                                <tr>
                                                    <td>Other Features</td>
                                                    <td> : {{ $product->k_other }}</td>
                                                </tr>
                                            </table> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </section>

                <section class="mt-5">
                    <h1 class="text-center" style="text-decoration: underline">Products Photos</h1>
                    <div class="text-center">
                        @php
                            $photo = explode(',', $product->photo);
                        @endphp
                        @foreach ($photo as $pto)
                            <img src="{{ $pto }}" class="mx-auto rounded img-fluid img-thumbnail" alt="...">
                        @endforeach
                    </div>
                </section>
            @endif

        </div>
    </div>
@endsection

@push('styles')
    <style>
        .order-info,
        .shipping-info {
            background: #ECECEC;
            padding: 20px;
        }

        .order-info h4,
        .shipping-info h4 {
            text-decoration: underline;
        }
    </style>
@endpush
