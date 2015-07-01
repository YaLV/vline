(function($) {
  $.fn.updateInput = function() {
    $("input:file").change(function() {
      form = $(this).closest('form');
      file = this.files[0];
      var reader = new FileReader();
      if(reader instanceof FileReader) {
        reader.readAsDataURL(file);
        reader.onload = (function(kak) {
          return function(e) {  
            if(e.target.result.length>5) {
              var req = new XMLHttpRequest();
              console.log(form.attr('action'));
              req.open("POST", form.attr('action'), true);
              boundary = "---------------------------7da24f2e50046";
              req.setRequestHeader("Content-Type", "multipart/form-data, boundary="+boundary);
              var body = "--" + boundary + "\r\n";
              body += "Content-Disposition: form-data; name='"+form.parents('div.tab-pane').attr('id')+"'; filename='" + file.name + "'\r\n";
              body += "Content-Type: application/octet-stream\r\n\r\n";
              body += e.target.result + "\r\n";
              body += "--" + boundary + "--";
              req.onreadystatechange = function(e) {
                  console.log(e.target.response);
                  if(this.readyState === 4) {
                    json = $.parseJSON(e.target.response);
                    if(typeof json.callback!='undefined') {
                      $().toastmessage(json.messageType,json.message);
                      eval(json.callback);
                    }                 
                  }
                  $('#uploadHeader').html($('#uploadHeader').html());
                  $('#uploadPic').html($('#uploadPic').html());
                  $().updateInput();
                  return false;
              }
              e.preventDefault();
              req.send(body);
            } else {
              $().toastmessage('showErrorToast',"Error Uploading File!!!");
            }      
          } 
        })(file); 
      } else {
        $().toastmessage('showErrorToast',"File loading Error!!!");
      }
    });
  }
  
  $.fn.appendImage = function(id,tab) {
    $("#"+tab).append('<div style="float:left;height: 140px;width: 240px;text-align:center;"><img src="/'+tab+'/'+id+'.jpg" class="img'+id+'" style="max-height:100px;"/><a href="'+$('input:file').parents('form').attr('action')+'" data-remove="'+id+'" class="btn btn-danger btn-remove">Remove</a></div>');
    //$('<div style="float:left;height: 140px;width: 240px;text-align:center;"><img src="/showImage/'+id+'.jpg" class="img'+id+'" style="max-height:100px;"/><a href="'+$('input:file').parents('form').attr('action')+'" data-remove="'+id+'" class="btn btn-danger btn-remove">Remove</a></div>').insertAfter(tab+' div.clear').animate({opacity:1,height:"140px"},100);
    //$('<tr style="opacity:0;height:0px;"><td><img class="img'+id+'" src="/showImage/'+id+'" style="max-height: 100px;" /></td><td><a href="'+$('input:file').parents('form').attr('action')+'" data-remove="'+id+'" class="btn btn-danger btn-remove">Remove</a></td></tr>').insertAfter('.firstRow').animate({opacity:1,height:"100px"},100);
    $().enableRemoveImage();
  }
})(jQuery);
$(document).ready(function() { $().updateInput(); });