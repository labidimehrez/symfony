<?php

 namespace MyApp\ForumBundle\Twig\Extension;
  class ContenuExtension extends \Twig_Extension
  {
      
      public function getFilters() {
          return array( new \Twig_SimpleFilter('Contenu',  array($this,'Contenu')));
      }
      
      function contenu($contenu)
      {
//      return strip_tags($contenu);
     $contenu = str_replace("&nbsp;", ' ', $contenu);
     $contenu = str_replace("<br />", '', $contenu);
     $contenu = str_replace("&eacute;", 'é', $contenu);
     $contenu = str_replace("&#39;", "'", $contenu);     
     $contenu = str_replace("&agrave;", 'à', $contenu);  
     $contenu = str_replace("&egrave;", 'è', $contenu);
     $contenu = str_replace("&ccedil;", 'ç', $contenu);
     $contenu = str_replace("&Agrave;", 'À', $contenu);
     $contenu = str_replace("&ecirc;", 'ê', $contenu);
      $contenu = str_replace("<p>", '', $contenu);
       $contenu = str_replace("</p>", '', $contenu);
       $contenu = str_replace("Ã©", 'é', $contenu);
     
  
  $contenu = str_replace("Ã§", 'ç', $contenu);
  $contenu = str_replace("Ã¨", 'è', $contenu);
//    $contenu =strip_tags($contenu, '&nbsp;');
     
    return $contenu;
      }       

      public function getName() {
          return 'contenu_extension'; 
      }
  }
  