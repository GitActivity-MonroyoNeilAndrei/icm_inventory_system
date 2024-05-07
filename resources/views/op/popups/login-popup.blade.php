@include('admin.popups.popup')


@if(Session::has('success'))
    <script>
        openPopup("{{ Session::get('success') }}", "success");
    </script>
@endif
