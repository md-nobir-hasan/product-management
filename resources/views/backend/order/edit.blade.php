@extends('backend.layouts.master')
@push('title')
    Edit Order
@endpush
@section('title', 'Order Detail')

@section('main-content')
    <div class="card">
        {{-- @dd($errors) --}}
           {{-- @if($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-danger">{{$error}}</li>
            @endforeach
        </ul>
    @endif --}}
        <h5 class="card-header">Order Edit</h5>
        <div class="card-body">
            <form action="{{ route('order.update', 1) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="order-dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Title</th>
                                <th>Quantity</th>
                                <th>Selling Price</th>
                                <th>Discount</th>
                                <th>Final Price</th>
                                <th>Branch</th>
                                <th>Order Status</th>
                                {{-- <th>Payment Status</th> --}}
                                {{-- @canany('Edit Order')
                                    <th>Action</th>
                                @endcanany --}}
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>S.N.</th>
                                <th>Title</th>
                                <th>Quantity</th>
                                <th>Selling Price</th>
                                <th>Discount</th>
                                <th>Final price</th>
                                <th>Branch</th>
                                <th>Order Status</th>
                                {{-- <th>Payment Status</th> --}}
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($new_orders as $order)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $order->product->title }}
                                        <input type="hidden" name="order[{{ $loop->iteration }}][id]" value="{{$order->id}}">
                                    </td>
                                    <td>
                                        <input type="number" name="order[{{ $loop->iteration }}][qty]" min="1"
                                            max="9999" value="{{ $order->qty }}" class="form-control qty">
                                        @error("order.$loop->iteration.qty")
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="number" name="order[{{ $loop->iteration }}][selling_price]"
                                           value="{{ $order->selling_price }}"
                                            class="form-control selling_price">
                                        @error("order.$loop->iteration.selling_price")
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="number" name="order[{{ $loop->iteration }}][order_discount]"
                                            value="{{ $order->order_discount }}" class="form-control order_discount">
                                        @error("order.$loop->iteration.order_discount")
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="number" name="order[{{ $loop->iteration }}][final_price]" i
                                            value="{{ $order->final_price }}"
                                            class="form-control final_price">
                                        @error("order.$loop->iteration.final_price")
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td>
                                        <select name="order[{{ $loop->iteration }}][branch_id]" class="form-control">
                                            <option value="">--Select Branch--</option>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}" @selected($branch->id == $order->branch_id)>
                                                    {{ $branch->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error("order.$loop->iteration.branch_id")
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>

                                    <td>
                                        <select name="order[{{ $loop->iteration }}][order_status]" class="form-control">
                                            <option value="">--Select Order Status--</option>
                                            @foreach ($order_statuses as $order_status)
                                                <option value="{{ $order_status->title }}" @selected($order_status->title == $order->order_status)>
                                                    {{ $order_status->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error("order.$loop->iteration.order_status")
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.selling_price').each(function(index) {
                $(this).on('keyup change', function() {
                    let price = $('.selling_price').eq(index).val() ? $('.selling_price').eq(index)
                        .val() : '0';
                    let discount = $('.order_discount').eq(index).val() ? $('.order_discount').eq(
                        index).val() : 0;
                    let qty = Number($('.qty').eq(index).val() ? $('.qty').eq(
                        index).val() : 0);
                    let final_price = Number(price) - Number(discount);

                    $('.final_price').eq(index).val(final_price * qty);
                });
            });

            $('.order_discount').each(function(index) {
                $(this).on('keyup change', function() {
                    let price = $('.selling_price').eq(index).val() ? $('.selling_price').eq(index)
                        .val() : '0';
                    let discount = $('.order_discount').eq(index).val() ? $('.order_discount').eq(
                        index).val() : 0;
                    let qty = Number($('.qty').eq(index).val() ? $('.qty').eq(
                        index).val() : 0);
                    let final_price = Number(price) - Number(discount);

                    $('.final_price').eq(index).val(final_price * qty);
                });
            });

            $('.qty').each(function(index) {
                $(this).on('change keyup', function() {
                    let price = $('.selling_price').eq(index).val() ? $('.selling_price').eq(index)
                        .val() : '0';
                    let discount = $('.order_discount').eq(index).val() ? $('.order_discount').eq(
                        index).val() : 0;
                    let qty = Number($('.qty').eq(index).val() ? $('.qty').eq(
                        index).val() : 0);
                    let final_price = Number(price) - Number(discount);

                    $('.final_price').eq(index).val(final_price * qty);
                });
            })

        })
    </script>
@endpush
