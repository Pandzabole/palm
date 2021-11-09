@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-left"> Create Admin </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('admins.store')}}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 @if($errors->has('name')) has-danger @endif">
                                <label for="name">Name</label>
                                <input id="name" class="form-control" placeholder="Name"
                                       name="name"
                                       value="{{ old('name')}}" required>
                                @if($errors->has('name'))
                                    <span class="text-danger">*{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6  @if($errors->has('role_id')) has-danger @endif">
                                <label for="privileges" class="asterisk">Admins privileges</label>
                                <select class="form-control selectpicker" id="privileges"
                                        data-toggle="select" data-placeholder="Privileges" required
                                        name="role_id"
                                        data-live-search="false">
                                    <option selected="selected" disabled>
                                        Choose admin
                                    </option>
                                    @foreach( config('admins.admins') as $key => $value)
                                        <option
                                            value="{{ $key }}" {{ (collect(old('role_id'))->contains( $key )) ? 'selected':'' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->has('role_id'))
                                    <span class="text-danger">*{{ $errors->first('role_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 @if($errors->has('email')) has-danger @endif">
                                <label for="email">Email</label>
                                <input id="email" type="text" class="form-control" placeholder="Email"
                                       name="email"
                                       value="{{ old('email') }}">
                                @if($errors->has('email'))
                                    <span class="text-danger">*{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div
                                class="form-group col-md-6 @if($errors->has('main_market_id')) has-danger @endif"
                                id="markets-wrapper">
                                <label for="markets" class="asterisk">Language</label>
                                <select class="form-control selectpicker" id="markets"
                                        data-toggle="select" data-placeholder="Markets"
                                        name="main_market_id[]"
                                        multiple disabled>
                                    @foreach( $markets as $market)
                                        <option
                                            {{ (collect(old('main_market_id'))->contains( $market->id )) ? 'selected':'' }}
                                            value="{{ $market->id }}">
                                            {{ $market->name  }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->has('main_market_id'))
                                    <span class="text-danger">*{{ $errors->first('main_market_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 @if($errors->has('password')) has-danger @endif">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control" placeholder="Password"
                                       name="password" required>
                                @if($errors->has('password'))
                                    <span class="text-danger">*{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password_confirmation">Password confirmation</label>
                                <input id="password_confirmation" type="password" class="form-control"
                                       placeholder="Password confirmation" name="password_confirmation">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="status" checked value="1">
                                        Status
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col ml-auto mr-auto text-right">
                                <a href="{{ route('admins.index') }}" class="btn"> Cancel </a>
                                <button type="submit" class="btn btn-primary" id="submit-form"> Add</button>
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
