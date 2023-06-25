@extends('layout.app')
@section('pageTitle',trans('Brand List'))
@section('pageSubTitle',trans('List'))

@section('content')
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                    <div class="card-tabs">
                        <a class="card-tab" href="{{route(currentUser().'.brand.create')}}">Add New</a>
                        <a class="card-tab active" href="{{route(currentUser().'.brand.index')}}">List</a>
                    </div>
                    <div class="table-responsive mt-5">
                        <div class="card mx-3 index-tbl shadow-sm">
                            <table class="table mb-0 px-2">
                                <thead>
                                    <tr class="tbl-th text-center">
                                        <th scope="col">{{__('#SL')}}</th>
                                        <th scope="col">{{__('Name')}}</th>
                                        <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($brands as $b)
                                    <tr class="text-center">
                                    <th scope="row">{{ ++$loop->index }}</th>
                                        <td>{{$b->name}}</td>
                                        <td class="white-space-nowrap">
                                            <a href="{{route(currentUser().'.brand.edit',encryptor('encrypt',$b->id))}}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            {{-- <a href="javascript:void()" onclick="$('#form{{$b->id}}').submit()">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                            <form id="form{{$b->id}}" action="{{route('brand.destroy',$b->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                
                                            </form> --}}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <th colspan="3" class="text-center">No Pruduct Found</th>
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