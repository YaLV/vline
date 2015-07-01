$(document).ready(function() {
  bindFile();
  enableRemove();  
});

var imagesUploaded = 0;

function bindFile() {
  $(".imageUpload").change(function(){
    file = this.files;
    console.log(file);
      for(x in file) {
        if($.isNumeric(x)) {
          read(file[x]);
        }
      }
      clearForm();
  });
}

function read(file) {
  var reader = new FileReader();
  if(reader instanceof FileReader) {
    reader.readAsDataURL(file);
    reader.onload = (function(kak) {
      return function(e) {         
        if(e.target.result.length>5) {
          $('#imageList').append("<div class='imageContainer'><a href='#' class='removeImage'>X</a><img src='"+e.target.result+"' style='max-width:200px;'/><input type='hidden' class='imageContent' value='"+e.target.result+"' /></div>")
          enableRemove();          
        }
      }
    })(file);      
  }
}


function clearForm() {
  $('#uploader').html($('#uploader').html());
  bindFile();
}

function enableRemove() {
  $('.removeImage').unbind().click(function(e){
    el=$(this);
    if(el.parent().hasClass('loaded')) {
      $.post($(this).attr('href'),"removeImage=1",function(returnData){
        console.log(returnData);
      });
    } 
    el.parent().remove();
    e.preventDefault();
  });
}

function uploadImage(response) {
  form = $('.imageContent').parents('form');
  galleryID = response.id;
  $('.imageContent').each(function(){
    var req = new XMLHttpRequest();
    console.log(form.attr('action')+"/edit:"+galleryID);
    req.open("POST", form.attr('action')+"/edit:"+galleryID, true);
    boundary = "---------------------------7da24f2e50046";
    req.setRequestHeader("Content-Type", "multipart/form-data, boundary="+boundary);
    var body = "--" + boundary + "\r\n";
    body += "Content-Disposition: form-data; name='galleryFile'; filename='das.jpg'\r\n";
    body += "Content-Type: application/octet-stream\r\n\r\n";
    body += $(this).val() + "\r\n";
    body += "--" + boundary + "--";
    req.onreadystatechange = function(e) {
        if(this.readyState === 4) {
          console.log(e.target.response);
        }
        return false;
    }
    req.send(body);
  });
  return response;
}
