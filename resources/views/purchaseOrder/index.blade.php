@extends('layout.app')
@section('pageTitle',trans('Purchase List'))
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
                    <a class="card-tab" href="{{route(currentUser().'.purchaseOrder.create')}}">Add New</a>
                    <a class="card-tab active" href="{{route(currentUser().'.purchaseOrder.index')}}">List</a>
                </div>
                <!-- table bordered -->
                <div class="table-responsive mt-5">
                    <div class="card mx-3 index-tbl shadow-sm">
                        <table class="table mb-0 px-2">
                            <thead>
                                <tr class="tbl-th text-center">
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Supplier')}}</th>
                                    <th scope="col">{{__('Date')}}</th>
                                    <th scope="col">{{__('Warehouse')}}</th>
                                    <th scope="col">{{__('Status')}}</th>
                                    <th class="white-space-nowrap">{{__('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($purchasesOrder as $pur)
                                <tr>
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$pur->supplier?->supplier_name}}</td>
                                    <td>{{$pur->date}}</td>
                                    <td>{{$pur->warehouse?->name}}</td>
                                    <td>{{$pur->status}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.purchaseOrder.edit',encryptor('encrypt',$pur->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a class="text-danger" href="javascript:void()" onclick="$('#form{{$pur->id}}').submit()">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        <form id="form{{$pur->id}}" onsubmit="return confirm('Are you sure?')" action="{{route(currentUser().'.purchaseOrder.destroy',encryptor('encrypt',$pur->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
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