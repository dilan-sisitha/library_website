<?php
  include "connection.php";
  include "navbar.php";
?>


<!DOCTYPE html>
<html>
<head>
	<title>Books</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<style type="text/css">
		.srch
		{
			padding-left: 1000px;


		}
		.boxx
		{
			padding: 100px;
			margin-top: 0px;
			padding-top: 20px;


		}

		.add{
			align-self: center;
			text-align: left;
			padding:20px;
			border-radius: 5px;
  			background-color: #f2f2f2;
  			margin-left: 20%;
  			margin-right: 20%;
  			padding-left: 300px;
  			

		}
		#ad{

			
			padding-bottom: 10px;
			padding-left: 20px;

		}

		
		body {
  font-family: "Lato", sans-serif;
  transition: background-color .5s;


}
input[type=text],select{
  width: 50%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
 
  border-radius: 4px;
}


	</style>

</head>
<body>
	
	
<!-- _________add books _______________-->

<div class="add">
<h2 id="ad">ADD BOOKS</h2>
<form name="add_books" action="" method="post">
  <div class="form-group">
    <label >Book-Name </label>
    <input type="text" class="form-control" name="bname" placeholder="Book-Name" required>
   
  </div>

  <div class="form-group">
    <label >Authors Name</label>
    <input type="text" class="form-control" name="authors" placeholder="Authors Name" required>
  </div>

    <div class="form-group">
    <label >Edition</label>
    <input type="text" class="form-control" name="edition" placeholder="Edition" required>
  </div>
  

    <div class="form-group">
    <label >Status</label>
    <select  class="form-control" name="status" style="width: 50%;">
    <option value="Available">Available</option>
    <option value="Unavailable">Unavailable</option>
     
    </select>

  </div>

    <div class="form-group">
    <label >Quantity</label>
    <input type="text" class="form-control" name="quantity"  placeholder="Quantity" required>
  </div>

   <div class="form-group">
    <label >Department</label>
    <input type="text" class="form-control" name="department"  placeholder="Department" required>
  </div>
 
  <button type="submit" class="btn btn-primary" name="add" >ADD BOOK</button>
</form>
</div>

		<!--___________________search bar________________________-->

	<div class="srch">
		<form class="navbar-form" method="post" name="form1">
			
				<input class="form-control" type="text" name="search" placeholder="search books.." required="">
				<button style="background-color: #6db6b9e6;" type="submit" name="submit" class="btn btn-default">
					<span class="glyphicon glyphicon-search"></span>
				</button>
		</form>
	</div>

	<h2 style="padding-left: 80px;">List Of Books</h2>
	<?php

		if(isset($_POST['submit']))
		{
			$q=mysqli_query($db,"SELECT * from books where name like '%$_POST[search]%' ");

			if(mysqli_num_rows($q)==0)
			{
				echo "Sorry! No book found. Try searching again.";
			}
			else
			{
				echo"<div class='boxx'>";		
				echo "<table class='table table-bordered table-hover' >";
				echo "<tr style='background-color: #6db6b9e6;'>";
				//Table header
				echo "<th>"; echo "ID";	echo "</th>";
				echo "<th>"; echo "Book-Name";  echo "</th>";
				echo "<th>"; echo "Authors Name";  echo "</th>";
				echo "<th>"; echo "Edition";  echo "</th>";
				echo "<th>"; echo "Status";  echo "</th>";
				echo "<th>"; echo "Quantity";  echo "</th>";
				echo "<th>"; echo "Department";  echo "</th>";
			echo "</tr>";	

			while($row=mysqli_fetch_assoc($q))
			{
				echo "<tr>";
				echo "<td>"; echo $row['bid']; echo "</td>";
				echo "<td>"; echo $row['name']; echo "</td>";
				echo "<td>"; echo $row['authors']; echo "</td>";
				echo "<td>"; echo $row['edition']; echo "</td>";
				echo "<td>"; echo $row['status']; echo "</td>";
				echo "<td>"; echo $row['quantity']; echo "</td>";
				echo "<td>"; echo $row['department']; echo "</td>";

				echo "</tr>";
			}
			echo "</table>";
			echo"</div>";	
			}

		


		}
		/*if add book button is  pressed.*/
		elseif(isset($_POST['add'])){
			$count=0;

        $sq="SELECT name from `books`";
        $r=mysqli_query($db,$sq);

        while($row=mysqli_fetch_assoc($r))
        {
          if($row['name']==$_POST['bname'])
          {
            $count=$count+1;
          }
        }
        if($count==0)
        {
          mysqli_query($db,"INSERT INTO `BOOKS` VALUES('','$_POST[bname]', '$_POST[authors]', '$_POST[edition]', '$_POST[status]', '$_POST[quantity]', '$_POST[department]');");
          ?>
          <script type="text/javascript">
           alert("Registration successful");
          </script>
       	 <?php
        	}
       	 else
       	 {

          ?>
            <script type="text/javascript">
              alert("The book already exist.");
            </script>
          <?php

       	 }
		  $res=mysqli_query($db,"SELECT * FROM `books` ORDER BY `books`.`bid` ASC;");
			echo"<div class='boxx'>";
			echo "<table class='table table-bordered table-hover' >";
			echo "<tr style='background-color: #6db6b9e6;'>";
				//Table header
				echo "<th>"; echo "ID";	echo "</th>";
				echo "<th>"; echo "Book-Name";  echo "</th>";
				echo "<th>"; echo "Authors Name";  echo "</th>";
				echo "<th>"; echo "Edition";  echo "</th>";
				echo "<th>"; echo "Status";  echo "</th>";
				echo "<th>"; echo "Quantity";  echo "</th>";
				echo "<th>"; echo "Department";  echo "</th>";
			echo "</tr>";	

			while($row=mysqli_fetch_assoc($res))
			{
				echo "<tr>";
				echo "<td>"; echo $row['bid']; echo "</td>";
				echo "<td>"; echo $row['name']; echo "</td>";
				echo "<td>"; echo $row['authors']; echo "</td>";
				echo "<td>"; echo $row['edition']; echo "</td>";
				echo "<td>"; echo $row['status']; echo "</td>";
				echo "<td>"; echo $row['quantity']; echo "</td>";
				echo "<td>"; echo $row['department']; echo "</td>";

				echo "</tr>";
			}
			echo "</table>";
			echo"</div>";


		}

			/*if button is not pressed.*/
		else
		{
			$res=mysqli_query($db,"SELECT * FROM `books` ORDER BY `books`.`name` ASC;");
			echo"<div class='boxx'>";
			echo "<table class='table table-bordered table-hover' >";
			echo "<tr style='background-color: #6db6b9e6;'>";
				//Table header
				echo "<th>"; echo "ID";	echo "</th>";
				echo "<th>"; echo "Book-Name";  echo "</th>";
				echo "<th>"; echo "Authors Name";  echo "</th>";
				echo "<th>"; echo "Edition";  echo "</th>";
				echo "<th>"; echo "Status";  echo "</th>";
				echo "<th>"; echo "Quantity";  echo "</th>";
				echo "<th>"; echo "Department";  echo "</th>";
			echo "</tr>";	

			while($row=mysqli_fetch_assoc($res))
			{
				echo "<tr>";
				echo "<td>"; echo $row['bid']; echo "</td>";
				echo "<td>"; echo $row['name']; echo "</td>";
				echo "<td>"; echo $row['authors']; echo "</td>";
				echo "<td>"; echo $row['edition']; echo "</td>";
				echo "<td>"; echo $row['status']; echo "</td>";
				echo "<td>"; echo $row['quantity']; echo "</td>";
				echo "<td>"; echo $row['department']; echo "</td>";

				echo "</tr>";
			}
			echo "</table>";
			echo"</div>";
		}

		

	

	?>


	<!----- add book php-->



</div>

</body>
</html>