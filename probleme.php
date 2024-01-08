<?php
include("../connection.php");

$errorInsert = $errorDelete = $errorUpdate = '';

// Verificare și execuție pentru inserare
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitInsert'])) {
    $enuntProb = $_POST['enuntProb'];
    $rezProb = $_POST['rezProb'];

    if (!empty($enuntProb) && !empty($rezProb)) {
        $sqlInsert = "INSERT INTO ProblemaRezolvata (EnuntProb, RezProb) VALUES (?, ?)";
        $paramsInsert = array($enuntProb, $rezProb);

        $stmtInsert = sqlsrv_query($conn, $sqlInsert, $paramsInsert);

        if ($stmtInsert === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            header("Location: probleme.php");
        }

        sqlsrv_free_stmt($stmtInsert);
        sqlsrv_close($conn);
    } else {
        $errorInsert = "Te rugăm să completezi atât enunțul cât și rezolvarea problemei pentru a putea efectua inserarea.";
    }
}

// Verificare și execuție pentru ștergere
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitDelete'])) {
    $enuntProb = $_POST['deleteEnuntProb'];

    if (!empty($enuntProb)) {
        $sqlDelete = "DELETE FROM ProblemaRezolvata WHERE EnuntProb = ?";
        $paramsDelete = array($enuntProb);

        $stmtDelete = sqlsrv_query($conn, $sqlDelete, $paramsDelete);

        if ($stmtDelete === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            header("Location: probleme.php");
        }

        sqlsrv_free_stmt($stmtDelete);
        sqlsrv_close($conn);
    } else {
        $errorDelete = "Te rugăm să completezi enunțul problemei pentru a putea efectua ștergerea.";
    }
}

// Verificare și execuție pentru update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitUpdate'])) {
    $currentEnuntProb = $_POST['currentEnuntProb'];
    $newEnuntProb = $_POST['newEnuntProb'];
    $newRezProb = $_POST['newRezProb'];

    if (!empty($currentEnuntProb) && (!empty($newEnuntProb) || !empty($newRezProb))) {
        $updateFields = array();
        $params = array();

        if (!empty($newEnuntProb)) {
            $updateFields[] = "EnuntProb = ?";
            $params[] = $newEnuntProb;
        }

        if (!empty($newRezProb)) {
            $updateFields[] = "RezProb = ?";
            $params[] = $newRezProb;
        }

        $sqlUpdate = "UPDATE ProblemaRezolvata SET " . implode(", ", $updateFields) . " WHERE EnuntProb = ?";
        $params[] = $currentEnuntProb;

        $stmtUpdate = sqlsrv_query($conn, $sqlUpdate, $params);

        if ($stmtUpdate === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            header("Location: fizician.php");
        }

        sqlsrv_free_stmt($stmtUpdate);
        sqlsrv_close($conn);
    } else {
        $errorUpdate = "Te rugăm să completezi enunțul problemei curente și cel puțin un câmp pentru actualizare.";
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
            $sql = "SELECT PR.EnuntProb
            FROM ProblemaRezolvata PR";

            $rezultat = sqlsrv_query($conn, $sql);

            if ($rezultat === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            $index = 0;

            while ($row = sqlsrv_fetch_array($rezultat, SQLSRV_FETCH_ASSOC)) {
                $enuntProb = $row['EnuntProb'];
                $idTab = 'Problema_' . $index;

                echo '<li class="nav-item" role="presentation">';
                echo '<button class="nav-link border-white" id="' . $idTab . '-tab" data-bs-toggle="tab" data-bs-target="#' . $idTab . '" type="button" role="tab" aria-controls="' . $idTab . '" aria-selected="false" style="font-size: calc(1rem + 1.5vw);">';
                echo $enuntProb;
                echo '</button>';
                echo '</li>';

                $index++;
            }

            sqlsrv_free_stmt($rezultat);
            ?>

        </ul>

        <div class="tab-content" id="myTabContent" style="background-color:white">
            <?php
            $sql = "SELECT PR.EnuntProb, PR.RezProb
            FROM ProblemaRezolvata PR";

            $stmt = sqlsrv_query($conn, $sql);

            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            $index = 0;

            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $enuntProb = $row['EnuntProb'];
                $rezProb = $row['RezProb'];
                $rezProbFormatat = str_replace("//", "<br>", $rezProb);

                $idTab = 'Problema_' . $index;

                echo '<div class="tab-pane fade" id="' . $idTab . '" role="tabpanel" aria-labelledby="' . $idTab . '-tab">';
                echo "<h3>$enuntProb";
                echo "</h3>";
                echo "<p>$$ $rezProbFormatat $$</p>";
                echo '</div>';

                $index++;
            }

            sqlsrv_free_stmt($stmt);
            ?>
        </div>
    </div>

    <div class="container col-md-4 mt-5" style="background-color:#ffffff;">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h2>Adăugare Problemă Rezolvată</h2>
            <div class="form-group">
                <label for="enuntProb">Enunț Problemă:</label>
                <input type="text" class="form-control" id="enuntProb" name="enuntProb">
            </div>
            <div class="form-group">
                <label for="rezProb">Rezolvare Problemă:</label>
                <textarea class="form-control" id="rezProb" name="rezProb"></textarea>
            </div>
            <?php if (!empty($errorInsert)) : ?>
                <div class="alert alert-danger"><?php echo $errorInsert; ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary" name="submitInsert">Adaugă Problemă Rezolvată</button>
        </form>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h2>Ștergere Problemă Rezolvată</h2>
            <div class="form-group">
                <label for="deleteEnuntProb">Enunț Problemă:</label>
                <input type="text" class="form-control" id="deleteEnuntProb" name="deleteEnuntProb">
            </div>
            <?php if (!empty($errorDelete)) : ?>
                <div class="alert ale rt-danger"><?php echo $errorDelete; ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-danger" name="submitDelete">Șterge Problemă Rezolvată</button>
        </form>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h2>Actualizare Problemă Rezolvată</h2>
            <div class="form-group">
                <label for="currentEnuntProb">Enunț Problemă Curent:</label>
                <input type="text" class="form-control" id="currentEnuntProb" name="currentEnuntProb">
            </div>
            <div class="form-group">
                <label for="newEnuntProb">Noul Enunț Problemă:</label>
                <input type="text" class="form-control" id="newEnuntProb" name="newEnuntProb">
            </div>
            <div class="form-group">
                <label for="newRezProb">Noua Rezolvare Problemă:</label>
                <textarea class="form-control" id="newRezProb" name="newRezProb"></textarea>
            </div>
            <?php if (!empty($errorUpdate)) : ?>
                <div class="alert alert-warning"><?php echo $errorUpdate; ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-success" name="submitUpdate">Actualizează Problemă Rezolvată</button>
        </form>

    </div>


</body>

</html>