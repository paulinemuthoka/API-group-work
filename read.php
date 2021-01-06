public function show(Post $post)
{
    // Pass current post to view
    return view('posts.show', compact('post'));
}
@section('title', $post->title)
@extends('layout')

@section('content')

@include('partials.summary')

@endsection
<div class="content">
  <a href="{{ route('posts.show', [$post->slug]) }}">
    <h1 class="title">{{ $post->title }}</h1>
  </a>
  <p><b>Posted:</b> {{ $post->created_at->diffForHumans() }}</p>
  <p><b>Category:</b> {{ $post->category }}</p>
  <p>{!! nl2br(e($post->content)) !!}</p>

  <form method="post" action="{{ route('posts.destroy', [$post->slug]) }}">
    @csrf @method('delete')
    <div class="field is-grouped">
      <div class="control">
        <a
          href="{{ route('posts.edit', [$post->slug])}}"
          class="button is-info is-outlined"
        >
          Edit
        </a>
      </div>
      <div class="control">
        <button type="submit" class="button is-danger is-outlined">
          Delete
        </button>
      </div>
    </div>
  </form>
</div>
public function index()
{
    // Get all Posts, ordered by the newest first
    $posts = Post::latest()->get();

    // Pass Post Collection to view
    return view('posts.index', compact('posts'));
}
@section('title', 'Home')
@extends('layout')

@section('content')

@foreach ($posts as $post)
    @include('partials.summary')
@endforeach

@endsection
