<?php

namespace MyApp\EspritBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class horoscopeController extends Controller {

    public function showAction() {

        try {

            if (!@$fluxrsscapricorne = simplexml_load_file('http://www.asiaflash.com/horoscope/rss_horojour_capricorne.xml')) {
                throw new Exception('Flux introuvable');
            }
            if (!@$fluxrssbelier = simplexml_load_file('http://www.asiaflash.com/horoscope/rss_horojour_belier.xml')) {
                throw new Exception('Flux introuvable');
            }

            if (!@$fluxrsslion = simplexml_load_file('http://www.asiaflash.com/horoscope/rss_horojour_lion.xml')) {
                throw new Exception('Flux introuvable');
            }


            if (!@$fluxrssvierge = simplexml_load_file('http://www.asiaflash.com/horoscope/rss_horojour_vierge.xml')) {
                throw new Exception('Flux introuvable');
            }

            if (!@$fluxrsscancer = simplexml_load_file('http://www.asiaflash.com/horoscope/rss_horojour_cancer.xml')) {
                throw new Exception('Flux introuvable');
            }

            if (!@$fluxrssscorpion = simplexml_load_file('http://www.asiaflash.com/horoscope/rss_horojour_scorpion.xml')) {
                throw new Exception('Flux introuvable');
            }

            if (!@$fluxrssbalance = simplexml_load_file('http://www.asiaflash.com/horoscope/rss_horojour_balance.xml')) {
                throw new Exception('Flux introuvable');
            }


            if (!@$fluxrssverseau = simplexml_load_file('http://www.asiaflash.com/horoscope/rss_horojour_verseau.xml')) {
                throw new Exception('Flux introuvable');
            }

            if (!@$fluxrsssagittaire = simplexml_load_file('http://www.asiaflash.com/horoscope/rss_horojour_sagittaire.xml')) {
                throw new Exception('Flux introuvable');
            }

            if (!@$fluxrssgemeaux = simplexml_load_file('http://www.asiaflash.com/horoscope/rss_horojour_gemeaux.xml')) {
                throw new Exception('Flux introuvable');
            }
            if (!@$fluxrsstaureau = simplexml_load_file('http://www.asiaflash.com/horoscope/rss_horojour_taureau.xml')) {
                throw new Exception('Flux introuvable');
            }
            if (!@$fluxrsspoissons = simplexml_load_file('http://www.asiaflash.com/horoscope/rss_horojour_poissons.xml')) {
                throw new Exception('Flux introuvable');
            }

            $fluxrsscapricornedonnee = $fluxrsscapricorne->channel->item->description;           
            $fluxrssbelierdonnee = $fluxrssbelier->channel->item->description;
            $fluxrssliondonnee = $fluxrsslion->channel->item->description;

            $fluxrssviergedonnee = $fluxrssvierge->channel->item->description;
            $fluxrsscancerdonnee = $fluxrsscancer->channel->item->description;

            $fluxrssscorpiondonnee = $fluxrssscorpion->channel->item->description;
            $fluxrssbalancedonnee = $fluxrssbalance->channel->item->description;

            $fluxrssverseaudonnee = $fluxrssverseau->channel->item->description;
            $fluxrsssagittairedonnee = $fluxrsssagittaire->channel->item->description;

            $fluxrssgemeauxdonnee = $fluxrssgemeaux->channel->item->description;
            $fluxrsstaureaudonnee = $fluxrsstaureau->channel->item->description;
            $fluxrsspoissonsdonnee = $fluxrsspoissons->channel->item->description;
            
        } catch (Exception $e) {

            echo $e->getMessage();
        }


        return $this->render('MyAppEspritBundle:horoscope:show.html.twig', array(
                    'capricone' => $fluxrsscapricornedonnee,
                    'belier' => $fluxrssbelierdonnee,
                    'lion' => $fluxrssliondonnee,
                    'vierge' => $fluxrssviergedonnee,
                    'cancer' => $fluxrsscancerdonnee,
                    'scorpion' => $fluxrssscorpiondonnee,
                    'balance' => $fluxrssbalancedonnee,
                    'verseau' => $fluxrssverseaudonnee,
                    'sagittaire' => $fluxrsssagittairedonnee,
                    'gemeaux' => $fluxrssgemeauxdonnee,
                    'poissons' => $fluxrsspoissonsdonnee,
                    'taureau' => $fluxrsstaureaudonnee
                        //poissons taureau
        ));
    }

}
