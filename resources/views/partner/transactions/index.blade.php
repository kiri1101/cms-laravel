@extends('partnerlayout')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">
@endsection

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-body">
                     {{-- <a href="{{ route('partner.newagent') }}" class="btn btn-sm btn-neutral">
                         <em class="fas fa-plus"></em> {{ __('New Agent') }}
                     </a> --}}
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header header-elements-inline">
                <div class="row">
                    <div class="col-6">
                        <h3 class="mb-0">{{__('Transactions')}}</h3>
                    </div>                 
                </div>
            </div>
            <div class="table-responsive py-4">
                <table class="table table-flush" id="datatable-buttons" aria-labelledby="Transactions Table">
                    <thead>
                        <tr>
                            <th>{{__('S/N')}}</th>
                            <th class="scope"></th>    
                            <th>{{__('Branch')}}</th>
                            <th>{{__('Agent Name')}}</th>
                            <th>{{__('Type')}}</th>                                                                      
                            <th>{{__('Status')}}</th>
                            <th>{{__('Sender')}}</th>
                            <th>{{__('Receiver')}}</th>
                            <th>{{__('Currency')}}</th>
                            <th>{{__('Amount')}}</th>
                            <th>{{__('Fee')}}</th>
                            <th>{{__('Sum')}}</th>
                            <th>{{__('Created')}}</th>
                            <th>{{__('Updated')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($transaction as $k=>$val)
                        <tr>
                            <td>{{++$k}}.</td>
                            <td class="text-right">
                            <div class="dropdown">
                                    <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <em class="fad fa-chevron-circle-down"></em>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a href="" class="dropdown-item">{{__('Manage Transaction')}}</a>
                                        <a data-toggle="modal" data-target="#delete{{$val->id}}" href="" class="dropdown-item">{{__('Delete')}}</a>
                                    </div>
                                </div>
                            </td>
                            {{-- <td>{{$val->first_name.' '.$val->last_name}}</td> --}}
                            <td>{{ $val->branch }}</td>
                            <td>{{$val->agent}}</td>
                            <td>{{$val->type}}</td>
                            <td>{{ $val->status }}</td>
                            <td>{{ $val->sender }}</td>
                            <td>{{ $val->receiver }}</td>
                            <td>{{ $val->currency }}</td>
                            <td>{{ $val->amount }}</td>
                            <td>{{ $val->fee }}</td>
                            <td>{{ $val->sum }}</td>
                            <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>  
                            <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>                   
                        </tr>
                        @endforeach               
                    </tbody>                    
                </table>
            </div>
        </div>
        {{-- @foreach($transaction as $k=>$val)
        <div class="modal fade" id="delete{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card bg-white border-0 mb-0">
                            <div class="card-header">
                                <h3 class="mb-0">{{__('Are you sure you want to delete this?')}}</h3>
                            </div>
                            <div class="card-body px-lg-5 py-lg-5 text-right">
                                <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                <a  href="{{route('partner.agent.delete', ['id' => $val->id])}}" class="btn btn-danger btn-sm">{{__('Proceed')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach   --}}
@endsection