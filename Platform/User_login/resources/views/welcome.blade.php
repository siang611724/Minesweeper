<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MinesweeperOnline</title>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            /* color: #636b6f; */
            font-family: 'Nunito', sans-serif, 微軟正黑體;
            /* font-weight: 200; */
            height: 100vh;
            margin: 0;
        }

        /* .full-height {
            height: 100vh;
        } */

        /* .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        } */

        /* .position-ref {
            position: relative;
        } */

        /* .top-right {
            position: absolute;
            right: 10px;
            top: 5px;
        } */

        /* .content {
            text-align: center;
        } */

        /* .title {
            font-size: 84px;
        } */

        /* .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        } */
        /* 
        .m-b-md {
            margin-bottom: 30px;
        } */

        .login {
            padding: 5px;
        }

        .register {
            padding-top: 40px;
        }

        td {
            padding: 0 0 0 14px;
            font-size: 14px;
        }

        nav {
            background-color: #eee;
        }
        h1 {
            font-weight: 600;
        }
    </style>
</head>

<body>

    @if (Route::has('login'))
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <b><a class="navbar-brand" href="{{ url('/') }}" style="font-family: Arial; font-size: 2rem">
                    <img src="{{URL::asset('/image/icon.svg')}}" alt="profile Pic" height="30" width="40">
                    Minesweeper Online</a></b>
            @auth
            @if(Auth::user()->name == 'admin')
            <a href="{{ url('/admin') }}">Game</a>
            @else
            <a href="{{ url('/home') }}">Game</a>
            @endif
            @else
            <form method="POST" action="{{ route('login') }}" style="right: 0px; float: right">
                @csrf
                <table>
                    <tbody>
                        <tr>
                            <td style="padding-top: 5px;">
                                <label for="email" style="margin-bottom: 2px; color: white;">{{ __('E-Mail Address') }}</label>
                            </td>
                            <td style="padding-top: 5px;">
                                <label for="password" style="margin-bottom: 2px; color: white;">{{ __('Password') }}</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input id="email" type="email" class="" name="email" required autocomplete="email" autofocus> <!-- value="{{ old('email') }}" -->

                                <!-- @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror -->
                            </td>
                            <td>
                                <input id="password" type="password" class="" name="password" required autocomplete="current-password"> <!-- <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password"> -->

                                <!-- @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror -->
                            </td>
                            <td>
                                <button type="submit" class="btn-primary">{{ __('Login') }}</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @error('email')
                                <span style="color: red; font-size: 14px">{{ $errors->messages()['email'][0] }}</span>
                                @enderror
                            </td>
                            <td>
                                @if($errors->has('password') && !$errors->has('email'))
                                <span style="color: red; font-size: 14px">{{ $errors->messages()['password'][0] }}</span>
                                @endif
                                <!-- @if (Route::has('password.request'))
                                <a class="" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif -->
                            </td>
                            <td>&emsp;</td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <!-- <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif -->
            @endauth
    </nav>
    @endif

    @if (Route::has('login'))
    <div class="container register">
        <div class="row">
            @auth
            <div class="col-lg-6 col-12">
                    <!--  style="display: inline-block; width: 500px; height: 600px; position: absolute; right: 200px;" -->
    
                <h1>遊戲介紹</h1>
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="http://user-image.logdown.io/user/7/blog/530/post/935/D3UaF7fTqCnLhjF1knmW_winmine.gif" class="d-block w-100" alt=""> 
                            <div class="carousel-caption d-none d-md-block">
                                <h5>踩地雷</h5>
                                <p>享受它吧</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="http://user-image.logdown.io/user/7/blog/530/post/935/D3UaF7fTqCnLhjF1knmW_winmine.gif" class="d-block w-100" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="http://user-image.logdown.io/user/7/blog/530/post/935/D3UaF7fTqCnLhjF1knmW_winmine.gif" class="d-block w-100" alt="">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>    
            </div>
            <div class="col-lg-6 col-12">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th colspan="2" scope="col">Title</th>
                            <th scope="col" style="text-align: right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td colspan="2">Article 1</td>
                            <td style="text-align: right"><button class="btn btn-primary btn-sm">more</button></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td colspan="2">Article 2</td>
                            <td style="text-align: right"><button class="btn btn-primary btn-sm">more</button></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Article 3</td>
                            <td style="text-align: right"><button class="btn btn-primary btn-sm">more</button></td>
                        </tr>   
                    </tbody>    
                </table>
            </div>
            @else
            <div class="col-lg-6 col-12">
                <!-- style="display: inline-block; position: relative; width: 500px; left: 50px; height: 600px;" -->
                <h1 class="">{{ __('快速註冊') }}</h1>
                <hr>
                <br>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <!--  style="display: inline-block; width: 500px; height: 600px; position: absolute; right: 200px;" -->

                <h1>遊戲介紹</h1>
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="http://user-image.logdown.io/user/7/blog/530/post/935/D3UaF7fTqCnLhjF1knmW_winmine.gif" class="d-block w-100" alt=""> 
                            <div class="carousel-caption d-none d-md-block">
                                <h5>踩地雷</h5>
                                <p>享受它吧</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="http://user-image.logdown.io/user/7/blog/530/post/935/D3UaF7fTqCnLhjF1knmW_winmine.gif" class="d-block w-100" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="http://user-image.logdown.io/user/7/blog/530/post/935/D3UaF7fTqCnLhjF1knmW_winmine.gif" class="d-block w-100" alt="">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>    
            </div>
            @endauth
        </div>
    </div>
    <div class="container news">
        <div class="form-group" style="margin-top: 50px; text-align: left;">
            <label style="text-align: left;">
                <h1>最新消息</h1>
            </label>
            <div class="accordion" id="accordionExample">
                    <!-- 公告生成區 -->
            </div>
            {{-- <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th colspan="2" scope="col">Title</th>
                        <th scope="col" style="text-align: right"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td colspan="2">Article 1</td>
                        <td style="text-align: right"><button class="btn btn-primary btn-sm">more</button></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td colspan="2">Article 2</td>
                        <td style="text-align: right"><button class="btn btn-primary btn-sm">more</button></td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Article 3</td>
                        <td style="text-align: right"><button class="btn btn-primary btn-sm">more</button></td>
                    </tr>
                </tbody>
            </table> --}}
        </div>
    </div>
    @endif

    <script>
        
    </script>

</body>

</html>