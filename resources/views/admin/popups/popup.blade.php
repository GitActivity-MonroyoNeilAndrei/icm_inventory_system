<div id="popup" class="border z-50 rounded p-4 shadow-xl hidden fixed left-1/2 -translate-x-1/2 top-20" >
  <p class="fw-bold text-white" id="popup-message">This is a popup!</p>
</div>


<script>
  function openPopup($text, $popupType) {
  var popup = document.getElementById('popup');
  var message = document.getElementById('popup-message');

  switch ($popupType) {
    case 'success':
      popup.style.backgroundColor = '#002e57';
      break;
    case 'warning':
      popup.style.backgroundColor = '#982A2A';
      break;
    case 'neutral':
      popup.style.backgroundColor = '#414141';
      break;
  }

  message.innerHTML = $text;
  popup.style.display = 'block';

  setTimeout(function() {
      popup.style.display = 'none';
  }, 1300);
}
</script>


<!-- style="display: block; position: fixed; top: 20%; left: 50%; transform: translate(-50%, -20%); background-color: #002e57;" -->