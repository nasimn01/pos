@extends('layout.app')
@section('pageTitle',trans('Product List'))
@section('pageSubTitle',trans('List'))

@section('content')
<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-tabs">
                    <a class="card-tab" href="{{route(currentUser().'.product.create')}}">Add New</a>
                    <a class="card-tab active" href="{{route(currentUser().'.product.index')}}">List</a>
                </div>
                <div class="row pb-1 px-3 mt-5">
                    <div class="col-md-6">
                        <form action="" method="get">
                            <div class="input-group">
                                <input type="text" name="name" value="{{isset($_GET['name'])?$_GET['name']:''}}" placeholder="Product name or item code" class="form-control">
                                <div class="input-group-append ms-1">
                                    <button class="btn btn-sm btn-info" type="submit">Search</button>
                                    <a class="btn btn-sm btn-warning" href="{{route(currentUser().'.product.index')}}" title="Clear">Clear</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="table-responsive ">
                    <div class="card mx-3 index-tbl shadow-sm">
                        <table class="table mb-0 px-2">
                            <thead>
                                <tr class="tbl-th text-center">
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Brand')}}</th>
                                    <th scope="col">{{__('Category')}}</th>
                                    <th scope="col">{{__('Sub Category')}}</th>
                                    <th scope="col">{{__('Child Category')}}</th>
                                    <th scope="col">{{__('Item Code')}}</th>
                                    <th scope="col">{{__('Name')}}</th>
                                    <th scope="col">{{__('Unit Stule')}}</th>
                                    <th scope="col">{{__('Image')}}</th>
                                    <th scope="col">{{__('Status')}}</th>
                                    <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $p)
                                <tr class="text-center">
                                <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$p->brand?->name}}</td>
                                    <td>{{$p->category?->category}}</td>
                                    <td>{{$p->subcategory?->name}}</td>
                                    <td>{{$p->childcategory?->name}}</td>
                                    <td>{{$p->item_code}}</td>
                                    <td>{{$p->product_name}}</td>
                                    <td>{{$p->unitStyle?->name}}</td>
                                        <td><img width="80px" height="40px" class="float-first" src="{{asset('images/product/'.company()['company_id'].'/'.$p->image)}}" alt=""></td>
                                    <td>@if($p->status == 1) Active @else Inactive @endif</td>
                                    <!-- or <td>{{ $p->status == 1?"Active":"Inactive" }}</td>-->
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.product.edit',encryptor('encrypt',$p->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        {{-- <a href="javascript:void()" onclick="$('#form{{$p->id}}').submit()">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        <form id="form{{$p->id}}" action="{{route(currentUser().'.product.destroy',encryptor('encrypt',$p->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                            
                                        </form> --}}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="11" class="text-center">No Pruduct Found</th>
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