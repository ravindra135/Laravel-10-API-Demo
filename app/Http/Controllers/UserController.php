<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Exceptions\GeneralJsonException;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return new JsonResponse([
            'data' => 'hello world',
            'url' => $request->url(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //.
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $created = User::query()->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'email_verified' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            throw_if(!$created, GeneralJsonException::class, 'Failed to Create User');

            event(new UserCreated($created));

            return $created;
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
