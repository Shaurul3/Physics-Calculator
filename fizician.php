<?php
include("../connection.php");

$errorInsert = $errorDelete = $errorUpdate = '';

// Verificare și execuție pentru inserare
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitInsert'])) {
    $numeFizician = $_POST['numeFizician'];
    $prenumeFizician = $_POST['prenumeFizician'];
    $scurtaIstorie = isset($_POST['scurtaIstorie']) ? $_POST['scurtaIstorie'] : '';

    if (!empty($numeFizician) && !empty($prenumeFizician)) {
        $sqlInsert = "INSERT INTO Fizician (NumeFizician, PrenumeFizician, SCurtaIstorie) VALUES (?, ?, ?)";
        $paramsInsert = array($numeFizician, $prenumeFizician, $scurtaIstorie);

        $stmtInsert = sqlsrv_query($conn, $sqlInsert, $paramsInsert);

        if ($stmtInsert === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            header("Location: fizician.php");
        }

        sqlsrv_free_stmt($stmtInsert);
        sqlsrv_close($conn);
    } else {
        $errorInsert = "Te rugăm să completezi macar numele și prenumele fizicianului pentru a putea efectua inserarea.";
    }
}

// Verificare și execuție pentru ștergere
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitDelete'])) {
    $numeFizician = $_POST['deleteNumeFizician'];
    $prenumeFizician = $_POST['deletePrenumeFizician'];

    // Verificare dacă datele necesare pentru ștergere sunt completate
    if (!empty($numeFizician) && !empty($prenumeFizician)) {
        $sqlDelete = "DELETE FROM Fizician WHERE NumeFizician = ? AND PrenumeFizician = ?";
        $paramsDelete = array($numeFizician, $prenumeFizician);

        $stmtDelete = sqlsrv_query($conn, $sqlDelete, $paramsDelete);

        if ($stmtDelete === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            header("Location: fizician.php");
        }

        sqlsrv_free_stmt($stmtDelete);
        sqlsrv_close($conn);
    } else {
        $errorDelete = "Te rugăm să completezi numele și prenumele fizicianului pentru a putea efectua inserarea.";
    }
}

// Verificare și execuție pentru update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitUpdate'])) {
    $currentNumeFizician = $_POST['currentNumeFizician'];
    $currentPrenumeFizician = $_POST['currentPrenumeFizician'];
    $newNumeFizician = $_POST['newNumeFizician'];
    $newPrenumeFizician = $_POST['newPrenumeFizician'];
    $newScurtaIstorie = $_POST['newScurtaIstorie'];

    if (!empty($currentNumeFizician) && !empty($currentPrenumeFizician)) {
        $updateFields = array();
        $params = array();

        if (!empty($newNumeFizician)) {
            $updateFields[] = "NumeFizician = ?";
            $params[] = $newNumeFizician;
        }

        if (!empty($newPrenumeFizician)) {
            $updateFields[] = "PrenumeFizician = ?";
            $params[] = $newPrenumeFizician;
        }

        if (!empty($newScurtaIstorie)) {
            $updateFields[] = "SCurtaIstorie = ?";
            $params[] = $newScurtaIstorie;
        }

        if (!empty($updateFields)) {
            $sqlUpdate = "UPDATE Fizician SET " . implode(", ", $updateFields) . " WHERE NumeFizician = ? AND PrenumeFizician = ?";
            $params[] = $currentNumeFizician;
            $params[] = $currentPrenumeFizician;

            $stmtUpdate = sqlsrv_query($conn, $sqlUpdate, $params);

            if ($stmtUpdate === false) {
                die(print_r(sqlsrv_errors(), true));
            } else {
                header("Location: fizician.php");
            }

            sqlsrv_free_stmt($stmtUpdate);
            sqlsrv_close($conn);
        } else {
            $errorUpdate = "Nu ai furnizat date noi pentru actualizare.";
        }
    } else {
        $errorUpdate = "Te rugăm să completezi câmpurile pentru numele și prenumele fizicianului curent.";
    }
}

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
            $sql = "SELECT Fiz.NumeFizician, Fiz.PrenumeFizician
            FROM Fizician Fiz";

            $rezultat = sqlsrv_query($conn, $sql);

            if ($rezultat === false) {
                die(print_r(sqlsrv_errors(), true));
            }

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
            // Închide conexiunea la baza de date după ce ai terminat de lucrat cu ea
            ?>

        </ul>

        <div class="tab-content" id="myTabContent" style="background-color:white">
            <?php
            // Presupunând că ai deja o conexiune validă la baza de date

            // Interogare SQL pentru a obține toate informațiile despre fizicieni
            $sql = "SELECT Fiz.NumeFizician, Fiz.PrenumeFizician, Fiz.ScurtaIstorie
            FROM Fizician Fiz";

            $stmt = sqlsrv_query($conn, $sql);

            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            $index = 0; // Resetăm indexul pentru a-l folosi pentru fiecare tab

            // Extrage datele din baza de date și afișează-le
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $numeFizician = $row['NumeFizician'];
                $prenumeFizician = $row['PrenumeFizician'];
                $scurtaIstorie = $row['ScurtaIstorie'];

                // Manipulează numele cu două prenume
                $numeComplet = $numeFizician . ' ' . $prenumeFizician; // Uneste cele două prenume

                $idTab = 'fizician_' . $index; // Aici poți folosi un ID unic bazat pe nume/prenume sau altceva

                // Afișează informațiile
                echo '<div class="tab-pane fade" id="' . $idTab . '" role="tabpanel" aria-labelledby="' . $idTab . '-tab">';
                echo "<h3>$numeComplet</h3>";
                echo "<p>$scurtaIstorie</p>";
                echo '</div>';

                $index++;
            }

            // Eliberarea resurselor
            sqlsrv_free_stmt($stmt);
            // Închiderea conexiunii la baza de date după terminarea lucrului cu ea
            ?>
        </div>
    </div>

    <div class="container col-md-4 mt-5" style="background-color:#ffffff;">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h2>Adăugare Fizician</h2>
    <div class="form-group">
        <label for="numeFizician">Nume Fizician:</label>
        <input type="text" class="form-control" id="numeFizician" name="numeFizician">
    </div>
    <div class="form-group">
        <label for="prenumeFizician">Prenume Fizician:</label>
        <input type="text" class="form-control" id="prenumeFizician" name="prenumeFizician">
    </div>
    <div class="form-group">
        <label for="scurtaIstorie">Scurtă Istorie:</label>
        <textarea class="form-control" id="scurtaIstorie" name="scurtaIstorie"></textarea>
    </div>
    <?php if (!empty($errorInsert)) : ?>
        <div class="alert alert-danger"><?php echo $errorInsert; ?></div>
    <?php endif; ?>
    <button type="submit" class="btn btn-primary" name="submitInsert">Adaugă Fizician</button>
</form>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h2>Ștergere Fizician</h2>
    <div class="form-group">
        <label for="deleteNumeFizician">Nume Fizician:</label>
        <input type="text" class="form-control" id="deleteNumeFizician" name="deleteNumeFizician">
    </div>
    <div class="form-group">
        <label for="deletePrenumeFizician">Prenume Fizician:</label>
        <input type="text" class="form-control" id="deletePrenumeFizician" name="deletePrenumeFizician">
    </div>
    <?php if (!empty($errorDelete)) : ?>
        <div class="alert alert-danger"><?php echo $errorDelete; ?></div>
    <?php endif; ?>
    <button type="submit" class="btn btn-danger" name="submitDelete">Șterge Fizician</button>
</form>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h2>Actualizare Fizician</h2>
    <div class="form-group">
        <label for="currentNumeFizician">Nume Fizician Curent:</label>
        <input type="text" class="form-control" id="currentNumeFizician" name="currentNumeFizician">
    </div>
    <div class="form-group">
        <label for="currentPrenumeFizician">Prenume Fizician Curent:</label>
        <input type="text" class="form-control" id="currentPrenumeFizician" name="currentPrenumeFizician">
    </div>
    <div class="form-group">
        <label for="newNumeFizician">Nume Fizician Nou:</label>
        <input type="text" class="form-control" id="newNumeFizician" name="newNumeFizician">
    </div>
    <div class="form-group">
        <label for="newPrenumeFizician">Prenume Fizician Nou:</label>
        <input type="text" class="form-control" id="newPrenumeFizician" name="newPrenumeFizician">
    </div>
    <div class="form-group">
        <label for="newScurtaIstorie">Scurtă Istorie Nouă:</label>
        <textarea class="form-control" id="newScurtaIstorie" name="newScurtaIstorie"></textarea>
    </div>
    <?php if (!empty($errorUpdate)) : ?>
        <div class="alert alert-warning"><?php echo $errorUpdate; ?></div>
    <?php endif; ?>
    <button type="submit" class="btn btn-success" name="submitUpdate">Actualizează Informații</button>
</form>
    </div>


</body>

</html>