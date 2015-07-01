(function($) {

  $.fn.enableRemoveAndEdit = function() {
    $('.newsItem a, a.addNew').click(function(e){
      button = $(this);
      ask = $(this).attr('data-ask');
      if(typeof ask!='undefined') {
        if(confirm(ask)) {
          for (var i = 0; i < tinyMCE.editors.length; i) {
            tinyMCE.execCommand('mceRemoveControl',false,tinyMCE.editors[i].editorId);
          }
          $.post($(this).attr('href'),"removeItem=true",function(data) {
            if(data.result=='success') {
              button.parents('.newsItem').animate({opacity:0, height:0},function() { $(this).remove(); });
              $().toastmessage(data.messageType,data.message);
            }
          },'json');
        }
      } else {
        $("#content").animate({"opacity":0},function() {
          for (var i = 0; i < tinyMCE.editors.length; i) {
            tinyMCE.execCommand('mceRemoveControl',false,tinyMCE.editors[i].editorId);
          }
          $().loadContent(button.attr('href'));
        });
      }
    e.preventDefault();
    });
  }
  
  $.fn.enableRemoveType = function() {
    $('ul.items a').unbind().click(function(e){
      $.post($(this).attr('href'),'removeItem=true',function(link){
        $('.item.'+link).remove();
        $().enableRemoveType();      
      });
      e.preventDefault();
      return false;
    });
  }
  
  $.fn.updateAllLinks = function(e) {
    // Menu Links
    $('#menu a:not(.logout)').unbind().click(function(e){
      clickedLink = $(this).attr("href");
      if(clickedLink) {
        $("#content").animate({"opacity":0},function() {
          $().loadContent(clickedLink,function(data){ });
        });
      }
      e.preventDefault();
    });
    
    // Logout
    $('.logout').unbind().click(function(e){
      $("#content, #menu").animate({"opacity":0},function(){
        $.get("/cms/logout");
        $("#content, #menu").html("");
        $("#menu").animate({"opacity":1});
        $('#content').load("/cms/login",function(){
          $().updateAllLinks();
          $(this).animate({"opacity":1});
        });
      });
      e.preventDefault();
    });
  
    // Common Form Submit
    $('form.aSync').submit(function(e){
      action = $(this).attr('action');
      $.post(action,$(this).serialize(),function(response) {
        console.log(response);
        if($('.imageContent').length>0) {
          $('#idVal').val(response.id); 
          $.when( uploadImage(response) ).done(function(response){
            $().toastmessage(response.messageType,response.message);
            if(response.callback) {
              eval(response.callback);
            }          
          }); 
        } else {
          $().toastmessage(response.messageType,response.message);
          if(response.callback) {
            eval(response.callback);
          }
        }
      },"json");
      e.preventDefault();
    });
    
    // Common submit button
    $('form.aSync .submit').click(function(e){ $(this).parents('form').submit(); e.preventDefault(); });
    
    $('li.disabled a').unbind().click(function(e) { e.preventDefault(); return false; });
  }
  
  $.fn.loadContent = function(href) {
    for (var i = 0; i < tinyMCE.editors.length; i) {
      tinyMCE.execCommand('mceRemoveControl',false,tinyMCE.editors[i].editorId);
    }
    $("#content").load(href, function(response) {
      $().updateAllLinks();
      $("#content").animate({"opacity":1});  
    });
  }
    
  // remove image
  $.fn.enableRemoveImage = function() {
    $('.btn-remove').unbind().click(function(e){
      $.post($(this).attr('href'),'tab='+$(this).parents('div.tab-pane').attr('id')+'&removeHeader='+$(this).attr('data-remove'),function(response){
        $().toastmessage(response.messageType,response.message);
        if(response.callback) {
          eval(response.callback);
        }
      },'json');
      e.preventDefault();
    });  
  }
})(jQuery);