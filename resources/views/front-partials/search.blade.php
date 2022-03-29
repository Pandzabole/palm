<div class="b-search_popup search-custom-layout">
    {{--    <form role="search" method="get" id="searchform" class="searchform  basel-ajax-search" action="{{ route('search-class') }}" data-thumbnail="1" data-price="1" data-count="3">--}}
    {{--        @csrf--}}
    {{--        <div>--}}
    {{--            <label class="screen-reader-text" for="s"></label>--}}
    {{--            <input type="text" placeholder="Search for products" value="" name="search" id="s" autocomplete="off">--}}
    {{--            <input type="hidden" name="post_type" id="post_type" value="product">--}}
    {{--            <button type="submit" class="b-searchsubmit" id="b-searchsubmit">Search</button>--}}
    {{--            <div class="search-result">rezultati</div>--}}
    {{--            <div class="search-result">rezultati</div>--}}
    {{--            <div class="search-result">rezultati</div>--}}
    {{--            <div class="search-result">rezultati</div>--}}
    {{--        </div>--}}
    {{--    </form>--}}

    <form role="search" method="get" id="searchform" class="searchform  basel-ajax-search" action="" data-thumbnail="1"
          data-price="1" data-count="3">
        @csrf
        <div id="results">
            <label class="screen-reader-text" for="s"></label>
            <input type="text" placeholder="Search for classes" value="" name="search" id="search" autocomplete="off">
            <a class="b-searchsubmit search-classes" id="b-searchsubmit">Search</a>
        </div>
        <div class="no-search-results" id="no-search">No search results</div>

    </form>
    <span class="b-close_search" id="b-close_search">close</span>
</div>

@section('js-links')
    @parent
    <script>
        $(document).ready(function () {
            $('.b-close_search').on('click', function () {
                $('#no-search').hide();
                $('#search').val('');
                $('.search-result').empty();
            });

            $('#no-search').hide()

            $('#search').on('keyup', function (e) {
                e.preventDefault()
                let search = $(this).val();
                if (search.length === 0) {
                    $('.search-result').empty();
                }
                $.ajax({
                    url: "{{ route('search-class') }}",
                    search: search,
                    data: {
                        search: search,
                        _token: "{{ csrf_token() }}"
                    },
                    type: "GET",
                    success: function (data) {
                        if (data) {
                            $('.search-result').empty();
                            $('#no-search').hide();
                            $.each(data.classes, function (index, subcategory) {

                                let url = '{{  route('single-class', ['lang' => $selectedLanguageLayout, ":id"]) }}';
                                url = url.replace(':id', subcategory.uuid);

                                $('#results').append('<div class="search-result"><a href="' + url + '"> '  + subcategory.name + '</a> </div>');
                            })
                        }
                        if (data.classes.length === 0) {
                            $('.search-result').empty();
                            $('#no-search').show()
                        }
                    }
                });
            })
        })
    </script>
@endsection
