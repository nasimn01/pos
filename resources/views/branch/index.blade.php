@extends('layout.app')

@section('pageTitle',trans('Branch List'))
@section('pageSubTitle',trans('List'))

@section('content')
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
        <div class="card">
                <div class="card-tabs">
                    <a class="card-tab" href="{{route(currentUser().'.branch.create')}}">Add New</a>
                    <a class="card-tab active" href="{{route(currentUser().'.branch.index')}}">List</a>
                </div>
                <div class="table-responsive mt-5">
                    <div class="card mx-3 index-tbl shadow-sm">
                        <table class="table mb-0 px-2">
                            <thead>
                                <tr class="tbl-th text-center">
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Name')}}</th>
                                    <th scope="col">{{__('Contact')}}</th>
                                    <th scope="col">{{__('Bin Number')}}</th>
                                    <th scope="col">{{__('Trade Number')}}</th>
                                    <th scope="col">{{__('Address')}}</th>
                                    <th scope="col">{{__('Currency')}}</th>
                                    <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($branchs as $cat)
                                <tr class="text-center">
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$cat->name}}</td>
                                    <td>{{$cat->contact}}</td>
                                    <td>{{$cat->binNumber}}</td>
                                    <td>{{$cat->tradeNumber}}</td>
                                    <td>{{$cat->address}}</td>
                                    <td>{{$cat->Currency?->currency_name}}</td>
                                    
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.branch.edit',encryptor('encrypt',$cat->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                            {{-- <a href="javascript:void()" onclick="$('#form{{$cat->id}}').submit()">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        <form id="form{{$cat->id}}" action="{{route(currentUser().'.branch.destroy',encryptor('encrypt',$cat->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form> --}}
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

