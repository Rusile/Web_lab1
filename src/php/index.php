<?php


class ReqErrors
{
    private $method;
    private $params;

    function __construct($method, $params)
    {
        $this->method = $method;
        $this->params = $params;
    }


    function checkMethod()
    {
        if ($this->method != 'GET') {
            http_response_code(405);
            exit(0);
        }
    }

    function checkAcceptability()
    {
        foreach ($this->params as $value) {
            if (!isset($_GET[$value])) {
                http_response_code(406);
                exit(0);
            }
        }
    }

    function checkDataType()
    {
        foreach ($this->params as  $value) {
            if (!is_numeric($_GET[$value])) {
                http_response_code(415);
                exit(0);
            }

        }
    }


    public function checkErrors()
    {
        $this->checkMethod();
        $this->checkAcceptability();
        $this->checkDataType();
    }
}


class HitPoint {
    private $x;
    private $y;
    private $r;

    private $rValues = array(1, 1.5, 2, 2.5, 3);

    function __construct($x, $y, $r)
    {
        $this->x = $x;
        $this->y = $y;
        $this->r = $r;
    }

    function checkRange() 
    {
        if(($this->x > 2) || ($this->x < -2) || $this->y > 5 || $this->y < -3 || $this->r > 3 || $this->r < 1 || !in_array($this->r, $this->rValues)) {
            http_response_code(415);
            exit(0);
        }
    }

    function checkSquare() {
        return (($this->x <= 0) && ($this->y >= 0) && ($this->x >= -$this->r) && ($this->y <= $this->r / 2));

    }

    function checkTriange() {
        return (($this->x <= 0) && ($this->y <= 0) && ($this->x * 2 + $this->r >= -1 * $this->y));
    }

    function checkCircle() {
        return (($this->x >= 0) && ($this->y <= 0) && ($this->x * $this->x + $this->y * $this->y <= $this->r * $this->r / 4));
    }

    function checkPoint() {
        $this->checkRange();
        return $this->checkCircle() || $this->checkTriange() || $this->checkSquare();
    }



}
date_default_timezone_set('Europe/Moscow');
$start = microtime(true);

$rqErr = new ReqErrors("GET", ["x", "y", "r"]);
$rqErr->checkErrors();

$y = $_GET['y'];
$r = $_GET['r'];
$x = $_GET['x'];

$hitPoint = new HitPoint($x, $y, $r);
$flag = $hitPoint->checkPoint() ? "TRUE" : "FALSE";


$time = date('H:i:s');

$start_time = number_format(microtime(true) - $start, 8, ".", "") * 1000000;

$res = "<tr>" .
    "<td> $time </td>" .
    "<td> $start_time </td>" .
    "<td> $x </td>" .
    "<td> $y </td>" .
    "<td> $r </td>" .
    "<td> $flag </td>" .
    "</tr>";
echo $res;
