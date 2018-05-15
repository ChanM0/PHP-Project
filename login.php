<!-- File login.php (25 pt)

Using php $_POST array, accesses the input values in "Log in" form.
The page:
1. Connects to the DB
2. Using a select query looks for a record in the DB which matches the entered value in "username" input box.
	3. If the record is found, checks if the password entered by the user matches the password stored in the record.
	4. If it is not a match displays an error message "Incorrect username or password."
	5. If it is a match, display a success message such as " Welcome back <username>! Login was successful". 
	6. Then display the user's firstname, lastname, email and phone in a table with headers.
-->

<?php 
	/*
	**	
	*/ 
	$username = null;
	$password = null;
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$username =  $_POST["username"];
		$password =  $_POST["password"];
	}

	if($username == null || $password ==null)
		die( "user or password can not be null </body></html>" );

	#1
	// Connect to MySQL
	if ( !( $database = mysqli_connect( "localhost","root", "" ) ) )
		die( "Could not connect to database </body></html>" );

	// open auth database
	if ( !mysqli_select_db( $database, "finaldb" ) )
		die( "Could not open products database </body></html>" );
	
	#2
	// query auth database
	$query = "SELECT username from auth where username = '$username'";


	if ( !( $result = mysqli_query( $database,$query ) ) ){ // checks if user exists
		print( "<p>Could not execute query!</p>" );
		die( mysqli_error($database) . "</body></html>" );
	} 
	else{ 
		#3
		// checks if username corresponds with password
		$query = "SELECT password from auth where username = '$username' AND password = '$password' ";	

		$result = mysqli_query( $database,$query );
		$count = mysqli_num_rows($result);

		if($count < 1){
			print( "<p>Incorrect username or password.</p>" );
			die( mysqli_error($database) . "</body></html>" );
		}

		#4
		if ( !( $result = mysqli_query( $database,$query ) ) ){  // fix this if statement when no input happens
			print( "<p>Incorrect username or password.</p>" );
			die( mysqli_error($database) . "</body></html>" );
		}
		#5 
		else{
			print( "<p>Welcome back $username! Login was successful!</p>" ); 
			showInfo($database,$username,$password); 
		}
	}


	mysqli_close( $database );

//prints in a table format
	function showInfo($database,$username,$password){
		$query = "SELECT  firstname,lastname,email,phone from auth where username = '$username' AND password = '$password'";
		print ("<table> <th>First Name</th> <th>Last Name</th> <th>Email</th> <th>Phone</th>");
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

	?>