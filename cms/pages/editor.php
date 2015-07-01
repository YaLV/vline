<?
$contentID = $location->section;

function rcd($data) {
    $p = strpos($data, ',');
    $d = substr($data, $p+1);
    return $d;
}

if(isPOST) {
  $sql = new sql;
  if($_POST['saveContent']==1) {
    $content_lv = addslashes($_POST['pageContent_lv']);
    $content_en = addslashes($_POST['pageContent_en']);
    $sql->query("replace into pageData values('$contentID', '$content_lv', '$content_en')");
    $this->variables['message'] = "Page Content Saved";
    $this->variables['messageType'] = "showSuccessToast";
    $this->variables['callback'] = "$('#content').animate({opacity:1});";
    $this->variables['result'] = "success";
  } else {
    $this->variables['message'] = "No Job specified";
    $this->variables['messageType'] = "showErrorToast";
    $this->variables['callback'] = "$('#content').animate({opacity:1});";
    $this->variables['result'] = "fail";
  } 
} else {
  $this->variables['action'] = "/cms/".$location->addr;
  $this->variables['section'] = ucfirst($location->section);
  $this->variables['pageTitle'] = ucfirst($location->section);
  $this->variables['pageContent_lv'] = get_reply("select content_lv from pageData where link='$contentID'");
  $this->variables['pageContent_en'] = get_reply("select content_en from pageData where link='$contentID'");
}
?>