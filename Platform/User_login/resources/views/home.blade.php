@extends('layouts.app')

@section('content')
<div class="container">
    <div class="content">
        <div class="information_left">
            <div style="border: 1px solid; height: 100px; width:100px; margin: 30px auto"></div>
            <p style="margin: 20px 20px auto">暱稱: {{ Auth::user()->name }}</p>
            <p style="margin: 20px 20px auto">信箱: {{ Auth::user()->email }}</p>
            <p style="margin: 20px 20px auto">金幣:
                <a id="deposit" class="deposit">+</a></p>

            <div id="mask" class="mask">
                <!-- 遮蔽視窗 -->
                <div style="">
                    <form class="form-horizontal form-box">
                        <fieldset>

                            <!-- Form Name -->
                            <legend>Form Name</legend>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">卡號</label>
                                <div class="col-md-6">
                                    <input id="textinput" name="textinput" type="text" placeholder="請輸入卡號" class="form-control input-md">

                                </div>
                            </div>

                            <!-- Multiple Radios (inline) -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="radios">儲值金額</label>
                                <div class="col-md-4">
                                    <label class="radio-inline" for="radios-0">
                                        <input type="radio" name="radios" id="radios-0" value="1" checked="checked">
                                        10
                                    </label>
                                    <label class="radio-inline" for="radios-1">
                                        <input type="radio" name="radios" id="radios-1" value="2">
                                        30
                                    </label>
                                    <label class="radio-inline" for="radios-2">
                                        <input type="radio" name="radios" id="radios-2" value="3">
                                        50
                                    </label>
                                    <label class="radio-inline" for="radios-3">
                                        <input type="radio" name="radios" id="radios-3" value="4">
                                        100
                                    </label>
                                </div>
                            </div>

                            <!-- Button (Double) -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="button1id"></label>
                                <div class="col-md-8">
                                    <button id="button1id" name="button1id" class="btn btn-primary">確認</button>
                                    <button id="button2id" name="button2id" class="btn btn-danger">關閉</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>
            <!-- <div class="text_box"> 彈出對話框 -->
            <!-- <p>彈窗內容</p> -->
            <!-- </div>  -->
        </div>
        <div class="gameArea_right">
            <div style="border: 1px solid; height: 400px; width: 400px; margin-left: 30px; margin-top: 20px">
            </div>
            <p style="margin: 10px">公告欄:</p>
            <textarea name="" id="" cols="30" rows="10" style="height: 100px; width: 400px; margin-left: 30px"></textarea>
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
    $("#deposit").click(function() {
        $("#mask").show();
    })
</script>



@endsection