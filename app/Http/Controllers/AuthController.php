<?php

namespace App\Http\Controllers;

use App\Http\Repositories\AuthRepository;
use App\Models\{User};
use Illuminate\Support\Facades\{Auth, DB};
use App\Http\Requests\Auth\{LoginRequest, PasswordRecoveryRequest, RegisterRequest};
use App\Http\Traits\CustomResponses;
use Illuminate\Http\{JsonResponse, Request};

class AuthController extends Controller
{
    use CustomResponses;

    private AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only("email", "password");

        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $activeUser = User::with(["document_type"])->where("status_id", 1)->where("id", $user->id)->first();

            if(isset($activeUser->id)) {
                $token = $activeUser->createToken("Eml Test")->accessToken;
                return $this->success("Bienvenido de nuevo!", array("token" => $token, "user" => $activeUser));
            } else {
                return $this->unauthorized("No estas autorizado para el ingreso al sistema.", array());
            }
        } else {
            return $this->notFound("El usuario ingresado no existe, revisa tus datos y vuelve a intentarlo.", array());
        }
    }

    public function getDocumentTypes(): JsonResponse
    {
        $document_types = $this->authRepository->getDocumentTypes();
        return $this->success("Done.", $document_types);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $status = false;
        $newStatus = null;
        $result = null;
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $newStatus = $this->authRepository->create($data);

            DB::commit();

            $status = true;
            DB::commit();
        } catch (\Throwable $th) {
            $result = $th->getMessage();
            DB::rollBack();
        }

        if($status) {
            return $this->success("Done.", $newStatus);
        } else {
            return $this->error("Error.", $result);
        }
    }

    public function passwordRecovery(PasswordRecoveryRequest $request): JsonResponse
    {
        $status = false;
        $newStatus = null;
        $result = null;
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $newStatus = $this->authRepository->changePassword($data);

            DB::commit();

            $status = true;
            DB::commit();
        } catch (\Throwable $th) {
            $result = $th->getMessage();
            DB::rollBack();
        }

        if($status) {
            return $this->success("Done.", $newStatus);
        } else {
            return $this->error("Error.", $result);
        }
    }
}
