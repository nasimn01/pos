@extends('layout.app')
@section('pageTitle',trans('Country List'))
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
                    <a class="card-tab" href="{{route(currentUser().'.country.create')}}">Add New</a>
                    <a class="card-tab active" href="{{route(currentUser().'.country.index')}}">List</a>
                </div>
                <div class="table-responsive mt-5">
                    <div class="card mx-3 index-tbl shadow-sm">
                        <table class="table mb-0 px-2">
                            <thead>
                                <tr class="tbl-th text-center">
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Country')}}</th>
                                    <th scope="col">{{__('Country bn')}}</th>
                                    <th scope="col">{{__('Code')}}</th>
                                    <th class="white-space-nowrap">{{__('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($countries as $d)
                                <tr class="text-center">
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$d->name}}</td>
                                    <td>{{$d->name_bn}}</td>
                                    <td>{{$d->code}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.country.edit',encryptor('encrypt',$d->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        
                                        <form id="form{{$d->id}}" action="{{route(currentUser().'.country.destroy',encryptor('encrypt',$d->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
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