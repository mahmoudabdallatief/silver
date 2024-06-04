
<!DOCTYPE html>
<html lang="ar">

<head>

    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="n80fszngzr1H7XpQjvKvmFqrq3bwatf24c4K3EBt">

    
    
    
    <title>
                AdminLTE 3            </title>

    
    
                <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">

            
    
    
    
    
    
            
    
    
</head>

<body class="register-page" >

    
        <div class="register-box">

        
        <div class="register-logo">
            <a href="http://127.0.0.1:8000/home">

                
                                    <img src="http://127.0.0.1:8000/vendor/adminlte/dist/img/AdminLTELogo.png"
                         alt="Admin Logo" height="50">
                
                
                <b>Admin</b>LTE

            </a>
        </div>

        
        <div class="card card-outline card-primary">

            
                            <div class="card-header ">
                    <h3 class="card-title float-none text-center">
                         Register New Account                       </h3>
                </div>
            
            
            <div class="card-body register-card-body ">
                    <form action="{{route('register')}}" method="post">
        @csrf
        
        <div class="input-group mb-3">
            <input type="text" name="name_ar" class="form-control @error('name_ar') is-invalid @enderror"
                   value="{{old('name_ar')}}" placeholder="Name in Arabic" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user "></span>
                </div>
                @error('name_ar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            </div>
            <div class="input-group mb-3 mt-3">
            <input type="text" name="name_en" class="form-control @error('name_en') is-invalid @enderror"
                   value="{{old('name_en')}}" placeholder="Name in English" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user "></span>
                </div>
            </div>
            @error('name_en')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>

        
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{old('email')}}" placeholder="E-mail">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope "></span>
                </div>
            </div>
            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>

        
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="Password">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock "></span>
                </div>
            </div>
            @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>

        
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                   class="form-control "
                   placeholder="Confirm Password">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock "></span>
                </div>
            </div>

                    </div>

        
        <button type="submit" class="btn btn-block btn-flat btn-primary">
            <span class="fas fa-user-plus"></span>
             Register
        </button>

    </form>
            </div>

            
                            <div class="card-footer ">
                        <p class="my-0">
        <a href="{{route('login')}}">
            Do you already have an account?
        </a>
    </p>
                </div>
            
        </div>

    </div>

    
       
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    
    
    
    
    
            
</body>

</html>
