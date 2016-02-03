<?php
class uploader{
	private $filename, $type;
	
	public function __construct(){
		$this->filename = "";
		$this->type = "";
	}
	
	public function checkAndMove(){
		$size = $_FILES['picture']['size'];
		$postMax = ((int) ini_get('post_max_size'))*1024*1024;
		if($size < $postMax){
			$this->moveFile();
		}else{
			echo "<h3>Файл слишком большой<h3>";
			echo "<p>Пожалуйста, загрузите файл, размером до ".(ini_get('post_max_size'))."b<p>";
		}
	}
	
	public function getFileType(){
		$name = $_FILES['picture']['name'];
		$this->type = ".".substr($name, strlen($name) - 3);
		return $this->type;
	}
	
	public function moveFile(){
		if(is_uploaded_file($_FILES['picture']['tmp_name'])){
			$tmp_name = $_FILES["picture"]["tmp_name"];
			$this->filename = md5(time().$_FILES["picture"]["name"]).($this->getFileType());
			move_uploaded_file($tmp_name, "files/".($this->filename));
			$_SESSION['filename'] = "files/".($this->filename);
		}
	}
	
	public function getName(){
		return $this->filename;
	}
	
	public function setNullName(){
		session_destroy();
		$this->filename = "";
		$this->type = "";
	}
	
}
?>