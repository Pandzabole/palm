@section('js-links')
    @parent
    <script src="{{ asset('js/bootstrap-notify.js') }}"></script>
    <script>
        @if(session()->has('success'))
        notifyIt('{{ session()->get('success') }}');
        @php
            session()->forget('success');
        @endphp
        @endif
        @if(session()->has('errors'))
        @foreach($errors->all() as $message)
        notifyIt("{{$message}}", 'danger');

        @endforeach
        @php
            session()->forget('errors');
        @endphp
        @endif
        function notifyIt(message, type = 'success') {
            let setup = {
                type: type,
                timer: 1000,
                placement: {
                    from: 'top',
                    align: 'right'
                }
            };
            $.notify(
                {
                    icon: "fa fa-bell",
                    message: message
                },
                setup
            );
        }
    </script>
@endsection
