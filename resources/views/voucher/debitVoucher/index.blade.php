@extends('layout.app')
@section('pageTitle',trans('Debit Voucher List'))
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
                    <a class="card-tab " href="{{route(currentUser().'.debit.create')}}">Add New</a>
                    <a class="card-tab active" href="{{route(currentUser().'.debit.index')}}">List</a>
                </div>
                <div class="table-responsive mt-5">
                    <div class="card mx-3 index-tbl shadow-sm">
                        <table class="table mb-0 px-2">
                            <thead>
                                <tr class="tbl-th text-center">
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Voucher No')}}</th>
                                    <th scope="col">{{__('Date')}}</th>
                                    <th scope="col">{{__('Pay Name')}}</th>
                                    <th scope="col">{{__('Purpose')}}</th>
                                    <th scope="col">{{__('Amount')}}</th>
                                    <th class="white-space-nowrap">{{__('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($debitVoucher as $cr)
                                <tr class="text-center">
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$cr->voucher_no}}</td>
                                    <td>{{date('d/m,Y',strtotime($cr->current_date))}}</td>
                                    <td>{{$cr->pay_name}}</td>
                                    <td>{{$cr->purpose}}</td>
                                    <td>{{$cr->debit_sum}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.debit.edit',encryptor('encrypt',$cr->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="7" class="text-center">No Data Found</th>
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