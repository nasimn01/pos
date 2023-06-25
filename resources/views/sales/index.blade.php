@extends('layout.app')
@section('pageTitle',trans('Sales List'))
@section('pageSubTitle',trans('List'))

@section('content')
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                @if(Session::has('response'))
                {!!Session::get('response')['message']!!}
                @endif
                <div class="card-tabs">
                    <a class="card-tab " href="{{route(currentUser().'.sales.create')}}">Add New</a>
                    <a class="card-tab active" href="{{route(currentUser().'.sales.index')}}">List</a>
                </div>
                <!-- table bordered -->
                <div class="table-responsive mt-5">
                    <div class="card mx-3 index-tbl shadow-sm">
                        <table class="table mb-0 px-2">
                            <thead>
                                <tr class="tbl-th text-center">
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Customer')}}</th>
                                    <th scope="col">{{__('Date')}}</th>
                                    <th scope="col">{{__('Reference Number')}}</th>
                                    <th scope="col">{{__('Total QTY')}}</th>
                                    <th scope="col">{{__('Sub Amount')}}</th>
                                    <th scope="col">{{__('TAX')}}</th>
                                    <th scope="col">{{__('Discount Type')}}</th>
                                    <th scope="col">{{__('Discount')}}</th>
                                    <!-- <th scope="col">{{__('RoundOf')}}</th> -->
                                    <th scope="col">{{__('GrandTotal')}}</th>
                            
                                
                                    <th scope="col">{{__('Branch')}}</th>
                                    <th scope="col">{{__('Warehouse')}}</th>
                                    <th scope="col">{{__('Status')}}</th>
                                    <th scope="col">{{__('Payment Status')}}</th>
                                    <th class="white-space-nowrap">{{__('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sales as $s)
                                <tr class="text-center">
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$s->customer?->customer_name}}</td>
                                    <td>{{$s->sales_date}}</td>
                                    <td>{{$s->reference_no}}</td>
                                    <td>{{$s->total_quantity}}</td>
                                    <td>{{$s->sub_amount}}</td>
                                    <td>{{$s->tax}}</td>
                                    <td>{{$s->discount_type}}</td>
                                    <td>{{$s->discount}}</td>
                                    <!-- <td>{{$s->round_of}}</td> -->
                                    <td>{{$s->grand_total}}</td>
                                
                                
                                    <td>{{$s->branch?->name}}</td>
                                    <td>{{$s->warehouse?->name}}</td>
                                    <td>{{$s->status}}</td>
                                    <td>{{$s->payment_status}}</td>
                                    <td class="white-space-nowrap">
                                        {{-- <a href="{{route(currentUser().'.sales.edit',encryptor('encrypt',$s->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a> --}}
                                        {{--<a href="javascript:void()" onclick="$('#form{{$s->id}}').submit()">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        <form id="form{{$s->id}}" action="{{route(currentUser().'.purchase.destroy',encryptor('encrypt',$pur->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>--}}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="18" class="text-center">No Pruduct Found</th>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection