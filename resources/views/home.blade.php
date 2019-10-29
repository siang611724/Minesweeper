@extends('layouts.app')

@section('content')

<style>
    html,
    body {
        background-color: #fff;
        font-family: 微軟正黑體;
    }

    tr,
    td {
        color: black;
        margin-bottom: 10px;
    }

    th {
        width: 100px;
    }

    .right_collection {
        background-color: #fff;
    }

    .annTitle {
        color: #007aff;
        font-weight: 900;
    }

    .card-body {
        color: black;
        font-weight: 700;
    }

    /* .gameArea_right{overflow-y: scroll} */
    /* html{overflow: hidden} */
</style>

<script>
    var changePWMsg = '{{ Session::get('alertPW') }}';
    var exist = '{{ Session::has('alertPW') }}';
    if (exist) {
        alert(changePWMsg);
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
            <p style="margin: 20px 20px auto">金幣: {{ Auth::user()->coins }}
                <a href="#exampleModalCenter" class="fas fa-plus-circle" style="color: rgb(0, 157, 230)" data-toggle="modal" data-target="#exampleModalCenter"></a></p>
            <p style="margin: 20px 20px auto">
                <button onclick="tradingList();" type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#exampleModalScrollable">
                    我的錢包
                </button></p>
            <a href="/2"> <button onclick="closegame();" style="margin-top: 70px; margin-left: 30px;" class="css_button">開始遊戲</button></a>
            <a href="/home"> <button onclick="opengame();" style="margin-top: 10px; margin-left: 30px;" class="css_button">回到首頁</button></a>
        </div>


        <div class="gameArea_right col-lg-9 col-sm-12 col-12">
            <div class="right_collection col-lg-12">
                <div class="accordion" id="accordionExample">
                    <!-- 公告生成區 -->
                </div>
            </div>
        </div>
    </div>
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
            <!-- <form method="POST" action="api/store/{{ Auth::id() }}">
                        @csrf
                        @method('PUT') -->
            <div class="modal-body" style="">
                <table>
                    <tbody>
                        <tr>
                            <th><label class="control-label" for="cardNumInput">卡號*</label></th>
                            <td><input id="cardNumInput" name="cardNumInput" type="text" placeholder="請輸入卡號" class="form-control" style="width: 300px"></td>
                        </tr>
                        <tr>
                            <th><label class="control-label" for="dateInput">有效日期*</label></th>
                            <td><select name="cardMonth" id="cardMonth">
                                    <option value="">月</option>
                                    <option value="01">1</option>
                                    <option value="02">2</option>
                                    <option value="03">3</option>
                                    <option value="04">4</option>
                                    <option value="05">5</option>
                                    <option value="06">6</option>
                                    <option value="07">7</option>
                                    <option value="08">8</option>
                                    <option value="09">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                                /
                                <select name="cardYear" id="cardYear">
                                    <option value="">年</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><label class="control-label" for="CVVInput">CVV*</label></th>
                            <td><input id="CVVInput" name="CVVInput" type="text" placeholder="安全碼" class="form-control" style="width: 80px"></td>
                        </tr>
                    </tbody>
                </table>
                    <b><span style="color: red; background-color: pink" id="errorText" name="errorText" class="help-block"></span></b>
                <br>
                <!-- <div class="form-group">
                    <label class="col-md-4 control-label" for="textinput">卡號:</label>
                    <div class="col-md-6">
                        <input id="textinput" name="textinput" type="text" placeholder="請輸入卡號" class="form-control input-md" style="width: 400px">
                        <b><span id="textbox" style="color: red" class="help-block">格式:xxxx-xxxx-xxxx-xxxx</span></b>
                    </div>
                </div> -->

                <!-- Multiple Radios (inline) -->
                <div class="form-group" style="">
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
                <button type="button" onclick="storeCoin()" class="btn btn-primary">確認</button>
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
                            <th scope="col">交易編號</th>
                            <th scope="col">交易日期</th>
                            <th scope="col">交易類型</th>
                            <th scope="col">交易金額</th>
                            <th scope="col">餘額</th>
                        </tr>
                    </thead>
                    <tbody id="tradingList">
                        <!-- 交易紀錄區 -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>

@endsection