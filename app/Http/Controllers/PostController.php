<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @SWG\Get(
     *     path="/posts",
     *     summary="Get a list of posts",
     *     tags={"Posts"},
     *     @SWG\Response(response=200, description="Successful operation"),
     *     @SWG\Response(response=400, description="Invalid request")
     * )
     */
    public function index()
    {
        $posts = Posts::paginate(10); // Paginate the results with 10 posts per page
        return response()->json($posts);
    }

    /**
     * @SWG\Post(
     *     path="/posts",
     *     summary="Creates a new post",
     *     tags={"Posts"},
     *     @SWG\Response(response=200, description="Successful operation"),
     *     @SWG\Response(response=400, description="Invalid request")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $post = Posts::create($validated);

        return response()->json($post, 201);
    }

    /**
     * @SWG\Get(
     *     path="/posts/{id}",
     *     summary="Gets a specific post by ID",
     *     tags={"Posts"},
     *     @SWG\Response(response=200, description="Successful operation"),
     *     @SWG\Response(response=400, description="Invalid request")
     * )
     */
    public function show($id)
    {
        $post = Posts::findOrFail($id);
        return response()->json($post);
    }

    /**
     * @SWG\Patch(
     *     path="/posts/{id}",
     *     summary="updates specific post by ID",
     *     tags={"Posts"},
     *     @SWG\Response(response=200, description="Successful operation"),
     *     @SWG\Response(response=400, description="Invalid request")
     * )
     */
    public function update(Request $request, $id)
    {
        $post = Posts::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'user_id' => 'sometimes|integer|exists:users,id',
        ]);

        $post->update($validated);

        return response()->json($post);
    }

    /**
     * @SWG\Delete(
     *     path="/posts/{id}",
     *     summary="Deletes post by ID",
     *     tags={"Posts"},
     *     @SWG\Response(response=200, description="Successful operation"),
     *     @SWG\Response(response=400, description="Invalid request")
     * )
     */
    public function destroy($id)
    {
        $post = Posts::findOrFail($id);
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully.'], 200);
    }
}