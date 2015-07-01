<?
// $location->page; - ID

function rcd($data) {
  $p = strpos($data, ',');
  $d = substr($data, $p+1);
  return $d;
}

if(isPOST) {
  $actions = explode(";",$location->page);
  foreach($actions as $actionCurrent) {
    list($action,$id) = explode(":",$actionCurrent);
    $$action = $id;    
  }
  
  if(isset($removeImage)) {
    unlink(getcwd()."/uploads/galleries/$edit/$removeImage");
    echo "Removing $removeImage @ $edit";
    exit;
  }  
  
  /* 
  ob_start();
  print_r($_POST);
  echo "\n";
  print_r($_FILES);
  echo "\n";
  print_r($_GET);
  echo "\n";
  print_r($_SERVER);
  echo "---------------\n";
  
  $dev=ob_get_clean();
  
  $f=fopen(getcwd()."/test.txt","a+");
  fwrite($f,$dev);
  fclose($f);
  */
  
  if(isset($_FILES['galleryFile']) && file_exists($_FILES['galleryFile']['tmp_name'])) {
    if(!is_dir(getcwd()."/uploads/galleries/$id")) {
      mkdir(getcwd()."/uploads/galleries/$id");
      chmod(getcwd()."/uploads/galleries/$id", 0777);
    }
    $fileName = explode("/",$_FILES['galleryFile']['tmp_name']);
    $folder = "/uploads/galleries/$id/";
    $imageCount=count(getFolderFiles($folder));
    if(move_uploaded_file($_FILES['galleryFile']['tmp_name'],getcwd()."/uploads/galleries/$id/$imageCount-".$fileName[count($fileName)-1])) {
      $fc = base64_decode(rcd(file_get_contents(getcwd()."/uploads/galleries/$id/$imageCount-".$fileName[count($fileName)-1])));
      $fh = fopen(getcwd()."/uploads/galleries/$id/$imageCount-".$fileName[count($fileName)-1],"w");
      fwrite($fh,$fc);
      fclose($fh);
      echo '{"state":"success"}';
    } else {
      echo json_encode(error_get_last());
      exit;
    }
    exit;
  }
  
  if(isset($_POST['saveContent'])) {
    if($_POST['edit']!='') {
      $sql = new sql;
      $edit=$_POST['edit'];
      $query = "update portfolio set name_lv='{$_POST['name_lv']}', name_en='{$_POST['name_en']}', description_lv='{$_POST['pageContent_lv']}', description_en='{$_POST['pageContent_en']}', type='{$_POST['type']}' where id='$edit'";
      $sql->query($query);
    } else {
      $query = "insert into portfolio values('','{$_POST['name_lv']}','{$_POST['name_en']}','{$_POST['pageContent_lv']}','{$_POST['pageContent_en']}','{$_POST['type']}');select last_insert_id();";
      $edit = get_reply($query);
    }
    echo json_encode(Array('message' => "Save Success",'messageType' => "showSuccessToast", 'id' => $edit, 'callback' => '$().loadContent("/cms/portfolio",function(data){ });'));
    exit;
  }
  
  if(isset($remove)) {
    $sql = new sql;
    $sql->query("delete from portfolio where id='$remove'");
    $folder = "/uploads/galleries/$remove/";
    $images = getFolderFiles($folder);
    foreach($images as $image) {
      unlink(getcwd().$folder.$image);
    }
    unlink(getcwd().$folder);
    echo json_encode(array(
      'messageType' => 'showSuccessToast',
      'message' => 'Gallery Deleted',
      'result' => 'success'
      ));
    exit;
    //removeImages($remove);
  }
  
} else {
  $this->variables['action'] = "/cms/".$location->section;
  $this->variables['fullAction'] = "/cms/".$location->addr;
  $this->variables['section'] = ucfirst($location->section);
  $sql = new sql;
  if(!$location->page) { // list
    $listItems=Array();
    $sql->query("select id,name_lv,description_lv from portfolio order by id desc");
    while($sql->row()) {
      $this->variables['id']=$sql->col('id');
      $this->variables['name']=$sql->col('name_lv');
      $this->variables['description']=$sql->col('description_lv');
      $this->load('contentListItem','content');
      $listItems[] = $this->variables['content'];
    }  
    $this->variables['listContent']=implode("\n",$listItems);
    $this->load('contentList', 'currentContent');
  } else { // editing/adding
    list($action,$id) = explode(":",$location->page);
    if($action=='edit') {
      $sql->query("select name_lv,name_en,description_lv,description_en,type from portfolio where id='$id'");
      $sql->row();
      $this->variables['id'] = $id;
      $this->variables['itemNameLV'] = $sql->col('name_lv');
      $this->variables['itemNameEN'] = $sql->col('name_en');
      $this->variables['itemDescriptionLV'] = $sql->col('description_lv');
      $this->variables['itemDescriptionEN'] = $sql->col('description_en');
      $this->variables['images'] = "";

      $type = $sql->col('type');
      
      $optsLV=$optsEN=Array();
      $sql->query("select id,name_lv,name_en from types order by id");
      while($sql->row()) {
        $optsLV[]="<option value='{$sql->col('id')}' ".($sql->col('id')==$type ? "selected='selected'" : "").">{$sql->col('name_lv')}</option>";
      }
      $this->variables['type']=implode("\n",$optsLV);
    
      
      $folder = "/uploads/galleries/$id/";
      $images = getFolderFiles($folder);
      foreach($images as $image) {
        $imageList[] = "<div class='imageContainer loaded'>
          <a href='/cms/{$location->addr};removeImage:$image' class='removeImage'>X</a><img src='$folder$image' style='max-width:200px;'/>
        </div>";
      }
      $this->variables['images'] = implode("\n",$imageList);
      
      $this->load('portfolioManage','currentContent');
    } elseif($action=='add') {
      $this->variables['itemNameLV']=$this->variables['itemNameEN']=$this->variables['itemDescriptionLV']=$this->variables['itemDescriptionEN']="";
      $this->variables['images'] = "";
      $this->variables['id']='';
      $optsLV=$optsEN=Array();
      $sql->query("select id,name_lv,name_en from types order by id");
      while($sql->row()) {
        $optsLV[]="<option value='{$sql->col('id')}'>{$sql->col('name_lv')}</option>";
      }
      $this->variables['type']=implode("\n",$optsLV);
      $this->load('portfolioManage','currentContent');
    } 
  }
}


?>