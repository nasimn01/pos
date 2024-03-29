@extends('layout.app')
@section('pageTitle',trans('Supplier List'))
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
                    <a class="card-tab " href="{{route(currentUser().'.supplier.create')}}">Add New</a>
                    <a class="card-tab active" href="{{route(currentUser().'.supplier.index')}}">List</a>
                </div>
                <div class="table-responsive mt-5">
                    <div class="card mx-3 index-tbl shadow-sm">
                        <table class="table mb-0 px-2">
                            <thead>
                                <tr class="tbl-th text-center">
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Supplier')}}</th>
                                    <th scope="col">{{__('Contact')}}</th>
                                    <th scope="col">{{__('Email')}}</th>
                                    <th scope="col">{{__('Phone')}}</th>
                                    <th scope="col">{{__('TAX Number')}}</th>
                                    <th scope="col">{{__('Fax Number')}}</th>
                                    <th scope="col">{{__('Opening balance')}}</th>
                                    <th scope="col">{{__('Country')}}</th>
                                    <th scope="col">{{__('State')}}</th>
                                    <th scope="col">{{__('City')}}</th>
                                    <th class="white-space-nowrap">{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($suppliers as $sup)
                                <tr class="text-center">
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$sup->supplier_name}}</td>
                                    <td>{{$sup->contact}}</td>
                                    <td>{{$sup->email}}</td>
                                    <td>{{$sup->phone}}</td>
                                    <td>{{$sup->tax_number}}</td>
                                    <td>{{$sup->fax}}</td>
                                    <td>{{$sup->opening_balance}}</td>
                                    <td>{{$sup->country?->name}}</td>
                                    <td>{{$sup->division?->name}}</td>
                                    <td>{{$sup->district?->name}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.supplier.edit',encryptor('encrypt',$sup->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a class="text-danger" href="javascript:void()" onclick="$('#form{{$sup->id}}').submit()">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        <form id="form{{$sup->id}}" onsubmit="return confirm('Are you sure?')" action="{{route(currentUser().'.supplier.destroy',encryptor('encrypt',$sup->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="12" class="text-center">No Pruduct Found</th>
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