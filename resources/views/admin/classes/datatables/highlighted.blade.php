<div>
    <img src="{{ asset($highlighted ? 'img/checked.png' : 'img/unchecked.png') }}" class="pt-2" width="20px" alt="published">
    @if(!$highlighted)
        <a href="{{ route('classes.highlight', $id) }}"  class="float-right btn btn-secondary btn-icon">
            <i class="fa fa-bolt"></i>
        </a>
    @endif
</div>

