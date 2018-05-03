<input type="text" name="{{ $name }}" id="{{ $id }}"
       form="{{ $formId }}"
       class="{{ $class }}" value="{{ request($name) }}" data-toggle="tooltip" title="{{ $title }}" placeholder="{{ $title }}"
       style="font-size: 12px;"
       @foreach($dataAttributes as $k => $v)
       data-{{ $k }}={{ $v }}
        @endforeach
>