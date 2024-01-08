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
							$sql = "SELECT NumeRamura FROM Ramura";
							$rezultat = sqlsrv_query($conn, $sql);

							if ($rezultat === false) {
								die(print_r(sqlsrv_errors(), true));
							}

							while ($row = sqlsrv_fetch_array($rezultat, SQLSRV_FETCH_ASSOC)) {
								$numeRamura = $row['NumeRamura'];
								$link = str_replace(' ', '', $numeRamura) . '.php';
								echo '<li><a class="dropdown-item" href="' . $link . '">' . $numeRamura . '</a></li>';
							}

							sqlsrv_free_stmt($rezultat);
							?>
						</ul>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Tools
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="capitole.php">Capitole</a>
							<a class="dropdown-item" href="probleme.php">Probleme rezolvate</a>
							<a class="dropdown-item" href="fizician.php">Fizicieni</a>
							<a class="dropdown-item" href="clase.php">Filtrare pe clase a fundamentelor</a>
							<a class="dropdown-item" href="cautareAn.php">Filtrare dupa an a fizicienilor</a>
							<a class="dropdown-item" href="cautareRamura.php">Filtrare a fizicienilor dupa ramuri</a>
							<a class="dropdown-item" href="cautareCapitol.php">Filtrare a fundamentelor pe capitole</a>
							<a class="dropdown-item" href="fundamenterecente.php">Cel mai recent fundament pentru fiecare ramura</a>
							<a class="dropdown-item" href="maxCapitole.php">Cel mai mare numar de capitole dintre ramuri</a>
							<a class="dropdown-item" href="nrLegiTeorii.php">Numar Legi/Teorii pentru fiecare ramura</a>
							<a class="dropdown-item" href="NoiFundament.php">Fizicienii celui mai recent fundament pe ramura</a>
						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="contact.php">Contact</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<ul class="nav nav-tabs bg-dark nav-fill" id="myTab" role="tablist">
			<?php
			$sql = "SELECT R.NumeRamura
            FROM Ramura R
            INNER JOIN Capitol C ON R.RamuraID = C.RamuraID
            INNER JOIN Fundament F ON C.CapitolID = F.CapitolID
            WHERE F.AnAparitie IN (
                SELECT MAX(Fu.AnAparitie) AS UltimulAn
                FROM Fundament Fu
                JOIN Capitol Ca ON Fu.CapitolID = Ca.CapitolID
                WHERE Ca.RamuraID = C.RamuraID
            );";
			$rezultat = sqlsrv_query($conn, $sql);

			if ($rezultat === false) {
				die(print_r(sqlsrv_errors(), true));
			}

			while ($row = sqlsrv_fetch_array($rezultat, SQLSRV_FETCH_ASSOC)) {
				$numeRamura = $row['NumeRamura'];
				$idTab = strtolower(str_replace([' ', '(', ')'], '_', $numeRamura));

				echo '<li class="nav-item" role="presentation">';
				echo '<button class="nav-link border-white" id="' . $idTab . '-tab" data-bs-toggle="tab" data-bs-target="#' . $idTab . '" type="button" role="tab" aria-controls="' . $idTab . '" aria-selected="false" style="font-size: calc(1rem + 1.5vw);">';
				echo $numeRamura;
				echo '</button>';
				echo '</li>';
			}

			sqlsrv_free_stmt($rezultat);
			?>
		</ul>

		<div class="tab-content" id="myTabContent" style="background-color:white">
			<?php
			$sql = "SELECT R.NumeRamura, C.NumeCapitol, F.NumeFundament, F.AnAparitie
            FROM Ramura R
            INNER JOIN Capitol C ON R.RamuraID = C.RamuraID
            INNER JOIN Fundament F ON C.CapitolID = F.CapitolID
            WHERE F.AnAparitie IN (
                SELECT MAX(Fu.AnAparitie) AS UltimulAn
                FROM Fundament Fu
                JOIN Capitol Ca ON Fu.CapitolID = Ca.CapitolID
                WHERE Ca.RamuraID = C.RamuraID
            );";

			$stmt = sqlsrv_query($conn, $sql);

			if ($stmt === false) {
				die(print_r(sqlsrv_errors(), true));
			}


			while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
				$numeFundament = $row['NumeFundament'];
				$numeCapitol = $row['NumeCapitol'];
				$anAparitie = $row['AnAparitie'];
				$numeRamura = $row['NumeRamura'];

				$idTab = strtolower(str_replace([' ', '(', ')'], '_', $numeRamura));

				echo '<div class="tab-pane fade" id="' . $idTab . '" role="tabpanel" aria-labelledby="' . $idTab . '-tab">';
				echo "<h3>$numeRamura</h3>";
				echo "<h3>$numeCapitol - $numeFundament ($anAparitie)</h3>";


				echo '</div>';
			}

			sqlsrv_free_stmt($stmt);
			?>
		</div>
	</div>
</body>

</html>