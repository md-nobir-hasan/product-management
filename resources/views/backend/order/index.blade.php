@extends('backend.layouts.master')
@push('title')
    Orders
@endpush
@section('main-content')
    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="row">
            <div class="col-md-12">
                @include('backend.layouts.notification')
            </div>
        </div>
        <div class="py-3 card-header d-flex justify-content-between">
            <h6 class="float-left m-0 font-weight-bold text-primary">Order Lists</h6>
            <h6 class="font-weight-bold text-primary">
                Total: {{ count($count) }} ||
                Delivered: {{ count($count->where('order_status', 'Delivered')) }} ||
                Cancelled: {{ count($count->where('order_status', 'Canceled')) }} ||
                New: {{ count($count->where('order_status', 'New')) }} ||
                Pending: {{ count($count->where('order_status', 'Pending')) }}
                Processing: {{ count($count->where('order_status', 'Processing')) }}
            </h6>
            <h6>
                <a href="{{ route('selling') }}"><button type="button" class="btn btn-primary">Go to Selling</button> </a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (count($orders) > 0)
                    <table class="table table-bordered table-striped text-center" id="order-dataTable" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Title</th>
                                <th>Code</th>
                                <th>Quantity</th>
                                <th>Branch</th>
                                <th>Selling Price</th>
                                <th>Discount</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                @canany(['Edit Order', 'Delete Order'])
                                    <th>Action</th>
                                @endcanany
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>S.N.</th>
                                <th>Title</th>
                                <th>Code</th>
                                <th>Quantity</th>
                                <th>Branch</th>
                                <th>Selling Price</th>
                                <th>Discount</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                @canany(['Edit Order', 'Delete Order'])
                                    <th>Action</th>
                                @endcanany
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->product?->title }}</td>
                                    <td>{{ $order->product?->code }}</td>
                                    <td>{{ $order->qty }}</td>
                                    <td>{{ $order->Branch?->name }}</td>
                                    <td>{{ $order->selling_price }}</td>
                                    <td>{{ $order->order_discount }}</td>
                                    <td>{{ $order->final_price }}</td>
                                    <td>
                                        @if ($order->order_status == 'New')
                                            <span class="badge badge-primary">{{ $order->order_status }}</span>
                                        @elseif($order->order_status == 'Pending')
                                            <span class="badge badge-info">{{ $order->order_status }}</span>
                                        @elseif($order->order_status == 'Processing')
                                            <span class="badge badge-warning">{{ $order->order_status }}</span>
                                        @elseif($order->order_status == 'Delivered')
                                            <span class="badge badge-success">{{ $order->order_status }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ $order->order_status }}</span>
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-center align-items-center">

                                        @if ($order->is_cancelled)
                                            <a href="{{ route('order.uncancel', [$order->id]) }}" onclick="confirm('Are you sure. The product returned from the default branch to the previous branch')"
                                                class="float-left btn btn-success btn-sm mr-1 p-0"
                                                style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                                title="Uncancel" data-placement="bottom">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                            </a>
                                        @else
                                          {{-- @dd($order->is_cancelled,0); --}}
                                            <a href="{{ route('order.cancel', [$order->id]) }}" onclick="confirm('Are you sure. The product returned to the default branch')"
                                                class="float-left mr-1 btn btn-danger btn-sm p-0"
                                                style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                                title="Cancel" data-placement="bottom">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>

                                            </a>
                                        @endif

                                        @can('Edit Order')
                                            <a href="{{ route('order.edit', $order->id) }}"
                                                class="float-left mr-1 btn btn-primary btn-sm"
                                                style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                                title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                        @endcan
                                        @can('Delete Order')
                                            <form method="POST" action="{{ route('order.destroy', [$order->id]) }}">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm dltBtn" data-id={{ $order->id }}
                                                    style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                                    data-placement="bottom" title="Delete"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <span>{{ $orders->links('vendor.pagination.bootstrap-5') }}</span>
                @else
                    <h6 class="text-center">No orders found!!! Please order some products</h6>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <style>
        div.dataTables_wrapper div.dataTables_paginate {
            display: none;
        }
    </style>
@endpush

@push('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
    <script>
        $('#order-dataTable').DataTable({
            "columnDefs": [{
                "orderable": false,
                "targets": [8]
            }]
        });

        // Sweet alert

        function deleteData(id) {

        }
    </script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.dltBtn').click(function(e) {
                var form = $(this).closest('form');
                var dataID = $(this).data('id');
                // alert(dataID);
                e.preventDefault();
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this data!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        } else {
                            swal("Your data is safe!");
                        }
                    });
            })
        })
    </script>
@endpush
