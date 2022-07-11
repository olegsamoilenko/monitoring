<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
      $posts = Post::orderBy('number')->get();

      return view('admin.posts.index', ['posts' => $posts]);
    }

  /**
   * Paginate posts
   *
   * @return \Illuminate\Http\JsonResponse
   */

  public function paginationPosts(Request $request)
  {

    $post = Post::orderBy($request->postOrderBy, $request->postDirection)->paginate($request->postPerPage);

    $post->withPath('posts/');


    return response()->json([
      'posts' => $post,
    ], 201);
  }

    /**
     * Get posts.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPosts()
    {
      $posts = Post::all();

      return response()->json([
        'posts' => $posts
      ], 201);
    }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.posts.create');
  }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePostRequest $request)
    {

      $data = $request->validated();

      $post = Post::create(
        $data
      );

      return response()->json([
        'message' => 'Пост успішно доданий',
        'post' => $post
      ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
      return view('admin.posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
      $data = $request->validated();

      $post->update($data);

      return response()->json([
        'message' => 'Пост успішно оновлено',
        'post' => $post,
      ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post)
    {
      $post->delete();

      return response()->json([
        'message' => 'Пост успішно видалено',
      ], 201);
    }
}
