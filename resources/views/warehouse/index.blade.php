@extends('layout.app')

@section('pageTitle',trans('Warehouse List'))
@section('pageSubTitle',trans('List'))

@section('content')
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="text-end me-3">
                    <a class="float-end" href="{{route(currentUser().'.warehouse.create')}}"style="font-size:1.7rem"><i class="bi bi-plus-square-fill"></i></a>
                </div>
                <div class="table-responsive">
                    <div class="card mx-3 index-tbl shadow-sm">
                        <table class="table mb-0 px-2">
                            <thead>
                                <tr class="tbl-th text-center">
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Branch')}}</th>
                                    <th scope="col">{{__('Name')}}</th>
                                    <th scope="col">{{__('Contact')}}</th>
                                    <th scope="col">{{__('Address')}}</th>
                                    <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($warehouses as $war)
                                <tr class="text-center">
                                <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$war->branch->name}}</td> 
                                    <td>{{$war->name}}</td>
                                    <td>{{$war->contact}}</td>
                                    <td>{{$war->address}}</td>
                                    
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.warehouse.edit',encryptor('encrypt',$war->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        
                                        <form id="form{{$war->id}}" action="{{route(currentUser().'.warehouse.destroy',encryptor('encrypt',$war->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="6" class="text-center">No Warehouse Found</th>
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

