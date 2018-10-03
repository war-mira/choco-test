<div class="row" id="{{$doctor['id']}}-doctor-comments-section">
    <div class="col-sm-8">
        @include('redesign.doctors.profile.tabs.comments.list')
    </div>
    <!-- /Tab content block -->
    <div class="col-sm-4">
        <aside class="side-content">
            @include('redesign.doctors.profile.tabs.comments.form')
        </aside>
    </div>
</div>
@push('scripts')
    <script>
        $(function () {
            var countPagination = function (pages, page) {

                var pageState = page;
                if (page < 6)
                    pageState = 6;
                else if (page > pages - 5)
                    pageState = pages - 5;

                var innerPagination;
                if (pages >= 11) {
                    innerPagination = [1,
                        2,
                        pageState > 6 ? '...' : 3,
                        pageState - 2,
                        pageState - 1,
                        pageState,
                        pageState + 1,
                        pageState + 2,
                        pageState < (pages - 5) ? '...' : pages - 2,
                        pages - 1,
                        pages];
                }
                else {
                    innerPagination = [];
                    for (var i = 1; i <= pages; i++)
                        innerPagination.push(i);

                }
                var pagination = ['«'].concat(innerPagination).concat(['»']);
                var renderPaginationItem = function (name, curr, pageNum) {
                    if (curr)
                        return '<li class="pagination-li current"><a>' + name + '</a></li>';
                    else if (pageNum)
                        return '<li class="pagination-li"><a href="#" data-page="' + pageNum + '">' + name + '</a></li>';
                    else
                        return '<li class="pagination-li"><span>' + name + '</span></li>';
                };
                var paginationHtml = pagination.reduce(function (prev, curr) {
                    var current = false, pageNum = false;

                    if (curr == page)
                        current = true;

                    if (curr == '«' && page > 1)
                        pageNum = parseInt(page) - 1;
                    else if (curr == '»' && page < pages)
                        pageNum = parseInt(page) + 1;
                    else if (Number.isInteger(curr))
                        pageNum = curr;


                    var paginationItem = renderPaginationItem(curr, current, pageNum);

                    return prev + paginationItem;
                }, '');

                return $(paginationHtml);
            };
            var initCommentsList = function ($section) {
                var $filterForm = $section.find('[data-role="filter"]');

                var $commentsList = $section.find('[data-role="list"]');

                var $pagination = $section.find('.comments-pagination');

                var $rateFilter = $filterForm.find('input[name="rate"]');
                var $pageInput = $filterForm.find('input[name="page"]');

                var loadPage = function (page) {
                    if (page)
                        $pageInput.val(page).trigger('change');
                    $filterForm.addClass('disabled');
                    $filterForm.ajaxSubmit({
                        success: function (comments) {
                            $pagination.empty().append(countPagination(comments.total, comments.page));
                            $pageInput.val(comments.page).trigger('change');
                            $commentsList.html(comments.view).ready(function () {
                                $filterForm.removeClass('disabled');
                            });

                        },
                        error: function (error) {
                            alert("Ошибка");
                            $filterForm.removeClass('disabled');
                        }
                    })
                };
                $pagination.on('click', 'a[href]', function () {
                    var page = $(this).data('page');
                    loadPage(page);
                    return false;
                });

                $rateFilter.on('change', function () {
                    loadPage();
                });
                loadPage(1);
            };
            var $commentsSection = $('#{{$doctor['id']}}-doctor-comments-section');
            initCommentsList($commentsSection);
        });


    </script>
@endpush