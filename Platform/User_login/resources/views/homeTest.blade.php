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
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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
            height: 550px;
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

        <main class="py-4">

            <script>
            function test() {
                alert('1');
            }

            function checkCreditCard(form) {
            var key = document.getElementById("textinput").value;
            var coinValue = document.querySelector("input[name='radios']:checked").value;
            var result = confirm("確定要儲值 " + coinValue + " 金幣嗎？");
            var patt = /^\d{4}-\d{4}-\d{4}-\d{4}$/;
            if (patt.test(key)) {
                if (result == true) {
                    form.submit();
                    return true;
                }
            } else {
                document.getElementById("textbox").innerHTML = "請輸入正確信用卡號碼";
                alert("格式錯誤");
                return false;
            }
            // alert(patt.test(key));
            // alert(key);
        }
            </script>

<div class="">
    <div class="content row">
        <div class="information_left d-md-none d-lg-block d-sm-none d-none">

            <!-- hidden-xs hidden-sm  -->

            <button onclick="test();">123</button>
            <div style="height: 100px; width:100px; margin: 30px auto 5px">
                <img src="{{URL::asset('/image/user_icon.jpg')}}" alt="profile Pic" height="100" width="100">
            </div> <!-- 頭像 -->
            <a class="" href="/user/{{ Auth::id() }}/edit">
                <p style="font-size:13px; padding-left: 88px; color: grey"><i class="fas fa-key"></i>變更密碼</p>
            </a>
            <p style="margin: 20px 20px auto">暱稱: {{ Auth::user()->name }}</p>
            <p style="margin: 20px 20px auto">信箱: {{ Auth::user()->email }}</p>
            <p style="margin: 20px 20px auto">金幣: {{ Auth::user()->coins }}
                <a href="#exampleModalCenter" class="fas fa-plus-circle" style="color: rgb(0, 157, 230)" data-toggle="modal" data-target="#exampleModalCenter"></a></p>
            <!-- <img src="../../public/image/plus-circle.svg" alt=""> -->
            <p style="margin: 20px 20px auto">
                <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#exampleModalScrollable">
                    我的錢包
                </button></p>
            <button onclick="test();">開始遊戲</button>
        </div>

        <!-- 加值彈窗 -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">儲值</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="api/store/{{ Auth::id() }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-body" style="margin-left: 20px">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">卡號:</label>
                                <div class="col-md-6">
                                    <input id="textinput" name="textinput" type="text" placeholder="請輸入卡號" class="form-control input-md" style="width: 400px">
                                    <b><span id="textbox" style="color: red" class="help-block">格式:xxxx-xxxx-xxxx-xxxx</span></b>
                                </div>
                            </div>

                            <!-- Multiple Radios (inline) -->
                            <div class="form-group" style="margin-left: 10px">
                                <label class="control-label" for="radios">請選擇儲值金額:</label>
                                <div class="">
                                    <label class="radio-inline" for="radios-0">
                                        <input type="radio" name="radios" id="radios-0" value="10" checked="checked">
                                        10
                                    </label>
                                    <label class="radio-inline" for="radios-1">
                                        <input type="radio" name="radios" id="radios-1" value="30">
                                        30
                                    </label>
                                    <label class="radio-inline" for="radios-2">
                                        <input type="radio" name="radios" id="radios-2" value="50">
                                        50
                                    </label>
                                    <label class="radio-inline" for="radios-3">
                                        <input type="radio" name="radios" id="radios-3" value="100">
                                        100
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="checkCreditCard(this.form)" class="btn btn-primary">確認</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- 錢包彈窗 -->
        <div class="modal fade bd-example-modal-lg" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">我的錢包</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table-sm table-striped" style="width: 100%">
                            <thead>
                                <tr>
                                    <th scope="col">使用者</th>
                                    <th scope="col">交易日期</th>
                                    <th scope="col">類型</th>
                                    <th scope="col">交易金額</th>
                                    <th scope="col">餘額</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tradingRecord as $tRecord)
                                <tr>
                                    <td>{{ $tRecord->user_name }}</td>
                                    <td>{{ $tRecord->trading_date }}</td>
                                    <td>{{ $tRecord->trading_type }}</td>
                                    <td>{{ $tRecord->trading_coins }}</td>
                                    <td>{{ $tRecord->balance_coins }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="gameArea_right col-lg-9 col-sm-12 col-12">
            <div class="right_collection">
                <!-- <div style="border: 1px solid; height: 400px; width: 660px; margin: auto; margin-top: 20px" class="mb-3"> -->
                <iframe src="http://127.0.0.1:8000/1" id="startGame" width="900" height="620" style="border-radius: 10px;">開始遊戲</! </div> <div class="">
                    <table class="table">
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
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
<!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                </div>
            </div>
        </div>
    </div> -->
</div>

<script>
    // var alerttest;
    // $(document).ready(function() {
    //     alerttest = function (){
    //         console.log('1');
    //     };

    // })
    function test() {
        alert('1');
    };
</script>

<script type="text/javascript">
    $(document).ready(function() {


        function checkCreditCard(form) {
            var key = document.getElementById("textinput").value;
            var coinValue = document.querySelector("input[name='radios']:checked").value;
            var result = confirm("確定要儲值 " + coinValue + " 金幣嗎？");
            var patt = /^\d{4}-\d{4}-\d{4}-\d{4}$/;
            if (patt.test(key)) {
                if (result == true) {
                    form.submit();
                    return true;
                }
            } else {
                document.getElementById("textbox").innerHTML = "請輸入正確信用卡號碼";
                alert("格式錯誤");
                return false;
            }
            // alert(patt.test(key));
            // alert(key);
        }
    })
</script>
            @yield('content')
        </main>
    </div>
</body>

</html>