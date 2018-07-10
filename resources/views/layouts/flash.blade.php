@if ($msg = session('message'))
    <div class="alert alert-success" id="flash-message">
        {{ $msg }}
    </div>
@endif

@push ('scripts')
    <script type="text/javascript">
        $(function() {
            $('#flash-message').delay(250).fadeIn(1000).delay(3000).fadeOut(1000);
        });
    </script>
@endpush
