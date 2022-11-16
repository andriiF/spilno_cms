$(document).ready(function () {
    $('.nav-link').click(function (e) {
        e.preventDefault();
        let data_href = $(this).attr('data-href');
        let href = $(this).attr('href');
        if (href === '/') {
            window.location.replace('/' + data_href);
        } else {
            $('html, body').animate({
                scrollTop: [$(data_href).offset().top - 130, "swing"]
            }, 250);
        }
        return false;
    });

    if ($('.loadMoreArticles').length > 0) {
        $('.loadMoreArticles').click(function () {
            mainPage.loadMoreArticles();
        });

        mainPage.updateList();
    }

});


const mainPage = {
    newsPageCount: 3,
    newsCurrentCount: 3,
    loadMoreArticles: function () {
        this.newsCurrentCount += this.newsPageCount;
        this.updateList();

    },
    updateList: function () {
        let newsCurrentCount = this.newsCurrentCount;

        $('.list-articles .item').each(function (key, value) {
            if (key >= newsCurrentCount) {
                $(value).hide();
                $(value).removeClass('d-block');
            } else {
                $(value).show();
                $(value).addClass('d-block');
            }
        })
        this.validateMoreArticlesBtn();
    },
    validateMoreArticlesBtn: function () {
        let newsCount = $('.list-articles .item').length;
        if (newsCount <= this.newsCurrentCount) {
            $('.more-articles').hide();
        } else {
            $('.more-articles').show();
        }
    }

}