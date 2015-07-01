<?

class languages {
  public $output;
    
  public function getMessage($messageID) {
    return Array("message" => "$messageID", "messageType" => "showSuccessToast");
  }
}

$language = new languages;

?>