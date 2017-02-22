<?php

/*
 * This file is part of the Telosys package.
 *
 * Coded by MAILLET Hugues
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller\Telosys\Project;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Class BusLineSearchController.
 */
class BusLineSearchController extends Controller
{
    /**
     *
     * @Rest\Get("/projects/search/buslines/{code}")
     * @Rest\View(statusCode=Response::HTTP_OK)
     * 
     */
    public function getProjectsSearchBusLinesCodeAction($code)
    {
        return $this->get('busline_search_service')->getBusLineByCode($code);
    }
    
    /**
     *
     * @Rest\Get("/projects/search/buslines/global/{content}")
     * @Rest\View(statusCode=Response::HTTP_OK)
     * 
     */
    public function getProjectsSearchBusLinesGlobalContentAction($content)
    {
        return $this->get('busline_search_service')->getBusLineMatchAll($content);
    }
    
    /**
     *
     * @Rest\Get("/projects/search/buslines/global/{content}/alternative")
     * @Rest\View(statusCode=Response::HTTP_OK)
     * 
     */
    public function getProjectsSearchBusLinesGlobalContentAlternativeAction($content)
    {
        return $this->get('busline_search_service')->getBusLineQueryString($content);
    }
    
    /**
     *
     * Sample using Query DSL library for Elasticsearch 
     * 
     * @Rest\Get("/projects/search/buslines/global/{content}/querytool")
     * @Rest\View(statusCode=Response::HTTP_OK)
     * 
     */
    public function getProjectsSearchBusLinesQueryToolsAction($content)
    {
        return $this->get('busline_search_service')->getExtendQueryToolsQueryString($content);
    }
    
    /**
     *
     * @Rest\Get("/projects/search/buslines")
     * @Rest\View(statusCode=Response::HTTP_OK)
     * 
     */
    public function getProjectsSearchBusLinesAction()
    {
        return $this->get('busline_search_service')->getBusLineAll();
    }
}
