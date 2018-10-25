
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));


Vue.component('admin-sessions', function (resolve) {
    require(['./components/admin_sessions.vue'], resolve)
});
Vue.component('user-profile', require('./components/user_profile'));
Vue.component('edit-user-profile', require('./components/edit_profile'));
Vue.component('doctor-reviews', require('./components/block_reviews'));
Vue.component('btn-ajax', require('./components/btn_ajax.vue'));
Vue.component('inp-rate', require('./components/inp_rate.vue'));
Vue.component('rx-span', require('./components/rx_span.vue'));
Vue.component('phone-show-btn', require('./components/phone_show_btn.vue'));
Vue.component('find-doctor-btn', require('./components/find_doctor_btn.vue'));
Vue.component('load-doctors-btn', require('./components/load_doctors_btn.vue'));

window.socket = Echo.connector.socket;
// window.socket = {};



window.runVue = function() {
    window.app = new Vue({
        el: '#app',
        data:{

        },

        watch:{

        },
        mounted:function(){

            let tabID = sessionStorage.tabID ? sessionStorage.tabID : sessionStorage.tabID = Math.random();
            socket.emit('handshake',Echo.connector.csrfToken(),tabID);
            socket.on('state',function (message) {
                // socket.emit('join','for-all-dummies');
            });

            socket.on('command redirect',function (msg) {
                console.log('redirect to:', msg);
                location.href = msg;
            });


            socket.on('command notify',function (msg) {
                // toastr message
                toastr.success(msg)
            });

        },
        methods:{

        }
    });
}

runVue();