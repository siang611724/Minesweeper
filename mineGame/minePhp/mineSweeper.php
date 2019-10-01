<?php

class Mine{
    
    public $c=0;
    public $diffuclty="";
    public $timer;

   function __construct($tr,$td,$mineNum){
   $this->tr=$tr;
        $this->td=$td;
        $this->mineNum=$mineNum;

        $this->time=0;

        $this->squares;


        $this->randNum();
        $this->init();
    //    $this->drawTable();
    //    $this->getArotud();
    //    $this->updateNum();
    //    $this->play();
    //    $this->gameover();
    //    $this->win();
   }
   function randNum(){
     
       $area=array();
       for ($i=0;$i<$this->tr*$this->td;$i++){
           $area[]=$i;
       };
    //   $area->sort(function(){
    //       return 0.5 - rand(0,1);
    //   });
    shuffle($area);
    //    return $area->slice(0,$this->$mineNum);
    $mineRand = array_slice($area,0,$this->mineNum);
    // echo print_r($c);
        return $mineRand;
    //    $a=print_r($c);
    //    echo $a;
   }
   function init(){
        $location =$this->randNum();
        $n=0;
        for($i=0; $i < $this->tr ; $i++){
           $this->squares[i]=[];
           for($j=0;$j < $this->td;$j++){
               if(strrpos($location,++$n)===false){
                $this->squares[$i][$j];
               }
           }
        };


   }
  
}

$Mine=new Mine(9,9,9);

?>