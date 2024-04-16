<form method="GET" id="{{ $id }}" action="{{ $action }}"
      @foreach($dataAttributes as $k => $v)
          data-{{ $k }}="{{ $v }}"
    @endforeach
>
    <div class="input-group mb-12">
        <input type="text" class="form-control" name="{{ $name }}"
               placeholder="{{ $placeholder }}" value="{{ request($name) }}" aria-label="search">
        <div class="input-group-append">
            <button class="btn btn-primary grid-search-submit-button" type="submit"><i
                    class="fa fa-search"></i> {{ __("Search") }}</button>
        </div>
    </div>
    @if ($grid->renderSearchFormCustomSwitches)
        <div class="ml-4">
            <input class="form-check-input" type="checkbox" name="{{ $custom_one_name }}"
                   value="true" {{request($custom_one_name, false) == true?"checked":""}}><label
                class="form-check-label">{{ $custom_one_label }}</label>
        </div>
    @endif
</form>
