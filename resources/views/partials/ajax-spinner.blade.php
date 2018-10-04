<style>
    #loader {
        display          : none;
        background-color : rgba(0, 0, 0, .3);
        position         : fixed;
        left             : 0;
        top              : 0;
        width            : 100%;
        height           : 100%;
        z-index          : 9998;
    }

    .ajax-spinner {
        width      : 48px;
        height     : 48px;
        display    : inline-block;
        box-sizing : border-box;
        position   : absolute;
        top        : 25px;
        right      : 25px;
    }

    .ajax-skeleton {
        border-radius : 50%;
        border-top    : solid 6px white;
        border-right  : solid 6px transparent;
        border-bottom : solid 6px transparent;
        border-left   : solid 6px transparent;
        animation     : ajax-skeleton-animate 1s linear infinite;
    }

    .ajax-skeleton:before {
        border-radius : 50%;
        content       : " ";
        width         : 48px;
        height        : 48px;
        display       : inline-block;
        box-sizing    : border-box;
        border-top    : solid 6px transparent;
        border-right  : solid 6px transparent;
        border-bottom : solid 6px transparent;
        border-left   : solid 6px white;
        position      : absolute;
        top           : -6px;
        left          : -6px;
        transform     : rotateZ(-30deg);
    }

    .ajax-skeleton:after {
        border-radius : 50%;
        content       : " ";
        width         : 48px;
        height        : 48px;
        display       : inline-block;
        box-sizing    : border-box;
        border-top    : solid 6px transparent;
        border-right  : solid 6px white;
        border-bottom : solid 6px transparent;
        border-left   : solid 6px transparent;
        position      : absolute;
        top           : -6px;
        right         : -6px;
        transform     : rotateZ(30deg);
    }

    @keyframes ajax-skeleton-animate {
        0% {
            transform : rotate(0);
            opacity   : 1
        }
        50% {
            opacity : .7
        }
        100% {
            transform : rotate(360deg);
            opacity   : 1;
        }
    }
</style>

<div id="loader">
    <div class="ajax-spinner ajax-skeleton"></div>
</div>