<?php

namespace App\Http\Controllers;

use App\Mine;
use DB;
use Illuminate\Http\Request;

class Play extends Controller
{
    //
    
    public function MouseClickTd($i,$j){
            // echo $i." & ".$j."<br>";
        $map = unserialize(DB::table('Map')->where('GameID',1)->value('info')) ;
            $x=$map[$j][$i]["x"];
            $y=$map[$j][$i]["y"];
        $arround = array();   
            // echo ($x." ".$y);
            for($k = $y-1; $k<=$y+1;$k++){
                for($m = $x-1; $m<=$x+1;$m++){
                    if($k<0 || $k>=count($map)|| $m<0 ||
                        $m>=count($map[0])|| $map[$k][$m]["type"]=="mine"){
                            continue;
                        };
                    array_push($arround,$map[$k][$m]);
                    

                    // if($map[$k][$m]["value"]==0 &&  $map[$k][$m]["checked"]=false){
                    //     $this->MouseClickTd($k,$m);  
                                          
                    // } else {                       
                    //     $map[$k][$m]["checked"]=true;
                    //     DB::table('Map')
                    //         ->where('GameID',1)
                    //         ->update(['Info'=>serialize($map)]);
                        
                    // };
                    
            }  
            
        }
          return $map ;                          
    }
}