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
	<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
	<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

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

	<div class="container">
		<ul class="nav nav-tabs bg-dark nav-fill" id="myTab" role="tablist">
			<?php
			// Conexiunea la baza de date ar trebui să fie stabilită aici

			// Query pentru a selecta numele din tabela 'Fundament'
			$sql = "SELECT F.NumeFundament 
					FROM Fundament F
					INNER JOIN Capitol C ON F.CapitolID = C.CapitolID
        			INNER JOIN Ramura R ON C.RamuraID = R.RamuraID
        			WHERE NumeRamura = 'Electricitate'";
			$rezultat = sqlsrv_query($conn, $sql);

			if ($rezultat === false) {
				die(print_r(sqlsrv_errors(), true));
			}

			while ($row = sqlsrv_fetch_array($rezultat, SQLSRV_FETCH_ASSOC)) {
				$numeFundament = $row['NumeFundament'];
				// Înlocuiește spațiile din numele fundației pentru a crea link-uri
				$link = str_replace(' ', '', $numeFundament) . '.php';
				$idTab = strtolower(str_replace([' ', '(', ')'], '_', $numeFundament)); // înlocuiește spațiile și parantezele cu _

				echo '<li class="nav-item" role="presentation">';
				echo '<button class="nav-link border-white" id="' . $idTab . '-tab" data-bs-toggle="tab" data-bs-target="#' . $idTab . '" type="button" role="tab" aria-controls="' . $idTab . '" aria-selected="false" style="font-size: calc(1rem + 1.5vw);">';
				echo $numeFundament;
				echo '</button>';
				echo '</li>';
			}

			sqlsrv_free_stmt($rezultat);
			// Închide conexiunea la baza de date după ce ai terminat de lucrat cu ea
			?>
		</ul>

		<div class="tab-content" id="myTabContent" style="background-color:white">
		<?php
			// Presupunând că ai deja o conexiune validă la baza de date

			// Interogare SQL pentru a obține toate numele și definițiile fundamentelor
			$sql = "SELECT F.NumeFundament, F.DefinitieFundament, Fo.EcuatieFormula, Fo.UnitateMasura, C.NumeCapitol, F.AnAparitie, Fiz.NumeFizician, Fiz.PrenumeFizician
    				FROM Fundament F
					LEFT JOIN Formula Fo ON F.FundamentID = Fo.FundamentID
					LEFT JOIN Capitol C ON F.CapitolID = C.CapitolID
					LEFT JOIN FizicianFundament FF ON F.FundamentID = FF.FundamentID
					LEFT JOIN Fizician Fiz ON Fiz.FizicianID = FF.FizicianID";

			$stmt = sqlsrv_query($conn, $sql);

			if ($stmt === false) {
				die(print_r(sqlsrv_errors(), true));
			}


			while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
				$numeFundament = $row['NumeFundament'];
				$definitieFundament = $row['DefinitieFundament'];
				$ecuatieFormula = $row['EcuatieFormula'];
				$unitateMasura = $row['UnitateMasura'];
				$numeCapitol = $row['NumeCapitol'];
				$anAparitie = $row['AnAparitie'];
				$numeFizician = $row['NumeFizician'];
				$prenumeFizician = $row['PrenumeFizician'];
			
				$idTab = strtolower(str_replace([' ', '(', ')'], '_', $numeFundament));
			
				echo '<div class="tab-pane fade" id="' . $idTab . '" role="tabpanel" aria-labelledby="' . $idTab . '-tab">';
				echo "<h3>$numeCapitol - $numeFundament" . (!empty($anAparitie) ? " ($anAparitie)" : "") . "</h3>";
				echo "<p>$definitieFundament</p>";
			
				if (!is_null($ecuatieFormula) && !is_null($unitateMasura)) {
					echo "<p>$$$ecuatieFormula$$</p>";
					echo "<p>Unitate de măsură: $unitateMasura</p>";
				} else {
					echo "<p>Nu există formulă asociată acestui fundament.</p>";
				}
			
				if (!is_null($numeFizician) && !is_null($prenumeFizician)) {
					echo "<p>Fizician asociat: $numeFizician $prenumeFizician</p>";
				}
			
				echo '</div>';

			}

			// Eliberarea resurselor
			sqlsrv_free_stmt($stmt);
			// Închiderea conexiunii la baza de date după terminarea lucrului cu ea
			?>
		</div>
	</div>

	<!-- <div class="container">
			<ul class="nav nav-tabs bg-dark nav-fill" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link border-white" id="formulaIntensitate-tab" data-bs-toggle="tab"
						data-bs-target="#formulaIntensitate" type="button" role="tab" aria-controls="formulaIntensitate"
						aria-selected="true" style="font-size: calc(1.525rem + 2vw);">Formula intensitatii</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link border-white" id="sarcinaElectrica-tab" data-bs-toggle="tab"
						data-bs-target="#sarcinaElectrica" type="button" role="tab" aria-controls="sarcinaElectrica"
						aria-selected="false" style="font-size: calc(1.525rem + 2vw);">Sarcina electrica</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link border-white" id="OhmPortiune-tab" data-bs-toggle="tab" data-bs-target="#OhmPortiune"
						type="button" role="tab" aria-controls="OhmPortiune" aria-selected="false" style="font-size: calc(1.525rem + 2vw);">Legea lui Ohm pe o
						portiune de circuit</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link border-white" id="scurtcircuit" data-bs-toggle="tab" data-bs-target="#scurtcircuit"
						type="button" role="tab" aria-controls="scurtcircuit" aria-selected="false" style="font-size: calc(1.525rem + 2vw);">Intensitatea de
						scurtcircuit</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link border-white" id="putereaElectrica-tab" data-bs-toggle="tab"
						data-bs-target="#putereaElectrica" type="button" role="tab" aria-controls="putereaElectrica"
						aria-selected="false" style="font-size: calc(1.525rem + 2vw);">Puterea Electrica</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link border-white" id="putereaTotala-tab" data-bs-toggle="tab" data-bs-target="#putereaTotala"
						type="button" role="tab" aria-controls="putereaTotala" aria-selected="false" style="font-size: calc(1.525rem + 2vw);">Puterea
						Totala</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link border-white" id="randament-tab" data-bs-toggle="tab" data-bs-target="#randament"
						type="button" role="tab" aria-controls="randament" aria-selected="false" style="font-size: calc(1.525rem + 2vw);">Randament</button>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent" style="background-color:white">
				<div class="tab-pane fade" id="formulaIntensitate" role="tabpanel"
					aria-labelledby="formulaIntensitate-tab">

					<h3>Formula intensității I = Q / &Delta;t</h3>

					Intensitate: <input id="intensitate"> A <br>
					Sarcina electrică: <input id="Q"> C <br>
					Intervalul de timp: <input id="deltat"> s

				</div>
				<div class="tab-pane fade" id="sarcinaElectrica" role="tabpanel" aria-labelledby="sarcinaElectrica-tab">

					<h3>Sarcina electrică Q = n * E</h3>

					Sarcina electrică: <input id="Q1"> C <br>
					Numărul de electroni: <input id="nrelectroni"> <br>
					e = 1.6 * 10<sup>-19</sup>

				</div>
				<div class="tab-pane fade" id="OhmPortiune" role="tabpanel" aria-labelledby="OhmPortiune-tab">

					<h3>Legea lui Ohm pe porțiune de circuit I = U / R</h3>

					Intensitate: <input id="intensitateOhm"> A <br>
					Tensiunea electrică: <input id="U"> V <br>
					Rezistența electrică a circuitului exterior: <input id="R"> &Omega;

				</div>
				<div class="tab-pane fade" id="scurtcircuit" role="tabpanel" aria-labelledby="scurtcircuit-tab">

					<h3>Intensitatea de scurtcircuit I<sub>sc</sub> = E / r</h3>

					Intensitatea de scurtcircuit: <input id="Intensitateasc"> A <br>
					Tensiunea electromotoare: <input id="E"> V <br>
					Rezistența electrică a circuitului interior: <input id="r"> &Omega;

				</div>
				<div class="tab-pane fade" id="putereaElectrica" role="tabpanel" aria-labelledby="putereaElectrica-tab">

					<h3>Puterea electrică P = U * I</h3>

					Puterea electrică: <input id="P"> W <br>
					Tensiunea electrică: <input id="Putere-U"> V <br>
					Intensitate: <input id="Putere-intensitate"> A

				</div>
				<div class="tab-pane fade" id="putereaTotala" role="tabpanel" aria-labelledby="putereaTotala-tab">

					<h3>Puterea totală P<sub>t</sub> = E * I</h3>

					Puterea totală: <input id="Pt"> W <br>
					Tensiunea electromotoare: <input id="Puterea totala-E"> V <br>
					Intensitate: <input id="Puterea totala-intensitate"> A

				</div>
				<div class="tab-pane fade" id="randament" role="tabpanel" aria-labelledby="randament-tab">

					<h3>Randament &eta; = U / E</h3>

					Randament: <input id="randament"><br>
					Tensiunea electromotoare: <input id="randament-E"> V <br>
					Tensiunea electrică: <input id="randament-U"> V

				</div>
			</div>
	</div> -->
</body>

</html>