<?php
namespace App\Http\Controllers;

use DB;

class Play extends Controller
{
    //

    public function MouseClickTd($clickX, $clickY)
    {

        $map = unserialize(DB::table('Map')->where('GameID', 1)->value('info'));
        $x = $map[$clickY][$clickX]["x"];
        $y = $map[$clickY][$clickX]["y"];
        $around = array();
        $a=empty($map[$clickY][$clickX]["open"]);
    
        function getAround(){
            if ($map[$clickY][$clickX]["value"] == 0 && empty($map[$clickY][$clickX]["open"])==true) {
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
            // $this->MouseClickTd($clickY-1,$clickX-1);
            // $this->MouseClickTd($clickY-1,$clickX);
            // $this->MouseClickTd($clickY-1,$clickX+1);
            // $this->MouseClickTd($clickY,$clickX-1);
            // $this->MouseClickTd($clickY,$clickX-1);   
            // $this->MouseClickTd($clickY+1,$clickX-1);
            // $this->MouseClickTd($clickY+1,$clickX);
            // $this->MouseClickTd($clickY+1,$clickX+1);

            return $map;
        }
        // $map[$clickY][$clickX]["checked"]=true;
        return $map[$clickY][$clickX];
        
    }
        }
        
}
