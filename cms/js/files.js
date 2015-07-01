(function($) {
  $.fn.bindFile = function() {
    $("#fileuploader").change(function(){
      file = this.files[0];
      filename = this.files[0].name;
      $('[name=filename]').val(filename);
      var reader = new FileReader();
      if(reader instanceof FileReader) {
        reader.readAsDataURL(file);
        reader.onload = (function(kak) {
          return function(e) {  
            if(e.target.result.length>5) {
              $('[name=file]').val(e.target.result);
              $('#fileUpper').submit();
            }
          }
        })(file);      
      }
    });
    $("#fileUpper").submit(function(e){
      $.post($(this).attr('action'),$(this).serialize(),function(data) {
        eval(data.callback);
        $().bindInsert();
      },"json");
      e.preventDefault();
      return false;
    });
  }
  
  $.fn.insertFile = function(type,name,id,ext) {
    if(type!='unknown') {
      type = "<img style='max-width:90px;max-height:90px;' src='/cms/types/"+type+"' />";
    } else {
      type='Unknown FileType';
    }
    $('.fileContainer').prepend("<div style='opacity:0;width:0px;' data-id='"+id+"' data-filetype='"+ext+"' data-filename='"+name+"' class='pull-left file'><div style='width:96px;height:96px;text-align:center;vertical-align:middle;'>"+type+"</div>"+name+"</div>");
    $('.fileContainer .file:first-child').animate({width:"100px",opacity:"1"});
  }
  
  $.fn.bindUpload = function() {
    $('.fileUpload').unbind().click(function(){
      console.log('clicked');
      $("#fileuploader").click();
    });
  } 
  
  $.fn.bindInsert = function() {
    $('.file').unbind().click(function(){
      var el = $(this); 
      var html = "<a class='downloadFile "+el.attr('data-fileType')+"' href='/file/"+el.attr('data-id')+"/"+el.attr('data-filename')+"' title='Download "+el.attr('data-filename')+"'>"+el.attr('data-filename')+"</a>"; 
      fileDialog.insert(html);
    });
  }
})(jQuery);

var fileDialog = {
	init : function(ed) {
		tinyMCEPopup.resizeToInnerSize();
	},

	insert : function(text) {
		var ed = tinyMCEPopup.editor, dom = ed.dom;
		tinyMCEPopup.execCommand('mceInsertContent', false, text);
    tinyMCEPopup.close();
	}
};

$(document).ready(function(){
  $().bindInsert();
  $().bindUpload();
  $().bindFile();
  tinyMCEPopup.onInit.add(fileDialog.init, fileDialog);
});