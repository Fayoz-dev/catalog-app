<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
/**
 * @OA\Get(
 * path="/api/category",
 * summary="all category",
 * description="Category",
 * security={{ "api": {} }},
 * operationId="index_category",
 * tags={"Category"},
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
        $category = Category::all();
        return CategoryResource::collection($category);
    }




    /**
     * * * * * *  * * * *  * * * * * *
     * @OA\Post(
     * path="/api/category",
     * summary="Post a new data",
     * description="Post new category",
     * security={{ "api": {} }},
     * tags={"Category"},
     * 
     * 
     * @OA\RequestBody(
     *    required=true,
     *    description="Category",
     *    @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *       type="object",
     *       required={"name"},
     *       @OA\Property(property="name", type="text", format="foreign", example="category name"),
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

    public function store(Request $request)
    {
       $request->validate([
         
        'name'=> 'required'

       ]);

       $category = new Category();
       $category->name = $request->name;
       $category->save();

        return response()->json(new CategoryResource($category),200);
    }

  
    /**
     * @OA\Get(
     *      path="/api/category/{category}",
     *      tags={"Category"},
     *      summary="category",
     *      description="Returns project data",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="category",
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




    public function show($category)
    {
        $category = Category::find($category);

        if($category){

            return response()->json(new CategoryResource($category),200);
        }

        return response()->json("NOt found !",404);



    }

 /**
     * * * * * *  * * * *  * * * * * *
     * @OA\Put(
     * path="/api/category/{category}",
     * summary="Post a new data",
     * description="update  category  data",
     * security={{ "api": {} }},
     * tags={"Category"},
     * 
     * * *@OA\Parameter(name="category", in="path", description="Id of category", required=true,
     *       @OA\Schema(type="integer")
     *  ),
     * @OA\RequestBody(
     *    description="Pass category   credentials",
     *    @OA\JsonContent(
     *       required={"name"},
     *       @OA\Property(property="name", type="text", format="text", example="Category"),
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

    public function update(Request $request,$category)
    {
        $category = Category::find($category);
        if($category){
            $request->validate([
                'name'=>['required']
         
            ]);

            $category->name = $request->name;
            $category->save();
    
            return response()->json(new CategoryResource($category),200);
        }
        return response()->json("Not found user for update",404);

    }

   /**
     * @OA\Delete(
     *      path="/api/category/{category}",
     *      operationId="deleteProject",
     *      tags={"Category"},
     *      summary="Delete existing project",
     *      description="Deletes a record and returns no content",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="category",
     *          description="Category id",
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
    public function destroy($category)
    {
        $category = Category::find($category);
        if($category){
            $category->delete();
            return response()->json("deleted success");
        }
    }
}
