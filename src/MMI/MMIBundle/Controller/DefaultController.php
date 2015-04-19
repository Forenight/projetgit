<?php

namespace MMI\MMIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function accueilAction()
    {
        return $this->render('MMIMMIBundle:Default:accueil.html.twig');
    }
    public function agendaAction()
    {
    	return $this->render('MMIMMIBundle:Default:agenda.html.twig');
    }
    public function newsAction()
    {
    	return $this->render('MMIMMIBundle:Default:news.html.twig');
    }
    public function eventsAction()
    {
    	return $this->render('MMIMMIBundle:Default:events.html.twig');
    }
    public function portfolioAction()
    {
    	return $this->render('MMIMMIBundle:Default:portfolio.html.twig');
    }
    public function videosAction()
    {
    	return $this->render('MMIMMIBundle:Default:videos.html.twig');
    }
    public function directAction()
    {
        $news = $this->getDoctrine()->getRepository('MMIMMIBundle:news')->findAll();
        return $this->render('MMIMMIBundle:Default:direct.html.twig', array('news' => $news));
    }
    public function getNewsAction()
    {
        $news = $this->getDoctrine()->getRepository('MMIMMIBundle:news')->findAll();
        $output = '';
        foreach ($news as $new) {
            $output .= '<li>'.$new->getDescription().'</li>'.PHP_EOL;
        }

        return new Response($output, 200, array('Content-type' => 'text/html'));
    }
    public function playlistAction()
    {
        return $this->render('MMIMMIBundle:Playlist:index.html.twig');
    }

    public function grilleAction()
    {
        return $this->render('MMIMMIBundle:grille:index.html.twig');
    }

}

