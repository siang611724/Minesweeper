@extends('layouts.app')

@section('content')

<script type="text/javascript">
    function checkCreditCard() {
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
</script>

<div class="">
    <div class="content row">
        <div class="information_left d-md-none d-lg-block d-sm-none d-none">

            <!-- hidden-xs hidden-sm  -->
            <div style="height: 100px; width:100px; margin: 30px auto 5px">
                <img src="{{URL::asset('/image/user_icon.jpg')}}" alt="profile Pic" height="100" width="100">
            </div> <!-- 頭像 -->
            <a class="" href="/edit">
                <p style="font-size:13px; padding-left: 88px; color: grey"><i class="fas fa-key"></i>變更密碼</p>
            </a>
            <p style="margin: 20px 20px auto">暱稱: {{ Auth::user()->name }}</p>
            <p style="margin: 20px 20px auto">信箱: {{ Auth::user()->email }}</p>
            <p style="margin: 20px 20px auto;display:inline">金幣:<div class="money"style="display:inline;"></div>
                <a href="#exampleModalCenter" class="fas fa-plus-circle" style="color: rgb(0, 157, 230)" data-toggle="modal" data-target="#exampleModalCenter" ><button id="addMoney" style="display:none"></button></a></p>
            <p style="margin: 20px 20px auto">
                <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#exampleModalScrollable">
                    我的錢包
                </button></p>

                <a href="/2"> <button onclick="closegame();" style="margin-top: 70px; margin-left: 30px;" class="css_button">開始遊戲</button></a>
                <a href="/home"> <button onclick="opengame();" style="margin-top: 10px; margin-left: 30px;" class="css_button">回到首頁</button></a>
        </div>

        <!-- 加值彈窗 -->
        
        <div data-backdrop="static" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

            <a href="/home"><button style="margin-top: 200px; margin-left: 85px">返回</button></a>
        </div>

        <!-- 加值彈窗 -->

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
>>>>>>> 1aa85344711447f232bf8e82b85cfe98306c2e1c
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">儲值</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- <form method="POST" action="api/store/{{ Auth::id() }}">
                        @csrf
                        @method('PUT') -->
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
                        <button type="button" onclick="checkCreditCard();" class="btn btn-primary">確認</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>

                    </div>
                    <!-- </form> -->
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


        <div id="mine">

            <div class="level">

                <button name="easy" id="easy" class="btn1">初級 </button>
                <button name="medium" id="medium" class="btn1">中級</button>
                <button name="hard" id="hard" class="btn1">高級</button>


            </div>
            <div class="info">
                剩餘地雷數:<span class="mineNum"></span>
                經過時間:<span class="times" id="times"></span>
            </div>
            <div class="gameBox">

            </div>


        </div>
        <button id="myModal" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="display: none;"></button>
        <button id="showHistoryLoseClick" type="button" class="btn btn-primary" data-toggle="modal" data-target="#showHistoryLose" style="display: none;"></button>
        <button id="showHistoryWinClick" type="button" class="btn btn-primary" data-toggle="modal" data-target="#showHistoryWin" style="display: none;"></button>

        <script src="js/game.js"></script>
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

{{-- 接關modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <span>復活將扣除5金幣</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="continue">復活</button>
                <button type="button" class="btn btn-secondary"  data-dismiss="modal" id="gameover">遊戲結束</button>
            </div>
        </div>
    </div>
    <script src="js/game.js"></script>
</div>
{{-- 不接關遊戲結束 --}}

<div class="modal fade" id="showHistoryLose" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                遊玩者:<div style="display:inline;">{{ Auth::user()->name }}</div> <br>
                遊戲時間:<div style="display:inline;" id="gametime" class="gametimeLose"></div>秒<br>
                剩餘金幣:<div style="display:inline;" class="moneyLose"style="display:inline;"></div><br>
                此局勝敗:敗
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">確認</button>
                
            </div>
        </div>
    </div>
    <script src="js/game.js"></script>
</div>
{{-- 遊戲勝利 --}}

<div class="modal fade" id="showHistoryWin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                遊玩者:<div style="display:inline;">{{ Auth::user()->name }}</div> <br>
                遊戲時間:<div style="display:inline;" id="gametime" class="gametimeWin"></div>秒<br>
                剩餘金幣:<div style="display:inline;" class="moneyWin"style="display:inline;"></div><br>
                此局勝敗:勝
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload()">確認</button>
                
            </div>
        </div>
    </div>
    <script src="js/game.js"></script>
</div>


@endsection