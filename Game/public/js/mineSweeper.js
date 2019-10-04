var diffuclty = '';
var timer
var t = 0

function Mine(tr, td, mineNum) {

    this.tr = tr; //行
    this.td = td; //列
    this.mineNum = mineNum; //雷的數量

    this.time = 0;

    this.squares = []; //存所有方塊的位置訊息 
    this.tds = []; // 存所有單元格(dom)
    this.leftMine = mineNum; //剩餘雷的數量
    this.pass = false; //確認所有旗子是否都是雷 判斷遊戲成功與否
    


    this.parent = document.querySelector('.gameBox');
};

Mine.prototype.randNum = function () {
    var area = new Array(this.tr * this.td);
    for (var i = 0; i < area.length; i++) {
        area[i] = i;
    }
    area.sort(function () {
        return 0.5 - Math.random()
    });

    return area.slice(0, this.mineNum);


}
Mine.prototype.init = function () {
    var location = this.randNum();
    var n = 0;
    for (var i = 0; i < this.tr; i++) {
        this.squares[i] = [];
        for (var j = 0; j < this.td; j++) {
            if (location.indexOf(++n) != -1) {
                this.squares[i][j] = {
                    type: "mine",
                    x: j,
                    y: i
                }
            } else {
                this.squares[i][j] = {
                    type: "number",
                    x: j,
                    y: i,
                    value: 0
                }
            }
        }
    }
    this.parent.oncontextmenu = function () {
        return false;
    };
    this.drawTable();
    this.updateNum();
    // this.addTime();

    this.mineNumLeft = document.querySelector(".mineNum");
    this.mineNumLeft.innerHTML = this.leftMine;
    
    // this.addTime = document.querySelector(".times");
    // this.addTime.innerHTML = this.time;
    // console.log(this.squares);
    // console.log(this.tds);

}
var isClick = true;
Mine.prototype.drawTable = function () {
    var This = this;
    var table = document.createElement('table');
    for (var i = 0; i < this.tr; i++) {
        var domTr = document.createElement('tr');
        this.tds[i] = [];
        for (var j = 0; j < this.td; j++) {
            var domTd = document.createElement('td');
            domTd.pos = [i, j];
            this.tds[i][j] = domTd
            domTd.onmousedown = function () {
                
                if(isClick) {
                    isClick = false;
                    //事件
                    This.play(event, this);
                    //定时器
                    setTimeout(function() {
                        isClick = true;
                    }, 250);//一秒内不能重复点击
                }
    

            }

            domTr.appendChild(domTd);
        }
        table.appendChild(domTr);
    }
    this.parent.innerHTML = '';
    this.parent.appendChild(table);
}
Mine.prototype.startTime=function(){
 

};
Mine.prototype.getAround = function (area) {
    var x = area.x;
    var y = area.y;
    var result = [];
    for (var i = x - 1; i <= x + 1; i++) {
        for (var j = y - 1; j <= y + 1; j++) {
            if (
                i < 0 || j < 0 ||
                i > this.td - 1 || j > this.tr - 1 ||
                (i == x && j == y) || this.squares[j][i].type == "mine"
            ) {
                continue;
            }
            result.push([j, i]);
        }
    }
    return result
}

Mine.prototype.updateNum = function () {
    for (var i = 0; i < this.tr; i++) {
        for (var j = 0; j < this.td; j++) {
            if (this.squares[i][j].type == "number") {
                continue;
            }
            var num = this.getAround(this.squares[i][j]);
            for (var k = 0; k < num.length; k++) {
                this.squares[num[k][0]][num[k][1]].value += 1;
            }
        }
    }
}



Mine.prototype.play = function (event, obj) {
    var This = this;
    
    if (event.which == 1) {

        


        var clickedItem = this.squares[obj.pos[0]][obj.pos[1]];
        var changeClass = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight']
        if (clickedItem.type == "number") {
            obj.innerHTML = clickedItem.value;
            obj.className = changeClass[clickedItem.value]
            if(t==0 ){
                timer = setInterval(function () {
                   t+=0.2;
                   document.querySelector('.times').innerHTML = Math.floor(t);
                   console.log(t);
               }, 200);
               
             
           }
            if (clickedItem.value == 0) {
                obj.innerHTML = "";

                function getZero(space) {
                    var around = This.getAround(space);
                    for (var i = 0; i < around.length; i++) {
                        var x = around[i][0];
                        var y = around[i][1];
                        This.tds[x][y].className = changeClass[This.squares[x][y].value];
                        if (This.squares[x][y].value == 0) {
                            if (!This.tds[x][y].check) {
                                This.tds[x][y].check = true;
                                getZero(This.squares[x][y]);
                            }
                        } else {
                            This.tds[x][y].innerHTML = This.squares[x][y].value;
                        }
                    }
                }
                getZero(clickedItem);
            }


            return timer;
        } else {
            this.gameOver(obj);
        }

    }
    if (event.which == 3) {
        if (obj.className && obj.className != 'flag') {
            return;
        }
        obj.className = obj.className == 'flag' ? '' : 'flag';
        if (this.squares[obj.pos[0]][obj.pos[1]].type == 'mine') {
            this.pass = true;
        } else {
            this.pass = false;
        }
        if (obj.className == 'flag') {
            this.mineNumLeft.innerHTML = --this.leftMine;
        } else {
            this.mineNumLeft.innerHTML = ++this.leftMine;
        }

    }
    this.win();
}
Mine.prototype.gameOver = function (clickTd) {
    for (var i = 0; i < this.tr; i++) {
        for (var j = 0; j < this.td; j++) {
            if (this.squares[i][j].type == "mine") {
                this.tds[i][j].className = "mine";
            }
            this.tds[i][j].onmousedown = null;
        }
    }
    if (clickTd) {
        clickTd.style.backgroundColor = "red";
        clearInterval(timer);
    }
}
Mine.prototype.win = function () {

    var totalClicked = 0
    for (var i = 0; i < this.tr; i++) {
        for (var j = 0; j < this.td; j++) {
            if (this.tds[i][j].className != "" &&
                this.tds[i][j].className != "flag" &&
                this.tds[i][j].className != "mine") {
                totalClicked++;
                if (totalClicked == this.tr * this.td - this.mineNum) {
                    this.squares[i][j].innerHTML = this.squares[i][j].value;
                    alert('you win');
                    clearInterval(timer);
                }
            }
        }
    }
    // console.log(totalClicked)

}

$("#easy").click(function () {
    clearInterval(timer);
    t=0;
    
    document.querySelector('.times').innerHTML = "";    
   
    diffuclty = 'easy';
    var mine = new Mine(9, 9, 10)
    mine.init()
    
})
$("#medium").click(function () {
    clearInterval(timer);
    t=0;
    document.querySelector('.times').innerHTML = "";   
    diffuclty = 'medium';
    var mine = new Mine(16, 16, 40)
    mine.init();
})
$("#hard").click(function () {
    clearInterval(timer);
    t=0;
    document.querySelector('.times').innerHTML = "";   
    diffuclty = 'hard';
    var mine = new Mine(16, 30, 99)
    mine.init();
})
$("#restart").click(function () {
    clearInterval(timer);
    t=0;
    document.querySelector('.times').innerHTML = "";   
    switch (diffuclty) {
        case 'easy':
            var mine = new Mine(9, 9, 10)
            mine.init();
            break;
        case 'medium':
            var mine = new Mine(16, 16, 40)
            mine.init();
            break;
        case 'hard':
            var mine = new Mine(16, 30, 99)
            mine.init();
            break;
    }

})