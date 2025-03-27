<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Province extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
        /**
     * @OA\GET(
     *     path="/api/v1/provinces",
     *     summary="This will return all regions",
     *     tags={"Province"},
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
    * tags={"Province"}, 
    * path="/api/v1/province", 
    * security={{"BasicAuth": {}}},
    * summary="Create a new province", 
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
    * tags={"Province"},
    * path="/api/v1/province/{provcode}", 
    * security={{"BasicAuth": {}}},
    * @OA\Parameter(
    * name="provcode",
    * in="path",
    * description="PSGC Province Code",
    * required=true,
    * @OA\Schema(
    * type="string"
    * )
    * ),
    * @OA\Response( 
    * response=200, 
    * description="Retrieve Province", 
    * @OA\JsonContent(ref="#/components/schemas/Province") 
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
     *     title="Province model",
     *     description="Province model",
     *     schema="Province",
     *     @OA\Property(property="provcode", type="string", description="Province PSGC Code"), 
     *     @OA\Property(property="provname", type="string", description="Province PSGC Name"),
     *     required={"provcode", "provname"} 
     * )
     */

}