<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Panier;
use AppBundle\Entity\FruitPanier;
use AppBundle\Entity\Fruit;

class BasketController extends Controller
{
    /**
     * @Route("/basket", name="basket")
     */
    public function indexAction(Request $request)
    {
    	$session = $request->getSession();
    	if($session->has('basket')){
    		$basket = $session->get('basket');
    	} else {
    		$basket = [];
    	}

    	


    	$response = new Response();
    	$fruits = $this->getDoctrine()->getRepository('AppBundle:Fruit')->findAll();
        $response = $this->render('basket/basket.html.twig', array(
        	'fruits' => $fruits,
        	'basket' => $basket));
		return $response;
    }


    /**
     * @Route("/basket/session", name="panierSession")
     */
    public function sendBasket(Request $request)
    {
    	$session = $request->getSession();
    	if($session->has('basket')){
    		$basket = $session->get('basket');
    	} else {
    		$basket = [];
    	}

    	$encoders = array(new JsonEncoder());
		$normalizers = array(new ObjectNormalizer());

		$serializer = new Serializer($normalizers, $encoders);
    	$response = new Response($serializer->serialize($basket, 'json'));
        return $response;
    }

    /**
     * @Route("/basket/store", name="storePanier")
     */
    public function storeBasket(Request $request)
    {
    	$response = new Response();
    	$session = $request->getSession();
    	if($session->has('basket')){
    		$basket = $session->get('basket');
    	}
    	$panier = new Panier();
    	$fruitPanier[] = array();
    	$prixHt = 0;

    	$em = $this->getDoctrine()->getManager();
    	
    	foreach ($basket as $key => $value) {
    		$prixHt += $value['number'] * $value['prixHt'];
    	}
    	$panier->setDateTransaction(new \DateTime());
    	$panier->setTotalHt($prixHt);
    	$panier->setTotalTtc($prixHt * 1.2);
    	$panier->setUserId(1);

    	$em->persist($panier);
    	$em->flush();

    	foreach ($basket as $key => $value) {
    		$fruitTemp = new FruitPanier();
    		$fruitTemp->setIdPanier($panier->getId());
    		$fruitTemp->setIdFruit($value['id']);
    		$fruitTemp->setQuantiteFruit($value['number']);
    		$em->persist($fruitTemp);
    	}
    	$em->flush();
    	$basket = [];
    	$session->set('basket', $basket);
    	$response->setStatusCode(Response::HTTP_OK);
        return $response;
    }


    /**
     * @Route("/basket/{idPanier}/{idFruit}", name="add_Fruit")
     */
    public function sendFruitInformation($idPanier, $idFruit, Request $request)
    {
    	$session = $request->getSession();
    	if($session->has('basket')){
    		$basket = $session->get('basket');
    	} else {
    		$basket = array();
    	}

    	$encoders = array(new JsonEncoder());
		$normalizers = array(new ObjectNormalizer());

		$serializer = new Serializer($normalizers, $encoders);
    	$fruit = $this->getDoctrine()->getRepository('AppBundle:Fruit')->findOneById($idFruit);


    	$i = 0;
    	$ok = False;
    	while(!$ok && $i < sizeOf($basket)){
    		if($basket[$i]['id'] == $fruit->getId()){
    			$basket[$i]['number'] = $basket[$i]['number'] + 1;
    			$ok = True;
    		}
    		$i++;
    	}
    	if(!$ok){
    		$newFruit = array(array('id'=>$fruit->getId(), 'name'=>$fruit->getNomFruit(), 'number'=>1, 'prixHt'=>$fruit->getPrixHt()));
    		$basket = array_merge($basket, $newFruit);
    	}


    	$session->set('basket', $basket);
        $response = new Response($serializer->serialize($fruit, 'json'));
		$response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}