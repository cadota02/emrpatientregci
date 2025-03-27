<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @OA\Info(
 *     title="iHOMIS+ API",
 *     version="0.1",
 * )
 * @OA\Server(url="https://codeigniter.test")
 * @OA\SecurityScheme(
 * securityScheme="BasicAuth",
 * type="http",
 * scheme="basic"
 * )
 */

class Regions extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

        /**
     * @OA\GET(
     *     path="/api/v1/regions",
     *     summary="This will return all regions",
     *     tags={"Regions"},
     *     @OA\Response(
     *         response="404",
     *         description="Username is already taken."
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Email is already registered."
     *     ),     
     *      @OA\Response(
     *         response="202",
     *         description="Registration successful! Please log in."
     *     ),
     *      @OA\Response(
     *         response="403",
     *         description="Registration failed. Try again.."
     *     ),
     *      security={{"basicAuth": {}}}
     * )
     */
    public function all() {
        echo "this is the way";
    }

    /** * @OA\Post(
    * tags={"Regions"}, 
    * path="/api/v1/regions", 
    * security={{"BasicAuth": {}}},
    * summary="Create a new region", 
    * @OA\RequestBody( 
    * required=true, 
    * @OA\JsonContent(ref="#/components/schemas/Region") 
    * ), 
    * @OA\Response( 
    * response=201, 
    * description="Region created", 
    * @OA\JsonContent(ref="#/components/schemas/Region") 
    * ), 
    * @OA\Response(response=400, description="Invalid request") 
    * ) 
    */

    public function create(){
        if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
            header('HTTP/1.0 401 Unauthorized');
            echo 'Authentication Required.';
            exit; // Stop further execution
        }
        return true;
        echo "this is the way!";
    }

    /** * @OA\Get( 
    * tags={"Regions"},
    * path="/api/v1/regions/{regcode}", 
    * security={{"BasicAuth": {}}},
    * @OA\Parameter(
    * name="regcode",
    * in="path",
    * description="PSGC Region Code",
    * required=true,
    * @OA\Schema(
    * type="string"
    * )
    * ),
    * @OA\Response( 
    * response=200, 
    * description="Retrieve Region", 
    * @OA\JsonContent(ref="#/components/schemas/Region") 
    * ), 
    * @OA\Response(response=400, description="Invalid request") 
    * ) 
    */
    
    public function read(){
        if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
            header('HTTP/1.0 401 Unauthorized');
            echo 'Authentication Required.';
            exit; // Stop further execution
        }
        return true;
        echo "this is the way!";
    }

    /**
     * @OA\Schema(
     *     title="Region model",
     *     description="Region model",
     *     schema="Region",
     *     @OA\Property(property="regcode", type="string", description="Region PSGC Code"), 
     *     @OA\Property(property="regname", type="string", description="Region PSGC Name"),
     *     required={"regcode", "regname"} 
     * )
     */

}