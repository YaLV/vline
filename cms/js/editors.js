$(document).ready( function() {
  initMCE();
  $('.submit').unbind().click(function(e){
    tinyMCE.triggerSave();
    $('#content').animate({opacity:0},function() {
      $(this).parents('form').submit();
    });    
    e.preventDefault();
  });
});
function initMCE() {
  tinyMCE.init({
    mode : "textareas",
    theme: "advanced",
    plugins : "autolink,lists,pagebreak,style,layer,table,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,images,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
      theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
      theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,images,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
      theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
      theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
      theme_advanced_toolbar_location : "top",
      theme_advanced_toolbar_align : "left",
      theme_advanced_statusbar_location : "bottom",
      theme_advanced_resizing : true,  
      theme_advanced_blockformats: 'h1,h2,h3,h4,h5,h6',
      //theme_advanced_disable : "formatselect",
    valid_elements : "*[*]",
    inline_styles : true,
    schema: "html5",
    force_br_newlines : true,
    force_p_newlines : false,
    remove_linebreaks : false,
    forced_root_block : false,
    invalid_elements : "p",
    content_css : "/cms/css/admcss.css"
  });
}
