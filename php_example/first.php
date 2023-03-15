<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PHP first example</title>
		<meta charset="UTF-8">
	</head>
	
	<body>
		<p><i>Пример за отпечатване на текст чрез PHP</i></p>
	
		<?php 
			echo "Hello World!<br>";
			print ("Hello World!");
			
			//втори пример за отпечатване на променливи и пресвояване на стойности
			$car = (array("Ana" => "Porsche","Peter" => "VW", "John" =>"Mercedes"));
			$name = "Peter";
			print("$name has $car[$name].<br>");
		?>
		
		<br>
		
		<?php 
			$age = array("Peter"=>"35", "Ani"=>"37", "Stenli"=>"43");
			echo "Peter is ".$age['Peter']." years old.";
		?>
		
		<p>Втори пример за деклариране и отпечатване стойности на масив чрез PHP със служебна дума range</p>
		<p><i>Масив може да се създаде чрез оператора range. range(начална_стойност, крайна_стойност, стъпка=1)
		масивът, който се създава по този начин има ключове 0,1,2, .....</i></p>
		
		<?php
			$arr = range(1,5);
			print_r($arr);
			print("<br>");
			
			$arr = range(1,10,2);
			print_r($arr);
			print("<br>");
			
			$arr = range('A','E');
			print_r($arr);
			print("<br>");
		?>
		
		<br>
		<p><i>Пример за отпечатване стойности на масив по индекс</i></p>
		
		<?php 
			$cars = array("Volvo", "BMW", "Toyota");
			echo "I like ".$cars[0].", ".$cars[1]." and ".$cars[2].".","<br>";
			
			echo "Length is ";
			print(count($cars));
			echo"<br>";
		?>
		
		<br>
		
		<p><i>Пример за отпечатване стойности на масив чрез цикъл</i></p>
		
		<?php 
			$cars = array("Volvo", "BMW", "Toyota");
			$arraylength = count($cars);
			
			for($x = 0; $x < $arraylength; $x++)
			{
				echo $cars[$x];
				echo "<br>";
			}
		?>
	</body>
</html>