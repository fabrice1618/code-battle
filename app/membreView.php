<?php 

function membreView()
{
  //global $nCompetenceId;

  appRequestParamSetdefault( 'competenceid', 'get', '0' );
  $nCompetenceId = appRequestParam('competenceid');

  if ($nCompetenceId==0) {
    return( readTemplate("membre-profil.part"));
  } else {
    return( readTemplate("membre-competence.part"));
  }
  
}