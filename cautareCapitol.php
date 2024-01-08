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

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="input-group mb-3 mt-3">
                <input type="text" class="form-control" placeholder="Introduceți parametrul variabil" aria-label="Introduceti clasa" name="parametruVariabil">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Trimite</button>
            </div>
        </form>

        <ul class="nav nav-tabs bg-dark nav-fill" id="myTab" role="tablist">
            <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $parametruVariabil = isset($_POST['parametruVariabil']) ? $_POST['parametruVariabil'] : null;

                if (isset($parametruVariabil) && !empty($parametruVariabil)) {

                    $parametruVariabil = htmlspecialchars($parametruVariabil);

                    $sql = "SELECT F.NumeFundament
                    FROM Fundament F
                    INNER JOIN Capitol C ON F.CapitolID = C.CapitolID
                    WHERE c.NumeCapitol = ?;";

                    $params = array($parametruVariabil);
                    $rezultat = sqlsrv_query($conn, $sql, $params);

                    if ($rezultat === false) {
                        die(print_r(sqlsrv_errors(), true));
                    }



                    while ($row = sqlsrv_fetch_array($rezultat, SQLSRV_FETCH_ASSOC)) {
                        $numeFundament = $row['NumeFundament'];
                        $idTab = strtolower(str_replace([' ', '(', ')'], '_', $numeFundament));
                        echo '<li class="nav-item" role="presentation">';
                        echo '<button class="nav-link border-white" id="' . $idTab . '-tab" data-bs-toggle="tab" data-bs-target="#' . $idTab . '" type="button" role="tab" aria-controls="' . $idTab . '" aria-selected="false" style="font-size: calc(1rem + 1.5vw);">';
                        echo $numeFundament;
                        echo '</button>';
                        echo '</li>';
                    }

                    sqlsrv_free_stmt($rezultat);
                } else {
                    echo '<p class="text-white">Vă rugăm introduceți un capitol corect pentru a genera fundamentele.</p>';
                }
            }

            ?>
        </ul>

        <div class="tab-content" id="myTabContent" style="background-color:white">
            <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $parametruVariabil = isset($_POST['parametruVariabil']) ? $_POST['parametruVariabil'] : null;

                if (isset($parametruVariabil) && !empty($parametruVariabil)) {
                    $parametruVariabil = htmlspecialchars($parametruVariabil);

                    $sql = "SELECT F.NumeFundament, F.DefinitieFundament, Fo.EcuatieFormula, Fo.UnitateMasura, C.NumeCapitol, F.AnAparitie, Fiz.NumeFizician, Fiz.PrenumeFizician
                    FROM Fundament F
                    LEFT JOIN Formula Fo ON F.FundamentID = Fo.FundamentID
                    LEFT JOIN Capitol C ON F.CapitolID = C.CapitolID
                    LEFT JOIN FizicianFundament FF ON F.FundamentID = FF.FundamentID
                    LEFT JOIN Fizician Fiz ON Fiz.FizicianID = FF.FizicianID
                    WHERE C.NumeCapitol = ?";

                    $params = array($parametruVariabil);
                    $rezultat = sqlsrv_query($conn, $sql, $params);

                    if ($rezultat === false) {
                        die(print_r(sqlsrv_errors(), true));
                    }

                    $fundamente = array();

                    while ($row = sqlsrv_fetch_array($rezultat, SQLSRV_FETCH_ASSOC)) {
                        $numeFundament = $row['NumeFundament'];

                        if (!isset($fundamente[$numeFundament])) {
                            $fundamente[$numeFundament] = array(
                                "detaliiFundament" => array(
                                    "definitie" => $row['DefinitieFundament'],
                                    "ecuatie" => $row['EcuatieFormula'],
                                    "unitate" => $row['UnitateMasura'],
                                    "anAparitie" => $row['AnAparitie']
                                ),
                                "fizicieni" => array()
                            );
                        }

                        if (!is_null($row['NumeFizician']) && !is_null($row['PrenumeFizician'])) {
                            $idFizician = $row['NumeFizician'] . '_' . $row['PrenumeFizician'];

                            if (!isset($fundamente[$numeFundament]["fizicieni"][$idFizician])) {
                                $fundamente[$numeFundament]["fizicieni"][$idFizician] = array(
                                    'nume' => $row['NumeFizician'],
                                    'prenume' => $row['PrenumeFizician']
                                );
                            }
                        }
                    }

                    foreach ($fundamente as $numeFundament => $detaliiFundament) {
                        $detalii = $detaliiFundament["detaliiFundament"];
                        $fizicieni = $detaliiFundament["fizicieni"];

                        $idTab = strtolower(str_replace([' ', '(', ')'], '_', $numeFundament));
                        echo '<div class="tab-pane fade" id="' . $idTab . '" role="tabpanel" aria-labelledby="' . $idTab . '-tab">';
                        echo "<h3>$numeFundament" . (!empty($detalii['anAparitie']) ? " (" . $detalii['anAparitie'] . ")" : "") . "</h3>";
                        echo "<p>" . $detalii['definitie'] . "</p>";

                        if (!is_null($detalii['ecuatie']) && !is_null($detalii['unitate'])) {
                            echo "<p>$$" . $detalii['ecuatie'] . "$$</p>";
                            echo "<p>Unitate de măsură: " . $detalii['unitate'] . "</p>";
                        } else {
                            echo "<p>Nu există formulă asociată acestui fundament.</p>";
                        }

                        if (!empty($fizicieni)) {
                            echo '<p>Fizicieni asociati: ';
                            $numFizicieni = count($fizicieni);
                            $counter = 0;
                            foreach ($fizicieni as $fizician) {
                                echo $fizician['nume'] . ' ' . $fizician['prenume'];
                                $counter++;
                                if ($counter !== $numFizicieni) {
                                    echo ', ';
                                }
                            }
                            echo '</p>';
                        }

                        echo '</div>';
                    }

                    sqlsrv_free_stmt($rezultat);
                }
            }
            ?>
        </div>
    </div>

</body>

</html>