@extends('layout.layout')
@section('title','Edit Profile')
@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                @include('shared.left-sidebar')
            </div>

            {{-- Showing specific post --}}
            <div class="col-6">
                @include('shared.success-message')
                <div class="mt-3">
                    @include('users.shared.user-edit-card')
                </div>
                <hr>

                @forelse ($ideas as $idea)
                    <div class="mt-3">
                        @include('ideas.shared.idea-card')
                    </div>
                @empty
                    <p class="text-center mt-4">No Results Found.</p>
                @endforelse
                {{-- Pagination buttons --}}
                <div class="mt-2">
                    {{ $ideas->withQueryString()->links() }}
                </div>
            </div>
            <div class="col-3">
                @include('shared.searchbar')
                @include('shared.followbox')
            </div>
        </div>
    </div>
@endsection
