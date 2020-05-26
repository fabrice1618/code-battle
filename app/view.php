<?php

function viewRender( $sControllerView )
{

  if (! function_exists($sControllerView)) {
    // Si la vue n'est pas disponible la charger
    $sFileName = '../app/' . $sControllerView . '.php';
    if ( file_exists($sFileName) ) {
      require_once($sFileName);
    }
  } 

    // Demarre la bufferisation de sortie
    ob_start();
    echo('<!doctype html>'.PHP_EOL);
    echo('<html lang="fr">'.PHP_EOL);
    echo('<head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
            <title>REAC</title>
        </head>'.PHP_EOL);
    echo('<body>'.PHP_EOL);

    // Afficher le menu
    viewNavbar();

    // Afficher le contenu principal de la page
    echo( $sControllerView() );

    echo('  <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
          </body>');
    echo('</html>');
    // envoi le buffer sur la sortie puis libere le buffer
    ob_end_flush();
}

function viewNavbar()
{

    echo('
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/home">
          <img src="/template/tuxguitar.png" width="30" height="30" alt="" loading="lazy">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/home">Home</a>
            </li>
            ');

    if ( appGetUser('type')=='admin' ) {
        viewMenuAdmin();
    }
    
    if ( isAuthLogin()) {
      viewMenuProfil();
    } else {
      viewMenuLogin();
    }

    echo('
            </ul>
            <blockquote class="navbar-text blockquote">
              <p class="mb-0"><small><em>In Reac we trust</em></small></p>
            </blockquote>
        </div>
      </nav>
    </div>
    ');

}

function viewMenuLogin()
{

    echo('
    <li class="nav-item dropdown" style="min-width: 20rem">
    <button class="btn btn-outline-success dropdown-toggle" type="button" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Connexion
    </button>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <form action="/home?action=login" method="post" class="px-4 py-3">
        <input type="hidden" name="token" value="0123456789abcdef">
        <div class="form-group">
          <label for="exampleDropdownFormEmail1">Email</label>
          <input type="email" name="loginEmail" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
        </div>
        <div class="form-group">
          <label for="exampleDropdownFormPassword1">Password</label>
          <input type="password" name="loginPassword" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
        </div>
        <div class="form-group">
          <div class="form-check">
            <input type="checkbox" name="loginRemember" class="form-check-input" id="dropdownCheck">
            <label class="form-check-label" for="dropdownCheck">
              Connexion permanente
            </label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Connexion</button>
      </form>
    </div>
  </li>
  ');

}

function viewMenuProfil()
{

    echo('
    <li class="nav-item dropdown" style="min-width: 20rem">
    <button class="btn btn-outline-success dropdown-toggle" type="button" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.
      appGetUser('email') .
    '</button>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    ');    

    if ( appGetUser('type')=='membre' ) {
        echo('
        <a class="dropdown-item" href="/profil?userid=1">Mon profil</a>
        ');    
    }

    echo('
      <a class="dropdown-item" href="/home?action=logout">Se déconnecter</a>
    </div>
  </li>            
  ');

}

function viewMenuAdmin()
{
    echo('
    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Admin
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="/utilisateur">Utilisateurs</a>
      <a class="dropdown-item" href="/formation">Formations</a>
      <a class="dropdown-item" href="/competence">Compétences</a>
      <a class="dropdown-item" href="/groupe">Groupes</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item disabled" href="/genac">Imprimer GENAC</a>
    </div>
  </li>
  ');
}

function viewMainHeader( $sHeader )
{
  return('
  <div class="container">
  <div class="card" style="margin-top: 2rem;margin-bottom: 2rem;">
    <div class="card-header">'.$sHeader.'</div>
    ');

}


function viewMainFooter()
{
  return('
  <div class="card-footer text-muted"><p></p></div>
  </div>
  </div>
  ');

}


function readTemplate( $sTemplate )
{
    $sReturn = "";
    $sPath = "../template/";

    if (file_exists($sPath.$sTemplate)) {
        $fp = fopen($sPath.$sTemplate, 'r');
        $sReturn = fread($fp,20*1024);
        fclose($fp);
    }

    return($sReturn);
}