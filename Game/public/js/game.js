// var squares = [];
//row 橫的
//col 直的
var tds = [];
var parent = document.querySelector(".gameBox");

var initMap = new Array();

function drawTable(map) {
    var table = document.createElement("table");
    for (var i = 0; i < map.length; i++) {
        var domTr = document.createElement("tr");
        tds[i] = [];
        for (var j = 0; j < map[1].length; j++) {
            var domTd = document.createElement("td");
            domTd.pos = [i, j];
            tds[i][j] = domTd;
            domTd.onmousedown = function () {
                play(event, this);
            }
            domTr.appendChild(domTd);
        }
        table.appendChild(domTr);
    }
    parent.innerHTML = "";
    parent.appendChild(table);
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

                var changeClass = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight'];
        
                var newMap = new Array();
                $.each(clickedItem, function (index, content) {
                    $.each(content, function (index2, content2) {
                        newMap.push(content2);
                    });

                });
                initMap=clickedItem;
                open(newMap);
            }
        })
    }
}

function open(newMap) {
    var k=-1;
    var changeClass = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight'];
        for (var i = 0; i < tds.length; i++) {
            for (var j = 0; j < tds[0].length; j++) {
              if(k < tds.length*tds[0].length && newMap[++k].checked==true){
                tds[i][j].innerHTML=newMap[k].value;
                tds[i][j].className=changeClass[newMap[k].value]
                  if(newMap[k].value==0){
                    tds[i][j].innerHTML=""
                  }
                    

                 
              }else{
                  continue;
              }
            }
        }
        console.log(initMap);

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
            console.log(map.length);
            console.log(map[1].length);
            drawTable(map);
        }
    })
});
