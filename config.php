<?php 

// Initialize the session
session_start();

/*define('DB_SERVER', 'fdb13.awardspace.net');
define('DB_USERNAME', '1772949_respirar');
define('DB_PASSWORD', 'saatkamp2');
define('DB_NAME', '1772949_respirar');*/

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'respirar');

/* Attempt to Connect to MySQL Database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($link === false) {
    die("Erro: Conexão não realizada" . mysqli_connect_error());
}

$cur_date = date('Y-m-d');
$cur_month = date('m', strtotime($cur_date));
$cur_year = date('Y', strtotime($cur_date));
$admin_users = array("msaatkamp", "administrador");
$PAGE_TITLE = "respirAR - $cur_year";
$page = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], '/'));
switch ($page) {
    case "/Index.php":
    case "/index.php":
    case "/Index":
        $CURRENT_PAGE = "Indice";
        $PAGE_TITLE = "respirAR - 2019";
        break;
    case "/register.php":
    case "/register":
        $CURRENT_PAGE = "Cadastro de Usuário";
        $PAGE_TITLE = "respirAR - Registro";
        break;
    case "/login.php":
    case "/login":
        $CURRENT_PAGE = "Página de Login";
        $PAGE_TITLE = "respirAR - Login";
        break;
    default:
        $CURRENT_PAGE = "respirAR";
        $PAGE_TITLE = "respirAR - 2019";
};

function activeMatchUrl($requestUri, $classCheck = false)
{
    //Returns active when page == request
    // Example activeMatchUrl("/index")
    $page = $GLOBALS['page'];

    // if(!$classCheck)
    //echo "Pagina? $page <br/>";
    $page = strtolower(substr($page, 1, strpos($page, ".php")-1));
    $requestUri = strtolower($requestUri);

    if(!$classCheck){
        //echo "Página: $page <br/>";
        //echo "Request: $requestUri";
    }
    if ($page == $requestUri) {
        // //echo ' active';
        return true;
    } else{
        return false;
    }
};

function isAdmin($user = ""){
    if(isset($_SESSION["username"])&&empty($user))
        $user = $_SESSION["username"];
    if(in_array($user, $GLOBALS['admin_users'])){
        return true;
    }else{
        return false;
    }
}

function url(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

function toFixed($number, $decimals) {
    return number_format($number, $decimals, ".", "");
  }

/*//echo "
<script>
    console.log('Pagina: $page');
    console.log('Administrador?: ",isAdmin() ? 'SIM' : 'NÃO',"');
</script>";
*/
?>