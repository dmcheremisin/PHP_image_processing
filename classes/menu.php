<?php
class menu{
	public function showUploadMenu(){
		?>
		<form action="" method="post" enctype="multipart/form-data">
			<p>Изображениe:</p>
			<p><input type="file" name="picture" /></p>
			<p><input type="submit" value="Отправить" /></p>
		</form>
		<?php
	}
	
	public function showCropMenu(){
		?>
		<form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
			<p>Варианты для печати:</p>
			<p>
			<label><input type="radio" name="dimensions" value="10х15" /> 10х15 </label>
			<label><input type="radio" name="dimensions" value="15х20" /> 15х20 </label>
			<label><input type="radio" name="dimensions" value="15х23" /> 15х23 </label>
			<label><input type="radio" name="dimensions" value="20х27" /> 20х27 </label>
			<label><input type="radio" name="dimensions" value="20х30" /> 20х30 </label> 
			<input type="submit" value="Печать" /> 
			</p>
		</form>
		<?php
	}
	
	public function showButton(){
		?>
		<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
		  <input type="hidden" name="x1" value="" />
		  <input type="hidden" name="y1" value="" />
		  <input type="hidden" name="x2" value="" />
		  <input type="hidden" name="y2" value="" />
		  Выберите область и нажмите кнопку: <input type="submit" name="imageCrop" value="Обрезать" />
		</form>
		</br>
		<?php
	}
	
	public function showSepia(){
		?>
		<form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
			<p>Добавить эффект сепия?
			<label><input type="radio" name="sepia" value="yes" /> Да </label>
			<label><input type="radio" name="sepia" value="no" /> Нет </label>
			<input type="submit" value="Сохранить" /> 
			</p>
		</form>
		<?php
	}
}
?>