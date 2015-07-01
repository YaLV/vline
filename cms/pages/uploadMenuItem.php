<?

function rcd($data) {
    $p = strpos($data, ',');
    $d = substr($data, $p+1);
    return $d;
}

if(isPOST) {
  if($_POST['source']) {
    $sql = new sql;
    $contentID = get_reply("select id from menu where link='{$location->section}'");
    $id = get_reply("select id from pageImages where contentID='$contentID'");
    $sql->query("delete from pageImages where id='$id'");
    $lastID=get_reply("insert into pageImages values(NULL,'".rcd($_POST['source'])."','1','$contentID');select last_insert_id() from pageImages");
    $this->variables["callback"]="$('#oldImage').attr('src','/menuImage/$lastID.jpg');clearForm();";
    $this->variables["messageType"]="showSuccessToast";
    $this->variables["message"]="Menu Image replaced!";
  } else {
    $this->variables["messageType"]="showErrorToast";
    $this->variables["message"]="No Image Specified";
  }
  unset($this->variables['menuItems']);
  unset($this->variables['menu']);
  unset($this->variables['content']);
} else {
  $section = get_reply("select id from menu where link='".$location->section."'");
  
  $image = get_reply("select id from pageImages where contentID='$section'");
  
  if($image) {
    $this->variables['oldImage']="/HeaderImages/$image.jpg";
  } else {
    $this->variables['oldImage']="/images/no_image.jpg";
  }
  $this->variables['action']="/cms/".$location->addr;
}
?>