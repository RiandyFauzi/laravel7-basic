@extends('layouts.app', ['title'=>'Update Post'])


@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-6">

        
            <div class="card">
                <div class="card-header">New Post</div>
                <div class="card-body">
                    <form action="/posts/store" method="post" enctype="multipart/form-data">
                        @csrf
                       
                       @include('posts.partials.form-control', ['submit' => 'Create'])

                   
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection