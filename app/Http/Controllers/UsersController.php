<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $res = [
            'body' => null,
            'message' => null,
            'success' => null
        ];
        try {
            $res['body'] = User::all();
            $res['message'] = 'SUCCESS';
            $res['success'] = true;
        } catch (Exception $e) {
            $res['message'] = $e->getMessage();
            $res['success'] = false;
        }
        return $res;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $res = [
            'body' => null,
            'message' => null,
            'success' => null
        ];
        try {
            $userData = $request->except((['id']));
            $userData['password'] = $userData['password'] ?? 'password';
            $userData['password'] = Hash::make($userData['password']);
            $user = new User();
            $user->fill($userData);
            $user->save();
            $res['body'] = $user;
            $res['message'] = 'SUCCESS';
            $res['success'] = true;
        } catch (Exception $e) {
            $res['message'] = $e->getMessage();
            $res['success'] = false;
        }
        return $res;
    }

    /**
     * Display the specified resource.
     */
    public function show($user)
    {
        $res = [
            'body' => null,
            'message' => null,
            'success' => null
        ];
        try {
            $res['body'] = User::findOrFail($user);
            $res['message'] = 'SUCCESS';
            $res['success'] = true;
        } catch (Exception $e) {
            $res['message'] = $e->getMessage();
            $res['success'] = false;
        }
        return $res;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $user)
    {
        $data = $request->except(['id']);
        $res = [
            'body' => null,
            'message' => null,
            'success' => null
        ];

        try {
            $data['password'] = 'password';
            $User = User::findOrFail($user);
            $data['password'] = Hash::make($data['password']);
            $User->update($data);
            $res['body'] = $User;
            $res['message'] = 'SUCCESS';
            $res['success'] = true;
        } catch (Exception $e) {
            $res['message'] = $e->getMessage();
            $res['success'] = false;
        }
        return $res;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $res = [
            'body' => null,
            'message' => null,
            'success' => null
        ];
        try {
            $user = User::find($id);

            if (!$user) {
                $res['message'] = 'User not found';
                $res['success'] = false;
            } else {
                $result = $user->delete();

                if ($result) {
                    $res['body'] = $user;
                    $res['message'] = 'SUCCESS';
                    $res['success'] = true;
                } else {
                    $res['message'] = 'Could not delete user';
                    $res['success'] = false;
                }
            }
        } catch (\Exception $e) {
            $res['message'] = $e->getMessage();
            $res['success'] = false;
        }
        return $res;
    }
}
