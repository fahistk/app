

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible alert-outline fade show" id="message_box" role="alert">
    <strong>Success</strong> - {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@endif
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible alert-outline fade show" id="message_box" role="alert">
    <strong>Warning</strong> - {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


@endif
@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-dismissible alert-outline fade show" id="message_box" role="alert">
   <strong>Warning</strong> - {{ $message }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
<script>
  document.addEventListener('DOMContentLoaded', function () {
  setTimeout(() => {
    $('.alert').alert('close');
  }, 2000);
}, false);
</script>



