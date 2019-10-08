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
            $x=$map[$i][$j]["x"];
            $y=$map[$i][$j]["y"];
            
            // echo ($x." ".$y);
            for($k = $x-1; $k<=$x+1;$k++){
                for($m = $y-1; $m<=$y+1;$m++){
                    if($k<0 || $k>=count($map[$m])|| $m<0 ||$m>=count($map[$k])|| $map[$k][$m]["type"]=="mine"){
                            continue;
                        }
                    if($map[$k][$m]["value"]==0 &&  $map[$k][$m]["checked"]=false){
                        $map->MouseClickTd($k,$m);
                    } else {
                       
                        $map[$k][$m]["checked"]=true;
                    }
                    
            }  
            
        }
        return $map;                           
}
}