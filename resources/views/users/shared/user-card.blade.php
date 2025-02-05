<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:150px" class="me-3 avatar-sm rounded-circle" src="{{ $user->getImageURL() }}"
                    alt="{{ $user->name }}">
                <div>
                    <h3 class="card-title mb-0"><a href="#"> {{ $user->name }}
                        </a></h3>
                    <span class="fs-6 text-muted">{{ $user->email }}</span>
                </div>
            </div>
            <!-- Calling user policy using @ can also check if user is login alternative approach for @ auth -->
            @can('update', $user)

                <div>
                    <a href="{{ route('users.edit', $user->id) }}">edit</a>
                </div>
            @endcan

        </div>
        <div class="px-2 mt-4">
            <h5 class="fs-5"> Bio : </h5>
            <p class="fs-6 fw-light">
                {{ $user->bio }}
            </p>
            @include('users.shared.user-stats')
            @auth
                @if (Auth::user()->isNot($user))
                    <div class="mt-3">
                        @if (Auth::user()->follows($user))
                            <form action="{{ route('users.unfollow', $user->id) }}" method="POST">
                                @csrf
                                <div class="mt-3">
                                    <button class="btn btn-danger btn-sm"> Unfollow </button>
                                </div>
                            </form>
                        @else
                            <form action="{{ route('users.follow', $user->id) }}" method="POST">
                                @csrf
                                <div class="mt-3">
                                    <button class="btn btn-primary btn-sm"> Follow </button>
                                </div>
                            </form>
                        @endif
                    </div>
                @endif
            @endauth
        </div>
    </div>
</div>
