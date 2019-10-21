<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/mineSweeper.css">

    
    <title>Welcome</title>
</head>
<body>
    <div id="mine">

        <div class="level">
        
            <button  name="easy" id="easy">初級 </button> 
            <button  name="medium" id="medium">中級</button> 
            <button  name="hard" id="hard">高級</button>   
           
                
        
        </div>
        <div class="info">
            剩餘地雷數:<span class="mineNum"></span>
            經過時間:<span class="times" id="times"></span>
        </div>
        <div class="gameBox" id="top1">

        </div>

    </div>
    <script src="js/game.js"></script>
    
</body>
</html><?php /**PATH C:\xampp\htdocs\minphp\Minesweeper\Minesweeper\Game\resources\views/index.blade.php ENDPATH**/ ?>