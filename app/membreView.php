<?php 

function membreView()
{
  global $nCompetenceId;

  if ($nCompetenceId==0) {
    return( readTemplate("membre-profil.part"));
  } else {
    return( readTemplate("membre-competence.part"));
  }
  
}