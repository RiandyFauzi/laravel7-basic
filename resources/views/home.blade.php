@extends('layouts.app')


@section('content')




<div class="container">


    <div class="">
        <div>
            @isset($category)
            <h4>Category {{ $category->name }}</h4>

            @endisset

            @isset($tag)
            <h4>Tag {{ $tag->name }}</h4>

            @endisset

            @if(!isset($tag) && !isset($category))
            <h4>All Post</h4>
            @endif
            <hr>
        </div>

        <div>
          
        </div>

    </div>



    <div class="row">


        <div class="col-md-7">
            @forelse($posts as $post)

            <div class="card mb-4">

                @if($post->thumbnail)
                <a href="{{ route('posts.show', $post->slug) }}">
                    <img style="height:350px; object-fit:cover; object-position: center; " class="card-img-top" src="{{ $post->takeImage }}">
                </a>
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
                        <div class="text-secondary">
                            <small>
                                Published on {{ $post->created_at->diffForHumans() }}

                            </small>
                        </div>
                    </div>



                </div>






            </div>


            @empty
            <div class="col-md-6">
                <div class="alert alert-info">
                    There is no post
                </div>
            </div>
            @endforelse



        </div>



    </div>


          
                

</div>
@endsection