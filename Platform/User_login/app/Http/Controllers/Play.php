<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Auth;
class Play extends Controller
{
    //
    public $id;
    public function MouseClickTd($clickRows, $clickCols)
    {
        // echo '<pre>';
        $userID = Auth::id();
        $map = unserialize(DB::table('Map')->where('MemberID', $userID)
                ->orderBy('GameID', 'desc')->take(1)->value('info'));
        $this->id = DB::table('Map')->where('MemberID', $userID)
            ->orderBy('GameID', 'desc')->take(1)->value('GameID');
        // $this->tempmap = unserialize(DB::table('Map')->where('MemberID', "jack")->max('GameID')->value('info'));
        // foreach ($map as $Data) {
        //     foreach ($Data as $Temp) {
        //         echo $Temp['value'] . '  ';
        //     }
        //     echo '<br>';
        // }
        $map = $this->testMap($clickRows, $clickCols, $map);
        DB::table('Map')->where('MemberID', $userID)->orderBy('GameID', 'desc')->take(1)
            ->update(['Info' => serialize($map)]);
        if ($map[$clickRows][$clickCols]["type"] == "mine") {
            DB::table('history')->insert([
                'GameID' => $this->id,
                'MemberID' => $userID,
                'MapX' => $clickCols,
                'MapY' => $clickRows,
                'result' => 'lose',
            ]);
        } else {
            DB::table('history')->insert([
                'GameID' => $this->id,
                'MemberID' => $userID,
                'MapX' => $clickCols,
                'MapY' => $clickRows,
            ]);
        }
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
        // return $map[$clickCols][$clickRows];
    }
    public function flag($Rows, $Cols)
    {
        $userID = Auth::id();
        $map = unserialize(DB::table('Map')->where('MemberID', $userID)
                ->orderBy('GameID', 'desc')->take(1)->value('info'));
        if ($map[$Rows][$Cols]["flag"] == false) {
            $map[$Rows][$Cols]["flag"] = true;
        } else if ($map[$Rows][$Cols]["flag"] == true) {
            $map[$Rows][$Cols]["flag"] = false;
        }
        DB::table('Map')->where('MemberID', $userID)->orderBy('GameID', 'desc')->take(1)
            ->update(['Info' => serialize($map)]);
        return $map;
    }
    public function testMap($Rows, $Cols, $map)
    {
        if ($map[$Rows][$Cols]["type"] == "mine") {
            $map[$Rows][$Cols]["checked"] = true;
            return $map;
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
                $flagNum = 0;
                if ($map[$Rows][$Cols]["checked"] == true) {
                    for ($i = $x - 1; $i <= $x + 1; $i++) {
                        for ($j = $y - 1; $j <= $y + 1; $j++) {
                            if ($i < 0 || $i >= count($map) || $j < 0 ||
                                $j >= count($map[0]) || ($map[$j][$i] == $map[$Rows][$Cols])) {
                                continue;
                            }
                            if ($map[$j][$i]['flag'] == true) {
                                $flagNum += 1;
                                // echo $flagNum ."okokokok";
                            }
                           
                        }
                    }
                    if ($map[$Rows][$Cols]['value'] == $flagNum) {
                        for ($ii = $x - 1; $ii <= $x + 1; $ii++) {
                            for ($jj = $y - 1; $jj <= $y + 1; $jj++) {
                                if ($ii < 0 || $ii >= count($map) || $jj < 0 ||
                                    $jj >= count($map[0]) || ($map[$jj][$ii] == $map[$Rows][$Cols])) {
                                    continue;
                                }
                                if ($map[$jj][$ii]['flag'] == false) {
                                    $map[$jj][$ii]['checked'] = true;
                                    if($map[$jj][$ii]['value'] == 0){
                                        $map = $this->testMap($map[$jj][$ii]['rows'],$map[$jj][$ii]['cols'],$map);
                                    }
                                    
                                }
                            }
                        }
                    }
                    return $map;
                } else {
                    $map[$Rows][$Cols]["checked"] = true;
                    return $map;
                }
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