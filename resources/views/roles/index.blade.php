


@extends('layouts-dashboard.app')
@section('title' , __('mycustom.roles'))
@section('content')
@if (session()->has('Add'))
        <script>
            window.onload = function() {
                notif({
                    msg: "{{session('Add')}}",
                    type: "success"
                })
            }

        </script>
    @endif

    @if (session()->has('edit'))
        <script>
            window.onload = function() {
                notif({
                    msg: "{{session('edit')}}",
                    type: "success"
                })
            }

        </script>
    @endif
    @if (session()->has('delete'))
        <script>
            window.onload = function() {
                notif({
                    msg: "{{session('delete')}}",
                    type: "success"
                })
            }

        </script>
    @endif
  <!-- Content Wrapper. Contains page content -->
 
    <!-- Content Header (Page header) -->
   
    <!-- /.content-header -->

    <!-- Main content -->
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    
                    <th>{{__('mycustom.id')}}</th>
                    <th>{{__('mycustom.name')}}</th>
                    <th>{{__('mycustom.controls')}}</th>
                  </tr>
                  </thead>
                  <tbody>
                   
                    @foreach($roles as $role)
                    <tr>
                    <td>{{$role->id}}</td>
                        <td>{{ $role->{'name_' . app()->getLocale()} }}</td>
                       
                        <td>
                        @if ($role->name_en !== 'owner')
                        @can('edit-role')

                            <a href="{{route('roles.edit',$role->id)}}"><button class="btn btn-success">{{ __('mycustom.edit')}}</button></a>
                            @endcan
                            @can('delete-role')
                         <a class="modal-effect btn  btn-danger" data-effect="effect-scale"
                                                
                                                data-toggle="modal" href="#modaldemo8{{$role->id}}">{{ __('mycustom.delete')}}</a>
                                                @endcan
                                            @endif
                                            </td>
                                                
                                                <div class="modal" id="modaldemo8{{$role->id}}">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('mycustom.deleterole')}}</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>{{ __('mycustom.deletecheck')}}</p><br>
                        <p>{{ $role->{'name_' . app()->getLocale()} }}</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('mycustom.cancel')}}</button>
                        <button type="submit" class="btn btn-danger">{{ __('mycustom.Confirm')}}</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
                    </tr>
                    @endforeach
                </tbody>
                </table>
              </div>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      
    </section>
  @endsection
