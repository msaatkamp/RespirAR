<?php

// Include config file
require_once "config.php";

class stdObject
{
    public function __construct(array $arguments = array())
    {
        if (!empty($arguments)) {
            foreach ($arguments as $property => $argument) {
                $this->{$property} = $argument;
            }
        }
    }

    public function __call($method, $arguments)
    {
        $arguments = array_merge(array("stdObject" => $this), $arguments); // Note: method argument 0 will always referred to the main class ($this).
        if (isset($this->{$method}) && is_callable($this->{$method})) {
            return call_user_func_array($this->{$method}, $arguments);
        } else {
            throw new Exception("Fatal error: Call to undefined method stdObject::{$method}()");
        }
    }
}


if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

function is_ajax()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}


if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (!empty($_GET['data'])) {

        if ($_GET['data'] == 'graphs') {


            if (!empty($_GET['type']) && trim($_GET['type'] == 'totais')) {
                $data = array('measures' => []);
                $sql = "SELECT m.id as id, avg(m.temperatura) as temperatura, 
                avg(m.umidade) as umidade, 
                m.data as data, s.nome as station, count(*) as qtd 
                FROM measures m JOIN stations s ON m.station_id = s.id 
                group by data ORDER BY data ASC LIMIT 5";

                $result = $link->query($sql);
                foreach ($result as $row) {
                    $obj = new stdObject();
                    $obj->id = $row['id'];
                    $obj->temperatura = $row['temperatura'];
                    $obj->umidade = $row['umidade'];
                    $obj->qtd = $row['qtd'];
                    $obj->station = $row['station'];
                    $obj->data = $row['data'];
                    array_push($data['measures'], $obj);
                }
                header('Content-Type: application/json');
                echo json_encode($data);
                exit;
            }

    } else {
        echo "DATA: " . $_GET['data'];
        echo "Type: " . $_GET['type'];
    }
} else {
    //echo "<br/> Dados de GET COs: " . $_GET['co'];
    $requestURI = explode(' / ', $_SERVER['REQUEST_URI']);
    $scriptName = explode(' / ', $_SERVER['SCRIPT_NAME']);
    $strURI = strstr($_SERVER['REQUEST_URI'], "co/", false);

    echo "<br/>";
    $api = false;
    foreach (explode ("/", $strURI) as $part)
    {
        // Figure out what you want to do with the URL parts.
        echo "URL PART: $part <br/>";
        if($part=="api"){
            $api = true;
        }
        if($api){
            
        }

    }

    for ($i = 0; $i < sizeof($scriptName); $i++) {
            if ($requestURI[$i] == $scriptName[$i]) {
                    unset($requestURI[$i]);
                }
        }
    $command = array_values($requestURI);
    echo "Dados da URL: " . implode("//", $requestURI);

    

    //echo "<br/> Dados do GET?: $_GET['co']";
}
}
?>