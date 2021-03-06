<!DOCTYPE html>
<html lang="en">

<head id="toAppend">
</head>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="icon" href="{{ asset('/icon/icon.svg') }}">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <style>
        html,
        body {
            overflow: hidden;
            font-family: 微軟正黑體;
        }


        /* ============================================================ */
        /* for scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: rgb(121, 144, 175);
        }

        ::-webkit-scrollbar-thumb {
            background: LightSteelBlue;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgb(154, 183, 221);
        }

        /* ===================================================== */
        .rightSide {
            overflow: hidden;
        }

        .cardheader {
            overflow: hidden;
        }

        table {
            table-layout: fixed;

        }

        .modal-header {
            background-color: LimeGreen;
            color: white;
        }

        #Info {
            display: none;
        }

        .annTitle {
            text-overflow: ellipsis;
            height: 15px;

        }

        .leftNav {
            margin: 20px;
            border: 1px solid LightSteelBlue;
            padding: 10px;
            height: 80vh;
            overflow-y: scroll;
        }

        .leftSide {
            padding: 3px;
            border-right: 1px solid LightSteelBlue;
        }

        input {
            border-radius: 3px;
            box-shadow: 0;
            border: 1px solid lightgrey;
            width: 70%;
        }

        .fa-coins {
            color: goldenrod;
            font-size: 30px;
        }

        .PWchangeHeader {
            background-color: red;
            color: white;
        }

        textarea {
            width: 100%;
            height: 28vh;
            max-width: 100%;
            max-height: 28vh;
            resize: none;
            border-radius: 3px;
            border: 1px solid lightgrey;
        }
    </style>
    <title>Minesweeper Online</title>
</head>

<body>
    <div>
        <nav class="navbar navbar-dark bg-dark">
            <b><a class="navbar-brand" href="#" style="font-family: Nunito; font-size:1.7rem;">
                    <img src="{{URL::asset('/image/icon.svg')}}" alt="profile Pic" width="30" height="35" class="d-inline-block align-top">
                    Minesweeper Online</a></b>

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Administrator
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </nav>
    </div>

    <div class="container">

        <!-- 左側欄位 -->
        <div class="bd-example bd-example-tabs">
            <div class="row leftNav">
                <div class="col-2 text-center leftSide">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link show active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="false" onclick="MemberList()">會員資料</a>
                        <a class="nav-link show" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">發布公告</a>
                    </div>
                </div>
                <div class="col-10 rightSide">
                    <div class="tab-content" id="v-pills-tabContent">
                        <!-- 會員資料 -->
                        <div class="tab-pane fade show active container" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div id="table">
                                <table class="table table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>ID</th>
                                            <th>Status</th>
                                            <th>Infomation</th>
                                        </tr>
                                    </thead>
                                    <tbody id="members">
                                        <!-- 會員列表生成處 -->
                                    </tbody>
                                </table>
                            </div>
                            <div id="Info">
                            </div>
                        </div>





                        <!-- 公告 -->
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <span class="h2">公告列表</span>
                            <button type="button" class="btn float-right btn-success btn-lg" data-toggle="modal" data-target="#exampleModal">
                                +
                            </button>
                            <hr>
                            <div class="accordion" id="accordionExample">
                                <!-- 公告生成區 -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>




    <!-- 新增金幣MODAL -->

    <div class="modal fade" id="AddCoinModal" tabindex="-1" role="dialog" aria-labelledby="AddCoinModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddCoinModalLabel">補償金幣</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <i class="fas fa-coins"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="AddCoin" name="AddCoin" placeholder="請輸入補償金額">
                    <div class="errorMsgCoin" style="display: none; color: red">
                        <div></div>
                    </div>
                </div>
                <div class="modal-footer AddCoinFooter">
                    <!-- <button type="button" class="btn btn-primary">Save changes</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->

                </div>
            </div>
        </div>
    </div>
    <!-- 新增公告MODAL -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="AddAnnModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="AddAnnModal">新增公告</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>


                </div>
                <div class="modal-body">
                    <input type="text" id="AddAnnTitle" placeholder="請輸入新公告標題">
                    <br>
                    <br>
                    <textarea id="AddAnnContent" placeholder="請輸入公告內容"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary AddAnnOK" onclick="AddAnnOK()" data-dismiss="modal">發布</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
    <!-- 修改密碼Modal -->

    <div class="modal fade" id="PWchange" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header PWchangeHeader">
                    <h5 class="modal-title" id="PWchangeLabel">密碼修改</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="NewPW" placeholder="請輸入新密碼">
                    <div class="errorMsgPW" style="display: none; color:red">
                        <div></div>
                    </div>
                </div>
                <div class="modal-footer PWFooter">
                </div>
            </div>
        </div>
    </div>


    <script>
        // 詳細會員資料
        function ReadMore(j) {
            console.log(j);
            // 會員資料
            $.ajax({
                type: 'GET',
                url: "/api/member",
                dataType: 'json',
                success: function(e) {
                    let idArray = j - 1;
                    $('#Info').html("");

                    $('#Info').append('<div class="row"><div class="col-9 h1">' +
                        e[idArray].name +
                        '<btn class="btn-link" data-toggle="modal" data-target="#PWchange" onclick="ChangePWFooter(' +
                        e[idArray].id + ')"><span class="h6">[密碼修改]</span></btn><p class="h5">' +
                        e[idArray].email +
                        '</p></div><div class="col-3 h4 m-auto"><i class="fas fa-coins"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span id="NewCoin">' +
                        e[idArray].coins +
                        '</span><button type="button" class="btn btn-success float-right" onclick="AddCoinFooter(' +
                        e[idArray].id +
                        ')"   data-toggle="modal" data-target="#AddCoinModal">+</button></div></div><div class="nav w-100 nav-tabs" id="nav-tab" role="tablist"><a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">登入紀錄</a><a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">交易紀錄</a> <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">遊玩紀錄</a></div><div class="tab-content" id="nav-tabContent"><div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"><div id="table"><table class="table table-hover"><thead class="thead-light"><tr><th>登入序號</th><th>登入時間</th></tr></thead><tbody id="Log"></tbody></table></div></div><div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"><div id="table"><table class="table table-hover"><thead class="thead-light"><tr><th>訂單號</th><th>交易時間</th><th>交易類型</th><th>金額異動</th><th>總金額</th></tr></thead><tbody id="Order"></tbody></table></div></div><div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"><div id="table">    <table class="table table-hover"><thead class="thead-light"><tr><th>遊戲局號</th><th>遊戲時長</th><th>遊戲結果</th></tr></thead><tbody id="GameInfo"></tbody></table></div></div></div></div>'
                    )
                }
            })
            //   console.log(j)
            // 交易紀錄
            $.ajax({
                type: 'GET',
                url: "/api/trans/" + j,
                dataType: 'json',
                success: function(e) {
                    console.log(e);
                    for (i = 0; i < e.length; i++) {

                        $('#Order').append(
                            '<tr><th>' +
                            e[i].id +
                            '</th><td>' +
                            e[i].trading_date +
                            '</td><td>' +
                            e[i].trading_type +
                            '</td><td>' +
                            e[i].trading_coins +
                            '</td><td>' +
                            e[i].balance_coins +
                            '</td></tr>')

                    }
                }
            })
            //   登入紀錄
            $.ajax({
                type: 'GET',
                url: "/api/logs/" + j,
                dataType: 'json',
                success: function(e) {
                    //   console.log(e);
                    for (i = 0; i < e.length; i++) {

                        $('#Log').append(
                            '<tr><th>' +
                            e[i].id +
                            '</th><td>' +
                            e[i].login_time +
                            '</td>')

                    }
                }
            })
            // 遊戲歷程
            $.ajax({
                type: 'GET',
                url: "/api/course/" + j,
                dataType: 'json',
                success: function(e) {
                    console.log(e)
                    for (i = 0; i < e.length; i++) {
                        $('#GameInfo').append(
                            '<tr><th>' +
                            e[i].GameID +
                            '</th><td>' +
                            e[i].Time + '秒' +
                            '</td><td>' +
                            e[i].result +
                            '</td></tr>')

                    }
                }
            })

            //    ===============================
            var t = document.getElementById('table');
            t.style.display = 'none';
            var t1 = document.getElementById('Info');
            t1.style.display = 'block';
        }

        function ChangePWFooter(id) {
            $('.PWFooter').html('');
            $('.PWFooter').append(
                '<button type="button" class="btn btn-danger" Onclick="changePW(' + id +
                ')">確認</button><button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>'
            )
        }

        function AddCoinFooter(id) {
            $('.AddCoinFooter').html('');
            $('.AddCoinFooter').append(
                '<button type="button" class="btn btn-success" Onclick="AddCoinOK(' + id + ')" id ="updateCoin" data-dismiss="modal">確認</button><button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>'
            )
        }


        function changePW(id) {
            // console.log(j);
            var NewPW = $("#NewPW").val();
            $.ajax({
                type: 'PUT',
                url: "/api/member/" + id,
                dataType: 'json',
                data: {
                    "password": NewPW,
                },
                success: function(response) {
                    if (response.errorMsg == 'numberOnly') {
                        $('.errorMsgPW').find('div').html('');
                        $('.errorMsgPW').css('display', 'block');
                        $('.errorMsgPW').find('div').append("<p>" + response.error + "</p>");
                        $("#NewPW").val('');
                    } else {
                        alert("已修改成功");
                        location.reload();
                    }
                }
            })
        }

        function AddCoinOK(id) {
            var AddCoin = $("#AddCoin").val();
           
            $.ajax({
                type: 'PUT',
                url: "/api/coin/" + id,
                dataType: 'json',
                data: {
                    "coins": AddCoin,
                },
                success: function(response) {
                    // alert(errors.error);
                    if (response.errorMsg == 'numberOnly') {
                        $('.errorMsgCoin').find('div').html('');
                        $('.errorMsgCoin').css('display', 'block');
                        $('.errorMsgCoin').find('div').append("<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + response.error + "</p>");
                        $("#AddCoin").val('');
                    } else if (response.errorMsg == 'moreThan0') {
                        $('.errorMsgCoin').find('div').html('');
                        $('.errorMsgCoin').css('display', 'block');
                        $('.errorMsgCoin').find('div').append("<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;金幣不能少於0</p>");
                        $("#AddCoin").val('');
                    } else {
                        alert("已修改成功");
                     
                    }
                }
            })
            $.ajax({
                type: 'get',
                url: "/api/NewCoin/" + AddCoin+"/"+id,
                success: function (newCoin) {
                  document.getElementById("NewCoin").innerHTML=newCoin;

                // console.log(newCoin);
                   }
             })
        }

        // ====================功能已完成=========================
        $(document).ready(function() {
            //    公告列表生成
            $.ajax({
                type: 'GET',
                url: "/api/announce",
                dataType: 'json',
                success: function(e) {
                    // console.log(e);
                    for (j = e.length - 1; j >= 0; j--) {
                        // console.log(e);
                        $('.accordion').append(
                            '<div class="card" id="Card'+e[j].id+'"><div class="card-header" id="heading' +
                            j +
                            '"><button class="btn text-left btn-sm btn-link" type="button" data-toggle="collapse" data-target="#collapse' +
                            j +
                            '" aria-expanded="true" aria-controls="collapse' +
                            j + '"><span class="h5 annTitle'+e[j].id+'">#' + e[j].id + ' 　　' +
                            e[j].title +
                            '</span>[修改]</button><button class="btn btn-sm btn-danger float-right" onclick="deleteAnn(' +
                            e[j].id +
                            ')"><i class="fas fa-trash-alt"></i></button></div><div id="collapse' +
                            j +
                            '" class="collapse" aria-labelledby="heading' +
                            j +
                            '"data-parent="#accordionExample"><div class="card-body"><div class="form-group"><input type="text" id="updateTitle' +
                            e[j].id +
                            '" placeholder="請輸入新公告標題" id="updateTitle"><button type="button" class="btn btn-success float-right mr-3" onclick="updateOK(' +
                            e[j].id +
                            ')">確認</button></div><textarea id="updateContent' + e[j]
                            .id +
                            '" placeholder="請輸入公告內容">' +
                            e[j].content + '</textarea></div></div></div>'
                        )
                    }
                }
            });


            //    會員列表生成
            $.ajax({
                type: 'GET',
                url: "/api/member",
                dataType: 'json',
                success: function(e) {
                    //    會員列表生成
                    for (j = 0; j < e.length; j++) {
                        $('#members').append(
                            '<tr><th>' + e[j].id + '</th><td>' + e[j].name +
                            '</td><td><input type="checkbox" id="Checkbox' + e[j]
                            .id +
                            '" checked  onchange="Status(' + e[j].id +
                            ')" data-toggle="toggle" data-on="Normal" data-off="Ban" data-onstyle="success" data-offstyle="danger"></td><td><button type = "button" class = "btn btn-primary btn-sm" onclick = "ReadMore(' +
                            e[j].id + ')">More</button></td></tr>'
                        )
                        var CheckboxId = "#Checkbox" + e[j].id;
                        //抓取停權狀態
                        if (e[j].status) {
                            $(CheckboxId).prop("checked",
                                false); // $().prop("checked", true)
                        }
                    }
                    // 事後新增CDN
                    $("head").append(
                        '<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.5.0/css/bootstrap4-toggle.min.css" rel="stylesheet"><script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.5.0/js/bootstrap4-toggle.min.js"><//script>'
                    )
                }
            })
        })

        // 更新公告
        function updateOK(i) {
            let title = $("#updateTitle" + i).val();
            let content = $("#updateContent" + i).val();
            // console.log(title);
            // console.log(content);
            $.ajax({
                type: 'PUT',
                url: "/api/announce/" + i,
                dataType: 'json',
                data: {
                    "title": title,
                    "content": content,
                },
                success: function() {
                    $.ajax({
                type: 'GET',
                url: "/api/announce/" +i ,
                dataType: 'json',
                success: function(e) {
                    // console.log(e);
                    $(".annTitle"+i).html('#'+i+' 　　'+e.title);
                    $("#updateContent"+i).html(e.content);                               
                                }
                         })
                    alert("已修改成功"); 
                }
            })

        }
        // 切換至MEMBER
        function MemberList() {
            var t = document.getElementById('table');
            t.style.display = 'block';
            var t1 = document.getElementById('Info');
            t1.style.display = 'none';
        }

        // 新增公告

        function AddAnnOK() {
            let title = $("#AddAnnTitle").val();
            let content = $("#AddAnnContent").val();
            $.ajax({
                type: 'POST',
                url: "/api/announce",
                dataType: 'json',
                data: {
                    "title": title,
                    "content": content,
                },
                success: function() {
                    $("#AddAnnTitle").val("");
                    $("#AddAnnContent").val("");
                  
                    $.ajax({
                        type:"get",
                        url:"/api/NewAnnounce",
                        success:function(e){
                           
                            // console.log(e[0].id);
                           var listID=e.length-1;
                           var lastID=e.length-1;
                            var listID2=e[e.length-1].id;
                            var listID3=e[e.length-2].id
                           console.log(e);
                            
                            console.log(listID);
                            console.log(lastID);
                            console.log(listID2);
                            
                        $('#Card'+listID3).before(
                            '<div  class="card" id="Card'+listID2+'"><div class="card-header" id="heading' +
                            listID +
                            '"><button class="btn text-left btn-sm btn-link" type="button" data-toggle="collapse" data-target="#collapse' +
                            listID +
                            '" aria-expanded="true" aria-controls="collapse' +
                            listID + '"><span class="h5 annTitle">#' + e[listID].id + ' 　　' +
                            e[listID]
                            .title +
                            '</span>[修改]</button><button class="btn btn-sm btn-danger float-right" onclick="deleteAnn(' +
                            e[listID].id +
                            ')"><i class="fas fa-trash-alt"></i></button></div><div id="collapse' +
                            listID +
                            '" class="collapse" aria-labelledby="heading' +
                            listID +
                            '"data-parent="#accordionExample"><div class="card-body"><div class="form-group"><input type="text" id="updateTitle' +
                            e[listID].id +
                            '" placeholder="請輸入新公告標題" id="updateTitle"><button type="button" class="btn btn-success float-right mr-3" onclick="updateOK(' +
                            e[listID].id +
                            ')">確認</button></div><textarea id="updateContent' + e[listID]
                            .id +
                            '" placeholder="請輸入公告內容">' +
                            e[listID].content + '</textarea></div></div></div>'
                        )
                    
                        }
                    })
                }
            });

        }

        // 刪除公告
        function deleteAnn(j) {

            $.ajax({
                type: 'DELETE',
                url: "/api/announce/" + j,
                dataType: 'json',
                data: {},
                success: function(e) {
                console.log(j);
                  alert("已刪除");
                  $("#Card"+j).hide();
                }
            })
        }

        function Status(i) {
            // console.log($("#Checkbox"+i ))
            // console.log()
            if (true) {
                $.ajax({
                    type: 'PUT',
                    url: "/api/ban/" + i,
                    dataType: 'json',
                    data: {
                        status: !$('#Checkbox' + i).prop("checked")
                    }
                })
            }
        }
      

        $("#updateCoin").click(function(){
            var AddCoin = $("#AddCoin").val();
    
        })
    </script>
</body>

</html>