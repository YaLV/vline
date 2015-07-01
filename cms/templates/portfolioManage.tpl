<script src='/cms/js/editors.js'></script>
<script src='/cms/js/imageUploader.js'></script>

<ul class='nav nav-tabs'>
  <li class='active'><a href='#PageContent_lv' data-toggle="tab">Latvian</a></li>  
  <li><a href='#PageContent_en' data-toggle="tab">English</a></li>  
  <li><a href='#Images' data-toggle="tab">Images</a></li>
  <li class='pull-right'><a>Editing: {section}</a></li>  
</ul>
<form method='post' class='aSync' action='{action}'>
<input type='hidden' name='edit' value='{id}' id='idField' />
<input type='hidden' value='{fullAction}' id='action' />
  <div class='tab-content'>
    <div>Tips: <select name='type'>{type}</select></div>
    <div id='PageContent_lv' class='tab-pane active'>
      <table>
        <tr>
          <td>Nosaukums:</td>
          <td><input type='text' name='name_lv' value='{itemNameLV}'></td>
        </tr>
        <tr>
          <td colspan="2"><input type='hidden' value='1' name='saveContent' /><textarea name='pageContent_lv' class='editfield' style='height: 200px;'>{itemDescriptionLV}</textarea></td>
        </tr>
        <tr>
          <td style='text-align:center;'><a class='submit btn btn-success'>Save</a></td>
        </tr>
      </table>
    </div>
    <div id='PageContent_en' class='tab-pane'>
      <table>
        <tr>
          <td>Nosaukums:</td>
          <td><input type='text' name='name_en' value='{itemNameEN}'></td>
        </tr>
        <tr>
          <td colspan="2"><textarea style='width:1004px;height: 200px;' name='pageContent_en' class='editfield'>{itemDescriptionEN}</textarea></td>
        </tr>
        <tr>
          <td style='text-align:center;'><a class='submit btn btn-success'>Save</a></td>
        </tr>
      </table>
    </div>
    <div id='Images' class='tab-pane'>
      <table>
        <tr>
          <td colspan="2">
          <div id='uploader'><input type='file' class='imageUpload' multiple/></div>
          <div class='clear'></div>
          <div id='imageList'>{images}</div>          
          </td>
        </tr>
        <tr>
          <td style='text-align:center;'><a class='submit btn btn-success'>Save</a></td>
        </tr>
      </table>
    </div>
  </div>
</form>