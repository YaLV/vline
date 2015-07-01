<?
session_start();

include getcwd()."/includes/conf.inc.php";
$extraClass=($subsection ? "hasMenu" : "");
?>
<!DOCTYPE html>  
<html lang="eng">  
  <head>  
    <meta charset="utf-8" />
    <meta name='viewport' content="maximum-scale=0.5 user-scalable=yes, width=device-width" />  
  	<title>V Line <?=$sectionTitle;?></title>
  	<meta name="author" content="Ya" />
    <link href="/css/style.css" rel="stylesheet" media="screen">
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="/js/functions.js"></script>
    <script src="/js/main.js"></script>
  </head>  
  <body>
    <section id='header'>
      <div id='logo'>
        <div class='language'>
          <a href='/lv/<?=$section;?>' rel='alternate' class='language<?=$activeLanguageLV;?>'>LV</a>
          &nbsp;&nbsp;&nbsp;
          <a href='/en/<?=$section;?>' rel='alternate' class='language<?=$activeLanguageEN;?>'>EN</a>
        </div>
      </div>
      <div id='mainMenu'>
        <a href='/<?=$lang;?>/contacts' <?=$activeContacts;?>>CONTACTS</a>
        <a href='/<?=$lang;?>/portfolio' <?=$activePortfolio;?>>PORTFOLIO</a>
        <a href='/<?=$lang;?>/about'  <?=$activeAbout;?>>ABOUT</a>
      </div>
<?=$subMenu;?>  
    </section>
    <section id='content'>
      <div class='contentWindow'>
        <?=$content;?>
      </div>
    </section>
    <section id='footer'>
      <div id='logo'>
      </div>
    </section>
  </body>
</html>    