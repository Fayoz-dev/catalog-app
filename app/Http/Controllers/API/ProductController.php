<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
 * @OA\Get(
 * path="/api/product",
 * summary="all product",
 * description="Product",
 * security={{ "api": {} }},
 * operationId="index_product",
 * tags={"Product"},
 * @OA\Response(
 *    response=200,
 *    description="Success",
 * @OA\JsonContent(
 *       @OA\Property(property="id", type="integer", example="1"),
 *       @OA\Property(property="name", type="string", example="join"),
 *       @OA\Property(property="image", type="string", example="/"),
 *       @OA\Property(property="organization_id", type="unsignedBigInteger", example="5"),
 *       @OA\Property(property="description", type="string", example="lorem"),
 *       @OA\Property(property="price", type="string", example="10000"),
 *       
 *        
 *        )
 *     )
 * ),
 **/

    public function index()
    {
        $product = Product::all();

        return ProductResource::collection($product);

    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

   
    public function store(Request  $request)
    {

        $request->validate([

            'name'=>['required'],
            'image'=>['required'],
            'organization_id'=>['required'],
            'description'=>['required'],
            'price'=>['required'],
            'status'=>['required']

        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->image = $request->image;
        $product->organization_id = $request->organization_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->save();
        

        return response()->json(new ProductResource($product),200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     *      path="/api/product/{product}",
     *      tags={"Product"},
     *      summary="product",
     *      description="Returns project data",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="product",
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

    public function show($id)
    {
        $id = Product::find($id);

        if($id){
            return response()->json(new ProductResource($id),200);
        }

        return response()->json("Not found", 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
        
    // }

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
     * path="/api/product/{product}",
     * summary="Post a new data",
     * description="update  product  data",
     * security={{ "api": {} }},
     * tags={"Product"},
     * 
     * * *@OA\Parameter(name="product", in="path", description="Id of product", required=true,
     *       @OA\Schema(type="integer")
     *  ),
     * @OA\RequestBody(
     *    description="Pass category   credentials",
     *    @OA\JsonContent(
     *       required={"name","image","organization_id","description","price","status"},
     *       @OA\Property(property="name", type="integer", format="foreign", example="john"),
     *       @OA\Property(property="image", type="integer", format="foreign", example="bb"),
     *       @OA\Property(property="organization_id",type="number", format="foreign , exists,organizations,id", example="1"),
     *       @OA\Property(property="description", type="integer", format="text", example="lorem"),
     *       @OA\Property(property="price", type="number", format="text", example="lorem"),
     *       @OA\Property(property="status", type="string", format="text", example="active"),
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

    public function update(Request $request, $product)
    {
        $product = Product::find($product);

        if($product)
        {
            $request->validate([

                'name' => ['required'],
                'image' => ['required'],
                'organization_id' => ['required','exists:organizations,id'],
                'description' => ['required'],
                'price' => ['required'],
                'status' => ['required']


            ]);

            $product->name = $request->name;
            $product->image = $request->image;
            $product->organization_id = $request->organization_id;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->status = $request->status;
            $product->save();

            return response()->json(new ProductResource($product),200);

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
     *     @OA\Delete(
     *      path="/api/product/{product}",
     *      tags={"Product"},
     *      summary="Delete existing project",
     *      description="Deletes a record and returns no content",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="product",
     *          description="product id",
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
     *          description="Forbidden",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found",
     *      )
     * )
     */
     
    public function destroy($product)
    {
        $product = Product::find($product);

        if($product)
        {
            $product->delete();
            return response()->json("deleted success");
        }
    }
}
