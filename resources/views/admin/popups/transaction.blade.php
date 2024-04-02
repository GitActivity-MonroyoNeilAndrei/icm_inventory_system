@include('admin.popups.popup')


@if(Session::has('success'))
    <script>
        openPopup("{{ Session::get('success') }}", "success");
    </script>
@elseif(Session::has('failed'))
    <script>
        openPopup("{{ Session::get('failed') }}", "warning");
    </script>
@elseif(Session::has('onlyLettersName'))
    <script>
        openPopup("{{ Session::get('onlyLettersName') }}", "warning");
    </script>
@elseif(Session::has('dataDeleted'))
    <script>
        openPopup("{{ Session::get('dataDeleted') }}", "neutral");
    </script>
@elseif(Session::has('TransactionUpdated'))
    <script>
        openPopup("{{ Session::get('TransactionUpdated') }}", "success");
    </script>
@elseif(Session::has('errorNotFound'))
    <script>
        openPopup("{{ Session::get('errorNotFound') }}", "success");
    </script>
@elseif ($errors->any())
    @foreach($errors->all() as $error)
    <script>  
        openPopup("{{ $error }}", "warning");
    </script>
    @endforeach
@endif
