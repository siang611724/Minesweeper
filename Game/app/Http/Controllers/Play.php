<?php
namespace App\Http\Controllers;

use DB;

class Play extends Controller
{
    //
    private $tempmap;

    public function MouseClickTd($clickRows, $clickCols)
    {
        // echo '<pre>';
        $map = unserialize(DB::table('Map')->where('GameID', 1)->value('info'));
        $this->tempmap = unserialize(DB::table('Map')->where('GameID', 1)->value('info'));
        // foreach ($map as $Data) {
        //     foreach ($Data as $Temp) {
        //         echo $Temp['value'] . '  ';
        //     }
        //     echo '<br>';
        // }

        $map = $this->testMap($clickRows, $clickCols, $map);
        DB::table('Map')->where('GameID',1)
        ->update(['Info'=>serialize($map)]);
            return $map;
        // foreach ($map as $Data) {
        //     foreach ($Data as $Temp) {
        //         if ($Temp['checked']) {
        //             echo 'V' . '  ';
        //         } else {
        //             echo 'X' . '  ';
        //         }

        //     }
        //     echo '<br>';
        // }
        // print_r($map);
        // exit;
        // $map[$clickCols][$clickRows]["checked"]=true;
        // return $map[$clickCols][$clickRows];

    }

    public function testMap($Rows, $Cols, $map)
    {
        if($map[$Rows][$Cols]["type"] == "mine"){
            return "9";
        }
        $x = $map[$Rows][$Cols]["cols"];
        $y = $map[$Rows][$Cols]["rows"];
        $around = array();
      
        if ($map[$Rows][$Cols]["type"] == "number") {
            if ($map[$Rows][$Cols]["value"] == 0) {
                $map[$Rows][$Cols]["checked"] = true;

                for ($m = $x - 1; $m <= $x + 1; $m++) {
                    for ($k = $y - 1; $k <= $y + 1; $k++) {
                        // echo 'x = ' . $k . ' y = ' . $m . '<br>';

                        if ($k < 0 || $k >= count($map) || $m < 0 ||
                            $m >= count($map[0]) || $map[$k][$m]["type"] == "mine"
                            || ($map[$k][$m] == $map[$Rows][$Cols])) {
                            continue;
                        }
                        // $aroundTemp[$k][$m] = $map[$k][$m];
                        array_push($around, $map[$k][$m]);

                    }

                }
                // print_r($around);
                // echo 'x = ' . $Rows . ' y = ' . $Cols . '<br>';
                // print_r(count($around)."<br>");
                $map = $this->getZero($around, $map);
                // print_r($around);
                // print_r($map);
                // print_r($map[$Rows][$Cols]);
                return $map;
            } else {
                $map[$Rows][$Cols]["checked"] = true;
                return $map;
            }
        }

    }
    public function getZero($space, $map)
    {
        // print_r($space);
        for ($a = 0; $a < count($space); $a++) {
            $aroundX = $space[$a]["rows"];
            $aroundY = $space[$a]["cols"];

            if ($map[$aroundX][$aroundY]["checked"] == false) {
                $map[$aroundX][$aroundY]["checked"] = true;
                // echo 'y = ' . $aroundX . ' x = ' . $aroundY . '<br>';
                // echo 'testMap<br>';
                $map = $this->testMap($aroundX, $aroundY, $map);

                //     // echo "ok" . "<br>";
                // print_r($map[$aroundX][$aroundY]);
            } else {
                continue;
            }
        }
        return $map;
    }
}
