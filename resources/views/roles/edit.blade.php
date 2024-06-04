@extends('layouts-dashboard.app')
@section('title' , __('mycustom.roles'))
@section('content')

<section class="content">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('mycustom.roles')}}</h1>
           
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
                {!! Form::model($role, ['method' => 'PUT','route' => ['roles.update', $role->id]]) !!}
               
                   

                    <div class="">

                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-6" id="fnWrapper">
                            <p>{{ __('mycustom.roleinarabic')}}</p>
                            {!! Form::text('name_ar', null, array('class' => 'form-control')) !!}
                            </div>
                            
                            <div class="parsley-input col-md-6" id="fnWrapper">
                            <p>{{ __('mycustom.roleinenglish')}}</p>
                            {!! Form::text('name_en', null, array('class' => 'form-control')) !!}
                            </div>
                            

                            
                        </div>

                    </div>

                    <div class="row">
                    <!-- col -->
                    <div class="col-lg-4">
                        <ul id="treeview1">
                            <li><a href="#">{{ __('mycustom.permissions')}}</a>
                                <ul>
                            </li>
                            @foreach($permission as $value)
                                        <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                            {{ $value->name }}</label>
                                        <br />
                                        @endforeach
                            </li>

                        </ul>
                        </li>
                        </ul>
                    </div>
                    

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button class="btn btn-primary pd-x-20" type="submit">{{ __('mycustom.update')}}</button>
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