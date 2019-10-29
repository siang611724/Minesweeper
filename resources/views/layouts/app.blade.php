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

    <link rel="icon" href="{{ asset('/icon/icon.svg') }}">
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
        body,
        html {
            background-color: #f9f9f9;
            font-family: 'Nunito', sans-serif, 微軟正黑體;

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

        .card-header {
            cursor: pointer;
            background-color: #fff;
            margin: 5px;
            border-radius: 10px;
        }
        .card-body{
            color: black;
            font-weight: 700;
            margin-left: 15px;
        }
    </style>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <b><a class="navbar-brand" style="font-family: Nunito; font-size: 1.7rem" href="{{ url('/') }}">
                    <img src="{{URL::asset('/image/icon.svg')}}" alt="profile Pic" height="35" width="30" class="d-inline-block align-top">
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
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: "/api/announce",
                dataType: 'json',
                success: function(e) {
                    //   console.log(e.data.length);
                    for (j = e.length - 1; j >= 0; j--) {
                        //   console.log(e);
                        $('.accordion').append(
                            '<div class="card"><div class="card-header" id="heading' +
                            j +
                            '"><button class="btn text-left btn-sm btn-link" type="button" data-toggle="collapse" data-target="#collapse' +
                            j +
                            '" aria-expanded="true" aria-controls="collapse' +
                            j + '"><span class="h5 annTitle">[' + e[j].type + '] ' + e[j].releaseDate + ' ' + e[j].title +
                            '</span></button></div><div id="collapse' +
                            j +
                            '" class="collapse" aria-labelledby="heading' +
                            j +
                            '"data-parent="#accordionExample"><div class="card-body">' +
                            e[j].content + '</div></div></div>'
                        )
                    }
                }
            });
        })

        function storeCoin() {
            var cardNumKey = document.getElementById("cardNumInput").value;
            var cardNumPatt = /^\d{4}-\d{4}-\d{4}-\d{4}$/;
            var CVVKey = document.getElementById('CVVInput').value;
            var CVVPatt = /^\d{3}$/;
            var coinValue = document.querySelector("input[name='radios']:checked").value;
            var month = $('#cardMonth').val();
            var year = $('#cardYear').val();
            var result = confirm("確定要儲值 " + coinValue + " 金幣嗎？");
            if (cardNumPatt.test(cardNumKey) && CVVPatt.test(CVVKey) && !($('#cardMonth').val() == '') && !($('#cardYear').val() == '')) {
                if (result == true) {
                    $.ajax({
                        type: 'PUT',
                        url: '/api/store/{{ Auth::id() }}',
                        dataType: 'json',
                        data: {
                            'coins': coinValue,
                            'cardNum': cardNumKey,
                            'CVV': CVVKey,
                            'cardMonth': month,
                            'cardYear': year
                        },
                        success: function(result) {
                            if (result.error) {
                                document.getElementById('errorText').innerHTML = result.error[0];
                            } else {
                                alert('加值成功');
                                location.reload();
                            }
                        }
                    });
                }
            } else if (!cardNumPatt.test(cardNumKey)) {
                document.getElementById("errorText").innerHTML = "請輸入正確信用卡號碼";
                return false;
            } else if (!CVVPatt.test(CVVKey)) {
                document.getElementById("errorText").innerHTML = "請輸入正確安全碼";
                return false;
            } else if ($('#cardMonth').val() == '' || $('#cardYear').val() == '') {
                document.getElementById("errorText").innerHTML = "請填寫信用卡到期日";
                return false;
            }
            // alert(patt.test(key));
            // alert(key);
        }

        function tradingList() {
            $('#tradingList').html('');
            $.ajax({
                type: 'GET',
                url: '/api/trans/{{ Auth::id() }}',
                dataType: 'json',
                success: function(result) {
                    for (i = 0; i < result.length; i++) {
                        $('#tradingList').append("<tr><td>" +
                            result[i].id + "</td><td>" +
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