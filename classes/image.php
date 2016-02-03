<?php
class image{
	private $userImage, $img, $width, $height, $ratio, $sizes, $toCrop;
	
	public function __construct(){
		$this->userImage = $_SESSION['filename'];
		$this->img = imagecreatefromjpeg($this->userImage);
		list($this->width, $this->height) = getimagesize($this->userImage);
		$this->ratio = $this->width / $this->height;
		$this->toCrop = false;
	}
	
	public function showImage(){
		if($this->width > 600 || $this->height > 800){
			echo '<img id="image" src="'.$this->userImage.'" width="400" height="500" alt="Ваш файл">';
		}else{
			echo '<img id="image" src="'.$this->userImage.'" width="'.$this->width.'" height="'.$this->height.'" alt="Ваш файл">';
		}
	}
	
	public function getDimensions(){
		if(!empty($_GET['dimensions'])){
			$this->sizes = explode("х", $_GET['dimensions']);
			$this->sizes[0] = (int) $this->sizes[0];
			$this->sizes[1] = (int) $this->sizes[1];
			$realRation = $this->sizes[0] / $this->sizes[1];
			if($realRation != $this->ratio){	
				getScript($this);
				$this->toCrop = true;
			}
		}
	}
	
	public function checkCrop($menu){
		if(!empty($_GET['dimensions'])){
			if($this->toCrop){
				echo "<p>Вы выбрали формат: ".$this->getWidthHeight().", пожалуйста обрежьте изображение</p>";
				$menu->showButton();
			}else{
				echo "<p>Вы выбрали формат: ".$this->getWidthHeight()."</p>";
			}
		}
	}
	
	public function cropImage(){
		print_r($_POST);
		$x1 = (int) $_POST['x1'];
		$x2 = (int) $_POST['x2'];
		$y1 = (int) $_POST['y1'];
		$y2 = (int) $_POST['y2'];
		$width = $x2 - $x1;
		$height = $y2 - $y1;
		$dest = imagecreatetruecolor($width, $height);
		imagecopy($dest, $this->img, 0, 0, $x1, $y1, $width, $height);
		$this->img = $dest;
		$this->saveImage();
		header("Location: index.php");
	}
	
	public function getWidthHeight(){
		return ($this->sizes[0]).":".($this->sizes[1]);
	}

	public function applySepia(){
		imagefilter($this->img,IMG_FILTER_GRAYSCALE);
		imagefilter($this->img,IMG_FILTER_COLORIZE,100,50,0);
	}
	
	public function saveImage(){
		imagejpeg($this->img, $this->userImage);
		imagedestroy($this->img);
	}
}

?>