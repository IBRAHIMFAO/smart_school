{{-- @extends('layouts.app')

@section('title', 'Login')
@section('content')



<div class="container">
    <section>
        <form class="card2" method="POST" action="{{ route('login') }}" style="margin-top: -22px">
            @csrf
            <div class="img">
                <i class="fas fa-clock"></i>
            </div>
            <div class="top">
                <h1 style="padding: 0% 10%"> Online Attendance</h1>
                <p style="margin: 0% 5%;font-size: 26px;"> Admin Login </p>
            </div>
            <div class="a">
                <label><span>Email Address:</span></label><br>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <label>Password:</label><br>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="forget">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}" >
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>

            </div>

            <label>Role:</label><br>
            <div class="col-md-6">
                <select id="role" class="form-control" name="role" required>
                    @foreach($userRoles as $role)
                        <option value="{{ $role }}">{{ $role }}</option>
                    @endforeach
                </select>
            </div>

            <div class="bottom">
                <button type="submit">
                    {{ __('Login') }}
                </button>
                <p>Don't have an account?<a href="#">Sign up!</a></p>
            </div>
        </form>
        <div class="imga">
            <img class="img-fluid" src="{{ url('image/img_login.png') }}" style="margin-top: 42px"/>
        </div>
    </section>
</div>

@endsection --}}






{{--
@extends('layouts.app')

@section('title', 'Login')

   @section('content')
    <div class="container">
        <section>
            <div class="form" style="min-height: 100vh;min-width:70vh ">

                <form class="form-control-all" method="POST" action="{{ route('login') }}">

                    @csrf
                    <div class="text-center">
                        <img src="{{ url('image/livre-login.png') }}" class="img-livre" style="width: 200px; height: 150px; ">
                    </div>
                    <div class="text text-center">
                        <h1><strong>Edu</strong>Portail</h1>
                        <p>Welcom</p>
                    </div>
                    <div class="card-body">
                        <div class="email">
                            <i class="fas fa-envelope"></i>
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <div class="col-md-6" style="width: 100%">
                                    <input type="text" class="form-control" name="email" placeholder="Email" required="">
                                    <p>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </p>

                                </div>
                        </div>

                    <div class="password">
                        <i class="fas fa-lock"></i>
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <div class="col-md-6" style="width: 100%">
                                    <input for="password" type="password" class="form-control" name="password" placeholder="Password" required="">
                                    <p>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                     </p>
                                </div>
                    </div>

                    <div class="forget">
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                    </div>

                    <div class="role">
                        <i class="fas fa-user"></i>
                        <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                        <div class="col-md-6" style="width:100%">
                            <select id="role" class="form-control" name="role" required>
                                @foreach($userRoles as $role)
                                    <option value="{{ $role }}">{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="remember">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label>Remember Me</label>
                    </div>


                    <div class="form-group row mb-0 text-center">
                        <div class="bottom">
                            <button type="submit" class="btn btn-primary mb-2"> {{ __('Login') }} </button>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                            <p>Don't have an account? <a href="#">Sign up!</a></p>
                    </div>


                    </div>
                </form>
            </div>
        </section>
    </div>

    <style>
        .container {
            display: flex;
                justify-content: center;
                align-items: center;
                /* background-color: blueviolet; */

            }
        .container .img-livre {
                object-fit: contain;
                object-position: 50% 50%;
                filter: saturate(1);
                /* box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1); */



            }

        .form {
            width: 100%;
            height:75% ;
            max-width: 500px;
            padding: 40px;
            border-radius: 10px;
            /* background-color: #fff; */
            background-color: lightskyblue;
             /* background-attachment: fixed; */
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
            }

        section .form-control-all {
            width: 100%;
            height: 100%;
            padding: 10px;
            border: none;
            /* background-color: #fff; */
            background-color: lightskyblue;

            }

        .form .text {
            margin-bottom: 20px;
            }
        .form .text p {
            font-size: 25px;    /* font-size: 14px; */
            font-weight: 400;
            font-bolder: 1000;
            /* font-style: italic; */
            color: rgb(4, 41, 97);
            font-family: 'Times New Roman', Times, serif;

        }
        .form .text h1 {
            font-size: 40px;
            font-weight: 700;
            color: rgb(222, 240, 25);
            font-family: 'Times New Roman', Times, serif;
            }
        .form .text strong {
            font-size: 40px;
            font-weight: 700;
            color: rgb(4, 41, 97);
            }

        .form i {
            position: absolute;
            font-size: 20px;
            color: #ffffff;
            margin: 10px;
            }
        .form label {
             margin-left: 40px;
                font-size: 20px;
                font-weight: 500;
                color: rgb(4, 41, 97);
                font-family: 'Times New Roman', Times, serif;

            }
        .form .forget a  {
            margin-top: -15px;
            margin-left: 75%;
            font-size: 15px;
            font-weight: 500;
            color: rgb(4, 41, 97);
            font-family: 'Times New Roman', Times, serif;
            text-decoration: none;
            }

        .form .remember label {
            margin-left: 5px;
            font-size: 15px;
            font-weight: 500;
            font: bold;
            color: rgb(4, 41, 97);
            font-family: 'Times New Roman', Times, serif;

            }
        .form .remember input {
            width: 20px;
            height: 20px;
            margin-top: 8px;
            }


        .form .form-control {
            position: relative;
            width: 100%;
            height: 50px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #fff;
            border: 1px solid #ced4da;
            padding: 0 15px;
            }


    </style>

@endsection --}}





@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container">
    <section>
        {{-- <div class="form"> --}}
            
            <form class="form-control-all" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="text-center">
                    <img src="{{ url('image/livre-login.png') }}" class="img-livre" alt="Logo" style="width: 200px; height: 150px;">
                </div>
                <div class="text text-center">
                    <h1><strong>Edu</strong>Portail</h1>
                    <p>Welcome</p>
                </div>
                <div class="card-body">

                    {{-- @if(session('status'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}

                    @if ($errors->any())
                        <div id="error-alert" class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="email">
                        <i class="fas fa-envelope"></i>
                        <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                        <div class="col-md-12" style="width: 100%">
                            <input type="text" class="form-control" name="email" placeholder="Email" required="">
                            <p>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </p>
                        </div>
                    </div>

                    <div class="password">
                        <i class="fas fa-lock"></i>
                        <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                        <div class="col-md-12" style="width: 100%">
                            <input for="password" type="password" class="form-control" name="password" placeholder="Password" required="">
                            <p>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </p>
                        </div>
                    </div>

                    <div class="forget">
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                    </div>

                    <div class="role">
                        <i class="fas fa-user"></i>
                        <label for="role" class="col-form-label text-md-right">{{ __('Role') }}</label>
                        <div class="col-md-12 mb-3" style="width: 100%">
                            <select id="role" class="form-control" name="role" required>
                                @foreach($userRoles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                   

                    <div class="remember ml-2 mb-3">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label>Remember Me</label>
                    </div>

                    <div class="form-group ">
                        <div class="bottom row">
                            <button type="submit" class="btn btn-primary mb-2"> {{ __('Login') }} </button>
                        </div>
                    </div>

                    <div class="form-group row mb-0 ml-3">
                        <p>Don't have an account? <a href="{{ route('register') }}">Sign up!</a></p>
                    </div>

                </div>
            </form>
        {{-- </div> --}}
        {{-- {{ dd($errors->all());  }} --}}
    </section>
</div>


<style>

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top:15px;
        margin-bottom: 15px;
        background-color: lightskyblue;
        
        /* background-color: blueviolet; */

    }

   


    @media (max-width: 576px) {

        form {
            width: 100%;
            height: 100%;
            border-radius: 10px;
            background-color: lightskyblue;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
            margin-bottom: 5%;
        }


        .container .img-livre {
            object-fit: contain;
            object-position: 50% 50%;
            filter: saturate(1);
        }


        form .text {
            margin-bottom: 20px;
        }

        form .text p {
            font-size: 25px;
            font-weight: 400;
            color: rgb(4, 41, 97);
            font-family: 'Times New Roman', Times, serif;
        }

        form .text h1 {
            font-size: 40px;
            font-weight: 700;
            color: rgb(222, 240, 25);
            font-family: 'Times New Roman', Times, serif;
        }

        form .text strong {
            font-size: 40px;
            font-weight: 700;
            color: rgb(4, 41, 97);
        }

        form i {
            position: absolute;
            font-size: 20px;
            color: #ffffff;
            margin: 10px;
        }

        form label {
            margin-left: 40px;
            font-size: 20px;
            font-weight: 500;
            color: rgb(4, 41, 97);
            font-family: 'Times New Roman', Times, serif;
        }

        form .forget a {
            margin-top: -15px;
            margin-left: 50%;
            font-size: 15px;
            font-weight: 500;
            color: rgb(4, 41, 97);
            font-family: 'Times New Roman', Times, serif;
            text-decoration: none;
        }

        form .remember label {
            margin-left: 5px;
            font-size: 15px;
            font-weight: 500;
            color: rgb(4, 41, 97);
            font-family: 'Times New Roman', Times, serif;
        }

        form .remember input {
            width: 20px;
            height: 20px;
            margin-top: 10px;
        }

        form .form-control {
            width: 100%;
            height: 50px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #fff;
            border: 1px solid #ced4da;
        }

        .bottom button {
            width: 50%;
            justify-content: center;
            align-items: center;
            margin-left: 25%;
            }



    }




</style>


<script>
    // Add a delay before hiding the error alert
    setTimeout(function(){
        document.getElementById('error-alert').style.display = 'none';
    }, 5000); // Adjust the duration (in milliseconds) as needed
</script>



















    {{-- <style>
            /* Make the form responsive */
        .form {
        width: 100%;
        max-width: 500px;
        margin: 0 auto;
        }

        /* Make the input fields responsive */
        .form-control {
        width: 100%;
        margin-bottom: 20px;
        }

        /* Make the buttons responsive */
        .bottom button {
        width: 100%;
        padding: 10px 0;
        }

        /* Make the image responsive */
        .img-livre {
        max-width: 100%;
        height: auto;
        }



        /* Media queries for smaller screens */
        @media (max-width: 576px) {
        .form {
            width: 100%;
        }
        }

        @media (max-width: 480px) {
        .form {
            width: 100%;
        }

        }

        /* Small devices (landscape phones, 576px and up)
        media (min-width: 576px) {
        .form {
            width: 50%;


        }
            } */



    </style> --}}

@endsection


