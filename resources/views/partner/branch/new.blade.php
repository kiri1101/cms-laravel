@extends('partnerlayout')
@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
      <div class="row">
          <div class="col-md-12">
              <div class="card border-0 mb-0">
                  <div class="card-header">
                      <h3 class="mb-0">{{__('New Branch')}}</h3>
                  </div>
                  <div class="card-body">
                      <form action="{{route('create.branch')}}" method="post">
                          @csrf
                          <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                          <div class="form-group row">
                              <div class="col-lg-12">
                                  <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Branch Name" required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors }}</strong>
                                    </span>
                                    @enderror
                              </div>
                          </div>
                          {{-- <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="text" name="chief" class="form-control @error('chief') is-invalid @enderror" value="{{ old('chief') }}" placeholder="Branch Chief" required>
                                  @error('chief')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors }}</strong>
                                  </span>
                                  @enderror
                            </div>
                          </div> --}}
                          <div class="form-group row">
                            <div class="col-lg-12">
                              <select class="form-control select" name="chief_id" required>
                                  <option value="">{{__('Select Branch Chief')}}</option> 
                                    @foreach($agent as $val)
                                      <option value="{{ $val->id }}">{{ $val->first_name }} {{ $val->last_name }}</option>
                                    @endforeach
                              </select>
                            </div>
                          </div> 
                          <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{ old('mobile') }}" placeholder="Mobile" required>
                                    @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors }}</strong>
                                    </span>
                                    @enderror
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" placeholder="Address" required>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors }}</strong>
                                    </span>
                                    @enderror
                            </div>
                          </div> 
                          <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="text" name="state" class="form-control @error('state') is-invalid @enderror" value="{{ old('state') }}" placeholder="State" required>
                                    @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors }}</strong>
                                    </span>
                                    @enderror
                            </div>
                          </div>                              
                          <div class="form-group row">
                              <div class="col-lg-12">
                                  <input type="text" name="country" class="form-control @error('country') is-invalid @enderror" value="{{ old('country') }}" placeholder="Country" required>
                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors }}</strong>
                                    </span>
                                    @enderror
                              </div>
                          </div>                            
                          <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="text" name="zipcode" class="form-control @error('zipcode') is-invalid @enderror" value="{{ old('zipcode') }}" placeholder="Zip Code" required>
                                    @error('zipcode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors }}</strong>
                                    </span>
                                    @enderror
                            </div>
                          </div>               
                          <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="text" name="postal" class="form-control @error('postal') is-invalid @enderror" value="{{ old('postal') }}" placeholder="Postal Code" required>
                                    @error('postal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors }}</strong>
                                    </span>
                                    @enderror
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
  @stop