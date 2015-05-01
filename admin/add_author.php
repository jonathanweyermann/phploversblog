<?php include 'includes/header.php'; ?>

<?php 
	//Create db Object
	$db = new Database();
	$error = "";
	if(isset($_POST['submit'])){
		//Assign Variables
		$name = mysqli_real_escape_string($db->link, $_POST['name']);
		$homepage = mysqli_real_escape_string($db->link, $_POST['homepage']);
		
		//validation
		if ($name=='' || $homepage==''){
			//set error
			$error = 'Please fill out all required fields';
		} elseif (!preg_match("/\/\//",$homepage)){
			//set error
			$error = 'Please add Protocol to website';
		}
		else {
			$query = "INSERT INTO authors
						(name, homepage)
						VALUES('$name','$homepage')";
			$update_row = $db->update($query);
		}
		
	}
	if ($error!="") echo $error;
?>

<form role="form" method="post" action="add_author.php">
  <?php if ($error!="") : ?>
  
  
  <?php endif ; ?>
  <div class="form-group">
    <label>Author Name</label>
    <input name="name" type="text" class="form-control" placeholder="Enter Name">
  </div>

  <div class="form-group">
    <label>HomePage</label>
    <input name="homepage" type="text" class="form-control" placeholder="Enter HomePage">
  </div>
  
  <div>
	  <input name="submit" type="submit" class="btn btn-default" value="Submit" />
	  <a href="index.php" class="btn btn-default">Cancel</a>
  </div>
  <br>
</form>

<?php include 'includes/footer.php'; ?>