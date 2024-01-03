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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

	<title>Physics Calculator</title>

</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="home.php" style="font-size: 30px;">Physics Calculator</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="home.php">Home</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

	<div class="container d-flex align-items-center justify-content-center">
		<div class="row" style="background-color:#ffffff;">
			<?php
			// Assuming $conn is your SQL Server connection
			$sql = "SELECT NumeRamura FROM Ramura";
			$rezultat = sqlsrv_query($conn, $sql);

			if ($rezultat === false) {
				die(print_r(sqlsrv_errors(), true)); // Check for SQL errors
			}

			while ($row = sqlsrv_fetch_array($rezultat, SQLSRV_FETCH_ASSOC)) {
				$numeRamura = $row['NumeRamura'];
				$link = str_replace(' ', '', $numeRamura) . '.php'; // Generating the link based on the subject

				$classes = 'col-lg-6 col-sm-12 btn btn-primary btn-dark btn-outline-light';
				if ($numeRamura === 'Fizica Cuantica') {
					$classes = 'col-sm-12 btn btn-primary btn-dark btn-outline-light';
				}

				echo '<a href="' . $link . '" class="' . $classes . '" style="font-size: calc(1.525rem + 3vw);">' . $numeRamura . '</a>';
			}
			?>

		</div>
	</div>

	<!--<div class="TabelFor" id="Mecanica">
		<h2 style="text-align:center;"> Mecanică </h2>

			<h3>Legea vitezei v = &Delta;d / &Delta;t</h3>
			
				Viteza: <input id="vitezacorp"> m/s <br>
				Distanța: <input id="distantaparcursa"> m<br>
				Timp: <input id="timpcorp"> s<br>

			<h3>Densitatea &rho; = m / V</h3>

				Densitatea: <input id="densitateacorpului"> Kg/m<sup>3</sup> <br>
				Masa: <input id="masacorp"> Kg<br>
				Volumul: <input id="volumcorp"> m<sup>3</sup> (1000L) <br>
                         
			<h3>Greutatea G = m / g</h3>

				Greutatatea: <input id="greutatateacorpului"> N <br>
				Masa: <input id="masaG"> Kg <br>
				Accelerația gravitatională: <input id="accgravitationala"> m/s<sup>2</sup> <br>

			<h3>Forța de frecare F<sub>f</sub> = &mu; * N</h3>

				Forța de frecare: <input id="ffcorp"> N <br>
				Normala la suprafata: <input id="normalaF"> N <br>
				Coeficientul de frecare: <input id="cfcorp"> <br>

			<h3>Forța elastică F<sub>e</sub> = -k * &Delta;l</h3>

				Forța elastică: <input id="Fe"> N <br>
				Alungirea barei: <input id="deltal"> m <br>
				Constanta elastică: <input id="k"> N/m <br>

		<br><br>
		<button onclick="MECANICA();" id="buton1">Calculează</button>

		<p id="rezultat"></p>
		<p id="rezultat1"></p>
		<p id="rezultat2"></p>
		<p id="rezultat3"></p>
		<p id="rezultat4"></p>



	</div>


	<br>


	<div class="TabelFor" id="Electricitate">
		<h2 style="text-align:center;"> Electricitate </h2>

			<h3>Formula intensității I = Q / &Delta;t</h3>

				Intensitate: <input id="intensitate"> A <br>
				Sarcina electrică: <input id="Q"> C <br>
				Intervalul de timp: <input id="deltat"> s <br>

			<h3>Sarcina electrică Q = n * E</h3>

				Sarcina electrică: <input id="Q1"> C <br>
				Numărul de electroni: <input id="nrelectroni"> <br>
				e = 1.6 * 10<sup>-19</sup>

			<h3>Legea lui Ohm pe porțiune de circuit I = U / R</h3>

				Intensitate: <input id="intensitateOhm"> A <br>
				Tensiunea electrică: <input id="U"> V <br>
				Rezistența electrică a circuitului exterior: <input id="R"> &Omega; <br>

			<h3>Intensitatea de scurtcircuit I<sub>sc</sub> = E / r</h3>

				Intensitatea de scurtcircuit: <input id="Intensitateasc"> A <br>
				Tensiunea electromotoare: <input id="E"> V <br>
				Rezistența electrică a circuitului interior: <input id="r"> &Omega; <br>

			<h3>Puterea electrică P = U * I</h3>

				Puterea electrică: <input id="P"> W <br>
            	Tensiunea electrică: <input id="Putere-U"> V <br>
            	Intensitate: <input id="Putere-intensitate"> A <br>

			<h3>Puterea totală P<sub>t</sub> = E * I</h3>

				Puterea totală: <input id="Pt"> W <br>
				Tensiunea electromotoare: <input id="Puterea totala-E"> V <br>
				Intensitate: <input id="Puterea totala-intensitate"> A <br>

			<h3>Randament &eta; = U / E</h3>	

				Randament: <input id="randament"><br>
				Tensiunea electromotoare: <input id="randament-E"> V <br>
				Tensiunea electrică: <input id="randament-U"> V <br>

		<br><br>
		<button onclick="ELECTRICITATE();" id="buton2">Calculează</button>

				<p id="rezultat5"></p>
				<p id="rezultat6"></p>
				<p id="rezultat7"></p>
				<p id="rezultat8"></p>
				<p id="rezultat9"></p>
				<p id="rezultat10"></p>
				<p id="rezultat11"></p>

			</div>-->

	<br><br><br>



</body>

</html>