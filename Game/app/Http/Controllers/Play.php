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
        $a=empty($map[$j][$i]["open"]);
    
        if ($map[$j][$i]["value"] == 0 && empty($map[$j][$i]["open"])==true) {
            for ($k = $y - 1; $k <= $y + 1; $k++) {
                for ($m = $x - 1; $m <= $x + 1; $m++) {
                    if ($k < 0 || $k >= count($map) || $m < 0 ||
                        $m >= count($map[0]) || $map[$k][$m]["type"] == "mine") {
                        continue;
                    };
                    // $map[$k][$m]["open"]=true;
                        
                       
                    array_push($around, $map[$k][$m]);

                        for($a=0;$a<count($around);$a++){
                            $aroundX=$around[$a]["x"];
                            $aroundY=$around[$a]["y"];
                            if($aroundX < 0 || $aroundX >= count($map) || $aroundY < 0 ||
                            $aroundY >= count($map[0]) || 
                            $map[$aroundX][$aroundY]["type"] == "mine"||
                            empty($map[$aroundX][$aroundY]["open"])==true){
                                $map[$aroundX][$aroundY]["open"]=true;
                                array_push($around, $map[$aroundX][$aroundY]);

                                DB::table('Map')
                                ->where('GameID',1)
                                ->update(['Info'=>serialize($map)]);
                                $this->MouseClickTd($aroundX,$aroundY);
                            }
                        }
                     
                        // DB::table('Map')
                        // ->where('GameID',1)
                        // ->update(['Info'=>serialize($map)]);
                            
                }
            }
            // $this->MouseClickTd($j-1,$i-1);
            // $this->MouseClickTd($j-1,$i);
            // $this->MouseClickTd($j-1,$i+1);
            // $this->MouseClickTd($j,$i-1);
            // $this->MouseClickTd($j,$i-1);   
            // $this->MouseClickTd($j+1,$i-1);
            // $this->MouseClickTd($j+1,$i);
            // $this->MouseClickTd($j+1,$i+1);

            return $map;
        }
        // $map[$j][$i]["checked"]=true;
        return $map[$j][$i];
        
    }
}
