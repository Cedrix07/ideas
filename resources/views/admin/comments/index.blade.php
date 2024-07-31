@extends('layout.layout')
@section('title','Ideas Comments | Admin Dashboard')
@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                @include('admin.shared.left-sidebar')
            </div>
            <div class="col-9">
              <h1>Comments</h1>
              @include('shared.success-message')
              <table class="table table-striped mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Idea</th>
                        <th>Content</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <td>{{$comment->id}}</td>
                            <td>
                                <a href="{{route('users.show', $comment->user) }}">{{$comment->user->name}}</a>
                            </td>
                            <td>
                                <a href="{{route('ideas.show', $comment->idea) }}">{{$comment->idea->id}}</a>
                            </td>
                            <td>{{$comment->content}}</td>
                            <td>{{$comment->created_at->toDateString()}}</td>
                            <td>
                                <form action="{{route('admin.comments.destroy', $comment)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
              <div>
                {{$comments->links()}}
              </div>
            </div>
        </div>
    </div>
@endsection
