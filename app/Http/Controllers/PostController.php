<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::query()->get();

        return new JsonResponse([
            'data' => $posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $created = DB::transaction(function () use ($request) {
            
            $postMake = Post::query()->create([
                'title' => $request->title,
                'body' => $request->body,
            ]);

            $postMake->users()->sync($request->user_ids);

            return $postMake;
        }); 

        return new JsonResponse([
            'data' => $created,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new JsonResponse([
            'data' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // $post->update($request->only(['title', 'body']));
        $updated = $post->update([
            'title' => $request->title ?? $post->title,
            'body' => $request->body ?? $post->body,
        ]);

        // Error Response
        if(!$updated) {
            return new JsonResponse([
                'errors' => [
                    'Failed to update model.'
                ]
            ], 400);
        }

        //return jsonResponse
        return new JsonResponse([
            'data' => $post
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $delete = $post->forceDelete();
        if(!$delete) {
            return new JsonResponse([
                'errors' => [
                    'Failed to delete resources.'
                ]
            ], 400);
        }

        //return jsonResponse
        return new JsonResponse([
            'data' => "success",
        ]);
    }
}
