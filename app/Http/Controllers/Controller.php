<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *    title="Catalog",
 *    version="1.0.0",
 * )
 * 
 * * @OA\SecurityScheme(
     *     type="http",
     *     description="Login with email and password to get the authentication token",
     *     name="Token based Based",
     *     in="header",
     *     scheme="bearer",
     *     bearerFormat="JWT",
     *     securityScheme="api",
     * ),
     * 
 * @OA\Tag(
 *    name="Authorization",
 *    description="Authdan o'tish",
 * )
 * * @OA\Tag(
 *    name="Admin",
 *    description="Admin_crud",
 * )
 *  @OA\Tag(
 *    name="Category",
 *    description="category_crud",
 * )
 * 
 *  @OA\Tag(
 *    name="Organization",
 *    description="organization_crud",
 * )
 * @OA\Tag(
 *    name="Product",
 *    description="product_crud",
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
