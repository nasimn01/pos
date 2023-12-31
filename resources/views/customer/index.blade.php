@extends('layout.app')
@section('pageTitle',trans('Customer List'))
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
                    <a class="card-tab" href="{{route(currentUser().'.customer.create')}}">Add New</a>
                    <a class="card-tab active" href="{{route(currentUser().'.customer.index')}}">List</a>
                </div>
                <!-- table bordered -->
                <div class="table-responsive mt-5">
                    <div class="card mx-3 index-tbl shadow-sm">
                        <table class="table mb-0 px-2">
                            <thead>
                                <tr class="tbl-th text-center">
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Customer')}}</th>
                                    <th scope="col">{{__('Contact')}}</th>
                                    <th scope="col">{{__('Email')}}</th>
                                    <th scope="col">{{__('Phone')}}</th>
                                    <th scope="col">{{__('TAX Number')}}</th>
                                    <th scope="col">{{__('GST Number')}}</th>
                                    <th scope="col">{{__('Opening balance')}}</th>
                                    <th scope="col">{{__('Country')}}</th>
                                    <th scope="col">{{__('Division')}}</th>
                                    <th scope="col">{{__('District')}}</th>
                                    <th class="white-space-nowrap">{{__('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customers as $sup)
                                <tr class="text-center">
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$sup->customer_name}}</td>
                                    <td>{{$sup->contact}}</td>
                                    <td>{{$sup->email}}</td>
                                    <td>{{$sup->phone}}</td>
                                    <td>{{$sup->tax_number}}</td>
                                    <td>{{$sup->gst_number}}</td>
                                    <td>{{$sup->opening_balance}}</td>
                                    <td>{{$sup->country?->name}}</td>
                                    <td>{{$sup->division?->name}}</td>
                                    <td>{{$sup->district?->name}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.customer.edit',encryptor('encrypt',$sup->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        {{-- <a href="javascript:void()" onclick="$('#form{{$sup->id}}').submit()">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        <form id="form{{$sup->id}}" action="{{route(currentUser().'.customer.destroy',encryptor('encrypt',$sup->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form> --}}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="8" class="text-center">No Pruduct Found</th>
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