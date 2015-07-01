<?
$sql = new sql;
$sql2 = new sql;

$currentID=get_reply("select id from menu where link='$currentAddress'");
if($currentID!=1) {
  include getcwd()."/modules/sideMenu.php";
  $this->content=str_replace("../","/",get_reply("select data from pageData where id='$currentID'"));
  $images = Array();
  $active = "class='active'";
  $sql->query("select id from pageImages where contentID='$currentID'");
  while($sql->row()) {
    $image=$sql->col('id');
    $images[]="<img src='/HeaderImages/$image.jpg' $active />";
    unset($active);
  } 

  if(count($images)>0) {
    $this->headerImages = "<div class='headerIm'>".implode("\n",$images)."</div>";
  } else {
    $this->headerImages = '';
  }
} else {

  $hover[]="<h2><p>THE AIM MAKES</p></h2><h2><p>GREAT THE LIFE</p></h2>";
  $hover[]="<h2><p>Through Challenge</p></h2><h2><p>to Achievement</p></h2>";
  $hover[]="<h2><p>Through Encouragement</p></h2><h2><p>to Self Belief</p></h2>";
  $hover[]="<h2><p>Through Inspiration</p></h2><h2><p>to strive for their dreams</p></h2>";
  
  $x=0;
  $sql->query("select id from pageImages where contentID='$currentID'");
  while($sql->row()) {
    $image=$sql->col('id');
    $hoverIm = isset($hover[$x]) ? $hover[$x] : "";
    $images[]="<li>$hoverIm<img src='/HeaderImages/$image.jpg' /></li>";
    $x++;
  } 
  
  $this->sliderImages = "<div class='shadow'>
      <div class='scrollingImages shadow'>
        <ul class='scrolling'>
          ".implode("\n",$images)."
        </ul>                 
      </div>
    </div>";    
  
  $newsItem= Array();
  $sql->query("select title,text,n.link as newslink,m.link as menulink from newsList as n, menu as m where m.id!=1630 and n.sectionID=m.id order by n.id desc limit 10");
  while($sql->row()) {
    $text = substr(strip_tags($sql->col('text')),0,100)."..."; 
    $newsItem[]="
      <a href='/{$sql->col('menulink')}/{$sql->col('newslink')}'>
        <div>
        <h4>{$sql->col('title')}</h4>
        $text
        </div>
      </a>
      ";
  }
  
  $newsItems = implode("<hr class='dark'/>",$newsItem);

  $newsItem = Array();
  $sql->query("select title,text,n.link as newslink,m.link as menulink from newsList as n, menu as m where m.id=1630 and n.sectionID=m.id order by n.id desc limit 10");
  while($sql->row()) {
    $text = substr(strip_tags($sql->col('text')),0,100)."..."; 
    $newsItem[]="
      <a href='/{$sql->col('menulink')}/{$sql->col('newslink')}'>
        <div>
        <h4>{$sql->col('title')}</h4>
        $text
        </div>
      </a>
      ";
  }

  $eventItems = implode("<hr class='dark'/>",$newsItem);

  
  /*$ims=Array();
  $sql->query("select id from schoolPictures");
  while($sql->row()) {
    $image=$sql->col('id');
    $ims[]="<div style='margin-bottom: 5px;'><img src='/SchoolPictures/$image.jpg' style='max-width:290px;' /></div>";
    $x++;
  } 
  $ims = implode("\n",$ims);*/
  
  
  
  $pageSection[] = "<div class='dividedContent'><div class='head'><h4>News Headlines</h4></div><div class='dividedContentContent'>$newsItems</div></div>";
  $pageSection[] = "<div class='dividedContent'><div class='head'><h4>Honour Board</h4></div><div class='dividedContentContent'>$eventItems</div></div>";
  //$pageSection[] = "<div class='dividedContent'><div class='head'><h4>School Pictures</h4></div><div class='dividedContentContent' style='text-align:center;'>$ims</div></div>";
  $pageSection[] = "<div class='dividedContent'><div class='head'><h4>A Welcome Message</h4></div><div class='dividedContentContent'>".get_reply("select data from pageData where id='$currentID'")."</div></div>";
  $this->content = implode("\n",$pageSection);
}

?>