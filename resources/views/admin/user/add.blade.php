@extends('layouts.admin')
@section('content') 
<div class="main-panel">        
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Add USer
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page">Basic elements</li>
              </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  
                  
                  <form action="{{ route('users.store') }}" method="POST" class="form-horizontal">
					{{ csrf_field() }}
					
                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                      <label for="exampleInputUsername1">Username</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" name="username" value="{{ old('username') }}">
                      
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                    </div>
                    
                    
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="exampleInputEmail1">Email address</label> 
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" value="{{ old('email') }}">
								@if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                    </div>
                    
                    
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1"  name="password" placeholder="Password">
								@if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                    </div>
                    
                    
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                      <label for="exampleInputConfirmPassword1">Confirm Password</label>
                      <input type="password" class="form-control" id="exampleInputConfirmPassword1" placeholder="Password">
								@if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                    </div>
                    
                    
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Role</label>

                            
                                <select name="role" class="form-control">
								  <option value="1">User</option>
								  <option value="2">Admin</option>
								 
								</select>
                          
                    </div>
                    
                    
                    <div class="form-check form-check-flat form-check-primary">
                      
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                    <a href="{{url('/')}}" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            
            
        </div>
        <!-- content-wrapper ends -->



@endsection
