<?php
include("../connection.php")
?>

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
						<a class="dropdown-item" href="cautareRamura.php">Filtrare a fizicienilor pe ramuri</a>
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

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Introduceți parametrul variabil" aria-label="Introduceti clasa" name="parametruVariabil">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Trimite</button>
            </div>
        </form>

        <ul class="nav nav-tabs bg-dark nav-fill" id="myTab" role="tablist">
            <?php
            // Verificare dacă parametrul variabil a fost trimis prin POST
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Verificare dacă parametrul variabil a fost trimis prin POST
                $parametruVariabil = isset($_POST['parametruVariabil']) ? $_POST['parametruVariabil'] : null;

                // Verificare dacă parametrul variabil este setat și nu este gol
                if (isset($parametruVariabil) && !empty($parametruVariabil)) {
                    // Evită SQL injection
                    $parametruVariabil = htmlspecialchars($parametruVariabil);


                    // Prepararea și executarea interogării SQL pentru a obține Ramurile
                    $sql = "SELECT fiz.NumeFizician, fiz.PrenumeFizician
                    FROM Fizician fiz
                    WHERE fiz.FizicianID IN (
                    SELECT ff.FizicianID
                    FROM FizicianFundament ff
                    INNER JOIN Fundament fu ON ff.FundamentID = fu.FundamentID
                    WHERE fu.AnAparitie > ?
                    );";
                    $params = array($parametruVariabil);
                    $rezultat = sqlsrv_query($conn, $sql, $params);

                    if ($rezultat === false) {
                        die(print_r(sqlsrv_errors(), true));
                    }

                    // Generarea butoanelor pentru taburi în funcție de rezultatele interogării
                    $index = 0;

                    while ($row = sqlsrv_fetch_array($rezultat, SQLSRV_FETCH_ASSOC)) {
                        $numeFizician = $row['NumeFizician'];
                        $prenumeFizician = $row['PrenumeFizician'];
                        $idTab = 'fizician_' . $index; // Aici poți folosi un ID unic bazat pe nume/prenume sau altceva

                        echo '<li class="nav-item" role="presentation">';
                        echo '<button class="nav-link border-white" id="' . $idTab . '-tab" data-bs-toggle="tab" data-bs-target="#' . $idTab . '" type="button" role="tab" aria-controls="' . $idTab . '" aria-selected="false" style="font-size: calc(1rem + 1.5vw);">';
                        echo $numeFizician . ' ' . $prenumeFizician;
                        echo '</button>';
                        echo '</li>';

                        $index++;
                    }

                    sqlsrv_free_stmt($rezultat);
                } else {
                    // Afișează un mesaj pentru introducerile lipsite sau greșite
                    echo '<p class="text-white">Vă rugăm introduceți clasa corect pentru a genera fundamentele.</p>';
                }
            }

            ?>
        </ul>

        <div class="tab-content" id="myTabContent" style="background-color:white">
            <?php
            // Presupunând că ai deja o conexiune validă la baza de date

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $parametruVariabil = isset($_POST['parametruVariabil']) ? $_POST['parametruVariabil'] : null;

                if (isset($parametruVariabil) && !empty($parametruVariabil)) {
                    $parametruVariabil = htmlspecialchars($parametruVariabil);

                    $sql = "SELECT Fiz.NumeFizician, Fiz.PrenumeFizician, F.NumeFundament, F.AnAparitie
                    FROM Fizician Fiz
                    INNER JOIN FizicianFundament FF ON Fiz.FizicianID = FF.FizicianID
                    INNER JOIN Fundament F ON FF.FundamentID = F.FundamentID
                    WHERE F.AnAparitie > ?";
                    $params = array($parametruVariabil);
                    $rezultat = sqlsrv_query($conn, $sql, $params);

                    if ($rezultat === false) {
                        die(print_r(sqlsrv_errors(), true));
                    }

                    $index = 0;

                    $fizicieni_si_fundamente = array(); // Array pentru a stoca informațiile pentru fiecare fizician

                    while ($row = sqlsrv_fetch_array($rezultat, SQLSRV_FETCH_ASSOC)) {
                        $numeFizician = $row['NumeFizician'];
                        $prenumeFizician = $row['PrenumeFizician'];
                        $numeFundament = $row['NumeFundament'];
                        $anAparitie = $row['AnAparitie'];

                        $numeComplet = $numeFizician . ' ' . $prenumeFizician;


                        // Verificăm dacă există deja informații pentru acest fizician în array-ul nostru
                        if (!isset($fizicieni_si_fundamente[$numeComplet])) {
                            $fizicieni_si_fundamente[$numeComplet] = array(); // Creăm o intrare pentru acest fizician
                        }

                        // Adăugăm informațiile despre fundament în array-ul fizicianului respectiv
                        $fizicieni_si_fundamente[$numeComplet][] = array(
                            "numeFundament" => $numeFundament,
                            "anAparitie" => $anAparitie
                        );
                    }

                    // Afisăm informațiile salvate în array pentru fiecare fizician
                    foreach ($fizicieni_si_fundamente as $numeComplet => $fundamente) {
                        $idTab = 'fizician_' . $index;
                        echo '<div class="tab-pane fade" id="' . $idTab . '" role="tabpanel" aria-labelledby="' . $idTab . '-tab">';
                        echo "<h3>$numeComplet</h3>";
                        foreach ($fundamente as $fundament) {
                            $numeFundament = $fundament['numeFundament'];
                            $anAparitie = $fundament['anAparitie'];
                            echo "<p>$numeFundament ($anAparitie)</p>";
                        }
                        echo "</div>";
                        $index++;
                    }

                    sqlsrv_free_stmt($rezultat);
                }
            }
            ?>
        </div>
    </div>

</body>

</html>