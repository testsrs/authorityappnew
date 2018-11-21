@extends('layouts.admin')

@section('content')
 <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              All Users
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Authority</a></li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
              </ol>
            </nav>
          </div>
          <div class="row">           
           
            
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Users</h4>
                  
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>
                          #
                        </th>
                        <th>
                          Name
                        </th>
                        <th>
                          Email
                        </th>
                        <th>
                          Action
                        </th>
                        
                        
                      </tr>
                    </thead>
                    <tbody>
						 @if (count($users) > 0)
						<?php $i = 1; ?>
						 @foreach( $users as $user )
								<tr>
									
									<td>
										{{ $i }}
									</td>
									
									<td>
										{{ $user->username }}
									</td>
									
									<td>
										{{ $user->email }}
									</td>
									<!-- action links -->
									<td>
										
										<a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
										{!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
										{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
										{!! Form::close() !!}
									</td>
									
									
									
								</tr>	
								
								
								
								
							<?php 	$i++; ?>
							@endforeach
						@else
							<tr>
									<td colspan="3">
										No users
								</td>
									
							</tr>	
						
						@endif
										
						
						
                      
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            
            
        </div>
        <!-- content-wrapper ends -->
        
@endsection
