<?

$mainID=get_reply("select id from menu where link='$section'");

if(get_reply("select count(*) from menu where childrenOf='$mainID'")>0) {
  $id=get_reply("select id from menu where link='$section'");
  if($id) {
    $imageID = get_reply("select id from pageImages where contentID='$id'");
    if($imageID) {
      $menuItem[] = "<li style='margin-bottom: 10px;text-align:center;'><img src='/menuImage/$imageID.jpg' style='max-width:200px;' /></li>";
    }
  } else {
    $menuImage = "";
  }

  $sql->query("select name,link,id from menu where childrenOf='$mainID'");
  while($sql->row()) {
    if(get_reply("select count(*) from menu where childrenOf='{$sql->col('id')}'")>0) {
      $sql2->query("select name,link from menu where childrenOf='{$sql->col('id')}'");
      $menuItem[] = "<li><hr style='width:100%;'/></li>";
      $menuItem[] = "<li><h5>{$sql->col('name')}<h5></li>";
      $menuItem[] = "<li><hr style='width:100%;'/></li>";
      while($sql2->row()) {
        $menuItem[] = "<li><div class='bullet'></div><a href='/{$sql2->col('link')}' title='{$sql2->col('name')}'>{$sql2->col('name')}</a></li>";      
      }
      $lastWasSub=true;
    } else {
      if($lastWasSub==true) {
        $menuItem[] = "<li><hr style='width:100%;margin-top:5px;margin-bottom:5px;'/></li>";
        $lastWasSub=false;
      }
      $menuItem[] = "<li><div class='bullet'></div><a href='/{$sql->col('link')}' title='{$sql->col('name')}'>{$sql->col('name')}</a></li>"; 
    }
  }
  $this->menuItems = "<ul class='sideMenu'>".implode("\n",$menuItem)."</ul>";
} else {
  $this->menuItems = "";
}
?>