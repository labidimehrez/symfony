<?php

namespace MyApp\ArticleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyApp\ArticleBundle\Form\ArticleType;
use MyApp\ArticleBundle\Entity\Article;

class ArticleController extends Controller {

    public function addAction() {

        $em = $this->getDoctrine()->getManager();
        $tags = $em->getRepository('MyAppForumBundle:tag')->findAll();
        $manager = $this->get('collectify_article_manager');/** equivalent de em manager * */
        $articleWithfixedposition = $manager->getArticleWithFixedPosition(); /* array des objetcs a positions FIXéS */
        $articleNOfixedposition = $manager->getArticleNOFixedPosition(); /* array  des objetcs a  positions non fixés  ordonnés ACS positions */


        $lespositionsoccupés = $manager->getPositionOccuped(); /* array des positions occupés */
        $premierepositionlibre = $manager->getFirstPositionFree($lespositionsoccupés); /* int la premiere position libre sinon return boolean false */
        $article = new Article();
        $form = $this->createForm(new ArticleType, $article);
        $request = $this->getRequest();
        if ($request->isMethod('Post')) {
            $form->bind($request);
            if ($form->isValid()) {
                $article = $form->getData();
                /* traitement special pour le choix des tags */
                $managertag = $this->get('collectify_tag_manager'); /* em pour TAG !! */
                $inputtag = $this->getRequest()->get('inputtag');

                $alltags = $managertag->getAll(); /* array de tous les objets tags  */
                $tagaajouté = array(); // tableau vide
                foreach ($alltags as $tag) {
                    $tagtitle = $tag->getTitle(); /* get title of objects :D */
                    if ($inputtag == $tagtitle) {
                        $selectedtag = $managertag->getByTitle($tagtitle); /* get objet tag by title */
                        array_push($tagaajouté, $selectedtag);
                        $article->setTags($tagaajouté);
                    }
                }
                /* traitement special pour le choix des tags */

                $positiondelarticleenajout = $form["position"]->getData(); /* INTEGER la position du nouveau article ajouté */
                $fixedpositionChecked = $form["fixedposition"]->getData(); /*  Boolean TRUE si Fixed Position is Checked */
                /* $lapositionchoisie contient 'vide' si position vide sinon 'contenufixe' ou 'contenuNONfixe' */
                $lapositionchoisie = $manager->Disponiblitedelapositionchoisie($positiondelarticleenajout);
            $message=  $manager->traitementenajout($positiondelarticleenajout, $fixedpositionChecked, $lapositionchoisie, $articleNOfixedposition, $premierepositionlibre, $article);
//              var_dump($message);exit;
            if($message=="STOP. The chosen position is fixed. Please unfix this position first.")
            {$this->get('session')->getFlashBag()->set('messagearticlefailtitre', 'la position choisie est déja fixée, veuillez choisir autre ou librez-la avant  '); }
                return $this->redirect($this->generateUrl('my_app_article_article_add'));
            }
        }
        return $this->render('MyAppArticleBundle:article:add.html.twig', array('form' => $form->createView(), 'tags' => $tags));
    }

    public function showAction(Request $request) {



        $em = $this->getDoctrine()->getManager();
        /*         * *****************    recuperation de tout les article s    ************ */
        $article = $em->getRepository('MyAppArticleBundle:article')->getAllArticle();
        $publicite = $em->getRepository('MyAppEspritBundle:publicite')->getintPub();
        $sujet = $em->getRepository('MyAppForumBundle:sujet')->findAll();
        $sujetlimited = $em->getRepository('MyAppForumBundle:sujet')->getAllsujetrecent();
        /*  sortedtopic by comment */
        $managerarticle = $this->get('collectify_article_manager'); /* em pour article !! */
        $sortedtopic = $managerarticle->debatsortedmostcommented();

        $sujetneverarticlebeforearray = array();
        $articlearray = array();

        foreach ($sujet as $s) {
            array_push($sujetneverarticlebeforearray, $s);
        }

        foreach ($article as $ar) {
            if ($ar->getPosition() < 16) {/* il faut pas avoir un parmi 1-15 positions */
                array_push($articlearray, $ar);
            }
        }

        //  var_dump($sujetneverarticlebeforearray);exit;
        foreach ($sujetneverarticlebeforearray as $snar) {
            foreach ($articlearray as $ar) {
                if ($snar->getSujet() == $ar->getHeadline()) {
                    unset($sujetneverarticlebeforearray[array_search($snar, $sujetneverarticlebeforearray)]);
                }
            }
        }
//        var_dump($sujetneverarticlebeforearray);exit;

        if ($sujetneverarticlebeforearray == NULL) {
            array_push($sujetneverarticlebeforearray, array());
        }
        $sujetnotarticle = $sujetneverarticlebeforearray;

        $outputsujetnotarticle = array_slice($sujetnotarticle, 0, 7); /* get Only 7 element */
        $sortedtopicarticle = array_slice($sortedtopic, 0, 7); /* get Only 7 element */

        return $this->render('MyAppArticleBundle:article:show.html.twig', array(
                    'article' => $article, 'publicite' => $publicite, 'sujet' => $sujetlimited,
                    'mostcommenteddebat' => $sortedtopicarticle, 'sujetnotarticle' => $outputsujetnotarticle));
    }

    public function deleteAction(article $article) {
        $manager = $this->get('collectify_article_manager'); /* em pour article !! */
        $em = $this->getDoctrine()->getManager();
        $selectarticle = $em->getRepository('MyAppArticleBundle:article')->find($article->getId());

        $manager->ShiftToRightNofixedPositionOneDelete($selectarticle);
        $manager->remove($article);
        $this->get('session')->getFlashBag()->set('message', 'Ce article  disparait !!');
        return $this->redirect($this->generateUrl('my_app_article_article_manage'));
    }

    public function manageAction() {
        $em = $this->getDoctrine()->getManager();
        /*         * *******************    recuperation de tout les article s    ************ */
        $article = $em->getRepository('MyAppArticleBundle:article')->findBy(array(), array('position' => 'asc'));
        $form = $this->createFormBuilder($article)->add('article')->getForm();
        return $this->render('MyAppArticleBundle:article:manage.html.twig', array(
                    'form' => $form->createView(), 'article' => $article
        ));
    }

    public function deletemoreAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $manager = $this->get('collectify_article_manager');/** equivalent de em manager * */
        $article = $em->getRepository('MyAppArticleBundle:article')->findAll();
        $articleNOfixedposition = $manager->getArticleNOFixedPosition(); /* array  des objetcs a  positions non fixés  ordonnés ACS positions */
        $articlenofixedpositionreversed = array_reverse($articleNOfixedposition); /* ar non fixé le plus haut indice  egal 0 */
        $form = $this->createFormBuilder($article)->add('article')->getForm();
        $totalnumberofar = intval($em->getRepository('MyAppArticleBundle:article')->getARnumber());


        /* delete more  checked */
        $ids = $this->getRequest()->get('mesIds');
        if ($totalnumberofar <= 2) {
            $this->get('session')->getFlashBag()->set('message', 'At least  15 AR  !');
        }
        /*         * ********************************************************************************************** */
        if ((count($ids) > 1) && ( $totalnumberofar > 2)) {//15
            $articled = $em->getRepository('MyAppArticleBundle:article')->findBy(array('id' => $ids), array('position' => 'asc'));

            $manager->removemore($articled);



            /* Traitement pour supprimer plusieurs et translater plusieurs */
            /*             * ***************************************************************** */


            return $this->render('MyAppArticleBundle:article:manage.html.twig', array(
                        'form' => $form->createView(), 'article' => $article));
        }
        /* delete more  checked */

        /*         * ******************************************************************************************************* */

        /* delete one checked */
        if ((count($ids) === 1) && ( $totalnumberofar > 2)) {
            $articled = $em->getRepository('MyAppArticleBundle:article')->findBy(array('id' => $ids));
            $article = $articled[0];
            if ($articleNOfixedposition != NULL) {
                $manager->ShiftToRightNofixedPositionOneDelete($article);
            }
            $manager->remove($article);

            return $this->render('MyAppArticleBundle:article:manage.html.twig', array(
                        'form' => $form->createView(), 'article' => $article));
        }
        /* delete one  checked */
        /*         * ********************************************************************************************** */

        $positions = $this->getRequest()->get('i'); /* tableau de string position text input deja   :D */
        if ($positions != NULL) {
            if (($positions != array_unique($positions)) && ($positions != NULL)) {
                $this->get('session')->getFlashBag()->set('message', 'More than one AR per position  !!');
            } else {
                $manager->UpdatePosition($positions);  /*  mise a jour des positions AR selon les input text */
            }
            /* test pour la duplication des valeurs positions AR */


            $fixedornotvalue = $this->getRequest()->get('fixedposition'); /* tableau de string id deja coché :D */
            $manager->makeFixorUnfix($fixedornotvalue);


            return $this->render('MyAppArticleBundle:article:manage.html.twig', array('form' => $form->createView(), 'article' => $article));
        }
        /*         * ********************************************************************************************** */
        /* fin de la validation des valeurs positions AR */





        return $this->render('MyAppArticleBundle:article:manage.html.twig', array(
                    'form' => $form->createView(), 'article' => $article
        ));
    }

    public function editAction($id, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $tags = $em->getRepository('MyAppForumBundle:tag')->findAll();
        $manager = $this->get('collectify_article_manager');/** equivalent de em manager * */
        $articleWithfixedposition = $manager->getArticleWithFixedPosition(); /* array des objetcs a positions FIXéS */
        $articleNOfixedposition = $manager->getArticleNOFixedPosition(); /* array  des objetcs a  positions non fixés  ordonnés ACS positions */


        $lespositionsoccupés = $manager->getPositionOccuped(); /* array des positions occupés */
        $premierepositionlibre = $manager->getFirstPositionFree($lespositionsoccupés); /* int la premiere position libre sinon return boolean false */



        $article = $em->getRepository('MyAppArticleBundle:Article')->find($id);
        if (!$article) {
            throw $this->createNotFoundException(
                    'no article found for id ' . $id
            );
        }

        $form = $this->createFormBuilder($article)
                ->add('headline')
                ->add('file', 'file', array('required' => false))
                ->add('copyrights', null, array('required' => false))
                ->add('fixedposition', 'checkbox', array('required' => false, 'data' => false))
                ->add('style', 'entity', array(
                    'class' => 'MyApp\ArticleBundle\Entity\Style',
                    'property' => 'title',
                    'expanded' => false,
                    'multiple' => false,
                    'required' => true))
                ->add('lien')
                ->add('position', 'choice', array(
                    'choices' => array(
                        '1' => 'Position 1',
                        '2' => 'Position 2',
                        '3' => 'Position 3',
                        '4' => 'Position 4',
                        '5' => 'Position 5',
                        '6' => 'Position 6',
                        '7' => 'Position 7',
                        '8' => 'Position 8',
                        '9' => 'Position 9',
                        '10' => 'Position 10',
                        '11' => 'Position 11',
                        '12' => 'Position 12',
                        '13' => 'Position 13',
                        '14' => 'Position 14',
                        '15' => 'Position 15'
                    ),
                    'expanded' => false,
                    'multiple' => false
                ))
                ->add('tags')
                ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $article = $form->getData();
            /* traitement special pour le choix des tags */
            $managertag = $this->get('collectify_tag_manager'); /* em pour TAG !! */
            $inputtag = $this->getRequest()->get('inputtag');

            $alltags = $managertag->getAll(); /* array de tous les objets tags  */
            $tagaajouté = array(); // tableau vide
            foreach ($alltags as $tag) {
                $tagtitle = $tag->getTitle(); /* get title of objects :D */
                if ($inputtag == $tagtitle) {
                    $selectedtag = $managertag->getByTitle($tagtitle); /* get objet tag by title */
                    array_push($tagaajouté, $selectedtag);
                    $article->setTags($tagaajouté);
                }
            }
            /* traitement special pour le choix des tags */

            $positiondelarticleenajout = $form["position"]->getData(); /* INTEGER la position du nouveau article ajouté */
            $fixedpositionChecked = $form["fixedposition"]->getData(); /*  Boolean TRUE si Fixed Position is Checked */
            /* $lapositionchoisie contient 'vide' si position vide sinon 'contenufixe' ou 'contenuNONfixe' */
            $lapositionchoisie = $manager->Disponiblitedelapositionchoisie($positiondelarticleenajout);
            $manager->traitementenajout($positiondelarticleenajout, $fixedpositionChecked, $lapositionchoisie, $articleNOfixedposition, $premierepositionlibre, $article);
            return $this->redirect($this->generateUrl('my_app_article_article_edit', array('id' => $id)));
        }

        return $this->render('MyAppArticleBundle:article:edit.html.twig', array('form' => $form->createView(), 'article' => $article, 'tags' => $tags));
    }

    public function voirAction($id, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $managerarticle = $this->get('collectify_article_manager');/** equivalent de em manager * */
        $article = $managerarticle->getOne($id);
        $publicite = $em->getRepository('MyAppEspritBundle:publicite')->findBy(array('position' => 22));


        if (!$article) {
            throw $this->createNotFoundException('no  article found for id ' . $id);
        }

        $sujet = $em->getRepository('MyAppForumBundle:sujet')->findBy(array('sujet' => $article->getHeadline()));

        return $this->render('MyAppArticleBundle:article:voir.html.twig', array(
                    'article' => $article, 'publicite' => $publicite, 'sujet' => $sujet
        ));
    }

}
