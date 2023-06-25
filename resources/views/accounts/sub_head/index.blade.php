@extends('layout.app')
@section('pageTitle',trans('Sub Head List'))
@section('pageSubTitle',trans('List'))

@section('content')
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-tabs">
                    <a class="card-tab " href="{{route(currentUser().'.sub_head.create')}}">Add New</a>
                    <a class="card-tab active" href="{{route(currentUser().'.sub_head.index')}}">List</a>
                </div>
                <div class="table-responsive mt-5">
                    <div class="card mx-3 index-tbl shadow-sm">
                        <table class="table mb-0 px-2">
                            <thead>
                                <tr class="tbl-th text-center">
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Master Head')}}</th>
                                    <th scope="col">{{__('Sub Head')}}</th>
                                    <th scope="col">{{__('Opening Balance')}}</th>
                                    <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $d)
                                <tr class="text-center">
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$d->master_account?->head_name}} - {{$d->master_account?->head_code}}</td>
                                    <td>{{$d->head_name}} - {{$d->head_code}}</td>
                        
                                    <td>{{$d->opening_balance}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.sub_head.edit',encryptor('encrypt',$d->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        {{-- <a href="javascript:void()" onclick="$('#form{{$d->id}}').submit()">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        <form id="form{{$d->id}}" action="{{route(currentUser().'.sub_head.destroy',encryptor('encrypt',$d->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                            
                                        </form> --}}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="5" class="text-center">No data Found</th>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end my-3">
                            {!! $data->links()!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection