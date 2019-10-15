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
            domTd.pos = [j, i];
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
            MapX: obj.pos[0],
            MapY: obj.pos[1]
        };
        $.ajax({
            type: "get",
            url: "/getMap/" + position.MapX + "/" + position.MapY,
            success: function (clickedItem) {
                // var ceil = clickedItem[position.MapY][position.MapX];
                // var changeClass = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight'];
                // if (ceil.type == "number" && ceil.checked ==true) {
                //     obj.innerHTML =ceil.value;
                //     obj.className = changeClass[ceil.value];
                // }
                console.log(clickedItem);
            }
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