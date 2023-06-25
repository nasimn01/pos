@extends('layout.app')
@section('pageTitle',trans('Business Type List'))
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
                    <a class="card-tab" href="{{route(currentUser().'.business.create')}}">Add New</a>
                    <a class="card-tab active" href="{{route(currentUser().'.business.index')}}">List</a>
                </div>
                <!-- table bordered -->
                <div class="table-responsive mt-5">
                    <div class="card mx-3 index-tbl shadow-sm">
                        <table class="table mb-0 px-2">
                            <thead>
                                <tr class="tbl-th text-center">
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Name')}}</th>
                                    <th class="white-space-nowrap">{{__('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $d)
                                <tr class="text-center">
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$d->name}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.business.edit',encryptor('encrypt',$d->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="3" class="text-center">No Data Found</th>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="pt-2">
                            {{$data->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection