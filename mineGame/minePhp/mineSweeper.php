


<?php

class Mine{
    
    
    public $diffuclty="";
    public $timer;
    public $squares;
    public $area;
   function __construct($tr,$td,$mineNum){
        $this->tr=$tr;
        $this->td=$td;
        $this->mineNum=$mineNum;
        
        $this->area=array();
        $this->time=0;
        $this->squares=array();

        $this->init();
        // $this->drawTable();
    //    $this->getAround();
    //    $this->updateNum();
    //    $this->play();
    //    $this->gameover();
    //    $this->win();
   }
   function init(){
   
        for($i=0;$i<$this->tr;$i++){
            for($j=0;$j<$this->td;$j++){    
                $this->area[$i][$j]="type:nuber";
            }
        } 

    $index=0;

    while ($index<$this->mineNum){
        $i=rand(0,$this->mineNum-1);
        $j=rand(0,$this->mineNum-1);
     if($this->area[$i][$j]=="type:nuber"){
        $this->area[$i][$j]=9;
        $index++;
        } 
    }
    for($i=0;$i<$this->tr;$i++){
        for($j=0;$j<$this->td;$j++){    
            if($this->area[$i][$j]==9){
                continue;
            }else{
                $arrondNum=0;
                if($i-1>=0 && $j-1>=0 &&$this->area[$i-1][$j-1]==9)$arrondNum++; //左上
                if($i-1>=0 && $this->area[$i-1][$j]==9)$arrondNum++;    //左
                if($i-1>=0 && $j+1<$this->td && $this->area[$i-1][$j+1]==9)$arrondNum++;//左下
                if($j-1>=0 &&$this->area[$i][$j-1]==9)$arrondNum++;    //上
                if($j+1<$this->td && $this->area[$i][$j+1]==9)$arrondNum++;    //下
                if($i+1<$this->tr && $j-1>=0 &&$this->area[$i+1][$j-1]==9)$arrondNum++;//右上
                if($i+1<$this->tr && $this->area[$i+1][$j]==9)$arrondNum++;    //右   
                if($i+1<$this->tr && $j+1<$this->td &&$this->area[$i+1][$j+1]==9)$arrondNum++;//右下
                $this->area[$i][$j]=$arrondNum;

            }
        }
    } 
    echo("<script>console.log(".json_encode($this->area).");</script>");
    $this->MouseClickTd(1,1);
 
   }
   function MouseClickTd($i,$j){
      
    for($i=0;$i<$this->tr;$i++){
        for($j=0;$j<$this->td;$j++){
               
            if($i<0 || $i>=$this->td || $j<0 ||$j>=$this->tr|| $this->area[$i][$j]==9 || ($this->area[$i]==$i && $this->area[$i][$j]==$j)){
                return;
            }else{
               $this->area=' ';
            }
        }
    }echo("<script>console.log(".json_encode($this->area).");</script>");
   }
//    function drawTable(){

//     echo "<table>";
//     for($i=0;$i<$this->tr;$i++){
//             echo  "<tr>";
//         for($j=0;$j<$this->td;$j++){
//             echo "<td>";
//         }echo "</td>";
//     }echo "</tr>";
//     echo "</table>";

//    }
  
    

}

$Mine=new Mine(9,9,9);

?>
