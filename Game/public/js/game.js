// var squares = [];
var tds = [];
var parent = document.querySelector(".gameBox");

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

function getZero(space, obj) {
    for (var i = 0; i < space.length; i++) {
        var changeClass = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight'];
        $.ajax({
            async: true,
            type: 'get',
            url: "/getMap/" + space[i].x + "/" + space[i].y,
            // success: function (zero) {
            // //   for (var j=0; j<tds.length;j++){
            // //       for (var k=0;k<tds[1].length;k++){
            // //           if(zero.checked==true || zero.open==true){
            // //               tds[j][i].innerHTML=zero.value;
            // //           }
            // //       }
            // //   }

                
            // }
        }).then( function (zero){
              for (var j=0; j<tds.length;j++){
                  for (var k=0;k<tds[1].length;k++){
                      if( zero.open==true){
                          tds[j][i].innerHTML=zero.value;
                      }
                  }
              }
            console.log(zero);
        })



    }

}

function play(event, obj) {

    if (event.which == 1) {
        var position = {
            MapX: obj.pos[0],
            MapY: obj.pos[1]
        };
        $.ajax({
            async: true,
            type: "get",
            url: "/getMap/" + position.MapY + "/" + position.MapX,
            // success: function (getAround) {
            //     // var ceil = clickedItem[position.MapY][position.MapX];
            //     var changeClass = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight'];
            //     if (Object.keys(getAround)[0] == "type") {
            //         obj.innerHTML = getAround.value;
            //         obj.className = changeClass[getAround.value];
            //     } else {
            //         getZero(getAround, obj);

            //     }
            //     console.log(Object.keys(getAround)[0]);
            // }
        }).then(function (getAround){
            var changeClass = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight'];
                if (Object.keys(getAround)[0] == "type") {
                    obj.innerHTML = getAround.value;
                    obj.className = changeClass[getAround.value];
                } else {
                    getZero(getAround, obj);

                }
                console.log(Object.keys(getAround)[0]);
        })
    }
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
        bomb: 99
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