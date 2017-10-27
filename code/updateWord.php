<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<center>
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <a class="navbar-brand" href="#">Dictionary</a>
		</div>
		<ul class="nav navbar-nav">
		  <li><a href="homePage.php">Home</a></li>
		  
		  <li class="active"><a href="addWord.php">Add word</a></li>
		  <li><a href="updateWord.php">Update word</a></li>
		  <li><a href="deleteWord.php">Delete Word</a></li>
		  <li><a href="#">Sentence - Image</a></li>
		  <li><a href="miniGame.php">Mini - Game</a></li>
	   
		</ul>
	  </div>
	</nav>
</center>
	<div class="col-sm-4">
			<form action="updateWord.php" method="POST">

			<div class="form-group">
			  <label for="id">Nhập id từ bạn muốn sửa:</label>
			  <input type="text" class="form-control" id="id" placeholder="01" name="id">
			</div>

			<div class="form-group">
				 <label for="tu">Từ:</label>
				 <input type="text" class="form-control" id="tu" placeholder="にほんご" name="tu">
			</div>
			
			<div class="form-group">
				  <label for="hantu">Hán tự:</label>
				  <input type="text" class="form-control" id="hantu" placeholder="日本語" name="hantu">
			</div>
			
			<div class="form-group">
				  <label for="amhan">Âm hán:</label>
				  <input type="text" class="form-control" id="amhan" placeholder="Nhật Bản Ngữ" name="amhan">
			</div>
			
			<div class="form-group">
			  <label for="viesub">VieSub:</label>
			  <input type="text" class="form-control" id="viesub" placeholder="Tiếng Nhật" name="viesub">
			</div>
		   
		   <div class="form-group">
			  <label for="engsub">EngSub:</label>
			  <input type="text" class="form-control" id="engsub" placeholder="Japanese" name="engsub">
			</div>

			<div class="form-group">
			  <label for="note">Note:</label>
			  <input type="text" class="form-control" id="note" placeholder="Tiếng nhật rất thú vị ^.^" name="note">
			</div>
	
			<button type="submit" name="submit" class="btn btn-success" onclick="return confirm('Bạn đã chắc chắn')">Submit</button>
		  </form>
	</div>
	<!--Code php-->
<center>
		<?php
					$host = "host=127.0.0.1";
					$port = "port=5432";
					$dbname = "dbname=tudien";
					$credentials = "user=postgres password='thanglongsp'";
					$db = pg_connect("$host $port $dbname $credentials");
					   if(!$db)
						   {
							  echo "Error : Unable to open database\n";
						   }//ket noi database
			
				if(isset($_POST['submit'])){

				$id = $_POST['id'];
				$tu = $_POST['tu'];
				$hantu = $_POST['hantu'];
				$amhan = $_POST['amhan'];
				$viesub = $_POST['viesub'];
				$engsub = $_POST['engsub'];
				$note = $_POST['note'];

				//-- check null

				if($tu != null ){
						$qr1 = "update goin2 set tu = '$tu' where id = '$id'" ;
						$result1 = pg_query($qr1);
						if($result1){
						echo "từ updated !";
						}
					}

				if($hantu != null) {
						$qr2 = "update goin2 set hantu = '$hantu' where id = '$id'" ;
						$result2 = pg_query($qr2);
						if($result2){
						echo "Hán tự updated !";
						}
					}

				if($amhan != null){
						$qr3 = "update goin2 set amhan = '$amhan' where id = '$id'" ;
						$result3 = pg_query($qr3);
						if($result3){
						echo "Âm hán updated !";
						}
					}

				if($viesub != null){
						$qr4 = "update goin2 set viesub = '$viesub' where id = '$id'" ;
						$result4 = pg_query($qr4);
						if($result4){
						echo "Viet sub updated !";
						}
					}

				if($engsub != null){
						$qr5 = "update goin2 set engsub = '$engsub' where id = '$id'" ;
						$result5 = pg_query($qr5);
						if($result5){
						echo "EngSub updated !";
						}
					}

				if($note != null){
						$qr6 = "update goin2 set note = '$note' where id = '$id'" ;
						$result6 = pg_query($qr6);
						if($result6){
						echo "Note updated !";
						}
					}

				echo "Updated all !";
				pg_close($db);
			}
			?>
</center>
	
	
	
<center>
	<div class="col-sm-8">
  <h2>Dictionary</h2>
  <p>What is word you want to find ? </p>  
  <input id="myInput" type="text" placeholder="Search..." >
  <br>
  <br>

				<?php           					
					$host        = "host=127.0.0.1";
					$port        = "port=5432";
					$dbname      = "dbname=tudien";
					$credentials = "user=postgres password='thanglongsp'";
					$db = pg_connect("$host $port $dbname $credentials");
					   if(!$db)
						   {
							  echo "Error : Unable to open database\n";
						   }//ket noi database
						$query = "SELECT * from goin2" ;
						$rowCollection = pg_query($query);
				?>
				<table border="2" class="table table-striped">
					<tr>
						<th>STT</th>
						<th>ID</th>
						<th>Từ</th>
						<th>Hán tự</th>
						<th>Âm hán</th>
						<th>VieSub</th>
						<th>EngSub</th>
						<th>Note</th>
					</tr>
				<table border="2" id="mytable" class="table table-striped">
				<tbody>
					<?php 
					
						$b = 0 ;
						while ($row = pg_fetch_assoc($rowCollection)) :
						$b = $b + 1;
						  ?>
						<tr>

							<td><?php echo "".$b."" ?></td>
							<td><?php echo $row['id']; ?></td>
							<td><?php echo $row['tu']; ?></td>
							<td><?php echo $row['hantu']; ?></td>
							<td><?php echo $row['amhan']; ?></td>
							<td><?php echo $row['viesub']; ?></td>
							<td><?php echo $row['engsub']; ?></td>
							<td><?php echo $row['note']; ?></td>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</div>
			
			<script>
			$(document).ready(function(){
			  $("#myInput").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$("#mytable tr").filter(function() {
				  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			  });
			});
			</script>
			
</center>
</body>
</html>