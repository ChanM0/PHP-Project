<!-- File signup.php (25 pt)

	Using php $_POST array, 
		processes the input values entered in "Sign up" form of “home.html” page and sent to “signup.php”.
	This page:
		1. Makes a connection to the DB
		2. Inserts a new record in the DB with the received information. 
			(For simplicity you don't need to validate the input info)

		3. If the submission is not successful an error message should be displayed on this page. 

		4. If successful a success message should be displayed such as "you are registered now".

		5. For simplicity insert the entered password as plain text into the DB (no need for encryption).
		
		6. The script should have a function called showTable, 
			which once called, 
				queries the DB and displays a table of all registered users' firstname and lastname.
				Call function showTable at the end to display the table content at the bottom on the page. 
(you can use this function for debugging purposes as well) 
-->

<?php  
	/*
	**	
	*/ 
	$username =  null;
	$password =  null;
	$firstname = null;
	$lastname =  null;
	$phone = 	 null;
	$email = 	 null;

	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$username =  $_POST["username"];
		$password =  $_POST["password"];
		$firstname = $_POST["firstname"];
		$lastname =  $_POST["lastname"];
		$phone = 	 $_POST["phone"];
		$email = 	 $_POST["email"];
	}

	if($username == null || $password ==null || $firstname == null || $lastname ==null || $phone == null || $email ==null)
		die( "no input values can be null </body></html>" );

	#1
	// Connect to MySQL
	if ( !( $database = mysqli_connect( "localhost","root", "" ) ) )
		die( "Could not connect to database </body></html>" );
	// open auth database
	if ( !mysqli_select_db( $database, "finaldb" ) )
		die( "Could not open products database </body></html>" );
	
	#2
	// query auth database
	$query = "INSERT INTO auth (userid, username, password, firstName, lastName, email, phone) VALUES ('', '$username', '$password', '$firstname', '$lastname', '$email', '$phone')";
	#3
	if ( !( $result = mysqli_query( $database,$query ) ) ){
		print( "<p>Could not execute query!</p>" );
		die( mysqli_error($database) . "</body></html>" );
	} 
	else print( "<p>you are registered now<p>" );//#4

	showTable($database); //#6
	mysqli_close( $database );

	function showTable($database){
		$query = "SELECT firstName,lastName  FROM auth";
		print ("<table> <th>First Name</th> <th>Last Name</th>");
		if ( !( $result = mysqli_query( $database,$query ) ) ){
			print( "<p>Could not execute query!</p>" );
			die( mysqli_error($database) . "</body></html>" );
		} 
		else{
			while ( $row = mysqli_fetch_row( $result ) ){
				print( "<tr>" );
				foreach ( $row as $value )
					print( "<td>$value</td>" );
				print( "</tr>" );
			}
		}
		print ("</table>");
	}
}




?>