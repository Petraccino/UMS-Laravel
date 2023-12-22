<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

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
        //
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
    public function update(Request $request, User $user)
    {
        $data = $request->except(['id']);
        $res = [
            'body' => null,
            'message' => null,
            'success' => null
        ];

        try {
            $User = User::findOrFail($user);
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
    public function destroy(User $user)
    {
        //
    }
}
