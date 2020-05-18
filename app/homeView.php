<?php

function homeView()
{
    global $aProfil;

    echo '<!doctype html>
    <html lang="fr">
      <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    
        <title>Code is fun · fabrice1618</title>
      </head>
      <body>
    
        
            <div class="container">
                <header>
                  <nav class="nav justify-content-center">
                    <span class="navbar-brand mb-0 h1">Code is fun</span>
                    <a class="nav-link active" href="/template">Home</a>
                    <a class="nav-link" href="/profil">Profil</a>
                    <a class="nav-link" href="/template/skills.html">Skills</a>
                    <a class="nav-link" href="https://github.com/fabrice1618/code-battle">Code source</a>
                  </nav>
              </header>
                    
                <div class="card" style="width: 51rem;">
                    <div class="card-header">
                        <h1>'.$aProfil['prenom'].' '.$aProfil['nom'].'</h1>
                    </div>
                    <div class="card-body">
                        <img src="/template/tuxguitar.png" class="rounded float-left" alt="Photo profil">
                      <blockquote class="blockquote mb-0">
                        <p>'.$aProfil['presentation'].'</p>
                      </blockquote>
                    </div>
    
                    <div class="card-body">
                        <ul class="list-group list-group-horizontal-lg">
                            <li class="list-group-item d-flex justify-content-between align-items-center">C1&nbsp;<span class="badge badge-success badge-pill">3</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">C2&nbsp;<span class="badge badge-success badge-pill">5</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">C3&nbsp;<span class="badge badge-success badge-pill">1</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">C4&nbsp;<span class="badge badge-success badge-pill">3</span></li>
                            <li class="list-group-item active">C5</li>
                            <li class="list-group-item active">C6</li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">C7&nbsp;<span class="badge badge-success badge-pill">2</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">C8&nbsp;<span class="badge badge-success badge-pill">3</span></li>
                          </ul>
                          <p>&nbsp;</p>
                          <p class="lead d-flex justify-content-center align-middle">
                            <a href="/template/skills.html" class="btn btn-lg btn-success">Voir compétences</a>
                          </p>
        
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Email : <a href="mailto://'.$aProfil['presentation'].'">'.$aProfil['email'].'</a></li>
                        <li class="list-group-item">Github : <a href="https://github.com/fabrice1618">fabrice1618</a></li>
                        <li class="list-group-item">Visit me : <a href="http://netsim.fabricatic.fr">Network Simulator</a></li>
                      </ul>
                    <div class="card-footer text-muted">
                        <ul class="list-group list-group-horizontal-lg">
                            <li class="list-group-item">HTML</li>
                            <li class="list-group-item">CSS</li>
                            <li class="list-group-item">SASS</li>
                            <li class="list-group-item">JS</li>
                            <li class="list-group-item">PHP</li>
                            <li class="list-group-item">SQL</li>
                            <li class="list-group-item">GNU/Linux</li>
                            <li class="list-group-item">Docker</li>
                          </ul>
                      </div>
                  </div>
    
                  <footer>
                      <p>&nbsp;</p>
                    <p class="d-flex justify-content-center align-middle" >Download &nbsp;<a href="#">JSON profile</a>.</p>
                </footer>
          
          </div>
    
       
    
      </body>
    </html>';


}