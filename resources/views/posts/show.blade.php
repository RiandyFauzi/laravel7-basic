@extends('layouts.app')
@section('title', 'the post')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-8">
      @if($post->thumbnail)
      <img style="height:350px; object-fit:cover; object-position: center; " class="rounded w-100" src="{{ $post->takeImage }}">
      @endif
      <p>{{$post ->title}}</p>
      <div class="text-secondary mb-4">
        <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name}}</a>
        &middot; {{ $post->created_at->format("d F, Y")}}
        &middot;
        @foreach($post->tags as $tag)
        <a href="/tags/{{ $tag->slug }}">{{ $tag->name }}</a>

        @endforeach
        <div class="media my-3">
          <img width="90" class="rounded-circle mr-3" src="{{ $post->author->gravatar() }}" alt="">
          <div class="media-body">
            <div>
              {{ $post->author->name}}
            </div>
            {{ '@' . $post->author->username}}
          </div>
        </div>
      </div>

      <p>{!! nl2br($post->body) !!}</p>
      <div>

        <!-- Button trigger modal -->
        @can('update', $post)
        <div class="d-flex mt-2">

          <button type="button" class="btn btn-primary mx-2" data-toggle="modal" data-target="#exampleModal">
            Delete
          </button>
          <a href="/posts/{{ $post->slug }}/edit" class="btn btn-success">Edit</a>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin untuk menghapus?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="mb-2">
                  <div>{{ $post->title}}</div>
                  <div class="text-secondary">
                    <small> Published {{ $post->created_at->format('d F y')}}</small>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="/posts/{{ $post->slug }}/delete" method="post">
                  @csrf
                  @method("delete")
                  <button type="submit" class="btn btn-danger">Hapus</button>
                </form>

              </div>
            </div>
          </div>
        </div>
        @endcan



      </div>
     
    </div>
    <div class="col-md-4">
      @foreach($posts as $post)
      <div class="card mb-4">

@if($post->thumbnail)

@endif
<div class="card-body">
    <div>
        <small>
            <a class="text-secondary" href="{{ route('categories.show', $post->category->slug)}}">
                {{ $post->category->name }} -
            </a>

            @foreach($post->tags as $tag)
            <a class="text-secondary" href="{{ route('tags.show', $tag->slug)}}">
                {{ $tag->name}}
            </a>

            @endforeach
        </small>
    </div>

    <div>

    </div>
    <h5>
        <a class="text-dark" href="{{ route('posts.show', $post->slug) }}" class="card-title">
            {{ $post->title}}
        </a>
    </h5>
    <div class="text-secondary my-3">
        {{ Str::limit($post->body, 130, '.') }}
    </div>

    <div class="d-flex justify-content-between align-items-center mt-2">
        <div>

            <div class="media my-3 align-items-center">
                <img width="40" class="rounded-circle mr-3" src="{{ $post->author->gravatar() }}" alt="">
                <div class="media-body">
                    <div>
                        {{ $post->author->name}}
                    </div>
                    {{ '@' . $post->author->username}}
                </div>
            </div>
        </div>
        
    </div>



</div>






</div>

      @endforeach
    </div>
  </div>
  
   
 

</div>

@endsection