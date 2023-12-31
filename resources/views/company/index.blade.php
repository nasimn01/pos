@extends('layout.app')

@section('pageTitle',trans('Company Details'))
@section('pageSubTitle',trans('Details'))

@section('content')
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
        <div class="card">
                <div class="table-responsive">
                    <div class="card mx-3 index-tbl shadow-sm">
                        <table class="table mb-0 px-2">
                            <thead>
                                <tr class="tbl-th text-center">
                                    <th scope="col">{{__('Company Name')}}</th>
                                    <th scope="col">{{__('Contact')}}</th>
                                    <th scope="col">{{__('Country')}}</th>
                                    <th scope="col">{{__('Division')}}</th>
                                    <th scope="col">{{__('District')}}</th>
                                    <th scope="col">{{__('Upazila')}}</th>
                                    <th scope="col">{{__('Thana')}}</th>
                                    <th scope="col">{{__('Currency')}}</th>
                                    <th scope="col">{{__('Address')}}</th>
                                    <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr class="text-center">
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->contact}}</td>
                                    <td>{{$data->country?->name}}</td>
                                    <td>{{$data->division?->name}}</td>
                                    <td>{{$data->district?->name}}</td>
                                    <td>{{$data->upazila?->name}}</td>
                                    <td>{{$data->thana?->name}}</td>
                                    <td>{{$data->Currency?->currency_name}}</td>
                                    <td>{{$data->address}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.company.edit',encryptor('encrypt',$data->id))}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

