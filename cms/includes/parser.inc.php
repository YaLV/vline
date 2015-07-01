<?

function getFolderFiles($folder) {
  $dir = getcwd().$folder;
  $fileList = Array();
  if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
      while (($file = readdir($dh)) !== false) {
        if($file[0]!='.') { $fileList[] = $file; }
      }
      closedir($dh);
    }
  }  
  return $fileList;
}

if($auth->user) {
  $templates->load("menu","menu");
  switch($location->section) {
    case "loadMenu":
      $templates->display("menu");
      echo $templates->output;
      exit;
    break;
    
    case "loadContent":
      echo "";
      exit;
    break;
    
    case "types":
      $templates->exec("sections");
    break;
    
    case "about":
    case "contacts":
      $templates->exec("editor");
      $templates->load("editor","content");
    break;
    
    case "portfolio":
      $templates->exec("portfolio");
      $templates->load("portfolio","content");
    break;
    
    case "logout":
      session_destroy();
    break;
        
    case "login":
      $location->direct("");
    break;
    
    default:
      $templates->variables['content']='<h2><center>Welcome to V-Line Administration</center></h2>';
    break;
  }
}


if((isXML && isPOST) || count($_FILES)>0) {
  $templates->displayJSON();
} elseif(isXML) {
  if($location->section!='login') {
    $templates->display("content");
    echo $templates->output;
  } else {
    echo $templates->variables['content'];
  }
} else {
  $templates->display("index");
  echo $templates->output;
}

?>