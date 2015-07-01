<?
$sql = new sql;


$mime['pdf'] = "pdf.jpg";
$mime['xls'] = "xls.png";
$mime['xlsx'] = "xls.png";
$mime['doc'] = "doc.png";
$mime['docx'] = "doc.png";

function rcd($data) {
    $p = strpos($data, ',');
    $d = substr($data, $p+1);
    return $d;
}

if(isPOST) {
  if(!$_POST['removeItem']) {
    $file = rcd($_POST['file']);
    $fileName = $_POST['filename'];
    $id = get_reply("insert into files values(NULL,'$fileName','$file');select last_insert_id() from files");
/*    $file_check = base64_decode($file);
    $fileinfo = finfo_open();
    $mimet = finfo_buffer($fileinfo, $file_check);
    finfo_close($fileinfo);*/
    $exts = explode(".",$fileName);
    $ext = $mime[$exts[count($exts)-1]]; 
    $exts = $exts[count($exts)-1]; 
    $html = "<div class='pull-left file'>$mimet<br />$fileName</div>";
    $return['callback']='$().toastmessage("showSuccessToast","File Uploaded");$().insertFile("'.$ext.'","'.$fileName.'","'.$id.'","'.$exts.'")';
    echo json_encode($return);
    exit();
  } 
} else {
  $sql->query("select id,name,file from files order by id DESC");
  while($sql->row()) {
    $id=$sql->col('id');
    $file = $sql->col('file'); 
    $fileName = $sql->col('name');
    $exts = explode(".",$fileName);
    $ext = $mime[$exts[count($exts)-1]]; 
    $exts = $exts[count($exts)-1]; 
    $files[] = "<div class='pull-left file' data-id='$id' data-filename='$fileName' data-filetype='$exts'><div style='width:96px;height:96px;text-align:center;vertical-align:middle;'><img style='max-width:90px;max-height:90px;' src='/cms/types/$ext' /></div>$fileName</div>";
  }             
  $files = implode("\n",$files); 
  
  $this->variables['content'] = "
    <form method='post' id='fileUpper' action='/cms/files'>
    <input type='hidden' name='filename' />
    <input type='hidden' name='file' />
    <input type='file' id='fileuploader' style='opacity:0;' />
    </form>
    <a class='fileUpload'>Upload</a>
    <div class='fileContainer' style='padding: 5px;'>
      $files
    </div>
  ";
}
?> 