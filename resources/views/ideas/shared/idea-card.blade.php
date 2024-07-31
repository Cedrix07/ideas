<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle" src="{{ $idea->user->getImageURL() }}"
                    alt="{{ $idea->user->name }}">
                <div>
                    <h5 class="card-title mb-0"><a
                            href="{{ route('users.show', $idea->user->id) }}">{{ $idea->user->name }}
                        </a></h5>
                </div>
            </div>
            <div>
                <form action="{{ route('ideas.destroy', $idea->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <a href="{{ route('ideas.show', $idea->id) }}">View</a>
                    @can('update', $idea) <!-- Idea Policy to check if user can edit or the admin is currently editing -->
                        <a class="mx-2" href="{{ route('ideas.edit', $idea->id) }}">Edit</a>
                        @if (auth()->id() == $idea->user_id)
                            <button class=" ms-1 btn btn-danger btn-sm"> x </button>
                        @endif
                    @endcan
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if ($editing ?? false)
            <form method="POST" action="{{ route('ideas.update', $idea->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <textarea class="form-control" id="idea" rows="3" name="content">{{ $idea->content }}</textarea>
                    @error('content')
                        <span class="d-block text-danger fs-6 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="">
                    <button type="submit" class="btn btn-dark mb-2 btn-sm"> Update </button>
                </div>
            </form>
        @else
            <p class="fs-6 fw-light text-muted">
                {{ $idea->content }}
            </p>
        @endif
        <div class="d-flex justify-content-between">
            @include('ideas.shared.like-button')
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    {{ $idea->created_at->diffForHumans() }} </span>
            </div>
        </div>
        @include('ideas.shared.comments-box')
    </div>
</div>
