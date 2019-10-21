// var squares = [];
//row 橫的
//col 直的
var tds = [];
var parent = document.querySelector(".gameBox");
var mineNumLeft = document.querySelector(".mineNum");
var mineNum = 0;
var initMap = new Array();
var leftMine = 0;
var isClick = true;
var t = 0;
var timer;
var updateMoney = document.querySelector(".money");
var updateTimeWin = document.querySelector(".gametimeWin");
var updateTimeLose = document.querySelector(".gametimeLose");
var moneyWin = document.querySelector(".moneyWin");
var moneyLose = document.querySelector(".moneyLose");

function drawTable(map) {
    parent.oncontextmenu = function () {
        return false;
    };
    var table = document.createElement("table");
    leftMine = 0;
    mineNum = 0;
    for (var i = 0; i < map.length; i++) {
        var domTr = document.createElement("tr");
        tds[i] = [];
        for (var j = 0; j < map[1].length; j++) {
            var domTd = document.createElement("td");
            domTd.pos = [i, j];
            tds[i][j] = domTd;
            if (map[i][j]["type"] == "mine") {
                leftMine++;
                mineNum++;
            }
            domTd.onmousedown = function () {

                if (isClick) {
                    isClick = false;
                    //事件
                    play(event, this);
                    //定时器
                    setTimeout(function () {
                        isClick = true;
                    }, 250);//一秒内不能重複
                }
            }
            domTr.appendChild(domTd);
        }
        table.appendChild(domTr);
    }
    parent.innerHTML = "";
    parent.appendChild(table);
    mineNumLeft.innerHTML = leftMine;

}

function gameover(tds) {
    mineNumLeft.innerHTML = --leftMine;
    tds.className = "mine";
    tds.style.backgroundColor = "red";
    updateTimeLose.innerHTML = t.toFixed(2);
    $("#myModal").click();

}

function win() {

    var totalClicked = 0;
    for (var i = 0; i < tds.length; i++) {
        for (var j = 0; j < tds[0].length; j++) {
            if (tds[i][j].className != "" &&
                tds[i][j].className != "flag" &&
                tds[i][j].className != "mine") {
                totalClicked++;
                if (totalClicked == tds.length * tds[0].length - mineNum) {
                    $.ajax({
                        type: 'get',
                        url: '/wang',
                        success: function (e) {
                            updateMoney.innerHTML = e;

                        }
                    })
                    alert("你贏了")
                    updateTimeWin.innerHTML = t.toFixed(2);
                    $("#showHistoryWinClick").click(function(){
                        $.ajax({
                            type: 'get',
                            url: '/getlastmoney',
                            success: function (e) {
                                moneyWin.innerHTML = e;
    
                            }
                        })
                    });
                    $("#showHistoryWinClick").click();
                    clearInterval(timer);
                    t = 0;
                }
            }
        }
    }
}

function play(event, obj) {
    if (event.which == 1) {
        var position = {
            MapRows: obj.pos[0],
            MapCols: obj.pos[1]

        };
        $.ajax({
            async: true,
            type: "get",
            url: "/getMap/" + position.MapRows + "/" + position.MapCols,
            success: function (clickedItem) {

                var newMap = new Array();
                $.each(clickedItem, function (index, content) {
                    $.each(content, function (index2, content2) {
                        newMap.push(content2);
                    });

                });
                initMap = clickedItem;
                // console.log(obj);
                open(newMap, clickedItem);
            }
        }
        )
        if (t == 0) {
            timer = setInterval(function () {
                t += 0.2;
                document.querySelector('.times').innerHTML = Math.floor(t);
                //    console.log(t);
            }, 200);
        }
    }
    if (event.which == 3) {
        if (obj.className && obj.className != 'flag') {
            return;
        }
        obj.className = obj.className == 'flag' ? '' : 'flag';
        if (obj.className == 'flag') {
            mineNumLeft.innerHTML = --leftMine;
        } else {
            mineNumLeft.innerHTML = ++leftMine;
        }
    }

}

function open(newMap, clickedItem) {
    var k = -1;
    var changeClass = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight'];
    for (var i = 0; i < tds.length; i++) {
        for (var j = 0; j < tds[0].length; j++) {
            if (k < tds.length * tds[0].length && newMap[++k].checked == true) {
                if (newMap[k].className != 'flag') {
                    if (newMap[k].type != 'mine') {
                        tds[i][j].innerHTML = newMap[k].value;
                        tds[i][j].className = changeClass[newMap[k].value]
                        if (newMap[k].value == 0) {
                            tds[i][j].innerHTML = "";
                        }
                    } else if (newMap[k].type == 'mine' && tds[i][j].checked != true) {
                        tds[i][j].checked = true;

                        gameover(tds[i][j]);

                    }



                }

            } else {
                continue;
            }
        }
    }
    win();
    // console.log(initMap);

    // console.log(newMap);
    // console.log(newMap.length);

}
$("#easy").click(function () {
    clearInterval(timer);
    t = 0;
    document.querySelector('.times').innerHTML = t;
    var table = document.createElement("table");
    for (var i = 0; i < 9; i++) {
        var domTr = document.createElement("tr");
        for (var j = 0; j < 9; j++) {
            var domTd = document.createElement("td");
            domTr.appendChild(domTd);
        }
        table.appendChild(domTr);
    }
    mineNumLeft.innerHTML = 10;
    parent.innerHTML = "";
    parent.appendChild(table);
    var btn = document.createElement("button");
    parent.appendChild(btn);
    btn.innerHTML = "開始";
    btn.setAttribute("id", "starteasy");
    $("#starteasy").click(function () {
        var mapData = {
            column: 9,
            row: 9,
            bomb: 10
        };
        $.ajax({
            type: 'get',
            url: '/newmoneyeasy',
            success: function (money) {
                if (money <= 0) {
                    alert("您的剩餘金額為:0");
                    $("#addMoney").click();

                } else {
                    updateMoney.innerHTML = money;
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'get',
                        url: '/wang/' + mapData.column + '/' + mapData.row + '/' + mapData.bomb + '',
                        success: function (map) {

                            drawTable(map);
                            // console.log(map);
                        }
                    })
                }

            }
        })

    })

});

$("#medium").click(function () {
    clearInterval(timer);
    t = 0;
    document.querySelector('.times').innerHTML = t;
    var table = document.createElement("table");
    for (var i = 0; i < 16; i++) {
        var domTr = document.createElement("tr");
        for (var j = 0; j < 16; j++) {
            var domTd = document.createElement("td");
            domTr.appendChild(domTd);
        }
        table.appendChild(domTr);
    }
    mineNumLeft.innerHTML = 40;
    parent.innerHTML = "";
    parent.appendChild(table);
    var btn = document.createElement("button");
    parent.appendChild(btn);
    btn.innerHTML = "開始";
    btn.setAttribute("id", "startmed");
    $("#startmed").click(function () {
        var mapData = {
            column: 16,
            row: 16,
            bomb: 40
        };
        $.ajax({
            type: 'get',
            url: '/newmoneymed',
            success: function (money) {
                if (money <= 0) {
                    alert("您的剩餘金額為:0");
                    $("#addMoney").click();

                } else {
                    updateMoney.innerHTML = money;
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'get',
                        url: '/wang/' + mapData.column + '/' + mapData.row + '/' + mapData.bomb + '',
                        success: function (map) {

                            drawTable(map);
                            // console.log(map);
                        }
                    })
                }
            }
        })
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            url: '/wang/' + mapData.column + '/' + mapData.row + '/' + mapData.bomb + '',
            success: function (map) {
                // console.log(map);
                drawTable(map);
            }
        })

    })

});

$("#hard").click(function () {
    clearInterval(timer);
    t = 0;
    document.querySelector('.times').innerHTML = t;
    var table = document.createElement("table");
    for (var i = 0; i < 16; i++) {
        var domTr = document.createElement("tr");
        for (var j = 0; j < 30; j++) {
            var domTd = document.createElement("td");
            domTr.appendChild(domTd);
        }
        table.appendChild(domTr);
    }
    mineNumLeft.innerHTML = 99;
    parent.innerHTML = "";
    parent.appendChild(table);
    var btn = document.createElement("button");
    parent.appendChild(btn);
    btn.innerHTML = "開始";
    btn.setAttribute("id", "starthard");
    $("#starthard").click(function () {

        var mapData = {
            column: 16,
            row: 30,
            bomb: 1
        };
        $.ajax({
            type: 'get',
            url: '/newmoneyhard',
            success: function (money) {
                if (money <= 0) {
                    alert("餘額不足");
                    $("#addMoney").click();

                } else {
                    updateMoney.innerHTML = money;
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'get',
                        url: '/wang/' + mapData.column + '/' + mapData.row + '/' + mapData.bomb + '',
                        success: function (map) {

                            drawTable(map);
                            // console.log(map);
                        }
                    })
                }
            }
        })
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            url: '/wang/' + mapData.column + '/' + mapData.row + '/' + mapData.bomb + '',
            success: function (map) {
                // console.log(map);
                // console.log(map.length);
                // console.log(map[1].length);
                drawTable(map);
            }
        })
    })

});
$("#continue").click(function () {
    // console.log("test");
    $.ajax({
        type: 'get',
        url: '/newmoney',
        success: function (money) {
            updateMoney.innerHTML = money;
        }
    })
})
$("#gameover").click(function () {
    $.ajax({
        type: 'get',
        url: '/getlastmoney',
        success: function (money) {
            moneyLose.innerHTML = money;
        }
    })
    $("#showHistoryLoseClick").click();
})




window.onload = showMoney;
function showMoney() {
    $.ajax({
        type: 'get',
        url: '/showmoney',
        success: function (money) {
            updateMoney.innerHTML = money;
        }
    })
}
