webpackJsonp([0],{CXUg:function(s,t,i){i("dslT");var e=i("VU/8")(i("NO4C"),i("S6c9"),null,null);s.exports=e.exports},NO4C:function(s,t,i){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var e=i("Usnf"),a=i.n(e);t.default={data:function(){return{sessions:collect([]),current:null,user:null}},mounted:function(){var s=this;socket.on("active-sessions",function(t){s.sessions=collect(JSON.parse(t).items).values().groupBy(function(s){return s.user?s.user.id:null}).transform(function(s,t){return{user:t>0?s.items[0].user.name:"Гость",devices:collect(s.items).groupBy("csrf").transform(function(s,t){return{device:t,tabs:s.items}}).items}}).items})},methods:{redirect:function(s){socket.emit("socket redirect",this.current.socket,s)},login:function(s){socket.emit("manual authorization",this.current.socket,s)}},components:{btn:a.a}}},S6c9:function(s,t){s.exports={render:function(){var s=this,t=s.$createElement,i=s._self._c||t;return i("div",{staticClass:"session-app"},[i("div",{staticClass:"active-sessions"},s._l(s.sessions,function(t,e){return i("div",{staticClass:"card my-2"},[i("div",{staticClass:"card-header"},[s._v(s._s(t.name)+" ("+s._s(e)+")")]),s._v(" "),s._l(t.devices,function(t,e){return i("div",{staticClass:"list-group list-group-flush"},[i("div",{staticClass:"list-group-item flex-column align-items-start"},[i("div",{staticClass:"d-flex w-100 justify-content-between"},[i("h3",{staticClass:"mb-1"},[s._v(s._s(t.device))])]),s._v(" "),i("div",{staticClass:"list-group list-group-flush"},s._l(t.tabs,function(t){return i("div",{staticClass:"list-group-item socket-item",class:{active:s.current==t},on:{click:function(i){s.current=t}}},[i("strong",[i("img",{staticStyle:{height:"26px"},attrs:{src:"https://avatars.dicebear.com/v2/identicon/"+t.tabId+".svg"}}),s._v("\n                                "+s._s(t.tabId))]),s._v(" "),i("p",{staticClass:"mb-1"},[s._v(s._s(t.page))]),s._v(" "),i("small",[s._v(s._s(t.address)+" - "+s._s(t.socket))])])}))])])})],2)})),s._v(" "),i("div",{staticClass:"session-viewer"},[s.current?i("div",{staticClass:"session-info"},[i("div",{staticClass:"details pl-2"},[i("div",[i("i",{staticClass:"fa-link fa"}),s._v(" "),i("a",{attrs:{href:s.current.page,target:"_blank"}},[s._v(s._s(s.current.page))])]),s._v(" "),i("div",[i("small",[s._v(s._s(s.current.user_agent))])])]),s._v(" "),i("div",{staticClass:"actions "},[i("div",{staticClass:"p-1"},[i("div",{staticClass:"btn-group",attrs:{role:"group"}},[i("button",{staticClass:"btn btn-outline-secondary",attrs:{type:"button"}},[s._v("Вызвать чат")]),s._v(" "),i("div",{staticClass:"btn-group",attrs:{role:"group"}},[i("button",{staticClass:"btn btn-outline-secondary dropdown-toggle",attrs:{id:"sessionActions",type:"button","data-toggle":"dropdown","aria-haspopup":"true","aria-expanded":"false"}}),s._v(" "),i("div",{staticClass:"dropdown-menu dropdown-menu-right",attrs:{"aria-labelledby":"sessionActions"}},[i("a",{staticClass:"dropdown-item",attrs:{href:"#"}},[s._v("Снимок экрана")]),s._v(" "),i("a",{staticClass:"dropdown-item",attrs:{href:"#"},on:{click:function(t){s.login(10)}}},[s._v("Авторизовать")]),s._v(" "),i("a",{staticClass:"dropdown-item",attrs:{href:"#"},on:{click:function(t){s.redirect("https://dev.idoctor.kz/")}}},[s._v("Перенаправить")]),s._v(" "),i("a",{staticClass:"dropdown-item",attrs:{href:"#"}},[s._v("Отправить файл")])])])])])])]):s._e(),s._v(" "),i("div",{staticClass:"session-control"},[i("div",{staticClass:"module-block"},[i("div",{staticClass:"row"},[i("div",{staticClass:"col"},[i("div",{staticClass:"m-3"},[i("div",{staticClass:"input-group input-group-sm"},[i("div",{staticClass:"input-group-append"},[i("button",{staticClass:"btn btn-outline-secondary",attrs:{type:"button"},on:{click:function(t){s.login(s.user)}}},[s._v("Авторизовать")])])])])])])])])])])},staticRenderFns:[]}},ciKI:function(s,t,i){t=s.exports=i("FZ+f")(),t.push([s.i,".session-app{display:-ms-flexbox;display:flex;width:100%;height:100%}.active-sessions{border-right:1px solid #888}.session-viewer{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;-ms-flex-positive:1;flex-grow:1}.session-viewer .details{-ms-flex-positive:1;flex-grow:1}.session-info{border-bottom:1px solid #888;display:-ms-flexbox;display:flex}.socket-item{cursor:pointer}",""])},dslT:function(s,t,i){var e=i("ciKI");"string"==typeof e&&(e=[[s.i,e,""]]),e.locals&&(s.exports=e.locals);i("rjj0")("2d2168d3",e,!0)}});