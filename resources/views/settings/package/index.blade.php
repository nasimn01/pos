@extends('layout.app')
@section('pageTitle',trans('Package List'))
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
                    <a class="card-tab" href="{{route(currentUser().'.package.create')}}">Add New</a>
                    <a class="card-tab active" href="{{route(currentUser().'.package.index')}}">List</a>
                </div>
                <div class="table-responsive mt-5">
                    <div class="card mx-3 index-tbl shadow-sm">
                        <table class="table mb-0 px-2">
                            <thead>
                                <tr class="tbl-th text-center">
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Package Name')}}</th>
                                    <th scope="col">{{__('Package Day')}}</th>
                                    <th scope="col">{{__('Price')}}</th>
                                    <th scope="col">{{__('Package Color')}}</th>
                                    <th scope="col">{{__('Package Feature')}}</th>
                                    <th scope="col">{{__('Status')}}</th>
                                    <th class="white-space-nowrap">{{__('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $d)
                                <tr class="text-center">
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$d->package_name}}</td>
                                    <td>{{$d->package_day}} Days</td>
                                    <td>{{$d->price}}</td>
                                    <td><input type="color"value="{{$d->package_code}}" disabled></td>
                                    <td>
                                        <ul class="text-start">
                                            @foreach(explode(',', $d->package_feature) as $feature)
                                            <li>{{$feature}}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $d->status == 1?"Active":"Inactive" }}</td>
                                    <td class="white-space-nowrap">
                                        <a class="text-primary" href="{{route(currentUser().'.package.edit',encryptor('encrypt',$d->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a class="text-danger" href="javascript:void()" onclick="$('#form{{$d->id}}').submit()">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        <form id="form{{$d->id}}" onsubmit="return confirm('Are you sure?')" action="{{route(currentUser().'.package.destroy',encryptor('encrypt',$d->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
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