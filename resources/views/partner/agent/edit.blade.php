@extends('partnerlayout')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">{{__('Update Agent Information')}}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('partner.agent.update') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Username')}}</label>
                                <div class="col-lg-10">
                                    <input type="hidden" value="{{ $client->id }}" name="id">
                                    <input type="text" name="username" class="form-control" value="{{$client->business_name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Agent First Name')}}</label>
                                <div class="col-lg-10">
                                    <input type="text" name="first_name" class="form-control" value="{{$client->first_name}}">
                                </div>
                            </div>                          
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Agent Last Name')}}</label>
                                <div class="col-lg-10">
                                    <input type="text" name="last_name" class="form-control" value="{{$client->last_name}}">
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Address')}}</label>
                                <div class="col-lg-10">
                                    <input type="text" name="email" class="form-control" value="{{$client->email}}">
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Country')}}</label>
                                <div class="col-lg-10">
                                    <input type="text" name="country" class="form-control" value="{{$client->country}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Phone Number')}}</label>
                                <div class="col-lg-10">
                                    <input type="text" name="phone" class="form-control" value="{{$client->phone}}">
                                </div>
                            </div>        
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Branch')}}</label>
                                <div class="col-lg-10">
                                  <select class="form-control select" name="branch" required>
                                      <option value="">{{__('Select Branch')}}</option> 
                                        @foreach($branch as $val)
                                          <option value="{{ $val->name }}">{{ $val->name }}</option>
                                        @endforeach
                                  </select>
                                </div>
                              </div>                                                                               
                            <div class="text-right">
                                <button type="submit" class="btn btn-success btn-sm">{{__('Save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
