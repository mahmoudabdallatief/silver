@extends('layouts-dashboard.app')
@section('title' , __('mycustom.users') )
@section('content')

<section class="content">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{__('mycustom.users')}}</h1>
           
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
     
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="card-body">
          @if ($errors->any())
    <div class="alert alert-danger">
    <p>{{__('mycustom.error')}}</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="col-lg-12 col-md-12">

       

<div class="card">
    <div class="card-body">
        <br>

        {!! Form::model($user, ['method' => 'PUT','route' => ['users.update', $user->id]]) !!}
        @csrf
        <div class="">

            <div class="row mg-b-20">
                <div class="parsley-input col-md-4" id="fnWrapper">
                <label>{{__('mycustom.userinarabic')}}<span class="tx-danger">*</span></label>
                    {!! Form::text('name_ar', null, array('class' => 'form-control')) !!}
                </div>
                <div class="parsley-input col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper">
                <label>{{__('mycustom.userinenglish')}}<span class="tx-danger">*</span></label>
                    {!! Form::text('name_en', null, array('class' => 'form-control')) !!}
                </div>
                <div class="parsley-input col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper">
                <label>{{__('mycustom.email')}}<span class="tx-danger">*</span></label>
                    {!! Form::text('email', null, array('class' => 'form-control')) !!}
                </div>
            </div>

        </div>

        <div class="row mg-b-20">
            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
            <label>{{__('mycustom.password')}}<span class="tx-danger">*</span></label>
                {!! Form::password('password', array('class' => 'form-control')) !!}
            </div>

            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
            <label>{{__('mycustom.confirmpassword')}}<span class="tx-danger">*</span></label>
                {!! Form::password('confirm-password', array('class' => 'form-control')) !!}
            </div>
        </div>

      

        <div class="row mg-b-20">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{__('mycustom.userrole')}}<strong>
                    {!! Form::select('roles_name[]', $roles,$userRole, array('class' => 'form-control','multiple'))
                    !!}
                </div>
            </div>
        </div>
        <div class="mg-t-30">
            <button class="btn btn-primary pd-x-20" type="submit">{{__('mycustom.update')}}</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
</div>
              </div>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      
    </section>
@endsection