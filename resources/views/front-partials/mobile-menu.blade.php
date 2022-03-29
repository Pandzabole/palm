<!-- MOBILE MENU-->
@if($session === 'database-om' || $session === 'database-ar')
    <div class="b-main_menu-wrapper hidden-lg-up" style="max-width: 100%" >

@else
    <div class="b-main_menu-wrapper hidden-lg-up">
@endif
    <ul class="mobile-top">
        <li class="search">
            <form role="search" method="get" id="searchform-mobile" class="searchform-mobile  basel-ajax-search" action="" data-thumbnail="1"
                  data-price="1" data-count="3">
                @csrf
                    <label class="screen-reader-text" for="s"></label>
                    <input type="text" placeholder="Search for classes" value="" name="search" id="search-mobile" autocomplete="off">
            </form>
        </li>
        <li class="no-search-results-mobile text-center" id="no-search-mobile">
            No search results
        </li>
        <li id="results-mobile">
        </li>
    </ul>
    <ul class="categories @if($session === 'database-om' || $session === 'database-ar') text-right @else text-center @endif menu-list-mobile">
        <li>
            <a href="{{ route('home', ['lang' => $selectedLanguageLayout]) }}"><span class="top">{{__('home-page.home')}}</span></a>
        </li>
        <!-- Top level items -->
        <li class=" has-sub dropdown-wrapper from-bottom">
            @if($session === 'database-om' || $session === 'database-ar')
                <a href="{{ route('all-classes', ['lang' => $selectedLanguageLayout]) }}"><span class="top"><span class="fa fa-angle-down mr-2"></span>{{__('home-page.all-classes')}}</span></a>

            @else
                <a href="{{ route('all-classes', ['lang' => $selectedLanguageLayout]) }}"><span class="top">{{__('home-page.all-classes')}}</span><i class="fa fa-angle-down"></i></a>
        @endif
            <!-- Sub Menu items -->
            <div class="dropdown-content sub-holder dropdown-left narrow">
                <div class="dropdown-inner">
                    <div class="clearfix">
                        <div class="col-xs-12 col-sm-12 ">
                            <div class="menu-item">
                                <div class="categories">
                                    <div class="clearfix">
                                        <div class="col-sm-12 hover-menu">
                                            <ul>
                                                @foreach($mainCategories as $key => $mainCategory)
                                                    <li><a href="{{ route('main-category', ['lang' => $selectedLanguageLayout, $mainCategory->uuid]) }}">{{ $mainCategory->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <a href="{{ route('all-discounted-classes', ['lang' => $selectedLanguageLayout]) }}"><span class="top">{{__('home-page.mount-offer')}}</span></a>
        </li>
        <li>
            <a href="{{route('contact-us', ['lang' => $selectedLanguageLayout])}}"><span class="top">{{__('home-page.contact')}}</span></a>
        </li>
    </ul>
        <ul>
            <li class="btn-close-mobile-menu text-center mt-5" id="close-mobile-menu">
                {{__('home-page.close')}}
            </li>
        </ul>
</div>

@yield('mobile-menu')
    @section('js-links')
        @parent
        <script>
            $(document).ready(function () {
                $('.btn-close-mobile-menu').on('click', function () {
                    $('#no-search-mobile').hide();
                    $('#search-mobile').val('');
                    $('.search-result-mobile').empty();
                    $('.menu-list-mobile').show()
                });

                $('#no-search-mobile').hide()

                $('#search-mobile').on('keyup', function (e) {
                    e.preventDefault()
                    $('.menu-list-mobile').hide()
                    let search = $(this).val();
                    if (search.length === 0) {
                        $('.search-result-mobile').empty();
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
                                $('.search-result-mobile').empty();
                                $('#no-search-mobile').hide();
                                $.each(data.classes, function (index, subcategory) {

                                    let url = '{{  route('single-class', ['lang' => $selectedLanguageLayout, ":id"]) }}';
                                    url = url.replace(':id', subcategory.uuid);

                                    $('#results-mobile').append('<div class="search-result-mobile"><a class="search-result-mobile-href" href="' + url + '"> '  + subcategory.name + '</a> </div>');
                                })
                            }
                            if (data.classes.length === 0) {
                                $('.search-result-mobile').empty();
                                $('#results-mobile').empty();
                                $('#no-search-mobile').show();
                            }
                        }
                    });
                })
            })
        </script>
    @endsection
