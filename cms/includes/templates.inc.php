<?

class templates {
  public $output,$variables;
  
  public function display($page) {
    $contentFile = TEMPLATE.$page.".tpl";
    $this->output = $this->insertVariables(file_get_contents($contentFile));
  }
  
  private function createLink($linkFrom) {
    return preg_replace("/[^a-zA-Z0-9]/","_",$linkFrom);
  }
  
  public function exec($module) {
    global $location;
    include getcwd()."/pages/$module.php";
  }
  
  public function load($page,$key="content") {
    $contentFile = TEMPLATE.$page.".tpl";
    $this->variables[$key]=$this->insertVariables(file_get_contents($contentFile));
  }
  
  private function insertVariables($contents) {
    if(!isset($this->variables['extraTabs'])) {
      $this->variables['extraTabs'] = "";
      $this->variables['extraTabContent'] = "";
    }
    if(is_array($this->variables)) {
      foreach($this->variables as $variable => $content) {
        $contents = str_replace("{".$variable."}",$content,$contents);
      }
    }
    return $contents;
  }                          
  
  public function displayJSON() {
    echo json_encode($this->variables);
    exit();
  }
}

$templates = new templates;

?>