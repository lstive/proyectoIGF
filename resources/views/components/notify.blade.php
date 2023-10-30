<div class="notify">
  @if(request()->get('ok') != null)
  @if(request()->get('ok') == 1)
  <div class="notify-ok-content">{{ $ok }}</div>
  @else
  <div class="notify-error-content">{{ $error }}</div>
  @endif
  @endif
</div>
