<?
$addre=$_GET['address'];
$currentAddress = preg_replace("/[^a-zA-Z0-9-_\/]/","",$addre);
include getcwd()."/includes/sql.inc.php";
@list($lang,$section,$subSection,$contentID,$imageID) = explode("/",$currentAddress);

if(!in_array($lang,array('lv','en') || !in_array($section,Array('contacts','portfolio','about','showImage')))) {
  
}


if($section=='portfolio') {
  $sql = new sql;
  $subMenuItems = Array();
  $sql->query("select link_en,name_$lang from types");
  while($sql->row()) {
    $name=$sql->col('name_'.$lang);
    $link=$sql->col('link_en');
    $s = ($link==$subSection ? "<div><img src='/images/selectedSubMenu.png'/></div>" : "");
    $subMenuItems[] = "<a href='/$lang/portfolio/$link'>$name $s</a>";
  }
  
  $subMenuItems = implode("",$subMenuItems);
  $subMenu = "<div class='subMenu'>
        <div class='menuItems'>
          $subMenuItems
        </div>
      </div>";
} else {
  $submenu='';
}

if(!$section) {
  header("location:/$defaultLanguage/$defaultSection");
  exit();
}

$activeLanguageLV=($lang=='lv' ? ' active' : "");
$activeLanguageEN=($lang=='en' ? ' active' : "");
$activeContacts=($section=='contacts' ? "class='active'" : "");
$activePortfolio=($section=='portfolio' ? "class='active'" : "");
$activeAbout=($section=='about' ? "class='active'" : "");


switch($section) {
  case "contacts":
  case "about":
    include getcwd()."/modules/editor.php";
  break;
  
  case "showImage":
    list($lang,$undef,$size,$croppable,$type,$id,$image) = explode("/",$currentAddress);
    echo "Showing image $size, gonna: $croppable, from gallery type: $type, and gallery: $id, imageID: $image";
    exit;
  break; 
  
  case "portfolio":
    include getcwd()."/modules/portfolio.php";
  break;  
    
  default:
    ob_start();
      readfile(getcwd()."/templates/404");
    $content = ob_get_clean();
  break;
}
?>