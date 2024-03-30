@include('admin.popups.popup')


@if(Session::has('success'))
    <script>
        openPopup("{{ Session::get('success') }}", "success");
    </script>
@elseif(Session::has('deactivated'))
<script>
    openPopup("{{ Session::get('deactivated') }}", "warning");
</script>
@endif
