<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Minesweeper Online</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

    <!-- game css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/mineSweeper.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <script src="https://kit.fontawesome.com/299337bdc7.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Nunito', sans-serif;

        }

        .information_left {
            /* float: left; */
            box-shadow: 1px 0 0 0 #eee;
            /* height: 550px; */
            width: 250px;
            margin: 15px;
        }

        .gameArea_right {
            /* float: left; */
            height: 550px;
            width: 700px;
            margin-top: 20px;
        }

        .content {
            position: absolute;
            background-color: #fff;
            height: 660px;
            width: 1200px;
            left: 50%;
            margin: 0 0 0 -600px;
            border: 1px solid #eee;
            border-radius: 15px;
        }

        .right_collection {
            position: absolute;
            left: 50%;
            transform: translate(-50%);
        }

        .mask {
            display: none;
            /* 默认隐藏 */
            position: fixed;
            /* 固定定位 */
            z-index: 10;
            /* 设置在顶层 */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .form-box {
            /* display: none; */
            background-color: #fff;
            position: fixed;
            margin: 100px auto;
            width: 50%;
            z-index: 20;
        }
    </style>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <b><a class="navbar-brand" style="font-size: 2rem" href="{{ url('/home') }}">
                        <img src="{{URL::asset('/image/icon.svg')}}" alt="profile Pic" height="30" width="30">
                        {{ 'Minesweeper Online' }}
                    </a></b>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <table class="d-xl-none d-lg-none">
                            <td style="margin-right: 20px" class="d-xl-none d-lg-none">
                                <tr>
                                    <td style="color: white;">信箱: {{ Auth::user()->email }} </td>
                                </tr>
                                <tr>
                                    <td style="color: white;">金幣: {{ Auth::user()->coins }}<a href="#exampleModalCenter" class="fas fa-plus-circle" style="color: rgb(0, 157, 230)" data-toggle="modal" data-target="#exampleModalCenter"></a></td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#exampleModalScrollable">
                                            我的錢包
                                        </button>
                                    </td>
                                </tr>
                            </td>
                        </table>
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>

                            </a>


                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>


                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <script>
            function storeCoin() {
                var key = document.getElementById("textinput").value;
                var coinValue = document.querySelector("input[name='radios']:checked").value;
                var result = confirm("確定要儲值 " + coinValue + " 金幣嗎？");
                var patt = /^\d{4}-\d{4}-\d{4}-\d{4}$/;
                if (patt.test(key)) {
                    if (result == true) {
                        // form.submit();
                        // return true;
                        $.ajax({
                            type: 'PUT',
                            url: 'http://127.0.0.1:8000/api/store/{{ Auth::id() }}',
                            dataType: 'json',
                            data: {
                                'coins': coinValue
                            },
                            success: function() {
                                alert('加值成功');
                                location.reload();
                            }
                        });
                    }
                } else {
                    document.getElementById("textbox").innerHTML = "請輸入正確信用卡號碼";
                    alert("格式錯誤");
                    return false;
                }
                // alert(patt.test(key));
                // alert(key);
            }

            function tradingList() {
                $.ajax({
                    type: 'GET',
                    url: 'http://127.0.0.1:8000/api/trans/{{ Auth::id() }}',
                    dataType: 'json',
                    success: function(result) {
                        for (i = 0; i < result.length; i++) {
                            $('#tradingList').append("<tr><td>" +
                                result[i].user_name + "</td><td>" +
                                result[i].trading_date + "</td><td>" +
                                result[i].trading_type + "</td><td>" +
                                result[i].trading_coins + "</td><td>" +
                                result[i].balance_coins + "</td></tr>");
                        }
                    }
                })
            }
        </script>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>