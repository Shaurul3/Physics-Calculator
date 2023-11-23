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
						<a class="nav-link active" aria-current="page" href="../home.html">Home</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
							data-bs-toggle="dropdown" aria-expanded="false">
							Capitole
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item" href="Mecanica.html">Mecanică</a></li>
							<li><a class="dropdown-item" href="Electricitate.html">Electricitate</a></li>
							<li><a class="dropdown-item" href="Termodinamica.html">Termodinamică</a></li>
							<li><a class="dropdown-item" href="Optica.html">Optică</a></li>
							<!-- <li><hr class="dropdown-divider"></li>
				  <li><a class="dropdown-item" href="#">Something else here</a></li>-->
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
			<li class="nav-item" role="presentation">
				<button class="nav-link border-white" id="mecanica-tab" data-bs-toggle="tab" data-bs-target="#mecanica" type="button"
					role="tab" aria-controls="mecanica" aria-selected="true" style="font-size: calc(1.525rem + 2vw);">Legea vitezei</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link border-white" id="densitate-tab" data-bs-toggle="tab" data-bs-target="#densitate"
					type="button" role="tab" aria-controls="densitate" aria-selected="false" style="font-size: calc(1.525rem + 2vw);">Densitatea</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link border-white" id="greutate-tab" data-bs-toggle="tab" data-bs-target="#greutate" type="button"
					role="tab" aria-controls="greutate" aria-selected="false" style="font-size: calc(1.525rem + 2vw);">Greutatea</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link border-white" id="fortaFrecare-tab" data-bs-toggle="tab" data-bs-target="#fortaFrecare"
					type="button" role="tab" aria-controls="fortafrecare" aria-selected="false" style="font-size: calc(1.525rem + 2vw);">Forta de
					frecare</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link border-white" id="fortaElastica-tab" data-bs-toggle="tab" data-bs-target="#fortaElastica"
					type="button" role="tab" aria-controls="fortaelastica" aria-selected="false" style="font-size: calc(1.525rem + 2vw);">Forta
					elastica</button>
			</li>
		</ul>
		<div class="tab-content" id="myTabContent"  style="background-color:white">
			<div class="tab-pane fade" id="mecanica" role="tabpanel" aria-labelledby="mecanica-tab">

				<h3>Legea vitezei v = &Delta;d / &Delta;t</h3>

				Viteza: <input id="vitezacorp"> m/s <br>
				Distanța: <input id="distantaparcursa"> m<br>
				Timp: <input id="timpcorp"> s

			</div>
			<div class="tab-pane fade" id="densitate" role="tabpanel" aria-labelledby="densitate-tab">

				<h3>Densitatea &rho; = m / V</h3>

				Densitatea: <input id="densitateacorpului"> Kg/m<sup>3</sup> <br>
				Masa: <input id="masacorp"> Kg<br>
				Volumul: <input id="volumcorp"> m<sup>3</sup> (1000L)

			</div>
			<div class="tab-pane fade" id="greutate" role="tabpanel" aria-labelledby="greutate-tab">

				<h3>Greutatea G = m / g</h3>

				Greutatatea: <input id="greutatateacorpului"> N <br>
				Masa: <input id="masaG"> Kg <br>
				Accelerația gravitatională: <input id="accgravitationala"> m/s<sup>2</sup>

			</div>
			<div class="tab-pane fade" id="fortaFrecare" role="tabpanel" aria-labelledby="fortaFrecare-tab">

				<h3>Forța de frecare F<sub>f</sub> = &mu; * N</h3>

				Forța de frecare: <input id="ffcorp"> N <br>
				Normala la suprafata: <input id="normalaF"> N <br>
				Coeficientul de frecare: <input id="cfcorp">

			</div>
			<div class="tab-pane fade" id="fortaElastica" role="tabpanel" aria-labelledby="fortaElastica-tab">

				<h3>Forța elastică F<sub>e</sub> = -k * &Delta;l</h3>

				Forța elastică: <input id="Fe"> N <br>
				Alungirea barei: <input id="deltal"> m <br>
				Constanta elastică: <input id="k"> N/m

			</div>
		</div>
	</div>
	</div>
	
</body>

</html>