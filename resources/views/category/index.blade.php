@extends('layout.app')

@section('pageTitle',trans('Category List'))
@section('pageSubTitle',trans('List'))

@section('content')
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-tabs">
                    <a class="card-tab" href="{{route(currentUser().'.category.create')}}">Add New</a>
                    <a class="card-tab active" href="{{route(currentUser().'.category.index')}}">List</a>
                </div>
                    <!-- table bordered -->
                    <div class="table-responsive mt-5">
                        <div class="card mx-3 index-tbl shadow-sm">
                            <table class="table mb-0 px-2">
                                <thead>
                                    <tr class="tbl-th text-center">
                                        <th scope="col">{{__('#SL')}}</th>
                                        <th scope="col">{{__('Name')}}</th>
                                        <th scope="col">{{__('Image')}}</th>
                                        <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($categories as $cat)
                                    <tr class="text-center">
                                    <th scope="row">{{ ++$loop->index }}</th>
                                        <td>{{$cat->category}} ({{$cat->products->count()}})</td>
                                        <td><img width="80px" height="40px" class="float-first" src="{{asset('images/category/'.company()['company_id'].'/'.$cat->image)}}" alt=""></td>
                                        <td class="white-space-nowrap">
                                            <a href="{{route(currentUser().'.category.edit',encryptor('encrypt',$cat->id))}}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <!-- <a href="javascript:void()" onclick="$('#form{{$cat->id}}').submit()">
                                                <i class="bi bi-trash"></i>
                                            </a> -->
                                            <form id="form{{$cat->id}}" action="{{route(currentUser().'.category.destroy',encryptor('encrypt',$cat->id))}}" method="post">
                                                @csrf
                                                @method('delete')
                                                
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <th colspan="4" class="text-center">No Category Found</th>
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

