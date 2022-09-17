@extends('master')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h3 class="mb-0">{{__('Transaction')}}</h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                    <th>{{__('NO#')}}</th>
                                    <th>{{__('TRANSACTION ID')}}</th>
                                    <th>{{__('SENDER')}}</th>
                                    <th>{{__('RECEIVER')}}</th>                                                                      
                                    <th>{{__('DEBIT')}}</th>
                                    <th>{{__('CREDIT')}}</th>
                                    <th>{{__('TYPE')}}</th>
                                    <th>{{__('BALANCE')}}</th>
                                    <th>{{__('TIME')}}</th>    
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $k=>$transaction)
                                <tr>
                                    <td>{{++$k}}.</td>
                                    <td>{{ $transaction->transaction_id??'' }}</td>
                                    <td>{{ \App\CentralLogics\Helpers::get_user_info($transaction->from_user_id)->first_name ?? '' }} {{ \App\CentralLogics\Helpers::get_user_info($transaction->from_user_id)->phone ?? '' }}</td>
                                    <td>
                                        <span>
                                            @if ($transaction['to_user_id']==NULL)
                                                {{ __('Admin') }}
                                            @else
                                                {{ \App\CentralLogics\Helpers::get_user_info($transaction->to_user_id)->first_name ?? '' }} {{ \App\CentralLogics\Helpers::get_user_info($transaction->to_user_id)->last_name ?? '' }} 
                                            @endif
                                        </span>
                                    </td>
                                    <td>{{ App\CentralLogics\Helpers::set_symbol($transaction->debit, $transaction->currency) }}</td>
                                    <td>{{ App\CentralLogics\Helpers::set_symbol($transaction->credit, $transaction->currency) }}</td>
                                    <td>
                                        <span class="badge badge-pill badge-primary">{{__("message.{$transaction['transaction_type']}")}}</span>
                                    </td>
                                    <td>
                                        @if($transaction->status==0)
                                            <span class="badge badge-pill badge-info">{{__('Active')}}</span>
                                        @elseif($transaction->status==1)
                                            <span class="badge badge-pill badge-danger">{{__('Blocked')}}</span> 
                                        @endif
                                    </td>   
                                    <td>{{date("Y/m/d h:i:A", strtotime($transaction->created_at))}}</td>                
                                </tr>
                                @endforeach               
                            </tbody>                          
                        </table>
                    </div>
                </div>
            </div>
        </div>
@stop