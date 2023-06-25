@extends('layout.app')
@section('pageTitle',trans('District List'))
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
                    <a class="card-tab" href="{{route(currentUser().'.district.create')}}">Add New</a>
                    <a class="card-tab active" href="{{route(currentUser().'.district.index')}}">List</a>
                </div>
                <div class="table-responsive mt-5">
                    <div class="card mx-3 index-tbl shadow-sm">
                        <table class="table mb-0 px-2">
                            <thead>
                                <tr class="tbl-th text-center">
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Division')}}</th>
                                    <th scope="col">{{__('District')}}</th>
                                    <th scope="col">{{__('District bn')}}</th>
                                    <th class="white-space-nowrap">{{__('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($districts as $d)
                                <tr class="text-center">
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$d->division?->name}}</td>
                                    <td>{{$d->name}}</td>
                                    <td>{{$d->name_bn}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.district.edit',encryptor('encrypt',$d->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <!--<a href="javascript:void()" onclick="$('#form{{$d->id}}').submit()">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        <form id="form{{$d->id}}" action="{{route(currentUser().'.country.destroy',encryptor('encrypt',$d->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>-->
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
                </div>
            </div>
        </div>
    </div>
</section>
@endsection