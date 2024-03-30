@include('admin.popups.popup')


@if(Session::has('success'))
    <script>
        openPopup("{{ Session::get('success') }}", "success");
    </script>
@elseif(Session::has('failed'))
    <script>
        openPopup("{{ Session::get('failed') }}", "warning");
    </script>
@elseif(Session::has('profileUpdated'))
<script>
    openPopup("{{ Session::get('profileUpdated') }}", "success");
</script>
@elseif(Session::has('errorNotFound'))
<script>
    openPopup("{{ Session::get('errorNotFound') }}", "warning");
</script>
@elseif ($errors->any())
    @foreach($errors->all() as $error)
    <script>  
        openPopup("{{ $error }}", "warning");
    </script>
    @endforeach
@endif

