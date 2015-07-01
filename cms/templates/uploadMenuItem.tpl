<script src='/cms/js/imageUploader.js'></script>
<div style='width:300px;text-align:center;margin:auto;border: 1px solid rgba(0,0,0,.3);padding:5px;'>
  Image Should be no more than 200 pixels wide.
  <form method='post' action='{action}' class='aSync'>
    <div style='text-align:center;'>
      <img src='{oldImage}' id='oldImage' style='max-width:200px;'/>
    </div>
    <hr />
    <div id='newImageContainer'>
    </div>
    <div>
      <input type='hidden' name='source' id='imageSource' />
      <div id='uploader'>
        <input type='file' class='imageUpload'/>
      </div>
    </div>
    <div>
      <a herf='#' class='btn btn-danger btn-mini pull-right clear'>Discard New Image</a>
      <a href='#' class='btn btn-success btn-mini pull-right submit' style='margin-right:10px;'>Save New Image</a>
    </div>
  </form>
</div>