<?php 

function profilView()
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
                    <a class="nav-link" href="/template/profil.html">Profil</a>
                    <a class="nav-link" href="/template/skills.html">Skills</a>
                    <a class="nav-link" href="https://github.com/fabrice1618/code-battle">Code source</a>
                  </nav>
                </header>
    
    
              <div class="row">
    
              <form>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputNom">Nom</label>
                    <input type="text" name="inputNom" class="form-control" id="inputNom" value="'.$aProfil['nom'].'">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPrenom">Prenom</label>
                    <input type="text" name="inputPrenom" class="form-control" id="inputPrenom" value="'.$aProfil['prenom'].'">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-5">
                    <label for="fileAvatar">Avatar</label>
                    <input type="file" class="form-control-file" id="fileAvatar">
                  </div>
                  <div class="form-group col-md-7">
                    <label for="inputPresentation">Présentation</label>
                    <textarea class="form-control" id="inputPresentation" placeholder="Votre présentation..."  rows="5" cols="50"></textarea>
                  </div>
                </div> 
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="inputEmail">Email</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@</span>
                      </div>
                      <input type="text" class="form-control" name="inputEmail" id="inputEmail" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" value="'.$aProfil['email'].'">
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="inputGithub">Compte github</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2">https://github.com/</span>
                      </div>
                      <input type="text" class="form-control" id="inputGithub" placeholder="Compte github" aria-label="Compte github" aria-describedby="basic-addon2">
                    </div>
                  </div>
                </div>
    
    
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="inputWeb">Site web</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">https://</span>
                      </div>
                      <input type="text" class="form-control" id="inputWeb" placeholder="Site web" aria-label="Site web" aria-describedby="basic-addon3">
                    </div>
                  </div>
                </div>
    
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputTechno">Technologies</label>
                    <select id="inputTechno" class="form-control" multiple>
                      <option value="html">HTML</option>
                      <option value="css">CSS</option>
                      <option value="sass">SASS</option>
                      <option value="js">JS</option>
                      <option value="php">PHP</option>
                      <option value="sql">SQL</option>
                      <option value="linux">GNU/Linux</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputTechnoPlus">Autre technologie</label>
                    <input type="text" class="form-control" id="inputTechnoPlus">
                  </div>
                </div>
    
                <div class="form-row">
                </div>
    
                <button type="submit" class="btn btn-primary">Enregistrer</button>
              </form>
    
                  <footer>
                      <p>&nbsp;</p>
                    <p class="d-flex justify-content-center align-middle" >Download &nbsp;<a href="#">JSON technologies</a>.&nbsp;Upload &nbsp;<a href="#">JSON tecnologies</a></p>
                </footer>
          
          </div>
          </div>
       
    
      </body>
    </html>';
}