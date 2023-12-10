<?php

require_once("../../Controller/Controller.php");
class View
{
    private function Head()
    {
        ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css.css">
    <script src="../../jQuery.js"></script>
    <script src="js.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/0e253a6280.js" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<?php
    }
    private function Header()
    {
        session_start();
        if (isset($_GET["deconnexion"])) {
            if ($_GET['deconnexion'] == true) {
                session_unset();
                header("location: ../Page_Acceuil/index.php");
            }
        } else if (isset($_SESSION["name"])) {
            $user = $_SESSION['name'];
            $id = $_SESSION['id'];
        }
        ?>
<header>
    <div class="container bg-dark mt-2">
        <img style="height:30px;width:100px;margin:20px;" alt="Logo" src="../../Images/logo.png">

        <div class="container d-inline">
            <a href="http://facebook.com"><i class="fa-brands fa-square-facebook fa-2xl"
                    style="color:white;margin-left:30%"></i></a>
            <i class=""></i>

            <a href="http://instagram.com"><i class="fa-brands fa-square-instagram fa-2xl"
                    style="color:white;height:30px"></i></a>
            <a href="http://youtube.com"><i class="fa-brands fa-square-youtube fa-2xl" style="color:white"></i></a>
        </div>

        <div class="container d-inline">
            <?php
                    if (isset($_SESSION['name'])) {
                        echo "<a href='../Page_Acceuil/index.php?deconnexion=true' class='btn btn-secondary pull-right mt-3' style='margin-left:2px;'> Out </a>";
                        echo "<a href='../Page_Profil/index.php?id=" . $_SESSION['id'] . "' class='btn btn-primary pull-right mt-3'>" . $_SESSION['name'] . "</a>";
                    } else {
                        echo "<a href='../Page_Connexion/index.php' class='btn btn-secondary pull-right mt-3' style='margin-left:2px;'> S'inscrire </a>";
                        echo "<a href='../Page_Connexion/index.php' class='btn btn-primary pull-right mt-3'>Se connecter</a>";
                    }

                    ?>

        </div>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="collapse navbar-collapse sticky-top" id="navbarTogglerDemo01">
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                    <li class="nav-item li_nav">
                        <a class="nav-link" href="../Page_Acceuil/index.php">Acceuil</a>
                    </li>
                    <li class="nav-item li_nav">
                        <a class="nav-link" href="../Page_News/index.php">News</a>
                    </li>
                    <li class="nav-item li_nav">
                        <a class="nav-link" href="../Page_IdeesRecette/index.php">Idées de recettes</a>
                    </li>
                    <li class="nav-item li_nav">
                        <a class="nav-link" href="../Page_Healthy/index.php">Healthy</a>
                    </li>
                    <li class="nav-item li_nav">
                        <a class="nav-link" href="../Page_Saisons/index.php">Saisons</a>
                    </li>
                    <li class="nav-item li_nav">
                        <a class="nav-link" href="../Page_Fetes/index.php">Fêtes</a>
                    </li>
                    <li class="nav-item li_nav">
                        <a class="nav-link" href="../Page_Nutrition/index.php">Nutrition</a>
                    </li>
                    <li class="nav-item li_nav">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<?php
    }

    private function Diaporama($diapo)
    {
        ?>
<div class="container mt-4">
    <div id="carouselExampleIndicators" class="carousel slide diapo w-75 mx-auto" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <?php
                    $i = 0;
                    foreach ($diapo[1] as $news) {
                        if ($i == 0) {
                            echo "<li data-bs-target='#carouselExampleIndicators' class='active' data-bs-slide-to='" . $i . "'></li>";
                        } else {
                            echo "<li data-bs-target='#carouselExampleIndicators' data-bs-slide-to='" . $i . "'></li>";
                        }
                        $i++;

                    }
                    foreach ($diapo[0] as $recette) {
                        if ($i == 0) {
                            echo "<li data-bs-target='#carouselExampleIndicators' class='active' data-bs-slide-to='" . $i . "'></li>";
                        } else {
                            echo "<li data-bs-target='#carouselExampleIndicators' data-bs-slide-to='" . $i . "'></li>";
                        }
                        $i++;
                    }
                    ?>
        </ol>
        <div class="carousel-inner">
            <?php
                    $i = 0;
                    foreach ($diapo[1] as $news) {
                        if ($i == 0) {
                            echo "<div class='carousel-item active'>
                    <a href='../../Routeurs/Page_News2/index.php?id_news=" . $news["Id_news"] . "'><img class='w-100' src='" . $news["Image_news"] . "'></a>
                </div>";
                        } else {
                            echo "<div class='carousel-item'>
                    <a href='../../Routeurs/Page_News2/index.php?id_news=" . $news["Id_news"] . "'><img class='w-100' src='" . $news["Image_news"] . "'></a>
                </div>";
                        }
                        $i++;
                    }
                    foreach ($diapo[0] as $recette) {
                        if ($i == 0) {
                            echo "<div class='carousel-item active'>
                    <a href='../../Routeurs/Page_Recette/index.php?id_recette=" . $recette["Id_recette"] . "'><img class='w-100' src='" . $recette["Image_recette"] . "'></a>
                </div>";
                        } else {
                            echo "<div class='carousel-item'>
                    <a href='../../Routeurs/Page_Recette/index.php?id_recette=" . $recette["Id_recette"] . "'><img class='w-100' src='" . $recette["Image_recette"] . "'></a>
                </div>";
                        }
                        $i++;
                    }
                    ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only"></span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only"></span>
        </a>
    </div>
</div>
<?php
    }

    private function Cadre($recette)
    {
        ?>
<div class="container rounded bg-light col-sm3 mt-2 mb-5 cadre">
    <br>
    <?php
            $titre = $recette["Nom_recette"];
            $description = $recette["Description_recette"];
            $image = $recette["Image_recette"];
            $id = $recette["Id_recette"];
            ?>
    <img src="<?php
            echo $image
                ?>" class="rounded d-block w-100" alt="Image de la recette" style="width:200px;height:150px">
    <div class="container">
        <h4>
            <?php
                    echo $titre
                        ?>
        </h4>
        <p><?php
                if (strlen($description) > 50) {
                    echo substr($description, 0, 50) . " ...";
                } else {
                    echo substr($description, 0, 50);
                }

                ?></p>
        <div class="row">
            <form class="col" action="../Page_Recette/index.php" method="get">
                <input type="text" value=" <?php
                        echo $id
                            ?>" name="id_recette" hidden>

                <a class="btn btn-secondary pull-right" target="_blank" href="../Page_Recette/index.php?id_recette=<?php
                        echo $id
                            ?>">Suite</a>
            </form>
        </div>
    </div>
</div>
<?php
    }

    private function Cadre_Profil($recette)
    {
        ?>
<div class="container rounded bg-light col-sm3 mt-2 mb-5 cadre">
    <br>
    <?php
            $titre = $recette["Nom_recette"];
            $description = $recette["Description_recette"];
            $image = $recette["Image_recette"];
            $id = $recette["Id_recette"];
            ?>
    <img src="<?php
            echo $image
                ?>" class="rounded d-block w-100" alt="Image de la recette" style="width:200px;height:150px">
    <div class="container">
        <h4>
            <?php
                    echo $titre
                        ?>
        </h4>
        <p><?php
                if (strlen($description) > 50) {
                    echo substr($description, 0, 50) . " ...";
                } else {
                    echo substr($description, 0, 50);
                }

                ?></p>
        <div class="row">
            <form class="col" action="../Page_Recette/index.php" method="get">
                <input type="text" value=" <?php
                        echo $id
                            ?>" name="id_recette" hidden>

                <?php
                        if ($recette["Valide_recette"] == 1) {
                            echo "<a class='btn btn-secondary' target='_blank' href='../Page_Recette/index.php?id_recette=" . $id . "' style='text-align: right;'>Suite</a>";
                            echo "<button class='btn btn-success pull-right' style='text-align: right;' disabled>Valide</button>";
                        } else {
                            echo "<button class='btn btn-secondary' style='text-align: right;' disabled>Suite</button>";
                            echo "<button class='btn btn-danger pull-right' style='text-align: right;' disabled>Non valide</button>";
                        }
                        ?>
            </form>
        </div>
    </div>
</div>
<?php
    }

    private function Cadre_avecNotation($recette)
    {
        ?>
<div class="container rounded bg-light col-sm3 mt-2 mb-5 cadre">
    <br>
    <?php
            $titre = $recette["Nom_recette"];
            $description = $recette["Description_recette"];
            $image = $recette["Image_recette"];
            $id = $recette["Id_recette"];
            $note = $recette["moyenne"];
            ?>
    <img src="<?php
            echo $image
                ?>" class="rounded d-block w-100" alt="Image de la recette" style="width:200px;height:150px">
    <div class="container">
        <h4>
            <?php
                    echo $titre
                        ?>
        </h4>
        <p><?php
                if (strlen($description) > 50) {
                    echo substr($description, 0, 50) . " ...";
                } else {
                    echo substr($description, 0, 50);
                }

                ?></p>
        <form action="../Page_Recette/index.php" method="get">
            <input type="text" value=" <?php
                    echo $id
                        ?>" name="id_recette" hidden>
            <a class="btn btn-secondary pull-right" target="_blank" href="../Page_Recette/index.php?id_recette=<?php
                    echo $id
                        ?>">Suite</a>
        </form>
        <p>
            <?php
                    echo "Note : " . $note
                        ?>
        </p>
        <form action="../Page_Profil/index.php">
            <input type="text" value=" <?php
                    echo $_GET["id"]
                        ?>" name="id" class="col-3" hidden>
            <input type="text" value=" <?php
                    echo $id
                        ?>" name="id_recette_enlev" class="col-3" hidden>
            <button class="btn btn-secondary" style="text-align: right;" id="enlever">Enlever des favoris</button>
        </form>
    </div>
</div>
<?php
    }

    private function Cadre_news($news)
    {
        $description = $news["Description_news"];
        ?>

<div class="container rounded bg-secondary col-sm3 mt-2 mb-5 cadre">
    <br>
    <img src=" <?php
            echo $news["Image_news"]
                ?>" class="rounded d-block w-100" alt=" Image de la recette" style="width:200px;height:150px">
    <div class="container">
        <h4>
            <?php
                    echo $news["Titre_news"]
                        ?>
        </h4>
        <p><?php
                if (strlen($description) > 50) {
                    echo substr($description, 0, 50) . ' ...';
                } else {
                    echo substr($description, 0, 50);
                }
                ?></p>
        <form class="col" action="../Page_News2/index.php" method="get">
            <input type="text" value=" <?php
                    echo $news["Id_news"];
                    ?>" name="id_news" hidden>

            <a class="btn btn-primary pull-right" target="_blank" href="../Page_News2/index.php?id_news=<?php
                    echo $news["Id_news"]
                        ?>">Suite</a>
        </form>
    </div>
</div>
<?php
    }

    private function Categorie($titre, $data)
    {
        ?>
<div class="container mx-auto mt-4">
    <a href="<?php
            switch ($titre) {
                case "Entrées":
                    echo "../Page_Categorie/index.php?categorie=1";
                    break;
                case "Plats":
                    echo "../Page_Categorie/index.php?categorie=2";
                    break;
                case "Desserts":
                    echo "../Page_Categorie/index.php?categorie=3";
                    break;
                case "Boissons":
                    echo "../Page_Categorie/index.php?categorie=4";
                    break;
            }
            ?>">
        <h2 class="text-center">
            <?php
                    echo $titre;
                    ?>
        </h2>
    </a>
</div>
<div class="container">
    <div id="carouselCategorie<?php
            echo $titre;
            ?>" class="carousel slide diapo bg-dark" data-bs-interval="false">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselCategorie<?php
                    echo $titre;
                    ?>" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselCategorie<?php
                    echo $titre;
                    ?>" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselCategorie<?php
                    echo $titre;
                    ?>" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row w-75 mx-auto">
                    <?php
                            if (count($data) >= 4) {
                                for ($i = 0; $i < 4; $i++) {
                                    $recette = $data[$i];
                                    $this->Cadre($recette);
                                }
                            } else {
                                for ($i = 0; $i < count($data); $i++) {
                                    $recette = $data[$i];
                                    $this->Cadre($recette);
                                }
                            }

                            ?>
                </div>

            </div>
            <div class="carousel-item">
                <div class="row w-75 mx-auto">
                    <?php
                            if (count($data) >= 8) {
                                for ($i = 4; $i < 8; $i++) {
                                    $recette = $data[$i];
                                    $this->Cadre($recette);
                                }
                            } else {
                                for ($i = 4; $i < count($data); $i++) {
                                    $recette = $data[$i];
                                    $this->Cadre($recette);
                                }
                            }
                            ?>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row w-75 mx-auto">
                    <?php
                            if (count($data) >= 10) {
                                for ($i = 8; $i < 10; $i++) {
                                    $recette = $data[$i];
                                    $this->Cadre($recette);
                                }
                            } else {
                                for ($i = 8; $i < count($data); $i++) {
                                    $recette = $data[$i];
                                    $this->Cadre($recette);
                                }
                            }
                            ?>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselCategorie<?php
                echo $titre;
                ?>" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only"></span>
        </a>
        <a class="carousel-control-next" href="#carouselCategorie<?php
                echo $titre;
                ?>" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only"></span>
        </a>
    </div>
</div>

<br>
</div>
<?php
    }

    private function Filtres()
    {
        ?>
<div class="container col-sm3 w-25 bg-light">
    <div class="container sticky-top">
        <div class="container mt-4">
            <h5>Filtres</h5>
            <table class="table">
                <tr>
                    <td>
                        <h6>Catégorie</h6>
                    </td>
                    <td>
                        <h6>Saison</h6>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="entrees" value="1" id="entrees"
                                checked>
                            <label class="form-check-label" for="entrees">
                                Entrées
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="plats" value="2" id="plats">
                            <label class="form-check-label" for="plats">
                                Plats
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="desserts" value="3" id="desserts">
                            <label class="form-check-label" for="desserts">
                                Desserts
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="boissons" value="4" id="boissons">
                            <label class="form-check-label" for="boissons">
                                Boissons
                            </label>
                        </div>

                    </td>

                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="hiver" id="hiver" checked>
                            <label class="form-check-label" for="hiver">
                                Hiver
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="2" name="printemps" id="printemps"
                                checked>
                            <label class="form-check-label" for="printemps">
                                Printemps
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ete" value="3" id="été" checked>
                            <label class="form-check-label" for="été">
                                Eté
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="automne" value="4" id="automne"
                                checked>
                            <label class="form-check-label" for="automne">
                                Automne
                            </label>
                        </div>
                    </td>
                </tr>
            </table>

            <table class="table">
                <tr>
                    <th>
                        <h5>Tris</h5>
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tri" value="1" id="temps_preparation">
                            <label class="form-check-label" for="temps_preparation">
                                Temps de préparation
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tri" value="2" id="temps_cuisson">
                            <label class="form-check-label" for="temps_cuisson">
                                Temps de cuisson
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tri" value="3" id="temps_total">
                            <label class="form-check-label" for="temps_total">
                                Temps total
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tri" value="4" id="calories">
                            <label class="form-check-label" for="calories">
                                Nombre de calories
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tri" value="5" id="notation" checked>
                            <label class="form-check-label" for="Notation">
                                Notation
                            </label>
                        </div>
                    </td>
                </tr>
            </table>

            <br>
            <br>
        </div>
    </div>
</div>

<?php
    }

    private function Page_Idees($ingredients, $recettes)
    {
        ?>
<div class="container mt-4">
    <form action="index.php" method="post">
        <div class="row">

            <?php
                    $this->Filtres();
                    ?>
            <div class="container col">
                <div class="container bg-light">
                    <h4>Ajoutez vos ingrédients</h4>
                    <div class="form-outline form-white">
                        <textarea class="form-control" id="ingredients" disabled></textarea>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="input-group mt-2">
                                <select class="form-select" aria-label="Default select example" id="ingredient">
                                    <option value="0" selected>Séletionnez l'ingrédient à ajouter</option>
                                    <?php
                                            foreach ($ingredients as $ingredient) {
                                                echo "<option value='" . $ingredient["Id_ingredient"] . "'>" . $ingredient["Nom_ingredient"] . "</option>";
                                            }
                                            ?>
                                </select>
                                <button type="button" class="btn btn-outline-primary" id="ajouter">Ajouter</button>
                            </div>
                        </div>
                        <div class="col mt-2">
                            <input type="text" name="ids" id="ids" hidden>
                            <button type="submit" class="btn btn-primary ms-2 pull-right"
                                id="rechercher">Rechercher</button>
                        </div>
                    </div>



    </form>

    <br>
</div>
<div class="container row">
    <?php
            foreach ($recettes as $recette) {
                $this->Cadre($recette);
            }
            ?>
</div>

</div>
</div>
</div>
<?php
    }

    private function Filtres_Saisons()
    {
        ?>
<div class="container col-sm3 w-25 bg-light">
    <div class="container sticky-top">
        <div class="container mt-4">
            <table class="table">
                <tr>
                    <td>
                        <h6>Saison</h6>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="hiver" id="hiver">
                            <label class="form-check-label" for="hiver">
                                Hiver
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="2" name="printemps" id="printemps">
                            <label class="form-check-label" for="printemps">
                                Printemps
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ete" value="3" id="été">
                            <label class="form-check-label" for="été">
                                Eté
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="automne" value="4" id="automne">
                            <label class="form-check-label" for="automne">
                                Automne
                            </label>
                        </div>
                    </td>
                </tr>
            </table>
            <button type="submit" class="btn btn-primary ms-2" name="appliquer" id="appliquer">Appliquer</button>
            <br>
            <br>
        </div>
    </div>
</div>

<?php
    }

    private function Page_Saisons($recettes)
    {
        ?>
<div class="container mt-4">
    <form action="" method="post">
        <div class="row">

            <?php
                    $this->Filtres_Saisons();
                    ?>
    </form>
    <div class="container col">
        <div class="container row">
            <?php
                    foreach ($recettes as $recette) {
                        $this->Cadre($recette);
                    }
                    ?>
        </div>
    </div>
    <br>
</div>

</div>
</div>
</div>


<?php
    }

    private function Filtres_Fetes()
    {
        ?>
<div class="container col-sm3 w-25 bg-light">
    <div class="container sticky-top">
        <div class="container mt-4">
            <table class="table">
                <tr>
                    <td>
                        <h6>Fetes</h6>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="yennayer" id="yennayer">
                            <label class="form-check-label" for="yennayer">
                                Yennayer
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="2" name="mawlid" id="mawlid">
                            <label class="form-check-label" for="mawlid">
                                El Mawlid
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="achoura" value="3" id="achoura">
                            <label class="form-check-label" for="achoura">
                                El Achoura
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="aidkbir" value="4" id="aidkbir">
                            <label class="form-check-label" for="aidkbir">
                                Aïd al-Adha
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="aidsghir" value="5" id="aidsghir">
                            <label class="form-check-label" for="aidsghir">
                                Aïd al-Fitr
                            </label>
                        </div>
                    </td>
                </tr>
            </table>
            <button type="submit" class="btn btn-primary ms-2" name="appliquer" id="appliquer">Appliquer</button>
            <br>
            <br>
        </div>
    </div>
</div>

<?php
    }

    private function Page_Fetes($recettes)
    {
        ?>
<div class="container mt-4">
    <form action="" method="post">
        <div class="row">
            <?php
                    $this->Filtres_Fetes();
                    ?>
    </form>
    <div class="container col">
        <div class="container row">
            <?php
                    foreach ($recettes as $recette) {
                        $this->Cadre($recette);
                    }
                    ?>
        </div>
    </div>
    <br>
</div>

</div>
</div>
</div>


<?php

    }

    private function Filtres_Categorie()
    {
        ?>
<div class="container col-sm3 w-25 bg-light">
    <div class="container sticky-top">
        <div class="container mt-4">
            <h5>Filtres</h5>
            <table class="table">
                <tr>
                    <td>
                        <h6>Saison</h6>
                    </td>
                </tr>
                <tr>


                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="saison[]" id="hiver"
                                checked>
                            <label class="form-check-label" for="hiver">
                                Hiver
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="2" name="saison[]" id="printemps"
                                checked>
                            <label class="form-check-label" for="printemps">
                                Printemps
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="saison[]" value="3" id="été" checked>
                            <label class="form-check-label" for="été">
                                Eté
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="saison[]" value="4" id="automne"
                                checked>
                            <label class="form-check-label" for="automne">
                                Automne
                            </label>
                        </div>
                    </td>
                </tr>
            </table>

            <table class="table">
                <tr>
                    <th>
                        <h5>Tris</h5>
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tri" value="1" id="temps_preparation">
                            <label class="form-check-label" for="temps_preparation">
                                Temps de préparation
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tri" value="2" id="temps_cuisson">
                            <label class="form-check-label" for="temps_cuisson">
                                Temps de cuisson
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tri" value="3" id="temps_total">
                            <label class="form-check-label" for="temps_total">
                                Temps total
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tri" value="4" id="calories">
                            <label class="form-check-label" for="calories">
                                Nombre de calories
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tri" value="5" id="notation" checked>
                            <label class="form-check-label" for="Notation">
                                Notation
                            </label>
                        </div>
                    </td>
                </tr>
            </table>
            <button type="submit" class="btn btn-primary mx-auto mt-5" id="appliquer">Appliquer</button>
            <br>
            <br>
        </div>
    </div>
</div>

<?php
    }

    private function Page_Categorie($recettes)
    {


        ?>
<div class="container mt-4">
    <form action="index.php?categorie=<?php
            echo $_GET["categorie"]
                ?>" method="post">
        <div class="row">
            <?php
                    $this->Filtres_Categorie();
                    ?>

    </form>
    <div class="container col-sm3 w-75">
        <div class="row">
            <h1>
                <?php
                        switch ($_GET["categorie"]) {
                            case 1:
                                echo "Entrées";
                                break;
                            case 2:
                                echo "Plats";
                                break;
                            case 3:
                                echo "Desserts";
                                break;
                            case 4:
                                echo "Boissons";
                                break;

                        }
                        ?>
            </h1>
            <?php
                    foreach ($recettes as $recette) {
                        $this->Cadre($recette);
                    }
                    ?>
        </div>
    </div>
</div>
</div>

<?php
    }

    private function Footer()
    {
        ?>
<footer>
    <div class="container bg-dark">
        <div class="container mt-5">
            <nav class="navbar navbar-expand-lg navbar-dark ">
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                        <li class="nav-item li_nav">
                            <a class="nav-link" href="../Page_Acceuil/index.php">Acceuil</a>
                        </li>
                        <li class="nav-item li_nav">
                            <a class="nav-link" href="../Page_News/index.php">News</a>
                        </li>
                        <li class="nav-item li_nav">
                            <a class="nav-link" href="../Page_IdeesRecette/index.php">Idées de recettes</a>
                        </li>
                        <li class="nav-item li_nav">
                            <a class="nav-link" href="#">Healthy</a>
                        </li>
                        <li class="nav-item li_nav">
                            <a class="nav-link" href="../Page_Saisons/index.php">Saisons</a>
                        </li>
                        <li class="nav-item li_nav">
                            <a class="nav-link" href="#">Fêtes</a>
                        </li>
                        <li class="nav-item li_nav">
                            <a class="nav-link" href="../Page_Nutrition/index.php">Nutrition</a>
                        </li>
                        <li class="nav-item li_nav">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <br>
        <br>
        <div class="container mx-auto">
            <div class="container bg-dark">
                <img style="height:30px;width:100px;margin-left:35%;" alt="Logo" src="../../Images/logo.png">

                <div class="container d-inline">
                    <a href="http://facebook.com"><i class="fa-brands fa-square-facebook fa-2xl"
                            style="color:white;margin-left:10%"></i></a>
                    <i class=""></i>

                    <a href="http://instagram.com"><i class="fa-brands fa-square-instagram fa-2xl"
                            style="color:white;height:30px"></i></a>
                    <a href="http://youtube.com"><i class="fa-brands fa-square-youtube fa-2xl"
                            style="color:white"></i></a>
                </div>
            </div>
        </div>

    </div>
</footer>
<?php
    }

    public function Profil($data)
    {
        $utilisateur = $data[0];
        ?>
<div class="container mt-4 bg-light">
    <h3>Informations Personnelles</h3>
    <div class="row">
        <div class="container col mt-4">
            <h6>Nom</h6>
            <p class=" mt-4">
                <?php
                        echo $utilisateur["Nom_utilisateur"]
                            ?>
            </p>
        </div>
        <div class="container col mt-4">
            <h6>Prénom</h6>
            <p class="mt-4">
                <?php
                        echo $utilisateur["Prenom_utilisateur"]
                            ?>
            </p>
            </p>
        </div>
        <div class="container col mt-4">
            <h6>Date de naissance</h6>
            <p class=" mt-4">
                <?php
                        echo $utilisateur["DateNaissance_utilisateur"]
                            ?>
            </p>
            </p>
        </div>
        <div class="container col mt-4">
            <h6>Sexe</h6>
            <p class=" mt-4">
                <?php
                        echo $utilisateur["Sexe_utilisateur"]
                            ?>
            </p>
            </p>
        </div>
    </div>
    <div class="row mt-4">
        <div class="container col mt-4">
            <h6>Email</h6>
            <p class=" mt-4">
                <?php
                        echo $utilisateur["Mail_utilisateur"]
                            ?>
            </p>
            </p>
        </div>
        <div class="container col mt-4">
            <h6>Mot de passe</h6>
            <p class=" mt-4">
                <?php
                        echo $utilisateur["MotDePasse_utilisateur"]
                            ?>
            </p>
            </p>
        </div>
    </div>
</div>

<div class="container mt-4 ">
    <h3>Favoris</h3>
    <div class="row">
        <?php
                if (isset($utilisateur["moyenne"])) {
                    foreach ($data as $recette) {
                        $this->Cadre_avecNotation($recette);
                    }
                } else {
                    echo "Aucun  recette disponible";
                }

                ?>
    </div>
</div>

<div class=" container mx-auto row">
    <div class="col">
        <h3>
            Recettes déja ajoutés
        </h3>
    </div>
    <div class="col">
        <a href="#ajout" class="btn btn-primary ms-2 rounded pull-right"> Ajouter une recette
        </a>
    </div>
    <?php
            require_once("../../Controller/Controller.php");
            $c = new Controller();
            $recettes = $c->afficher_recettes_ByUser($utilisateur["Id_utilisateur"]);
            $this->Cadres_Profil($recettes);
            ?>
</div>

<div class="container mx-auto">
    <h3>Ajouter une recette</h3>
    <form class="w-75 mx-auto bg-light mt-4" id="ajout" action="" method="post" enctype="multipart/form-data">

        <div class="input-group mt-2">
            <span class="input-group-text">Nom</span>
            <input type="text" id="nom" name="nom" class="form-control" aria-describedby="basic-addon1">
        </div>

        <div class="input-group mt-2">
            <span class="input-group-text">Description</span>
            <textarea class="form-control" name="description" id="description" aria-label="With textarea"></textarea>
        </div>

        <div class="input-group mt-2">
            Selectionnez une image :
            <input class="form-control-file" type="file" name="url">
        </div>

        <div class="input-group mt-2">
            <span class="input-group-text">Difficulté</span>
            <input type="number" class="form-control" name="difficulté" id="difficulté" aria-describedby="difficulté">
        </div>

        <div class="input-group mt-2">
            <span class="input-group-text" id="cat">Id_Categorie</span>
            <input type="number" class="form-control" name="categorie" id="categorie" aria-describedby="cat">
        </div>

        <div class="input-group mt-5">
            <span class="input-group-text" id="ing">Ingredient</span>
            <select class="form-select" aria-label="Default select example" id="ingredient">
                <option value="0" selected>Séletionnez l'ingrédient à ajouter</option>
                <?php
                        require_once("../../Controller/Controller.php");
                        $c = new Controller();
                        $ingredients = $c->afficher_ingredients();
                        foreach ($ingredients as $ingredient) {
                            echo "<option value='" . $ingredient["Id_ingredient"] . "'>" . $ingredient["Nom_ingredient"] . "</option>";
                        }
                        ?>
            </select>
            <input type="number" class="form-control" name="quantite" id="quantite" aria-describedby="cat">
            <select class="form-select" aria-label="Default select example" id="unite">
                <option value="0" selected>Unité</option>
                <option value="1">g</option>
                <option value="2">cl</option>
                <option value="3"> </option>
                <option value="4">ver</option>
                <option value="5">sachet</option>
            </select>
            <button type="button" class="btn btn-outline-primary" id="ajouter2">Ajouter</button>
        </div>
        <div class="mt-2">
            <span class="input-group-text" id="ing">Ingredients</span>
            <textarea class="form-control" id="ingredients" name="ingredients" readonly></textarea>
        </div>

        <div class="input-group mt-5">
            <span class="input-group-text" id="etps">Etape</span>
            <textarea class="form-control" id="etape"></textarea>
        </div>

        <div class="input-group mt-2">
            <input type="number" class="form-control" placeholder="Preparation" name="tempspreparation"
                id="tempspreparation" aria-describedby="cat">
            <input type="number" class="form-control" placeholder="Cuisson" name="tempscuisson" id="tempscuisson"
                aria-describedby="cat">
            <input type="number" class="form-control" placeholder="Repos" name="tempsrepos" id="tempsrepos"
                aria-describedby="cat">
            <input type="number" class="form-control" placeholder="Total" name="tempstotal" id="tempstotal"
                aria-describedby="cat">
            <button type="button" class="btn btn-outline-primary" id="ajouter3">Ajouter</button>

        </div>
        <div class="mt-2">
            <span class="input-group-text" id="etps">Etapes</span>
            <textarea class="form-control h-25" id="etapes" name="etapes" readonly></textarea>
        </div>


        <button type="submit" class="btn btn-primary btn-block mt-5 w-100" id="ajouter">Ajouter</button>
        <button type="submit" class="btn btn-primary btn-block mt-5 w-100" id="modifier" hidden>Modifier</button>

    </form>

</div>

<?php
    }

    // Les données recues dans cette fonction sont en forme d'un tableau contenant :
// 1 - les détails de la recette
// 2 - les ingrédients de la recette
// 3 - les étapes de la recette
    private function Recette($data)
    {
        $details = $data[0];
        $ingredients = $data[1];
        $etapes = $data[2];
        ?>
<div class="container bg-light mt-4" style="padding: 10px;">
    <div class="container">
        <h2>
            <?php
                    echo $details["Nom_recette"]
                        ?>
        </h2>
        <div class="row">
            <form class="col" action="" method="get">
                <input type="text" value=" <?php
                        if (isset($_SESSION["id"])) {
                            echo $_SESSION["id"];
                        }
                        ?>" name="id" hidden>
                <input type="text" value=" <?php
                        echo $details["Id_recette"];
                        ?>" name="id_recette" hidden>
                <div class="row">
                    <div class="col">
                        <div class="input-group">
                            <button type="submit" class="btn btn-secondary" style="text-align: right;">Ajouter aux
                                favoris</button>
                        </div>
                    </div>
                </div>
            </form>
            <form class="col" action="" method="get">
                <div class="row">
                    <div class="col">
                        <div class="input-group">
                            <input type="text" value=" <?php
                                    if (isset($_SESSION["id"])) {
                                        echo $_SESSION["id"];
                                    }
                                    ?>" name="id" hidden>
                            <input type="text" value=" <?php
                                    echo $details["Id_recette"];
                                    ?>" name="id_recette" hidden>
                            <input id="input_note" type="number" name="note" class="form-control ms-2"
                                aria-describedby="basic-addon1">
                            <button type="submit" class="btn btn-outline-secondary" id="noter">Noter</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <?php
                                    require_once("../../Controller/Controller.php");
                                    $c = new Controller();
                                    if (isset($_SESSION["id"]) && $c->lire_note($_SESSION["id"], $details["Id_recette"])) {
                                        echo "<b>Ma note :  </b>  " . $c->lire_note($_SESSION["id"], $details["Id_recette"]);
                                    }
                                    ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-4">
        <div class="contanier col-sm3 w-50 h-25">
            <img src="<?php
                    echo $details["Image_recette"]
                        ?>" class="rounded d-block w-100" alt="Image de la recette">
        </div>
        <div class="contanier col-sm3 w-50">
            <div class="row">
                <div class="container col">
                    <h6 class="text-center">Difficulté</h6>
                    <p class="text-center mt-4">
                        <?php
                                echo $details["Difficulte_recette"]
                                    ?>
                    </p>
                </div>
                <div class="container col">
                    <h6 class="text-center">Calories</h6>
                    <p class="text-center mt-4">
                        <?php
                                echo $details["nbcalories"]
                                    ?>
                    </p>
                    </p>
                </div>
                <div class="container col">

                    <h6 class="text-center">Notation</h6>
                    <?php
                            echo " <p class='text-center mt-4'>" . $details["note"] . "</p>";
                            ?>

                    </p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="container col">
                    <h6 class="text-center">Temps Total </h6>
                    <p class="text-center mt-4">
                        <?php
                                echo $details["TempsTotal"] . " min"
                                    ?>
                    </p>
                </div>
                <div class="container col">

                </div>
                <div class="container col">

                </div>
            </div>
            <div class="row mt-4">
                <div class="container col">
                    <h6 class="text-center">Temps de Préparation</h6>
                    <p class="text-center mt-4">
                        <?php
                                echo $details["TempsPreparation"] . " min"
                                    ?>
                    </p>
                    </p>
                </div>
                <div class="container col">
                    <h6 class="text-center">Temps de Cuisson</h6>
                    <p class="text-center mt-4"> <?php
                            echo $details["TempsCuisson"] . " min"
                                ?> </p>
                    </p>
                </div>
                <div class="container col">
                    <h6 class="text-center">Temps de Repos</h6>
                    <p class="text-center mt-4">
                        <?php
                                echo $details["TempsRepos"] . " min"
                                    ?>
                    </p>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <h2>Ingrédients</h2>
        <div class="row mt-4">
            <?php
                    foreach ($ingredients as $ingredient) {
                        if ($ingredient["Quantite"] == 0) {
                            $quantite = "";
                        } else {
                            $quantite = "" . $ingredient["Quantite"];
                        }
                        echo "<div class='col-2'>
                    <img src='" . $ingredient["Image_ingredient"] . "' class='rounded d-block w-100' alt='Image de la recette'>
                    <p class='text-center'>" . $ingredient["Nom_ingredient"] . "</p>
                    <p class='text-center'>" . $quantite . " " . $ingredient["Unite"] . "</p>
                </div>";
                    }
                    ?>
        </div>
    </div>

    <div class="container mt-4">
        <h2>Étapes</h2>
        <table class="table">
            <?php
                    $i = 0;
                    foreach ($etapes as $etape) {
                        $i++;
                        echo "<tr>
                        <td> Etape" . $i . "</td>
                        <td>" . $etape["Description_etape"] . "</td>
                    </tr> ";
                    }
                    ?>
        </table>
    </div>

    <div class="container mt-4">
        <h2>Video </h2>

    </div>

</div>
<?php
    }

    private function Cadres($recettes)
    {
        ?>
<div class="container mt-4">
    <div class="row">
        <?php
                // Affihcer les news et les recettes
                foreach ($recettes as $row) {
                    echo $this->Cadre($row);
                }
                ?>
    </div>
</div>
<?php
    }

    private function Cadres_Profil($recettes)
    {
        ?>
<div class="container mt-4">
    <div class="row">
        <?php
                // Affihcer les news et les recettes
                foreach ($recettes as $recette) {
                    echo $this->Cadre_Profil($recette);
                }
                ?>
    </div>
</div>
<?php
    }

    private function News($news, $recettes)
    {
        ?>
<div class="container mt-4">
    <div class="row">
        <?php
                // Affihcer les news et les recettes
                foreach ($news as $row) {
                    echo $this->Cadre_news($row);
                }
                foreach ($recettes as $row) {
                    echo $this->Cadre($row);
                }
                ?>
    </div>
</div>
<?php
    }

    private function News_page($data)
    {
        $news = $data[0];
        $paragraphes = $data[1];
        ?>
<div class="container mt-5 bg-light">
    <div class="container mt-5">
        <br>
        <h2>
            <?php
                    echo "<u><b>NEWS:</b></u> " . $news["Titre_news"];
                    ?>
        </h2>
    </div>
    <div class="container mt-5">
        <p>
            <?php
                    echo $news["Description_news"];
                    ?>
        </p>
    </div>
    <?php
            foreach ($paragraphes as $paragraphe) {
                if ($paragraphe["Position_paragraphe"] % 2 == 1) {
                    echo "<div class='container mt-5'><h4>" . $paragraphe['Titre_paragraphe'] . "</h4></div>";
                    if ($paragraphe["Image_paragraphe"] != "") {
                        echo "<div class='container row mt-4'><div class='col'><p>" . $paragraphe['Contenu_paragraphe'] . "</p></div>";
                        echo "<div class='col'><img src='" . $paragraphe["Image_paragraphe"] . "'class='rounded d-block w-100' alt='Image du paragraphe'></div></div>";
                    } else {
                        echo "<div class='container'><p>" . $paragraphe['Contenu_paragraphe'] . "</p></div></div>";
                    }
                } else {
                    echo "<div class='container mt-5'><h4>" . $paragraphe['Titre_paragraphe'] . "</h4></div>";
                    if ($paragraphe["Image_paragraphe"] != "") {
                        echo "<div class='container row mt-4'><div class='col'><img src='" . $paragraphe["Image_paragraphe"] . "'class='rounded d-block w-100' alt='Image du paragraphe'></div>";
                        echo "<div class='col'><p>" . $paragraphe['Contenu_paragraphe'] . "</p></div></div>";
                    } else {
                        echo "<div class='container'><p>" . $paragraphe['Contenu_paragraphe'] . "</p></div></div>";
                    }
                }

            }

            ?>
    <br>
</div>
<?php
    }

    private function Formulaire_Connexion()
    {
        require_once("../../Controller/Controller.php");
        $c = new Controller();
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            if ($c->login_utilisateur($email, $password)) {
                session_start();
                $data = $c->login_utilisateur($email, $password);
                $_SESSION["name"] = $data[1];
                $_SESSION["id"] = $data[0];
                header("Location:../../Routeurs/Page_Acceuil/index.php");
            } else if ($c->login_admin($email, $password)) {
                header("Location:../../Admin/Page_Principale/index.php");
            } else {
                header("Location:../../Routeurs/Page_Connexion/index.php");
            }
        }

        if (
            isset($_POST["nom"]) && isset($_POST["prénom"]) && isset($_POST["naissance"])
            && isset($_POST["sexe"]) && isset($_POST["register_email"]) && isset($_POST["register_password"])
        ) {
            $nom = $_POST["nom"];
            $prénom = $_POST["prénom"];
            $dateNaissance = $_POST["naissance"];
            $sexe = $_POST["sexe"];
            $email = $_POST["register_email"];
            $password = $_POST["register_password"];

            $c->ajouter_utilisateur($nom, $prénom, $dateNaissance, $sexe, $email, $password);
            echo "Compte créé, Il faut attendre la validation de l'admin pour pouvoir vous connecter";
            echo "<a href='../Page_Acceuil/index.php'>Revenir à la page d'acceuil</a>";
        }

        ?>
<div class="container mt-4" id="page_cnx">
    <br>

    <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab"
                aria-controls="pills-login" aria-selected="true">Se connecter</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab"
                aria-controls="pills-register" aria-selected="false">S'inscrire</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
            <form action="" method="post">

                <br>
                <br>

                <div class="form-outline mb-4">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" />
                </div>

                <div class="form-outline mb-5">
                    <label class="form-label" for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" class="form-control" />
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 d-flex justify-content-center">
                        <div class="form-check mb-3 mb-md-0">
                            <input class="form-check-input" type="checkbox" value="" id="remember" checked />
                            <label class="form-check-label" for="remember"> Se souvenir de moi </label>
                        </div>
                    </div>

                    <div class="col-md-6 d-flex justify-content-center">
                        <a href="#!">Mot de passe oublié?</a>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block mb-4 w-100">Se connecter</button>

                <div class="text-center">
                    <p>Vous n'avez pas de compte ? <a id="raccourci" href="#">S'inscrire</a></p>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
            <form action="" method="post">
                <div class="row mt-4">
                    <div class="form-outline w-50 col">
                        <label class="form-label" for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control" />
                    </div>

                    <div class="form-outline w-50 col">
                        <label class="form-label" for="Identifiant">Prénom</label>
                        <input type="text" id="prénom" name="prénom" class="form-control" />
                    </div>
                </div>

                <div class="row">
                    <div class="form-outline w-50 col">
                        <label class="form-label" for="naissance">Date de naissance</label>
                        <input type="date" id="naissance" name="naissance" class="form-control" />
                    </div>


                    <div class="col">
                        <label class="form-label" for="sexe">Sexe</label>
                        <div class="row">
                            <div class="form-check col">
                                <input class="form-check-input" type="radio" name="sexe" id="homme" value="M">
                                <label class="form-check-label" for="homme">
                                    Homme
                                </label>
                            </div>
                            <div class="form-check col">
                                <input class="form-check-input" type="radio" name="sexe" id="femme" value="F" checked>
                                <label class="form-check-label" for="femme">
                                    Femme
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="form-outline mt-4">
                    <label class="form-label" for="register_email">Email</label>
                    <input type="email" id="register_email" name="register_email" class="form-control" />
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="register_password">Mot de passe</label>
                    <input type="password" id="register_password" name="register_password" class="form-control" />
                </div>

                <div class="form-check d-flex justify-content-center mb-4">
                    <input class="form-check-input me-2" type="checkbox" value="" id="termes" checked
                        aria-describedby="registerCheckHelpText" />
                    <label class="form-check-label" for="termes">
                        J'ai lu et j'accepte les termes
                    </label>
                </div>

                <button type="submit" class="btn btn-primary btn-block mb-3 w-100"
                    id="register_button">S'inscrire</button>
            </form>
        </div>
    </div>
</div>
<?php
    }

    private function Ingredients($ingredients)
    {
        ?>
<div class="container mx-auto mt-5">
    <h3>
        Informations Nutritionnelles sur les ingrédients
    </h3>
    <form action="index.php" method="get">
        <div class="input-group mt-5">
            <input class="form-control" type="text" name="rechercher" id="text" />
            <button type="submit" class="btn btn-outline-primary" id="rechercher">Rechercher</button>
        </div>
    </form>
    <div class="row">
        <table class="table table-striped table-hover mt-5 text-left" id="table_recettes">
            <caption>
                Ingrédients disponibles
            </caption>
            <thead>
                <th>
                    Image
                </th>
                <th>

                </th>
                <th>
                    Healthy
                </th>
                <th>
                    Calories
                </th>
                <th>
                    Glucides
                </th>
                <th>
                    Lipides
                </th>
                <th>
                    Minéraux
                </th>
                <th>
                    Vitamines
                </th>
                <th>
                    Saison
                </th>
            </thead>
            <tbody id="tbody_ingredients">
                <?php
                        foreach ($ingredients as $ingredient) {
                            echo "<tr><td scope='col'><img class='ing' src='" . $ingredient["Image_ingredient"] . "'></td>";
                            echo "<td scope='col'><b>" . $ingredient["Nom_ingredient"] . "</b></td>";
                            echo "<td>" . $ingredient["Healthy"] . "</td>";
                            echo "<td>" . $ingredient["Calories"] . "</td>";
                            echo "<td>" . $ingredient["Glucides"] . "</td>";
                            echo "<td>" . $ingredient["Lipides"] . "</td>";
                            echo "<td>" . $ingredient["Mineraux"] . "</td>";
                            echo "<td>" . $ingredient["Vitamines"] . "</td>";
                            echo "<td>" . $ingredient["Nom_saison"] . "</td></tr>";
                        }
                        ?>
            </tbody>
        </table>

    </div>
</div>
<?php
    }

    /*--------------------------- ADMIN ----------------------------*/

    private function Cadre_Admin($titre, $url)
    {
        ?>
<div class="container rounded bg-light col-2" style="margin-top: 15%;">
    <br>
    <img src="../../Images/photo2.jpg" class="rounded d-block w-100" alt="Icone">
    <div class="container mt-2">
        <a href="<?php
                echo $url
                    ?>">
            <h4>
                <?php
                        echo $titre
                            ?>
            </h4>
        </a>
    </div>
</div>
<?php
    }
    private function page_principale()
    {
        ?>
<div class="container mx-auto ">
    <div class="container">
        <div class="row mx-auto">
            <?php
                    $this->Cadre_Admin("Gestion des recettes", "../Page_Gestion_Recettes/index.php");
                    $this->Cadre_Admin("Gestion des news", "../Page_Gestion_News/index.php");
                    $this->Cadre_Admin("Gestion des utilisateurs", "../Page_Gestion_Utilisateurs/index.php");
                    $this->Cadre_Admin("Gestion de la nutrition", "../Page_Gestion_Nutrition/index.php");
                    $this->Cadre_Admin("Paramètres", "../Page_Paramètres/index.php");
                    ?>
        </div>
    </div>
</div>
<?php
    }

    private function Filtres_Admin()
    {
        ?>
<div class="container col-sm3 w-25 bg-light">
    <div class="container sticky-top">
        <div class="container mt-4">
            <h5>Filtres</h5>
            <table class="table">
                <tr>
                    <td>
                        <h6>Catégorie</h6>
                    </td>
                    <td>
                        <h6>Saison</h6>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="categorie[]" value="1" id="entrees"
                                checked>
                            <label class="form-check-label" for="entrees">
                                Entrées
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="categorie[]" value="2" id="plats">
                            <label class="form-check-label" for="plats">
                                Plats
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="categorie[]" value="3" id="desserts">
                            <label class="form-check-label" for="desserts">
                                Desserts
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="categorie[]" value="4" id="boissons">
                            <label class="form-check-label" for="boissons">
                                Boissons
                            </label>
                        </div>

                    </td>

                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="saison[]" id="hiver"
                                checked>
                            <label class="form-check-label" for="hiver">
                                Hiver
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="2" name="saison[]" id="printemps"
                                checked>
                            <label class="form-check-label" for="printemps">
                                Printemps
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="saison[]" value="3" id="été" checked>
                            <label class="form-check-label" for="été">
                                Eté
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="saison[]" value="4" id="automne"
                                checked>
                            <label class="form-check-label" for="automne">
                                Automne
                            </label>
                        </div>
                    </td>
                </tr>
            </table>

            <table class="table">
                <tr>
                    <th>
                        <h5>Tris</h5>
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tri" value="1" id="temps_preparation">
                            <label class="form-check-label" for="temps_preparation">
                                Temps de préparation
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tri" value="2" id="temps_cuisson">
                            <label class="form-check-label" for="temps_cuisson">
                                Temps de cuisson
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tri" value="3" id="temps_total">
                            <label class="form-check-label" for="temps_total">
                                Temps total
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tri" value="4" id="calories">
                            <label class="form-check-label" for="calories">
                                Nombre de calories
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tri" value="5" id="notation" checked>
                            <label class="form-check-label" for="Notation">
                                Notation
                            </label>
                        </div>
                    </td>
                </tr>
            </table>
            <button class="btn btn-primary mx-auto mt-5" id="appliquer">Appliquer</button>
            <br>
            <br>
        </div>
    </div>
</div>

<?php
    }

    private function Filtres_Admin_Utilisateurs()
    {
        ?>
<div class="container col-sm3 w-25 bg-light">
    <div class="container sticky-top">
        <div class="container mt-4">
            <table class="table">
                <tr>
                    <td>
                        <h6>Sexe</h6>
                    </td>
                    <td>
                        <h6>Validité</h6>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sexe" value="1" id="M" checked>
                            <label class="form-check-label" for="entrees">
                                M
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sexe" value="2" id="F">
                            <label class="form-check-label" for="plats">
                                F
                            </label>
                        </div>
                    </td>

                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="validité" id="valide"
                                checked>
                            <label class="form-check-label" for="hiver">
                                Valide
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="2" name="validité" id="nonvalide"
                                checked>
                            <label class="form-check-label" for="printemps">
                                Non valide
                            </label>
                        </div>
                    </td>
                </tr>
            </table>
            <table class="table">
                <tr>
                    <th>
                        <h5>Tris</h5>
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tri" value="1" id="nom" checked>
                            <label class="form-check-label" for="nom">
                                Nom et prénom
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tri" value="2" id="datenaissance">
                            <label class="form-check-label" for="datenaissance">
                                Date de naissance
                            </label>
                        </div>
                    </td>
                </tr>
            </table>
            <button class="btn btn-primary mx-auto mt-5" id="appliquer">Appliquer</button>
            <br>
            <br>
        </div>
    </div>
</div>

<?php
    }

    private function table_recettes($ingredients)
    {
        ?>
<div class="row">
    <?php
            $this->Filtres_Admin();
            ?>
    <div class="container mx-auto col">
        <table class="table mt-2 text-center col" id="table_recettes">
            <caption>
                Recettes disponibles
            </caption>
            <thead>
                <th>
                    Id_Recette
                </th>
                <th>
                    Titre_Recette
                </th>
                <th>
                    Id_Utilisateur
                </th>
                <th>
                    Valide
                </th>
            </thead>
            <tbody id="tbody_recettes">
                <tr>
                    <td>2</td>
                    <td>
                        <form action="" method="post">
                            <a type="submit" href="">Couscous</a>
                        </form>
                    </td>
                    <td>
                        <form action="" method="post">
                            <a type="submit" href="">2</a>
                        </form>
                    </td>
                    <td>1</td>

                </tr>
            </tbody>
        </table>

        <div class=" container col mt-2 mx-auto">
            <form class="w-75 mx-auto bg-light sticky-top" action="../../Admin/Page_Gestion_Recettes/index.php"
                method="post" enctype="multipart/form-data">
                <select class="form-select bg-secondary text-white" id="choix_action" name="choix">
                    <option value="1" selected> Ajouter </option>
                    <option value="2"> Modifier </option>
                </select>

                <div class="input-group mt-5">
                    <span class="input-group-text" id="id">Id</span>
                    <input id="input_id" type="number" name="id" class="form-control" aria-label="id"
                        aria-describedby="basic-addon1" disabled>
                    <button type="button" class="btn btn-outline-primary" id="charger" disabled>Charger</button>
                </div>

                <div class="input-group mt-2">
                    <span class="input-group-text">Nom</span>
                    <input type="text" id="nom" name="nom" class="form-control" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mt-2">
                    <span class="input-group-text">Description</span>
                    <textarea class="form-control" name="description" id="description"
                        aria-label="With textarea"></textarea>
                </div>

                <div class="input-group mt-2">
                    Selectionnez une image :
                    <input class="form-control-file" type="file" name="url">
                </div>

                <div class="input-group mt-2">
                    <span class="input-group-text">Difficulté</span>
                    <input type="number" class="form-control" name="difficulté" id="difficulté"
                        aria-describedby="difficulté">
                </div>

                <div class="input-group mt-2">
                    <span class="input-group-text" id="cat">Id_Categorie</span>
                    <input type="number" class="form-control" name="categorie" id="categorie" aria-describedby="cat">
                </div>

                <div class="input-group mt-5">
                    <span class="input-group-text" id="ing">Ingredient</span>
                    <select class="form-select" aria-label="Default select example" id="ingredient">
                        <option value="0" selected>Séletionnez l'ingrédient à ajouter</option>
                        <?php
                                foreach ($ingredients as $ingredient) {
                                    echo "<option value='" . $ingredient["Id_ingredient"] . "'>" . $ingredient["Nom_ingredient"] . "</option>";
                                }
                                ?>
                    </select>
                    <input type="number" class="form-control" name="quantite" id="quantite" aria-describedby="cat">
                    <select class="form-select" aria-label="Default select example" id="unite">
                        <option value="0" selected>Unité</option>
                        <option value="1">g</option>
                        <option value="2">cl</option>
                        <option value="3"> </option>
                        <option value="4">ver</option>
                        <option value="5">sachet</option>
                    </select>
                    <button type="button" class="btn btn-outline-primary" id="ajouter2">Ajouter</button>
                </div>
                <div class="mt-2">
                    <span class="input-group-text" id="ing">Ingredients</span>
                    <textarea class="form-control" id="ingredients" name="ingredients" readonly></textarea>
                </div>

                <div class="input-group mt-5">
                    <span class="input-group-text" id="etps">Etape</span>
                    <textarea class="form-control" id="etape"></textarea>
                </div>

                <div class="input-group mt-2">
                    <input type="number" class="form-control" placeholder="Preparation" name="tempspreparation"
                        id="tempspreparation" aria-describedby="cat">
                    <input type="number" class="form-control" placeholder="Cuisson" name="tempscuisson"
                        id="tempscuisson" aria-describedby="cat">
                    <input type="number" class="form-control" placeholder="Repos" name="tempsrepos" id="tempsrepos"
                        aria-describedby="cat">
                    <input type="number" class="form-control" placeholder="Total" name="tempstotal" id="tempstotal"
                        aria-describedby="cat">
                    <button type="button" class="btn btn-outline-primary" id="ajouter3">Ajouter</button>

                </div>
                <div class="mt-2">
                    <span class="input-group-text" id="etps">Etapes</span>
                    <textarea class="form-control h-25" id="etapes" name="etapes" readonly></textarea>
                </div>


                <button type="submit" class="btn btn-primary btn-block mt-5 w-100" id="ajouter">Ajouter</button>
                <button type="submit" class="btn btn-primary btn-block mt-5 w-100" id="modifier"
                    hidden>Modifier</button>

            </form>
        </div>

        <?php
                require_once("../../Controller/Controller.php");

                $c = new Controller();

                if (
                    isset($_POST["nom"]) && isset($_POST["description"])
                    && isset($_FILES["url"]) && isset($_POST["difficulté"]) && isset($_POST["categorie"])
                    && isset($_POST["ingredients"]) && isset($_POST["etapes"])
                ) {
                    $target_dir = "../../Images/Recettes/";
                    $target_file = $target_dir . basename($_FILES["url"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    move_uploaded_file($_FILES["url"]["tmp_name"], $target_file);

                    $div1 = explode(" - ", $_POST["ingredients"]);
                    $res1 = array();
                    foreach ($div1 as $div) {
                        $div2 = explode(":", $div);
                        array_push($res1, $div2);
                    }

                    $d1 = explode(" - ", $_POST["etapes"]);
                    $r1 = array();
                    foreach ($d1 as $d) {
                        $d2 = explode(":", $d);
                        array_push($r1, $d2);
                    }

                    if ($_POST["choix"] == "1") {
                        $c->ajouter_recette($_POST["nom"], $_POST["description"], $target_file, $_POST["difficulté"], $_POST["categorie"], $res1, $r1);
                    } else if ($_POST["choix"] == "2") {
                        if (isset($_POST["id"])) {
                            $c->modifier_recette($_POST["id"], $_POST["nom"], $_POST["description"], $target_file, $_POST["difficulté"], $_POST["categorie"], $res1, $r1);
                        }
                    }
                }
                if (isset($_POST["bloquer"])) {
                    $c->bloquer_recette($_POST["bloquer"]);
                }
                if (isset($_POST["supprimer"])) {
                    $c->supprimer_recette($_POST["supprimer"]);
                }
                if (isset($_POST["valider"])) {
                    $c->valider_recette($_POST["valider"]);
                }
                ?>

    </div>
</div>
<?php
    }

    private function table_ingredients()
    {

        ?>
<div class="container">
    <div class="row">
        <div class="col mt-5 mb-5">
            <div class="input-group w75">
                <input class="form-control" type="text" name="rechercher" id="text" />
                <button type="button" class="btn btn-outline-primary" id="rechercher">Rechercher</button>
            </div>
        </div>

        <div class="col mt-5 mb-5">
            <a href="#choix_action" class="btn btn-primary ms-2 rounded pull-right"> Ajouter ou modifier un ingredient
            </a>
        </div>
    </div>
</div>
<div class="container mx-auto">
    <div class="row">
        <table class="table mt-2 text-center col" id="table_recettes">
            <caption>
                Ingrédients disponibles
            </caption>
            <thead>
                <th>
                    Id
                </th>
                <th>
                    Nom
                </th>
                <th>
                    Healthy
                </th>
                <th>
                    Calories
                </th>
                <th>
                    Glucides
                </th>
                <th>
                    Lipides
                </th>
                <th>
                    Minéraux
                </th>
                <th>
                    Vitamines
                </th>
                <th>
                    Id_saison
                </th>
                <th>
                    Saison
                </th>
            </thead>
            <tbody id="tbody_ingredients">
                <tr>
                    <td>2</td>
                    <td>
                        <form action="" method="post">
                            <a type="submit" href="">Couscous</a>
                        </form>
                    </td>
                    <td>
                        <form action="" method="post">
                            <a type="submit" href="">2</a>
                        </form>
                    </td>
                    <td>1</td>

                </tr>
            </tbody>
        </table>

        <div class=" container mt-2 mx-auto">
            <form class="mx-auto bg-light sticky-top" action="" method="post" enctype="multipart/form-data">
                <select class="form-select w-50" id="choix_action" name="choix">
                    <option value="1" selected> Ajouter </option>
                    <option value="2"> Modifier </option>
                </select>

                <div class="input-group mt-5">
                    <span class="input-group-text" id="id">Id</span>
                    <input type="text" id="input_id" name="id" class="form-control" aria-label="id"
                        aria-describedby="basic-addon1" disabled>
                    <button type="button" class="btn btn-outline-primary" id="charger" disabled>Charger</button>

                    <span class="input-group-text ms-2">Nom</span>
                    <input type="text" name="nom" id="nom" class="form-control" aria-label="nom"
                        aria-describedby="basic-addon1">
                </div>

                <div class="input-group mt-2">

                </div>

                <div class="input-group mt-2">
                    <span class="input-group-text">Description</span>
                    <textarea class="form-control" id="description" name="description"
                        aria-label="With textarea"></textarea>
                </div>

                <div class="input-group mt-2">
                    Selectionnez une image :
                    <input class="form-control-file" type="file" name="url">
                </div>

                <div class="input-group mt-2">
                    <span class="input-group-text" id="health">Healthy</span>
                    <input type="number" class="form-control" name="healthy" id="healthy" aria-describedby="health">
                </div>

                <div class="input-group mt-2">
                    <span class="input-group-text" id="cal">Calories</span>
                    <input type="number" class="form-control" name="calories" id="calories" aria-describedby="cal">
                </div>

                <div class="input-group mt-2">
                    <span class="input-group-text" id="glu">Glucides</span>
                    <input type="text" class="form-control" name="glucides" id="glucides" aria-describedby="glu">
                </div>

                <div class="input-group mt-2">
                    <span class="input-group-text" id="lip">Lipides</span>
                    <input type="text" class="form-control" name="lipides" id="lipides" aria-describedby="lip">
                </div>

                <div class="input-group mt-2">
                    <span class="input-group-text" id="min">Minéraux</span>
                    <input type="text" class="form-control" name="mineraux" id="mineraux" aria-describedby="min">
                </div>

                <div class="input-group mt-2">
                    <span class="input-group-text" id="min">Vitamines</span>
                    <input type="text" class="form-control" name="vitamines" id="vitamines" aria-describedby="min">
                </div>

                <div class="input-group mt-2">
                    <span class="input-group-text">Saison</span>
                    <input type="number" id="saison" class="form-control" name="saison" aria-describedby="saison">
                </div>

                <button type="submit" class="btn btn-primary btn-block mt-5 w-100" id="ajouter"
                    name="ajouter">Ajouter</button>
                <button type="submit" class="btn btn-primary btn-block mt-5 w-100" id="modifier" name="modifier"
                    hidden>Modifier</button>

            </form>
        </div>

        <?php
                require_once("../../Controller/Controller.php");

                $c = new Controller();
                if (
                    isset($_POST["nom"]) && isset($_POST["description"]) && isset($_FILES["url"]) && isset($_POST["healthy"]) && isset($_POST["calories"]) && isset($_POST["glucides"])
                    && isset($_POST["lipides"]) && isset($_POST["mineraux"]) && isset($_POST["vitamines"])
                    && isset($_POST["saison"])
                ) {
                    if ($_POST["choix"] == "1") {
                        $target_dir = "../../Images/Ingredients/";
                        $target_file = $target_dir . basename($_FILES["url"]["name"]);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        move_uploaded_file($_FILES["url"]["tmp_name"], $target_file);

                        $c->ajouter_ingredient(
                            $_POST["nom"], $_POST["description"],
                            $target_file, $_POST["healthy"],
                            $_POST["calories"], $_POST["glucides"], $_POST["lipides"], $_POST["mineraux"], $_POST["vitamines"],
                            $_POST["saison"]
                        );
                    } else if ($_POST["choix"] == "2") {
                        if (isset($_POST["id"])) {
                            $c->modifier_ingredient(
                                $_POST["id"], $_POST["nom"], $_POST["description"], $_POST["url"], $_POST["healthy"],
                                $_POST["calories"], $_POST["glucides"], $_POST["lipides"], $_POST["mineraux"], $_POST["vitamines"],
                                $_POST["saison"]
                            );
                        }
                    }
                }

                if (isset($_POST["supprimer"])) {
                    $c->supprimer_ingredient($_POST["supprimer"]);
                }
                ?>
    </div>
</div>
<?php
    }


    private function table_utilisateurs()
    {
        ?>
<div class="row">
    <?php
            echo $this->Filtres_Admin_Utilisateurs();
            ?>
    <div class="container col">
        <table class="table mt-2 text-center" id="table_utilisateurs">
            <caption>
                Utilisateurs disponibles
            </caption>
            <thead>
                <th>
                    Id
                </th>
                <th>
                    Nom
                </th>
                <th>
                    Prénom
                </th>
                <th>
                    Date de Naissance
                </th>
                <th>
                    Sexe
                </th>
                <th>
                    Email
                </th>
                <th>
                    Valide
                </th>
            </thead>
            <tbody id="tbody_utilisateurs">
                <tr>
                    <td>2</td>
                    <td>
                        <form action="" method="post">
                            <a type="submit" href="">Couscous</a>
                        </form>
                    </td>
                    <td>
                        <form action="" method="post">
                            <a type="submit" href="">2</a>
                        </form>
                    </td>
                    <td>1</td>

                </tr>
            </tbody>
        </table>
    </div>

</div>
<?php

        require_once("../../Controller/Controller.php");

        $c = new Controller();

        if (isset($_POST["bloquer"])) {
            $c->bloquer_utilisateur($_POST["bloquer"]);
        }
        if (isset($_POST["supprimer"])) {
            $c->supprimer_utilisateur($_POST["supprimer"]);
        }
        if (isset($_POST["valider"])) {
            $c->valider_utilisateur($_POST["valider"]);
        }
        ?>

<?php

    }

    private function table_news()
    {
        ?>
<div class="container mt-4">
    <div class="row">
        <div class="container col">
            <table class="table mt-2 text-center" id="table_news">
                <caption>
                    News disponibles
                </caption>
                <thead>
                    <th>
                        Id
                    </th>
                    <th>
                        Nom
                    </th>
                    <th>
                        Description
                    </th>
                </thead>
                <tbody id="tbody_news">
                    <tr>
                        <td>2</td>
                        <td>
                            <form action="" method="post">
                                <a type="submit" href="">Couscous</a>
                            </form>
                        </td>
                        <td>
                            <form action="" method="post">
                                <a type="submit" href="">2</a>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <form class="mx-auto bg-light sticky-top" action="" method="post">
            <select class="form-select w-50" id="choix_action" name="choix">
                <option value="1" selected> Ajouter </option>
                <option value="2"> Modifier </option>
            </select>

            <div class="row">
                <div class="col">
                    <div class="input-group mt-5">
                        <span class="input-group-text" id="id">Id</span>
                        <input type="text" id="input_id" name="id" class="form-control" aria-label="id"
                            aria-describedby="basic-addon1" disabled>
                        <button type="button" class="btn btn-outline-primary" id="charger" disabled>Charger</button>
                    </div>

                    <div class="input-group mt-2">
                        <span class="input-group-text">Nom</span>
                        <input type="text" name="nom" id="nom" class="form-control" aria-label="nom"
                            aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group mt-2">
                        <span class="input-group-text">Description</span>
                        <textarea class="form-control" id="description" name="description"
                            aria-label="With textarea"></textarea>
                    </div>

                    <div class="input-group mt-2">
                        <span class="input-group-text" id="url">Url de l'image</span>
                        <input type="text" class="form-control" name="url" id="url_image" aria-describedby="url">

                    </div>
                </div>

                <div class="col">
                    <h4 class="mt-4 mb-2">
                        Paragraphes
                    </h4>

                    <div class="row mx-auto">
                        <div class="col-2 mx-auto">
                            <button type="button" class="btn btn-outline-primary" id="precedent">
                                < </button>
                        </div>
                        <div class="col-8 mx-auto">
                            <div class="input-group mt-2">
                                <span class="input-group-text" id="title">Titre</span>
                                <input type="text" class="form-control" name="titre" id="titre"
                                    aria-describedby="title">
                            </div>
                            <div class="input-group mt-2">
                                <span class="input-group-text">Contenu</span>
                                <textarea class="form-control" id="contenu" name="contenu"
                                    aria-label="With textarea"></textarea>
                            </div>
                            <div class="input-group mt-2">
                                <span class="input-group-text" id="url">Url de l'image</span>
                                <input type="text" class="form-control" name="url2" id="url_image2"
                                    aria-describedby="url">
                            </div>
                            <div class="mt-2">
                                <button type="button" class="btn btn-primary btn-block pull-right"
                                    id="sauvegarder">Sauvegarder</button>
                            </div>
                            <div class="mt-2">
                                <span class="input-group-text" id="ptgraphs">Paragraphes</span>
                                <textarea class="form-control" id="paragraphes" name="paragraphes" readonly></textarea>
                            </div>
                        </div>
                        <div class="col-2 mx-auto">
                            <button type="button" class="btn btn-outline-primary" id="suivant">></button>
                        </div>
                    </div>


                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block mt-5 w-100" id="ajouter">Ajouter</button>
            <button type="submit" class="btn btn-primary btn-block mt-5 w-100" id="modifier" hidden>Modifier</button>

        </form>

        <?php
                require_once("../../Controller/Controller.php");

                $c = new Controller();
                if (
                    isset($_POST["nom"]) && isset($_POST["description"])
                    && isset($_POST["url"]) && isset($_POST["paragraphes"])
                ) {
                    $div1 = explode(" --- ", $_POST["paragraphes"]);
                    $res1 = array();
                    foreach ($div1 as $div) {
                        $div2 = explode(":::", $div);
                        array_push($res1, $div2);
                    }

                    if ($_POST["choix"] == "1") {
                        $c->ajouter_news($_POST["nom"], $_POST["description"], $_POST["url"], $res1);
                    }
                }

                if (isset($_POST["supprimer"])) {
                    $c->supprimer_news($_POST["supprimer"]);
                }
                ?>

    </div>
</div>

<?php

    }

    private function table_parametres()
    {
        require_once("../../Controller/Controller.php");

        $c = new Controller();
        if (isset($_POST["ajouter_news_diapo"])) {
            $c->ajouter_news_diapo($_POST["ajouter_news_diapo"]);
        }
        if (isset($_POST["ajouter_recette_diapo"])) {
            $c->ajouter_recette_diapo($_POST["ajouter_recette_diapo"]);
        }
        if (isset($_POST["enlever_news_diapo"])) {
            $c->enlever_news_diapo($_POST["enlever_news_diapo"]);
        }
        if (isset($_POST["enlever_recette_diapo"])) {
            $c->enlever_recette_diapo($_POST["enlever_recette_diapo"]);
        }
        if (isset($_POST["pourcentage"])) {
            $c->modifier_pourcentage($_POST["pourcentage"]);
        }
        if (isset($_POST["proportion"])) {
            $c->modifier_proportion($_POST["proportion"]);
        }
        ?>
<div class="container mt-4">
    <div>
        <h4 class="mb-4"><b><u>Gestion de la page "Idées de Recettes"</u></b></h4>
        <div class="row">
            <form class="mx-auto col" action="" method="post">
                <div class="input-group mt-2">
                    <span class="input-group-text" id="new">Nouveau pourcentage</span>
                    <input type="text" id="pourcentage" name="pourcentage" class="form-control" aria-label="new"
                        aria-describedby="basic-addon1">
                    <button type="submit" class="btn btn-outline-primary" name="appliquer"
                        id="appliquer">Appliquer</button>
                </div>
            </form>
            <div class="col mt-3">
                <h6 class="text-center">
                    <b> Poucentage actuel : </b> <?php
                            echo $c->afficher_pourcentage();
                            ?> %
                </h6>
            </div>
        </div>
    </div>

    <div>
        <h4 class="mb-4"><b><u>Gestion de la page "Healthy"</u></b></h4>
        <div class="row">
            <form class="mx-auto col" action="" method="post">
                <div class="input-group mt-2">
                    <span class="input-group-text" id="new">Nouvelle proportion</span>
                    <input type="text" id="proportion" name="proportion" class="form-control" aria-label="new"
                        aria-describedby="basic-addon1">
                    <button type="submit" class="btn btn-outline-primary" name="appliquer2"
                        id="appliquer2">Appliquer</button>
                </div>
            </form>
            <div class="col mt-3">
                <h6 class="text-center">
                    <b> Proportion actuelle : </b>
                    <?php
                            echo $c->afficher_proportion();
                            ?> %
                </h6>
            </div>
        </div>
    </div>

    <h4 class="mb-4 mt-4"><b><u>Gestion du diaporama</u></b></h4>
    <div class="row">
        <div class="container col">
            <h6>News</h6>
            <table class="table mt-2 text-center" id="table_news">
                <caption>
                    News disponibles
                </caption>
                <thead>
                    <th>
                        Id
                    </th>
                    <th>
                        Nom
                    </th>
                </thead>
                <tbody id="tbody_news">

                </tbody>
            </table>
        </div>
        <div class="container col">
            <h6>Recettes</h6>
            <table class="table mt-2 text-center col" id="table_recettes">
                <caption>
                    Recettes disponibles
                </caption>
                <thead>
                    <th>
                        Id_Recette
                    </th>
                    <th>
                        Titre_Recette
                    </th>
                    <th>
                        Id_Utilisateur
                    </th>
                </thead>
                <tbody id="tbody_recettes">

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php

    }



    public function afficher_page_acceuil($diapo, $data)
    {
        $this->Head();
        $this->Header();
        $this->Diaporama($diapo);
        $this->Categorie("Entrées", $data[0]);
        $this->Categorie("Plats", $data[1]);
        $this->Categorie("Desserts", $data[2]);
        $this->Categorie("Boissons", $data[3]);
        $this->Footer();
    }

    public function afficher_page_categorie($recettes)
    {
        $this->Head();
        $this->Header();
        $this->Page_Categorie($recettes);

    }

    public function afficher_page_recette($data)
    {
        $this->Head();
        $this->Header();
        $this->Recette($data);
    }

    public function afficher_page_News($news, $recettes)
    {
        $this->Head();
        $this->Header();
        $this->News($news, $recettes);
    }

    public function afficher_page_News2($news)
    {
        $this->Head();
        $this->Header();
        $this->News_page($news);
    }

    public function afficher_page_IdeesRecette($ingredients, $recettes)
    {
        $this->Head();
        $this->Header();
        $this->Page_Idees($ingredients, $recettes);
    }

    public function afficher_page_healthy($recettes)
    {
        $this->Head();
        $this->Header();
        $this->Cadres($recettes);
    }
    public function afficher_page_saisons($recettes)
    {
        $this->Head();
        $this->Header();
        $this->Page_Saisons($recettes);
    }

    public function afficher_page_fetes($recettes)
    {
        $this->Head();
        $this->Header();
        $this->Page_Fetes($recettes);
    }

    public function afficher_page_connexion()
    {

        $this->Head();
        $this->Formulaire_Connexion();
    }

    public function afficher_page_profil($data)
    {
        $this->Head();
        $this->Header();
        $this->Profil($data);
    }

    public function afficher_page_nutrition($ingredients)
    {
        $this->Head();
        $this->Header();
        $this->Ingredients($ingredients);
    }
    public function afficher_page_principale_admin()
    {
        $this->Head();
        $this->page_principale();
    }

    public function afficher_page_gestion_recettes_admin($ingredients)
    {
        $this->Head();
        $this->table_recettes($ingredients);
    }

    public function afficher_page_gestion_nutrition_admin()
    {
        $this->Head();
        $this->table_ingredients();
    }

    public function afficher_page_gestion_utilisateurs_admin()
    {
        $this->Head();
        $this->table_utilisateurs();
    }

    public function afficher_page_gestion_news_admin()
    {
        $this->Head();
        $this->table_news();
    }

    public function afficher_page_parametres_admin()
    {
        $this->Head();
        $this->table_parametres();
    }
}
?>