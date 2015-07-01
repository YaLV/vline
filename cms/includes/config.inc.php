<?
define("ROOT",getcwd());
define("INC",getcwd()."/includes/");
define("PAGE",getcwd()."/pages/");
define("TEMPLATE",getcwd()."/templates/");
define("isPOST",(count($_POST)>0 || count($_FILES)>0 ? true : false));
define("isXML",(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] =='XMLHttpRequest' ? true : false));
define("BASE","/cms/");

$config['mysql']['user'] = "kw";
$config['mysql']['password'] = "kwpass";
$config['mysql']['db'] = "kw";
$config['mysql']['host'] = "localhost";

include INC."sql.inc.php";
include INC."templates.inc.php";
/*if(isPOST) {
  ob_start();
  print_r($_POST);
  print_r($_FILES);
  $templates->variables['test'] = ob_get_clean();
}*/
include INC."location.inc.php";
include INC."languages.inc.php";
include INC."auth.inc.php";
include INC."menu.inc.php";
include INC."parser.inc.php";


?>