@extends('master')
    @section('content')
    <div class="container-fluid mt--6">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h3 class="mb-0">{{__('Congifure website')}}</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.settings.update')}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{__('Website name')}}</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="site_name" maxlength="200" value="{{$set->site_name}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{__('Company email')}}</label>
                                    <div class="col-lg-10">
                                        <input type="email" name="email" value="{{$set->email}}" class="form-control" required>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{__('Support email')}}</label>
                                    <div class="col-lg-10">
                                        <input type="email" name="support_email" value="{{$set->support_email}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{__('Mobile')}}</label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <input type="text" name="mobile" max-length="14" value="{{$set->mobile}}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{__('Website title')}}</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="title" max-length="200" value="{{$set->title}}" class="form-control" required>
                                    </div>
                                </div>                                  
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{__('Short description')}}</label>
                                    <div class="col-lg-10">
                                        <textarea type="text" name="site_desc" rows="4" class="form-control" required>{{$set->site_desc}}</textarea>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{__('Welcome Message')}}</label>
                                    <div class="col-lg-10">
                                        <textarea type="text" name="welcome_message" rows="7" class="form-control" required>{{$set->welcome_message}}</textarea>
                                    </div>
                                </div>                           
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{__('Livechat code')}}</label>
                                    <div class="col-lg-10">
                                        <textarea type="text" name="livechat" class="form-control">{{$set->livechat}}</textarea>
                                    </div>
                                </div>           
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-success btn-sm">{{__('Save Changes')}}</button>
                                    </div>
                            </form>
                        </div>
                    </div>    
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0">{{__('Settlement')}}</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.settlement.update')}}" method="post">
                                @csrf                    
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{__('Duration')}}</label>
                                    <div class="col-lg-10">
                                        <input type="number" name="duration" pattern="[0-9]+(\.[0-9]{0,2})?%?" value="{{$set->duration}}" id="duration" class="form-control" placeholder="1" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{__('Period')}}</label>
                                    <div class="col-lg-10">
                                        <select class="form-control select" name="period" id="period" data-fouc required>    
                                            <option value="Day" 
                                                @if($set->period=='Day')
                                                {{__('selected')}}
                                                @endif
                                                >{{__('Day')}}
                                            </option>                                         
                                            <option value="Week" 
                                                @if($set->period=='Week')
                                                {{__('selected')}}
                                                @endif
                                                >{{__('Week')}}
                                            </option>                                         
                                            <option value="Month" 
                                                @if($set->period=='Month')
                                                {{__('selected')}}
                                                @endif
                                                >{{__('Month')}}
                                            </option>                                         
                                            <option value="Year" 
                                                @if($set->period=='Year')
                                                {{__('selected')}}
                                                @endif
                                                >{{__('Year')}}
                                            </option>                                       
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{__('Next Settlement')}}</label>
                                    <div class="col-lg-10">
                                        <input type="text" readonly value='{{date("Y/m/d", strtotime($set->next_settlement))}}' class="form-control">
                                    </div>
                                </div>  
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{__('Withdraw charge')}}<span class="text-danger">*</span></label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <input type="number" name="withdraw_charge" value="{{$set->withdraw_charge}}" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>      
                                </div>                                 
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{__('Withdraw Limit')}} (Unverified) <span class="text-danger">*</span></label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" name="withdraw_limit" value="{{$set->withdraw_limit}}" class="form-control" required>
                                        </div>
                                        <span class="text-gray text-xs">For unverified businesses</span>
                                    </div>      
                                </div>                                
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{__('Withdraw Limit')}} (Starter) <span class="text-danger">*</span></label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" name="starter_limit" value="{{$set->starter_limit}}" class="form-control" required>
                                        </div>
                                        <span class="text-gray text-xs">For starter businesses</span>
                                    </div>      
                                </div>      
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success btn-sm">{{__('Save')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>    
                    <!--                      
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0">{{__('Cryptocurrency')}}</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.crypto.update')}}" method="post">
                                @csrf                    
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{__('Btc wallet address')}} <span class="text-danger">*</span></label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">#</span>
                                            </span>
                                            <input type="text" name="btc_wallet" value="{{$set->btc_wallet}}" class="form-control">
                                        </div>
                                    </div> 
                                </div> 
                                <div class="form-group row">                                                                                  
                                    <label class="col-form-label col-lg-2">{{__('Eth wallet address')}}<span class="text-danger">*</span></label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">#</span>
                                            </span>
                                            <input type="text" name="eth_wallet" value="{{$set->eth_wallet}}" class="form-control">
                                        </div>
                                    </div>           
                                </div> 
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{__('Btc sell rate')}} <span class="text-danger">*</span></label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" name="btc_sell" step="any" max-length="10" value="{{convertFloat($set->btc_sell)}}" class="form-control">
                                        </div>
                                    </div>                                                                                   
                                    <label class="col-form-label col-lg-2">{{__('Btc buy rate ')}}<span class="text-danger">*</span></label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" name="btc_buy" step="any" max-length="10" value="{{convertFloat($set->btc_buy)}}" class="form-control">
                                        </div>
                                    </div>                                                                                   
                                    <label class="col-form-label col-lg-2">{{__('Eth sell rate')}} <span class="text-danger">*</span></label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" name="eth_sell" step="any" max-length="10" value="{{convertFloat($set->eth_sell)}}" class="form-control">
                                        </div>
                                    </div>                                                                                   
                                    <label class="col-form-label col-lg-2">{{__('Eth buy rate')}} <span class="text-danger">*</span></label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" name="eth_buy" step="any" max-length="10" value="{{convertFloat($set->eth_buy)}}" class="form-control">
                                        </div>
                                    </div>                                                                                                                                                                     
                                    <label class="col-form-label col-lg-2">{{__('Minimum bitcoin sell rate')}} <span class="text-danger">*</span></label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" name="min_btcsell" step="any" max-length="10" value="{{convertFloat($set->min_btcsell)}}" class="form-control">
                                        </div>
                                    </div>                                                                                   
                                    <label class="col-form-label col-lg-2">{{__('Minimum bitcoin buy rate ')}}<span class="text-danger">*</span></label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" name="min_btcbuy" step="any" max-length="10" value="{{convertFloat($set->min_btcbuy)}}" class="form-control">
                                        </div>
                                    </div>                                                                                   
                                    <label class="col-form-label col-lg-2">{{__('Minimum ethereum sell rate')}} <span class="text-danger">*</span></label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" name="min_ethsell" step="any" max-length="10" value="{{convertFloat($set->min_ethsell)}}" class="form-control">
                                        </div>
                                    </div>                                                                                   
                                    <label class="col-form-label col-lg-2">{{__('Minimum ethereum buy rate')}} <span class="text-danger">*</span></label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" name="min_ethbuy" step="any" max-length="10" value="{{convertFloat($set->min_ethbuy)}}" class="form-control">
                                        </div>
                                    </div>   
                                </div>        
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success btn-sm">{{__('Save')}}</button>
                                </div>
                            </form>
                        </div>
                    </div> 
                    -->                  
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0">{{__('Features')}}</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.features.update')}}" method="post">
                                @csrf   
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($set->email_verification==1)
                                                <input type="checkbox" name="email_activation" id="customCheckLogin2" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="email_activation"id="customCheckLogin2"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="customCheckLogin2">
                                            <span class="text-muted">{{__('Email verification')}}</span>     
                                            </label>
                                        </div>                       
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($set->email_notify==1)
                                                <input type="checkbox" name="email_notify" id="customCheckLogin3" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="email_notify"id="customCheckLogin3"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="customCheckLogin3">
                                            <span class="text-muted">{{__('Email notify')}}</span>     
                                            </label>
                                        </div>  
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($set->registration==1)
                                                <input type="checkbox" name="registration" id="customCheckLogin4" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="registration"id="customCheckLogin4"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="customCheckLogin4">
                                            <span class="text-muted">{{__('Registration')}}</span>     
                                            </label>
                                        </div>                                    
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($set->subscription==1)
                                                <input type="checkbox" name="subscription" id="customCheckLogin13" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="subscription"id="customCheckLogin13"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="customCheckLogin13">
                                            <span class="text-muted">{{__('Subscription')}}</span>     
                                            </label>
                                        </div>                                        
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($set->stripe_connect==1)
                                                <input type="checkbox" name="stripe_connect" id="customCheckLogin130" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="stripe_connect" id="customCheckLogin130"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="customCheckLogin130">
                                            <span class="text-muted">{{__('Stripe Connect')}}</span>     
                                            </label>
                                        </div>   
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($set->kyc_restriction==1)
                                                <input type="checkbox" name="kyc_restriction" id="customCheckLogin117" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="kyc_restriction" id="customCheckLogin117"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="customCheckLogin117">
                                            <span class="text-muted">{{__('Compliance Restriction')}}</span>     
                                            </label>
                                        </div>                                                                                                                                                                                        
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($set->recaptcha==1)
                                                <input type="checkbox" name="recaptcha" id="customCheckLogin6" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="recaptcha"id="customCheckLogin6"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="customCheckLogin6">
                                            <span class="text-muted">{{__('Recaptcha')}}</span>     
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($set->merchant==1)
                                                <input type="checkbox" name="merchant" id="customCheckLogin7" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="merchant" id="customCheckLogin7"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="customCheckLogin7">
                                            <span class="text-muted">{{__('Merchant')}}</span>     
                                            </label>
                                        </div>                                        
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($set->transfer==1)
                                                <input type="checkbox" name="transfer" id="customCheckLogin8" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="transfer" id="customCheckLogin8"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="customCheckLogin8">
                                            <span class="text-muted">{{__('Transfer')}}</span>     
                                            </label>
                                        </div>                                        
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($set->request_money==1)
                                                <input type="checkbox" name="request_money" id="customCheckLogin9" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="request_money" id="customCheckLogin9"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="customCheckLogin9">
                                            <span class="text-muted">{{__('Request Money')}}</span>     
                                            </label>
                                        </div>                                        
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($set->country_restriction==1)
                                                <input type="checkbox" name="country_restriction" id="customCheckLogin459" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="country_restriction" id="customCheckLogin459"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="customCheckLogin459">
                                            <span class="text-muted">{{__('Country Restriction')}}</span>     
                                            </label>
                                        </div>
                                        <!--
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($set->bitcoin==1)
                                                <input type="checkbox" name="bitcoin" id="customCheckLogin22" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="bitcoin" id="customCheckLogin22"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="customCheckLogin22">
                                            <span class="text-muted">{{__('Bitcoin')}}</span>     
                                            </label>
                                        </div>                                        
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($set->ethereum==1)
                                                <input type="checkbox" name="ethereum" id="customCheckLogin23" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="ethereum" id="customCheckLogin23"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="customCheckLogin23">
                                            <span class="text-muted">{{__('Ethereum')}}</span>     
                                            </label>
                                        </div>
                                        -->
                                    </div>                                    
                                    <div class="col-lg-4">
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($set->invoice==1)
                                                <input type="checkbox" name="invoice" id="customCheckLogin10" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="invoice" id="customCheckLogin10"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="customCheckLogin10">
                                            <span class="text-muted">{{__('Invoice')}}</span>     
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($set->store==1)
                                                <input type="checkbox" name="store" id="customCheckLogin10z" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="store" id="customCheckLogin10z"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="customCheckLogin10z">
                                            <span class="text-muted">{{__('Store')}}</span>     
                                            </label>
                                        </div>                                        
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($set->donation==1)
                                                <input type="checkbox" name="donation" id="customCheckLogin11" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="donation" id="customCheckLogin11"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="customCheckLogin11">
                                            <span class="text-muted">{{__('Donation')}}</span>     
                                            </label>
                                        </div>                                        
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($set->single==1)
                                                <input type="checkbox" name="single" id="customCheckLogin12" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="single" id="customCheckLogin12"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="customCheckLogin12">
                                            <span class="text-muted">{{__('Single Charge')}}</span>     
                                            </label>
                                        </div>                                        
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($set->bill==1)
                                                <input type="checkbox" name="bill" id="customCheckLogin20" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="bill" id="customCheckLogin20"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="customCheckLogin20">
                                            <span class="text-muted">{{__('Bill Payment')}}</span>     
                                            </label>
                                        </div>                                        
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($set->vcard==1)
                                                <input type="checkbox" name="vcard" id="customCheckLogin21" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="vcard" id="customCheckLogin21"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="customCheckLogin21">
                                            <span class="text-muted">{{__('Virtual Card')}}</span>     
                                            </label>
                                        </div>                                        
                                    </div>
                                </div>         
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success btn-sm">{{__('Save Changes')}}</button>
                                </div>
                            </form>
                        </div>
                    </div> 
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ __('Commissions') }}</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.commission.update') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($fee->mobile_transfer==1)
                                                <input type="checkbox" name="mobile_transfer" id="customCommission2" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="mobile_transfer" id="customCommission2"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="customCommission2">
                                            <span class="text-muted">{{__('Mobile Transfer')}}</span>     
                                            </label>
                                        </div>                       
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($fee->partner_deposit==1)
                                                <input type="checkbox" name="partner_deposit" id="customCommission3" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="partner_deposit" id="customCommission3"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="customCommission3">
                                            <span class="text-muted">{{__('Partner Deposit ')}}</span>     
                                            </label>
                                        </div>  
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($fee->partner_withdraw==1)
                                                <input type="checkbox" name="partner_withdraw" id="customCommission4" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="partner_withdraw"id="customCommission4"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="customCommission4">
                                            <span class="text-muted">{{__('Partner Withdraw')}}</span>     
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="col-form-label">{{__('Start Amount')}} <span class="text-danger">*</span></label>           
                                        <div class="input-group">
                                            <input type="number" step="any"  name="start_amount" class="form-control" required>
                                            <span class="input-group-append">
                                                <select class="form-control select" name="currency" id="currency" data-fouc required>    
                                                    <option value="base">
                                                        <span class="input-group-text">
                                                            {{ $currencys->base_code }}
                                                        </span>
                                                    </option>
                                                    <option value="extra1">
                                                        <span class="input-group-text">
                                                            {{ $currencys->extra1_code }}
                                                        </span>
                                                    </option>                                   
                                                    <option value="extra2">
                                                        <span class="input-group-text">
                                                            {{ $currencys->extra2_code }}
                                                        </span>
                                                    </option>                                
                                                    <option value="extra3">
                                                        <span class="input-group-text">
                                                            {{ $currencys->extra3_code }}
                                                        </span>
                                                    </option>   
                                                    <option value="extra4">
                                                        <span class="input-group-text">
                                                            {{ $currencys->extra4_code }}
                                                        </span>
                                                    </option>                    
                                                    <option value="extra5">
                                                        <span class="input-group-text">
                                                            {{ $currencys->extra5_code }}
                                                        </span>
                                                    </option>                  
                                                </select>
                                            </span>
                                        </div>
                                    </div>                                        
                                    <div class="col-lg-3">
                                        <label class="col-form-label">{{__('End Amount')}} <span class="text-danger">*</span></label>                                   
                                        <div class="input-group">
                                            <input type="number" step="any"  name="end_amount" class="form-control" required>
                                            <span class="input-group-append">
                                                <select class="form-control select" name="currency_end" id="currency_end" data-fouc required>    
                                                    <option value="base">
                                                        <span class="input-group-text">
                                                            {{ $currencys->base_code }}
                                                        </span>
                                                    </option>
                                                    <option value="extra1">
                                                        <span class="input-group-text">
                                                            {{ $currencys->extra1_code }}
                                                        </span>
                                                    </option>                                   
                                                    <option value="extra2">
                                                        <span class="input-group-text">
                                                            {{ $currencys->extra2_code }}
                                                        </span>
                                                    </option>                                
                                                    <option value="extra3">
                                                        <span class="input-group-text">
                                                            {{ $currencys->extra3_code }}
                                                        </span>
                                                    </option>   
                                                    <option value="extra4">
                                                        <span class="input-group-text">
                                                            {{ $currencys->extra4_code }}
                                                        </span>
                                                    </option>                    
                                                    <option value="extra5">
                                                        <span class="input-group-text">
                                                            {{ $currencys->extra5_code }}
                                                        </span>
                                                    </option>                  
                                                </select>
                                            </span>
                                        </div>                                
                                    </div> 
                                    <div class="col-lg-3">
                                        <label class="col-form-label">{{__('Fee')}} <span class="text-danger">*</span></label>                                   
                                        <div class="input-group">
                                            <input type="number" step="any"  name="fee" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>                                
                                    </div>    
                                </div> 
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success btn-sm">{{__('Save Changes')}}</button>
                                </div>                                   
                            </form>
                        </div>
                        <hr>
                        <div>  
                            <div class="border-bottom py-3">
                                <div class="container flex">
                                    <div class="row align-items-center flex justify-content-between">
                                        <div class="col-md-9 col-lg-10">
                                            <ul class="nav nav-underline border-0 justify-content-between justify-content-md-start">
                                                <li class="nav-item mr-md-4"><a data-toggle="tab" class="text-graphite active" href="#mobile" aria-selected="true">{{ __('Mobile-Fee') }}</a>
                                                </li>
                                                <li class="nav-item mr-md-4"><a data-toggle="tab" class="text-graphite" href="#deposit" aria-selected="false">{{ __('Deposit-Fee') }}</a>
                                                </li>
                                                <li class="nav-item mr-md-4"><a data-toggle="tab" class="text-graphite" href="#withdraw" aria-selected="false">{{ __('Withdraw-Fee') }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- container -->
                            </div>
                            <div class="container">
                                <div class="tab-content mt-4">
                                    <div id="mobile" class="tab-pane show active" role="tabpanel">
                                        <h2 class="text-center p-3">{{ __('Mobile Transfer Fee') }}</h2>
                                        <div class="row mt-6">
                                            <div class="container-fluid mt--6">
                                                <div class="content-wrapper">
                                                    <div class="card">
                                                        <div class="table-responsive py-4">
                                                            <table class="table table-flush" id="datatable-buttons" aria-labelledby="Mobile transfer Table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>{{__('S/N')}}</th>
                                                                        <th class="scope"></th>    
                                                                        <th>{{__('Start Amount')}}</th>
                                                                        <th>{{__('End Amount')}}</th>
                                                                        <th>{{__('Fee')}}</th>                                                                      
                                                                        <th>{{__('Currency')}}</th>
                                                                        <th>{{__('Created')}}</th>
                                                                        <th>{{__('Updated')}}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($mobile_fee as $k=>$val)
                                                                    <tr>
                                                                        <td>{{++$k}}.</td>
                                                                        <td class="text-right">
                                                                        <div class="dropdown">
                                                                                <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <em class="fad fa-chevron-circle-down"></em>
                                                                                </a>
                                                                                {{-- <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                                                    <a href="{{route('partner.agent.manage', ['id' => $val->id])}}" class="dropdown-item">{{__('Manage Agent')}}</a>
                                                                                    <a data-toggle="modal" data-target="#delete{{$val->id}}" href="" class="dropdown-item">{{__('Delete')}}</a>
                                                                                </div> --}}
                                                                            </div>
                                                                        </td>
                                                                        <td>{{ $val->start_amount }}</td>
                                                                        <td>{{ $val->end_amount }}</td>
                                                                        <td>{{ $val->fee }}</td>
                                                                        <td>{{ $val->currency }}</td>
                                                                        <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>  
                                                                        <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>                   
                                                                    </tr>
                                                                    @endforeach               
                                                                </tbody>                    
                                                            </table>
                                                        </div>
                                                    </div>
                                                    {{-- @foreach($agent as $k=>$val)
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
                                                    @endforeach  --}}
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    <div id="deposit" class="tab-pane fade text-center" role="tabpanel">
                                        <h2 class="p-3">{{ __('Partner Deposit Fee') }}</h2>
                                        <div class="row mt-6">
                                            <div class="container-fluid mt--6">
                                                <div class="content-wrapper">
                                                    <div class="card">
                                                        <div class="table-responsive py-4">
                                                            <table class="table table-flush" id="datatable-buttons1" aria-labelledby="Mobile transfer Table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>{{__('S/N')}}</th>
                                                                        <th class="scope"></th>    
                                                                        <th>{{__('Start Amount')}}</th>
                                                                        <th>{{__('End Amount')}}</th>
                                                                        <th>{{__('Fee')}}</th>                                                                      
                                                                        <th>{{__('Currency')}}</th>
                                                                        <th>{{__('Created')}}</th>
                                                                        <th>{{__('Updated')}}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($deposit_fee as $k=>$val)
                                                                    <tr>
                                                                        <td>{{++$k}}.</td>
                                                                        <td class="text-right">
                                                                        <div class="dropdown">
                                                                                <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <em class="fad fa-chevron-circle-down"></em>
                                                                                </a>
                                                                                {{-- <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                                                    <a href="{{route('partner.agent.manage', ['id' => $val->id])}}" class="dropdown-item">{{__('Manage Agent')}}</a>
                                                                                    <a data-toggle="modal" data-target="#delete{{$val->id}}" href="" class="dropdown-item">{{__('Delete')}}</a>
                                                                                </div> --}}
                                                                            </div>
                                                                        </td>
                                                                        <td>{{ $val->start_amount }}</td>
                                                                        <td>{{ $val->end_amount }}</td>
                                                                        <td>{{ $val->fee }}</td>
                                                                        <td>{{ $val->currency }}</td>
                                                                        <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>  
                                                                        <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>                   
                                                                    </tr>
                                                                    @endforeach               
                                                                </tbody>                    
                                                            </table>
                                                        </div>
                                                    </div>
                                                    {{-- @foreach($agent as $k=>$val)
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
                                                    @endforeach  --}}
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    <div id="withdraw" class="tab-pane fade text-center" role="tabpanel">
                                        <h2 class="p-3">{{ __('Partner Withdraw Fee') }}</h2>
                                        <div class="row mt-6">
                                            <div class="container-fluid mt--6">
                                                <div class="content-wrapper">
                                                    <div class="card">
                                                        <div class="table-responsive py-4">
                                                            <table class="table table-flush" id="datatable-buttons2" aria-labelledby="Mobile transfer Table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>{{__('S/N')}}</th>
                                                                        <th class="scope"></th>    
                                                                        <th>{{__('Start Amount')}}</th>
                                                                        <th>{{__('End Amount')}}</th>
                                                                        <th>{{__('Fee')}}</th>                                                                      
                                                                        <th>{{__('Currency')}}</th>
                                                                        <th>{{__('Created')}}</th>
                                                                        <th>{{__('Updated')}}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($deposit_fee as $k=>$val)
                                                                    <tr>
                                                                        <td>{{++$k}}.</td>
                                                                        <td class="text-right">
                                                                        <div class="dropdown">
                                                                                <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <em class="fad fa-chevron-circle-down"></em>
                                                                                </a>
                                                                                {{-- <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                                                    <a href="{{route('partner.agent.manage', ['id' => $val->id])}}" class="dropdown-item">{{__('Manage Agent')}}</a>
                                                                                    <a data-toggle="modal" data-target="#delete{{$val->id}}" href="" class="dropdown-item">{{__('Delete')}}</a>
                                                                                </div> --}}
                                                                            </div>
                                                                        </td>
                                                                        <td>{{ $val->start_amount }}</td>
                                                                        <td>{{ $val->end_amount }}</td>
                                                                        <td>{{ $val->fee }}</td>
                                                                        <td>{{ $val->currency }}</td>
                                                                        <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>  
                                                                        <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>                   
                                                                    </tr>
                                                                    @endforeach               
                                                                </tbody>                    
                                                            </table>
                                                        </div>
                                                    </div>
                                                    {{-- @foreach($agent as $k=>$val)
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
                                                    @endforeach  --}}
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                </div><!-- tab content -->
                            </div><!-- container --> 
                        </div>
                    </div>  
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ __('Savings') }}</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.commission.update') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($fee->month_saving==1)
                                                <input type="checkbox" name="one_month_saving" id="monthSaving" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="one_month_saving" id="monthSaving"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="monthSaving">
                                            <span class="text-muted">{{__('Monthly Saving')}}</span>     
                                            </label>
                                        </div>                       
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($fee->three_months_saving==1)
                                                <input type="checkbox" name="three_months_saving" id="threemonthSaving" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="three_months_saving" id="threemonthSaving"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="threemonthSaving">
                                            <span class="text-muted">{{__('Three Months Saving')}}</span>     
                                            </label>
                                        </div>  
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($fee->six_months_saving==1)
                                                <input type="checkbox" name="six_months_saving" id="sixmonthSaving" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="six_months_saving" id="sixmonthSaving"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="sixmonthSaving">
                                            <span class="text-muted">{{__('Six Months Saving')}}</span>     
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($fee->personal_saving==1)
                                                <input type="checkbox" name="personal_saving" id="personalSaving" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="personal_saving" id="personalSaving"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="personalSaving">
                                            <span class="text-muted">{{__('Personal Saving')}}</span>     
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            @if($fee->general_saving==1)
                                                <input type="checkbox" name="general_saving" id="generalSaving" class="custom-control-input" value="1" checked>
                                            @else
                                                <input type="checkbox" name="general_saving" id="generalSaving"  class="custom-control-input" value="1">
                                            @endif
                                            <label class="custom-control-label" for="generalSaving">
                                            <span class="text-muted">{{__('General Saving')}}</span>     
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="col-form-label">{{__('Start Amount')}} <span class="text-danger">*</span></label>           
                                        <div class="input-group">
                                            <input type="number" step="any"  name="start_amount" class="form-control" required>
                                            <span class="input-group-append">
                                                <select class="form-control select" name="currency" id="currency" data-fouc required>    
                                                    <option value="base">
                                                        <span class="input-group-text">
                                                            {{ $currencys->base_code }}
                                                        </span>
                                                    </option>
                                                    <option value="extra1">
                                                        <span class="input-group-text">
                                                            {{ $currencys->extra1_code }}
                                                        </span>
                                                    </option>                                   
                                                    <option value="extra2">
                                                        <span class="input-group-text">
                                                            {{ $currencys->extra2_code }}
                                                        </span>
                                                    </option>                                
                                                    <option value="extra3">
                                                        <span class="input-group-text">
                                                            {{ $currencys->extra3_code }}
                                                        </span>
                                                    </option>   
                                                    <option value="extra4">
                                                        <span class="input-group-text">
                                                            {{ $currencys->extra4_code }}
                                                        </span>
                                                    </option>                    
                                                    <option value="extra5">
                                                        <span class="input-group-text">
                                                            {{ $currencys->extra5_code }}
                                                        </span>
                                                    </option>                  
                                                </select>
                                            </span>
                                        </div>
                                    </div>                                        
                                    <div class="col-lg-3">
                                        <label class="col-form-label">{{__('End Amount')}} <span class="text-danger">*</span></label>                                   
                                        <div class="input-group">
                                            <input type="number" step="any"  name="end_amount" class="form-control" required>
                                            <span class="input-group-append">
                                                <select class="form-control select" name="currency_end" id="currency" data-fouc required>    
                                                    <option value="base">
                                                        <span class="input-group-text">
                                                            {{ $currencys->base_code }}
                                                        </span>
                                                    </option>
                                                    <option value="extra1">
                                                        <span class="input-group-text">
                                                            {{ $currencys->extra1_code }}
                                                        </span>
                                                    </option>                                   
                                                    <option value="extra2">
                                                        <span class="input-group-text">
                                                            {{ $currencys->extra2_code }}
                                                        </span>
                                                    </option>                                
                                                    <option value="extra3">
                                                        <span class="input-group-text">
                                                            {{ $currencys->extra3_code }}
                                                        </span>
                                                    </option>   
                                                    <option value="extra4">
                                                        <span class="input-group-text">
                                                            {{ $currencys->extra4_code }}
                                                        </span>
                                                    </option>                    
                                                    <option value="extra5">
                                                        <span class="input-group-text">
                                                            {{ $currencys->extra5_code }}
                                                        </span>
                                                    </option>                  
                                                </select>
                                            </span>
                                        </div>                                
                                    </div> 
                                    <div class="col-lg-3">
                                        <label class="col-form-label">{{__('Fee')}} <span class="text-danger">*</span></label>                                   
                                        <div class="input-group">
                                            <input type="number" step="any"  name="fee" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>                                
                                    </div>    
                                </div> 
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success btn-sm">{{__('Save Changes')}}</button>
                                </div>                                   
                            </form>
                        </div>
                        <hr>
                        <div>  
                            <div class="border-bottom py-3">
                                <div class="container flex">
                                    <div class="row align-items-center flex justify-content-between">
                                        <div class="col-md-9 col-lg-10">
                                            <ul class="nav nav-underline border-0 justify-content-between justify-content-md-start">
                                                <li class="nav-item mr-md-4"><a data-toggle="tab" class="text-graphite active" href="#monthly_fee" aria-selected="true">{{ __('Monthly-Fee') }}</a>
                                                </li>
                                                <li class="nav-item mr-md-4"><a data-toggle="tab" class="text-graphite" href="#three_months_fee" aria-selected="false">{{ __('Three-Months-Fee') }}</a>
                                                </li>
                                                <li class="nav-item mr-md-4"><a data-toggle="tab" class="text-graphite" href="#six_months_fee" aria-selected="false">{{ __('Six-Months-Fee') }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- container -->
                            </div>
                            <div class="container">
                                <div class="tab-content mt-4">
                                    <div id="monthly_fee" class="tab-pane show active" role="tabpanel">
                                        <h2 class="text-center p-3">{{ __('Monthly Fee') }}</h2>
                                        <div class="row mt-6">
                                            <div class="container-fluid mt--6">
                                                <div class="content-wrapper">
                                                    <div class="card">
                                                        <div class="table-responsive py-4">
                                                            <table class="table table-flush" id="datatable-buttons3" aria-labelledby="Mobile transfer Table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>{{__('S/N')}}</th>
                                                                        <th class="scope"></th>    
                                                                        <th>{{__('Start Amount')}}</th>
                                                                        <th>{{__('End Amount')}}</th>
                                                                        <th>{{__('Fee')}}</th>                                                                      
                                                                        <th>{{__('Currency')}}</th>
                                                                        <th>{{__('Created')}}</th>
                                                                        <th>{{__('Updated')}}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($monthly_fee as $k=>$val)
                                                                    <tr>
                                                                        <td>{{++$k}}.</td>
                                                                        <td class="text-right">
                                                                        <div class="dropdown">
                                                                                <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <em class="fad fa-chevron-circle-down"></em>
                                                                                </a>
                                                                                {{-- <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                                                    <a href="{{route('partner.agent.manage', ['id' => $val->id])}}" class="dropdown-item">{{__('Manage Agent')}}</a>
                                                                                    <a data-toggle="modal" data-target="#delete{{$val->id}}" href="" class="dropdown-item">{{__('Delete')}}</a>
                                                                                </div> --}}
                                                                            </div>
                                                                        </td>
                                                                        <td>{{ $val->start_amount }}</td>
                                                                        <td>{{ $val->end_amount }}</td>
                                                                        <td>{{ $val->fee }}</td>
                                                                        <td>{{ $val->currency }}</td>
                                                                        <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>  
                                                                        <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>                   
                                                                    </tr>
                                                                    @endforeach               
                                                                </tbody>                    
                                                            </table>
                                                        </div>
                                                    </div>
                                                    {{-- @foreach($agent as $k=>$val)
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
                                                    @endforeach  --}}
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    <div id="three_months_fee" class="tab-pane fade text-center" role="tabpanel">
                                        <h2 class="p-3">{{ __('Three Months Fee') }}</h2>
                                        <div class="row mt-6">
                                            <div class="container-fluid mt--6">
                                                <div class="content-wrapper">
                                                    <div class="card">
                                                        <div class="table-responsive py-4">
                                                            <table class="table table-flush" id="datatable-buttons4" aria-labelledby="Mobile transfer Table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>{{__('S/N')}}</th>
                                                                        <th class="scope"></th>    
                                                                        <th>{{__('Start Amount')}}</th>
                                                                        <th>{{__('End Amount')}}</th>
                                                                        <th>{{__('Fee')}}</th>                                                                      
                                                                        <th>{{__('Currency')}}</th>
                                                                        <th>{{__('Created')}}</th>
                                                                        <th>{{__('Updated')}}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($three_months_fee as $k=>$val)
                                                                    <tr>
                                                                        <td>{{++$k}}.</td>
                                                                        <td class="text-right">
                                                                        <div class="dropdown">
                                                                                <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <em class="fad fa-chevron-circle-down"></em>
                                                                                </a>
                                                                                {{-- <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                                                    <a href="{{route('partner.agent.manage', ['id' => $val->id])}}" class="dropdown-item">{{__('Manage Agent')}}</a>
                                                                                    <a data-toggle="modal" data-target="#delete{{$val->id}}" href="" class="dropdown-item">{{__('Delete')}}</a>
                                                                                </div> --}}
                                                                            </div>
                                                                        </td>
                                                                        <td>{{ $val->start_amount }}</td>
                                                                        <td>{{ $val->end_amount }}</td>
                                                                        <td>{{ $val->fee }}</td>
                                                                        <td>{{ $val->currency }}</td>
                                                                        <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>  
                                                                        <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>                   
                                                                    </tr>
                                                                    @endforeach               
                                                                </tbody>                    
                                                            </table>
                                                        </div>
                                                    </div>
                                                    {{-- @foreach($agent as $k=>$val)
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
                                                    @endforeach  --}}
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    <div id="six_months_fee" class="tab-pane fade text-center" role="tabpanel">
                                        <h2 class="p-3">{{ __('Six Months Fee') }}</h2>
                                        <div class="row mt-6">
                                            <div class="container-fluid mt--6">
                                                <div class="content-wrapper">
                                                    <div class="card">
                                                        <div class="table-responsive py-4">
                                                            <table class="table table-flush" id="datatable-buttons5" aria-labelledby="Mobile transfer Table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>{{__('S/N')}}</th>
                                                                        <th class="scope"></th>    
                                                                        <th>{{__('Start Amount')}}</th>
                                                                        <th>{{__('End Amount')}}</th>
                                                                        <th>{{__('Fee')}}</th>                                                                      
                                                                        <th>{{__('Currency')}}</th>
                                                                        <th>{{__('Created')}}</th>
                                                                        <th>{{__('Updated')}}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($six_months_fee as $k=>$val)
                                                                    <tr>
                                                                        <td>{{++$k}}.</td>
                                                                        <td class="text-right">
                                                                        <div class="dropdown">
                                                                                <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <em class="fad fa-chevron-circle-down"></em>
                                                                                </a>
                                                                                {{-- <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                                                    <a href="{{route('partner.agent.manage', ['id' => $val->id])}}" class="dropdown-item">{{__('Manage Agent')}}</a>
                                                                                    <a data-toggle="modal" data-target="#delete{{$val->id}}" href="" class="dropdown-item">{{__('Delete')}}</a>
                                                                                </div> --}}
                                                                            </div>
                                                                        </td>
                                                                        <td>{{ $val->start_amount }}</td>
                                                                        <td>{{ $val->end_amount }}</td>
                                                                        <td>{{ $val->fee }}</td>
                                                                        <td>{{ $val->currency }}</td>
                                                                        <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>  
                                                                        <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>                   
                                                                    </tr>
                                                                    @endforeach               
                                                                </tbody>                    
                                                            </table>
                                                        </div>
                                                    </div>
                                                    {{-- @foreach($agent as $k=>$val)
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
                                                    @endforeach  --}}
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                </div><!-- tab content -->
                            </div><!-- container --> 
                        </div>
                        <!-- container --> 
                    </div>                     
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0">{{__('Charges')}}</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.charges.update')}}" method="post">
                                @csrf
                                <p>Transfer/Request</p>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-3">{{__('Percent')}} <span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <input type="number" step="any"  name="transfer_charge" value="{{$set->transfer_charge}}" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>                                    
                                    <label class="col-form-label col-lg-3">{{__('Fiat')}} <span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" step="any"  name="transfer_chargep" value="{{$set->transfer_chargep}}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <p>Merchant</p>
                                <div class="form-group row">                                                                                                                                                                                                                       
                                    <label class="col-form-label col-lg-3">{{__('Percent')}} <span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <input type="number"step="any"  name="merchant_charge" value="{{$set->merchant_charge}}" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div> 
                                    <label class="col-form-label col-lg-3">{{__('Fiat')}} <span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" step="any" name="merchant_chargep" value="{{$set->merchant_chargep}}" class="form-control" required>
                                        </div>
                                    </div>
                                </div> 
                                <p>Invoice</p>
                                <div class="form-group row">                               
                                    <label class="col-form-label col-lg-3">{{__('Percent')}} <span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <input type="number" step="any"  name="invoice_charge" value="{{$set->invoice_charge}}" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>
                                    <label class="col-form-label col-lg-3">{{__('Fiat')}} <span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" step="any" name="invoice_chargep" value="{{$set->invoice_chargep}}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <p>Product</p>
                                <div class="form-group row">                             
                                    <label class="col-form-label col-lg-3">{{__('Percent')}} <span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <input type="number" step="any" name="product_charge" max-length="10" value="{{$set->product_charge}}" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div> 
                                    <label class="col-form-label col-lg-3">{{__('Fiat')}} <span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" step="any" name="product_chargep" value="{{$set->product_chargep}}" class="form-control" required>
                                        </div>
                                    </div> 
                                </div>
                                <p>Single Charge</p>
                                <div class="form-group row">                                   
                                    <label class="col-form-label col-lg-3">{{__('Percent')}} <span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <input type="number" step="any"  name="single_charge" max-length="10" value="{{$set->single_charge}}" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div> 
                                    <label class="col-form-label col-lg-3">{{__('Fiat')}} <span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" step="any" name="single_chargep" value="{{$set->single_chargep}}" class="form-control" required>
                                        </div>
                                    </div> 
                                </div>
                                <p>Donation</p>
                                <div class="form-group row">                                    
                                    <label class="col-form-label col-lg-3">{{__('Percent')}} <span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <input type="number"step="any"  name="donation_charge" max-length="10" value="{{$set->donation_charge}}" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div> 
                                    <label class="col-form-label col-lg-3">{{__('Fiat')}} <span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" step="any" name="donation_chargep" value="{{$set->donation_chargep}}" class="form-control" required>
                                        </div>
                                    </div>  
                                </div>
                                <p>Subscription</p>
                                <div class="form-group row">                                     
                                    <label class="col-form-label col-lg-3">{{__('Percent')}} <span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <input type="number" step="any" name="subscription_charge" max-length="10" value="{{$set->subscription_charge}}" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>  
                                    <label class="col-form-label col-lg-3">{{__('Fiat')}} <span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" step="any" name="subscription_chargep" value="{{$set->subscription_chargep}}" class="form-control" required>
                                        </div>
                                    </div> 
                                </div>
                                <p>Virtual Card Creation Charge</p>
                                <div class="form-group row">   
                                    <label class="col-form-label col-lg-3">{{__('Percent')}}<span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <input type="number" step="any" name="virtual_createcharge" value="{{$set->virtual_createcharge}}" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>
                                    <label class="col-form-label col-lg-3">{{__('Fiat')}}<span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" step="any" name="virtual_createchargep" value="{{$set->virtual_createchargep}}" class="form-control" required>
                                        </div>
                                    </div>  
                                </div> 
                                <p>Virtual Card Charge</p>
                                <div class="form-group row">                                     
                                    <label class="col-form-label col-lg-3">{{__('Percent')}}<span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <input type="number" step="any" name="virtual_charge" value="{{$set->virtual_charge}}" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>
                                    <label class="col-form-label col-lg-3">{{__('Fiat')}}<span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" step="any" name="virtual_chargep" value="{{$set->virtual_chargep}}" class="form-control" required>
                                        </div>
                                    </div>  
                                </div> 
                                <p>Bill Payment</p>
                                <div class="form-group row">  
                                    <label class="col-form-label col-lg-3">{{__('Bill')}}<span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <input type="number" step="any" name="bill_charge" value="{{$set->bill_charge}}" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>
                                    <label class="col-form-label col-lg-3">{{__('Fiat')}}<span class="text-danger">*</span></label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" step="any" name="bill_chargep" value="{{$set->bill_chargep}}" class="form-control" required>
                                        </div>
                                    </div>  
                                </div> 
                                <hr>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">{{__('Balance on Signup ')}}<span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" name="bal" value="{{$set->balance_reg}}" class="form-control" required>
                                        </div>
                                    </div>                                    
                                    <label class="col-form-label col-lg-2">{{__('Minimum Transfer')}}<span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" name="min_transfer" value="{{$set->min_transfer}}" class="form-control" required>
                                        </div>
                                    </div>                                                                                                                                                                                                                                                                                                                               
                                </div>                                   
                                <hr>
                                <div class="form-group row">                                                                        
                                    <label class="col-form-label col-lg-4">{{__('VC Minimum')}}<span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" name="vc_min" value="{{$set->vc_min}}" class="form-control" required>
                                        </div>
                                    </div>                                     
                                    <label class="col-form-label col-lg-4">{{__('VC Maximum')}}<span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">{{$currency->symbol}}</span>
                                            </span>
                                            <input type="number" name="vc_max" value="{{$set->vc_max}}" class="form-control" required>
                                        </div>
                                    </div>                                     
                                    <label class="col-form-label col-lg-4">{{__('VC Debit Currency')}}<span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <select class="form-control select" name="debit_currency" required>    
                                            <option value="NGN" @if($set->debit_currency=='NGN'){{__('selected')}}@endif>{{__('NGN')}}</option>                                                                               
                                            <option value="USD" @if($set->debit_currency=='USD'){{__('selected')}}@endif>{{__('USD')}}</option>                                                                               
                                            <option value="GNF" @if($set->debit_currency=='GNF'){{__('selected')}}@endif>{{__('GNF')}}</option>                                                                               
                                            <option value="KES" @if($set->debit_currency=='KES'){{__('selected')}}@endif>{{__('KES')}}</option>                                                                               
                                            <option value="LRD" @if($set->debit_currency=='LRD'){{__('selected')}}@endif>{{__('LRD')}}</option>                                                                               
                                            <option value="MWK" @if($set->debit_currency=='MWK'){{__('selected')}}@endif>{{__('MWK')}}</option>                                                                               
                                            <option value="MZN" @if($set->debit_currency=='MZN'){{__('selected')}}@endif>{{__('MZN')}}</option>                                                                               
                                            <option value="RWF" @if($set->debit_currency=='RWF'){{__('selected')}}@endif>{{__('RWF')}}</option>                                                                               
                                            <option value="SLL" @if($set->debit_currency=='SLL'){{__('selected')}}@endif>{{__('SLL')}}</option>                                                                               
                                            <option value="BIF" @if($set->debit_currency=='BIF'){{__('selected')}}@endif>{{__('BIF')}}</option>                                                                               
                                            <option value="CAD" @if($set->debit_currency=='CAD'){{__('selected')}}@endif>{{__('CAD')}}</option>                                                                               
                                            <option value="CDF" @if($set->debit_currency=='CDF'){{__('selected')}}@endif>{{__('CDF')}}</option>                                                                               
                                            <option value="CVE" @if($set->debit_currency=='CVE'){{__('selected')}}@endif>{{__('CVE')}}</option>                                                                               
                                            <option value="EUR" @if($set->debit_currency=='EUR'){{__('selected')}}@endif>{{__('EUR')}}</option>                                                                               
                                            <option value="GBP" @if($set->debit_currency=='GBP'){{__('selected')}}@endif>{{__('GBP')}}</option>                                                                               
                                            <option value="GHS" @if($set->debit_currency=='GHS'){{__('selected')}}@endif>{{__('GHS')}}</option>                                                                               
                                            <option value="GMD" @if($set->debit_currency=='GMD'){{__('selected')}}@endif>{{__('GMD')}}</option>                                                                               
                                            <option value="STD" @if($set->debit_currency=='STD'){{__('selected')}}@endif>{{__('STD')}}</option>                                                                               
                                            <option value="TZS" @if($set->debit_currency=='TZS'){{__('selected')}}@endif>{{__('TZS')}}</option>                                                                               
                                            <option value="UGX" @if($set->debit_currency=='UGX'){{__('selected')}}@endif>{{__('UGX')}}</option>                                                                               
                                            <option value="XAF" @if($set->debit_currency=='XAF'){{__('selected')}}@endif>{{__('XAF')}}</option>                                                                               
                                            <option value="XOF" @if($set->debit_currency=='XOF'){{__('selected')}}@endif>{{__('XOF')}}</option>                                                                               
                                            <option value="ZMK" @if($set->debit_currency=='ZMK'){{__('selected')}}@endif>{{__('ZMK')}}</option>                                                                               
                                            <option value="ZMW" @if($set->debit_currency=='ZMW'){{__('selected')}}@endif>{{__('ZMW')}}</option>                                                                               
                                            <option value="ZWD" @if($set->debit_currency=='ZWD'){{__('selected')}}@endif>{{__('ZWD')}}</option>                                                                               
                                        </select>
                                    </div>                                                                                                                                                                                                                                                     
                                </div>                          
                                                   
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-success btn-sm">{{__('Save Changes')}}</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0">{{__('Security')}}</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.account.update')}}" method="post">
                                @csrf
                                    <div class="form-group row">
                                        <label class="col-form-label ml-4">{{__('Username')}}</label> 
                                        <div class="col-lg-10">
                                            <input type="text" name="username" value="{{$val->username}}" class="form-control">
                                        </div>
                                    </div>                         
                                    <div class="form-group row">
                                        <label class="col-form-label ml-4">{{__('Password')}}</label>
                                        <div class="col-lg-10">
                                            <input type="password" name="password"  class="form-control" required>
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