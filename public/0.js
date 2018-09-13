webpackJsonp([0],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}]]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/admin_sessions.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__btn_ajax_vue__ = __webpack_require__("./resources/assets/js/components/btn_ajax.vue");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__btn_ajax_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__btn_ajax_vue__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//


// import selectUser from './inp_selectUser.vue'
/* harmony default export */ __webpack_exports__["default"] = ({
    data: function data() {
        return {
            sessions: collect([]),
            current: null,
            user: null
        };
    },
    mounted: function mounted() {
        var _this = this;

        socket.on('active-sessions', function (data) {
            _this.sessions = collect(JSON.parse(data).items).values().groupBy(function (item) {
                return item.user ? item.user.id : null;
            }).transform(function (user, key) {
                return {
                    'user': key > 0 ? user.items[0].user.name : 'Гость',
                    'devices': collect(user.items).groupBy('csrf').transform(function (device, csrf) {
                        return {
                            'device': csrf,
                            'tabs': device.items
                        };
                    }).items
                };
            }).items;
        });
    },

    methods: {
        redirect: function redirect(url) {
            socket.emit('socket redirect', this.current.socket, url);
        },
        login: function login(uid) {
            socket.emit('manual authorization', this.current.socket, uid);
        }
    },
    components: {
        'btn': __WEBPACK_IMPORTED_MODULE_0__btn_ajax_vue___default.a
        // 'select-user':selectUser
    }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-709ec2e4\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/admin_sessions.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.session-app{\n    display: -webkit-box;\n    display: -ms-flexbox;\n    display: flex;\n    width: 100%;\n    height: 100%;\n}\n.active-sessions{\n    border-right: 1px solid #888;\n}\n.session-viewer{\n    display: -webkit-box;\n    display: -ms-flexbox;\n    display: flex;\n    -webkit-box-orient: vertical;\n    -webkit-box-direction: normal;\n        -ms-flex-direction: column;\n            flex-direction: column;\n    -webkit-box-flex: 1;\n        -ms-flex-positive: 1;\n            flex-grow: 1;\n}\n.session-viewer .details{\n    -webkit-box-flex: 1;\n        -ms-flex-positive: 1;\n            flex-grow: 1;\n}\n.session-info{\n    border-bottom: 1px solid #888;\n    display: -webkit-box;\n    display: -ms-flexbox;\n    display: flex;\n}\n.socket-item{\n    cursor: pointer;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-709ec2e4\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/admin_sessions.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "session-app" }, [
    _c(
      "div",
      { staticClass: "active-sessions" },
      _vm._l(_vm.sessions, function(user, id) {
        return _c(
          "div",
          { staticClass: "card my-2" },
          [
            _c("div", { staticClass: "card-header" }, [
              _vm._v(_vm._s(user.name) + " (" + _vm._s(id) + ")")
            ]),
            _vm._v(" "),
            _vm._l(user.devices, function(device, csrf) {
              return _c("div", { staticClass: "list-group list-group-flush" }, [
                _c(
                  "div",
                  {
                    staticClass: "list-group-item flex-column align-items-start"
                  },
                  [
                    _c(
                      "div",
                      { staticClass: "d-flex w-100 justify-content-between" },
                      [
                        _c("h3", { staticClass: "mb-1" }, [
                          _vm._v(_vm._s(device.device))
                        ])
                      ]
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      { staticClass: "list-group list-group-flush" },
                      _vm._l(device.tabs, function(socket) {
                        return _c(
                          "div",
                          {
                            staticClass: "list-group-item socket-item",
                            class: { active: _vm.current == socket },
                            on: {
                              click: function($event) {
                                _vm.current = socket
                              }
                            }
                          },
                          [
                            _c("strong", [
                              _c("img", {
                                staticStyle: { height: "26px" },
                                attrs: {
                                  src:
                                    "https://avatars.dicebear.com/v2/identicon/" +
                                    socket.tabId +
                                    ".svg"
                                }
                              }),
                              _vm._v(
                                "\n                                " +
                                  _vm._s(socket.tabId)
                              )
                            ]),
                            _vm._v(" "),
                            _c("p", { staticClass: "mb-1" }, [
                              _vm._v(_vm._s(socket.page))
                            ]),
                            _vm._v(" "),
                            _c("small", [
                              _vm._v(
                                _vm._s(socket.address) +
                                  " - " +
                                  _vm._s(socket.socket)
                              )
                            ])
                          ]
                        )
                      })
                    )
                  ]
                )
              ])
            })
          ],
          2
        )
      })
    ),
    _vm._v(" "),
    _c("div", { staticClass: "session-viewer" }, [
      _vm.current
        ? _c("div", { staticClass: "session-info" }, [
            _c("div", { staticClass: "details pl-2" }, [
              _c("div", [
                _c("i", { staticClass: "fa-link fa" }),
                _vm._v(" "),
                _c(
                  "a",
                  { attrs: { href: _vm.current.page, target: "_blank" } },
                  [_vm._v(_vm._s(_vm.current.page))]
                )
              ]),
              _vm._v(" "),
              _c("div", [_c("small", [_vm._v(_vm._s(_vm.current.user_agent))])])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "actions " }, [
              _c("div", { staticClass: "p-1" }, [
                _c(
                  "div",
                  { staticClass: "btn-group", attrs: { role: "group" } },
                  [
                    _c(
                      "button",
                      {
                        staticClass: "btn btn-outline-secondary",
                        attrs: { type: "button" }
                      },
                      [_vm._v("Вызвать чат")]
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      { staticClass: "btn-group", attrs: { role: "group" } },
                      [
                        _c("button", {
                          staticClass:
                            "btn btn-outline-secondary dropdown-toggle",
                          attrs: {
                            id: "sessionActions",
                            type: "button",
                            "data-toggle": "dropdown",
                            "aria-haspopup": "true",
                            "aria-expanded": "false"
                          }
                        }),
                        _vm._v(" "),
                        _c(
                          "div",
                          {
                            staticClass: "dropdown-menu dropdown-menu-right",
                            attrs: { "aria-labelledby": "sessionActions" }
                          },
                          [
                            _c(
                              "a",
                              {
                                staticClass: "dropdown-item",
                                attrs: { href: "#" }
                              },
                              [_vm._v("Снимок экрана")]
                            ),
                            _vm._v(" "),
                            _c(
                              "a",
                              {
                                staticClass: "dropdown-item",
                                attrs: { href: "#" },
                                on: {
                                  click: function($event) {
                                    _vm.login(10)
                                  }
                                }
                              },
                              [_vm._v("Авторизовать")]
                            ),
                            _vm._v(" "),
                            _c(
                              "a",
                              {
                                staticClass: "dropdown-item",
                                attrs: { href: "#" },
                                on: {
                                  click: function($event) {
                                    _vm.redirect("https://dev.idoctor.kz/")
                                  }
                                }
                              },
                              [_vm._v("Перенаправить")]
                            ),
                            _vm._v(" "),
                            _c(
                              "a",
                              {
                                staticClass: "dropdown-item",
                                attrs: { href: "#" }
                              },
                              [_vm._v("Отправить файл")]
                            )
                          ]
                        )
                      ]
                    )
                  ]
                )
              ])
            ])
          ])
        : _vm._e(),
      _vm._v(" "),
      _c("div", { staticClass: "session-control" }, [
        _c("div", { staticClass: "module-block" }, [
          _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col" }, [
              _c("div", { staticClass: "m-3" }, [
                _c("div", { staticClass: "input-group input-group-sm" }, [
                  _c("div", { staticClass: "input-group-append" }, [
                    _c(
                      "button",
                      {
                        staticClass: "btn btn-outline-secondary",
                        attrs: { type: "button" },
                        on: {
                          click: function($event) {
                            _vm.login(_vm.user)
                          }
                        }
                      },
                      [_vm._v("Авторизовать")]
                    )
                  ])
                ])
              ])
            ])
          ])
        ])
      ])
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-709ec2e4", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-709ec2e4\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/admin_sessions.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-709ec2e4\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/admin_sessions.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("ba597b6c", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-709ec2e4\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./admin_sessions.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-709ec2e4\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./admin_sessions.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/admin_sessions.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-709ec2e4\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/admin_sessions.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}]]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/admin_sessions.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-709ec2e4\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/admin_sessions.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/admin_sessions.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-709ec2e4", Component.options)
  } else {
    hotAPI.reload("data-v-709ec2e4", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});