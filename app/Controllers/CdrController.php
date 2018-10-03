<?php

namespace App\Controllers;

use App\Filters\Filter;
use App\Models\Cdr;
use Aura\Filter\FilterFactory;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class CdrController
 *
 * @package  CDR-API
 * @author   mrpbueno
 * @license  http://www.gnu.org/licenses/gpl-3.0.txt GPLv3+
 * @link     https://github.com/goiabinha/cdr-api
 */
class CdrController
{
    /**
     * Method calldate
     *
     * @param Request  $request  Request
     * @param Response $response Response
     * @param array    $args     Arguments
     *
     * @return Response
     */
    public function calldate(Request $request, Response $response, $args)
    {
        $filter_factory = new FilterFactory();
        $filter = $filter_factory->newSubjectFilter();
        $filter->validate('limit')->is('int');
        $filter->validate('calldate')->is('dateTime');
        $success = $filter->apply($args);
        if (!$success) {
            return $response->withJson(['message' => 'not found'], 404);
        }
        $cdrs = Cdr::where('calldate', '>', $args['calldate'])->limit($args['limit'])->get();

        return $response->withJson($cdrs, 200);
    }

    /**
     * Method uniqueid
     *
     * @param Request  $request  Request
     * @param Response $response Response
     * @param array    $args     Arguments
     *
     * @return Response
     */
    public function uniqueid(Request $request, Response $response, $args)
    {
        $filter_factory = new FilterFactory();
        $filter = $filter_factory->newSubjectFilter();
        $filter->validate('limit')->is('int');
        $filter->validate('uniqueid')->is('float');
        $success = $filter->apply($args);
        if (!$success) {
            return $response->withJson(['message' => 'not found'], 404);
        }
        $cdrs = Cdr::where('uniqueid', '>', $args['uniqueid'])->limit($args['limit'])->get();

        return $response->withJson($cdrs, 200);
    }
}
