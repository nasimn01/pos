@extends('layout.app')
@section('pageTitle','Unit List')
@section('pageSubTitle','List')

@section('content')
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-tabs">
                    <a class="card-tab " href="{{route(currentUser().'.unit.create')}}">Add New</a>
                    <a class="card-tab active" href="{{route(currentUser().'.unit.index')}}">List</a>
                </div>
                <div class="row pb-1 px-3 mt-5">
                    <div class="col-md-6">
                        <form action="" method="get">
                            <div class="input-group index-search">
                                <input type="text" name="name" value="{{isset($_GET['name'])?$_GET['name']:''}}" placeholder="Name" class="form-control">
                                <div class="input-group-append ms-1">
                                    <button class="btn btn-sm btn-info py-2" type="submit">Search</button>
                                    <a class="btn btn-sm btn-warning py-2" href="{{route(currentUser().'.unit.index')}}" title="Clear">Clear</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- table bordered -->
                <div class="table-responsive">
                    <div class="card mx-3 index-tbl shadow-sm">
                        <table class="table mb-0 px-2">
                            <thead>
                                <tr class="tbl-th text-center">
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Name')}}</th>
                                    <th scope="col">{{__('Style Name')}}</th>
                                    <th scope="col">{{__('Quantity')}}</th>
                                    <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($units as $data)
                                <tr class="text-center">
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->ustyle?->name}}</td>
                                    <td>{{$data->qty}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.unit.edit',encryptor('encrypt',$data->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        {{-- <a href="javascript:void()" onclick="$('#form{{$data->id}}').submit()">
                                            <i class="bi bi-trash"></i>
                                        </a> -->
                                        <form id="form{{$data->id}}" action="{{route(currentUser().'.unitstyle.destroy',encryptor('encrypt',$data->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>--}}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="5" class="text-center">No Data Found</th>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="pt-2">
                        {{$units->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

