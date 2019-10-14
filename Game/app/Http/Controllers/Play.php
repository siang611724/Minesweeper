<?php
namespace App\Http\Controllers;

use DB;

class Play extends Controller
{
    //

    public function MouseClickTd($i, $j)
    {

        $map = unserialize(DB::table('Map')->where('GameID', 1)->value('info'));
        $x = $map[$j][$i]["x"];
        $y = $map[$j][$i]["y"];
        $around = array();

        if ($map[$j][$i]["value"] == 0 && $map[$j][$i]["checked"]==false) {
            for ($k = $y - 1; $k <= $y + 1; $k++) {
                for ($m = $x - 1; $m <= $x + 1; $m++) {
                    if ($k < 0 || $k >= count($map) || $m < 0 ||
                        $m >= count($map[0]) || $map[$k][$m]["type"] == "mine") {
                        continue;
                    };
                    
                        $map[$k][$m]["open"]=true;
                    
                   
                    
                    // for($n = 0;$n < count($around); $n++){
                    //     $this->MouseClickTd($around[$n]['x'],$around[$n]['y']);
                    // }
                    array_push($around, $map[$k][$m]);
                    // if($map[$k][$m]["value"]==0 &&  $map[$k][$m]["checked"]=false){
                    //     $this->MouseClickTd($k,$m);

                    // } else {
                    //     $map[$k][$m]["checked"]=true;
                        DB::table('Map')
                            ->where('GameID',1)
                            ->update(['Info'=>serialize($map)]);

                    // };

                }
            }
            return $around;
        }
        // $map[$j][$i]["checked"]=true;
        return $map[$j][$i];
        
    }
}
