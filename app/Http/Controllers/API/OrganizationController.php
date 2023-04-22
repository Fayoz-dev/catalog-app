<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\OrganizationResource;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth:api');
    }


/**
 * @OA\Get(
 * path="/api/organization",
 * summary="all organization",
 * description="Organization",
 * security={{ "api": {} }},
 * operationId="index_organization",
 * tags={"Organization"},
 * @OA\Response(
 *    response=200,
 *    description="Success",
 *    @OA\JsonContent(
 *       @OA\Property(property="id", type="integer", example="1"),
 *       @OA\Property(property="name", type="string", example="join"),
 *        )
 *     )
 * ),
 **/

    public function index()
    {


        return OrganizationResource::collection(Organization::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

   /**
     * * * * * *  * * * *  * * * * * *
     * @OA\Post(
     * path="/api/organization",
     * summary="Post a new data",
     * description="Post new organization",
     * tags={"Organization"},
     * security={{ "api": {} }},
     *
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="Organization",
     *    @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *       type="object",
     *       required={"name","image","description","category_id"},
     *       @OA\Property(property="name", type="text", format="text", example="john"),
     *       @OA\Property(property="image", type="text", format="text", example="bb"),
     *       @OA\Property(property="description", type="text", format="text", example="lorem"),
     *       @OA\Property(property="category_id",type="number", format="text , exists,categories,id", example="1"),
     *
     *    ),
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="The given data was invalid.")
     *        )
     *     ),
     *    @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *            @OA\MediaType(
     *             mediaType="application/json",
     *         ),
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */


    public function store(Request $app)
    {

        $app->validate([
            'name'=>['required'],
            'image'=>['required'],
            'description'=>['required'],
            'category_id'=>['required']

        ]);


        $organization = new Organization();
        $organization->name = $app->name;
        $organization->image = $app->image;
        $organization->description = $app->description;
        $organization->category_id = $app->category_id;
        $organization->save();


        return response()->json(new OrganizationResource($organization),200);







    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * @OA\Get(
     *      path="/api/organization/{organization}",
     *      tags={"Organization"},
     *      summary="organization",
     *      description="Returns project data",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="organization",
     *          description="Project id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * ),
     */
    public function show($organization)
    {
        $organization = Organization::find($organization);

        if($organization){

            return response()->json(new OrganizationResource($organization),200);
        }

        return response()->json("NOt found !",404);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


     /**
     * * * * * *  * * * *  * * * * * *
     * @OA\Put(
     * path="/api/organization/{organization}",
     * summary="Post a new data",
     * description="update  category  data",
     * security={{ "api": {} }},
     * tags={"Organization"},
     *
     * * *@OA\Parameter(name="organization", in="path", description="Id of category", required=true,
     *       @OA\Schema(type="integer")
     *  ),
     * @OA\RequestBody(
     *    description="Pass category   credentials",
     *    @OA\JsonContent(
     *       required={"name","image","description","category_id"},
     *       @OA\Property(property="name", type="integer", format="foreign", example="organization"),
     *       @OA\Property(property="image", type="integer", format="foreign", example="cc"),
     *       @OA\Property(property="description", type="integer", format="text", example="big"),
     *       @OA\Property(property="category_id",type="number", format="foreign , exists,categories,id", example="5"),
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="The given data was invalid.")
     *        )
     *     ),
     *    @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *            @OA\MediaType(
     *             mediaType="application/json",
     *         ),
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function update(Request $request, $app)
    {
        $app = Organization::find($app);

        if($app){
            $request->validate([
                'name'=>['required'],
                'image'=>['required'],
                 'description'=>['required'],
                 'category_id'=>['required','exists:categories,id']
            ]);

            $app->name = $request->name;
            $app->image = $request->image;
            $app->description = $request->description;
            $app->category_id = $request->category_id;
            $app->save();

            return response()->json(new OrganizationResource($app),200);

        }

        return response()->json("no update",404);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

      /**
     * @OA\Delete(
     *      path="/api/organization/{organization}",
     *
     *      tags={"Organization"},
     *      summary="Delete existing project",
     *      description="Deletes a record and returns no content",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="organization",
     *          description="Organization id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */

    public function destroy($app)
    {
       $app = Organization::find($app);

       if($app)
       {
        $app->delete();
        return response()->json("deleted success");
       }

    }
}
