


@extends('layouts-dashboard.app')

@section('title' , __('mycustom.users') )
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
            <h1 class="m-0"> {{__('mycustom.users')}} </h1>
           
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
                    
                    <th>{{__('mycustom.name')}}</th>
                    <th>{{__('mycustom.email')}}</th>
                    <th>{{__('mycustom.controls')}}</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->{'name_' . app()->getLocale()} }}</td>
                        <td>{{$user->email}}</td>
                        <td>
                        @can('edit-user')
                          <a href="{{route('users.edit',$user->id)}}"><button class="btn btn-success">{{__('mycustom.edit')}}</button></a>
                          @endcan
                          @can('delete-user')
                         <a class="modal-effect btn  btn-danger" data-effect="effect-scale"
                                                
                                                data-toggle="modal" href="#modaldemo8{{$user->id}}">{{__('mycustom.delete')}}</a>
                                                @endcan</td>
                                                <div class="modal" id="modaldemo8{{$user->id}}">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">{{__('mycustom.deleteuser')}}</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('users.destroy', $user->id) }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>{{__('mycustom.deletecheck')}}</p><br>
                        {{ $user->{'name_' . app()->getLocale()} }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('mycustom.cancel')}}</button>
                        <button type="submit" class="btn btn-danger">{{__('mycustom.Confirm')}}</button>
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
