<?

class auth {
  
  public $user,$userString;
  private $loginData;
  //private $userString='';
  //private $passString='';
  
  public function __construct() {
    global $language,$templates,$location;
    if(isPOST && !isset($_SESSION['user']) && !$_SESSION['user']) {
      if(!empty($_POST['username']) && !empty($_POST['password'])) {
        if($this->userExists() && $this->passwordExists()) {
          $_SESSION['user']=$this->loginData['userID'];
          $templates->variables = $language->getMessage("successLogin");
          $templates->variables['callback'] = "loginSuccess()";
          $templates->variables['result'] = "success";
        } else {                             
          $templates->variables = $language->getMessage("wrongLogin");
          $templates->variables['result'] = "fail";
        }
      } else {
        $templates->variables = $language->getMessage("noLoginData");
        $templates->variables['result'] = "fail";
      }
    } else {
      if(!isset($_SESSION['user']) && !$_SESSION['user']) {
        $templates->load("login","content");
        $templates->variables['menu']="";
      } elseif($_SESSION['user']) {
        $this->createUserString();
      }
    }                              
  }
  
  private function userExists() {
    $this->loginData['userID']=1;
    return true;
    //return crypt($_POST['username'],$this->userString)==$this->userString;
  }
  
  private function passwordExists() {
    return true;
    //return crypt($_POST['password'],$this->passString)==$this->passString;    
  }

  private function createUserString() {
    $this->userString="Logged in";
    $this->user = $_SESSION['user'];
  }
  
}


$auth = new auth; 
?>