function loginSuccess(text) {
  $('section#menu').animate({"opacity":0}, function() { $(this).load("/cms/loadMenu", function() { $(this).animate({"opacity":1}) }); $().updateAllLinks(); }); 
  $('section#content').animate({"opacity":0}, function() { $(this).load("/cms/loadContent", function() { $(this).animate({"opacity":1}); $().updateAllLinks(); }); });
}