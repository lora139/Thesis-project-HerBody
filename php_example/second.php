<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Form example with PHP</title>
		<meta charset="UTF-8">
	</head>
	
	<body>
		<form id="form1" name="form1" method="post" action="ex.php">
			<p>Информация за ученици</p>
			<p><lable>Номер в класа
				<input name="nom" type="text" id="name">
			</lable></p>
			
			<p><lable>Име 
				<input name="name" type="text" id="name">
			</lable></p>
			
			<p>
				<lable><input name="yes" type="radio" value="yes" checked>Положителен</lable>
				<lable><input name="yes" type="radio" value="yes">Отрицателен</lable>
			</p>
			
			<p>Предмети
				<select name="pr" size="1" id="pr">
					<option>Математика</option>
					<option>Информатика</option>
					<option>История</option>
				</select>
			</p>
			
			<lable>
				<input name="dipl" type="checkbox" id="dip1" value="diploma">Диплома
			</lable>
			
			<p>
				<input type="submit" name="submit" value="Submit!">
			</p>
		</form>
		
		
	</body>
</html>
	