<?php

function utilisateurView()
{

  $sMainContent = viewMainHeader( '<h3>Utilisateurs</h3>' );

  // Bloc variable
  ////////////////
  $sMainContent .= utilisateurViewCardbobyStart();
  // Bouton ajouter
  if ( in_array( 
        appRequestParam('action'), 
        ['index', 'add', 'groupe', 'supprimer', 'toformateur', 'toadmin', 'active', 'desactive', 'newpwd'] 
      ) ) {
    $sMainContent .= utilisateurViewBoutonajouter();
  }
  // Formulaire addform
  if ( appRequestParam('action') === 'addform' ) {
    $sMainContent .= utilisateurViewFormajouter();
  }
  // Formulaire modification groupe
  if ( appRequestParam('action') === 'groupeform' ) {
    $sMainContent .= utilisateurViewFormgroupe();
  }
  $sMainContent .= utilisateurViewCardbobyEnd();

  // Bloc liste administrateurs
  $sMainContent .= utilisateurViewBlocUser( '<h4>Administrateurs</h4>', 'admin' );

  // Bloc liste formateurs
  $sMainContent .= utilisateurViewBlocUser( '<h4>Formateurs</h4>', 'formateur' );

  // Bloc liste membres
  $sMainContent .= utilisateurViewBlocUser( '<h4>Membres</h4>', 'membre' );

  $sMainContent .= viewMainFooter();

  return($sMainContent);
}

function utilisateurViewCardbobyStart()
{
  return('<div class="card-body" style="margin-left: 1rem;">'.PHP_EOL);
}

function utilisateurViewCardbobyEnd()
{
  return('</div>'.PHP_EOL);
}

function utilisateurViewBoutonajouter()
{
  $sURL = routerMakeURL('utilisateur', ['action'=>'addform']);

  return('  <form>
              <fieldset style="padding: 1rem;">
              <button type="button" class="btn btn-outline-primary"><a href="'.$sURL.'">Ajouter</a></button>
              </fieldset>              
            </form>'.PHP_EOL);
}

function utilisateurViewFormajouter()
{

  $sURL = routerMakeURL('utilisateur', ['action'=>'add']);

  return('  
  <form action="'.$sURL.'" method="post">
  <fieldset class="border border-primary rounded" style="padding: 1rem;margin-bottom: 1rem;">
  <input type="hidden" name="token" value="0123456789abcdef">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputUtilEmail">Email</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="email" name="inputUtilEmail" class="form-control" id="inputUtilEmail" placeholder="email@example.com" aria-label="Email" aria-describedby="basic-addon1" required value="">
      </div>                
    </div>

    <div class="form-group col">
      <label for="inputUtilType">Type de compte</label>
      <select name="inputUtilType" id="inputUtilType" class="custom-select" style="margin-right: 1rem;">
        <option value="null" selected>Type de compte</option>
        <option value="admin">Administrateur</option>
        <option value="form">Formateur</option>
      </select>
    </div>

  </div>
  <button type="submit" class="btn btn-primary">Enregistrer</button>
</fieldset>
</form>
  '.PHP_EOL);
}

function utilisateurViewFormgroupe()
{
  $sURL = routerMakeURL('utilisateur', ['action'=>'groupe']);

  return('  
  <form action="'.$sURL.'" method="post">
  <fieldset class="border border-primary rounded" style="padding: 1rem;margin-bottom: 1rem;">
  <input type="hidden" name="token" value="0123456789abcdef">
  <input type="hidden" name="userid" value="0">
  <div class="form-row">
  <div class="form-group col-md-6">
  <label for="inputUtilEmail">Email du formateur</label>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">@</span>
    </div>
    <input type="email" name="inputUtilEmail" class="form-control" id="inputUtilEmail" placeholder="email@example.com" aria-label="Email" aria-describedby="basic-addon1" readonly value="toto@example.com">
  </div>                
</div>
    <div class="form-group col-md-6">
      <label for="inputUtilGroupe">Groupes</label>
      <select name="inputUtilGroupe[]" id="inputUtilGroupe" class="form-control" multiple>
        <option value="1">DWWM 2019/2020</option>
        <option value="2">TSSR 2019/2020</option>
      </select>
    </div>
    </div>
  <button type="submit" class="btn btn-primary">Enregistrer</button>
</fieldset>
</form>
  '.PHP_EOL);
}


function utilisateurViewBlocUser( $sTitre, $sType )
{
  $sReturn = utilisateurViewCardbobyStart();
  $sReturn .= $sTitre.PHP_EOL;
  $nCount = 0;
  foreach ( appGetData('user_list') as $aUser ) {
    if ($aUser['type'] === $sType) {
      $nCount++;
      $sReturn .= utilisateurViewUser($aUser);
    }
  }
  if ($nCount==0) {
    $sReturn .= '<div class="row"><p class="col-md-12">Pas d\'utilisateurs dans cette liste</p></div>';
  }
  $sReturn .= utilisateurViewCardbobyEnd();

  return($sReturn);
}

function utilisateurViewUser($aUser)
{

  if ($aUser['status'] == 'I') {
    $sUserActiveText = " text-danger";
  } else {
    $sUserActiveText = "";
  }

  $sReturn = '
  <div class="row">
  <p class="col-md-6'.$sUserActiveText.'">'.$aUser['email'].'</p>
  <p class="col-md-5">'.$aUser['view_groupe'].'</p>
  <div class="dropdown col-md-1">
    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      ...
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';

  $sReturn .= utilisateurViewUserMenu( $aUser['userid'], $aUser['type'], $aUser['status'], appGetData('token') );
  $sReturn .= '</div>
            </div>
          </div>';

  return($sReturn);
}

function utilisateurViewUserMenu( $sUserId, $sUserType, $sUserStatus, $sToken )
{
  $sReturn = "";

  if ($sUserType=='formateur') {
    $sReturn .= utilisateurViewUserMenuItem( 
      'utilisateur', 
      [ 'action' => 'groupeform', 'userid' => $sUserId ], 
      'Modifier groupes'
    );
  }

  if ( in_array($sUserType, ['formateur','admin']) ) {
    $sReturn .= utilisateurViewUserMenuItem( 
      'utilisateur', 
      [ 'action' => 'supprimer', 'userid' => $sUserId, 'token' => $sToken ], 
      'Supprimer'
      );

    $sReturn .= '<div class="dropdown-divider"></div>';
  }

  if ($sUserType=='formateur') {
    $sReturn .= utilisateurViewUserMenuItem( 
      'utilisateur', 
      [ 'action' => 'toadmin', 'userid' => $sUserId, 'token' => $sToken ], 
      'Changer type en admin'
      );
  }

  if ($sUserType=='admin') {
    $sReturn .= utilisateurViewUserMenuItem( 
      'utilisateur', 
      [ 'action' => 'toformateur', 'userid' => $sUserId, 'token' => $sToken ], 
      'Changer type en formateur'
      );
  }

  if ($sUserStatus=="A") {
    $sReturn .= utilisateurViewUserMenuItem( 
      'utilisateur', 
      [ 'action' => 'desactive', 'userid' => $sUserId, 'token' => $sToken ], 
      'Désactiver'
    );
  } else {
    $sReturn .= utilisateurViewUserMenuItem( 
      'utilisateur', 
      [ 'action' => 'active', 'userid' => $sUserId, 'token' => $sToken ], 
      'Activer'
    );
  }

  $sReturn .= utilisateurViewUserMenuItem( 
    'utilisateur', 
    [ 'action' => 'newpwd', 'userid' => $sUserId, 'token' => $sToken ], 
    'Nouveau mot de passe'
  );

  return($sReturn);
}

function utilisateurViewUserMenuItem( $sController, $aParam, $sDescURL )
{
  return( sprintf(
      '<a class="dropdown-item" href="%s">%s</a>', 
      routerMakeURL($sController, $aParam), 
      $sDescURL 
    ));
}

