<?php include 'includes/header.php'; ?>

<?php 
	$id = $_GET['id'];
	//Create db Object
	$db = new Database();
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
			$query = "UPDATE authors
						SET
						name = '$name', homepage = '$homepage'
						WHERE id = ".$id;
			$update_row = $db->update($query);
		}
		
	}
?>

<?php
	if(isset($_POST['delete'])){
		$query ="DELETE FROM authors WHERE id = ".$id;
		$delete_row = $db->delete($query);
	}
?>


<?php 
	$id = $_GET['id'];
	//Create db Object
	$db = new Database();
	
	//Create Query
	$query = "SELECT * FROM authors WHERE id = ".$id;
	
	//Run Query
	$author = $db->select($query)->fetch_assoc();
	
?>
<form role="form" method="post" action="edit_author.php?id=<?php echo $id ;?>">
    <div class="form-group">
    <label>Author Name</label>
    <input name="name" type="text" class="form-control" placeholder="Enter Name" value="<?php echo $author['name']; ?>">
  </div>

  <div class="form-group">
    <label>HomePage</label>
    <input name="homepage" type="text" class="form-control" placeholder="Enter HomePage" value="<?php echo $author['homepage']; ?>">
  </div>
  <div>
	  <input name="submit" type="submit" class="btn btn-default" value="Submit" />
	  <a href="index.php" class="btn btn-default">Cancel</a>
	  <input name="delete" type="submit" class="btn btn-danger" value="Delete" />
  </div>
  <br>
</form>

<?php include 'includes/footer.php'; ?>