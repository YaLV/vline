<?

function get_reply($query) {
  global $config;
  $mysql = $config['mysql'];
  $link = mysqli_connect($mysql['host'],$mysql['user'],$mysql['password'],$mysql['db']) or die("Connection Error " . mysqli_error($link));
  $link->select_db($mysql['db']);
  $link->query("set names utf8");
  if(preg_match("/last_insert_id/",$query)) {
    $link->multi_query($query) or die("Query Error " . mysqli_error($link));
    $link->next_result();
    $result = $link->use_result();
  } else {
    $result = $link->query($query) or die("Query Error " . mysqli_error($link));
  }
  $row = $result->fetch_row();
  $link->close();
  return trim($row[0]);
}


class sql {
  private $link,$result,$row,$cursor;
  
  public function __construct() {
    global $config;
    $mysql = $config['mysql'];
    $this->link = mysqli_connect($mysql['host'],$mysql['user'],$mysql['password'],$mysql['db']) or die("Connection Error " . mysqli_error($link));
    $this->link->select_db($mysql['db']);
    $this->link->query("set names utf8");
  }
  
  public function query($query) {
    $this->result = $this->link->query($query) or die("Query Error " . mysqli_error($this->link));
    $this->cursor = 0;
  }
  
  public function row() {
    if($this->cursor<$this->result->num_rows) {
      $this->result->data_seek($this->cursor) or die('Cannot Select');
      $this->cursor++;
      $this->row=$this->result->fetch_assoc() or die('Cannot fetch');
      return true;
    } else {
      return false;
    }
  } 
  
  public function col($cellName) {
    return trim($this->row[$cellName]);
  }
}