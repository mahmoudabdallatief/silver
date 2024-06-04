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
<div class="col-12">
        <div class="card">
            <div class="card-body">
                <br>
                <form class="parsley-style-1" id="selectForm2" autocomplete="off" name="selectForm2"
                    action="{{route('users.store')}}" method="post">
                    {{csrf_field()}}

                    <div class="">

                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-4" id="fnWrapper">
                                <label>{{__('mycustom.userinarabic')}}<span class="tx-danger">*</span></label>
                                <input class="form-control form-control-sm mg-b-20"
                                    data-parsley-class-handler="#lnWrapper" name="name_ar"  type="text">
                            </div>
                            
                       
                            <div class="parsley-input col-md-4" id="fnWrapper">
                                <label>{{__('mycustom.userinenglish')}}<span class="tx-danger">*</span></label>
                                <input class="form-control form-control-sm mg-b-20"
                                    data-parsley-class-handler="#lnWrapper" name="name_en"  type="text">
                            </div>

                            <div class="parsley-input col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>{{__('mycustom.email')}}<span class="tx-danger">*</span></label>
                                <input class="form-control form-control-sm mg-b-20"
                                    data-parsley-class-handler="#lnWrapper" name="email"  type="text">
                            </div>
                        </div>

                    </div>

                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>{{__('mycustom.password')}}<span class="tx-danger">*</span></label>
                            <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                                name="password"  type="password">
                        </div>

                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>{{__('mycustom.confirmpassword')}}<span class="tx-danger">*</span></label>
                            <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                                name="confirm-password"  type="password">
                        </div>
                    </div>

                    

                    <div class="row mg-b-20">
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="form-label">{{__('mycustom.userrole')}}</label>
                                {!! Form::select('roles_name[]', $roles,[], array('class' => 'form-control select2','multiple')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button class="btn btn-primary pd-x-20" type="submit">{{__('mycustom.Confirm')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
              </div>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      
    </section>
@endsection