@extends('partnerlayout')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">{{__('Update Branch Information')}}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('partner.branch.update') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Business name')}}</label>
                                <div class="col-lg-10">
                                    <input type="hidden" value="{{ $client->id }}" name="id">
                                    <input type="text" name="name" class="form-control" value="{{$client->name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Branch Chief')}}</label>
                                <div class="col-lg-10">
                                    <input type="text" name="chief" class="form-control" value="{{$client->chief}}">
                                </div>
                            </div>                          
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Mobile')}}</label>
                                <div class="col-lg-10">
                                    <input type="text" name="mobile" class="form-control" value="{{$client->mobile}}">
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Address')}}</label>
                                <div class="col-lg-10">
                                    <input type="text" name="address" class="form-control" readonly value="{{$client->address}}">
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('State')}}</label>
                                <div class="col-lg-10">
                                    <input type="text" name="state" class="form-control" readonly value="{{$client->state}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Country')}}</label>
                                <div class="col-lg-10">
                                    <input type="text" name="country" class="form-control" value="{{$client->country}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Zip Code')}}</label>
                                <div class="col-lg-10">
                                    <input type="text" name="zipcode" class="form-control" value="{{$client->zip_code}}">
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Postal Code')}}</label>
                                <div class="col-lg-10">
                                    <input type="text" name="postal" class="form-control" value="{{$client->postal_code}}">
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
