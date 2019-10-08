


<?php

class Mine
{

    public $diffuclty = "";
    public $timer;
    public $squares;
    public $area;
    public function __construct($tr, $td, $mineNum)
    {
        $this->tr = $tr;
        $this->td = $td;
        $this->mineNum = $mineNum;

        $this->area = array();
        $this->time = 0;
        $this->squares = array();

        $this->init();
        // $this->drawTable();
        //    $this->getAround();
        //    $this->updateNum();
        //    $this->play();
        //    $this->gameover();
        //    $this->win();
    }
    public function init()
    {

        for ($i = 0; $i < $this->tr; $i++) {
            for ($j = 0; $j < $this->td; $j++) {
                $this->area[$i][$j] = array("type" => "number",
                    "x" => $j, "y" => $i, "checked" => false, "value" => 0);

            }
        }

        $index = 0;

        while ($index < $this->mineNum) {
            $i = rand(0, $this->tr - 1);
            $j = rand(0, $this->td - 1);
            if ($this->area[$i][$j] == array("type" => "number",
                "x" => $j, "y" => $i, "checked" => false, "value" => 0)) {
                $this->area[$i][$j] = array("type" => "mine",
                    "x" => $j, "y" => $i, "checked" => false);
                $index++;
            }
        }

        for ($i = 0; $i < $this->tr; $i++) {
            for ($j = 0; $j < $this->td; $j++) {
                if ($this->area[$i][$j] == array("type" => "mine",
                    "x" => $j, "y" => $i, "checked" => false)) {
                    continue;
                }

                if ($i - 1 >= 0 && $j - 1 >= 0 && $this->area[$i - 1][$j - 1]["type"] == "mine") {
                    $this->area[$i][$j]["value"]++;
                }
                //左上

                if ($i - 1 >= 0 && $this->area[$i - 1][$j]["type"] == "mine") {
                    $this->area[$i][$j]["value"]++;
                }
                //左

                if ($i - 1 >= 0 && $j + 1 < $this->td &&
                    $this->area[$i - 1][$j + 1]["type"] == "mine") {
                    $this->area[$i][$j]["value"]++;
                }
//左下

                if ($j - 1 >= 0 && $this->area[$i][$j - 1]["type"] == "mine") {
                    $this->area[$i][$j]["value"]++;
                }
                //上

                if ($j + 1 < $this->td &&
                    $this->area[$i][$j + 1]["type"] == "mine") {
                    $this->area[$i][$j]["value"]++;
                }
                //下

                if ($i + 1 < $this->tr && $j - 1 >= 0
                    && $this->area[$i + 1][$j - 1]["type"] == "mine") {
                    $this->area[$i][$j]["value"]++;
                }
//右上

                if ($i + 1 < $this->tr
                    && $this->area[$i + 1][$j]["type"] == "mine") {
                    $this->area[$i][$j]["value"]++;
                }
                //右

                if ($i + 1 < $this->tr && $j + 1 < $this->td
                    && $this->area[$i + 1][$j + 1]["type"] == "mine") {
                    $this->area[$i][$j]["value"]++;
                }
//右下

            }
        }
        // $a=serialize($this->area);

        // echo print_r(unserialize($a));
        //    echo ($this->area[1][1]["type"]);
        echo ("<script>console.log(" . json_encode($this->area) . ");</script>");
        // $this->area[1][1]["checked"]=false;
        // echo print_r($this->area[1][1]);

        $this->MouseClickTd(8, 8);
    }
    public function MouseClickTd($i, $j)
    {
        // echo $i." & ".$j."<br>";
        $x = $this->area[$i][$j]["y"];
        $y = $this->area[$i][$j]["x"];


        // echo ($this->td);
        // echo ($x." ".$y);

        for ($k = $x - 1; $k <= $x + 1; $k++) {
            for ($m = $y - 1; $m <= $y + 1; $m++) {
                if ($k < 0 || $k >= $this->td || $m < 0 ||
                    $m >= $this->tr || $this->area[$k][$m]["type"] == "mine") {
                    continue;
                }
                if ($this->area[$k][$m]["value"] == 0 && $this->area[$k][$m]["checked"] = false) {
                    $this->MouseClickTd($k, $m);
                } else {
                    
                    $this->area[$k][$m]["checked"] = true;
                }

            }

        }

        echo ("<script>console.log(" . json_encode($this->area) . ");</script>");

    }}

$Mine = new Mine(9, 9, 9);

?>
<!--
Notice: Uninitialized string offset: 0
//將php.ini中error_reporting = E_ALL 改為error_reporting = E_ALL & ~E_NOTICE即可 -->
