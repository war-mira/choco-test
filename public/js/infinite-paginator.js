var InfinitePaginator = function (config) {
    var self = this;
    self.config = config;
    self.draw = 0;
    self.slider = null;
    self.getPageId = function (n) {
        return self.config.pageIdPerfix + n;
    };
    self.getContainer = function () {
        return self.config.container;
    };
    self.loadNextPage = function (ajaxData) {
        self.getContainer().find('.d-result').detach();
        self.config.pagination.html('');
        if (self.getContainer().find('#loader').length <= 0)
            self.getContainer().append($('<div class="filter" id="loader" style="height: 300px"><div class="load-spinner"></div></div> '));
        var currDraw = ++self.draw;
        $.post(self.getPageSource(), ajaxData, function (data) {
            if (currDraw != self.draw)
                return;
            self.config.dataHandler(data);
            self.getContainer().find('#loader').detach();
            self.getContainer().append($(data.view));
            self.getContainer().append($(' <div class="results d-result" style="float: right;">\n' +
                '        <div class="text-center search-pagination">\n' +
                data.pagination +
                '        </div>\n' +
                '        </div>'));
            var paginationItem = $(data.pagination);
            self.config.pagination.html(paginationItem);

        });
    };
    self.getPageSource = function (n) {
        return self.config.source;
    };
};

function getScrollTop() {
    return (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;
}

function getDocumentHeight() {
    const body = document.body;
    const html = document.documentElement;

    return Math.max(
        body.scrollHeight, body.offsetHeight,
        html.clientHeight, html.scrollHeight, html.offsetHeight
    );
}


