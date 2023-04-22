<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\AdminResource;
use App\Models\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
//yana nima kk usto? shut usto paka login parolni ber mengayam z qimaydimi bilmaydi ok hoz
/**
 * @OA\Get(
 * path="/api/admin",
 * summary="all admin",
 * description="Admin",
 * security={{ "api": {} }},
 *
 * tags={"Admin"},
 * @OA\Response(
 *    response=200,
 *    description="Success",
 *    @OA\JsonContent(
 *       @OA\Property(property="id", type="integer", example="1"),
 *       @OA\Property(property="name", type="string", example="join"),
 *       @OA\Property(property="surname", type="string", example="john"),
 *       @OA\Property(property="email", type="email", example="a@a.com"),
 *       @OA\Property(property="password", type="password", example="01020304"),
 *       @OA\Property(property="phone", type="number", example="1234567"),
 *
 *
 *        )
 *     )
 * ),
 **/
       public function index()
    {
        $admin = Admin::all();
        return AdminResource::collection($admin);
    }




      /**
     * * * * * *  * * * *  * * * * * *
     * @OA\Post(
     * path="/api/admin",
     * summary="Post a new data",
     * description="Post new admin",
     * security={{ "api": {} }},
     * tags={"Admin"},
     *
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="Admin",
     *    @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *       type="object",
     *       required={"name"},
     *
     *       @OA\Property(property="name", type="string", example="join"),
     *       @OA\Property(property="surname", type="string", example="john"),
     *       @OA\Property(property="email", type="email", example="a@a.com"),
     *       @OA\Property(property="password", type="password", example="01020304"),
     *       @OA\Property(property="phone", type="number", example="1234567"),
     *
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

    public function store(Request $req)
    {
        $req->validate([
            'name'=>['required'],
            'surname'=>['required'],
            'email'=>['email','unique:admins,email'],
            'password'=>['required'],
            'phone'=>['required'],

        ]);

        $admin = new Admin();
        $admin->name = $req->name;
        $admin->surname = $req->surname;
        $admin->email = $req->email;
        $admin->password = Hash::make($req->password);
        $admin->phone = $req->phone;
        $admin->save();

        return response()->json(new AdminResource($admin),200);
    }


    /**
     * @OA\Get(
     *      path="/api/admin/{admin}",
     *      tags={"Admin"},
     *      summary="admin",
     *      description="Returns project data",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="admin",
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


    public function show($admin)
    {
        $admin = Admin::find($admin);
        if($admin){
            return response()->json(new AdminResource($admin),200);
        }
        return response()->json("Not found people !",404);
    }




 /**
     * * * * * *  * * * *  * * * * * *
     * @OA\Put(
     * path="/api/admin/{admin}",
     * summary="Post a new data",
     * description="update  admin  data",
     * security={{ "api": {} }},
     * tags={"Admin"},
     *
     * * *@OA\Parameter(name="admin", in="path", description="Id of admin", required=true,
     *       @OA\Schema(type="integer")
     *  ),
     * @OA\RequestBody(
     *    description="Pass admin   credentials",
     *    @OA\JsonContent(
     *       required={"name","surname","email","password","phone"},
     *       @OA\Property(property="name", type="integer", format="foreign", example="john"),
     *       @OA\Property(property="surname", type="integer", format="foreign", example="bb"),
     *       @OA\Property(property="email", type="email", format="text", example="a@agmail.com"),
     *       @OA\Property(property="password", type="passsword", format="text", example="12345680"),
     *       @OA\Property(property="phone", type="number", format="number", example="4431063"),
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

    public function update(Request $req, $admin)
    {
        $admin = Admin::find($admin);
        if($admin){
            $req->validate([
                'name'=>['required'],
                'surname'=>['required'],
                'email'=>['email','unique:users,email'],
                'password'=>['required'],
                'phone'=>['required'],


            ]);

            $admin->name = $req->name;
            $admin->surname = $req->surname;
            $admin->email = $req->email;
            $admin->password = Hash::make($req->password);
            $admin->phone = $req->phone;
            $admin->save();

            return response()->json(new AdminResource($admin),200);
        }
        return response()->json("Not found people for update",200);

    }


    /**
     * @OA\Delete(
     *      path="/api/admin/{admin}",
     *      operationId="deleteAdmin",
     *      tags={"Admin"},
     *      summary="Delete existing project",
     *      description="Deletes a record and returns no content",
     *      security={{ "api": {} }},
     *      @OA\Parameter(
     *          name="admin",
     *          description="Admin id",
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

    public function destroy($admin)
    {
        $admin = Admin::find($admin);
        if($admin){
            $admin->delete();
            return response()->json("deleted success");
        }

    }
}
