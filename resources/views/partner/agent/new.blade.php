@extends('partnerlayout')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
      <div class="row">
          <div class="col-md-12">
              <div class="card border-0 mb-0">
                  <div class="card-header">
                      <h3 class="mb-0">{{__('New Agent')}}</h3>
                  </div>
                  <div class="card-body">
                      <form action="{{route('create.agent')}}" method="post">
                          @csrf
                          <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                          <div class="form-group row">
                              <div class="col-lg-12">
                                  <input type="text" name="business_name" class="form-control @error('business_name') is-invalid @enderror" value="{{ old('business_name') }}" placeholder="Business Name" required>
                                    @error('business_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors }}</strong>
                                    </span>
                                    @enderror
                              </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" placeholder="First Name" required>
                                  @error('first_name')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors }}</strong>
                                  </span>
                                  @enderror
                            </div>
                        </div>
                          <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" placeholder="Last Name" required>
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors }}</strong>
                                    </span>
                                    @enderror
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email" required>
                                    @error('email')
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
                                  <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Phone Number" required>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors }}</strong>
                                    </span>
                                    @enderror
                              </div>
                          </div>  
                          <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="new_password" placeholder="Password" required>
                                  @error('password')
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