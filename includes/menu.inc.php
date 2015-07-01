<?

function genMenu($depth,$parent=0) {
  ${'sql'.$depth} = new sql;
  ${'sql'.$depth}->query("select id,name,link from menu where childrenOf='$parent' order by id asc");
  while(${'sql'.$depth}->row()) {
    $id = ${'sql'.$depth}->col('id');
    if(get_reply("select count(*) from menu where childrenOf='$id'")>0) {
      $newDepth = $depth+1;
      $subMenu = genMenu($newDepth,$id);
      $link = ($subMenu[1] ? "href='{$subMenu[1]}'" : "");
      $subMenu = $subMenu[0];
      $caret = $depth==0 ? "" : "<b class='rightCarret'></b>";
      $return[] = "<li class='dropdown'><a class='cursor' $link>".${'sql'.$depth}->col('name')."</a>$caret$subMenu</li>";
    } else {
      $return[]="<li><a href='/".${'sql'.$depth}->col('link')."'>".${'sql'.$depth}->col('name')."</a></li>";
      if(!$firstMenu) {
        $firstMenu = "/".${'sql'.$depth}->col('link'); 
      }      
    }
    if($depth==0) {
      $return[] = "<li style='padding-top: 3px;'>|</li>";
    }    
  } 
  if($depth>0) {
    return Array("<ul class='".($depth>1 ? "dropdown-menu right-menu" : "dropdown-menu")."'>".implode("\n",$return)."</ul>",$firstMenu);  
  } else {                                
    unset($return[count($return)-1]);
    return implode("\n",$return);
  } 
}

echo $menu = genMenu(0);    
