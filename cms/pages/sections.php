<?
$sql = new sql;
if(isPOST) {
  if(isset($_POST['name_lv']) && isset($_POST['name_en'])) {
    $nl = $_POST['name_lv'];
    $ne = $_POST['name_en'];
    $l = strtolower($ne);
    $sql->query("insert into types values('','$nl','$ne','$l','$l')");
    $line = "<li class='item $l' style='border:1px solid black;'>LV: $nl<a href='/cms/types/?remove=$l' style='line-height: 40px;' class='pull-right btn btn-danger btn-mini'>Dzēst</a><br />EN: $ne</li>";
    echo json_encode(Array(
      'messageType' => 'showSuccessToast',
      'message' => 'Tips pievienots',
      'callback' => "$('ul.items').append(\"$line\");$().enableRemoveType();"   
    ));
    exit;
  }
  
  if(isset($_POST['removeItem'])) {
    $sql->query("delete from types where link_en='{$_GET['remove']}'");
    echo $_GET['remove'];
    exit;
  }

} else {
  

  $this->variables['content']="<form method='post' action='/cms/types/' class='aSync'>
    <input type='text' name='name_lv' placeholder='Nosaukums LV'/>
    <input type='text' name='name_en' placeholder='Nosaukums EN'/>
    <a class='submit btn btn-success'>Add</a>
    </form>
    <script>$(document).ready(function(){ $().enableRemoveType(); });</script>
  ";
  $sql->query("select * from types");
  while($sql->row()) {
    $nameLV=$sql->col('name_lv');
    $nameEN=$sql->col('name_en');
    $link = $sql->col('link_en');
    $line[] = "<li class='item $link' style='border:1px solid black;'>LV: $nameLV<a href='/cms/types/?remove=$link' style='line-height: 40px;' class='pull-right btn btn-danger btn-mini'>Dzēst</a><br />EN: $nameEN</li>";
  }
  
  $this->variables['content'].="<ul style='list-style-type:none;' class='items'>".implode("\n",$line)."</ul>";
}


?>