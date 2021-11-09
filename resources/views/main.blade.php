<div class="navbar-wrapper">
    <div class="navbar-toggle">
        <button type="button" class="navbar-toggler">
            <span class="navbar-toggler-bar bar1"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
        </button>
    </div>
    @if (isset($selectedLanguageLayout))
        <div class="btn-group select-language">
            <button type="button"
                    class="btn">{{ data_get($languageList, $selectedLanguageLayout) }}</button>
            <button type="button" class="btn dropdown-toggle dropdown-toggle-split"
                    data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">{{ data_get($languageList, $selectedLanguageLayout) }}</span>
            </button>
            <div class="dropdown-menu">
                @foreach($languageList as $code => $language)
                    <a class="dropdown-item"
                       href="{{ route('set-language-layout', ['lang' => $code]) }}">{{ $language }}</a>
                @endforeach
            </div>
        </div>
    @endif
</div>
