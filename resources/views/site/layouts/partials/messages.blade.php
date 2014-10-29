 @if (Session::has('msg-danger') || Session::has('msg-warning') || Session::has('msg-info') || Session::has('msg-success'))
    <div id="flash-messages">
        @if (Session::has('msg-danger'))

        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
            <strong>{{ trans('Error') }}: </strong> {{ Session::get('msg-danger') }}
        </div>

        @elseif (Session::has('msg-warning'))

        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
            <strong>{{ trans('Warning') }}: </strong> {{ Session::get('msg-warning') }}
        </div>

        @elseif (Session::has('msg-info'))

        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
            <strong>{{ trans('Info') }}: </strong> {{ Session::get('msg-info') }}
        </div>

        @elseif (Session::has('msg-success'))

        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
            <strong>{{ trans('Success') }}: </strong> {{ Session::get('msg-success') }}
        </div>

        @endif
    </div>

    <script type="text/javascript">
        $(function() { $("#flash-messages").delay(10000).slideUp(200); })
    </script>
@endif
