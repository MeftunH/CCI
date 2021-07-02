<section class="my-5">
    @if (session()->has('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{trans('profile.update_password')}}</h5>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form wire:submit.prevent="updateProfileInformation" role="form">

                <div class="form-group">
                    <label for="state.current_password">{{trans('profile.current_password')}}</label>
                    <input type="password" class="form-control" id="state.current_password" wire:model="state.current_password"/>
                </div>

                <div class="form-group">
                    <label for="state.password">{{trans('profile.new_password')}}</label>
                    <input type="password" class="form-control" id="state.password" wire:model="state.password"/>
                </div>

                <div class="form-group">
                    <label for="state.password_confirmation">{{trans('profile.confirm_password')}}</label>
                    <input type="password" class="form-control" id="state.password_confirmation" wire:model="state.password_confirmation"/>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{trans('profile.change_password')}}</button>
                </div>
            </form>
        </div>
    </div>
</section>
