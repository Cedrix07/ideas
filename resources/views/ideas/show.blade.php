@extends('layout.layout')
@section('title','View Idea')
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
                        @include('ideas.shared.idea-card')
                    </div>
                </div>

                <div class="col-3">
                    @include('shared.searchbar')
                    @include('shared.followbox')
                </div>
            </div>
        </div>
    @endsection

