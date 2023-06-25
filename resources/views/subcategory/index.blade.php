@extends('layout.app')
@section('pageTitle',trans('Subcategory List'))
@section('pageSubTitle',trans('List'))

@section('content')
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-tabs">
                    <a class="card-tab" href="{{route(currentUser().'.subcategory.create')}}">Add New</a>
                    <a class="card-tab active" href="{{route(currentUser().'.subcategory.index')}}">List</a>
                </div>
                <div class="table-responsive mt-5">
                    <div class="card mx-3 index-tbl shadow-sm">
                        <table class="table mb-0 px-2">
                            <thead>
                                <tr class="tbl-th text-center">
                                <th scope="col">{{__('#SL')}}</th>
                                <th scope="col">{{__('Category')}}</th>
                                <th scope="col">{{__('Name')}}</th>
                                <th class="white-space-nowrap">{{__('ACTION')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                                @forelse($subcategories as $sub)
                                <tr class="text-center">
                                <th scope="row">{{ ++$loop->index }}</th>

                                    <td>{{$sub->category?->category}}</td>
                                    <td>{{$sub->name}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.subcategory.edit',encryptor('encrypt',$sub->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    
                                        <form id="form{{$sub->id}}" action="{{route(currentUser().'.subcategory.destroy',encryptor('encrypt',$sub->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                            
                                        </form>
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