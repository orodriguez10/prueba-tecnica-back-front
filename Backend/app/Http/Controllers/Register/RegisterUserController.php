<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\Register\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RegisterUserController extends Controller
{

    /**
     * @author Oscar Rodriguez
     * @OA\Post(
     *     path="/api/register-user",
     *      tags={"Register"},
     *     summary="Registro de usuarios",
     *     description="Realiza el registro de nuevos usuarios",
     *      @OA\RequestBody(
     *        @OA\JsonContent(
     *          type="object",
     *             @OA\Property(property="name", type="string", description="Nombre de usuario"),
     *             @OA\Property(property="email", type="string", description="Email del usuario")
     *             @OA\Property(property="password", type="string", description="password")
     *             @OA\Property(property="confirmPassword", type="string", description="conformar el password ingresado anteriormente")
     *        ),
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Consultado correctamente"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error en validación de campos."
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No autorizado."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="usuario no existe."
     *     ),
     * )
     */

    public function registerUser(RegisterRequest $request)
    {
        try {
            return DB::transaction(function () use($request){
                $model = new User;
                $model->name = $request->name;
                $model->email = $request->email;
                $model->password = bcrypt($request->password);
                $model->save();
                return $this->susccesResponse(['message' => ('Guardado Correctamente'), 'data' => true]);
            },5);
        } catch (\Exception $error) {
            return $this->capturar($error, __("error al ingresar"));
        }
    }

}
