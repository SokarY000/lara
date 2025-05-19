@extends('layouts.app')
@section('title')index @endsection
@section('home')
<div class="container mt-4">
    <div class="text-center">
    <a href="{{route('posts.create')}}" class="btn btn-success">Create Post</a>    </div>
    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{$post['id']}}</td>
                <td>{{$post['title']}}</td>
                <td>{{$post->postCreator ? $post->postCreator->name : 'not found'}}</td>
                <td>{{$post['created_at']}}</td>
                <td>
                    <a href="{{route('posts.show', $post['id'])}}" class="btn btn-info">View</a>
                    <a href="{{route('posts.edit',$post['id'])}}" class="btn btn-primary">Edit</a>
                    <form style="display: inline;" method="POST" action="{{ route('posts.destroy', $post['id']) }}" onsubmit="return confirmDelete(event);">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
        @endforeach
        </tbody>
    </table>

            <script>
                function confirmDelete(event) {
                    const sure = confirm("Are you sure?");
                    if (!sure) {
                        event.preventDefault(); 
                    }
                    return sure; 
                }
            </script>

@endsection