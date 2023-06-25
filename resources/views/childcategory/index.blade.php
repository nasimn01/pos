@extends('layout.app')
@section('pageTitle',trans('Childcategory List'))
@section('pageSubTitle',trans('List'))

@section('content')
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                    <div class="card-tabs">
                        <a class="card-tab" href="{{route(currentUser().'.childcategory.create')}}">Add New</a>
                        <a class="card-tab active" href="{{route(currentUser().'.childcategory.index')}}">List</a>
                    </div>
                    <div class="table-responsive mt-5">
                        <div class="card mx-3 index-tbl shadow-sm">
                            <table class="table mb-0 px-2">
                                <thead>
                                    <tr class="tbl-th text-center">
                                        <th scope="col">{{__('#SL')}}</th>
                                        <th scope="col">{{__('Sub Category')}}</th>
                                        <th scope="col">{{__('Child Category')}}</th>
                                        <th class="white-space-nowrap">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($childcategories as $child)
                                    <tr class="text-center">
                                    <th scope="row">{{ ++$loop->index }}</th>
                                        <td>{{$child->subcategory?->name}}</td>
                                        <td>{{$child->name}}</td>
                                        <td class="white-space-nowrap">
                                            <a href="{{route(currentUser().'.childcategory.edit',encryptor('encrypt',$child->id))}}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <!-- <a href="javascript:void()" onclick="$('#form{{$child->id}}').submit()">
                                                <i class="bi bi-trash"></i>
                                            </a> -->
                                            <!-- <form id="form{{$child->id}}" action="{{route(currentUser().'.childcategory.destroy',encryptor('encrypt',$child->id))}}" method="post">
                                                @csrf
                                                @method('delete')
                                                
                                            </form> -->
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <th colspan="4" class="text-center">No Data Found</th>
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