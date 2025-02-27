<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'role_id' => 'required|integer|exists:roles,id',
            ]);


            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'role_id' => $validatedData['role_id'],
            ]);


            return response()->json([
                'message' => 'Usuário registrado com sucesso!',
                'token' => $user->createToken('API Token')->plainTextToken,
                'user' => $user
            ], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao registrar usuário!'], 500);
        }
    }

    public function login(Request $request)
    {


        try {

            $validatedData = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);


            $user = User::where('email', $validatedData['email'])->first();


            if (!$user || !Hash::check($validatedData['password'], $user->password)) {
                return response()->json(['error' => 'Credenciais inválidas!'], 401);
            }


            return response()->json([
                'message' => 'Login realizado com sucesso!',
                'token' => $user->createToken('API Token')->plainTextToken,
                'user' => $user
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao realizar login!'], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logout realizado com sucesso']);
    }
}
