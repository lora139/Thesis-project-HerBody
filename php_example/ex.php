<?php 
			echo "Отчет","<br>";
			echo "Име на ученик: ", $_POST['name'],"<br>";
			echo "Номер на ученик: ", $_POST['nom'],"<br>";
			echo "Резултат: ", $_POST['yes'],"<br>";
			echo "Предмет: ", $_POST['pr'],"<br>";
			echo "Диплома: ";
			
			if(isset($_POST['pr']))
			{
				echo"YES <br>";
			}
			else
			{
				echo "NO <br>";
			}
		?>