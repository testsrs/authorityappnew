@extends('layouts.admin')
 
@section('content')
   <div class="main-panel">        
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Edit User
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
    
    {!! Form::model($user, ['class' => 'form-horizontal','method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
        @include('admin.user.form')
    {!! Form::close() !!}
                    </div>
              </div>
            </div>
            
            
        </div>
        <!-- content-wrapper ends -->
@endsection
