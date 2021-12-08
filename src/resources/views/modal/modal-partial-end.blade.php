</div>

<!-- Modal footer -->
@if ($modal['footer-render'])
<div class="modal-footer">
    @if (empty($modal['footer-content']))
    <button type="button" class="btn btn-danger" data-dismiss="modal" id="modal-button-close"><i class="fas fa-fw fa-times"></i>&nbsp;<?php echo __("Close") ?></button>
    <button type="submit" class="btn btn-success" id="modal-button-save"><i class="fas fa-fw fa-save"></i>&nbsp;<?php echo __("Save") ?></button>
    @else
    {!! $modal['footer-content'] !!}
    @endif
</div>
@endif
</form>