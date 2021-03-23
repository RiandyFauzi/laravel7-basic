<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Tag;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;


class PostController extends Controller
{

  public function home(Post $post)
  {

    return view('home', [
      'posts' => Post::latest()->limit(10)
    ]);
  }

  public function index(Post $post)
  {

    return view('posts.index', [
      'posts' => Post::latest()->paginate(6)
    ]);
  }

  public function show(Post $post)
  {
    $posts = Post::where('category_id', $post->category_id)->latest()->limit(6)->get();
    return view('posts.show', compact('post', 'posts'));
  }

  public function create()
  {
    return view('posts.create', [
      'post' => new Post(),
      'categories' => Category::get(),
      'tags' => Tag::get(),
    ]);
  }

  public function store(PostRequest $request)
  {

    $request->validate([
      'thumbnail' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
    ]);

    $attr = $request->all();

    $slug = \Str::slug(request('title'));
    $attr['slug'] = $slug;

    $thumbnail = request()->file('thumbnail') ? request()->file('thumbnail')->store("image/posts") : null;

    $attr['category_id'] = request('category');
    $attr['thumbnail'] = $thumbnail;


    $post = auth()->user()->posts()->create($attr);
    $post->tags()->attach(request('tags'));

    session()->flash('success', 'Post was created');

    return redirect('posts');
  }

  public function edit(Post $post)
  {
    return view('posts.edit', [
      'post' => $post,
      'categories' => Category::get(),
      'tags' => Tag::get(),
    ]);
  }

  public function update(PostRequest $request, Post $post)
  {

    $request->validate([
      'thumbnail' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
    ]);

    $this->authorize('update', $post);

    if (request()->file('thumbnail')) {
      \Storage::delete($post->thumbnail);
      $thumbnail = request()->file('thumbnail')->store("image/posts");
    } else {
      $thumbnail = $post->thumbnail;
    }

    $thumbnail =  request()->file('thumbnail')->store("image/posts");


    $attr = $request->all();
    $attr['category_id'] = request('category');
    $attr['thumbnail'] = $thumbnail;
    $post->update($attr);
    $post->tags()->sync(request('tags'));


    session()->flash('success', 'The Post was updated');
    return redirect('posts');
  }

  public function destroy(Post $post)
  {
    $this->authorize('update', $post);

    \Storage::delete($post->thumbnail);
    $post->tags()->detach();
    $post->delete();
    session()->flash('error', "The post was deleted");
    return redirect('posts');
  }
}
