<?

class modules {
  public $content,$menu,$menuItems;
  
  public function exec($module) {
    global $section,$subsection,$currentAddress,$openSub;
    if($this->is($module)) {
      include getcwd()."/modules/$module.php";
    } else {
      if($module=="menu") {
        ob_start();
        include getcwd()."/includes/menu.inc.php";
        $this->menu = ob_get_clean();
      }
    }
  }
  
  private function is($module) {
    $modules = Array("editor","list");
    return in_array($module,$modules);
  }
}

$modules = new modules();

?>