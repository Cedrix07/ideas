@auth()
    <h4> Share yours ideas </h4>
    <div class="row">
        <form method="POST" action="{{ route('ideas.store') }}">
            @csrf
            <div class="mb-3">
                <textarea class="form-control" id="content" rows="3" name="content"></textarea>
                @error('content')
                    <span class="d-block text-danger fs-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="">
                <button type="submit" class="btn btn-dark"> Share </button>
            </div>
        </form>
    </div>
@endauth

{{-- If not logged in or registered yet --}}
@guest()
    <h4> {{ __('ideas.login_to_share') }} </h4>
@endguest
