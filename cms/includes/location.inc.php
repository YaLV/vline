<?

class location {
  public $section,$page,$action,$addr;
  
  public function __construct() {
    @list($section,$page,$action,$subaction) = @explode("/",$_GET['address']);
    $this->section = $section;
    $this->page = $page;
    $addr = explode("/",$_GET['address']);
    if($action && $section=='NewsAndEvents') {
      if($subaction) {
        $currentAddress = "$section/$subsection/$subsubSection";
        $this->action = $subaction;
      } else {
        if(get_reply("select id from menu where link='$section/$page/$action'")) {
          $currentAddress = "$section/$page/$action";
        } else {
          $currentAddress = "$section/$page";
          $this->action = $action;
        }
      }
    } else {
      $currentAddress=$_GET['address'];
    }
    $this->addr = $currentAddress;
  }

  public function direct($location) {
    header("location:".BASE."$location");
    exit();
  }
}

$location=new location;

?>