<script src='/cms/js/editors.js'></script>

<ul class='nav nav-tabs'>
  <li class='active'><a href='#PageContent_lv' data-toggle="tab">Latvian</a></li>  
  <li><a href='#PageContent_en' data-toggle="tab">English</a></li>  
  <li class='pull-right'><a>Editing: {section}</a></li>  
</ul>
<form method='post' class='aSync' action='{action}'>
  <div class='tab-content'>
    <div id='PageContent_lv' class='tab-pane active'>
      <table>
        <tr>
          <td colspan="2"><input type='hidden' value='1' name='saveContent' /><textarea name='pageContent_lv' class='editfield'>{pageContent_lv}</textarea></td>
        </tr>
        <tr>
          <td style='text-align:center;'><a class='submit btn btn-success'>Save</a></td>
        </tr>
      </table>
    </div>
    <div id='PageContent_en' class='tab-pane'>
      <table>
        <tr>
          <td colspan="2"><textarea style='width:1004px;height: 510px;' name='pageContent_en' class='editfield'>{pageContent_en}</textarea></td>
        </tr>
        <tr>
          <td style='text-align:center;'><a class='submit btn btn-success'>Save</a></td>
        </tr>
      </table>
    </div>
  </div>
</form>