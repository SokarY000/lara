@extends('layouts.app')
@section('title')show @endsection
@section('home')
<div class="container">
    <div class="card mt-4">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Title: {{$post['title']}}</h5>
            <p class="card-text">Description: {{$post['description']}}</p>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Name: {{$post->postCreator ? $post->postCreator->name : 'not found'}}</h5>
            <p class="card-text">Email: {{$post->postCreator ? $post->postCreator->email: 'not found'}}</p>
            <p class="card-text">Created At: {{$post->postCreator ? $post->postCreator->created_at: 'not found'}}</p>
        </div>
    </div>

</div>

@endsection
