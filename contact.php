<?php
include("../connection.php") ?>

<!DOCTYPE html>
<html>


<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript" src="JavaScript/javascript.js"></script>
	<script src="https://code.jquery.com/jquery-2.1.0.js"></script>
	<link rel="stylesheet" href="CSS/Inheritance.css">
	<link rel="stylesheet" href="CSS/styles.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
		integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
		integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
		crossorigin="anonymous"></script>

	<title>Physics Calculator</title>

</head>

<body>

	<!-- <div class="header">
		<a href="../home.html" class="logo">Physics Calculator</a>
		<div class="header-right">
			<a class="active" href="../home.html">Home</a>
			<a href="../contact.html">Contact</a>
			<a href="../about.html">About</a>
		</div>
	</div> -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="../home.html" style="font-size: 30px;">Physics Calculator</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
				data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="home.php">Home</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
							data-bs-toggle="dropdown" aria-expanded="false">
							Ramuri
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<?php
							// Assuming $conn is your SQL Server connection
							$sql = "SELECT NumeRamura FROM Ramura";
							$rezultat = sqlsrv_query($conn, $sql); // Use sqlsrv_query for SQL Server

							if ($rezultat === false) {
								die(print_r(sqlsrv_errors(), true)); // Check for SQL errors
							}

							while ($row = sqlsrv_fetch_array($rezultat, SQLSRV_FETCH_ASSOC)) {
								$numeRamura = $row['NumeRamura'];
								$link = str_replace(' ', '', $numeRamura) . '.php'; // Generating the link based on the subject
								echo '<li><a class="dropdown-item" href="' . $link . '">' . $numeRamura . '</a></li>';
							}

							sqlsrv_free_stmt($rezultat); // Free the statement resources
							?>
						</ul>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Tools
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a a class="dropdown-item" href="probleme.php">Probleme rezolvate</a>
						<a class="dropdown-item" href="fizician.php">Fizicieni</a>
						<a class="dropdown-item" href="clase.php">Filtrare pe clase a fundamentelor</a>
						<a class="dropdown-item" href="cautareAn.php">Filtrare avansată în funcție de an a fizicienilor</a>
						<a class="dropdown-item" href="cautareRamura.php">Filtrare a fizicienilor pe rammuri</a>
						<a class="dropdown-item" href="cautareCapitol.php">Filtrare a fundamentelor pe capitole</a>
						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Contact</a>
					</li>
					<!-- <li class="nav-item">
				<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
			  </li> -->
				</ul>
				<form class="d-flex">
					<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success" type="submit">Search</button>
				</form>
			</div>
		</div>
	</nav>


</body>

</html>