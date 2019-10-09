<?php
namespace App\Http\Controllers;
use App\Mine;
use DB;
use Illuminate\Http\Request;
class Play extends Controller
{
    //
    
    public function MouseClickTd($i,$j){
            
        $map = unserialize(DB::table('Map')->where('GameID',1)->value('info')) ;
            $x=$map[$i][$j]["x"];
            $y=$map[$i][$j]["y"];
        $arround = array();   
            
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
          return $arround ;                          
    }
}