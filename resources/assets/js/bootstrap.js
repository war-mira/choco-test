
window._ = require('lodash');
window.Popper = require('popper.js').default;
window.io = require("socket.io-client");
//window.toastr = require('toastr');
window.collect = require('collect.js');

window.Vue = require('vue');
require('vue-resource');


/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    // window.$ = window.jQuery = require('jquery');

    // require('bootstrap-sass');
} catch (e) {}




/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
window.Laravel = {"csrfToken":document.getElementsByName('csrf-token')[0].content};

Vue.http.headers.common['X-CSRF-TOKEN'] = Laravel.csrfToken;
Vue.http.interceptors.push((request, next) => {
    request.headers['X-CSRF-TOKEN'] = Laravel.csrfToken;
    next();
});


// window.axios = require('axios');
//
// window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from "laravel-echo"

window.Echo = new Echo({
    broadcaster: "socket.io",
    host: 'https://socket.idoctor.kz'
});
