@extends('layouts.app')

@section('content')
<div class="container">
    <div class="content row">
        <div class="information_left d-md-none d-lg-block d-sm-none d-none">

            <!-- hidden-xs hidden-sm  -->

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
        </div>
        <!-- <div class="text_box"> 彈出對話框 -->
        <!-- <p>彈窗內容</p> -->
        <!-- </div>  -->

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

        <div class="gameArea_right col-lg-8 col-sm-12 col-12">
            <div class="right_collection">
                <!-- <div style="border: 1px solid; height: 400px; width: 660px; margin: auto; margin-top: 20px" class="mb-3"> -->
            </div>
            <div class="">
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

<script type="text/javascript">
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



@endsection