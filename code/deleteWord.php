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
			<form action="deleteWord.php" method="POST">
				<div class="form-group">
				  <label for="tu">Từ bạn muốn xóa :</label>
				  <input type="text" class="form-control" id="tu" placeholder="にほんご" name="tu">
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
			
				else if(isset($_POST['submit'])){
				$tu = $_POST['tu'];
				//-- check null
				if($tu == null) 
					echo 'Notifies: bạn chưa nhập gì, hãy nhập lại!';
				else{
						$qr = "DELETE FROM goin2 WHERE tu = '$tu'" ;
						$result = pg_query($qr);
						if($result){
						echo "Successed!";
						pg_close($db);
						}
						else echo "false!";
					}
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