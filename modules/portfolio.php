<?

$pat = Array("/ā/","/ē/","/ū/","/ī/","/š/","/ģ/","/ķ/","/ļ/","/ž/","/č/","/ņ/","/ /");
$rep = Array("a","e","u","i","s","g","k","l","z","c","n","_");


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

if(!$contentID) {
  $sql = new sql;
  $typewhere = ($subSection!='' ? "and types.link_en='$subSection'" : "");
  $sql->query("select link_en as link,portfolio.id as id,portfolio.name_$lang as name from portfolio,types where portfolio.type=types.id $typewhere order by portfolio.id asc limit 1");
  $sql->row();
  $lastType = $sql->col('link');
  $lastItem = $sql->col('id').'-'.preg_replace($pat,$rep,$sql->col('name'));
  if($lastItem!='-') {
    header("location:/$lang/portfolio/$lastType/$lastItem");
  } else {
    header("location:/$lang/portfolio/");
  }
} else {
  $contentid=explode("-",$contentID);
  $contentID=$contentid[0];
  $hasPrevious = preg_replace($pat,$rep,get_reply("select concat_ws('-',portfolio.id,portfolio.name_$lang) as link from portfolio,types where portfolio.type=types.id and types.link_en='$subSection' and portfolio.id<$contentID order by portfolio.id desc limit 1"));
  $hasNext = preg_replace($pat,$rep,get_reply("select concat_ws('-',portfolio.id,portfolio.name_$lang) as link from portfolio,types where portfolio.type=types.id and types.link_en='$subSection' and portfolio.id>$contentID order by portfolio.id asc limit 1"));
  $sql->query("select name_$lang as name, description_$lang as description from portfolio where id='$contentID'");
  $sql->row();
  $imageID = $imageID ? $imageID : 0;
  $folder = "/uploads/galleries/$contentID";
  $images = getFolderFiles($folder);
  $hasPrevious = $hasPrevious ? "<a href='/$lang/$section/$subSection/$hasPrevious' style='position:absolute;top:200px;left:-15px;display:block;'><img src='/images/prev.png' /></a>" : "";
  $hasNext = $hasNext ? "<a href='/$lang/$section/$subSection/$hasNext' style='position:absolute;top:200px;right:-15px;display:block;'><img src='/images/next.png' /></a>" : "";
  ob_start();
  ?>
    <div style='width:100%;text-align:center;position:relative;min-height:700px;'>
      <?=$hasPrevious;?>
      <img style='max-width:800px;max-height:400px;' src='<?=$folder."/".$images[$imageID];?>'><br />
      <?
      echo $sql->col('description');
      echo "<br />";
      foreach($images as $id => $img) {
        $x=100;
        $y=100;
        $sizes = getimagesize(getcwd().$folder."/".$img) or die('error');
        if($sizes[1]>$sizes[0]) { $x=100; $y=$sizes[1]/$sizes[0]*100; }
        if($sizes[0]>$sizes[1]) { $y=100; $x=$sizes[0]/$sizes[1]*100; }
        echo "<a href='/$lang/$section/$subSection/".implode("-",$contentid)."/$id' style='display:inline-block;width:100px;height:100px;background:url($folder/$img) no-repeat center center; background-size: $x"."px $y"."px;margin-right:5px;'></a>";      
      }
      echo $hasNext;
      ?>  
    </div>  
  <?
  $content = ob_get_clean();
}

?>