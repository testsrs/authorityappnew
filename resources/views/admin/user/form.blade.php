										<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
														  <label for="exampleInputUsername1">Username</label>
														  {!! Form::text('username', null, array('placeholder' => 'Username','class' => 'form-control')) !!}
														  
																	@if ($errors->has('username'))
																		<span class="help-block">
																			<strong>{{ $errors->first('username') }}</strong>
																		</span>
																	@endif
										</div>




										<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
														  <label for="exampleInputConfirmPassword1">Email</label>
														  {!! Form::email('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
																	@if ($errors->has('password_confirmation'))
																		<span class="help-block">
																			<strong>{{ $errors->first('password_confirmation') }}</strong>
																		</span>
																	@endif
										 </div>
     
     
                    
                    
                             <div class="form-check form-check-flat form-check-primary">
                      
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                    <a href="{{url('/')}}" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
                    
                    
    
