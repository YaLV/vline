<?
/*
function genMenu($depth,$parent=0) {
  ${'sql'.$depth} = new sql;
  ${'sql'.$depth}->query("select id,name,link from menu where childrenOf='$parent' order by id asc");
  while(${'sql'.$depth}->row()) {
    $id = ${'sql'.$depth}->col('id');
    if(get_reply("select count(*) from menu where childrenOf='$id'")>0) {
      $newDepth = $depth+1;
      $subMenu = genMenu($newDepth,$id);
      $return[] = "<li class='dropdown'><a class='cursor'>".${'sql'.$depth}->col('name')."</a>$subMenu</li>";
    } else {
      $return[]="<li><a href='/cms/".${'sql'.$depth}->col('link')."'>".${'sql'.$depth}->col('name')."</a></li>";      
    }    
  } 
  if($depth>0) {
    if($depth==1) {
      $lnk = explode("/",${'sql'.$depth}->col('link'));
      $return[] = "<li><hr /></li><li><a href='/cms/".$lnk[0]."/uploadMenuItem'>Menu Image Upload</a></li>";
    }
    return "<ul class='".($depth>1 ? "dropdown-menu right-menu" : "dropdown-menu")."'>".implode("\n",$return)."</ul>";
  } else {
    return implode("\n",$return);
  } 
}
*/

function genMenuStatic() {
  $returnData = "<li><a href='/cms/about'>About</a></li>"; 
  $returnData.= "<li><a href='/cms/portfolio'>Portfolio</a></li>"; 
  $returnData.= "<li><a href='/cms/contacts'>Contacts</a></li>";
  $returnData.= "<li><a href='/cms/types'>Tipi</a></li>";
  return $returnData; 
}

$templates->variables['menuItems'] = genMenuStatic();    

