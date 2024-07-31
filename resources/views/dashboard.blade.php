@extends('layout.layout')

@section('title','Dashboard') {{-- Changes the title for every page --}}

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                @include('shared.left-sidebar')
            </div>
            <div class="col-6">
                @include('shared.success-message')
                @include('ideas.shared.submit-idea')
                <hr>
                {{-- Displaying the idea post  --}}
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
