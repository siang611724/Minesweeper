// var squares = [];
//row 橫的
//col 直的
var tds = [];
var parent = document.querySelector(".gameBox");
var mineNumLeft = document.querySelector(".mineNum");
var mineNum=0;
var initMap = new Array();
var leftMine =0;
function drawTable(map) {
    parent.oncontextmenu = function () {
        return false;
    };
    var table = document.createElement("table");
    leftMine =0;
    mineNum=0;
    for (var i = 0; i < map.length; i++) {
        var domTr = document.createElement("tr");
        tds[i] = [];
        for (var j = 0; j < map[1].length; j++) {
            var domTd = document.createElement("td");
            domTd.pos = [i, j];
            tds[i][j] = domTd;
           if(map[i][j]["type"]=="mine"){
               leftMine ++;
               mineNum++;
           }
            domTd.onmousedown = function () {
                play(event, this);
            }
            domTr.appendChild(domTd);
        }
        table.appendChild(domTr);
    }
    parent.innerHTML = "";
    parent.appendChild(table);
    mineNumLeft.innerHTML=leftMine;
   
}

<<<<<<< HEAD

=======
function gameover(tds) {
    tds.className="mine";
    tds.style.backgroundColor="red";
    
}
function win(clickedItem){
    
    var totalClicked = 0;
    for (var i = 0; i < tds.length; i++) {
        for (var j = 0; j < tds[0].length; j++) {
            if (tds[i][j].className != "" &&
            tds[i][j].className != "flag" &&
            tds[i][j].className != "mine"){
                totalClicked++;
                if(totalClicked==tds.length*tds[0].length-mineNum){
                    $.ajax({
                        type:'get',
                        url:'/wang',
                        success:function (e){
                            console.log(e);
                        }         
                    })
                    alert("win");
                }
            }
        }
    }
}
>>>>>>> project/jimmy

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
<<<<<<< HEAD
                // var ceil = clickedItem[position.MapRows][position.MapCols];
                var changeClass = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight'];
                //    for (var i=0;i<tds.length;i++){
                //        for (var j=0;j<tds[0].length;j++){
                //            if(clickedItem[i][j].checked==true){
                //                obj.innerHTML=clickedItem[i][j].value;
                //            }
                //            if(clickedItem[i][j].checked==true && clickedItem[i][j].type == 'mine'){
                //                alert ('gameOver');
                //            }
                //        }
                //    }
                var newMap = new Array();
                $.each(clickedItem, function (index, content) {
                    $.each(content, function (index2, content2) {
                        newMap.push(content2);                      
                    });

                });
                console.log(newMap);
                console.log(newMap.length);
                // for (var i=0;i<newMap.length;i++){
                //     if(newMap[i].checked==true){
                //         obj.innerHTML=newMap[i].value;
                //     }
                // }

                // if(content2.checked==true){
                //     obj.innerHTML=content2.value;
                //     console.log(content2.checked);
                //     console.log(content2.value);
                // }           

                // console.log(clickedItem.length);
                console.log(typeof (clickedItem));
                // console.log(tds.length); //16
                // console.log(tds[0].length); //30
                console.log(clickedItem);
                console.log(tds);

            }
        })
=======

                var newMap = new Array();
                $.each(clickedItem, function (index, content) {
                    $.each(content, function (index2, content2) {
                        newMap.push(content2);
                    });

                });
                initMap = clickedItem;
                // console.log(obj);
                open(newMap,clickedItem);
            }
        }
        )
>>>>>>> project/jimmy
    }
    if(event.which==3){
        obj.className = obj.className == 'flag' ? '' : 'flag';
        if (obj.className == 'flag') {
            mineNumLeft.innerHTML = --leftMine;
        } else {
            mineNumLeft.innerHTML = ++leftMine;
        }
    }
   
}

function open(newMap,clickedItem) {
    var k = -1;
    var changeClass = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight'];
    for (var i = 0; i < tds.length; i++) {
        for (var j = 0; j < tds[0].length; j++) {
            if (k < tds.length * tds[0].length && newMap[++k].checked == true) {
                
                tds[i][j].innerHTML = newMap[k].value;
                tds[i][j].className = changeClass[newMap[k].value]
                if (newMap[k].value == 0) {
                    tds[i][j].innerHTML = ""
                }
                if(tds[i][j].innerHTML==9){
              
                    gameover(tds[i][j]);
                }
            } else {
                continue;
            }
        }
    } 
    win(clickedItem);
    // console.log(initMap);

    console.log(newMap);
    // console.log(newMap.length);

}
$("#easy").click(function () {
    var mapData = {
        column: 9,
        row: 9,
        bomb: 10
    };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'get',
        url: '/wang/' + mapData.column + '/' + mapData.row + '/' + mapData.bomb + '',
        success: function (map) {

            drawTable(map);
            console.log(map);
        }
    })
});

$("#medium").click(function () {
    var mapData = {
        column: 16,
        row: 16,
        bomb: 40
    };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'get',
        url: '/wang/' + mapData.column + '/' + mapData.row + '/' + mapData.bomb + '',
        success: function (map) {
            console.log(map);
            drawTable(map);
        }
    })
});

$("#hard").click(function () {
    var mapData = {
        column: 16,
        row: 30,
        bomb: 1
    };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'get',
        url: '/wang/' + mapData.column + '/' + mapData.row + '/' + mapData.bomb + '',
        success: function (map) {
            console.log(map);
            // console.log(map.length);
            // console.log(map[1].length);
            drawTable(map);
        }
    })
});
