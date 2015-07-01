<?
if(isset($_GET['i'])) {
  phpinfo();
  exit();
}

session_start();
include getcwd()."/includes/config.inc.php";

?>
   