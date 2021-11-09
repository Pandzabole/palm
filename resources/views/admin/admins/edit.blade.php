@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-left"> Admin edit </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admins.update', $admin->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-row">
                            <div class="form-group col-md-6 @if($errors->has('name')) has-danger @endif">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control" placeholder="Ime i prezime"
                                       name="name"
                                       value="{{ old('name') ?? $admin->name }}">
                                @if($errors->has('name'))
                                    <span class="text-danger">*{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 @if($errors->has('email')) has-danger @endif">
                                <label for="email">Email</label>
                                <input id="email" type="text" class="form-control" placeholder="Email"
                                       name="email"
                                       value="{{ old('email') ?? $admin->email }}">
                                @if($errors->has('email'))
                                    <span class="text-danger">*{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6  @if($errors->has('role_id')) has-danger @endif">
                                <label for="privileges" class="asterisk">Admins privileges</label>
                                <select class="form-control" id="privileges"
                                        data-toggle="select" data-placeholder="Privileges" required
                                        name="role_id">
                                    @foreach( config('admins.admins') as $key => $value)
                                        <option value="{{ $key }}"
                                                @if($value === $admin->role_name) selected="selected" @endif
                                            {{ (collect(old('role_id'))->contains( $key )) ? 'selected':'' }} >
                                            {{$value}}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->has('role_id'))
                                    <span class="text-danger">*{{ $errors->first('role_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6  @if($errors->has('main_market_id')) has-danger @endif"
                                 id="markets-wrapper">
                                <label for="markets" class="asterisk">Markets</label>
                                <select class="form-control" id="markets"
                                        data-toggle="select" data-placeholder="Markets"
                                        name="main_market_id[]"
                                        multiple disabled>
                                    @foreach( $markets as $market)
                                        <option
                                            @if(in_array($market->id, $admin->mainMarkets->pluck('id')->toArray(), true)) selected
                                            @endif
                                            {{ (collect(old('main_market_id'))->contains( $market->id )) ? 'selected':'' }}
                                            value="{{ $market->id }}">
                                            {{ $market->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->has('main_market_id'))
                                    <span class="text-danger">*{{ $errors->first('main_market_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="togglebutton">
                                    <label>
                                        <input id="change_password" type="checkbox" name="change_password" value="1"
                                               @if(old('change_password')) checked @endif>
                                        Password
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row @if(!old('change_password')) d-none @endif" id="section-password">
                            <div class="form-group col-md-6 @if($errors->has('password')) has-danger @endif">
                                <label for="password">Password</label>
                                <input class="form-control" id="password" type="password" name="password">
                                @if($errors->has('password'))
                                    <span class="text-danger">*{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password_confirmation">Confirm password</label>
                                <input class="form-control" id="password_confirmation" type="password"
                                       name="password_confirmation"
                                       value="{{ old('password') ?? $admin->password }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox"
                                               @if($admin->status) checked @endif
                                               name="status" value="1">
                                        Status
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12 ml-auto mr-auto text-right">
                                <a href="{{ route('admins.index') }}" class="btn"> Cancel </a>
                                <button type="submit" class="btn btn-primary" id="submit-form"> Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js-links')
    @parent

    <script src="{{ asset('js/password-show.js') }}"></script>

    <script>

        $(document).ready(function () {

            let mainAdmin = @json( \App\Models\User::MAIN_ADMIN);
            let siteAdmin = @json( \App\Models\User::ADMIN);
            let microAdmin = @json(\App\Models\User::MICRO_ADMIN);
            let role = $('#privileges').val();
            let marketsInput = $("#markets");
            markets(role, marketsInput)

            if (role == siteAdmin) {
                marketsInput.prop('disabled', true);
                marketsInput.empty();
            }

            $('#privileges').on('change', function (e) {
                e.preventDefault()

                role = this.value;

                if (role == siteAdmin) {
                    marketsInput.prop('disabled', true);
                }
                marketsInput.empty();
                markets(role, marketsInput)
            })

            function markets(role, marketsInput) {

                let marketsWrapper = $('#markets-wrapper');
                marketsWrapper.show();
                marketsInput.prop('required', true)

                if (role == mainAdmin) {
                    marketsInput.removeAttr('required')
                    marketsWrapper.hide();
                }

                if (role == microAdmin) {
                    marketsInput.prop('disabled', false);
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('admins.markets') }}",
                    type: 'post',
                    data: {role_id: role},
                    dataType: 'json',
                    success: function (data) {
                        $.each(data.markets, function (key, value) {
                            $("#markets").append($('<option/>', {
                                value: value.id,
                                text: value.name,
                                selected: ((role == siteAdmin) ? 'selected' : false)
                            }));
                        });
                    }
                });
            }

            $('#submit-form').on('click', function () {
                marketsInput.prop('disabled', false);
            });
        });

    </script>
@endsection
