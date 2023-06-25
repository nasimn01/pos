@extends('layout.app')
@section('pageTitle',trans('Transfer List'))
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
                    <a class="card-tab " href="{{route(currentUser().'.transfer.create')}}">Add New</a>
                    <a class="card-tab active" href="{{route(currentUser().'.transfer.index')}}">List</a>
                </div>
                <div>
                <div class="table-responsive mt-5">
                    <div class="card mx-3 index-tbl shadow-sm">
                        <table class="table mb-0 px-2">
                            <thead>
                                <tr class="tbl-th text-center">
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('From Branch')}}</th>
                                    <th scope="col">{{__('From Warehouse')}}</th>
                                    <th scope="col">{{__('To Warehouse')}}</th>
                                    <th scope="col">{{__('Trasfer Date')}}</th>
                                    <th scope="col">{{__('Quantity')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transfers as $s)
                                <tr class="text-center">
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$s->branch?->name}}</td>
                                    <td>{{$s->warehousef?->name}}</td>
                                    <td>{{$s->warehouset?->name}}</td>
                                    <td>{{$s->transfer_date}}</td>
                                    <td>{{$s->quantity}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="6" class="text-center">No Data Found</th>
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