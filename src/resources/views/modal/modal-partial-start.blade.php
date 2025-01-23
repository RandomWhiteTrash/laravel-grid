<!-- Modal Header -->
<div class="modal-header">
    <input type="hidden" name="modal_size" value="{{ $modal['size'] ?? 'lg' }}">
    <input type="hidden" name="modal_backdrop" value="{{ $modal['backdrop'] ?? '' }}">
    <h4 class="modal-title">{{ !empty($modal['title']) ? $modal['title'] : (ucwords($modal['action'] . ' '. class_basename($modal['model']))) }}</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<!-- Modal body -->
<form accept-charset="UTF-8" action="{{ $modal['route'] }}" id="modal_form"
      data-pjax-target="#{{ $modal['pjaxContainer'] ?? null }}" method="POST">
    <div class="modal-body">
        <div id="modal-notification"></div>
        @if(isset($modal['method']) && $modal['method'] != 'post')
            <input type="hidden" name="_method" value="{{ $modal['method'] }}">
        @endif
{!! csrf_field() !!}