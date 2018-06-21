! function(t, e) {
  "use strict";
  "object" == typeof module && "object" == typeof module.exports ? module.exports = t.document ? e(t, !0) : function(t) {
    if (!t.document) throw new Error("jQuery requires a window with a document");
    return e(t)
  } : e(t)
}("undefined" != typeof window ? window : this, function(t, e) {
  "use strict";

  function i(t, e) {
    e = e || et;
    var i = e.createElement("script");
    i.text = t, e.head.appendChild(i).parentNode.removeChild(i)
  }

  function s(t) {
    var e = !!t && "length" in t && t.length,
      i = ft.type(t);
    return "function" !== i && !ft.isWindow(t) && ("array" === i || 0 === e || "number" == typeof e && e > 0 && e - 1 in t)
  }

  function n(t, e, i) {
    return ft.isFunction(e) ? ft.grep(t, function(t, s) {
      return !!e.call(t, s, t) !== i
    }) : e.nodeType ? ft.grep(t, function(t) {
      return t === e !== i
    }) : "string" != typeof e ? ft.grep(t, function(t) {
      return rt.call(e, t) > -1 !== i
    }) : wt.test(e) ? ft.filter(e, t, i) : (e = ft.filter(e, t), ft.grep(t, function(t) {
      return rt.call(e, t) > -1 !== i && 1 === t.nodeType
    }))
  }

  function o(t, e) {
    for (;
      (t = t[e]) && 1 !== t.nodeType;);
    return t
  }

  function r(t) {
    var e = {};
    return ft.each(t.match(St) || [], function(t, i) {
      e[i] = !0
    }), e
  }

  function a(t) {
    return t
  }

  function l(t) {
    throw t
  }

  function h(t, e, i) {
    var s;
    try {
      t && ft.isFunction(s = t.promise) ? s.call(t).done(e).fail(i) : t && ft.isFunction(s = t.then) ? s.call(t, e, i) : e.call(void 0, t)
    } catch (t) {
      i.call(void 0, t)
    }
  }

  function c() {
    et.removeEventListener("DOMContentLoaded", c), t.removeEventListener("load", c), ft.ready()
  }

  function u() {
    this.expando = ft.expando + u.uid++
  }

  function d(t) {
    return "true" === t || "false" !== t && ("null" === t ? null : t === +t + "" ? +t : Et.test(t) ? JSON.parse(t) : t)
  }

  function p(t, e, i) {
    var s;
    if (void 0 === i && 1 === t.nodeType)
      if (s = "data-" + e.replace(Ot, "-$&").toLowerCase(), "string" == typeof(i = t.getAttribute(s))) {
        try {
          i = d(i)
        } catch (t) {}
        Ht.set(t, e, i)
      } else i = void 0;
    return i
  }

  function f(t, e, i, s) {
    var n, o = 1,
      r = 20,
      a = s ? function() {
        return s.cur()
      } : function() {
        return ft.css(t, e, "")
      },
      l = a(),
      h = i && i[3] || (ft.cssNumber[e] ? "" : "px"),
      c = (ft.cssNumber[e] || "px" !== h && +l) && $t.exec(ft.css(t, e));
    if (c && c[3] !== h) {
      h = h || c[3], i = i || [], c = +l || 1;
      do {
        o = o || ".5", c /= o, ft.style(t, e, c + h)
      } while (o !== (o = a() / l) && 1 !== o && --r)
    }
    return i && (c = +c || +l || 0, n = i[1] ? c + (i[1] + 1) * i[2] : +i[2], s && (s.unit = h, s.start = c, s.end = n)), n
  }

  function g(t) {
    var e, i = t.ownerDocument,
      s = t.nodeName,
      n = Ft[s];
    return n || (e = i.body.appendChild(i.createElement(s)), n = ft.css(e, "display"), e.parentNode.removeChild(e), "none" === n && (n = "block"), Ft[s] = n, n)
  }

  function m(t, e) {
    for (var i, s, n = [], o = 0, r = t.length; o < r; o++) s = t[o], s.style && (i = s.style.display, e ? ("none" === i && (n[o] = Mt.get(s, "display") || null, n[o] || (s.style.display = "")), "" === s.style.display && Wt(s) && (n[o] = g(s))) : "none" !== i && (n[o] = "none", Mt.set(s, "display", i)));
    for (o = 0; o < r; o++) null != n[o] && (t[o].style.display = n[o]);
    return t
  }

  function v(t, e) {
    var i;
    return i = void 0 !== t.getElementsByTagName ? t.getElementsByTagName(e || "*") : void 0 !== t.querySelectorAll ? t.querySelectorAll(e || "*") : [], void 0 === e || e && ft.nodeName(t, e) ? ft.merge([t], i) : i
  }

  function b(t, e) {
    for (var i = 0, s = t.length; i < s; i++) Mt.set(t[i], "globalEval", !e || Mt.get(e[i], "globalEval"))
  }

  function _(t, e, i, s, n) {
    for (var o, r, a, l, h, c, u = e.createDocumentFragment(), d = [], p = 0, f = t.length; p < f; p++)
      if ((o = t[p]) || 0 === o)
        if ("object" === ft.type(o)) ft.merge(d, o.nodeType ? [o] : o);
        else if (Yt.test(o)) {
      for (r = r || u.appendChild(e.createElement("div")), a = (qt.exec(o) || ["", ""])[1].toLowerCase(), l = Bt[a] || Bt._default, r.innerHTML = l[1] + ft.htmlPrefilter(o) + l[2], c = l[0]; c--;) r = r.lastChild;
      ft.merge(d, r.childNodes), r = u.firstChild, r.textContent = ""
    } else d.push(e.createTextNode(o));
    for (u.textContent = "", p = 0; o = d[p++];)
      if (s && ft.inArray(o, s) > -1) n && n.push(o);
      else if (h = ft.contains(o.ownerDocument, o), r = v(u.appendChild(o), "script"), h && b(r), i)
      for (c = 0; o = r[c++];) Rt.test(o.type || "") && i.push(o);
    return u
  }

  function y() {
    return !0
  }

  function w() {
    return !1
  }

  function x() {
    try {
      return et.activeElement
    } catch (t) {}
  }

  function k(t, e, i, s, n, o) {
    var r, a;
    if ("object" == typeof e) {
      "string" != typeof i && (s = s || i, i = void 0);
      for (a in e) k(t, a, i, s, e[a], o);
      return t
    }
    if (null == s && null == n ? (n = i, s = i = void 0) : null == n && ("string" == typeof i ? (n = s, s = void 0) : (n = s, s = i, i = void 0)), !1 === n) n = w;
    else if (!n) return t;
    return 1 === o && (r = n, n = function(t) {
      return ft().off(t), r.apply(this, arguments)
    }, n.guid = r.guid || (r.guid = ft.guid++)), t.each(function() {
      ft.event.add(this, e, n, s, i)
    })
  }

  function C(t, e) {
    return ft.nodeName(t, "table") && ft.nodeName(11 !== e.nodeType ? e : e.firstChild, "tr") ? t.getElementsByTagName("tbody")[0] || t : t
  }

  function T(t) {
    return t.type = (null !== t.getAttribute("type")) + "/" + t.type, t
  }

  function S(t) {
    var e = Qt.exec(t.type);
    return e ? t.type = e[1] : t.removeAttribute("type"), t
  }

  function D(t, e) {
    var i, s, n, o, r, a, l, h;
    if (1 === e.nodeType) {
      if (Mt.hasData(t) && (o = Mt.access(t), r = Mt.set(e, o), h = o.events)) {
        delete r.handle, r.events = {};
        for (n in h)
          for (i = 0, s = h[n].length; i < s; i++) ft.event.add(e, n, h[n][i])
      }
      Ht.hasData(t) && (a = Ht.access(t), l = ft.extend({}, a), Ht.set(e, l))
    }
  }

  function P(t, e) {
    var i = e.nodeName.toLowerCase();
    "input" === i && jt.test(t.type) ? e.checked = t.checked : "input" !== i && "textarea" !== i || (e.defaultValue = t.defaultValue)
  }

  function I(t, e, s, n) {
    e = nt.apply([], e);
    var o, r, a, l, h, c, u = 0,
      d = t.length,
      p = d - 1,
      f = e[0],
      g = ft.isFunction(f);
    if (g || d > 1 && "string" == typeof f && !dt.checkClone && Jt.test(f)) return t.each(function(i) {
      var o = t.eq(i);
      g && (e[0] = f.call(this, i, o.html())), I(o, e, s, n)
    });
    if (d && (o = _(e, t[0].ownerDocument, !1, t, n), r = o.firstChild, 1 === o.childNodes.length && (o = r), r || n)) {
      for (a = ft.map(v(o, "script"), T), l = a.length; u < d; u++) h = o, u !== p && (h = ft.clone(h, !0, !0), l && ft.merge(a, v(h, "script"))), s.call(t[u], h, u);
      if (l)
        for (c = a[a.length - 1].ownerDocument, ft.map(a, S), u = 0; u < l; u++) h = a[u], Rt.test(h.type || "") && !Mt.access(h, "globalEval") && ft.contains(c, h) && (h.src ? ft._evalUrl && ft._evalUrl(h.src) : i(h.textContent.replace(Zt, ""), c))
    }
    return t
  }

  function A(t, e, i) {
    for (var s, n = e ? ft.filter(e, t) : t, o = 0; null != (s = n[o]); o++) i || 1 !== s.nodeType || ft.cleanData(v(s)), s.parentNode && (i && ft.contains(s.ownerDocument, s) && b(v(s, "script")), s.parentNode.removeChild(s));
    return t
  }

  function M(t, e, i) {
    var s, n, o, r, a = t.style;
    return i = i || ie(t), i && (r = i.getPropertyValue(e) || i[e], "" !== r || ft.contains(t.ownerDocument, t) || (r = ft.style(t, e)), !dt.pixelMarginRight() && ee.test(r) && te.test(e) && (s = a.width, n = a.minWidth, o = a.maxWidth, a.minWidth = a.maxWidth = a.width = r, r = i.width, a.width = s, a.minWidth = n, a.maxWidth = o)), void 0 !== r ? r + "" : r
  }

  function H(t, e) {
    return {
      get: function() {
        return t() ? void delete this.get : (this.get = e).apply(this, arguments)
      }
    }
  }

  function E(t) {
    if (t in ae) return t;
    for (var e = t[0].toUpperCase() + t.slice(1), i = re.length; i--;)
      if ((t = re[i] + e) in ae) return t
  }

  function O(t, e, i) {
    var s = $t.exec(e);
    return s ? Math.max(0, s[2] - (i || 0)) + (s[3] || "px") : e
  }

  function N(t, e, i, s, n) {
    var o, r = 0;
    for (o = i === (s ? "border" : "content") ? 4 : "width" === e ? 1 : 0; o < 4; o += 2) "margin" === i && (r += ft.css(t, i + zt[o], !0, n)), s ? ("content" === i && (r -= ft.css(t, "padding" + zt[o], !0, n)), "margin" !== i && (r -= ft.css(t, "border" + zt[o] + "Width", !0, n))) : (r += ft.css(t, "padding" + zt[o], !0, n), "padding" !== i && (r += ft.css(t, "border" + zt[o] + "Width", !0, n)));
    return r
  }

  function $(t, e, i) {
    var s, n = !0,
      o = ie(t),
      r = "border-box" === ft.css(t, "boxSizing", !1, o);
    if (t.getClientRects().length && (s = t.getBoundingClientRect()[e]), s <= 0 || null == s) {
      if (s = M(t, e, o), (s < 0 || null == s) && (s = t.style[e]), ee.test(s)) return s;
      n = r && (dt.boxSizingReliable() || s === t.style[e]), s = parseFloat(s) || 0
    }
    return s + N(t, e, i || (r ? "border" : "content"), n, o) + "px"
  }

  function z(t, e, i, s, n) {
    return new z.prototype.init(t, e, i, s, n)
  }

  function W() {
    he && (t.requestAnimationFrame(W), ft.fx.tick())
  }

  function L() {
    return t.setTimeout(function() {
      le = void 0
    }), le = ft.now()
  }

  function F(t, e) {
    var i, s = 0,
      n = {
        height: t
      };
    for (e = e ? 1 : 0; s < 4; s += 2 - e) i = zt[s], n["margin" + i] = n["padding" + i] = t;
    return e && (n.opacity = n.width = t), n
  }

  function j(t, e, i) {
    for (var s, n = (B.tweeners[e] || []).concat(B.tweeners["*"]), o = 0, r = n.length; o < r; o++)
      if (s = n[o].call(i, e, t)) return s
  }

  function q(t, e, i) {
    var s, n, o, r, a, l, h, c, u = "width" in e || "height" in e,
      d = this,
      p = {},
      f = t.style,
      g = t.nodeType && Wt(t),
      v = Mt.get(t, "fxshow");
    i.queue || (r = ft._queueHooks(t, "fx"), null == r.unqueued && (r.unqueued = 0, a = r.empty.fire, r.empty.fire = function() {
      r.unqueued || a()
    }), r.unqueued++, d.always(function() {
      d.always(function() {
        r.unqueued--, ft.queue(t, "fx").length || r.empty.fire()
      })
    }));
    for (s in e)
      if (n = e[s], ce.test(n)) {
        if (delete e[s], o = o || "toggle" === n, n === (g ? "hide" : "show")) {
          if ("show" !== n || !v || void 0 === v[s]) continue;
          g = !0
        }
        p[s] = v && v[s] || ft.style(t, s)
      }
    if ((l = !ft.isEmptyObject(e)) || !ft.isEmptyObject(p)) {
      u && 1 === t.nodeType && (i.overflow = [f.overflow, f.overflowX, f.overflowY], h = v && v.display, null == h && (h = Mt.get(t, "display")), c = ft.css(t, "display"), "none" === c && (h ? c = h : (m([t], !0), h = t.style.display || h, c = ft.css(t, "display"), m([t]))), ("inline" === c || "inline-block" === c && null != h) && "none" === ft.css(t, "float") && (l || (d.done(function() {
        f.display = h
      }), null == h && (c = f.display, h = "none" === c ? "" : c)), f.display = "inline-block")), i.overflow && (f.overflow = "hidden", d.always(function() {
        f.overflow = i.overflow[0], f.overflowX = i.overflow[1], f.overflowY = i.overflow[2]
      })), l = !1;
      for (s in p) l || (v ? "hidden" in v && (g = v.hidden) : v = Mt.access(t, "fxshow", {
        display: h
      }), o && (v.hidden = !g), g && m([t], !0), d.done(function() {
        g || m([t]), Mt.remove(t, "fxshow");
        for (s in p) ft.style(t, s, p[s])
      })), l = j(g ? v[s] : 0, s, d), s in v || (v[s] = l.start, g && (l.end = l.start, l.start = 0))
    }
  }

  function R(t, e) {
    var i, s, n, o, r;
    for (i in t)
      if (s = ft.camelCase(i), n = e[s], o = t[i], ft.isArray(o) && (n = o[1], o = t[i] = o[0]), i !== s && (t[s] = o, delete t[i]), (r = ft.cssHooks[s]) && "expand" in r) {
        o = r.expand(o), delete t[s];
        for (i in o) i in t || (t[i] = o[i], e[i] = n)
      } else e[s] = n
  }

  function B(t, e, i) {
    var s, n, o = 0,
      r = B.prefilters.length,
      a = ft.Deferred().always(function() {
        delete l.elem
      }),
      l = function() {
        if (n) return !1;
        for (var e = le || L(), i = Math.max(0, h.startTime + h.duration - e), s = i / h.duration || 0, o = 1 - s, r = 0, l = h.tweens.length; r < l; r++) h.tweens[r].run(o);
        return a.notifyWith(t, [h, o, i]), o < 1 && l ? i : (a.resolveWith(t, [h]), !1)
      },
      h = a.promise({
        elem: t,
        props: ft.extend({}, e),
        opts: ft.extend(!0, {
          specialEasing: {},
          easing: ft.easing._default
        }, i),
        originalProperties: e,
        originalOptions: i,
        startTime: le || L(),
        duration: i.duration,
        tweens: [],
        createTween: function(e, i) {
          var s = ft.Tween(t, h.opts, e, i, h.opts.specialEasing[e] || h.opts.easing);
          return h.tweens.push(s), s
        },
        stop: function(e) {
          var i = 0,
            s = e ? h.tweens.length : 0;
          if (n) return this;
          for (n = !0; i < s; i++) h.tweens[i].run(1);
          return e ? (a.notifyWith(t, [h, 1, 0]), a.resolveWith(t, [h, e])) : a.rejectWith(t, [h, e]), this
        }
      }),
      c = h.props;
    for (R(c, h.opts.specialEasing); o < r; o++)
      if (s = B.prefilters[o].call(h, t, c, h.opts)) return ft.isFunction(s.stop) && (ft._queueHooks(h.elem, h.opts.queue).stop = ft.proxy(s.stop, s)), s;
    return ft.map(c, j, h), ft.isFunction(h.opts.start) && h.opts.start.call(t, h), ft.fx.timer(ft.extend(l, {
      elem: t,
      anim: h,
      queue: h.opts.queue
    })), h.progress(h.opts.progress).done(h.opts.done, h.opts.complete).fail(h.opts.fail).always(h.opts.always)
  }

  function Y(t) {
    return (t.match(St) || []).join(" ")
  }

  function U(t) {
    return t.getAttribute && t.getAttribute("class") || ""
  }

  function X(t, e, i, s) {
    var n;
    if (ft.isArray(e)) ft.each(e, function(e, n) {
      i || ye.test(t) ? s(t, n) : X(t + "[" + ("object" == typeof n && null != n ? e : "") + "]", n, i, s)
    });
    else if (i || "object" !== ft.type(e)) s(t, e);
    else
      for (n in e) X(t + "[" + n + "]", e[n], i, s)
  }

  function K(t) {
    return function(e, i) {
      "string" != typeof e && (i = e, e = "*");
      var s, n = 0,
        o = e.toLowerCase().match(St) || [];
      if (ft.isFunction(i))
        for (; s = o[n++];) "+" === s[0] ? (s = s.slice(1) || "*", (t[s] = t[s] || []).unshift(i)) : (t[s] = t[s] || []).push(i)
    }
  }

  function V(t, e, i, s) {
    function n(a) {
      var l;
      return o[a] = !0, ft.each(t[a] || [], function(t, a) {
        var h = a(e, i, s);
        return "string" != typeof h || r || o[h] ? r ? !(l = h) : void 0 : (e.dataTypes.unshift(h), n(h), !1)
      }), l
    }
    var o = {},
      r = t === De;
    return n(e.dataTypes[0]) || !o["*"] && n("*")
  }

  function G(t, e) {
    var i, s, n = ft.ajaxSettings.flatOptions || {};
    for (i in e) void 0 !== e[i] && ((n[i] ? t : s || (s = {}))[i] = e[i]);
    return s && ft.extend(!0, t, s), t
  }

  function J(t, e, i) {
    for (var s, n, o, r, a = t.contents, l = t.dataTypes;
      "*" === l[0];) l.shift(), void 0 === s && (s = t.mimeType || e.getResponseHeader("Content-Type"));
    if (s)
      for (n in a)
        if (a[n] && a[n].test(s)) {
          l.unshift(n);
          break
        }
    if (l[0] in i) o = l[0];
    else {
      for (n in i) {
        if (!l[0] || t.converters[n + " " + l[0]]) {
          o = n;
          break
        }
        r || (r = n)
      }
      o = o || r
    }
    if (o) return o !== l[0] && l.unshift(o), i[o]
  }

  function Q(t, e, i, s) {
    var n, o, r, a, l, h = {},
      c = t.dataTypes.slice();
    if (c[1])
      for (r in t.converters) h[r.toLowerCase()] = t.converters[r];
    for (o = c.shift(); o;)
      if (t.responseFields[o] && (i[t.responseFields[o]] = e), !l && s && t.dataFilter && (e = t.dataFilter(e, t.dataType)), l = o, o = c.shift())
        if ("*" === o) o = l;
        else if ("*" !== l && l !== o) {
      if (!(r = h[l + " " + o] || h["* " + o]))
        for (n in h)
          if (a = n.split(" "), a[1] === o && (r = h[l + " " + a[0]] || h["* " + a[0]])) {
            !0 === r ? r = h[n] : !0 !== h[n] && (o = a[0], c.unshift(a[1]));
            break
          }
      if (!0 !== r)
        if (r && t.throws) e = r(e);
        else try {
          e = r(e)
        } catch (t) {
          return {
            state: "parsererror",
            error: r ? t : "No conversion from " + l + " to " + o
          }
        }
    }
    return {
      state: "success",
      data: e
    }
  }

  function Z(t) {
    return ft.isWindow(t) ? t : 9 === t.nodeType && t.defaultView
  }
  var tt = [],
    et = t.document,
    it = Object.getPrototypeOf,
    st = tt.slice,
    nt = tt.concat,
    ot = tt.push,
    rt = tt.indexOf,
    at = {},
    lt = at.toString,
    ht = at.hasOwnProperty,
    ct = ht.toString,
    ut = ct.call(Object),
    dt = {},
    pt = "3.1.1",
    ft = function(t, e) {
      return new ft.fn.init(t, e)
    },
    gt = function(t, e) {
      return e.toUpperCase()
    };
  ft.fn = ft.prototype = {
    jquery: pt,
    constructor: ft,
    length: 0,
    toArray: function() {
      return st.call(this)
    },
    get: function(t) {
      return null == t ? st.call(this) : t < 0 ? this[t + this.length] : this[t]
    },
    pushStack: function(t) {
      var e = ft.merge(this.constructor(), t);
      return e.prevObject = this, e
    },
    each: function(t) {
      return ft.each(this, t)
    },
    map: function(t) {
      return this.pushStack(ft.map(this, function(e, i) {
        return t.call(e, i, e)
      }))
    },
    slice: function() {
      return this.pushStack(st.apply(this, arguments))
    },
    first: function() {
      return this.eq(0)
    },
    last: function() {
      return this.eq(-1)
    },
    eq: function(t) {
      var e = this.length,
        i = +t + (t < 0 ? e : 0);
      return this.pushStack(i >= 0 && i < e ? [this[i]] : [])
    },
    end: function() {
      return this.prevObject || this.constructor()
    },
    push: ot,
    sort: tt.sort,
    splice: tt.splice
  }, ft.extend = ft.fn.extend = function() {
    var t, e, i, s, n, o, r = arguments[0] || {},
      a = 1,
      l = arguments.length,
      h = !1;
    for ("boolean" == typeof r && (h = r, r = arguments[a] || {}, a++), "object" == typeof r || ft.isFunction(r) || (r = {}), a === l && (r = this, a--); a < l; a++)
      if (null != (t = arguments[a]))
        for (e in t) i = r[e], s = t[e], r !== s && (h && s && (ft.isPlainObject(s) || (n = ft.isArray(s))) ? (n ? (n = !1, o = i && ft.isArray(i) ? i : []) : o = i && ft.isPlainObject(i) ? i : {}, r[e] = ft.extend(h, o, s)) : void 0 !== s && (r[e] = s));
    return r
  }, ft.extend({
    expando: "jQuery" + (pt + Math.random()).replace(/\D/g, ""),
    isReady: !0,
    error: function(t) {
      throw new Error(t)
    },
    noop: function() {},
    isFunction: function(t) {
      return "function" === ft.type(t)
    },
    isArray: Array.isArray,
    isWindow: function(t) {
      return null != t && t === t.window
    },
    isNumeric: function(t) {
      var e = ft.type(t);
      return ("number" === e || "string" === e) && !isNaN(t - parseFloat(t))
    },
    isPlainObject: function(t) {
      var e, i;
      return !(!t || "[object Object]" !== lt.call(t) || (e = it(t)) && ("function" != typeof(i = ht.call(e, "constructor") && e.constructor) || ct.call(i) !== ut))
    },
    isEmptyObject: function(t) {
      var e;
      for (e in t) return !1;
      return !0
    },
    type: function(t) {
      return null == t ? t + "" : "object" == typeof t || "function" == typeof t ? at[lt.call(t)] || "object" : typeof t
    },
    globalEval: function(t) {
      i(t)
    },
    camelCase: function(t) {
      return t.replace(/^-ms-/, "ms-").replace(/-([a-z])/g, gt)
    },
    nodeName: function(t, e) {
      return t.nodeName && t.nodeName.toLowerCase() === e.toLowerCase()
    },
    each: function(t, e) {
      var i, n = 0;
      if (s(t))
        for (i = t.length; n < i && !1 !== e.call(t[n], n, t[n]); n++);
      else
        for (n in t)
          if (!1 === e.call(t[n], n, t[n])) break; return t
    },
    trim: function(t) {
      return null == t ? "" : (t + "").replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, "")
    },
    makeArray: function(t, e) {
      var i = e || [];
      return null != t && (s(Object(t)) ? ft.merge(i, "string" == typeof t ? [t] : t) : ot.call(i, t)), i
    },
    inArray: function(t, e, i) {
      return null == e ? -1 : rt.call(e, t, i)
    },
    merge: function(t, e) {
      for (var i = +e.length, s = 0, n = t.length; s < i; s++) t[n++] = e[s];
      return t.length = n, t
    },
    grep: function(t, e, i) {
      for (var s = [], n = 0, o = t.length, r = !i; n < o; n++) !e(t[n], n) !== r && s.push(t[n]);
      return s
    },
    map: function(t, e, i) {
      var n, o, r = 0,
        a = [];
      if (s(t))
        for (n = t.length; r < n; r++) null != (o = e(t[r], r, i)) && a.push(o);
      else
        for (r in t) null != (o = e(t[r], r, i)) && a.push(o);
      return nt.apply([], a)
    },
    guid: 1,
    proxy: function(t, e) {
      var i, s, n;
      if ("string" == typeof e && (i = t[e], e = t, t = i), ft.isFunction(t)) return s = st.call(arguments, 2), n = function() {
        return t.apply(e || this, s.concat(st.call(arguments)))
      }, n.guid = t.guid = t.guid || ft.guid++, n
    },
    now: Date.now,
    support: dt
  }), "function" == typeof Symbol && (ft.fn[Symbol.iterator] = tt[Symbol.iterator]), ft.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "), function(t, e) {
    at["[object " + e + "]"] = e.toLowerCase()
  });
  var mt = function(t) {
    function e(t, e, i, s) {
      var n, o, r, a, l, c, d, p = e && e.ownerDocument,
        f = e ? e.nodeType : 9;
      if (i = i || [], "string" != typeof t || !t || 1 !== f && 9 !== f && 11 !== f) return i;
      if (!s && ((e ? e.ownerDocument || e : L) !== M && A(e), e = e || M, E)) {
        if (11 !== f && (l = gt.exec(t)))
          if (n = l[1]) {
            if (9 === f) {
              if (!(r = e.getElementById(n))) return i;
              if (r.id === n) return i.push(r), i
            } else if (p && (r = p.getElementById(n)) && z(e, r) && r.id === n) return i.push(r), i
          } else {
            if (l[2]) return G.apply(i, e.getElementsByTagName(t)), i;
            if ((n = l[3]) && y.getElementsByClassName && e.getElementsByClassName) return G.apply(i, e.getElementsByClassName(n)), i
          }
        if (y.qsa && !B[t + " "] && (!O || !O.test(t))) {
          if (1 !== f) p = e, d = t;
          else if ("object" !== e.nodeName.toLowerCase()) {
            for ((a = e.getAttribute("id")) ? a = a.replace(_t, yt) : e.setAttribute("id", a = W), c = C(t), o = c.length; o--;) c[o] = "#" + a + " " + u(c[o]);
            d = c.join(","), p = mt.test(t) && h(e.parentNode) || e
          }
          if (d) try {
            return G.apply(i, p.querySelectorAll(d)), i
          } catch (t) {} finally {
            a === W && e.removeAttribute("id")
          }
        }
      }
      return S(t.replace(ot, "$1"), e, i, s)
    }

    function i() {
      function t(i, s) {
        return e.push(i + " ") > w.cacheLength && delete t[e.shift()], t[i + " "] = s
      }
      var e = [];
      return t
    }

    function s(t) {
      return t[W] = !0, t
    }

    function n(t) {
      var e = M.createElement("fieldset");
      try {
        return !!t(e)
      } catch (t) {
        return !1
      } finally {
        e.parentNode && e.parentNode.removeChild(e), e = null
      }
    }

    function o(t, e) {
      for (var i = t.split("|"), s = i.length; s--;) w.attrHandle[i[s]] = e
    }

    function r(t, e) {
      var i = e && t,
        s = i && 1 === t.nodeType && 1 === e.nodeType && t.sourceIndex - e.sourceIndex;
      if (s) return s;
      if (i)
        for (; i = i.nextSibling;)
          if (i === e) return -1;
      return t ? 1 : -1
    }

    function a(t) {
      return function(e) {
        return "form" in e ? e.parentNode && !1 === e.disabled ? "label" in e ? "label" in e.parentNode ? e.parentNode.disabled === t : e.disabled === t : e.isDisabled === t || e.isDisabled !== !t && xt(e) === t : e.disabled === t : "label" in e && e.disabled === t
      }
    }

    function l(t) {
      return s(function(e) {
        return e = +e, s(function(i, s) {
          for (var n, o = t([], i.length, e), r = o.length; r--;) i[n = o[r]] && (i[n] = !(s[n] = i[n]))
        })
      })
    }

    function h(t) {
      return t && void 0 !== t.getElementsByTagName && t
    }

    function c() {}

    function u(t) {
      for (var e = 0, i = t.length, s = ""; e < i; e++) s += t[e].value;
      return s
    }

    function d(t, e, i) {
      var s = e.dir,
        n = e.next,
        o = n || s,
        r = i && "parentNode" === o,
        a = j++;
      return e.first ? function(e, i, n) {
        for (; e = e[s];)
          if (1 === e.nodeType || r) return t(e, i, n);
        return !1
      } : function(e, i, l) {
        var h, c, u, d = [F, a];
        if (l) {
          for (; e = e[s];)
            if ((1 === e.nodeType || r) && t(e, i, l)) return !0
        } else
          for (; e = e[s];)
            if (1 === e.nodeType || r)
              if (u = e[W] || (e[W] = {}), c = u[e.uniqueID] || (u[e.uniqueID] = {}), n && n === e.nodeName.toLowerCase()) e = e[s] || e;
              else {
                if ((h = c[o]) && h[0] === F && h[1] === a) return d[2] = h[2];
                if (c[o] = d, d[2] = t(e, i, l)) return !0
              } return !1
      }
    }

    function p(t) {
      return t.length > 1 ? function(e, i, s) {
        for (var n = t.length; n--;)
          if (!t[n](e, i, s)) return !1;
        return !0
      } : t[0]
    }

    function f(t, i, s) {
      for (var n = 0, o = i.length; n < o; n++) e(t, i[n], s);
      return s
    }

    function g(t, e, i, s, n) {
      for (var o, r = [], a = 0, l = t.length, h = null != e; a < l; a++)(o = t[a]) && (i && !i(o, s, n) || (r.push(o), h && e.push(a)));
      return r
    }

    function m(t, e, i, n, o, r) {
      return n && !n[W] && (n = m(n)), o && !o[W] && (o = m(o, r)), s(function(s, r, a, l) {
        var h, c, u, d = [],
          p = [],
          m = r.length,
          v = s || f(e || "*", a.nodeType ? [a] : a, []),
          b = !t || !s && e ? v : g(v, d, t, a, l),
          _ = i ? o || (s ? t : m || n) ? [] : r : b;
        if (i && i(b, _, a, l), n)
          for (h = g(_, p), n(h, [], a, l), c = h.length; c--;)(u = h[c]) && (_[p[c]] = !(b[p[c]] = u));
        if (s) {
          if (o || t) {
            if (o) {
              for (h = [], c = _.length; c--;)(u = _[c]) && h.push(b[c] = u);
              o(null, _ = [], h, l)
            }
            for (c = _.length; c--;)(u = _[c]) && (h = o ? Q(s, u) : d[c]) > -1 && (s[h] = !(r[h] = u))
          }
        } else _ = g(_ === r ? _.splice(m, _.length) : _), o ? o(null, r, _, l) : G.apply(r, _)
      })
    }

    function v(t) {
      for (var e, i, s, n = t.length, o = w.relative[t[0].type], r = o || w.relative[" "], a = o ? 1 : 0, l = d(function(t) {
          return t === e
        }, r, !0), h = d(function(t) {
          return Q(e, t) > -1
        }, r, !0), c = [function(t, i, s) {
          var n = !o && (s || i !== D) || ((e = i).nodeType ? l(t, i, s) : h(t, i, s));
          return e = null, n
        }]; a < n; a++)
        if (i = w.relative[t[a].type]) c = [d(p(c), i)];
        else {
          if (i = w.filter[t[a].type].apply(null, t[a].matches), i[W]) {
            for (s = ++a; s < n && !w.relative[t[s].type]; s++);
            return m(a > 1 && p(c), a > 1 && u(t.slice(0, a - 1).concat({
              value: " " === t[a - 2].type ? "*" : ""
            })).replace(ot, "$1"), i, a < s && v(t.slice(a, s)), s < n && v(t = t.slice(s)), s < n && u(t))
          }
          c.push(i)
        }
      return p(c)
    }

    function b(t, i) {
      var n = i.length > 0,
        o = t.length > 0,
        r = function(s, r, a, l, h) {
          var c, u, d, p = 0,
            f = "0",
            m = s && [],
            v = [],
            b = D,
            _ = s || o && w.find.TAG("*", h),
            y = F += null == b ? 1 : Math.random() || .1,
            x = _.length;
          for (h && (D = r === M || r || h); f !== x && null != (c = _[f]); f++) {
            if (o && c) {
              for (u = 0, r || c.ownerDocument === M || (A(c), a = !E); d = t[u++];)
                if (d(c, r || M, a)) {
                  l.push(c);
                  break
                }
              h && (F = y)
            }
            n && ((c = !d && c) && p--, s && m.push(c))
          }
          if (p += f, n && f !== p) {
            for (u = 0; d = i[u++];) d(m, v, r, a);
            if (s) {
              if (p > 0)
                for (; f--;) m[f] || v[f] || (v[f] = K.call(l));
              v = g(v)
            }
            G.apply(l, v), h && !s && v.length > 0 && p + i.length > 1 && e.uniqueSort(l)
          }
          return h && (F = y, D = b), m
        };
      return n ? s(r) : r
    }
    var _, y, w, x, k, C, T, S, D, P, I, A, M, H, E, O, N, $, z, W = "sizzle" + 1 * new Date,
      L = t.document,
      F = 0,
      j = 0,
      q = i(),
      R = i(),
      B = i(),
      Y = function(t, e) {
        return t === e && (I = !0), 0
      },
      U = {}.hasOwnProperty,
      X = [],
      K = X.pop,
      V = X.push,
      G = X.push,
      J = X.slice,
      Q = function(t, e) {
        for (var i = 0, s = t.length; i < s; i++)
          if (t[i] === e) return i;
        return -1
      },
      Z = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
      tt = "[\\x20\\t\\r\\n\\f]",
      et = "(?:\\\\.|[\\w-]|[^\0-\\xa0])+",
      it = "\\[" + tt + "*(" + et + ")(?:" + tt + "*([*^$|!~]?=)" + tt + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + et + "))|)" + tt + "*\\]",
      st = ":(" + et + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + it + ")*)|.*)\\)|)",
      nt = new RegExp(tt + "+", "g"),
      ot = new RegExp("^" + tt + "+|((?:^|[^\\\\])(?:\\\\.)*)" + tt + "+$", "g"),
      rt = new RegExp("^" + tt + "*," + tt + "*"),
      at = new RegExp("^" + tt + "*([>+~]|" + tt + ")" + tt + "*"),
      lt = new RegExp("=" + tt + "*([^\\]'\"]*?)" + tt + "*\\]", "g"),
      ht = new RegExp(st),
      ct = new RegExp("^" + et + "$"),
      ut = {
        ID: new RegExp("^#(" + et + ")"),
        CLASS: new RegExp("^\\.(" + et + ")"),
        TAG: new RegExp("^(" + et + "|[*])"),
        ATTR: new RegExp("^" + it),
        PSEUDO: new RegExp("^" + st),
        CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + tt + "*(even|odd|(([+-]|)(\\d*)n|)" + tt + "*(?:([+-]|)" + tt + "*(\\d+)|))" + tt + "*\\)|)", "i"),
        bool: new RegExp("^(?:" + Z + ")$", "i"),
        needsContext: new RegExp("^" + tt + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + tt + "*((?:-\\d)?\\d*)" + tt + "*\\)|)(?=[^-]|$)", "i")
      },
      dt = /^(?:input|select|textarea|button)$/i,
      pt = /^h\d$/i,
      ft = /^[^{]+\{\s*\[native \w/,
      gt = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
      mt = /[+~]/,
      vt = new RegExp("\\\\([\\da-f]{1,6}" + tt + "?|(" + tt + ")|.)", "ig"),
      bt = function(t, e, i) {
        var s = "0x" + e - 65536;
        return s !== s || i ? e : s < 0 ? String.fromCharCode(s + 65536) : String.fromCharCode(s >> 10 | 55296, 1023 & s | 56320)
      },
      _t = /([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g,
      yt = function(t, e) {
        return e ? "\0" === t ? "�" : t.slice(0, -1) + "\\" + t.charCodeAt(t.length - 1).toString(16) + " " : "\\" + t
      },
      wt = function() {
        A()
      },
      xt = d(function(t) {
        return !0 === t.disabled && ("form" in t || "label" in t)
      }, {
        dir: "parentNode",
        next: "legend"
      });
    try {
      G.apply(X = J.call(L.childNodes), L.childNodes), X[L.childNodes.length].nodeType
    } catch (t) {
      G = {
        apply: X.length ? function(t, e) {
          V.apply(t, J.call(e))
        } : function(t, e) {
          for (var i = t.length, s = 0; t[i++] = e[s++];);
          t.length = i - 1
        }
      }
    }
    y = e.support = {}, k = e.isXML = function(t) {
      var e = t && (t.ownerDocument || t).documentElement;
      return !!e && "HTML" !== e.nodeName
    }, A = e.setDocument = function(t) {
      var e, i, s = t ? t.ownerDocument || t : L;
      return s !== M && 9 === s.nodeType && s.documentElement ? (M = s, H = M.documentElement, E = !k(M), L !== M && (i = M.defaultView) && i.top !== i && (i.addEventListener ? i.addEventListener("unload", wt, !1) : i.attachEvent && i.attachEvent("onunload", wt)), y.attributes = n(function(t) {
        return t.className = "i", !t.getAttribute("className")
      }), y.getElementsByTagName = n(function(t) {
        return t.appendChild(M.createComment("")), !t.getElementsByTagName("*").length
      }), y.getElementsByClassName = ft.test(M.getElementsByClassName), y.getById = n(function(t) {
        return H.appendChild(t).id = W, !M.getElementsByName || !M.getElementsByName(W).length
      }), y.getById ? (w.filter.ID = function(t) {
        var e = t.replace(vt, bt);
        return function(t) {
          return t.getAttribute("id") === e
        }
      }, w.find.ID = function(t, e) {
        if (void 0 !== e.getElementById && E) {
          var i = e.getElementById(t);
          return i ? [i] : []
        }
      }) : (w.filter.ID = function(t) {
        var e = t.replace(vt, bt);
        return function(t) {
          var i = void 0 !== t.getAttributeNode && t.getAttributeNode("id");
          return i && i.value === e
        }
      }, w.find.ID = function(t, e) {
        if (void 0 !== e.getElementById && E) {
          var i, s, n, o = e.getElementById(t);
          if (o) {
            if ((i = o.getAttributeNode("id")) && i.value === t) return [o];
            for (n = e.getElementsByName(t), s = 0; o = n[s++];)
              if ((i = o.getAttributeNode("id")) && i.value === t) return [o]
          }
          return []
        }
      }), w.find.TAG = y.getElementsByTagName ? function(t, e) {
        return void 0 !== e.getElementsByTagName ? e.getElementsByTagName(t) : y.qsa ? e.querySelectorAll(t) : void 0
      } : function(t, e) {
        var i, s = [],
          n = 0,
          o = e.getElementsByTagName(t);
        if ("*" === t) {
          for (; i = o[n++];) 1 === i.nodeType && s.push(i);
          return s
        }
        return o
      }, w.find.CLASS = y.getElementsByClassName && function(t, e) {
        if (void 0 !== e.getElementsByClassName && E) return e.getElementsByClassName(t)
      }, N = [], O = [], (y.qsa = ft.test(M.querySelectorAll)) && (n(function(t) {
        H.appendChild(t).innerHTML = "<a id='" + W + "'></a><select id='" + W + "-\r\\' msallowcapture=''><option selected=''></option></select>", t.querySelectorAll("[msallowcapture^='']").length && O.push("[*^$]=" + tt + "*(?:''|\"\")"), t.querySelectorAll("[selected]").length || O.push("\\[" + tt + "*(?:value|" + Z + ")"), t.querySelectorAll("[id~=" + W + "-]").length || O.push("~="), t.querySelectorAll(":checked").length || O.push(":checked"), t.querySelectorAll("a#" + W + "+*").length || O.push(".#.+[+~]")
      }), n(function(t) {
        t.innerHTML = "<a href='' disabled='disabled'></a><select disabled='disabled'><option/></select>";
        var e = M.createElement("input");
        e.setAttribute("type", "hidden"), t.appendChild(e).setAttribute("name", "D"), t.querySelectorAll("[name=d]").length && O.push("name" + tt + "*[*^$|!~]?="), 2 !== t.querySelectorAll(":enabled").length && O.push(":enabled", ":disabled"), H.appendChild(t).disabled = !0, 2 !== t.querySelectorAll(":disabled").length && O.push(":enabled", ":disabled"), t.querySelectorAll("*,:x"), O.push(",.*:")
      })), (y.matchesSelector = ft.test($ = H.matches || H.webkitMatchesSelector || H.mozMatchesSelector || H.oMatchesSelector || H.msMatchesSelector)) && n(function(t) {
        y.disconnectedMatch = $.call(t, "*"), $.call(t, "[s!='']:x"), N.push("!=", st)
      }), O = O.length && new RegExp(O.join("|")), N = N.length && new RegExp(N.join("|")), e = ft.test(H.compareDocumentPosition), z = e || ft.test(H.contains) ? function(t, e) {
        var i = 9 === t.nodeType ? t.documentElement : t,
          s = e && e.parentNode;
        return t === s || !(!s || 1 !== s.nodeType || !(i.contains ? i.contains(s) : t.compareDocumentPosition && 16 & t.compareDocumentPosition(s)))
      } : function(t, e) {
        if (e)
          for (; e = e.parentNode;)
            if (e === t) return !0;
        return !1
      }, Y = e ? function(t, e) {
        if (t === e) return I = !0, 0;
        var i = !t.compareDocumentPosition - !e.compareDocumentPosition;
        return i || (i = (t.ownerDocument || t) === (e.ownerDocument || e) ? t.compareDocumentPosition(e) : 1, 1 & i || !y.sortDetached && e.compareDocumentPosition(t) === i ? t === M || t.ownerDocument === L && z(L, t) ? -1 : e === M || e.ownerDocument === L && z(L, e) ? 1 : P ? Q(P, t) - Q(P, e) : 0 : 4 & i ? -1 : 1)
      } : function(t, e) {
        if (t === e) return I = !0, 0;
        var i, s = 0,
          n = t.parentNode,
          o = e.parentNode,
          a = [t],
          l = [e];
        if (!n || !o) return t === M ? -1 : e === M ? 1 : n ? -1 : o ? 1 : P ? Q(P, t) - Q(P, e) : 0;
        if (n === o) return r(t, e);
        for (i = t; i = i.parentNode;) a.unshift(i);
        for (i = e; i = i.parentNode;) l.unshift(i);
        for (; a[s] === l[s];) s++;
        return s ? r(a[s], l[s]) : a[s] === L ? -1 : l[s] === L ? 1 : 0
      }, M) : M
    }, e.matches = function(t, i) {
      return e(t, null, null, i)
    }, e.matchesSelector = function(t, i) {
      if ((t.ownerDocument || t) !== M && A(t), i = i.replace(lt, "='$1']"), y.matchesSelector && E && !B[i + " "] && (!N || !N.test(i)) && (!O || !O.test(i))) try {
        var s = $.call(t, i);
        if (s || y.disconnectedMatch || t.document && 11 !== t.document.nodeType) return s
      } catch (t) {}
      return e(i, M, null, [t]).length > 0
    }, e.contains = function(t, e) {
      return (t.ownerDocument || t) !== M && A(t), z(t, e)
    }, e.attr = function(t, e) {
      (t.ownerDocument || t) !== M && A(t);
      var i = w.attrHandle[e.toLowerCase()],
        s = i && U.call(w.attrHandle, e.toLowerCase()) ? i(t, e, !E) : void 0;
      return void 0 !== s ? s : y.attributes || !E ? t.getAttribute(e) : (s = t.getAttributeNode(e)) && s.specified ? s.value : null
    }, e.escape = function(t) {
      return (t + "").replace(_t, yt)
    }, e.error = function(t) {
      throw new Error("Syntax error, unrecognized expression: " + t)
    }, e.uniqueSort = function(t) {
      var e, i = [],
        s = 0,
        n = 0;
      if (I = !y.detectDuplicates, P = !y.sortStable && t.slice(0), t.sort(Y), I) {
        for (; e = t[n++];) e === t[n] && (s = i.push(n));
        for (; s--;) t.splice(i[s], 1)
      }
      return P = null, t
    }, x = e.getText = function(t) {
      var e, i = "",
        s = 0,
        n = t.nodeType;
      if (n) {
        if (1 === n || 9 === n || 11 === n) {
          if ("string" == typeof t.textContent) return t.textContent;
          for (t = t.firstChild; t; t = t.nextSibling) i += x(t)
        } else if (3 === n || 4 === n) return t.nodeValue
      } else
        for (; e = t[s++];) i += x(e);
      return i
    }, w = e.selectors = {
      cacheLength: 50,
      createPseudo: s,
      match: ut,
      attrHandle: {},
      find: {},
      relative: {
        ">": {
          dir: "parentNode",
          first: !0
        },
        " ": {
          dir: "parentNode"
        },
        "+": {
          dir: "previousSibling",
          first: !0
        },
        "~": {
          dir: "previousSibling"
        }
      },
      preFilter: {
        ATTR: function(t) {
          return t[1] = t[1].replace(vt, bt), t[3] = (t[3] || t[4] || t[5] || "").replace(vt, bt), "~=" === t[2] && (t[3] = " " + t[3] + " "), t.slice(0, 4)
        },
        CHILD: function(t) {
          return t[1] = t[1].toLowerCase(), "nth" === t[1].slice(0, 3) ? (t[3] || e.error(t[0]), t[4] = +(t[4] ? t[5] + (t[6] || 1) : 2 * ("even" === t[3] || "odd" === t[3])), t[5] = +(t[7] + t[8] || "odd" === t[3])) : t[3] && e.error(t[0]), t
        },
        PSEUDO: function(t) {
          var e, i = !t[6] && t[2];
          return ut.CHILD.test(t[0]) ? null : (t[3] ? t[2] = t[4] || t[5] || "" : i && ht.test(i) && (e = C(i, !0)) && (e = i.indexOf(")", i.length - e) - i.length) && (t[0] = t[0].slice(0, e), t[2] = i.slice(0, e)), t.slice(0, 3))
        }
      },
      filter: {
        TAG: function(t) {
          var e = t.replace(vt, bt).toLowerCase();
          return "*" === t ? function() {
            return !0
          } : function(t) {
            return t.nodeName && t.nodeName.toLowerCase() === e
          }
        },
        CLASS: function(t) {
          var e = q[t + " "];
          return e || (e = new RegExp("(^|" + tt + ")" + t + "(" + tt + "|$)")) && q(t, function(t) {
            return e.test("string" == typeof t.className && t.className || void 0 !== t.getAttribute && t.getAttribute("class") || "")
          })
        },
        ATTR: function(t, i, s) {
          return function(n) {
            var o = e.attr(n, t);
            return null == o ? "!=" === i : !i || (o += "", "=" === i ? o === s : "!=" === i ? o !== s : "^=" === i ? s && 0 === o.indexOf(s) : "*=" === i ? s && o.indexOf(s) > -1 : "$=" === i ? s && o.slice(-s.length) === s : "~=" === i ? (" " + o.replace(nt, " ") + " ").indexOf(s) > -1 : "|=" === i && (o === s || o.slice(0, s.length + 1) === s + "-"))
          }
        },
        CHILD: function(t, e, i, s, n) {
          var o = "nth" !== t.slice(0, 3),
            r = "last" !== t.slice(-4),
            a = "of-type" === e;
          return 1 === s && 0 === n ? function(t) {
            return !!t.parentNode
          } : function(e, i, l) {
            var h, c, u, d, p, f, g = o !== r ? "nextSibling" : "previousSibling",
              m = e.parentNode,
              v = a && e.nodeName.toLowerCase(),
              b = !l && !a,
              _ = !1;
            if (m) {
              if (o) {
                for (; g;) {
                  for (d = e; d = d[g];)
                    if (a ? d.nodeName.toLowerCase() === v : 1 === d.nodeType) return !1;
                  f = g = "only" === t && !f && "nextSibling"
                }
                return !0
              }
              if (f = [r ? m.firstChild : m.lastChild], r && b) {
                for (d = m, u = d[W] || (d[W] = {}), c = u[d.uniqueID] || (u[d.uniqueID] = {}), h = c[t] || [], p = h[0] === F && h[1], _ = p && h[2], d = p && m.childNodes[p]; d = ++p && d && d[g] || (_ = p = 0) || f.pop();)
                  if (1 === d.nodeType && ++_ && d === e) {
                    c[t] = [F, p, _];
                    break
                  }
              } else if (b && (d = e, u = d[W] || (d[W] = {}), c = u[d.uniqueID] || (u[d.uniqueID] = {}), h = c[t] || [], p = h[0] === F && h[1], _ = p), !1 === _)
                for (;
                  (d = ++p && d && d[g] || (_ = p = 0) || f.pop()) && ((a ? d.nodeName.toLowerCase() !== v : 1 !== d.nodeType) || !++_ || (b && (u = d[W] || (d[W] = {}), c = u[d.uniqueID] || (u[d.uniqueID] = {}), c[t] = [F, _]), d !== e)););
              return (_ -= n) === s || _ % s == 0 && _ / s >= 0
            }
          }
        },
        PSEUDO: function(t, i) {
          var n, o = w.pseudos[t] || w.setFilters[t.toLowerCase()] || e.error("unsupported pseudo: " + t);
          return o[W] ? o(i) : o.length > 1 ? (n = [t, t, "", i], w.setFilters.hasOwnProperty(t.toLowerCase()) ? s(function(t, e) {
            for (var s, n = o(t, i), r = n.length; r--;) s = Q(t, n[r]), t[s] = !(e[s] = n[r])
          }) : function(t) {
            return o(t, 0, n)
          }) : o
        }
      },
      pseudos: {
        not: s(function(t) {
          var e = [],
            i = [],
            n = T(t.replace(ot, "$1"));
          return n[W] ? s(function(t, e, i, s) {
            for (var o, r = n(t, null, s, []), a = t.length; a--;)(o = r[a]) && (t[a] = !(e[a] = o))
          }) : function(t, s, o) {
            return e[0] = t, n(e, null, o, i), e[0] = null, !i.pop()
          }
        }),
        has: s(function(t) {
          return function(i) {
            return e(t, i).length > 0
          }
        }),
        contains: s(function(t) {
          return t = t.replace(vt, bt),
            function(e) {
              return (e.textContent || e.innerText || x(e)).indexOf(t) > -1
            }
        }),
        lang: s(function(t) {
          return ct.test(t || "") || e.error("unsupported lang: " + t), t = t.replace(vt, bt).toLowerCase(),
            function(e) {
              var i;
              do {
                if (i = E ? e.lang : e.getAttribute("xml:lang") || e.getAttribute("lang")) return (i = i.toLowerCase()) === t || 0 === i.indexOf(t + "-")
              } while ((e = e.parentNode) && 1 === e.nodeType);
              return !1
            }
        }),
        target: function(e) {
          var i = t.location && t.location.hash;
          return i && i.slice(1) === e.id
        },
        root: function(t) {
          return t === H
        },
        focus: function(t) {
          return t === M.activeElement && (!M.hasFocus || M.hasFocus()) && !!(t.type || t.href || ~t.tabIndex)
        },
        enabled: a(!1),
        disabled: a(!0),
        checked: function(t) {
          var e = t.nodeName.toLowerCase();
          return "input" === e && !!t.checked || "option" === e && !!t.selected
        },
        selected: function(t) {
          return t.parentNode && t.parentNode.selectedIndex, !0 === t.selected
        },
        empty: function(t) {
          for (t = t.firstChild; t; t = t.nextSibling)
            if (t.nodeType < 6) return !1;
          return !0
        },
        parent: function(t) {
          return !w.pseudos.empty(t)
        },
        header: function(t) {
          return pt.test(t.nodeName)
        },
        input: function(t) {
          return dt.test(t.nodeName)
        },
        button: function(t) {
          var e = t.nodeName.toLowerCase();
          return "input" === e && "button" === t.type || "button" === e
        },
        text: function(t) {
          var e;
          return "input" === t.nodeName.toLowerCase() && "text" === t.type && (null == (e = t.getAttribute("type")) || "text" === e.toLowerCase())
        },
        first: l(function() {
          return [0]
        }),
        last: l(function(t, e) {
          return [e - 1]
        }),
        eq: l(function(t, e, i) {
          return [i < 0 ? i + e : i]
        }),
        even: l(function(t, e) {
          for (var i = 0; i < e; i += 2) t.push(i);
          return t
        }),
        odd: l(function(t, e) {
          for (var i = 1; i < e; i += 2) t.push(i);
          return t
        }),
        lt: l(function(t, e, i) {
          for (var s = i < 0 ? i + e : i; --s >= 0;) t.push(s);
          return t
        }),
        gt: l(function(t, e, i) {
          for (var s = i < 0 ? i + e : i; ++s < e;) t.push(s);
          return t
        })
      }
    }, w.pseudos.nth = w.pseudos.eq;
    for (_ in {
        radio: !0,
        checkbox: !0,
        file: !0,
        password: !0,
        image: !0
      }) w.pseudos[_] = function(t) {
      return function(e) {
        return "input" === e.nodeName.toLowerCase() && e.type === t
      }
    }(_);
    for (_ in {
        submit: !0,
        reset: !0
      }) w.pseudos[_] = function(t) {
      return function(e) {
        var i = e.nodeName.toLowerCase();
        return ("input" === i || "button" === i) && e.type === t
      }
    }(_);
    return c.prototype = w.filters = w.pseudos, w.setFilters = new c, C = e.tokenize = function(t, i) {
      var s, n, o, r, a, l, h, c = R[t + " "];
      if (c) return i ? 0 : c.slice(0);
      for (a = t, l = [], h = w.preFilter; a;) {
        s && !(n = rt.exec(a)) || (n && (a = a.slice(n[0].length) || a), l.push(o = [])), s = !1, (n = at.exec(a)) && (s = n.shift(), o.push({
          value: s,
          type: n[0].replace(ot, " ")
        }), a = a.slice(s.length));
        for (r in w.filter) !(n = ut[r].exec(a)) || h[r] && !(n = h[r](n)) || (s = n.shift(), o.push({
          value: s,
          type: r,
          matches: n
        }), a = a.slice(s.length));
        if (!s) break
      }
      return i ? a.length : a ? e.error(t) : R(t, l).slice(0)
    }, T = e.compile = function(t, e) {
      var i, s = [],
        n = [],
        o = B[t + " "];
      if (!o) {
        for (e || (e = C(t)), i = e.length; i--;) o = v(e[i]), o[W] ? s.push(o) : n.push(o);
        o = B(t, b(n, s)), o.selector = t
      }
      return o
    }, S = e.select = function(t, e, i, s) {
      var n, o, r, a, l, c = "function" == typeof t && t,
        d = !s && C(t = c.selector || t);
      if (i = i || [], 1 === d.length) {
        if (o = d[0] = d[0].slice(0), o.length > 2 && "ID" === (r = o[0]).type && 9 === e.nodeType && E && w.relative[o[1].type]) {
          if (!(e = (w.find.ID(r.matches[0].replace(vt, bt), e) || [])[0])) return i;
          c && (e = e.parentNode), t = t.slice(o.shift().value.length)
        }
        for (n = ut.needsContext.test(t) ? 0 : o.length; n-- && (r = o[n], !w.relative[a = r.type]);)
          if ((l = w.find[a]) && (s = l(r.matches[0].replace(vt, bt), mt.test(o[0].type) && h(e.parentNode) || e))) {
            if (o.splice(n, 1), !(t = s.length && u(o))) return G.apply(i, s), i;
            break
          }
      }
      return (c || T(t, d))(s, e, !E, i, !e || mt.test(t) && h(e.parentNode) || e), i
    }, y.sortStable = W.split("").sort(Y).join("") === W, y.detectDuplicates = !!I, A(), y.sortDetached = n(function(t) {
      return 1 & t.compareDocumentPosition(M.createElement("fieldset"))
    }), n(function(t) {
      return t.innerHTML = "<a href='#'></a>", "#" === t.firstChild.getAttribute("href")
    }) || o("type|href|height|width", function(t, e, i) {
      if (!i) return t.getAttribute(e, "type" === e.toLowerCase() ? 1 : 2)
    }), y.attributes && n(function(t) {
      return t.innerHTML = "<input/>", t.firstChild.setAttribute("value", ""), "" === t.firstChild.getAttribute("value")
    }) || o("value", function(t, e, i) {
      if (!i && "input" === t.nodeName.toLowerCase()) return t.defaultValue
    }), n(function(t) {
      return null == t.getAttribute("disabled")
    }) || o(Z, function(t, e, i) {
      var s;
      if (!i) return !0 === t[e] ? e.toLowerCase() : (s = t.getAttributeNode(e)) && s.specified ? s.value : null
    }), e
  }(t);
  ft.find = mt, ft.expr = mt.selectors, ft.expr[":"] = ft.expr.pseudos, ft.uniqueSort = ft.unique = mt.uniqueSort, ft.text = mt.getText, ft.isXMLDoc = mt.isXML, ft.contains = mt.contains, ft.escapeSelector = mt.escape;
  var vt = function(t, e, i) {
      for (var s = [], n = void 0 !== i;
        (t = t[e]) && 9 !== t.nodeType;)
        if (1 === t.nodeType) {
          if (n && ft(t).is(i)) break;
          s.push(t)
        }
      return s
    },
    bt = function(t, e) {
      for (var i = []; t; t = t.nextSibling) 1 === t.nodeType && t !== e && i.push(t);
      return i
    },
    _t = ft.expr.match.needsContext,
    yt = /^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i,
    wt = /^.[^:#\[\.,]*$/;
  ft.filter = function(t, e, i) {
    var s = e[0];
    return i && (t = ":not(" + t + ")"), 1 === e.length && 1 === s.nodeType ? ft.find.matchesSelector(s, t) ? [s] : [] : ft.find.matches(t, ft.grep(e, function(t) {
      return 1 === t.nodeType
    }))
  }, ft.fn.extend({
    find: function(t) {
      var e, i, s = this.length,
        n = this;
      if ("string" != typeof t) return this.pushStack(ft(t).filter(function() {
        for (e = 0; e < s; e++)
          if (ft.contains(n[e], this)) return !0
      }));
      for (i = this.pushStack([]), e = 0; e < s; e++) ft.find(t, n[e], i);
      return s > 1 ? ft.uniqueSort(i) : i
    },
    filter: function(t) {
      return this.pushStack(n(this, t || [], !1))
    },
    not: function(t) {
      return this.pushStack(n(this, t || [], !0))
    },
    is: function(t) {
      return !!n(this, "string" == typeof t && _t.test(t) ? ft(t) : t || [], !1).length
    }
  });
  var xt, kt = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/;
  (ft.fn.init = function(t, e, i) {
    var s, n;
    if (!t) return this;
    if (i = i || xt, "string" == typeof t) {
      if (!(s = "<" === t[0] && ">" === t[t.length - 1] && t.length >= 3 ? [null, t, null] : kt.exec(t)) || !s[1] && e) return !e || e.jquery ? (e || i).find(t) : this.constructor(e).find(t);
      if (s[1]) {
        if (e = e instanceof ft ? e[0] : e, ft.merge(this, ft.parseHTML(s[1], e && e.nodeType ? e.ownerDocument || e : et, !0)), yt.test(s[1]) && ft.isPlainObject(e))
          for (s in e) ft.isFunction(this[s]) ? this[s](e[s]) : this.attr(s, e[s]);
        return this
      }
      return n = et.getElementById(s[2]), n && (this[0] = n, this.length = 1), this
    }
    return t.nodeType ? (this[0] = t, this.length = 1, this) : ft.isFunction(t) ? void 0 !== i.ready ? i.ready(t) : t(ft) : ft.makeArray(t, this)
  }).prototype = ft.fn, xt = ft(et);
  var Ct = /^(?:parents|prev(?:Until|All))/,
    Tt = {
      children: !0,
      contents: !0,
      next: !0,
      prev: !0
    };
  ft.fn.extend({
    has: function(t) {
      var e = ft(t, this),
        i = e.length;
      return this.filter(function() {
        for (var t = 0; t < i; t++)
          if (ft.contains(this, e[t])) return !0
      })
    },
    closest: function(t, e) {
      var i, s = 0,
        n = this.length,
        o = [],
        r = "string" != typeof t && ft(t);
      if (!_t.test(t))
        for (; s < n; s++)
          for (i = this[s]; i && i !== e; i = i.parentNode)
            if (i.nodeType < 11 && (r ? r.index(i) > -1 : 1 === i.nodeType && ft.find.matchesSelector(i, t))) {
              o.push(i);
              break
            }
      return this.pushStack(o.length > 1 ? ft.uniqueSort(o) : o)
    },
    index: function(t) {
      return t ? "string" == typeof t ? rt.call(ft(t), this[0]) : rt.call(this, t.jquery ? t[0] : t) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
    },
    add: function(t, e) {
      return this.pushStack(ft.uniqueSort(ft.merge(this.get(), ft(t, e))))
    },
    addBack: function(t) {
      return this.add(null == t ? this.prevObject : this.prevObject.filter(t))
    }
  }), ft.each({
    parent: function(t) {
      var e = t.parentNode;
      return e && 11 !== e.nodeType ? e : null
    },
    parents: function(t) {
      return vt(t, "parentNode")
    },
    parentsUntil: function(t, e, i) {
      return vt(t, "parentNode", i)
    },
    next: function(t) {
      return o(t, "nextSibling")
    },
    prev: function(t) {
      return o(t, "previousSibling")
    },
    nextAll: function(t) {
      return vt(t, "nextSibling")
    },
    prevAll: function(t) {
      return vt(t, "previousSibling")
    },
    nextUntil: function(t, e, i) {
      return vt(t, "nextSibling", i)
    },
    prevUntil: function(t, e, i) {
      return vt(t, "previousSibling", i)
    },
    siblings: function(t) {
      return bt((t.parentNode || {}).firstChild, t)
    },
    children: function(t) {
      return bt(t.firstChild)
    },
    contents: function(t) {
      return t.contentDocument || ft.merge([], t.childNodes)
    }
  }, function(t, e) {
    ft.fn[t] = function(i, s) {
      var n = ft.map(this, e, i);
      return "Until" !== t.slice(-5) && (s = i), s && "string" == typeof s && (n = ft.filter(s, n)), this.length > 1 && (Tt[t] || ft.uniqueSort(n), Ct.test(t) && n.reverse()), this.pushStack(n)
    }
  });
  var St = /[^\x20\t\r\n\f]+/g;
  ft.Callbacks = function(t) {
    t = "string" == typeof t ? r(t) : ft.extend({}, t);
    var e, i, s, n, o = [],
      a = [],
      l = -1,
      h = function() {
        for (n = t.once, s = e = !0; a.length; l = -1)
          for (i = a.shift(); ++l < o.length;) !1 === o[l].apply(i[0], i[1]) && t.stopOnFalse && (l = o.length, i = !1);
        t.memory || (i = !1), e = !1, n && (o = i ? [] : "")
      },
      c = {
        add: function() {
          return o && (i && !e && (l = o.length - 1, a.push(i)), function e(i) {
            ft.each(i, function(i, s) {
              ft.isFunction(s) ? t.unique && c.has(s) || o.push(s) : s && s.length && "string" !== ft.type(s) && e(s)
            })
          }(arguments), i && !e && h()), this
        },
        remove: function() {
          return ft.each(arguments, function(t, e) {
            for (var i;
              (i = ft.inArray(e, o, i)) > -1;) o.splice(i, 1), i <= l && l--
          }), this
        },
        has: function(t) {
          return t ? ft.inArray(t, o) > -1 : o.length > 0
        },
        empty: function() {
          return o && (o = []), this
        },
        disable: function() {
          return n = a = [], o = i = "", this
        },
        disabled: function() {
          return !o
        },
        lock: function() {
          return n = a = [], i || e || (o = i = ""), this
        },
        locked: function() {
          return !!n
        },
        fireWith: function(t, i) {
          return n || (i = i || [], i = [t, i.slice ? i.slice() : i], a.push(i), e || h()), this
        },
        fire: function() {
          return c.fireWith(this, arguments), this
        },
        fired: function() {
          return !!s
        }
      };
    return c
  }, ft.extend({
    Deferred: function(e) {
      var i = [
          ["notify", "progress", ft.Callbacks("memory"), ft.Callbacks("memory"), 2],
          ["resolve", "done", ft.Callbacks("once memory"), ft.Callbacks("once memory"), 0, "resolved"],
          ["reject", "fail", ft.Callbacks("once memory"), ft.Callbacks("once memory"), 1, "rejected"]
        ],
        s = "pending",
        n = {
          state: function() {
            return s
          },
          always: function() {
            return o.done(arguments).fail(arguments), this
          },
          catch: function(t) {
            return n.then(null, t)
          },
          pipe: function() {
            var t = arguments;
            return ft.Deferred(function(e) {
              ft.each(i, function(i, s) {
                var n = ft.isFunction(t[s[4]]) && t[s[4]];
                o[s[1]](function() {
                  var t = n && n.apply(this, arguments);
                  t && ft.isFunction(t.promise) ? t.promise().progress(e.notify).done(e.resolve).fail(e.reject) : e[s[0] + "With"](this, n ? [t] : arguments)
                })
              }), t = null
            }).promise()
          },
          then: function(e, s, n) {
            function o(e, i, s, n) {
              return function() {
                var h = this,
                  c = arguments,
                  u = function() {
                    var t, u;
                    if (!(e < r)) {
                      if ((t = s.apply(h, c)) === i.promise()) throw new TypeError("Thenable self-resolution");
                      u = t && ("object" == typeof t || "function" == typeof t) && t.then, ft.isFunction(u) ? n ? u.call(t, o(r, i, a, n), o(r, i, l, n)) : (r++, u.call(t, o(r, i, a, n), o(r, i, l, n), o(r, i, a, i.notifyWith))) : (s !== a && (h = void 0, c = [t]), (n || i.resolveWith)(h, c))
                    }
                  },
                  d = n ? u : function() {
                    try {
                      u()
                    } catch (t) {
                      ft.Deferred.exceptionHook && ft.Deferred.exceptionHook(t, d.stackTrace), e + 1 >= r && (s !== l && (h = void 0, c = [t]), i.rejectWith(h, c))
                    }
                  };
                e ? d() : (ft.Deferred.getStackHook && (d.stackTrace = ft.Deferred.getStackHook()), t.setTimeout(d))
              }
            }
            var r = 0;
            return ft.Deferred(function(t) {
              i[0][3].add(o(0, t, ft.isFunction(n) ? n : a, t.notifyWith)), i[1][3].add(o(0, t, ft.isFunction(e) ? e : a)), i[2][3].add(o(0, t, ft.isFunction(s) ? s : l))
            }).promise()
          },
          promise: function(t) {
            return null != t ? ft.extend(t, n) : n
          }
        },
        o = {};
      return ft.each(i, function(t, e) {
        var r = e[2],
          a = e[5];
        n[e[1]] = r.add, a && r.add(function() {
          s = a
        }, i[3 - t][2].disable, i[0][2].lock), r.add(e[3].fire), o[e[0]] = function() {
          return o[e[0] + "With"](this === o ? void 0 : this, arguments), this
        }, o[e[0] + "With"] = r.fireWith
      }), n.promise(o), e && e.call(o, o), o
    },
    when: function(t) {
      var e = arguments.length,
        i = e,
        s = Array(i),
        n = st.call(arguments),
        o = ft.Deferred(),
        r = function(t) {
          return function(i) {
            s[t] = this, n[t] = arguments.length > 1 ? st.call(arguments) : i, --e || o.resolveWith(s, n)
          }
        };
      if (e <= 1 && (h(t, o.done(r(i)).resolve, o.reject), "pending" === o.state() || ft.isFunction(n[i] && n[i].then))) return o.then();
      for (; i--;) h(n[i], r(i), o.reject);
      return o.promise()
    }
  });
  var Dt = /^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;
  ft.Deferred.exceptionHook = function(e, i) {
    t.console && t.console.warn && e && Dt.test(e.name) && t.console.warn("jQuery.Deferred exception: " + e.message, e.stack, i)
  }, ft.readyException = function(e) {
    t.setTimeout(function() {
      throw e
    })
  };
  var Pt = ft.Deferred();
  ft.fn.ready = function(t) {
    return Pt.then(t).catch(function(t) {
      ft.readyException(t)
    }), this
  }, ft.extend({
    isReady: !1,
    readyWait: 1,
    holdReady: function(t) {
      t ? ft.readyWait++ : ft.ready(!0)
    },
    ready: function(t) {
      (!0 === t ? --ft.readyWait : ft.isReady) || (ft.isReady = !0, !0 !== t && --ft.readyWait > 0 || Pt.resolveWith(et, [ft]))
    }
  }), ft.ready.then = Pt.then, "complete" === et.readyState || "loading" !== et.readyState && !et.documentElement.doScroll ? t.setTimeout(ft.ready) : (et.addEventListener("DOMContentLoaded", c), t.addEventListener("load", c));
  var It = function(t, e, i, s, n, o, r) {
      var a = 0,
        l = t.length,
        h = null == i;
      if ("object" === ft.type(i)) {
        n = !0;
        for (a in i) It(t, e, a, i[a], !0, o, r)
      } else if (void 0 !== s && (n = !0, ft.isFunction(s) || (r = !0), h && (r ? (e.call(t, s), e = null) : (h = e, e = function(t, e, i) {
          return h.call(ft(t), i)
        })), e))
        for (; a < l; a++) e(t[a], i, r ? s : s.call(t[a], a, e(t[a], i)));
      return n ? t : h ? e.call(t) : l ? e(t[0], i) : o
    },
    At = function(t) {
      return 1 === t.nodeType || 9 === t.nodeType || !+t.nodeType
    };
  u.uid = 1, u.prototype = {
    cache: function(t) {
      var e = t[this.expando];
      return e || (e = {}, At(t) && (t.nodeType ? t[this.expando] = e : Object.defineProperty(t, this.expando, {
        value: e,
        configurable: !0
      }))), e
    },
    set: function(t, e, i) {
      var s, n = this.cache(t);
      if ("string" == typeof e) n[ft.camelCase(e)] = i;
      else
        for (s in e) n[ft.camelCase(s)] = e[s];
      return n
    },
    get: function(t, e) {
      return void 0 === e ? this.cache(t) : t[this.expando] && t[this.expando][ft.camelCase(e)]
    },
    access: function(t, e, i) {
      return void 0 === e || e && "string" == typeof e && void 0 === i ? this.get(t, e) : (this.set(t, e, i), void 0 !== i ? i : e)
    },
    remove: function(t, e) {
      var i, s = t[this.expando];
      if (void 0 !== s) {
        if (void 0 !== e) {
          ft.isArray(e) ? e = e.map(ft.camelCase) : (e = ft.camelCase(e), e = e in s ? [e] : e.match(St) || []), i = e.length;
          for (; i--;) delete s[e[i]]
        }(void 0 === e || ft.isEmptyObject(s)) && (t.nodeType ? t[this.expando] = void 0 : delete t[this.expando])
      }
    },
    hasData: function(t) {
      var e = t[this.expando];
      return void 0 !== e && !ft.isEmptyObject(e)
    }
  };
  var Mt = new u,
    Ht = new u,
    Et = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
    Ot = /[A-Z]/g;
  ft.extend({
    hasData: function(t) {
      return Ht.hasData(t) || Mt.hasData(t)
    },
    data: function(t, e, i) {
      return Ht.access(t, e, i)
    },
    removeData: function(t, e) {
      Ht.remove(t, e)
    },
    _data: function(t, e, i) {
      return Mt.access(t, e, i)
    },
    _removeData: function(t, e) {
      Mt.remove(t, e)
    }
  }), ft.fn.extend({
    data: function(t, e) {
      var i, s, n, o = this[0],
        r = o && o.attributes;
      if (void 0 === t) {
        if (this.length && (n = Ht.get(o), 1 === o.nodeType && !Mt.get(o, "hasDataAttrs"))) {
          for (i = r.length; i--;) r[i] && (s = r[i].name, 0 === s.indexOf("data-") && (s = ft.camelCase(s.slice(5)), p(o, s, n[s])));
          Mt.set(o, "hasDataAttrs", !0)
        }
        return n
      }
      return "object" == typeof t ? this.each(function() {
        Ht.set(this, t)
      }) : It(this, function(e) {
        var i;
        if (o && void 0 === e) {
          if (void 0 !== (i = Ht.get(o, t))) return i;
          if (void 0 !== (i = p(o, t))) return i
        } else this.each(function() {
          Ht.set(this, t, e)
        })
      }, null, e, arguments.length > 1, null, !0)
    },
    removeData: function(t) {
      return this.each(function() {
        Ht.remove(this, t)
      })
    }
  }), ft.extend({
    queue: function(t, e, i) {
      var s;
      if (t) return e = (e || "fx") + "queue", s = Mt.get(t, e), i && (!s || ft.isArray(i) ? s = Mt.access(t, e, ft.makeArray(i)) : s.push(i)), s || []
    },
    dequeue: function(t, e) {
      e = e || "fx";
      var i = ft.queue(t, e),
        s = i.length,
        n = i.shift(),
        o = ft._queueHooks(t, e),
        r = function() {
          ft.dequeue(t, e)
        };
      "inprogress" === n && (n = i.shift(), s--), n && ("fx" === e && i.unshift("inprogress"), delete o.stop, n.call(t, r, o)), !s && o && o.empty.fire()
    },
    _queueHooks: function(t, e) {
      var i = e + "queueHooks";
      return Mt.get(t, i) || Mt.access(t, i, {
        empty: ft.Callbacks("once memory").add(function() {
          Mt.remove(t, [e + "queue", i])
        })
      })
    }
  }), ft.fn.extend({
    queue: function(t, e) {
      var i = 2;
      return "string" != typeof t && (e = t, t = "fx", i--), arguments.length < i ? ft.queue(this[0], t) : void 0 === e ? this : this.each(function() {
        var i = ft.queue(this, t, e);
        ft._queueHooks(this, t), "fx" === t && "inprogress" !== i[0] && ft.dequeue(this, t)
      })
    },
    dequeue: function(t) {
      return this.each(function() {
        ft.dequeue(this, t)
      })
    },
    clearQueue: function(t) {
      return this.queue(t || "fx", [])
    },
    promise: function(t, e) {
      var i, s = 1,
        n = ft.Deferred(),
        o = this,
        r = this.length,
        a = function() {
          --s || n.resolveWith(o, [o])
        };
      for ("string" != typeof t && (e = t, t = void 0), t = t || "fx"; r--;)(i = Mt.get(o[r], t + "queueHooks")) && i.empty && (s++, i.empty.add(a));
      return a(), n.promise(e)
    }
  });
  var Nt = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
    $t = new RegExp("^(?:([+-])=|)(" + Nt + ")([a-z%]*)$", "i"),
    zt = ["Top", "Right", "Bottom", "Left"],
    Wt = function(t, e) {
      return t = e || t, "none" === t.style.display || "" === t.style.display && ft.contains(t.ownerDocument, t) && "none" === ft.css(t, "display")
    },
    Lt = function(t, e, i, s) {
      var n, o, r = {};
      for (o in e) r[o] = t.style[o], t.style[o] = e[o];
      n = i.apply(t, s || []);
      for (o in e) t.style[o] = r[o];
      return n
    },
    Ft = {};
  ft.fn.extend({
    show: function() {
      return m(this, !0)
    },
    hide: function() {
      return m(this)
    },
    toggle: function(t) {
      return "boolean" == typeof t ? t ? this.show() : this.hide() : this.each(function() {
        Wt(this) ? ft(this).show() : ft(this).hide()
      })
    }
  });
  var jt = /^(?:checkbox|radio)$/i,
    qt = /<([a-z][^\/\0>\x20\t\r\n\f]+)/i,
    Rt = /^$|\/(?:java|ecma)script/i,
    Bt = {
      option: [1, "<select multiple='multiple'>", "</select>"],
      thead: [1, "<table>", "</table>"],
      col: [2, "<table><colgroup>", "</colgroup></table>"],
      tr: [2, "<table><tbody>", "</tbody></table>"],
      td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
      _default: [0, "", ""]
    };
  Bt.optgroup = Bt.option, Bt.tbody = Bt.tfoot = Bt.colgroup = Bt.caption = Bt.thead, Bt.th = Bt.td;
  var Yt = /<|&#?\w+;/;
  ! function() {
    var t = et.createDocumentFragment(),
      e = t.appendChild(et.createElement("div")),
      i = et.createElement("input");
    i.setAttribute("type", "radio"), i.setAttribute("checked", "checked"), i.setAttribute("name", "t"), e.appendChild(i), dt.checkClone = e.cloneNode(!0).cloneNode(!0).lastChild.checked, e.innerHTML = "<textarea>x</textarea>", dt.noCloneChecked = !!e.cloneNode(!0).lastChild.defaultValue
  }();
  var Ut = et.documentElement,
    Xt = /^key/,
    Kt = /^(?:mouse|pointer|contextmenu|drag|drop)|click/,
    Vt = /^([^.]*)(?:\.(.+)|)/;
  ft.event = {
    global: {},
    add: function(t, e, i, s, n) {
      var o, r, a, l, h, c, u, d, p, f, g, m = Mt.get(t);
      if (m)
        for (i.handler && (o = i, i = o.handler, n = o.selector), n && ft.find.matchesSelector(Ut, n), i.guid || (i.guid = ft.guid++), (l = m.events) || (l = m.events = {}), (r = m.handle) || (r = m.handle = function(e) {
            return void 0 !== ft && ft.event.triggered !== e.type ? ft.event.dispatch.apply(t, arguments) : void 0
          }), e = (e || "").match(St) || [""], h = e.length; h--;) a = Vt.exec(e[h]) || [], p = g = a[1], f = (a[2] || "").split(".").sort(), p && (u = ft.event.special[p] || {}, p = (n ? u.delegateType : u.bindType) || p, u = ft.event.special[p] || {}, c = ft.extend({
          type: p,
          origType: g,
          data: s,
          handler: i,
          guid: i.guid,
          selector: n,
          needsContext: n && ft.expr.match.needsContext.test(n),
          namespace: f.join(".")
        }, o), (d = l[p]) || (d = l[p] = [], d.delegateCount = 0, u.setup && !1 !== u.setup.call(t, s, f, r) || t.addEventListener && t.addEventListener(p, r)), u.add && (u.add.call(t, c), c.handler.guid || (c.handler.guid = i.guid)), n ? d.splice(d.delegateCount++, 0, c) : d.push(c), ft.event.global[p] = !0)
    },
    remove: function(t, e, i, s, n) {
      var o, r, a, l, h, c, u, d, p, f, g, m = Mt.hasData(t) && Mt.get(t);
      if (m && (l = m.events)) {
        for (e = (e || "").match(St) || [""], h = e.length; h--;)
          if (a = Vt.exec(e[h]) || [], p = g = a[1], f = (a[2] || "").split(".").sort(), p) {
            for (u = ft.event.special[p] || {}, p = (s ? u.delegateType : u.bindType) || p, d = l[p] || [], a = a[2] && new RegExp("(^|\\.)" + f.join("\\.(?:.*\\.|)") + "(\\.|$)"), r = o = d.length; o--;) c = d[o], !n && g !== c.origType || i && i.guid !== c.guid || a && !a.test(c.namespace) || s && s !== c.selector && ("**" !== s || !c.selector) || (d.splice(o, 1), c.selector && d.delegateCount--, u.remove && u.remove.call(t, c));
            r && !d.length && (u.teardown && !1 !== u.teardown.call(t, f, m.handle) || ft.removeEvent(t, p, m.handle), delete l[p])
          } else
            for (p in l) ft.event.remove(t, p + e[h], i, s, !0);
        ft.isEmptyObject(l) && Mt.remove(t, "handle events")
      }
    },
    dispatch: function(t) {
      var e, i, s, n, o, r, a = ft.event.fix(t),
        l = new Array(arguments.length),
        h = (Mt.get(this, "events") || {})[a.type] || [],
        c = ft.event.special[a.type] || {};
      for (l[0] = a, e = 1; e < arguments.length; e++) l[e] = arguments[e];
      if (a.delegateTarget = this, !c.preDispatch || !1 !== c.preDispatch.call(this, a)) {
        for (r = ft.event.handlers.call(this, a, h), e = 0;
          (n = r[e++]) && !a.isPropagationStopped();)
          for (a.currentTarget = n.elem, i = 0;
            (o = n.handlers[i++]) && !a.isImmediatePropagationStopped();) a.rnamespace && !a.rnamespace.test(o.namespace) || (a.handleObj = o, a.data = o.data, void 0 !== (s = ((ft.event.special[o.origType] || {}).handle || o.handler).apply(n.elem, l)) && !1 === (a.result = s) && (a.preventDefault(), a.stopPropagation()));
        return c.postDispatch && c.postDispatch.call(this, a), a.result
      }
    },
    handlers: function(t, e) {
      var i, s, n, o, r, a = [],
        l = e.delegateCount,
        h = t.target;
      if (l && h.nodeType && !("click" === t.type && t.button >= 1))
        for (; h !== this; h = h.parentNode || this)
          if (1 === h.nodeType && ("click" !== t.type || !0 !== h.disabled)) {
            for (o = [], r = {}, i = 0; i < l; i++) s = e[i], n = s.selector + " ", void 0 === r[n] && (r[n] = s.needsContext ? ft(n, this).index(h) > -1 : ft.find(n, this, null, [h]).length), r[n] && o.push(s);
            o.length && a.push({
              elem: h,
              handlers: o
            })
          }
      return h = this, l < e.length && a.push({
        elem: h,
        handlers: e.slice(l)
      }), a
    },
    addProp: function(t, e) {
      Object.defineProperty(ft.Event.prototype, t, {
        enumerable: !0,
        configurable: !0,
        get: ft.isFunction(e) ? function() {
          if (this.originalEvent) return e(this.originalEvent)
        } : function() {
          if (this.originalEvent) return this.originalEvent[t]
        },
        set: function(e) {
          Object.defineProperty(this, t, {
            enumerable: !0,
            configurable: !0,
            writable: !0,
            value: e
          })
        }
      })
    },
    fix: function(t) {
      return t[ft.expando] ? t : new ft.Event(t)
    },
    special: {
      load: {
        noBubble: !0
      },
      focus: {
        trigger: function() {
          if (this !== x() && this.focus) return this.focus(), !1
        },
        delegateType: "focusin"
      },
      blur: {
        trigger: function() {
          if (this === x() && this.blur) return this.blur(), !1
        },
        delegateType: "focusout"
      },
      click: {
        trigger: function() {
          if ("checkbox" === this.type && this.click && ft.nodeName(this, "input")) return this.click(), !1
        },
        _default: function(t) {
          return ft.nodeName(t.target, "a")
        }
      },
      beforeunload: {
        postDispatch: function(t) {
          void 0 !== t.result && t.originalEvent && (t.originalEvent.returnValue = t.result)
        }
      }
    }
  }, ft.removeEvent = function(t, e, i) {
    t.removeEventListener && t.removeEventListener(e, i)
  }, ft.Event = function(t, e) {
    return this instanceof ft.Event ? (t && t.type ? (this.originalEvent = t, this.type = t.type, this.isDefaultPrevented = t.defaultPrevented || void 0 === t.defaultPrevented && !1 === t.returnValue ? y : w, this.target = t.target && 3 === t.target.nodeType ? t.target.parentNode : t.target, this.currentTarget = t.currentTarget, this.relatedTarget = t.relatedTarget) : this.type = t, e && ft.extend(this, e), this.timeStamp = t && t.timeStamp || ft.now(), void(this[ft.expando] = !0)) : new ft.Event(t, e)
  }, ft.Event.prototype = {
    constructor: ft.Event,
    isDefaultPrevented: w,
    isPropagationStopped: w,
    isImmediatePropagationStopped: w,
    isSimulated: !1,
    preventDefault: function() {
      var t = this.originalEvent;
      this.isDefaultPrevented = y, t && !this.isSimulated && t.preventDefault()
    },
    stopPropagation: function() {
      var t = this.originalEvent;
      this.isPropagationStopped = y, t && !this.isSimulated && t.stopPropagation()
    },
    stopImmediatePropagation: function() {
      var t = this.originalEvent;
      this.isImmediatePropagationStopped = y, t && !this.isSimulated && t.stopImmediatePropagation(), this.stopPropagation()
    }
  }, ft.each({
    altKey: !0,
    bubbles: !0,
    cancelable: !0,
    changedTouches: !0,
    ctrlKey: !0,
    detail: !0,
    eventPhase: !0,
    metaKey: !0,
    pageX: !0,
    pageY: !0,
    shiftKey: !0,
    view: !0,
    char: !0,
    charCode: !0,
    key: !0,
    keyCode: !0,
    button: !0,
    buttons: !0,
    clientX: !0,
    clientY: !0,
    offsetX: !0,
    offsetY: !0,
    pointerId: !0,
    pointerType: !0,
    screenX: !0,
    screenY: !0,
    targetTouches: !0,
    toElement: !0,
    touches: !0,
    which: function(t) {
      var e = t.button;
      return null == t.which && Xt.test(t.type) ? null != t.charCode ? t.charCode : t.keyCode : !t.which && void 0 !== e && Kt.test(t.type) ? 1 & e ? 1 : 2 & e ? 3 : 4 & e ? 2 : 0 : t.which
    }
  }, ft.event.addProp), ft.each({
    mouseenter: "mouseover",
    mouseleave: "mouseout",
    pointerenter: "pointerover",
    pointerleave: "pointerout"
  }, function(t, e) {
    ft.event.special[t] = {
      delegateType: e,
      bindType: e,
      handle: function(t) {
        var i, s = this,
          n = t.relatedTarget,
          o = t.handleObj;
        return n && (n === s || ft.contains(s, n)) || (t.type = o.origType, i = o.handler.apply(this, arguments), t.type = e), i
      }
    }
  }), ft.fn.extend({
    on: function(t, e, i, s) {
      return k(this, t, e, i, s)
    },
    one: function(t, e, i, s) {
      return k(this, t, e, i, s, 1)
    },
    off: function(t, e, i) {
      var s, n;
      if (t && t.preventDefault && t.handleObj) return s = t.handleObj, ft(t.delegateTarget).off(s.namespace ? s.origType + "." + s.namespace : s.origType, s.selector, s.handler), this;
      if ("object" == typeof t) {
        for (n in t) this.off(n, e, t[n]);
        return this
      }
      return !1 !== e && "function" != typeof e || (i = e, e = void 0), !1 === i && (i = w), this.each(function() {
        ft.event.remove(this, t, i, e)
      })
    }
  });
  var Gt = /<script|<style|<link/i,
    Jt = /checked\s*(?:[^=]|=\s*.checked.)/i,
    Qt = /^true\/(.*)/,
    Zt = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;
  ft.extend({
    htmlPrefilter: function(t) {
      return t.replace(/<(?!area|br|col|embed|hr|img|input|link|meta|param)(([a-z][^\/\0>\x20\t\r\n\f]*)[^>]*)\/>/gi, "<$1></$2>")
    },
    clone: function(t, e, i) {
      var s, n, o, r, a = t.cloneNode(!0),
        l = ft.contains(t.ownerDocument, t);
      if (!(dt.noCloneChecked || 1 !== t.nodeType && 11 !== t.nodeType || ft.isXMLDoc(t)))
        for (r = v(a), o = v(t), s = 0, n = o.length; s < n; s++) P(o[s], r[s]);
      if (e)
        if (i)
          for (o = o || v(t), r = r || v(a), s = 0, n = o.length; s < n; s++) D(o[s], r[s]);
        else D(t, a);
      return r = v(a, "script"), r.length > 0 && b(r, !l && v(t, "script")), a
    },
    cleanData: function(t) {
      for (var e, i, s, n = ft.event.special, o = 0; void 0 !== (i = t[o]); o++)
        if (At(i)) {
          if (e = i[Mt.expando]) {
            if (e.events)
              for (s in e.events) n[s] ? ft.event.remove(i, s) : ft.removeEvent(i, s, e.handle);
            i[Mt.expando] = void 0
          }
          i[Ht.expando] && (i[Ht.expando] = void 0)
        }
    }
  }), ft.fn.extend({
    detach: function(t) {
      return A(this, t, !0)
    },
    remove: function(t) {
      return A(this, t)
    },
    text: function(t) {
      return It(this, function(t) {
        return void 0 === t ? ft.text(this) : this.empty().each(function() {
          1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || (this.textContent = t)
        })
      }, null, t, arguments.length)
    },
    append: function() {
      return I(this, arguments, function(t) {
        if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
          C(this, t).appendChild(t)
        }
      })
    },
    prepend: function() {
      return I(this, arguments, function(t) {
        if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
          var e = C(this, t);
          e.insertBefore(t, e.firstChild)
        }
      })
    },
    before: function() {
      return I(this, arguments, function(t) {
        this.parentNode && this.parentNode.insertBefore(t, this)
      })
    },
    after: function() {
      return I(this, arguments, function(t) {
        this.parentNode && this.parentNode.insertBefore(t, this.nextSibling)
      })
    },
    empty: function() {
      for (var t, e = 0; null != (t = this[e]); e++) 1 === t.nodeType && (ft.cleanData(v(t, !1)), t.textContent = "");
      return this
    },
    clone: function(t, e) {
      return t = null != t && t, e = null == e ? t : e, this.map(function() {
        return ft.clone(this, t, e)
      })
    },
    html: function(t) {
      return It(this, function(t) {
        var e = this[0] || {},
          i = 0,
          s = this.length;
        if (void 0 === t && 1 === e.nodeType) return e.innerHTML;
        if ("string" == typeof t && !Gt.test(t) && !Bt[(qt.exec(t) || ["", ""])[1].toLowerCase()]) {
          t = ft.htmlPrefilter(t);
          try {
            for (; i < s; i++) e = this[i] || {}, 1 === e.nodeType && (ft.cleanData(v(e, !1)), e.innerHTML = t);
            e = 0
          } catch (t) {}
        }
        e && this.empty().append(t)
      }, null, t, arguments.length)
    },
    replaceWith: function() {
      var t = [];
      return I(this, arguments, function(e) {
        var i = this.parentNode;
        ft.inArray(this, t) < 0 && (ft.cleanData(v(this)), i && i.replaceChild(e, this))
      }, t)
    }
  }), ft.each({
    appendTo: "append",
    prependTo: "prepend",
    insertBefore: "before",
    insertAfter: "after",
    replaceAll: "replaceWith"
  }, function(t, e) {
    ft.fn[t] = function(t) {
      for (var i, s = [], n = ft(t), o = n.length - 1, r = 0; r <= o; r++) i = r === o ? this : this.clone(!0), ft(n[r])[e](i), ot.apply(s, i.get());
      return this.pushStack(s)
    }
  });
  var te = /^margin/,
    ee = new RegExp("^(" + Nt + ")(?!px)[a-z%]+$", "i"),
    ie = function(e) {
      var i = e.ownerDocument.defaultView;
      return i && i.opener || (i = t), i.getComputedStyle(e)
    };
  ! function() {
    function e() {
      if (a) {
        a.style.cssText = "box-sizing:border-box;position:relative;display:block;margin:auto;border:1px;padding:1px;top:1%;width:50%", a.innerHTML = "", Ut.appendChild(r);
        var e = t.getComputedStyle(a);
        i = "1%" !== e.top, o = "2px" === e.marginLeft, s = "4px" === e.width, a.style.marginRight = "50%", n = "4px" === e.marginRight, Ut.removeChild(r), a = null
      }
    }
    var i, s, n, o, r = et.createElement("div"),
      a = et.createElement("div");
    a.style && (a.style.backgroundClip = "content-box", a.cloneNode(!0).style.backgroundClip = "", dt.clearCloneStyle = "content-box" === a.style.backgroundClip, r.style.cssText = "border:0;width:8px;height:0;top:0;left:-9999px;padding:0;margin-top:1px;position:absolute", r.appendChild(a), ft.extend(dt, {
      pixelPosition: function() {
        return e(), i
      },
      boxSizingReliable: function() {
        return e(), s
      },
      pixelMarginRight: function() {
        return e(), n
      },
      reliableMarginLeft: function() {
        return e(), o
      }
    }))
  }();
  var se = /^(none|table(?!-c[ea]).+)/,
    ne = {
      position: "absolute",
      visibility: "hidden",
      display: "block"
    },
    oe = {
      letterSpacing: "0",
      fontWeight: "400"
    },
    re = ["Webkit", "Moz", "ms"],
    ae = et.createElement("div").style;
  ft.extend({
    cssHooks: {
      opacity: {
        get: function(t, e) {
          if (e) {
            var i = M(t, "opacity");
            return "" === i ? "1" : i
          }
        }
      }
    },
    cssNumber: {
      animationIterationCount: !0,
      columnCount: !0,
      fillOpacity: !0,
      flexGrow: !0,
      flexShrink: !0,
      fontWeight: !0,
      lineHeight: !0,
      opacity: !0,
      order: !0,
      orphans: !0,
      widows: !0,
      zIndex: !0,
      zoom: !0
    },
    cssProps: {
      float: "cssFloat"
    },
    style: function(t, e, i, s) {
      if (t && 3 !== t.nodeType && 8 !== t.nodeType && t.style) {
        var n, o, r, a = ft.camelCase(e),
          l = t.style;
        return e = ft.cssProps[a] || (ft.cssProps[a] = E(a) || a), r = ft.cssHooks[e] || ft.cssHooks[a], void 0 === i ? r && "get" in r && void 0 !== (n = r.get(t, !1, s)) ? n : l[e] : (o = typeof i, "string" === o && (n = $t.exec(i)) && n[1] && (i = f(t, e, n), o = "number"), void(null != i && i === i && ("number" === o && (i += n && n[3] || (ft.cssNumber[a] ? "" : "px")), dt.clearCloneStyle || "" !== i || 0 !== e.indexOf("background") || (l[e] = "inherit"), r && "set" in r && void 0 === (i = r.set(t, i, s)) || (l[e] = i))))
      }
    },
    css: function(t, e, i, s) {
      var n, o, r, a = ft.camelCase(e);
      return e = ft.cssProps[a] || (ft.cssProps[a] = E(a) || a), r = ft.cssHooks[e] || ft.cssHooks[a], r && "get" in r && (n = r.get(t, !0, i)), void 0 === n && (n = M(t, e, s)), "normal" === n && e in oe && (n = oe[e]), "" === i || i ? (o = parseFloat(n), !0 === i || isFinite(o) ? o || 0 : n) : n
    }
  }), ft.each(["height", "width"], function(t, e) {
    ft.cssHooks[e] = {
      get: function(t, i, s) {
        if (i) return !se.test(ft.css(t, "display")) || t.getClientRects().length && t.getBoundingClientRect().width ? $(t, e, s) : Lt(t, ne, function() {
          return $(t, e, s)
        })
      },
      set: function(t, i, s) {
        var n, o = s && ie(t),
          r = s && N(t, e, s, "border-box" === ft.css(t, "boxSizing", !1, o), o);
        return r && (n = $t.exec(i)) && "px" !== (n[3] || "px") && (t.style[e] = i, i = ft.css(t, e)), O(t, i, r)
      }
    }
  }), ft.cssHooks.marginLeft = H(dt.reliableMarginLeft, function(t, e) {
    if (e) return (parseFloat(M(t, "marginLeft")) || t.getBoundingClientRect().left - Lt(t, {
      marginLeft: 0
    }, function() {
      return t.getBoundingClientRect().left
    })) + "px"
  }), ft.each({
    margin: "",
    padding: "",
    border: "Width"
  }, function(t, e) {
    ft.cssHooks[t + e] = {
      expand: function(i) {
        for (var s = 0, n = {}, o = "string" == typeof i ? i.split(" ") : [i]; s < 4; s++) n[t + zt[s] + e] = o[s] || o[s - 2] || o[0];
        return n
      }
    }, te.test(t) || (ft.cssHooks[t + e].set = O)
  }), ft.fn.extend({
    css: function(t, e) {
      return It(this, function(t, e, i) {
        var s, n, o = {},
          r = 0;
        if (ft.isArray(e)) {
          for (s = ie(t), n = e.length; r < n; r++) o[e[r]] = ft.css(t, e[r], !1, s);
          return o
        }
        return void 0 !== i ? ft.style(t, e, i) : ft.css(t, e)
      }, t, e, arguments.length > 1)
    }
  }), ft.Tween = z, z.prototype = {
    constructor: z,
    init: function(t, e, i, s, n, o) {
      this.elem = t, this.prop = i, this.easing = n || ft.easing._default, this.options = e, this.start = this.now = this.cur(), this.end = s, this.unit = o || (ft.cssNumber[i] ? "" : "px")
    },
    cur: function() {
      var t = z.propHooks[this.prop];
      return t && t.get ? t.get(this) : z.propHooks._default.get(this)
    },
    run: function(t) {
      var e, i = z.propHooks[this.prop];
      return this.options.duration ? this.pos = e = ft.easing[this.easing](t, this.options.duration * t, 0, 1, this.options.duration) : this.pos = e = t, this.now = (this.end - this.start) * e + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), i && i.set ? i.set(this) : z.propHooks._default.set(this), this
    }
  }, z.prototype.init.prototype = z.prototype, z.propHooks = {
    _default: {
      get: function(t) {
        var e;
        return 1 !== t.elem.nodeType || null != t.elem[t.prop] && null == t.elem.style[t.prop] ? t.elem[t.prop] : (e = ft.css(t.elem, t.prop, ""), e && "auto" !== e ? e : 0)
      },
      set: function(t) {
        ft.fx.step[t.prop] ? ft.fx.step[t.prop](t) : 1 !== t.elem.nodeType || null == t.elem.style[ft.cssProps[t.prop]] && !ft.cssHooks[t.prop] ? t.elem[t.prop] = t.now : ft.style(t.elem, t.prop, t.now + t.unit)
      }
    }
  }, z.propHooks.scrollTop = z.propHooks.scrollLeft = {
    set: function(t) {
      t.elem.nodeType && t.elem.parentNode && (t.elem[t.prop] = t.now)
    }
  }, ft.easing = {
    linear: function(t) {
      return t
    },
    swing: function(t) {
      return .5 - Math.cos(t * Math.PI) / 2
    },
    _default: "swing"
  }, ft.fx = z.prototype.init, ft.fx.step = {};
  var le, he, ce = /^(?:toggle|show|hide)$/,
    ue = /queueHooks$/;
  ft.Animation = ft.extend(B, {
      tweeners: {
        "*": [function(t, e) {
          var i = this.createTween(t, e);
          return f(i.elem, t, $t.exec(e), i), i
        }]
      },
      tweener: function(t, e) {
        ft.isFunction(t) ? (e = t, t = ["*"]) : t = t.match(St);
        for (var i, s = 0, n = t.length; s < n; s++) i = t[s], B.tweeners[i] = B.tweeners[i] || [], B.tweeners[i].unshift(e)
      },
      prefilters: [q],
      prefilter: function(t, e) {
        e ? B.prefilters.unshift(t) : B.prefilters.push(t)
      }
    }), ft.speed = function(t, e, i) {
      var s = t && "object" == typeof t ? ft.extend({}, t) : {
        complete: i || !i && e || ft.isFunction(t) && t,
        duration: t,
        easing: i && e || e && !ft.isFunction(e) && e
      };
      return ft.fx.off || et.hidden ? s.duration = 0 : "number" != typeof s.duration && (s.duration in ft.fx.speeds ? s.duration = ft.fx.speeds[s.duration] : s.duration = ft.fx.speeds._default), null != s.queue && !0 !== s.queue || (s.queue = "fx"), s.old = s.complete, s.complete = function() {
        ft.isFunction(s.old) && s.old.call(this), s.queue && ft.dequeue(this, s.queue)
      }, s
    }, ft.fn.extend({
      fadeTo: function(t, e, i, s) {
        return this.filter(Wt).css("opacity", 0).show().end().animate({
          opacity: e
        }, t, i, s)
      },
      animate: function(t, e, i, s) {
        var n = ft.isEmptyObject(t),
          o = ft.speed(e, i, s),
          r = function() {
            var e = B(this, ft.extend({}, t), o);
            (n || Mt.get(this, "finish")) && e.stop(!0)
          };
        return r.finish = r, n || !1 === o.queue ? this.each(r) : this.queue(o.queue, r)
      },
      stop: function(t, e, i) {
        var s = function(t) {
          var e = t.stop;
          delete t.stop, e(i)
        };
        return "string" != typeof t && (i = e, e = t, t = void 0), e && !1 !== t && this.queue(t || "fx", []), this.each(function() {
          var e = !0,
            n = null != t && t + "queueHooks",
            o = ft.timers,
            r = Mt.get(this);
          if (n) r[n] && r[n].stop && s(r[n]);
          else
            for (n in r) r[n] && r[n].stop && ue.test(n) && s(r[n]);
          for (n = o.length; n--;) o[n].elem !== this || null != t && o[n].queue !== t || (o[n].anim.stop(i), e = !1, o.splice(n, 1));
          !e && i || ft.dequeue(this, t)
        })
      },
      finish: function(t) {
        return !1 !== t && (t = t || "fx"), this.each(function() {
          var e, i = Mt.get(this),
            s = i[t + "queue"],
            n = i[t + "queueHooks"],
            o = ft.timers,
            r = s ? s.length : 0;
          for (i.finish = !0, ft.queue(this, t, []), n && n.stop && n.stop.call(this, !0), e = o.length; e--;) o[e].elem === this && o[e].queue === t && (o[e].anim.stop(!0), o.splice(e, 1));
          for (e = 0; e < r; e++) s[e] && s[e].finish && s[e].finish.call(this);
          delete i.finish
        })
      }
    }), ft.each(["toggle", "show", "hide"], function(t, e) {
      var i = ft.fn[e];
      ft.fn[e] = function(t, s, n) {
        return null == t || "boolean" == typeof t ? i.apply(this, arguments) : this.animate(F(e, !0), t, s, n)
      }
    }), ft.each({
      slideDown: F("show"),
      slideUp: F("hide"),
      slideToggle: F("toggle"),
      fadeIn: {
        opacity: "show"
      },
      fadeOut: {
        opacity: "hide"
      },
      fadeToggle: {
        opacity: "toggle"
      }
    }, function(t, e) {
      ft.fn[t] = function(t, i, s) {
        return this.animate(e, t, i, s)
      }
    }), ft.timers = [], ft.fx.tick = function() {
      var t, e = 0,
        i = ft.timers;
      for (le = ft.now(); e < i.length; e++)(t = i[e])() || i[e] !== t || i.splice(e--, 1);
      i.length || ft.fx.stop(), le = void 0
    }, ft.fx.timer = function(t) {
      ft.timers.push(t), t() ? ft.fx.start() : ft.timers.pop()
    }, ft.fx.interval = 13, ft.fx.start = function() {
      he || (he = t.requestAnimationFrame ? t.requestAnimationFrame(W) : t.setInterval(ft.fx.tick, ft.fx.interval))
    }, ft.fx.stop = function() {
      t.cancelAnimationFrame ? t.cancelAnimationFrame(he) : t.clearInterval(he), he = null
    }, ft.fx.speeds = {
      slow: 600,
      fast: 200,
      _default: 400
    }, ft.fn.delay = function(e, i) {
      return e = ft.fx ? ft.fx.speeds[e] || e : e, i = i || "fx", this.queue(i, function(i, s) {
        var n = t.setTimeout(i, e);
        s.stop = function() {
          t.clearTimeout(n)
        }
      })
    },
    function() {
      var t = et.createElement("input"),
        e = et.createElement("select"),
        i = e.appendChild(et.createElement("option"));
      t.type = "checkbox", dt.checkOn = "" !== t.value, dt.optSelected = i.selected, t = et.createElement("input"), t.value = "t", t.type = "radio", dt.radioValue = "t" === t.value
    }();
  var de, pe = ft.expr.attrHandle;
  ft.fn.extend({
    attr: function(t, e) {
      return It(this, ft.attr, t, e, arguments.length > 1)
    },
    removeAttr: function(t) {
      return this.each(function() {
        ft.removeAttr(this, t)
      })
    }
  }), ft.extend({
    attr: function(t, e, i) {
      var s, n, o = t.nodeType;
      if (3 !== o && 8 !== o && 2 !== o) return void 0 === t.getAttribute ? ft.prop(t, e, i) : (1 === o && ft.isXMLDoc(t) || (n = ft.attrHooks[e.toLowerCase()] || (ft.expr.match.bool.test(e) ? de : void 0)), void 0 !== i ? null === i ? void ft.removeAttr(t, e) : n && "set" in n && void 0 !== (s = n.set(t, i, e)) ? s : (t.setAttribute(e, i + ""), i) : n && "get" in n && null !== (s = n.get(t, e)) ? s : (s = ft.find.attr(t, e), null == s ? void 0 : s))
    },
    attrHooks: {
      type: {
        set: function(t, e) {
          if (!dt.radioValue && "radio" === e && ft.nodeName(t, "input")) {
            var i = t.value;
            return t.setAttribute("type", e), i && (t.value = i), e
          }
        }
      }
    },
    removeAttr: function(t, e) {
      var i, s = 0,
        n = e && e.match(St);
      if (n && 1 === t.nodeType)
        for (; i = n[s++];) t.removeAttribute(i)
    }
  }), de = {
    set: function(t, e, i) {
      return !1 === e ? ft.removeAttr(t, i) : t.setAttribute(i, i), i
    }
  }, ft.each(ft.expr.match.bool.source.match(/\w+/g), function(t, e) {
    var i = pe[e] || ft.find.attr;
    pe[e] = function(t, e, s) {
      var n, o, r = e.toLowerCase();
      return s || (o = pe[r], pe[r] = n, n = null != i(t, e, s) ? r : null, pe[r] = o), n
    }
  });
  var fe = /^(?:input|select|textarea|button)$/i,
    ge = /^(?:a|area)$/i;
  ft.fn.extend({
    prop: function(t, e) {
      return It(this, ft.prop, t, e, arguments.length > 1)
    },
    removeProp: function(t) {
      return this.each(function() {
        delete this[ft.propFix[t] || t]
      })
    }
  }), ft.extend({
    prop: function(t, e, i) {
      var s, n, o = t.nodeType;
      if (3 !== o && 8 !== o && 2 !== o) return 1 === o && ft.isXMLDoc(t) || (e = ft.propFix[e] || e, n = ft.propHooks[e]), void 0 !== i ? n && "set" in n && void 0 !== (s = n.set(t, i, e)) ? s : t[e] = i : n && "get" in n && null !== (s = n.get(t, e)) ? s : t[e]
    },
    propHooks: {
      tabIndex: {
        get: function(t) {
          var e = ft.find.attr(t, "tabindex");
          return e ? parseInt(e, 10) : fe.test(t.nodeName) || ge.test(t.nodeName) && t.href ? 0 : -1
        }
      }
    },
    propFix: {
      for: "htmlFor",
      class: "className"
    }
  }), dt.optSelected || (ft.propHooks.selected = {
    get: function(t) {
      var e = t.parentNode;
      return e && e.parentNode && e.parentNode.selectedIndex, null
    },
    set: function(t) {
      var e = t.parentNode;
      e && (e.selectedIndex, e.parentNode && e.parentNode.selectedIndex)
    }
  }), ft.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function() {
    ft.propFix[this.toLowerCase()] = this
  }), ft.fn.extend({
    addClass: function(t) {
      var e, i, s, n, o, r, a, l = 0;
      if (ft.isFunction(t)) return this.each(function(e) {
        ft(this).addClass(t.call(this, e, U(this)))
      });
      if ("string" == typeof t && t)
        for (e = t.match(St) || []; i = this[l++];)
          if (n = U(i), s = 1 === i.nodeType && " " + Y(n) + " ") {
            for (r = 0; o = e[r++];) s.indexOf(" " + o + " ") < 0 && (s += o + " ");
            a = Y(s), n !== a && i.setAttribute("class", a)
          }
      return this
    },
    removeClass: function(t) {
      var e, i, s, n, o, r, a, l = 0;
      if (ft.isFunction(t)) return this.each(function(e) {
        ft(this).removeClass(t.call(this, e, U(this)))
      });
      if (!arguments.length) return this.attr("class", "");
      if ("string" == typeof t && t)
        for (e = t.match(St) || []; i = this[l++];)
          if (n = U(i), s = 1 === i.nodeType && " " + Y(n) + " ") {
            for (r = 0; o = e[r++];)
              for (; s.indexOf(" " + o + " ") > -1;) s = s.replace(" " + o + " ", " ");
            a = Y(s), n !== a && i.setAttribute("class", a)
          }
      return this
    },
    toggleClass: function(t, e) {
      var i = typeof t;
      return "boolean" == typeof e && "string" === i ? e ? this.addClass(t) : this.removeClass(t) : ft.isFunction(t) ? this.each(function(i) {
        ft(this).toggleClass(t.call(this, i, U(this), e), e)
      }) : this.each(function() {
        var e, s, n, o;
        if ("string" === i)
          for (s = 0, n = ft(this), o = t.match(St) || []; e = o[s++];) n.hasClass(e) ? n.removeClass(e) : n.addClass(e);
        else void 0 !== t && "boolean" !== i || (e = U(this), e && Mt.set(this, "__className__", e), this.setAttribute && this.setAttribute("class", e || !1 === t ? "" : Mt.get(this, "__className__") || ""))
      })
    },
    hasClass: function(t) {
      var e, i, s = 0;
      for (e = " " + t + " "; i = this[s++];)
        if (1 === i.nodeType && (" " + Y(U(i)) + " ").indexOf(e) > -1) return !0;
      return !1
    }
  });
  ft.fn.extend({
    val: function(t) {
      var e, i, s, n = this[0];
      return arguments.length ? (s = ft.isFunction(t), this.each(function(i) {
        var n;
        1 === this.nodeType && (n = s ? t.call(this, i, ft(this).val()) : t, null == n ? n = "" : "number" == typeof n ? n += "" : ft.isArray(n) && (n = ft.map(n, function(t) {
          return null == t ? "" : t + ""
        })), (e = ft.valHooks[this.type] || ft.valHooks[this.nodeName.toLowerCase()]) && "set" in e && void 0 !== e.set(this, n, "value") || (this.value = n))
      })) : n ? (e = ft.valHooks[n.type] || ft.valHooks[n.nodeName.toLowerCase()], e && "get" in e && void 0 !== (i = e.get(n, "value")) ? i : (i = n.value, "string" == typeof i ? i.replace(/\r/g, "") : null == i ? "" : i)) : void 0
    }
  }), ft.extend({
    valHooks: {
      option: {
        get: function(t) {
          var e = ft.find.attr(t, "value");
          return null != e ? e : Y(ft.text(t))
        }
      },
      select: {
        get: function(t) {
          var e, i, s, n = t.options,
            o = t.selectedIndex,
            r = "select-one" === t.type,
            a = r ? null : [],
            l = r ? o + 1 : n.length;
          for (s = o < 0 ? l : r ? o : 0; s < l; s++)
            if (i = n[s], (i.selected || s === o) && !i.disabled && (!i.parentNode.disabled || !ft.nodeName(i.parentNode, "optgroup"))) {
              if (e = ft(i).val(), r) return e;
              a.push(e)
            }
          return a
        },
        set: function(t, e) {
          for (var i, s, n = t.options, o = ft.makeArray(e), r = n.length; r--;) s = n[r], (s.selected = ft.inArray(ft.valHooks.option.get(s), o) > -1) && (i = !0);
          return i || (t.selectedIndex = -1), o
        }
      }
    }
  }), ft.each(["radio", "checkbox"], function() {
    ft.valHooks[this] = {
      set: function(t, e) {
        if (ft.isArray(e)) return t.checked = ft.inArray(ft(t).val(), e) > -1
      }
    }, dt.checkOn || (ft.valHooks[this].get = function(t) {
      return null === t.getAttribute("value") ? "on" : t.value
    })
  });
  var me = /^(?:focusinfocus|focusoutblur)$/;
  ft.extend(ft.event, {
    trigger: function(e, i, s, n) {
      var o, r, a, l, h, c, u, d = [s || et],
        p = ht.call(e, "type") ? e.type : e,
        f = ht.call(e, "namespace") ? e.namespace.split(".") : [];
      if (r = a = s = s || et, 3 !== s.nodeType && 8 !== s.nodeType && !me.test(p + ft.event.triggered) && (p.indexOf(".") > -1 && (f = p.split("."), p = f.shift(), f.sort()), h = p.indexOf(":") < 0 && "on" + p, e = e[ft.expando] ? e : new ft.Event(p, "object" == typeof e && e), e.isTrigger = n ? 2 : 3, e.namespace = f.join("."), e.rnamespace = e.namespace ? new RegExp("(^|\\.)" + f.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, e.result = void 0, e.target || (e.target = s), i = null == i ? [e] : ft.makeArray(i, [e]), u = ft.event.special[p] || {}, n || !u.trigger || !1 !== u.trigger.apply(s, i))) {
        if (!n && !u.noBubble && !ft.isWindow(s)) {
          for (l = u.delegateType || p, me.test(l + p) || (r = r.parentNode); r; r = r.parentNode) d.push(r), a = r;
          a === (s.ownerDocument || et) && d.push(a.defaultView || a.parentWindow || t)
        }
        for (o = 0;
          (r = d[o++]) && !e.isPropagationStopped();) e.type = o > 1 ? l : u.bindType || p, c = (Mt.get(r, "events") || {})[e.type] && Mt.get(r, "handle"), c && c.apply(r, i), (c = h && r[h]) && c.apply && At(r) && (e.result = c.apply(r, i), !1 === e.result && e.preventDefault());
        return e.type = p, n || e.isDefaultPrevented() || u._default && !1 !== u._default.apply(d.pop(), i) || !At(s) || h && ft.isFunction(s[p]) && !ft.isWindow(s) && (a = s[h], a && (s[h] = null), ft.event.triggered = p, s[p](), ft.event.triggered = void 0, a && (s[h] = a)), e.result
      }
    },
    simulate: function(t, e, i) {
      var s = ft.extend(new ft.Event, i, {
        type: t,
        isSimulated: !0
      });
      ft.event.trigger(s, null, e)
    }
  }), ft.fn.extend({
    trigger: function(t, e) {
      return this.each(function() {
        ft.event.trigger(t, e, this)
      })
    },
    triggerHandler: function(t, e) {
      var i = this[0];
      if (i) return ft.event.trigger(t, e, i, !0)
    }
  }), ft.each("blur focus focusin focusout resize scroll click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup contextmenu".split(" "), function(t, e) {
    ft.fn[e] = function(t, i) {
      return arguments.length > 0 ? this.on(e, null, t, i) : this.trigger(e)
    }
  }), ft.fn.extend({
    hover: function(t, e) {
      return this.mouseenter(t).mouseleave(e || t)
    }
  }), dt.focusin = "onfocusin" in t, dt.focusin || ft.each({
    focus: "focusin",
    blur: "focusout"
  }, function(t, e) {
    var i = function(t) {
      ft.event.simulate(e, t.target, ft.event.fix(t))
    };
    ft.event.special[e] = {
      setup: function() {
        var s = this.ownerDocument || this,
          n = Mt.access(s, e);
        n || s.addEventListener(t, i, !0), Mt.access(s, e, (n || 0) + 1)
      },
      teardown: function() {
        var s = this.ownerDocument || this,
          n = Mt.access(s, e) - 1;
        n ? Mt.access(s, e, n) : (s.removeEventListener(t, i, !0), Mt.remove(s, e))
      }
    }
  });
  var ve = t.location,
    be = ft.now(),
    _e = /\?/;
  ft.parseXML = function(e) {
    var i;
    if (!e || "string" != typeof e) return null;
    try {
      i = (new t.DOMParser).parseFromString(e, "text/xml")
    } catch (t) {
      i = void 0
    }
    return i && !i.getElementsByTagName("parsererror").length || ft.error("Invalid XML: " + e), i
  };
  var ye = /\[\]$/,
    we = /^(?:submit|button|image|reset|file)$/i,
    xe = /^(?:input|select|textarea|keygen)/i;
  ft.param = function(t, e) {
    var i, s = [],
      n = function(t, e) {
        var i = ft.isFunction(e) ? e() : e;
        s[s.length] = encodeURIComponent(t) + "=" + encodeURIComponent(null == i ? "" : i)
      };
    if (ft.isArray(t) || t.jquery && !ft.isPlainObject(t)) ft.each(t, function() {
      n(this.name, this.value)
    });
    else
      for (i in t) X(i, t[i], e, n);
    return s.join("&")
  }, ft.fn.extend({
    serialize: function() {
      return ft.param(this.serializeArray())
    },
    serializeArray: function() {
      return this.map(function() {
        var t = ft.prop(this, "elements");
        return t ? ft.makeArray(t) : this
      }).filter(function() {
        var t = this.type;
        return this.name && !ft(this).is(":disabled") && xe.test(this.nodeName) && !we.test(t) && (this.checked || !jt.test(t))
      }).map(function(t, e) {
        var i = ft(this).val();
        return null == i ? null : ft.isArray(i) ? ft.map(i, function(t) {
          return {
            name: e.name,
            value: t.replace(/\r?\n/g, "\r\n")
          }
        }) : {
          name: e.name,
          value: i.replace(/\r?\n/g, "\r\n")
        }
      }).get()
    }
  });
  var ke = /^(.*?):[ \t]*([^\r\n]*)$/gm,
    Ce = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/,
    Te = /^(?:GET|HEAD)$/,
    Se = {},
    De = {},
    Pe = "*/".concat("*"),
    Ie = et.createElement("a");
  Ie.href = ve.href, ft.extend({
    active: 0,
    lastModified: {},
    etag: {},
    ajaxSettings: {
      url: ve.href,
      type: "GET",
      isLocal: Ce.test(ve.protocol),
      global: !0,
      processData: !0,
      async: !0,
      contentType: "application/x-www-form-urlencoded; charset=UTF-8",
      accepts: {
        "*": Pe,
        text: "text/plain",
        html: "text/html",
        xml: "application/xml, text/xml",
        json: "application/json, text/javascript"
      },
      contents: {
        xml: /\bxml\b/,
        html: /\bhtml/,
        json: /\bjson\b/
      },
      responseFields: {
        xml: "responseXML",
        text: "responseText",
        json: "responseJSON"
      },
      converters: {
        "* text": String,
        "text html": !0,
        "text json": JSON.parse,
        "text xml": ft.parseXML
      },
      flatOptions: {
        url: !0,
        context: !0
      }
    },
    ajaxSetup: function(t, e) {
      return e ? G(G(t, ft.ajaxSettings), e) : G(ft.ajaxSettings, t)
    },
    ajaxPrefilter: K(Se),
    ajaxTransport: K(De),
    ajax: function(e, i) {
      function s(e, i, s, a) {
        var h, d, p, y, w, x = i;
        c || (c = !0, l && t.clearTimeout(l), n = void 0, r = a || "", k.readyState = e > 0 ? 4 : 0, h = e >= 200 && e < 300 || 304 === e, s && (y = J(f, k, s)), y = Q(f, y, k, h), h ? (f.ifModified && (w = k.getResponseHeader("Last-Modified"), w && (ft.lastModified[o] = w), (w = k.getResponseHeader("etag")) && (ft.etag[o] = w)), 204 === e || "HEAD" === f.type ? x = "nocontent" : 304 === e ? x = "notmodified" : (x = y.state, d = y.data, p = y.error, h = !p)) : (p = x, !e && x || (x = "error", e < 0 && (e = 0))), k.status = e, k.statusText = (i || x) + "", h ? v.resolveWith(g, [d, x, k]) : v.rejectWith(g, [k, x, p]), k.statusCode(_), _ = void 0, u && m.trigger(h ? "ajaxSuccess" : "ajaxError", [k, f, h ? d : p]), b.fireWith(g, [k, x]), u && (m.trigger("ajaxComplete", [k, f]), --ft.active || ft.event.trigger("ajaxStop")))
      }
      "object" == typeof e && (i = e, e = void 0), i = i || {};
      var n, o, r, a, l, h, c, u, d, p, f = ft.ajaxSetup({}, i),
        g = f.context || f,
        m = f.context && (g.nodeType || g.jquery) ? ft(g) : ft.event,
        v = ft.Deferred(),
        b = ft.Callbacks("once memory"),
        _ = f.statusCode || {},
        y = {},
        w = {},
        x = "canceled",
        k = {
          readyState: 0,
          getResponseHeader: function(t) {
            var e;
            if (c) {
              if (!a)
                for (a = {}; e = ke.exec(r);) a[e[1].toLowerCase()] = e[2];
              e = a[t.toLowerCase()]
            }
            return null == e ? null : e
          },
          getAllResponseHeaders: function() {
            return c ? r : null
          },
          setRequestHeader: function(t, e) {
            return null == c && (t = w[t.toLowerCase()] = w[t.toLowerCase()] || t, y[t] = e), this
          },
          overrideMimeType: function(t) {
            return null == c && (f.mimeType = t), this
          },
          statusCode: function(t) {
            var e;
            if (t)
              if (c) k.always(t[k.status]);
              else
                for (e in t) _[e] = [_[e], t[e]];
            return this
          },
          abort: function(t) {
            var e = t || x;
            return n && n.abort(e), s(0, e), this
          }
        };
      if (v.promise(k), f.url = ((e || f.url || ve.href) + "").replace(/^\/\//, ve.protocol + "//"), f.type = i.method || i.type || f.method || f.type, f.dataTypes = (f.dataType || "*").toLowerCase().match(St) || [""], null == f.crossDomain) {
        h = et.createElement("a");
        try {
          h.href = f.url, h.href = h.href, f.crossDomain = Ie.protocol + "//" + Ie.host != h.protocol + "//" + h.host
        } catch (t) {
          f.crossDomain = !0
        }
      }
      if (f.data && f.processData && "string" != typeof f.data && (f.data = ft.param(f.data, f.traditional)), V(Se, f, i, k), c) return k;
      u = ft.event && f.global, u && 0 == ft.active++ && ft.event.trigger("ajaxStart"), f.type = f.type.toUpperCase(), f.hasContent = !Te.test(f.type), o = f.url.replace(/#.*$/, ""), f.hasContent ? f.data && f.processData && 0 === (f.contentType || "").indexOf("application/x-www-form-urlencoded") && (f.data = f.data.replace(/%20/g, "+")) : (p = f.url.slice(o.length), f.data && (o += (_e.test(o) ? "&" : "?") + f.data, delete f.data), !1 === f.cache && (o = o.replace(/([?&])_=[^&]*/, "$1"), p = (_e.test(o) ? "&" : "?") + "_=" + be++ + p), f.url = o + p), f.ifModified && (ft.lastModified[o] && k.setRequestHeader("If-Modified-Since", ft.lastModified[o]), ft.etag[o] && k.setRequestHeader("If-None-Match", ft.etag[o])), (f.data && f.hasContent && !1 !== f.contentType || i.contentType) && k.setRequestHeader("Content-Type", f.contentType), k.setRequestHeader("Accept", f.dataTypes[0] && f.accepts[f.dataTypes[0]] ? f.accepts[f.dataTypes[0]] + ("*" !== f.dataTypes[0] ? ", " + Pe + "; q=0.01" : "") : f.accepts["*"]);
      for (d in f.headers) k.setRequestHeader(d, f.headers[d]);
      if (f.beforeSend && (!1 === f.beforeSend.call(g, k, f) || c)) return k.abort();
      if (x = "abort", b.add(f.complete), k.done(f.success), k.fail(f.error), n = V(De, f, i, k)) {
        if (k.readyState = 1, u && m.trigger("ajaxSend", [k, f]), c) return k;
        f.async && f.timeout > 0 && (l = t.setTimeout(function() {
          k.abort("timeout")
        }, f.timeout));
        try {
          c = !1, n.send(y, s)
        } catch (t) {
          if (c) throw t;
          s(-1, t)
        }
      } else s(-1, "No Transport");
      return k
    },
    getJSON: function(t, e, i) {
      return ft.get(t, e, i, "json")
    },
    getScript: function(t, e) {
      return ft.get(t, void 0, e, "script")
    }
  }), ft.each(["get", "post"], function(t, e) {
    ft[e] = function(t, i, s, n) {
      return ft.isFunction(i) && (n = n || s, s = i, i = void 0), ft.ajax(ft.extend({
        url: t,
        type: e,
        dataType: n,
        data: i,
        success: s
      }, ft.isPlainObject(t) && t))
    }
  }), ft._evalUrl = function(t) {
    return ft.ajax({
      url: t,
      type: "GET",
      dataType: "script",
      cache: !0,
      async: !1,
      global: !1,
      throws: !0
    })
  }, ft.fn.extend({
    wrapAll: function(t) {
      var e;
      return this[0] && (ft.isFunction(t) && (t = t.call(this[0])), e = ft(t, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && e.insertBefore(this[0]), e.map(function() {
        for (var t = this; t.firstElementChild;) t = t.firstElementChild;
        return t
      }).append(this)), this
    },
    wrapInner: function(t) {
      return ft.isFunction(t) ? this.each(function(e) {
        ft(this).wrapInner(t.call(this, e))
      }) : this.each(function() {
        var e = ft(this),
          i = e.contents();
        i.length ? i.wrapAll(t) : e.append(t)
      })
    },
    wrap: function(t) {
      var e = ft.isFunction(t);
      return this.each(function(i) {
        ft(this).wrapAll(e ? t.call(this, i) : t)
      })
    },
    unwrap: function(t) {
      return this.parent(t).not("body").each(function() {
        ft(this).replaceWith(this.childNodes)
      }), this
    }
  }), ft.expr.pseudos.hidden = function(t) {
    return !ft.expr.pseudos.visible(t)
  }, ft.expr.pseudos.visible = function(t) {
    return !!(t.offsetWidth || t.offsetHeight || t.getClientRects().length)
  }, ft.ajaxSettings.xhr = function() {
    try {
      return new t.XMLHttpRequest
    } catch (t) {}
  };
  var Ae = {
      0: 200,
      1223: 204
    },
    Me = ft.ajaxSettings.xhr();
  dt.cors = !!Me && "withCredentials" in Me, dt.ajax = Me = !!Me, ft.ajaxTransport(function(e) {
    var i, s;
    if (dt.cors || Me && !e.crossDomain) return {
      send: function(n, o) {
        var r, a = e.xhr();
        if (a.open(e.type, e.url, e.async, e.username, e.password), e.xhrFields)
          for (r in e.xhrFields) a[r] = e.xhrFields[r];
        e.mimeType && a.overrideMimeType && a.overrideMimeType(e.mimeType), e.crossDomain || n["X-Requested-With"] || (n["X-Requested-With"] = "XMLHttpRequest");
        for (r in n) a.setRequestHeader(r, n[r]);
        i = function(t) {
          return function() {
            i && (i = s = a.onload = a.onerror = a.onabort = a.onreadystatechange = null, "abort" === t ? a.abort() : "error" === t ? "number" != typeof a.status ? o(0, "error") : o(a.status, a.statusText) : o(Ae[a.status] || a.status, a.statusText, "text" !== (a.responseType || "text") || "string" != typeof a.responseText ? {
              binary: a.response
            } : {
              text: a.responseText
            }, a.getAllResponseHeaders()))
          }
        }, a.onload = i(), s = a.onerror = i("error"), void 0 !== a.onabort ? a.onabort = s : a.onreadystatechange = function() {
          4 === a.readyState && t.setTimeout(function() {
            i && s()
          })
        }, i = i("abort");
        try {
          a.send(e.hasContent && e.data || null)
        } catch (t) {
          if (i) throw t
        }
      },
      abort: function() {
        i && i()
      }
    }
  }), ft.ajaxPrefilter(function(t) {
    t.crossDomain && (t.contents.script = !1)
  }), ft.ajaxSetup({
    accepts: {
      script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
    },
    contents: {
      script: /\b(?:java|ecma)script\b/
    },
    converters: {
      "text script": function(t) {
        return ft.globalEval(t), t
      }
    }
  }), ft.ajaxPrefilter("script", function(t) {
    void 0 === t.cache && (t.cache = !1), t.crossDomain && (t.type = "GET")
  }), ft.ajaxTransport("script", function(t) {
    if (t.crossDomain) {
      var e, i;
      return {
        send: function(s, n) {
          e = ft("<script>").prop({
            charset: t.scriptCharset,
            src: t.url
          }).on("load error", i = function(t) {
            e.remove(), i = null, t && n("error" === t.type ? 404 : 200, t.type)
          }), et.head.appendChild(e[0])
        },
        abort: function() {
          i && i()
        }
      }
    }
  });
  var He = [],
    Ee = /(=)\?(?=&|$)|\?\?/;
  ft.ajaxSetup({
    jsonp: "callback",
    jsonpCallback: function() {
      var t = He.pop() || ft.expando + "_" + be++;
      return this[t] = !0, t
    }
  }), ft.ajaxPrefilter("json jsonp", function(e, i, s) {
    var n, o, r, a = !1 !== e.jsonp && (Ee.test(e.url) ? "url" : "string" == typeof e.data && 0 === (e.contentType || "").indexOf("application/x-www-form-urlencoded") && Ee.test(e.data) && "data");
    if (a || "jsonp" === e.dataTypes[0]) return n = e.jsonpCallback = ft.isFunction(e.jsonpCallback) ? e.jsonpCallback() : e.jsonpCallback, a ? e[a] = e[a].replace(Ee, "$1" + n) : !1 !== e.jsonp && (e.url += (_e.test(e.url) ? "&" : "?") + e.jsonp + "=" + n), e.converters["script json"] = function() {
      return r || ft.error(n + " was not called"), r[0]
    }, e.dataTypes[0] = "json", o = t[n], t[n] = function() {
      r = arguments
    }, s.always(function() {
      void 0 === o ? ft(t).removeProp(n) : t[n] = o, e[n] && (e.jsonpCallback = i.jsonpCallback, He.push(n)), r && ft.isFunction(o) && o(r[0]), r = o = void 0
    }), "script"
  }), dt.createHTMLDocument = function() {
    var t = et.implementation.createHTMLDocument("").body;
    return t.innerHTML = "<form></form><form></form>", 2 === t.childNodes.length
  }(), ft.parseHTML = function(t, e, i) {
    if ("string" != typeof t) return [];
    "boolean" == typeof e && (i = e, e = !1);
    var s, n, o;
    return e || (dt.createHTMLDocument ? (e = et.implementation.createHTMLDocument(""), s = e.createElement("base"), s.href = et.location.href, e.head.appendChild(s)) : e = et), n = yt.exec(t), o = !i && [], n ? [e.createElement(n[1])] : (n = _([t], e, o), o && o.length && ft(o).remove(), ft.merge([], n.childNodes))
  }, ft.fn.load = function(t, e, i) {
    var s, n, o, r = this,
      a = t.indexOf(" ");
    return a > -1 && (s = Y(t.slice(a)), t = t.slice(0, a)), ft.isFunction(e) ? (i = e, e = void 0) : e && "object" == typeof e && (n = "POST"), r.length > 0 && ft.ajax({
      url: t,
      type: n || "GET",
      dataType: "html",
      data: e
    }).done(function(t) {
      o = arguments, r.html(s ? ft("<div>").append(ft.parseHTML(t)).find(s) : t)
    }).always(i && function(t, e) {
      r.each(function() {
        i.apply(this, o || [t.responseText, e, t])
      })
    }), this
  }, ft.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function(t, e) {
    ft.fn[e] = function(t) {
      return this.on(e, t)
    }
  }), ft.expr.pseudos.animated = function(t) {
    return ft.grep(ft.timers, function(e) {
      return t === e.elem
    }).length
  }, ft.offset = {
    setOffset: function(t, e, i) {
      var s, n, o, r, a, l, h, c = ft.css(t, "position"),
        u = ft(t),
        d = {};
      "static" === c && (t.style.position = "relative"), a = u.offset(), o = ft.css(t, "top"), l = ft.css(t, "left"), h = ("absolute" === c || "fixed" === c) && (o + l).indexOf("auto") > -1, h ? (s = u.position(), r = s.top, n = s.left) : (r = parseFloat(o) || 0, n = parseFloat(l) || 0), ft.isFunction(e) && (e = e.call(t, i, ft.extend({}, a))), null != e.top && (d.top = e.top - a.top + r), null != e.left && (d.left = e.left - a.left + n), "using" in e ? e.using.call(t, d) : u.css(d)
    }
  }, ft.fn.extend({
    offset: function(t) {
      if (arguments.length) return void 0 === t ? this : this.each(function(e) {
        ft.offset.setOffset(this, t, e)
      });
      var e, i, s, n, o = this[0];
      return o ? o.getClientRects().length ? (s = o.getBoundingClientRect(), s.width || s.height ? (n = o.ownerDocument, i = Z(n), e = n.documentElement, {
        top: s.top + i.pageYOffset - e.clientTop,
        left: s.left + i.pageXOffset - e.clientLeft
      }) : s) : {
        top: 0,
        left: 0
      } : void 0
    },
    position: function() {
      if (this[0]) {
        var t, e, i = this[0],
          s = {
            top: 0,
            left: 0
          };
        return "fixed" === ft.css(i, "position") ? e = i.getBoundingClientRect() : (t = this.offsetParent(), e = this.offset(), ft.nodeName(t[0], "html") || (s = t.offset()), s = {
          top: s.top + ft.css(t[0], "borderTopWidth", !0),
          left: s.left + ft.css(t[0], "borderLeftWidth", !0)
        }), {
          top: e.top - s.top - ft.css(i, "marginTop", !0),
          left: e.left - s.left - ft.css(i, "marginLeft", !0)
        }
      }
    },
    offsetParent: function() {
      return this.map(function() {
        for (var t = this.offsetParent; t && "static" === ft.css(t, "position");) t = t.offsetParent;
        return t || Ut
      })
    }
  }), ft.each({
    scrollLeft: "pageXOffset",
    scrollTop: "pageYOffset"
  }, function(t, e) {
    var i = "pageYOffset" === e;
    ft.fn[t] = function(s) {
      return It(this, function(t, s, n) {
        var o = Z(t);
        return void 0 === n ? o ? o[e] : t[s] : void(o ? o.scrollTo(i ? o.pageXOffset : n, i ? n : o.pageYOffset) : t[s] = n)
      }, t, s, arguments.length)
    }
  }), ft.each(["top", "left"], function(t, e) {
    ft.cssHooks[e] = H(dt.pixelPosition, function(t, i) {
      if (i) return i = M(t, e), ee.test(i) ? ft(t).position()[e] + "px" : i
    })
  }), ft.each({
    Height: "height",
    Width: "width"
  }, function(t, e) {
    ft.each({
      padding: "inner" + t,
      content: e,
      "": "outer" + t
    }, function(i, s) {
      ft.fn[s] = function(n, o) {
        var r = arguments.length && (i || "boolean" != typeof n),
          a = i || (!0 === n || !0 === o ? "margin" : "border");
        return It(this, function(e, i, n) {
          var o;
          return ft.isWindow(e) ? 0 === s.indexOf("outer") ? e["inner" + t] : e.document.documentElement["client" + t] : 9 === e.nodeType ? (o = e.documentElement, Math.max(e.body["scroll" + t], o["scroll" + t], e.body["offset" + t], o["offset" + t], o["client" + t])) : void 0 === n ? ft.css(e, i, a) : ft.style(e, i, n, a)
        }, e, r ? n : void 0, r)
      }
    })
  }), ft.fn.extend({
    bind: function(t, e, i) {
      return this.on(t, null, e, i)
    },
    unbind: function(t, e) {
      return this.off(t, null, e)
    },
    delegate: function(t, e, i, s) {
      return this.on(e, t, i, s)
    },
    undelegate: function(t, e, i) {
      return 1 === arguments.length ? this.off(t, "**") : this.off(e, t || "**", i)
    }
  }), ft.parseJSON = JSON.parse, "function" == typeof define && define.amd && define("jquery", [], function() {
    return ft
  });
  var Oe = t.jQuery,
    Ne = t.$;
  return ft.noConflict = function(e) {
    return t.$ === ft && (t.$ = Ne), e && t.jQuery === ft && (t.jQuery = Oe), ft
  }, e || (t.jQuery = t.$ = ft), ft
}),
function(t) {
  "function" == typeof define && define.amd ? define(["jquery"], t) : t(jQuery)
}(function(t) {
  function e(t) {
    for (var e = t.css("visibility");
      "inherit" === e;) t = t.parent(), e = t.css("visibility");
    return "hidden" !== e
  }

  function i(t) {
    for (var e, i; t.length && t[0] !== document;) {
      if (("absolute" === (e = t.css("position")) || "relative" === e || "fixed" === e) && (i = parseInt(t.css("zIndex"), 10), !isNaN(i) && 0 !== i)) return i;
      t = t.parent()
    }
    return 0
  }

  function s() {
    this._curInst = null, this._keyEvent = !1, this._disabledInputs = [], this._datepickerShowing = !1, this._inDialog = !1, this._mainDivId = "ui-datepicker-div", this._inlineClass = "ui-datepicker-inline", this._appendClass = "ui-datepicker-append", this._triggerClass = "ui-datepicker-trigger", this._dialogClass = "ui-datepicker-dialog", this._disableClass = "ui-datepicker-disabled", this._unselectableClass = "ui-datepicker-unselectable", this._currentClass = "ui-datepicker-current-day", this._dayOverClass = "ui-datepicker-days-cell-over", this.regional = [], this.regional[""] = {
      closeText: "Done",
      prevText: "Prev",
      nextText: "Next",
      currentText: "Today",
      monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
      monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      dayNames: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
      dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
      dayNamesMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
      weekHeader: "Wk",
      dateFormat: "mm/dd/yy",
      firstDay: 0,
      isRTL: !1,
      showMonthAfterYear: !1,
      yearSuffix: ""
    }, this._defaults = {
      showOn: "focus",
      showAnim: "fadeIn",
      showOptions: {},
      defaultDate: null,
      appendText: "",
      buttonText: "...",
      buttonImage: "",
      buttonImageOnly: !1,
      hideIfNoPrevNext: !1,
      navigationAsDateFormat: !1,
      gotoCurrent: !1,
      changeMonth: !1,
      changeYear: !1,
      yearRange: "c-10:c+10",
      showOtherMonths: !1,
      selectOtherMonths: !1,
      showWeek: !1,
      calculateWeek: this.iso8601Week,
      shortYearCutoff: "+10",
      minDate: null,
      maxDate: null,
      duration: "fast",
      beforeShowDay: null,
      beforeShow: null,
      onSelect: null,
      onChangeMonthYear: null,
      onClose: null,
      numberOfMonths: 1,
      showCurrentAtPos: 0,
      stepMonths: 1,
      stepBigMonths: 12,
      altField: "",
      altFormat: "",
      constrainInput: !0,
      showButtonPanel: !1,
      autoSize: !1,
      disabled: !1
    }, t.extend(this._defaults, this.regional[""]), this.regional.en = t.extend(!0, {}, this.regional[""]), this.regional["en-US"] = t.extend(!0, {}, this.regional.en), this.dpDiv = n(t("<div id='" + this._mainDivId + "' class='ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>"))
  }

  function n(e) {
    var i = "button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a";
    return e.on("mouseout", i, function() {
      t(this).removeClass("ui-state-hover"), -1 !== this.className.indexOf("ui-datepicker-prev") && t(this).removeClass("ui-datepicker-prev-hover"), -1 !== this.className.indexOf("ui-datepicker-next") && t(this).removeClass("ui-datepicker-next-hover")
    }).on("mouseover", i, o)
  }

  function o() {
    t.datepicker._isDisabledDatepicker(d.inline ? d.dpDiv.parent()[0] : d.input[0]) || (t(this).parents(".ui-datepicker-calendar").find("a").removeClass("ui-state-hover"), t(this).addClass("ui-state-hover"), -1 !== this.className.indexOf("ui-datepicker-prev") && t(this).addClass("ui-datepicker-prev-hover"), -1 !== this.className.indexOf("ui-datepicker-next") && t(this).addClass("ui-datepicker-next-hover"))
  }

  function r(e, i) {
    t.extend(e, i);
    for (var s in i) null == i[s] && (e[s] = i[s]);
    return e
  }

  function a(t) {
    return function() {
      var e = this.element.val();
      t.apply(this, arguments), this._refresh(), e !== this.element.val() && this._trigger("change")
    }
  }
  t.ui = t.ui || {};
  var l = (t.ui.version = "1.12.1", 0),
    h = Array.prototype.slice;
  t.cleanData = function(e) {
    return function(i) {
      var s, n, o;
      for (o = 0; null != (n = i[o]); o++) try {
        s = t._data(n, "events"), s && s.remove && t(n).triggerHandler("remove")
      } catch (t) {}
      e(i)
    }
  }(t.cleanData), t.widget = function(e, i, s) {
    var n, o, r, a = {},
      l = e.split(".")[0];
    e = e.split(".")[1];
    var h = l + "-" + e;
    return s || (s = i, i = t.Widget), t.isArray(s) && (s = t.extend.apply(null, [{}].concat(s))), t.expr[":"][h.toLowerCase()] = function(e) {
      return !!t.data(e, h)
    }, t[l] = t[l] || {}, n = t[l][e], o = t[l][e] = function(t, e) {
      if (!this._createWidget) return new o(t, e);
      arguments.length && this._createWidget(t, e)
    }, t.extend(o, n, {
      version: s.version,
      _proto: t.extend({}, s),
      _childConstructors: []
    }), r = new i, r.options = t.widget.extend({}, r.options), t.each(s, function(e, s) {
      if (!t.isFunction(s)) return void(a[e] = s);
      a[e] = function() {
        function t() {
          return i.prototype[e].apply(this, arguments)
        }

        function n(t) {
          return i.prototype[e].apply(this, t)
        }
        return function() {
          var e, i = this._super,
            o = this._superApply;
          return this._super = t, this._superApply = n, e = s.apply(this, arguments), this._super = i, this._superApply = o, e
        }
      }()
    }), o.prototype = t.widget.extend(r, {
      widgetEventPrefix: n ? r.widgetEventPrefix || e : e
    }, a, {
      constructor: o,
      namespace: l,
      widgetName: e,
      widgetFullName: h
    }), n ? (t.each(n._childConstructors, function(e, i) {
      var s = i.prototype;
      t.widget(s.namespace + "." + s.widgetName, o, i._proto)
    }), delete n._childConstructors) : i._childConstructors.push(o), t.widget.bridge(e, o), o
  }, t.widget.extend = function(e) {
    for (var i, s, n = h.call(arguments, 1), o = 0, r = n.length; o < r; o++)
      for (i in n[o]) s = n[o][i], n[o].hasOwnProperty(i) && void 0 !== s && (t.isPlainObject(s) ? e[i] = t.isPlainObject(e[i]) ? t.widget.extend({}, e[i], s) : t.widget.extend({}, s) : e[i] = s);
    return e
  }, t.widget.bridge = function(e, i) {
    var s = i.prototype.widgetFullName || e;
    t.fn[e] = function(n) {
      var o = "string" == typeof n,
        r = h.call(arguments, 1),
        a = this;
      return o ? this.length || "instance" !== n ? this.each(function() {
        var i, o = t.data(this, s);
        return "instance" === n ? (a = o, !1) : o ? t.isFunction(o[n]) && "_" !== n.charAt(0) ? (i = o[n].apply(o, r), i !== o && void 0 !== i ? (a = i && i.jquery ? a.pushStack(i.get()) : i, !1) : void 0) : t.error("no such method '" + n + "' for " + e + " widget instance") : t.error("cannot call methods on " + e + " prior to initialization; attempted to call method '" + n + "'")
      }) : a = void 0 : (r.length && (n = t.widget.extend.apply(null, [n].concat(r))), this.each(function() {
        var e = t.data(this, s);
        e ? (e.option(n || {}), e._init && e._init()) : t.data(this, s, new i(n, this))
      })), a
    }
  }, t.Widget = function() {}, t.Widget._childConstructors = [], t.Widget.prototype = {
    widgetName: "widget",
    widgetEventPrefix: "",
    defaultElement: "<div>",
    options: {
      classes: {},
      disabled: !1,
      create: null
    },
    _createWidget: function(e, i) {
      i = t(i || this.defaultElement || this)[0], this.element = t(i), this.uuid = l++, this.eventNamespace = "." + this.widgetName + this.uuid, this.bindings = t(), this.hoverable = t(), this.focusable = t(), this.classesElementLookup = {}, i !== this && (t.data(i, this.widgetFullName, this), this._on(!0, this.element, {
        remove: function(t) {
          t.target === i && this.destroy()
        }
      }), this.document = t(i.style ? i.ownerDocument : i.document || i), this.window = t(this.document[0].defaultView || this.document[0].parentWindow)), this.options = t.widget.extend({}, this.options, this._getCreateOptions(), e), this._create(), this.options.disabled && this._setOptionDisabled(this.options.disabled), this._trigger("create", null, this._getCreateEventData()), this._init()
    },
    _getCreateOptions: function() {
      return {}
    },
    _getCreateEventData: t.noop,
    _create: t.noop,
    _init: t.noop,
    destroy: function() {
      var e = this;
      this._destroy(), t.each(this.classesElementLookup, function(t, i) {
        e._removeClass(i, t)
      }), this.element.off(this.eventNamespace).removeData(this.widgetFullName), this.widget().off(this.eventNamespace).removeAttr("aria-disabled"), this.bindings.off(this.eventNamespace)
    },
    _destroy: t.noop,
    widget: function() {
      return this.element
    },
    option: function(e, i) {
      var s, n, o, r = e;
      if (0 === arguments.length) return t.widget.extend({}, this.options);
      if ("string" == typeof e)
        if (r = {}, s = e.split("."), e = s.shift(), s.length) {
          for (n = r[e] = t.widget.extend({}, this.options[e]), o = 0; o < s.length - 1; o++) n[s[o]] = n[s[o]] || {}, n = n[s[o]];
          if (e = s.pop(), 1 === arguments.length) return void 0 === n[e] ? null : n[e];
          n[e] = i
        } else {
          if (1 === arguments.length) return void 0 === this.options[e] ? null : this.options[e];
          r[e] = i
        }
      return this._setOptions(r), this
    },
    _setOptions: function(t) {
      var e;
      for (e in t) this._setOption(e, t[e]);
      return this
    },
    _setOption: function(t, e) {
      return "classes" === t && this._setOptionClasses(e), this.options[t] = e, "disabled" === t && this._setOptionDisabled(e), this
    },
    _setOptionClasses: function(e) {
      var i, s, n;
      for (i in e) n = this.classesElementLookup[i], e[i] !== this.options.classes[i] && n && n.length && (s = t(n.get()), this._removeClass(n, i), s.addClass(this._classes({
        element: s,
        keys: i,
        classes: e,
        add: !0
      })))
    },
    _setOptionDisabled: function(t) {
      this._toggleClass(this.widget(), this.widgetFullName + "-disabled", null, !!t), t && (this._removeClass(this.hoverable, null, "ui-state-hover"), this._removeClass(this.focusable, null, "ui-state-focus"))
    },
    enable: function() {
      return this._setOptions({
        disabled: !1
      })
    },
    disable: function() {
      return this._setOptions({
        disabled: !0
      })
    },
    _classes: function(e) {
      function i(i, o) {
        var r, a;
        for (a = 0; a < i.length; a++) r = n.classesElementLookup[i[a]] || t(), r = t(e.add ? t.unique(r.get().concat(e.element.get())) : r.not(e.element).get()), n.classesElementLookup[i[a]] = r, s.push(i[a]), o && e.classes[i[a]] && s.push(e.classes[i[a]])
      }
      var s = [],
        n = this;
      return e = t.extend({
          element: this.element,
          classes: this.options.classes || {}
        }, e), this._on(e.element, {
          remove: "_untrackClassesElement"
        }), e.keys && i(e.keys.match(/\S+/g) || [], !0), e.extra && i(e.extra.match(/\S+/g) || []),
        s.join(" ")
    },
    _untrackClassesElement: function(e) {
      var i = this;
      t.each(i.classesElementLookup, function(s, n) {
        -1 !== t.inArray(e.target, n) && (i.classesElementLookup[s] = t(n.not(e.target).get()))
      })
    },
    _removeClass: function(t, e, i) {
      return this._toggleClass(t, e, i, !1)
    },
    _addClass: function(t, e, i) {
      return this._toggleClass(t, e, i, !0)
    },
    _toggleClass: function(t, e, i, s) {
      s = "boolean" == typeof s ? s : i;
      var n = "string" == typeof t || null === t,
        o = {
          extra: n ? e : i,
          keys: n ? t : e,
          element: n ? this.element : t,
          add: s
        };
      return o.element.toggleClass(this._classes(o), s), this
    },
    _on: function(e, i, s) {
      var n, o = this;
      "boolean" != typeof e && (s = i, i = e, e = !1), s ? (i = n = t(i), this.bindings = this.bindings.add(i)) : (s = i, i = this.element, n = this.widget()), t.each(s, function(s, r) {
        function a() {
          if (e || !0 !== o.options.disabled && !t(this).hasClass("ui-state-disabled")) return ("string" == typeof r ? o[r] : r).apply(o, arguments)
        }
        "string" != typeof r && (a.guid = r.guid = r.guid || a.guid || t.guid++);
        var l = s.match(/^([\w:-]*)\s*(.*)$/),
          h = l[1] + o.eventNamespace,
          c = l[2];
        c ? n.on(h, c, a) : i.on(h, a)
      })
    },
    _off: function(e, i) {
      i = (i || "").split(" ").join(this.eventNamespace + " ") + this.eventNamespace, e.off(i).off(i), this.bindings = t(this.bindings.not(e).get()), this.focusable = t(this.focusable.not(e).get()), this.hoverable = t(this.hoverable.not(e).get())
    },
    _delay: function(t, e) {
      function i() {
        return ("string" == typeof t ? s[t] : t).apply(s, arguments)
      }
      var s = this;
      return setTimeout(i, e || 0)
    },
    _hoverable: function(e) {
      this.hoverable = this.hoverable.add(e), this._on(e, {
        mouseenter: function(e) {
          this._addClass(t(e.currentTarget), null, "ui-state-hover")
        },
        mouseleave: function(e) {
          this._removeClass(t(e.currentTarget), null, "ui-state-hover")
        }
      })
    },
    _focusable: function(e) {
      this.focusable = this.focusable.add(e), this._on(e, {
        focusin: function(e) {
          this._addClass(t(e.currentTarget), null, "ui-state-focus")
        },
        focusout: function(e) {
          this._removeClass(t(e.currentTarget), null, "ui-state-focus")
        }
      })
    },
    _trigger: function(e, i, s) {
      var n, o, r = this.options[e];
      if (s = s || {}, i = t.Event(i), i.type = (e === this.widgetEventPrefix ? e : this.widgetEventPrefix + e).toLowerCase(), i.target = this.element[0], o = i.originalEvent)
        for (n in o) n in i || (i[n] = o[n]);
      return this.element.trigger(i, s), !(t.isFunction(r) && !1 === r.apply(this.element[0], [i].concat(s)) || i.isDefaultPrevented())
    }
  }, t.each({
    show: "fadeIn",
    hide: "fadeOut"
  }, function(e, i) {
    t.Widget.prototype["_" + e] = function(s, n, o) {
      "string" == typeof n && (n = {
        effect: n
      });
      var r, a = n ? !0 === n || "number" == typeof n ? i : n.effect || i : e;
      n = n || {}, "number" == typeof n && (n = {
        duration: n
      }), r = !t.isEmptyObject(n), n.complete = o, n.delay && s.delay(n.delay), r && t.effects && t.effects.effect[a] ? s[e](n) : a !== e && s[a] ? s[a](n.duration, n.easing, o) : s.queue(function(i) {
        t(this)[e](), o && o.call(s[0]), i()
      })
    }
  });
  t.widget;
  ! function() {
    function e(t, e, i) {
      return [parseFloat(t[0]) * (u.test(t[0]) ? e / 100 : 1), parseFloat(t[1]) * (u.test(t[1]) ? i / 100 : 1)]
    }

    function i(e, i) {
      return parseInt(t.css(e, i), 10) || 0
    }

    function s(e) {
      var i = e[0];
      return 9 === i.nodeType ? {
        width: e.width(),
        height: e.height(),
        offset: {
          top: 0,
          left: 0
        }
      } : t.isWindow(i) ? {
        width: e.width(),
        height: e.height(),
        offset: {
          top: e.scrollTop(),
          left: e.scrollLeft()
        }
      } : i.preventDefault ? {
        width: 0,
        height: 0,
        offset: {
          top: i.pageY,
          left: i.pageX
        }
      } : {
        width: e.outerWidth(),
        height: e.outerHeight(),
        offset: e.offset()
      }
    }
    var n, o = Math.max,
      r = Math.abs,
      a = /left|center|right/,
      l = /top|center|bottom/,
      h = /[\+\-]\d+(\.[\d]+)?%?/,
      c = /^\w+/,
      u = /%$/,
      d = t.fn.position;
    t.position = {
      scrollbarWidth: function() {
        if (void 0 !== n) return n;
        var e, i, s = t("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"),
          o = s.children()[0];
        return t("body").append(s), e = o.offsetWidth, s.css("overflow", "scroll"), i = o.offsetWidth, e === i && (i = s[0].clientWidth), s.remove(), n = e - i
      },
      getScrollInfo: function(e) {
        var i = e.isWindow || e.isDocument ? "" : e.element.css("overflow-x"),
          s = e.isWindow || e.isDocument ? "" : e.element.css("overflow-y"),
          n = "scroll" === i || "auto" === i && e.width < e.element[0].scrollWidth;
        return {
          width: "scroll" === s || "auto" === s && e.height < e.element[0].scrollHeight ? t.position.scrollbarWidth() : 0,
          height: n ? t.position.scrollbarWidth() : 0
        }
      },
      getWithinInfo: function(e) {
        var i = t(e || window),
          s = t.isWindow(i[0]),
          n = !!i[0] && 9 === i[0].nodeType;
        return {
          element: i,
          isWindow: s,
          isDocument: n,
          offset: s || n ? {
            left: 0,
            top: 0
          } : t(e).offset(),
          scrollLeft: i.scrollLeft(),
          scrollTop: i.scrollTop(),
          width: i.outerWidth(),
          height: i.outerHeight()
        }
      }
    }, t.fn.position = function(n) {
      if (!n || !n.of) return d.apply(this, arguments);
      n = t.extend({}, n);
      var u, p, f, g, m, v, b = t(n.of),
        _ = t.position.getWithinInfo(n.within),
        y = t.position.getScrollInfo(_),
        w = (n.collision || "flip").split(" "),
        x = {};
      return v = s(b), b[0].preventDefault && (n.at = "left top"), p = v.width, f = v.height, g = v.offset, m = t.extend({}, g), t.each(["my", "at"], function() {
        var t, e, i = (n[this] || "").split(" ");
        1 === i.length && (i = a.test(i[0]) ? i.concat(["center"]) : l.test(i[0]) ? ["center"].concat(i) : ["center", "center"]), i[0] = a.test(i[0]) ? i[0] : "center", i[1] = l.test(i[1]) ? i[1] : "center", t = h.exec(i[0]), e = h.exec(i[1]), x[this] = [t ? t[0] : 0, e ? e[0] : 0], n[this] = [c.exec(i[0])[0], c.exec(i[1])[0]]
      }), 1 === w.length && (w[1] = w[0]), "right" === n.at[0] ? m.left += p : "center" === n.at[0] && (m.left += p / 2), "bottom" === n.at[1] ? m.top += f : "center" === n.at[1] && (m.top += f / 2), u = e(x.at, p, f), m.left += u[0], m.top += u[1], this.each(function() {
        var s, a, l = t(this),
          h = l.outerWidth(),
          c = l.outerHeight(),
          d = i(this, "marginLeft"),
          v = i(this, "marginTop"),
          k = h + d + i(this, "marginRight") + y.width,
          C = c + v + i(this, "marginBottom") + y.height,
          T = t.extend({}, m),
          S = e(x.my, l.outerWidth(), l.outerHeight());
        "right" === n.my[0] ? T.left -= h : "center" === n.my[0] && (T.left -= h / 2), "bottom" === n.my[1] ? T.top -= c : "center" === n.my[1] && (T.top -= c / 2), T.left += S[0], T.top += S[1], s = {
          marginLeft: d,
          marginTop: v
        }, t.each(["left", "top"], function(e, i) {
          t.ui.position[w[e]] && t.ui.position[w[e]][i](T, {
            targetWidth: p,
            targetHeight: f,
            elemWidth: h,
            elemHeight: c,
            collisionPosition: s,
            collisionWidth: k,
            collisionHeight: C,
            offset: [u[0] + S[0], u[1] + S[1]],
            my: n.my,
            at: n.at,
            within: _,
            elem: l
          })
        }), n.using && (a = function(t) {
          var e = g.left - T.left,
            i = e + p - h,
            s = g.top - T.top,
            a = s + f - c,
            u = {
              target: {
                element: b,
                left: g.left,
                top: g.top,
                width: p,
                height: f
              },
              element: {
                element: l,
                left: T.left,
                top: T.top,
                width: h,
                height: c
              },
              horizontal: i < 0 ? "left" : e > 0 ? "right" : "center",
              vertical: a < 0 ? "top" : s > 0 ? "bottom" : "middle"
            };
          p < h && r(e + i) < p && (u.horizontal = "center"), f < c && r(s + a) < f && (u.vertical = "middle"), o(r(e), r(i)) > o(r(s), r(a)) ? u.important = "horizontal" : u.important = "vertical", n.using.call(this, t, u)
        }), l.offset(t.extend(T, {
          using: a
        }))
      })
    }, t.ui.position = {
      fit: {
        left: function(t, e) {
          var i, s = e.within,
            n = s.isWindow ? s.scrollLeft : s.offset.left,
            r = s.width,
            a = t.left - e.collisionPosition.marginLeft,
            l = n - a,
            h = a + e.collisionWidth - r - n;
          e.collisionWidth > r ? l > 0 && h <= 0 ? (i = t.left + l + e.collisionWidth - r - n, t.left += l - i) : t.left = h > 0 && l <= 0 ? n : l > h ? n + r - e.collisionWidth : n : l > 0 ? t.left += l : h > 0 ? t.left -= h : t.left = o(t.left - a, t.left)
        },
        top: function(t, e) {
          var i, s = e.within,
            n = s.isWindow ? s.scrollTop : s.offset.top,
            r = e.within.height,
            a = t.top - e.collisionPosition.marginTop,
            l = n - a,
            h = a + e.collisionHeight - r - n;
          e.collisionHeight > r ? l > 0 && h <= 0 ? (i = t.top + l + e.collisionHeight - r - n, t.top += l - i) : t.top = h > 0 && l <= 0 ? n : l > h ? n + r - e.collisionHeight : n : l > 0 ? t.top += l : h > 0 ? t.top -= h : t.top = o(t.top - a, t.top)
        }
      },
      flip: {
        left: function(t, e) {
          var i, s, n = e.within,
            o = n.offset.left + n.scrollLeft,
            a = n.width,
            l = n.isWindow ? n.scrollLeft : n.offset.left,
            h = t.left - e.collisionPosition.marginLeft,
            c = h - l,
            u = h + e.collisionWidth - a - l,
            d = "left" === e.my[0] ? -e.elemWidth : "right" === e.my[0] ? e.elemWidth : 0,
            p = "left" === e.at[0] ? e.targetWidth : "right" === e.at[0] ? -e.targetWidth : 0,
            f = -2 * e.offset[0];
          c < 0 ? ((i = t.left + d + p + f + e.collisionWidth - a - o) < 0 || i < r(c)) && (t.left += d + p + f) : u > 0 && ((s = t.left - e.collisionPosition.marginLeft + d + p + f - l) > 0 || r(s) < u) && (t.left += d + p + f)
        },
        top: function(t, e) {
          var i, s, n = e.within,
            o = n.offset.top + n.scrollTop,
            a = n.height,
            l = n.isWindow ? n.scrollTop : n.offset.top,
            h = t.top - e.collisionPosition.marginTop,
            c = h - l,
            u = h + e.collisionHeight - a - l,
            d = "top" === e.my[1],
            p = d ? -e.elemHeight : "bottom" === e.my[1] ? e.elemHeight : 0,
            f = "top" === e.at[1] ? e.targetHeight : "bottom" === e.at[1] ? -e.targetHeight : 0,
            g = -2 * e.offset[1];
          c < 0 ? ((s = t.top + p + f + g + e.collisionHeight - a - o) < 0 || s < r(c)) && (t.top += p + f + g) : u > 0 && ((i = t.top - e.collisionPosition.marginTop + p + f + g - l) > 0 || r(i) < u) && (t.top += p + f + g)
        }
      },
      flipfit: {
        left: function() {
          t.ui.position.flip.left.apply(this, arguments), t.ui.position.fit.left.apply(this, arguments)
        },
        top: function() {
          t.ui.position.flip.top.apply(this, arguments), t.ui.position.fit.top.apply(this, arguments)
        }
      }
    }
  }();
  var c = (t.ui.position, t.extend(t.expr[":"], {
      data: t.expr.createPseudo ? t.expr.createPseudo(function(e) {
        return function(i) {
          return !!t.data(i, e)
        }
      }) : function(e, i, s) {
        return !!t.data(e, s[3])
      }
    }), t.fn.extend({
      disableSelection: function() {
        var t = "onselectstart" in document.createElement("div") ? "selectstart" : "mousedown";
        return function() {
          return this.on(t + ".ui-disableSelection", function(t) {
            t.preventDefault()
          })
        }
      }(),
      enableSelection: function() {
        return this.off(".ui-disableSelection")
      }
    }), "ui-effects-animated"),
    u = t;
  t.effects = {
      effect: {}
    },
    function(t, e) {
      function i(t, e, i) {
        var s = c[e.type] || {};
        return null == t ? i || !e.def ? null : e.def : (t = s.floor ? ~~t : parseFloat(t), isNaN(t) ? e.def : s.mod ? (t + s.mod) % s.mod : 0 > t ? 0 : s.max < t ? s.max : t)
      }

      function s(e) {
        var i = l(),
          s = i._rgba = [];
        return e = e.toLowerCase(), p(a, function(t, n) {
          var o, r = n.re.exec(e),
            a = r && n.parse(r),
            l = n.space || "rgba";
          if (a) return o = i[l](a), i[h[l].cache] = o[h[l].cache], s = i._rgba = o._rgba, !1
        }), s.length ? ("0,0,0,0" === s.join() && t.extend(s, o.transparent), i) : o[e]
      }

      function n(t, e, i) {
        return i = (i + 1) % 1, 6 * i < 1 ? t + (e - t) * i * 6 : 2 * i < 1 ? e : 3 * i < 2 ? t + (e - t) * (2 / 3 - i) * 6 : t
      }
      var o, r = /^([\-+])=\s*(\d+\.?\d*)/,
        a = [{
          re: /rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
          parse: function(t) {
            return [t[1], t[2], t[3], t[4]]
          }
        }, {
          re: /rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
          parse: function(t) {
            return [2.55 * t[1], 2.55 * t[2], 2.55 * t[3], t[4]]
          }
        }, {
          re: /#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})/,
          parse: function(t) {
            return [parseInt(t[1], 16), parseInt(t[2], 16), parseInt(t[3], 16)]
          }
        }, {
          re: /#([a-f0-9])([a-f0-9])([a-f0-9])/,
          parse: function(t) {
            return [parseInt(t[1] + t[1], 16), parseInt(t[2] + t[2], 16), parseInt(t[3] + t[3], 16)]
          }
        }, {
          re: /hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
          space: "hsla",
          parse: function(t) {
            return [t[1], t[2] / 100, t[3] / 100, t[4]]
          }
        }],
        l = t.Color = function(e, i, s, n) {
          return new t.Color.fn.parse(e, i, s, n)
        },
        h = {
          rgba: {
            props: {
              red: {
                idx: 0,
                type: "byte"
              },
              green: {
                idx: 1,
                type: "byte"
              },
              blue: {
                idx: 2,
                type: "byte"
              }
            }
          },
          hsla: {
            props: {
              hue: {
                idx: 0,
                type: "degrees"
              },
              saturation: {
                idx: 1,
                type: "percent"
              },
              lightness: {
                idx: 2,
                type: "percent"
              }
            }
          }
        },
        c = {
          byte: {
            floor: !0,
            max: 255
          },
          percent: {
            max: 1
          },
          degrees: {
            mod: 360,
            floor: !0
          }
        },
        u = l.support = {},
        d = t("<p>")[0],
        p = t.each;
      d.style.cssText = "background-color:rgba(1,1,1,.5)", u.rgba = d.style.backgroundColor.indexOf("rgba") > -1, p(h, function(t, e) {
        e.cache = "_" + t, e.props.alpha = {
          idx: 3,
          type: "percent",
          def: 1
        }
      }), l.fn = t.extend(l.prototype, {
        parse: function(e, n, r, a) {
          if (void 0 === e) return this._rgba = [null, null, null, null], this;
          (e.jquery || e.nodeType) && (e = t(e).css(n), n = void 0);
          var c = this,
            u = t.type(e),
            d = this._rgba = [];
          return void 0 !== n && (e = [e, n, r, a], u = "array"), "string" === u ? this.parse(s(e) || o._default) : "array" === u ? (p(h.rgba.props, function(t, s) {
            d[s.idx] = i(e[s.idx], s)
          }), this) : "object" === u ? (e instanceof l ? p(h, function(t, i) {
            e[i.cache] && (c[i.cache] = e[i.cache].slice())
          }) : p(h, function(s, n) {
            var o = n.cache;
            p(n.props, function(t, s) {
              if (!c[o] && n.to) {
                if ("alpha" === t || null == e[t]) return;
                c[o] = n.to(c._rgba)
              }
              c[o][s.idx] = i(e[t], s, !0)
            }), c[o] && t.inArray(null, c[o].slice(0, 3)) < 0 && (c[o][3] = 1, n.from && (c._rgba = n.from(c[o])))
          }), this) : void 0
        },
        is: function(t) {
          var e = l(t),
            i = !0,
            s = this;
          return p(h, function(t, n) {
            var o, r = e[n.cache];
            return r && (o = s[n.cache] || n.to && n.to(s._rgba) || [], p(n.props, function(t, e) {
              if (null != r[e.idx]) return i = r[e.idx] === o[e.idx]
            })), i
          }), i
        },
        _space: function() {
          var t = [],
            e = this;
          return p(h, function(i, s) {
            e[s.cache] && t.push(i)
          }), t.pop()
        },
        transition: function(t, e) {
          var s = l(t),
            n = s._space(),
            o = h[n],
            r = 0 === this.alpha() ? l("transparent") : this,
            a = r[o.cache] || o.to(r._rgba),
            u = a.slice();
          return s = s[o.cache], p(o.props, function(t, n) {
            var o = n.idx,
              r = a[o],
              l = s[o],
              h = c[n.type] || {};
            null !== l && (null === r ? u[o] = l : (h.mod && (l - r > h.mod / 2 ? r += h.mod : r - l > h.mod / 2 && (r -= h.mod)), u[o] = i((l - r) * e + r, n)))
          }), this[n](u)
        },
        blend: function(e) {
          if (1 === this._rgba[3]) return this;
          var i = this._rgba.slice(),
            s = i.pop(),
            n = l(e)._rgba;
          return l(t.map(i, function(t, e) {
            return (1 - s) * n[e] + s * t
          }))
        },
        toRgbaString: function() {
          var e = "rgba(",
            i = t.map(this._rgba, function(t, e) {
              return null == t ? e > 2 ? 1 : 0 : t
            });
          return 1 === i[3] && (i.pop(), e = "rgb("), e + i.join() + ")"
        },
        toHslaString: function() {
          var e = "hsla(",
            i = t.map(this.hsla(), function(t, e) {
              return null == t && (t = e > 2 ? 1 : 0), e && e < 3 && (t = Math.round(100 * t) + "%"), t
            });
          return 1 === i[3] && (i.pop(), e = "hsl("), e + i.join() + ")"
        },
        toHexString: function(e) {
          var i = this._rgba.slice(),
            s = i.pop();
          return e && i.push(~~(255 * s)), "#" + t.map(i, function(t) {
            return t = (t || 0).toString(16), 1 === t.length ? "0" + t : t
          }).join("")
        },
        toString: function() {
          return 0 === this._rgba[3] ? "transparent" : this.toRgbaString()
        }
      }), l.fn.parse.prototype = l.fn, h.hsla.to = function(t) {
        if (null == t[0] || null == t[1] || null == t[2]) return [null, null, null, t[3]];
        var e, i, s = t[0] / 255,
          n = t[1] / 255,
          o = t[2] / 255,
          r = t[3],
          a = Math.max(s, n, o),
          l = Math.min(s, n, o),
          h = a - l,
          c = a + l,
          u = .5 * c;
        return e = l === a ? 0 : s === a ? 60 * (n - o) / h + 360 : n === a ? 60 * (o - s) / h + 120 : 60 * (s - n) / h + 240, i = 0 === h ? 0 : u <= .5 ? h / c : h / (2 - c), [Math.round(e) % 360, i, u, null == r ? 1 : r]
      }, h.hsla.from = function(t) {
        if (null == t[0] || null == t[1] || null == t[2]) return [null, null, null, t[3]];
        var e = t[0] / 360,
          i = t[1],
          s = t[2],
          o = t[3],
          r = s <= .5 ? s * (1 + i) : s + i - s * i,
          a = 2 * s - r;
        return [Math.round(255 * n(a, r, e + 1 / 3)), Math.round(255 * n(a, r, e)), Math.round(255 * n(a, r, e - 1 / 3)), o]
      }, p(h, function(e, s) {
        var n = s.props,
          o = s.cache,
          a = s.to,
          h = s.from;
        l.fn[e] = function(e) {
          if (a && !this[o] && (this[o] = a(this._rgba)), void 0 === e) return this[o].slice();
          var s, r = t.type(e),
            c = "array" === r || "object" === r ? e : arguments,
            u = this[o].slice();
          return p(n, function(t, e) {
            var s = c["object" === r ? t : e.idx];
            null == s && (s = u[e.idx]), u[e.idx] = i(s, e)
          }), h ? (s = l(h(u)), s[o] = u, s) : l(u)
        }, p(n, function(i, s) {
          l.fn[i] || (l.fn[i] = function(n) {
            var o, a = t.type(n),
              l = "alpha" === i ? this._hsla ? "hsla" : "rgba" : e,
              h = this[l](),
              c = h[s.idx];
            return "undefined" === a ? c : ("function" === a && (n = n.call(this, c), a = t.type(n)), null == n && s.empty ? this : ("string" === a && (o = r.exec(n)) && (n = c + parseFloat(o[2]) * ("+" === o[1] ? 1 : -1)), h[s.idx] = n, this[l](h)))
          })
        })
      }), l.hook = function(e) {
        var i = e.split(" ");
        p(i, function(e, i) {
          t.cssHooks[i] = {
            set: function(e, n) {
              var o, r, a = "";
              if ("transparent" !== n && ("string" !== t.type(n) || (o = s(n)))) {
                if (n = l(o || n), !u.rgba && 1 !== n._rgba[3]) {
                  for (r = "backgroundColor" === i ? e.parentNode : e;
                    ("" === a || "transparent" === a) && r && r.style;) try {
                    a = t.css(r, "backgroundColor"), r = r.parentNode
                  } catch (t) {}
                  n = n.blend(a && "transparent" !== a ? a : "_default")
                }
                n = n.toRgbaString()
              }
              try {
                e.style[i] = n
              } catch (t) {}
            }
          }, t.fx.step[i] = function(e) {
            e.colorInit || (e.start = l(e.elem, i), e.end = l(e.end), e.colorInit = !0), t.cssHooks[i].set(e.elem, e.start.transition(e.end, e.pos))
          }
        })
      }, l.hook("backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor"), t.cssHooks.borderColor = {
        expand: function(t) {
          var e = {};
          return p(["Top", "Right", "Bottom", "Left"], function(i, s) {
            e["border" + s + "Color"] = t
          }), e
        }
      }, o = t.Color.names = {
        aqua: "#00ffff",
        black: "#000000",
        blue: "#0000ff",
        fuchsia: "#ff00ff",
        gray: "#808080",
        green: "#008000",
        lime: "#00ff00",
        maroon: "#800000",
        navy: "#000080",
        olive: "#808000",
        purple: "#800080",
        red: "#ff0000",
        silver: "#c0c0c0",
        teal: "#008080",
        white: "#ffffff",
        yellow: "#ffff00",
        transparent: [null, null, null, 0],
        _default: "#ffffff"
      }
    }(u),
    function() {
      function e(e) {
        var i, s, n = e.ownerDocument.defaultView ? e.ownerDocument.defaultView.getComputedStyle(e, null) : e.currentStyle,
          o = {};
        if (n && n.length && n[0] && n[n[0]])
          for (s = n.length; s--;) i = n[s], "string" == typeof n[i] && (o[t.camelCase(i)] = n[i]);
        else
          for (i in n) "string" == typeof n[i] && (o[i] = n[i]);
        return o
      }

      function i(e, i) {
        var s, o, r = {};
        for (s in i) o = i[s], e[s] !== o && (n[s] || !t.fx.step[s] && isNaN(parseFloat(o)) || (r[s] = o));
        return r
      }
      var s = ["add", "remove", "toggle"],
        n = {
          border: 1,
          borderBottom: 1,
          borderColor: 1,
          borderLeft: 1,
          borderRight: 1,
          borderTop: 1,
          borderWidth: 1,
          margin: 1,
          padding: 1
        };
      t.each(["borderLeftStyle", "borderRightStyle", "borderBottomStyle", "borderTopStyle"], function(e, i) {
        t.fx.step[i] = function(t) {
          ("none" !== t.end && !t.setAttr || 1 === t.pos && !t.setAttr) && (u.style(t.elem, i, t.end), t.setAttr = !0)
        }
      }), t.fn.addBack || (t.fn.addBack = function(t) {
        return this.add(null == t ? this.prevObject : this.prevObject.filter(t))
      }), t.effects.animateClass = function(n, o, r, a) {
        var l = t.speed(o, r, a);
        return this.queue(function() {
          var o, r = t(this),
            a = r.attr("class") || "",
            h = l.children ? r.find("*").addBack() : r;
          h = h.map(function() {
            return {
              el: t(this),
              start: e(this)
            }
          }), o = function() {
            t.each(s, function(t, e) {
              n[e] && r[e + "Class"](n[e])
            })
          }, o(), h = h.map(function() {
            return this.end = e(this.el[0]), this.diff = i(this.start, this.end), this
          }), r.attr("class", a), h = h.map(function() {
            var e = this,
              i = t.Deferred(),
              s = t.extend({}, l, {
                queue: !1,
                complete: function() {
                  i.resolve(e)
                }
              });
            return this.el.animate(this.diff, s), i.promise()
          }), t.when.apply(t, h.get()).done(function() {
            o(), t.each(arguments, function() {
              var e = this.el;
              t.each(this.diff, function(t) {
                e.css(t, "")
              })
            }), l.complete.call(r[0])
          })
        })
      }, t.fn.extend({
        addClass: function(e) {
          return function(i, s, n, o) {
            return s ? t.effects.animateClass.call(this, {
              add: i
            }, s, n, o) : e.apply(this, arguments)
          }
        }(t.fn.addClass),
        removeClass: function(e) {
          return function(i, s, n, o) {
            return arguments.length > 1 ? t.effects.animateClass.call(this, {
              remove: i
            }, s, n, o) : e.apply(this, arguments)
          }
        }(t.fn.removeClass),
        toggleClass: function(e) {
          return function(i, s, n, o, r) {
            return "boolean" == typeof s || void 0 === s ? n ? t.effects.animateClass.call(this, s ? {
              add: i
            } : {
              remove: i
            }, n, o, r) : e.apply(this, arguments) : t.effects.animateClass.call(this, {
              toggle: i
            }, s, n, o)
          }
        }(t.fn.toggleClass),
        switchClass: function(e, i, s, n, o) {
          return t.effects.animateClass.call(this, {
            add: i,
            remove: e
          }, s, n, o)
        }
      })
    }(),
    function() {
      function e(e, i, s, n) {
        return t.isPlainObject(e) && (i = e, e = e.effect), e = {
          effect: e
        }, null == i && (i = {}), t.isFunction(i) && (n = i, s = null, i = {}), ("number" == typeof i || t.fx.speeds[i]) && (n = s, s = i, i = {}), t.isFunction(s) && (n = s, s = null), i && t.extend(e, i), s = s || i.duration, e.duration = t.fx.off ? 0 : "number" == typeof s ? s : s in t.fx.speeds ? t.fx.speeds[s] : t.fx.speeds._default, e.complete = n || i.complete, e
      }

      function i(e) {
        return !(e && "number" != typeof e && !t.fx.speeds[e]) || ("string" == typeof e && !t.effects.effect[e] || (!!t.isFunction(e) || "object" == typeof e && !e.effect))
      }

      function s(t, e) {
        var i = e.outerWidth(),
          s = e.outerHeight(),
          n = /^rect\((-?\d*\.?\d*px|-?\d+%|auto),?\s*(-?\d*\.?\d*px|-?\d+%|auto),?\s*(-?\d*\.?\d*px|-?\d+%|auto),?\s*(-?\d*\.?\d*px|-?\d+%|auto)\)$/,
          o = n.exec(t) || ["", 0, i, s, 0];
        return {
          top: parseFloat(o[1]) || 0,
          right: "auto" === o[2] ? i : parseFloat(o[2]),
          bottom: "auto" === o[3] ? s : parseFloat(o[3]),
          left: parseFloat(o[4]) || 0
        }
      }
      t.expr && t.expr.filters && t.expr.filters.animated && (t.expr.filters.animated = function(e) {
        return function(i) {
          return !!t(i).data(c) || e(i)
        }
      }(t.expr.filters.animated)), !1 !== t.uiBackCompat && t.extend(t.effects, {
        save: function(t, e) {
          for (var i = 0, s = e.length; i < s; i++) null !== e[i] && t.data("ui-effects-" + e[i], t[0].style[e[i]])
        },
        restore: function(t, e) {
          for (var i, s = 0, n = e.length; s < n; s++) null !== e[s] && (i = t.data("ui-effects-" + e[s]), t.css(e[s], i))
        },
        setMode: function(t, e) {
          return "toggle" === e && (e = t.is(":hidden") ? "show" : "hide"), e
        },
        createWrapper: function(e) {
          if (e.parent().is(".ui-effects-wrapper")) return e.parent();
          var i = {
              width: e.outerWidth(!0),
              height: e.outerHeight(!0),
              float: e.css("float")
            },
            s = t("<div></div>").addClass("ui-effects-wrapper").css({
              fontSize: "100%",
              background: "transparent",
              border: "none",
              margin: 0,
              padding: 0
            }),
            n = {
              width: e.width(),
              height: e.height()
            },
            o = document.activeElement;
          try {
            o.id
          } catch (t) {
            o = document.body
          }
          return e.wrap(s), (e[0] === o || t.contains(e[0], o)) && t(o).trigger("focus"), s = e.parent(), "static" === e.css("position") ? (s.css({
            position: "relative"
          }), e.css({
            position: "relative"
          })) : (t.extend(i, {
            position: e.css("position"),
            zIndex: e.css("z-index")
          }), t.each(["top", "left", "bottom", "right"], function(t, s) {
            i[s] = e.css(s), isNaN(parseInt(i[s], 10)) && (i[s] = "auto")
          }), e.css({
            position: "relative",
            top: 0,
            left: 0,
            right: "auto",
            bottom: "auto"
          })), e.css(n), s.css(i).show()
        },
        removeWrapper: function(e) {
          var i = document.activeElement;
          return e.parent().is(".ui-effects-wrapper") && (e.parent().replaceWith(e), (e[0] === i || t.contains(e[0], i)) && t(i).trigger("focus")), e
        }
      }), t.extend(t.effects, {
        version: "1.12.1",
        define: function(e, i, s) {
          return s || (s = i, i = "effect"), t.effects.effect[e] = s, t.effects.effect[e].mode = i, s
        },
        scaledDimensions: function(t, e, i) {
          if (0 === e) return {
            height: 0,
            width: 0,
            outerHeight: 0,
            outerWidth: 0
          };
          var s = "horizontal" !== i ? (e || 100) / 100 : 1,
            n = "vertical" !== i ? (e || 100) / 100 : 1;
          return {
            height: t.height() * n,
            width: t.width() * s,
            outerHeight: t.outerHeight() * n,
            outerWidth: t.outerWidth() * s
          }
        },
        clipToBox: function(t) {
          return {
            width: t.clip.right - t.clip.left,
            height: t.clip.bottom - t.clip.top,
            left: t.clip.left,
            top: t.clip.top
          }
        },
        unshift: function(t, e, i) {
          var s = t.queue();
          e > 1 && s.splice.apply(s, [1, 0].concat(s.splice(e, i))), t.dequeue()
        },
        saveStyle: function(t) {
          t.data("ui-effects-style", t[0].style.cssText)
        },
        restoreStyle: function(t) {
          t[0].style.cssText = t.data("ui-effects-style") || "", t.removeData("ui-effects-style")
        },
        mode: function(t, e) {
          var i = t.is(":hidden");
          return "toggle" === e && (e = i ? "show" : "hide"), (i ? "hide" === e : "show" === e) && (e = "none"), e
        },
        getBaseline: function(t, e) {
          var i, s;
          switch (t[0]) {
            case "top":
              i = 0;
              break;
            case "middle":
              i = .5;
              break;
            case "bottom":
              i = 1;
              break;
            default:
              i = t[0] / e.height
          }
          switch (t[1]) {
            case "left":
              s = 0;
              break;
            case "center":
              s = .5;
              break;
            case "right":
              s = 1;
              break;
            default:
              s = t[1] / e.width
          }
          return {
            x: s,
            y: i
          }
        },
        createPlaceholder: function(e) {
          var i, s = e.css("position"),
            n = e.position();
          return e.css({
            marginTop: e.css("marginTop"),
            marginBottom: e.css("marginBottom"),
            marginLeft: e.css("marginLeft"),
            marginRight: e.css("marginRight")
          }).outerWidth(e.outerWidth()).outerHeight(e.outerHeight()), /^(static|relative)/.test(s) && (s = "absolute", i = t("<" + e[0].nodeName + ">").insertAfter(e).css({
            display: /^(inline|ruby)/.test(e.css("display")) ? "inline-block" : "block",
            visibility: "hidden",
            marginTop: e.css("marginTop"),
            marginBottom: e.css("marginBottom"),
            marginLeft: e.css("marginLeft"),
            marginRight: e.css("marginRight"),
            float: e.css("float")
          }).outerWidth(e.outerWidth()).outerHeight(e.outerHeight()).addClass("ui-effects-placeholder"), e.data("ui-effects-placeholder", i)), e.css({
            position: s,
            left: n.left,
            top: n.top
          }), i
        },
        removePlaceholder: function(t) {
          var e = "ui-effects-placeholder",
            i = t.data(e);
          i && (i.remove(), t.removeData(e))
        },
        cleanUp: function(e) {
          t.effects.restoreStyle(e), t.effects.removePlaceholder(e)
        },
        setTransition: function(e, i, s, n) {
          return n = n || {}, t.each(i, function(t, i) {
            var o = e.cssUnit(i);
            o[0] > 0 && (n[i] = o[0] * s + o[1])
          }), n
        }
      }), t.fn.extend({
        effect: function() {
          function i(e) {
            function i() {
              a.removeData(c), t.effects.cleanUp(a), "hide" === s.mode && a.hide(), r()
            }

            function r() {
              t.isFunction(l) && l.call(a[0]), t.isFunction(e) && e()
            }
            var a = t(this);
            s.mode = u.shift(), !1 === t.uiBackCompat || o ? "none" === s.mode ? (a[h](), r()) : n.call(a[0], s, i) : (a.is(":hidden") ? "hide" === h : "show" === h) ? (a[h](), r()) : n.call(a[0], s, r)
          }
          var s = e.apply(this, arguments),
            n = t.effects.effect[s.effect],
            o = n.mode,
            r = s.queue,
            a = r || "fx",
            l = s.complete,
            h = s.mode,
            u = [],
            d = function(e) {
              var i = t(this),
                s = t.effects.mode(i, h) || o;
              i.data(c, !0), u.push(s), o && ("show" === s || s === o && "hide" === s) && i.show(), o && "none" === s || t.effects.saveStyle(i), t.isFunction(e) && e()
            };
          return t.fx.off || !n ? h ? this[h](s.duration, l) : this.each(function() {
            l && l.call(this)
          }) : !1 === r ? this.each(d).each(i) : this.queue(a, d).queue(a, i)
        },
        show: function(t) {
          return function(s) {
            if (i(s)) return t.apply(this, arguments);
            var n = e.apply(this, arguments);
            return n.mode = "show", this.effect.call(this, n)
          }
        }(t.fn.show),
        hide: function(t) {
          return function(s) {
            if (i(s)) return t.apply(this, arguments);
            var n = e.apply(this, arguments);
            return n.mode = "hide", this.effect.call(this, n)
          }
        }(t.fn.hide),
        toggle: function(t) {
          return function(s) {
            if (i(s) || "boolean" == typeof s) return t.apply(this, arguments);
            var n = e.apply(this, arguments);
            return n.mode = "toggle", this.effect.call(this, n)
          }
        }(t.fn.toggle),
        cssUnit: function(e) {
          var i = this.css(e),
            s = [];
          return t.each(["em", "px", "%", "pt"], function(t, e) {
            i.indexOf(e) > 0 && (s = [parseFloat(i), e])
          }), s
        },
        cssClip: function(t) {
          return t ? this.css("clip", "rect(" + t.top + "px " + t.right + "px " + t.bottom + "px " + t.left + "px)") : s(this.css("clip"), this)
        },
        transfer: function(e, i) {
          var s = t(this),
            n = t(e.to),
            o = "fixed" === n.css("position"),
            r = t("body"),
            a = o ? r.scrollTop() : 0,
            l = o ? r.scrollLeft() : 0,
            h = n.offset(),
            c = {
              top: h.top - a,
              left: h.left - l,
              height: n.innerHeight(),
              width: n.innerWidth()
            },
            u = s.offset(),
            d = t("<div class='ui-effects-transfer'></div>").appendTo("body").addClass(e.className).css({
              top: u.top - a,
              left: u.left - l,
              height: s.innerHeight(),
              width: s.innerWidth(),
              position: o ? "fixed" : "absolute"
            }).animate(c, e.duration, e.easing, function() {
              d.remove(), t.isFunction(i) && i()
            })
        }
      }), t.fx.step.clip = function(e) {
        e.clipInit || (e.start = t(e.elem).cssClip(), "string" == typeof e.end && (e.end = s(e.end, e.elem)), e.clipInit = !0), t(e.elem).cssClip({
          top: e.pos * (e.end.top - e.start.top) + e.start.top,
          right: e.pos * (e.end.right - e.start.right) + e.start.right,
          bottom: e.pos * (e.end.bottom - e.start.bottom) + e.start.bottom,
          left: e.pos * (e.end.left - e.start.left) + e.start.left
        })
      }
    }(),
    function() {
      var e = {};
      t.each(["Quad", "Cubic", "Quart", "Quint", "Expo"], function(t, i) {
        e[i] = function(e) {
          return Math.pow(e, t + 2)
        }
      }), t.extend(e, {
        Sine: function(t) {
          return 1 - Math.cos(t * Math.PI / 2)
        },
        Circ: function(t) {
          return 1 - Math.sqrt(1 - t * t)
        },
        Elastic: function(t) {
          return 0 === t || 1 === t ? t : -Math.pow(2, 8 * (t - 1)) * Math.sin((80 * (t - 1) - 7.5) * Math.PI / 15)
        },
        Back: function(t) {
          return t * t * (3 * t - 2)
        },
        Bounce: function(t) {
          for (var e, i = 4; t < ((e = Math.pow(2, --i)) - 1) / 11;);
          return 1 / Math.pow(4, 3 - i) - 7.5625 * Math.pow((3 * e - 2) / 22 - t, 2)
        }
      }), t.each(e, function(e, i) {
        t.easing["easeIn" + e] = i, t.easing["easeOut" + e] = function(t) {
          return 1 - i(1 - t)
        }, t.easing["easeInOut" + e] = function(t) {
          return t < .5 ? i(2 * t) / 2 : 1 - i(-2 * t + 2) / 2
        }
      })
    }();
  t.effects, t.effects.define("blind", "hide", function(e, i) {
    var s = {
        up: ["bottom", "top"],
        vertical: ["bottom", "top"],
        down: ["top", "bottom"],
        left: ["right", "left"],
        horizontal: ["right", "left"],
        right: ["left", "right"]
      },
      n = t(this),
      o = e.direction || "up",
      r = n.cssClip(),
      a = {
        clip: t.extend({}, r)
      },
      l = t.effects.createPlaceholder(n);
    a.clip[s[o][0]] = a.clip[s[o][1]], "show" === e.mode && (n.cssClip(a.clip), l && l.css(t.effects.clipToBox(a)), a.clip = r), l && l.animate(t.effects.clipToBox(a), e.duration, e.easing), n.animate(a, {
      queue: !1,
      duration: e.duration,
      easing: e.easing,
      complete: i
    })
  }), t.effects.define("bounce", function(e, i) {
    var s, n, o, r = t(this),
      a = e.mode,
      l = "hide" === a,
      h = "show" === a,
      c = e.direction || "up",
      u = e.distance,
      d = e.times || 5,
      p = 2 * d + (h || l ? 1 : 0),
      f = e.duration / p,
      g = e.easing,
      m = "up" === c || "down" === c ? "top" : "left",
      v = "up" === c || "left" === c,
      b = 0,
      _ = r.queue().length;
    for (t.effects.createPlaceholder(r), o = r.css(m), u || (u = r["top" === m ? "outerHeight" : "outerWidth"]() / 3), h && (n = {
        opacity: 1
      }, n[m] = o, r.css("opacity", 0).css(m, v ? 2 * -u : 2 * u).animate(n, f, g)), l && (u /= Math.pow(2, d - 1)), n = {}, n[m] = o; b < d; b++) s = {}, s[m] = (v ? "-=" : "+=") + u, r.animate(s, f, g).animate(n, f, g), u = l ? 2 * u : u / 2;
    l && (s = {
      opacity: 0
    }, s[m] = (v ? "-=" : "+=") + u, r.animate(s, f, g)), r.queue(i), t.effects.unshift(r, _, p + 1)
  }), t.effects.define("clip", "hide", function(e, i) {
    var s, n = {},
      o = t(this),
      r = e.direction || "vertical",
      a = "both" === r,
      l = a || "horizontal" === r,
      h = a || "vertical" === r;
    s = o.cssClip(), n.clip = {
      top: h ? (s.bottom - s.top) / 2 : s.top,
      right: l ? (s.right - s.left) / 2 : s.right,
      bottom: h ? (s.bottom - s.top) / 2 : s.bottom,
      left: l ? (s.right - s.left) / 2 : s.left
    }, t.effects.createPlaceholder(o), "show" === e.mode && (o.cssClip(n.clip), n.clip = s), o.animate(n, {
      queue: !1,
      duration: e.duration,
      easing: e.easing,
      complete: i
    })
  }), t.effects.define("drop", "hide", function(e, i) {
    var s, n = t(this),
      o = e.mode,
      r = "show" === o,
      a = e.direction || "left",
      l = "up" === a || "down" === a ? "top" : "left",
      h = "up" === a || "left" === a ? "-=" : "+=",
      c = "+=" === h ? "-=" : "+=",
      u = {
        opacity: 0
      };
    t.effects.createPlaceholder(n), s = e.distance || n["top" === l ? "outerHeight" : "outerWidth"](!0) / 2, u[l] = h + s, r && (n.css(u), u[l] = c + s, u.opacity = 1), n.animate(u, {
      queue: !1,
      duration: e.duration,
      easing: e.easing,
      complete: i
    })
  }), t.effects.define("explode", "hide", function(e, i) {
    function s() {
      _.push(this), _.length === u * d && n()
    }

    function n() {
      p.css({
        visibility: "visible"
      }), t(_).remove(), i()
    }
    var o, r, a, l, h, c, u = e.pieces ? Math.round(Math.sqrt(e.pieces)) : 3,
      d = u,
      p = t(this),
      f = e.mode,
      g = "show" === f,
      m = p.show().css("visibility", "hidden").offset(),
      v = Math.ceil(p.outerWidth() / d),
      b = Math.ceil(p.outerHeight() / u),
      _ = [];
    for (o = 0; o < u; o++)
      for (l = m.top + o * b, c = o - (u - 1) / 2, r = 0; r < d; r++) a = m.left + r * v, h = r - (d - 1) / 2, p.clone().appendTo("body").wrap("<div></div>").css({
        position: "absolute",
        visibility: "visible",
        left: -r * v,
        top: -o * b
      }).parent().addClass("ui-effects-explode").css({
        position: "absolute",
        overflow: "hidden",
        width: v,
        height: b,
        left: a + (g ? h * v : 0),
        top: l + (g ? c * b : 0),
        opacity: g ? 0 : 1
      }).animate({
        left: a + (g ? 0 : h * v),
        top: l + (g ? 0 : c * b),
        opacity: g ? 1 : 0
      }, e.duration || 500, e.easing, s)
  }), t.effects.define("fade", "toggle", function(e, i) {
    var s = "show" === e.mode;
    t(this).css("opacity", s ? 0 : 1).animate({
      opacity: s ? 1 : 0
    }, {
      queue: !1,
      duration: e.duration,
      easing: e.easing,
      complete: i
    })
  }), t.effects.define("fold", "hide", function(e, i) {
    var s = t(this),
      n = e.mode,
      o = "show" === n,
      r = "hide" === n,
      a = e.size || 15,
      l = /([0-9]+)%/.exec(a),
      h = !!e.horizFirst,
      c = h ? ["right", "bottom"] : ["bottom", "right"],
      u = e.duration / 2,
      d = t.effects.createPlaceholder(s),
      p = s.cssClip(),
      f = {
        clip: t.extend({}, p)
      },
      g = {
        clip: t.extend({}, p)
      },
      m = [p[c[0]], p[c[1]]],
      v = s.queue().length;
    l && (a = parseInt(l[1], 10) / 100 * m[r ? 0 : 1]), f.clip[c[0]] = a, g.clip[c[0]] = a, g.clip[c[1]] = 0, o && (s.cssClip(g.clip), d && d.css(t.effects.clipToBox(g)), g.clip = p), s.queue(function(i) {
      d && d.animate(t.effects.clipToBox(f), u, e.easing).animate(t.effects.clipToBox(g), u, e.easing), i()
    }).animate(f, u, e.easing).animate(g, u, e.easing).queue(i), t.effects.unshift(s, v, 4)
  }), t.effects.define("highlight", "show", function(e, i) {
    var s = t(this),
      n = {
        backgroundColor: s.css("backgroundColor")
      };
    "hide" === e.mode && (n.opacity = 0), t.effects.saveStyle(s), s.css({
      backgroundImage: "none",
      backgroundColor: e.color || "#ffff99"
    }).animate(n, {
      queue: !1,
      duration: e.duration,
      easing: e.easing,
      complete: i
    })
  }), t.effects.define("size", function(e, i) {
    var s, n, o, r = t(this),
      a = ["fontSize"],
      l = ["borderTopWidth", "borderBottomWidth", "paddingTop", "paddingBottom"],
      h = ["borderLeftWidth", "borderRightWidth", "paddingLeft", "paddingRight"],
      c = e.mode,
      u = "effect" !== c,
      d = e.scale || "both",
      p = e.origin || ["middle", "center"],
      f = r.css("position"),
      g = r.position(),
      m = t.effects.scaledDimensions(r),
      v = e.from || m,
      b = e.to || t.effects.scaledDimensions(r, 0);
    t.effects.createPlaceholder(r), "show" === c && (o = v, v = b, b = o), n = {
      from: {
        y: v.height / m.height,
        x: v.width / m.width
      },
      to: {
        y: b.height / m.height,
        x: b.width / m.width
      }
    }, "box" !== d && "both" !== d || (n.from.y !== n.to.y && (v = t.effects.setTransition(r, l, n.from.y, v), b = t.effects.setTransition(r, l, n.to.y, b)), n.from.x !== n.to.x && (v = t.effects.setTransition(r, h, n.from.x, v), b = t.effects.setTransition(r, h, n.to.x, b))), "content" !== d && "both" !== d || n.from.y !== n.to.y && (v = t.effects.setTransition(r, a, n.from.y, v), b = t.effects.setTransition(r, a, n.to.y, b)), p && (s = t.effects.getBaseline(p, m), v.top = (m.outerHeight - v.outerHeight) * s.y + g.top, v.left = (m.outerWidth - v.outerWidth) * s.x + g.left, b.top = (m.outerHeight - b.outerHeight) * s.y + g.top, b.left = (m.outerWidth - b.outerWidth) * s.x + g.left), r.css(v), "content" !== d && "both" !== d || (l = l.concat(["marginTop", "marginBottom"]).concat(a), h = h.concat(["marginLeft", "marginRight"]), r.find("*[width]").each(function() {
      var i = t(this),
        s = t.effects.scaledDimensions(i),
        o = {
          height: s.height * n.from.y,
          width: s.width * n.from.x,
          outerHeight: s.outerHeight * n.from.y,
          outerWidth: s.outerWidth * n.from.x
        },
        r = {
          height: s.height * n.to.y,
          width: s.width * n.to.x,
          outerHeight: s.height * n.to.y,
          outerWidth: s.width * n.to.x
        };
      n.from.y !== n.to.y && (o = t.effects.setTransition(i, l, n.from.y, o), r = t.effects.setTransition(i, l, n.to.y, r)), n.from.x !== n.to.x && (o = t.effects.setTransition(i, h, n.from.x, o), r = t.effects.setTransition(i, h, n.to.x, r)), u && t.effects.saveStyle(i), i.css(o), i.animate(r, e.duration, e.easing, function() {
        u && t.effects.restoreStyle(i)
      })
    })), r.animate(b, {
      queue: !1,
      duration: e.duration,
      easing: e.easing,
      complete: function() {
        var e = r.offset();
        0 === b.opacity && r.css("opacity", v.opacity), u || (r.css("position", "static" === f ? "relative" : f).offset(e), t.effects.saveStyle(r)), i()
      }
    })
  }), t.effects.define("scale", function(e, i) {
    var s = t(this),
      n = e.mode,
      o = parseInt(e.percent, 10) || (0 === parseInt(e.percent, 10) ? 0 : "effect" !== n ? 0 : 100),
      r = t.extend(!0, {
        from: t.effects.scaledDimensions(s),
        to: t.effects.scaledDimensions(s, o, e.direction || "both"),
        origin: e.origin || ["middle", "center"]
      }, e);
    e.fade && (r.from.opacity = 1, r.to.opacity = 0), t.effects.effect.size.call(this, r, i)
  }), t.effects.define("puff", "hide", function(e, i) {
    var s = t.extend(!0, {}, e, {
      fade: !0,
      percent: parseInt(e.percent, 10) || 150
    });
    t.effects.effect.scale.call(this, s, i)
  }), t.effects.define("pulsate", "show", function(e, i) {
    var s = t(this),
      n = e.mode,
      o = "show" === n,
      r = "hide" === n,
      a = o || r,
      l = 2 * (e.times || 5) + (a ? 1 : 0),
      h = e.duration / l,
      c = 0,
      u = 1,
      d = s.queue().length;
    for (!o && s.is(":visible") || (s.css("opacity", 0).show(), c = 1); u < l; u++) s.animate({
      opacity: c
    }, h, e.easing), c = 1 - c;
    s.animate({
      opacity: c
    }, h, e.easing), s.queue(i), t.effects.unshift(s, d, l + 1)
  }), t.effects.define("shake", function(e, i) {
    var s = 1,
      n = t(this),
      o = e.direction || "left",
      r = e.distance || 20,
      a = e.times || 3,
      l = 2 * a + 1,
      h = Math.round(e.duration / l),
      c = "up" === o || "down" === o ? "top" : "left",
      u = "up" === o || "left" === o,
      d = {},
      p = {},
      f = {},
      g = n.queue().length;
    for (t.effects.createPlaceholder(n), d[c] = (u ? "-=" : "+=") + r, p[c] = (u ? "+=" : "-=") + 2 * r, f[c] = (u ? "-=" : "+=") + 2 * r, n.animate(d, h, e.easing); s < a; s++) n.animate(p, h, e.easing).animate(f, h, e.easing);
    n.animate(p, h, e.easing).animate(d, h / 2, e.easing).queue(i), t.effects.unshift(n, g, l + 1)
  }), t.effects.define("slide", "show", function(e, i) {
    var s, n, o = t(this),
      r = {
        up: ["bottom", "top"],
        down: ["top", "bottom"],
        left: ["right", "left"],
        right: ["left", "right"]
      },
      a = e.mode,
      l = e.direction || "left",
      h = "up" === l || "down" === l ? "top" : "left",
      c = "up" === l || "left" === l,
      u = e.distance || o["top" === h ? "outerHeight" : "outerWidth"](!0),
      d = {};
    t.effects.createPlaceholder(o), s = o.cssClip(), n = o.position()[h], d[h] = (c ? -1 : 1) * u + n, d.clip = o.cssClip(), d.clip[r[l][1]] = d.clip[r[l][0]], "show" === a && (o.cssClip(d.clip), o.css(h, d[h]), d.clip = s, d[h] = n), o.animate(d, {
      queue: !1,
      duration: e.duration,
      easing: e.easing,
      complete: i
    })
  });
  !1 !== t.uiBackCompat && t.effects.define("transfer", function(e, i) {
    t(this).transfer(e, i)
  });
  t.ui.focusable = function(i, s) {
    var n, o, r, a, l, h = i.nodeName.toLowerCase();
    return "area" === h ? (n = i.parentNode, o = n.name, !(!i.href || !o || "map" !== n.nodeName.toLowerCase()) && (r = t("img[usemap='#" + o + "']"), r.length > 0 && r.is(":visible"))) : (/^(input|select|textarea|button|object)$/.test(h) ? (a = !i.disabled) && (l = t(i).closest("fieldset")[0]) && (a = !l.disabled) : a = "a" === h ? i.href || s : s, a && t(i).is(":visible") && e(t(i)))
  }, t.extend(t.expr[":"], {
    focusable: function(e) {
      return t.ui.focusable(e, null != t.attr(e, "tabindex"))
    }
  });
  t.ui.focusable, t.fn.form = function() {
    return "string" == typeof this[0].form ? this.closest("form") : t(this[0].form)
  }, t.ui.formResetMixin = {
    _formResetHandler: function() {
      var e = t(this);
      setTimeout(function() {
        var i = e.data("ui-form-reset-instances");
        t.each(i, function() {
          this.refresh()
        })
      })
    },
    _bindFormResetHandler: function() {
      if (this.form = this.element.form(), this.form.length) {
        var t = this.form.data("ui-form-reset-instances") || [];
        t.length || this.form.on("reset.ui-form-reset", this._formResetHandler), t.push(this), this.form.data("ui-form-reset-instances", t)
      }
    },
    _unbindFormResetHandler: function() {
      if (this.form.length) {
        var e = this.form.data("ui-form-reset-instances");
        e.splice(t.inArray(this, e), 1), e.length ? this.form.data("ui-form-reset-instances", e) : this.form.removeData("ui-form-reset-instances").off("reset.ui-form-reset")
      }
    }
  };
  "1.7" === t.fn.jquery.substring(0, 3) && (t.each(["Width", "Height"], function(e, i) {
    function s(e, i, s, o) {
      return t.each(n, function() {
        i -= parseFloat(t.css(e, "padding" + this)) || 0, s && (i -= parseFloat(t.css(e, "border" + this + "Width")) || 0), o && (i -= parseFloat(t.css(e, "margin" + this)) || 0)
      }), i
    }
    var n = "Width" === i ? ["Left", "Right"] : ["Top", "Bottom"],
      o = i.toLowerCase(),
      r = {
        innerWidth: t.fn.innerWidth,
        innerHeight: t.fn.innerHeight,
        outerWidth: t.fn.outerWidth,
        outerHeight: t.fn.outerHeight
      };
    t.fn["inner" + i] = function(e) {
      return void 0 === e ? r["inner" + i].call(this) : this.each(function() {
        t(this).css(o, s(this, e) + "px")
      })
    }, t.fn["outer" + i] = function(e, n) {
      return "number" != typeof e ? r["outer" + i].call(this, e) : this.each(function() {
        t(this).css(o, s(this, e, !0, n) + "px")
      })
    }
  }), t.fn.addBack = function(t) {
    return this.add(null == t ? this.prevObject : this.prevObject.filter(t))
  });
  t.ui.keyCode = {
    BACKSPACE: 8,
    COMMA: 188,
    DELETE: 46,
    DOWN: 40,
    END: 35,
    ENTER: 13,
    ESCAPE: 27,
    HOME: 36,
    LEFT: 37,
    PAGE_DOWN: 34,
    PAGE_UP: 33,
    PERIOD: 190,
    RIGHT: 39,
    SPACE: 32,
    TAB: 9,
    UP: 38
  }, t.ui.escapeSelector = function() {
    return function(t) {
      return t.replace(/([!"#$%&'()*+,.\/:;<=>?@[\]^`{|}~])/g, "\\$1")
    }
  }(), t.fn.labels = function() {
    var e, i, s, n, o;
    return this[0].labels && this[0].labels.length ? this.pushStack(this[0].labels) : (n = this.eq(0).parents("label"), s = this.attr("id"), s && (e = this.eq(0).parents().last(), o = e.add(e.length ? e.siblings() : this.siblings()), i = "label[for='" + t.ui.escapeSelector(s) + "']", n = n.add(o.find(i).addBack(i))), this.pushStack(n))
  }, t.fn.scrollParent = function(e) {
    var i = this.css("position"),
      s = "absolute" === i,
      n = e ? /(auto|scroll|hidden)/ : /(auto|scroll)/,
      o = this.parents().filter(function() {
        var e = t(this);
        return (!s || "static" !== e.css("position")) && n.test(e.css("overflow") + e.css("overflow-y") + e.css("overflow-x"))
      }).eq(0);
    return "fixed" !== i && o.length ? o : t(this[0].ownerDocument || document)
  }, t.extend(t.expr[":"], {
    tabbable: function(e) {
      var i = t.attr(e, "tabindex"),
        s = null != i;
      return (!s || i >= 0) && t.ui.focusable(e, s)
    }
  }), t.fn.extend({
    uniqueId: function() {
      var t = 0;
      return function() {
        return this.each(function() {
          this.id || (this.id = "ui-id-" + ++t)
        })
      }
    }(),
    removeUniqueId: function() {
      return this.each(function() {
        /^ui-id-\d+$/.test(this.id) && t(this).removeAttr("id")
      })
    }
  }), t.widget("ui.accordion", {
    version: "1.12.1",
    options: {
      active: 0,
      animate: {},
      classes: {
        "ui-accordion-header": "ui-corner-top",
        "ui-accordion-header-collapsed": "ui-corner-all",
        "ui-accordion-content": "ui-corner-bottom"
      },
      collapsible: !1,
      event: "click",
      header: "> li > :first-child, > :not(li):even",
      heightStyle: "auto",
      icons: {
        activeHeader: "ui-icon-triangle-1-s",
        header: "ui-icon-triangle-1-e"
      },
      activate: null,
      beforeActivate: null
    },
    hideProps: {
      borderTopWidth: "hide",
      borderBottomWidth: "hide",
      paddingTop: "hide",
      paddingBottom: "hide",
      height: "hide"
    },
    showProps: {
      borderTopWidth: "show",
      borderBottomWidth: "show",
      paddingTop: "show",
      paddingBottom: "show",
      height: "show"
    },
    _create: function() {
      var e = this.options;
      this.prevShow = this.prevHide = t(), this._addClass("ui-accordion", "ui-widget ui-helper-reset"), this.element.attr("role", "tablist"), e.collapsible || !1 !== e.active && null != e.active || (e.active = 0), this._processPanels(), e.active < 0 && (e.active += this.headers.length), this._refresh()
    },
    _getCreateEventData: function() {
      return {
        header: this.active,
        panel: this.active.length ? this.active.next() : t()
      }
    },
    _createIcons: function() {
      var e, i, s = this.options.icons;
      s && (e = t("<span>"), this._addClass(e, "ui-accordion-header-icon", "ui-icon " + s.header), e.prependTo(this.headers), i = this.active.children(".ui-accordion-header-icon"), this._removeClass(i, s.header)._addClass(i, null, s.activeHeader)._addClass(this.headers, "ui-accordion-icons"))
    },
    _destroyIcons: function() {
      this._removeClass(this.headers, "ui-accordion-icons"), this.headers.children(".ui-accordion-header-icon").remove()
    },
    _destroy: function() {
      var t;
      this.element.removeAttr("role"), this.headers.removeAttr("role aria-expanded aria-selected aria-controls tabIndex").removeUniqueId(), this._destroyIcons(), t = this.headers.next().css("display", "").removeAttr("role aria-hidden aria-labelledby").removeUniqueId(), "content" !== this.options.heightStyle && t.css("height", "")
    },
    _setOption: function(t, e) {
      if ("active" === t) return void this._activate(e);
      "event" === t && (this.options.event && this._off(this.headers, this.options.event), this._setupEvents(e)), this._super(t, e), "collapsible" !== t || e || !1 !== this.options.active || this._activate(0), "icons" === t && (this._destroyIcons(), e && this._createIcons())
    },
    _setOptionDisabled: function(t) {
      this._super(t), this.element.attr("aria-disabled", t), this._toggleClass(null, "ui-state-disabled", !!t), this._toggleClass(this.headers.add(this.headers.next()), null, "ui-state-disabled", !!t)
    },
    _keydown: function(e) {
      if (!e.altKey && !e.ctrlKey) {
        var i = t.ui.keyCode,
          s = this.headers.length,
          n = this.headers.index(e.target),
          o = !1;
        switch (e.keyCode) {
          case i.RIGHT:
          case i.DOWN:
            o = this.headers[(n + 1) % s];
            break;
          case i.LEFT:
          case i.UP:
            o = this.headers[(n - 1 + s) % s];
            break;
          case i.SPACE:
          case i.ENTER:
            this._eventHandler(e);
            break;
          case i.HOME:
            o = this.headers[0];
            break;
          case i.END:
            o = this.headers[s - 1]
        }
        o && (t(e.target).attr("tabIndex", -1), t(o).attr("tabIndex", 0), t(o).trigger("focus"), e.preventDefault())
      }
    },
    _panelKeyDown: function(e) {
      e.keyCode === t.ui.keyCode.UP && e.ctrlKey && t(e.currentTarget).prev().trigger("focus")
    },
    refresh: function() {
      var e = this.options;
      this._processPanels(), !1 === e.active && !0 === e.collapsible || !this.headers.length ? (e.active = !1, this.active = t()) : !1 === e.active ? this._activate(0) : this.active.length && !t.contains(this.element[0], this.active[0]) ? this.headers.length === this.headers.find(".ui-state-disabled").length ? (e.active = !1, this.active = t()) : this._activate(Math.max(0, e.active - 1)) : e.active = this.headers.index(this.active), this._destroyIcons(), this._refresh()
    },
    _processPanels: function() {
      var t = this.headers,
        e = this.panels;
      this.headers = this.element.find(this.options.header), this._addClass(this.headers, "ui-accordion-header ui-accordion-header-collapsed", "ui-state-default"), this.panels = this.headers.next().filter(":not(.ui-accordion-content-active)").hide(), this._addClass(this.panels, "ui-accordion-content", "ui-helper-reset ui-widget-content"), e && (this._off(t.not(this.headers)), this._off(e.not(this.panels)))
    },
    _refresh: function() {
      var e, i = this.options,
        s = i.heightStyle,
        n = this.element.parent();
      this.active = this._findActive(i.active), this._addClass(this.active, "ui-accordion-header-active", "ui-state-active")._removeClass(this.active, "ui-accordion-header-collapsed"), this._addClass(this.active.next(), "ui-accordion-content-active"), this.active.next().show(), this.headers.attr("role", "tab").each(function() {
        var e = t(this),
          i = e.uniqueId().attr("id"),
          s = e.next(),
          n = s.uniqueId().attr("id");
        e.attr("aria-controls", n), s.attr("aria-labelledby", i)
      }).next().attr("role", "tabpanel"), this.headers.not(this.active).attr({
        "aria-selected": "false",
        "aria-expanded": "false",
        tabIndex: -1
      }).next().attr({
        "aria-hidden": "true"
      }).hide(), this.active.length ? this.active.attr({
        "aria-selected": "true",
        "aria-expanded": "true",
        tabIndex: 0
      }).next().attr({
        "aria-hidden": "false"
      }) : this.headers.eq(0).attr("tabIndex", 0), this._createIcons(), this._setupEvents(i.event), "fill" === s ? (e = n.height(), this.element.siblings(":visible").each(function() {
        var i = t(this),
          s = i.css("position");
        "absolute" !== s && "fixed" !== s && (e -= i.outerHeight(!0))
      }), this.headers.each(function() {
        e -= t(this).outerHeight(!0)
      }), this.headers.next().each(function() {
        t(this).height(Math.max(0, e - t(this).innerHeight() + t(this).height()))
      }).css("overflow", "auto")) : "auto" === s && (e = 0, this.headers.next().each(function() {
        var i = t(this).is(":visible");
        i || t(this).show(), e = Math.max(e, t(this).css("height", "").height()), i || t(this).hide()
      }).height(e))
    },
    _activate: function(e) {
      var i = this._findActive(e)[0];
      i !== this.active[0] && (i = i || this.active[0], this._eventHandler({
        target: i,
        currentTarget: i,
        preventDefault: t.noop
      }))
    },
    _findActive: function(e) {
      return "number" == typeof e ? this.headers.eq(e) : t()
    },
    _setupEvents: function(e) {
      var i = {
        keydown: "_keydown"
      };
      e && t.each(e.split(" "), function(t, e) {
        i[e] = "_eventHandler"
      }), this._off(this.headers.add(this.headers.next())), this._on(this.headers, i), this._on(this.headers.next(), {
        keydown: "_panelKeyDown"
      }), this._hoverable(this.headers), this._focusable(this.headers)
    },
    _eventHandler: function(e) {
      var i, s, n = this.options,
        o = this.active,
        r = t(e.currentTarget),
        a = r[0] === o[0],
        l = a && n.collapsible,
        h = l ? t() : r.next(),
        c = o.next(),
        u = {
          oldHeader: o,
          oldPanel: c,
          newHeader: l ? t() : r,
          newPanel: h
        };
      e.preventDefault(), a && !n.collapsible || !1 === this._trigger("beforeActivate", e, u) || (n.active = !l && this.headers.index(r), this.active = a ? t() : r, this._toggle(u), this._removeClass(o, "ui-accordion-header-active", "ui-state-active"), n.icons && (i = o.children(".ui-accordion-header-icon"), this._removeClass(i, null, n.icons.activeHeader)._addClass(i, null, n.icons.header)), a || (this._removeClass(r, "ui-accordion-header-collapsed")._addClass(r, "ui-accordion-header-active", "ui-state-active"), n.icons && (s = r.children(".ui-accordion-header-icon"), this._removeClass(s, null, n.icons.header)._addClass(s, null, n.icons.activeHeader)), this._addClass(r.next(), "ui-accordion-content-active")))
    },
    _toggle: function(e) {
      var i = e.newPanel,
        s = this.prevShow.length ? this.prevShow : e.oldPanel;
      this.prevShow.add(this.prevHide).stop(!0, !0), this.prevShow = i, this.prevHide = s, this.options.animate ? this._animate(i, s, e) : (s.hide(), i.show(), this._toggleComplete(e)), s.attr({
        "aria-hidden": "true"
      }), s.prev().attr({
        "aria-selected": "false",
        "aria-expanded": "false"
      }), i.length && s.length ? s.prev().attr({
        tabIndex: -1,
        "aria-expanded": "false"
      }) : i.length && this.headers.filter(function() {
        return 0 === parseInt(t(this).attr("tabIndex"), 10)
      }).attr("tabIndex", -1), i.attr("aria-hidden", "false").prev().attr({
        "aria-selected": "true",
        "aria-expanded": "true",
        tabIndex: 0
      })
    },
    _animate: function(t, e, i) {
      var s, n, o, r = this,
        a = 0,
        l = t.css("box-sizing"),
        h = t.length && (!e.length || t.index() < e.index()),
        c = this.options.animate || {},
        u = h && c.down || c,
        d = function() {
          r._toggleComplete(i)
        };
      return "number" == typeof u && (o = u), "string" == typeof u && (n = u), n = n || u.easing || c.easing, o = o || u.duration || c.duration, e.length ? t.length ? (s = t.show().outerHeight(), e.animate(this.hideProps, {
        duration: o,
        easing: n,
        step: function(t, e) {
          e.now = Math.round(t)
        }
      }), void t.hide().animate(this.showProps, {
        duration: o,
        easing: n,
        complete: d,
        step: function(t, i) {
          i.now = Math.round(t), "height" !== i.prop ? "content-box" === l && (a += i.now) : "content" !== r.options.heightStyle && (i.now = Math.round(s - e.outerHeight() - a), a = 0)
        }
      })) : e.animate(this.hideProps, o, n, d) : t.animate(this.showProps, o, n, d)
    },
    _toggleComplete: function(t) {
      var e = t.oldPanel,
        i = e.prev();
      this._removeClass(e, "ui-accordion-content-active"), this._removeClass(i, "ui-accordion-header-active")._addClass(i, "ui-accordion-header-collapsed"), e.length && (e.parent()[0].className = e.parent()[0].className), this._trigger("activate", null, t)
    }
  }), t.ui.safeActiveElement = function(t) {
    var e;
    try {
      e = t.activeElement
    } catch (i) {
      e = t.body
    }
    return e || (e = t.body), e.nodeName || (e = t.body), e
  }, t.widget("ui.menu", {
    version: "1.12.1",
    defaultElement: "<ul>",
    delay: 300,
    options: {
      icons: {
        submenu: "ui-icon-caret-1-e"
      },
      items: "> *",
      menus: "ul",
      position: {
        my: "left top",
        at: "right top"
      },
      role: "menu",
      blur: null,
      focus: null,
      select: null
    },
    _create: function() {
      this.activeMenu = this.element, this.mouseHandled = !1, this.element.uniqueId().attr({
        role: this.options.role,
        tabIndex: 0
      }), this._addClass("ui-menu", "ui-widget ui-widget-content"), this._on({
        "mousedown .ui-menu-item": function(t) {
          t.preventDefault()
        },
        "click .ui-menu-item": function(e) {
          var i = t(e.target),
            s = t(t.ui.safeActiveElement(this.document[0]));
          !this.mouseHandled && i.not(".ui-state-disabled").length && (this.select(e), e.isPropagationStopped() || (this.mouseHandled = !0), i.has(".ui-menu").length ? this.expand(e) : !this.element.is(":focus") && s.closest(".ui-menu").length && (this.element.trigger("focus", [!0]), this.active && 1 === this.active.parents(".ui-menu").length && clearTimeout(this.timer)))
        },
        "mouseenter .ui-menu-item": function(e) {
          if (!this.previousFilter) {
            var i = t(e.target).closest(".ui-menu-item"),
              s = t(e.currentTarget);
            i[0] === s[0] && (this._removeClass(s.siblings().children(".ui-state-active"), null, "ui-state-active"), this.focus(e, s))
          }
        },
        mouseleave: "collapseAll",
        "mouseleave .ui-menu": "collapseAll",
        focus: function(t, e) {
          var i = this.active || this.element.find(this.options.items).eq(0);
          e || this.focus(t, i)
        },
        blur: function(e) {
          this._delay(function() {
            !t.contains(this.element[0], t.ui.safeActiveElement(this.document[0])) && this.collapseAll(e)
          })
        },
        keydown: "_keydown"
      }), this.refresh(), this._on(this.document, {
        click: function(t) {
          this._closeOnDocumentClick(t) && this.collapseAll(t), this.mouseHandled = !1
        }
      })
    },
    _destroy: function() {
      var e = this.element.find(".ui-menu-item").removeAttr("role aria-disabled"),
        i = e.children(".ui-menu-item-wrapper").removeUniqueId().removeAttr("tabIndex role aria-haspopup");
      this.element.removeAttr("aria-activedescendant").find(".ui-menu").addBack().removeAttr("role aria-labelledby aria-expanded aria-hidden aria-disabled tabIndex").removeUniqueId().show(), i.children().each(function() {
        var e = t(this);
        e.data("ui-menu-submenu-caret") && e.remove()
      })
    },
    _keydown: function(e) {
      var i, s, n, o, r = !0;
      switch (e.keyCode) {
        case t.ui.keyCode.PAGE_UP:
          this.previousPage(e);
          break;
        case t.ui.keyCode.PAGE_DOWN:
          this.nextPage(e);
          break;
        case t.ui.keyCode.HOME:
          this._move("first", "first", e);
          break;
        case t.ui.keyCode.END:
          this._move("last", "last", e);
          break;
        case t.ui.keyCode.UP:
          this.previous(e);
          break;
        case t.ui.keyCode.DOWN:
          this.next(e);
          break;
        case t.ui.keyCode.LEFT:
          this.collapse(e);
          break;
        case t.ui.keyCode.RIGHT:
          this.active && !this.active.is(".ui-state-disabled") && this.expand(e);
          break;
        case t.ui.keyCode.ENTER:
        case t.ui.keyCode.SPACE:
          this._activate(e);
          break;
        case t.ui.keyCode.ESCAPE:
          this.collapse(e);
          break;
        default:
          r = !1, s = this.previousFilter || "", o = !1, n = e.keyCode >= 96 && e.keyCode <= 105 ? (e.keyCode - 96).toString() : String.fromCharCode(e.keyCode), clearTimeout(this.filterTimer), n === s ? o = !0 : n = s + n, i = this._filterMenuItems(n), i = o && -1 !== i.index(this.active.next()) ? this.active.nextAll(".ui-menu-item") : i, i.length || (n = String.fromCharCode(e.keyCode), i = this._filterMenuItems(n)), i.length ? (this.focus(e, i), this.previousFilter = n, this.filterTimer = this._delay(function() {
            delete this.previousFilter
          }, 1e3)) : delete this.previousFilter
      }
      r && e.preventDefault()
    },
    _activate: function(t) {
      this.active && !this.active.is(".ui-state-disabled") && (this.active.children("[aria-haspopup='true']").length ? this.expand(t) : this.select(t))
    },
    refresh: function() {
      var e, i, s, n, o, r = this,
        a = this.options.icons.submenu,
        l = this.element.find(this.options.menus);
      this._toggleClass("ui-menu-icons", null, !!this.element.find(".ui-icon").length), s = l.filter(":not(.ui-menu)").hide().attr({
        role: this.options.role,
        "aria-hidden": "true",
        "aria-expanded": "false"
      }).each(function() {
        var e = t(this),
          i = e.prev(),
          s = t("<span>").data("ui-menu-submenu-caret", !0);
        r._addClass(s, "ui-menu-icon", "ui-icon " + a), i.attr("aria-haspopup", "true").prepend(s), e.attr("aria-labelledby", i.attr("id"))
      }), this._addClass(s, "ui-menu", "ui-widget ui-widget-content ui-front"), e = l.add(this.element), i = e.find(this.options.items), i.not(".ui-menu-item").each(function() {
        var e = t(this);
        r._isDivider(e) && r._addClass(e, "ui-menu-divider", "ui-widget-content")
      }), n = i.not(".ui-menu-item, .ui-menu-divider"), o = n.children().not(".ui-menu").uniqueId().attr({
        tabIndex: -1,
        role: this._itemRole()
      }), this._addClass(n, "ui-menu-item")._addClass(o, "ui-menu-item-wrapper"), i.filter(".ui-state-disabled").attr("aria-disabled", "true"), this.active && !t.contains(this.element[0], this.active[0]) && this.blur()
    },
    _itemRole: function() {
      return {
        menu: "menuitem",
        listbox: "option"
      }[this.options.role]
    },
    _setOption: function(t, e) {
      if ("icons" === t) {
        var i = this.element.find(".ui-menu-icon");
        this._removeClass(i, null, this.options.icons.submenu)._addClass(i, null, e.submenu)
      }
      this._super(t, e)
    },
    _setOptionDisabled: function(t) {
      this._super(t), this.element.attr("aria-disabled", String(t)), this._toggleClass(null, "ui-state-disabled", !!t)
    },
    focus: function(t, e) {
      var i, s, n;
      this.blur(t, t && "focus" === t.type), this._scrollIntoView(e), this.active = e.first(), s = this.active.children(".ui-menu-item-wrapper"), this._addClass(s, null, "ui-state-active"), this.options.role && this.element.attr("aria-activedescendant", s.attr("id")), n = this.active.parent().closest(".ui-menu-item").children(".ui-menu-item-wrapper"), this._addClass(n, null, "ui-state-active"), t && "keydown" === t.type ? this._close() : this.timer = this._delay(function() {
        this._close()
      }, this.delay), i = e.children(".ui-menu"), i.length && t && /^mouse/.test(t.type) && this._startOpening(i), this.activeMenu = e.parent(), this._trigger("focus", t, {
        item: e
      })
    },
    _scrollIntoView: function(e) {
      var i, s, n, o, r, a;
      this._hasScroll() && (i = parseFloat(t.css(this.activeMenu[0], "borderTopWidth")) || 0, s = parseFloat(t.css(this.activeMenu[0], "paddingTop")) || 0, n = e.offset().top - this.activeMenu.offset().top - i - s, o = this.activeMenu.scrollTop(), r = this.activeMenu.height(), a = e.outerHeight(), n < 0 ? this.activeMenu.scrollTop(o + n) : n + a > r && this.activeMenu.scrollTop(o + n - r + a))
    },
    blur: function(t, e) {
      e || clearTimeout(this.timer), this.active && (this._removeClass(this.active.children(".ui-menu-item-wrapper"), null, "ui-state-active"), this._trigger("blur", t, {
        item: this.active
      }), this.active = null)
    },
    _startOpening: function(t) {
      clearTimeout(this.timer), "true" === t.attr("aria-hidden") && (this.timer = this._delay(function() {
        this._close(), this._open(t)
      }, this.delay))
    },
    _open: function(e) {
      var i = t.extend({
        of: this.active
      }, this.options.position);
      clearTimeout(this.timer), this.element.find(".ui-menu").not(e.parents(".ui-menu")).hide().attr("aria-hidden", "true"), e.show().removeAttr("aria-hidden").attr("aria-expanded", "true").position(i)
    },
    collapseAll: function(e, i) {
      clearTimeout(this.timer), this.timer = this._delay(function() {
        var s = i ? this.element : t(e && e.target).closest(this.element.find(".ui-menu"));
        s.length || (s = this.element), this._close(s), this.blur(e), this._removeClass(s.find(".ui-state-active"), null, "ui-state-active"), this.activeMenu = s
      }, this.delay)
    },
    _close: function(t) {
      t || (t = this.active ? this.active.parent() : this.element), t.find(".ui-menu").hide().attr("aria-hidden", "true").attr("aria-expanded", "false")
    },
    _closeOnDocumentClick: function(e) {
      return !t(e.target).closest(".ui-menu").length
    },
    _isDivider: function(t) {
      return !/[^\-\u2014\u2013\s]/.test(t.text())
    },
    collapse: function(t) {
      var e = this.active && this.active.parent().closest(".ui-menu-item", this.element);
      e && e.length && (this._close(), this.focus(t, e))
    },
    expand: function(t) {
      var e = this.active && this.active.children(".ui-menu ").find(this.options.items).first();
      e && e.length && (this._open(e.parent()), this._delay(function() {
        this.focus(t, e)
      }))
    },
    next: function(t) {
      this._move("next", "first", t)
    },
    previous: function(t) {
      this._move("prev", "last", t)
    },
    isFirstItem: function() {
      return this.active && !this.active.prevAll(".ui-menu-item").length
    },
    isLastItem: function() {
      return this.active && !this.active.nextAll(".ui-menu-item").length
    },
    _move: function(t, e, i) {
      var s;
      this.active && (s = "first" === t || "last" === t ? this.active["first" === t ? "prevAll" : "nextAll"](".ui-menu-item").eq(-1) : this.active[t + "All"](".ui-menu-item").eq(0)), s && s.length && this.active || (s = this.activeMenu.find(this.options.items)[e]()), this.focus(i, s)
    },
    nextPage: function(e) {
      var i, s, n;
      if (!this.active) return void this.next(e);
      this.isLastItem() || (this._hasScroll() ? (s = this.active.offset().top, n = this.element.height(), this.active.nextAll(".ui-menu-item").each(function() {
        return i = t(this), i.offset().top - s - n < 0
      }), this.focus(e, i)) : this.focus(e, this.activeMenu.find(this.options.items)[this.active ? "last" : "first"]()))
    },
    previousPage: function(e) {
      var i, s, n;
      if (!this.active) return void this.next(e);
      this.isFirstItem() || (this._hasScroll() ? (s = this.active.offset().top, n = this.element.height(), this.active.prevAll(".ui-menu-item").each(function() {
        return i = t(this), i.offset().top - s + n > 0
      }), this.focus(e, i)) : this.focus(e, this.activeMenu.find(this.options.items).first()))
    },
    _hasScroll: function() {
      return this.element.outerHeight() < this.element.prop("scrollHeight")
    },
    select: function(e) {
      this.active = this.active || t(e.target).closest(".ui-menu-item");
      var i = {
        item: this.active
      };
      this.active.has(".ui-menu").length || this.collapseAll(e, !0), this._trigger("select", e, i)
    },
    _filterMenuItems: function(e) {
      var i = e.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&"),
        s = new RegExp("^" + i, "i");
      return this.activeMenu.find(this.options.items).filter(".ui-menu-item").filter(function() {
        return s.test(t.trim(t(this).children(".ui-menu-item-wrapper").text()))
      })
    }
  });
  t.widget("ui.autocomplete", {
    version: "1.12.1",
    defaultElement: "<input>",
    options: {
      appendTo: null,
      autoFocus: !1,
      delay: 300,
      minLength: 1,
      position: {
        my: "left top",
        at: "left bottom",
        collision: "none"
      },
      source: null,
      change: null,
      close: null,
      focus: null,
      open: null,
      response: null,
      search: null,
      select: null
    },
    requestIndex: 0,
    pending: 0,
    _create: function() {
      var e, i, s, n = this.element[0].nodeName.toLowerCase(),
        o = "textarea" === n,
        r = "input" === n;
      this.isMultiLine = o || !r && this._isContentEditable(this.element), this.valueMethod = this.element[o || r ? "val" : "text"], this.isNewMenu = !0, this._addClass("ui-autocomplete-input"), this.element.attr("autocomplete", "off"), this._on(this.element, {
        keydown: function(n) {
          if (this.element.prop("readOnly")) return e = !0, s = !0, void(i = !0);
          e = !1, s = !1, i = !1;
          var o = t.ui.keyCode;
          switch (n.keyCode) {
            case o.PAGE_UP:
              e = !0, this._move("previousPage", n);
              break;
            case o.PAGE_DOWN:
              e = !0, this._move("nextPage", n);
              break;
            case o.UP:
              e = !0, this._keyEvent("previous", n);
              break;
            case o.DOWN:
              e = !0, this._keyEvent("next", n);
              break;
            case o.ENTER:
              this.menu.active && (e = !0, n.preventDefault(), this.menu.select(n));
              break;
            case o.TAB:
              this.menu.active && this.menu.select(n);
              break;
            case o.ESCAPE:
              this.menu.element.is(":visible") && (this.isMultiLine || this._value(this.term), this.close(n), n.preventDefault());
              break;
            default:
              i = !0, this._searchTimeout(n)
          }
        },
        keypress: function(s) {
          if (e) return e = !1, void(this.isMultiLine && !this.menu.element.is(":visible") || s.preventDefault());
          if (!i) {
            var n = t.ui.keyCode;
            switch (s.keyCode) {
              case n.PAGE_UP:
                this._move("previousPage", s);
                break;
              case n.PAGE_DOWN:
                this._move("nextPage", s);
                break;
              case n.UP:
                this._keyEvent("previous", s);
                break;
              case n.DOWN:
                this._keyEvent("next", s)
            }
          }
        },
        input: function(t) {
          if (s) return s = !1, void t.preventDefault();
          this._searchTimeout(t)
        },
        focus: function() {
          this.selectedItem = null, this.previous = this._value()
        },
        blur: function(t) {
          if (this.cancelBlur) return void delete this.cancelBlur;
          clearTimeout(this.searching), this.close(t), this._change(t)
        }
      }), this._initSource(), this.menu = t("<ul>").appendTo(this._appendTo()).menu({
        role: null
      }).hide().menu("instance"), this._addClass(this.menu.element, "ui-autocomplete", "ui-front"), this._on(this.menu.element, {
        mousedown: function(e) {
          e.preventDefault(), this.cancelBlur = !0, this._delay(function() {
            delete this.cancelBlur, this.element[0] !== t.ui.safeActiveElement(this.document[0]) && this.element.trigger("focus")
          })
        },
        menufocus: function(e, i) {
          var s, n;
          if (this.isNewMenu && (this.isNewMenu = !1, e.originalEvent && /^mouse/.test(e.originalEvent.type))) return this.menu.blur(), void this.document.one("mousemove", function() {
            t(e.target).trigger(e.originalEvent)
          });
          n = i.item.data("ui-autocomplete-item"), !1 !== this._trigger("focus", e, {
            item: n
          }) && e.originalEvent && /^key/.test(e.originalEvent.type) && this._value(n.value), (s = i.item.attr("aria-label") || n.value) && t.trim(s).length && (this.liveRegion.children().hide(), t("<div>").text(s).appendTo(this.liveRegion))
        },
        menuselect: function(e, i) {
          var s = i.item.data("ui-autocomplete-item"),
            n = this.previous;
          this.element[0] !== t.ui.safeActiveElement(this.document[0]) && (this.element.trigger("focus"), this.previous = n, this._delay(function() {
            this.previous = n, this.selectedItem = s
          })), !1 !== this._trigger("select", e, {
            item: s
          }) && this._value(s.value), this.term = this._value(), this.close(e), this.selectedItem = s
        }
      }), this.liveRegion = t("<div>", {
        role: "status",
        "aria-live": "assertive",
        "aria-relevant": "additions"
      }).appendTo(this.document[0].body), this._addClass(this.liveRegion, null, "ui-helper-hidden-accessible"), this._on(this.window, {
        beforeunload: function() {
          this.element.removeAttr("autocomplete")
        }
      })
    },
    _destroy: function() {
      clearTimeout(this.searching), this.element.removeAttr("autocomplete"), this.menu.element.remove(), this.liveRegion.remove()
    },
    _setOption: function(t, e) {
      this._super(t, e), "source" === t && this._initSource(), "appendTo" === t && this.menu.element.appendTo(this._appendTo()), "disabled" === t && e && this.xhr && this.xhr.abort()
    },
    _isEventTargetInWidget: function(e) {
      var i = this.menu.element[0];
      return e.target === this.element[0] || e.target === i || t.contains(i, e.target)
    },
    _closeOnClickOutside: function(t) {
      this._isEventTargetInWidget(t) || this.close()
    },
    _appendTo: function() {
      var e = this.options.appendTo;
      return e && (e = e.jquery || e.nodeType ? t(e) : this.document.find(e).eq(0)), e && e[0] || (e = this.element.closest(".ui-front, dialog")), e.length || (e = this.document[0].body), e
    },
    _initSource: function() {
      var e, i, s = this;
      t.isArray(this.options.source) ? (e = this.options.source, this.source = function(i, s) {
        s(t.ui.autocomplete.filter(e, i.term))
      }) : "string" == typeof this.options.source ? (i = this.options.source, this.source = function(e, n) {
        s.xhr && s.xhr.abort(), s.xhr = t.ajax({
          url: i,
          data: e,
          dataType: "json",
          success: function(t) {
            n(t)
          },
          error: function() {
            n([])
          }
        })
      }) : this.source = this.options.source
    },
    _searchTimeout: function(t) {
      clearTimeout(this.searching), this.searching = this._delay(function() {
        var e = this.term === this._value(),
          i = this.menu.element.is(":visible"),
          s = t.altKey || t.ctrlKey || t.metaKey || t.shiftKey;
        e && (!e || i || s) || (this.selectedItem = null, this.search(null, t))
      }, this.options.delay)
    },
    search: function(t, e) {
      return t = null != t ? t : this._value(), this.term = this._value(), t.length < this.options.minLength ? this.close(e) : !1 !== this._trigger("search", e) ? this._search(t) : void 0
    },
    _search: function(t) {
      this.pending++, this._addClass("ui-autocomplete-loading"), this.cancelSearch = !1, this.source({
        term: t
      }, this._response())
    },
    _response: function() {
      var e = ++this.requestIndex;
      return t.proxy(function(t) {
        e === this.requestIndex && this.__response(t), --this.pending || this._removeClass("ui-autocomplete-loading")
      }, this)
    },
    __response: function(t) {
      t && (t = this._normalize(t)), this._trigger("response", null, {
        content: t
      }), !this.options.disabled && t && t.length && !this.cancelSearch ? (this._suggest(t), this._trigger("open")) : this._close()
    },
    close: function(t) {
      this.cancelSearch = !0, this._close(t)
    },
    _close: function(t) {
      this._off(this.document, "mousedown"), this.menu.element.is(":visible") && (this.menu.element.hide(), this.menu.blur(), this.isNewMenu = !0, this._trigger("close", t))
    },
    _change: function(t) {
      this.previous !== this._value() && this._trigger("change", t, {
        item: this.selectedItem
      })
    },
    _normalize: function(e) {
      return e.length && e[0].label && e[0].value ? e : t.map(e, function(e) {
        return "string" == typeof e ? {
          label: e,
          value: e
        } : t.extend({}, e, {
          label: e.label || e.value,
          value: e.value || e.label
        })
      })
    },
    _suggest: function(e) {
      var i = this.menu.element.empty();
      this._renderMenu(i, e), this.isNewMenu = !0, this.menu.refresh(), i.show(), this._resizeMenu(), i.position(t.extend({
        of: this.element
      }, this.options.position)), this.options.autoFocus && this.menu.next(), this._on(this.document, {
        mousedown: "_closeOnClickOutside"
      })
    },
    _resizeMenu: function() {
      var t = this.menu.element;
      t.outerWidth(Math.max(t.width("").outerWidth() + 1, this.element.outerWidth()))
    },
    _renderMenu: function(e, i) {
      var s = this;
      t.each(i, function(t, i) {
        s._renderItemData(e, i)
      })
    },
    _renderItemData: function(t, e) {
      return this._renderItem(t, e).data("ui-autocomplete-item", e)
    },
    _renderItem: function(e, i) {
      return t("<li>").append(t("<div>").text(i.label)).appendTo(e)
    },
    _move: function(t, e) {
      return this.menu.element.is(":visible") ? this.menu.isFirstItem() && /^previous/.test(t) || this.menu.isLastItem() && /^next/.test(t) ? (this.isMultiLine || this._value(this.term), void this.menu.blur()) : void this.menu[t](e) : void this.search(null, e)
    },
    widget: function() {
      return this.menu.element
    },
    _value: function() {
      return this.valueMethod.apply(this.element, arguments)
    },
    _keyEvent: function(t, e) {
      this.isMultiLine && !this.menu.element.is(":visible") || (this._move(t, e), e.preventDefault())
    },
    _isContentEditable: function(t) {
      if (!t.length) return !1;
      var e = t.prop("contentEditable");
      return "inherit" === e ? this._isContentEditable(t.parent()) : "true" === e
    }
  }), t.extend(t.ui.autocomplete, {
    escapeRegex: function(t) {
      return t.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&")
    },
    filter: function(e, i) {
      var s = new RegExp(t.ui.autocomplete.escapeRegex(i), "i");
      return t.grep(e, function(t) {
        return s.test(t.label || t.value || t)
      })
    }
  }), t.widget("ui.autocomplete", t.ui.autocomplete, {
    options: {
      messages: {
        noResults: "No search results.",
        results: function(t) {
          return t + (t > 1 ? " results are" : " result is") + " available, use up and down arrow keys to navigate."
        }
      }
    },
    __response: function(e) {
      var i;
      this._superApply(arguments), this.options.disabled || this.cancelSearch || (i = e && e.length ? this.options.messages.results(e.length) : this.options.messages.noResults, this.liveRegion.children().hide(), t("<div>").text(i).appendTo(this.liveRegion))
    }
  });
  t.ui.autocomplete, t.widget("ui.controlgroup", {
    version: "1.12.1",
    defaultElement: "<div>",
    options: {
      direction: "horizontal",
      disabled: null,
      onlyVisible: !0,
      items: {
        button: "input[type=button], input[type=submit], input[type=reset], button, a",
        controlgroupLabel: ".ui-controlgroup-label",
        checkboxradio: "input[type='checkbox'], input[type='radio']",
        selectmenu: "select",
        spinner: ".ui-spinner-input"
      }
    },
    _create: function() {
      this._enhance()
    },
    _enhance: function() {
      this.element.attr("role", "toolbar"), this.refresh()
    },
    _destroy: function() {
      this._callChildMethod("destroy"), this.childWidgets.removeData("ui-controlgroup-data"), this.element.removeAttr("role"), this.options.items.controlgroupLabel && this.element.find(this.options.items.controlgroupLabel).find(".ui-controlgroup-label-contents").contents().unwrap()
    },
    _initWidgets: function() {
      var e = this,
        i = [];
      t.each(this.options.items, function(s, n) {
        var o, r = {};
        if (n) return "controlgroupLabel" === s ? (o = e.element.find(n), o.each(function() {
          var e = t(this);
          e.children(".ui-controlgroup-label-contents").length || e.contents().wrapAll("<span class='ui-controlgroup-label-contents'></span>")
        }), e._addClass(o, null, "ui-widget ui-widget-content ui-state-default"), void(i = i.concat(o.get()))) : void(t.fn[s] && (r = e["_" + s + "Options"] ? e["_" + s + "Options"]("middle") : {
          classes: {}
        }, e.element.find(n).each(function() {
          var n = t(this),
            o = n[s]("instance"),
            a = t.widget.extend({}, r);
          if ("button" !== s || !n.parent(".ui-spinner").length) {
            o || (o = n[s]()[s]("instance")), o && (a.classes = e._resolveClassesValues(a.classes, o)), n[s](a);
            var l = n[s]("widget");
            t.data(l[0], "ui-controlgroup-data", o || n[s]("instance")), i.push(l[0])
          }
        })))
      }), this.childWidgets = t(t.unique(i)), this._addClass(this.childWidgets, "ui-controlgroup-item")
    },
    _callChildMethod: function(e) {
      this.childWidgets.each(function() {
        var i = t(this),
          s = i.data("ui-controlgroup-data");
        s && s[e] && s[e]()
      })
    },
    _updateCornerClass: function(t, e) {
      var i = this._buildSimpleOptions(e, "label").classes.label;
      this._removeClass(t, null, "ui-corner-top ui-corner-bottom ui-corner-left ui-corner-right ui-corner-all"), this._addClass(t, null, i)
    },
    _buildSimpleOptions: function(t, e) {
      var i = "vertical" === this.options.direction,
        s = {
          classes: {}
        };
      return s.classes[e] = {
        middle: "",
        first: "ui-corner-" + (i ? "top" : "left"),
        last: "ui-corner-" + (i ? "bottom" : "right"),
        only: "ui-corner-all"
      }[t], s
    },
    _spinnerOptions: function(t) {
      var e = this._buildSimpleOptions(t, "ui-spinner");
      return e.classes["ui-spinner-up"] = "", e.classes["ui-spinner-down"] = "", e
    },
    _buttonOptions: function(t) {
      return this._buildSimpleOptions(t, "ui-button")
    },
    _checkboxradioOptions: function(t) {
      return this._buildSimpleOptions(t, "ui-checkboxradio-label")
    },
    _selectmenuOptions: function(t) {
      var e = "vertical" === this.options.direction;
      return {
        width: !!e && "auto",
        classes: {
          middle: {
            "ui-selectmenu-button-open": "",
            "ui-selectmenu-button-closed": ""
          },
          first: {
            "ui-selectmenu-button-open": "ui-corner-" + (e ? "top" : "tl"),
            "ui-selectmenu-button-closed": "ui-corner-" + (e ? "top" : "left")
          },
          last: {
            "ui-selectmenu-button-open": e ? "" : "ui-corner-tr",
            "ui-selectmenu-button-closed": "ui-corner-" + (e ? "bottom" : "right")
          },
          only: {
            "ui-selectmenu-button-open": "ui-corner-top",
            "ui-selectmenu-button-closed": "ui-corner-all"
          }
        }[t]
      }
    },
    _resolveClassesValues: function(e, i) {
      var s = {};
      return t.each(e, function(n) {
        var o = i.options.classes[n] || "";
        o = t.trim(o.replace(/ui-corner-([a-z]){2,6}/g, "")), s[n] = (o + " " + e[n]).replace(/\s+/g, " ")
      }), s
    },
    _setOption: function(t, e) {
      if ("direction" === t && this._removeClass("ui-controlgroup-" + this.options.direction), this._super(t, e), "disabled" === t) return void this._callChildMethod(e ? "disable" : "enable");
      this.refresh()
    },
    refresh: function() {
      var e, i = this;
      this._addClass("ui-controlgroup ui-controlgroup-" + this.options.direction), "horizontal" === this.options.direction && this._addClass(null, "ui-helper-clearfix"), this._initWidgets(), e = this.childWidgets, this.options.onlyVisible && (e = e.filter(":visible")), e.length && (t.each(["first", "last"], function(t, s) {
        var n = e[s]().data("ui-controlgroup-data");
        if (n && i["_" + n.widgetName + "Options"]) {
          var o = i["_" + n.widgetName + "Options"](1 === e.length ? "only" : s);
          o.classes = i._resolveClassesValues(o.classes, n), n.element[n.widgetName](o)
        } else i._updateCornerClass(e[s](), s)
      }), this._callChildMethod("refresh"))
    }
  });
  t.widget("ui.checkboxradio", [t.ui.formResetMixin, {
    version: "1.12.1",
    options: {
      disabled: null,
      label: null,
      icon: !0,
      classes: {
        "ui-checkboxradio-label": "ui-corner-all",
        "ui-checkboxradio-icon": "ui-corner-all"
      }
    },
    _getCreateOptions: function() {
      var e, i, s = this,
        n = this._super() || {};
      return this._readType(), i = this.element.labels(), this.label = t(i[i.length - 1]), this.label.length || t.error("No label found for checkboxradio widget"), this.originalLabel = "", this.label.contents().not(this.element[0]).each(function() {
        s.originalLabel += 3 === this.nodeType ? t(this).text() : this.outerHTML
      }), this.originalLabel && (n.label = this.originalLabel), e = this.element[0].disabled, null != e && (n.disabled = e), n
    },
    _create: function() {
      var t = this.element[0].checked;
      this._bindFormResetHandler(), null == this.options.disabled && (this.options.disabled = this.element[0].disabled), this._setOption("disabled", this.options.disabled), this._addClass("ui-checkboxradio", "ui-helper-hidden-accessible"), this._addClass(this.label, "ui-checkboxradio-label", "ui-button ui-widget"), "radio" === this.type && this._addClass(this.label, "ui-checkboxradio-radio-label"), this.options.label && this.options.label !== this.originalLabel ? this._updateLabel() : this.originalLabel && (this.options.label = this.originalLabel), this._enhance(), t && (this._addClass(this.label, "ui-checkboxradio-checked", "ui-state-active"), this.icon && this._addClass(this.icon, null, "ui-state-hover")), this._on({
        change: "_toggleClasses",
        focus: function() {
          this._addClass(this.label, null, "ui-state-focus ui-visual-focus")
        },
        blur: function() {
          this._removeClass(this.label, null, "ui-state-focus ui-visual-focus")
        }
      })
    },
    _readType: function() {
      var e = this.element[0].nodeName.toLowerCase();
      this.type = this.element[0].type, "input" === e && /radio|checkbox/.test(this.type) || t.error("Can't create checkboxradio on element.nodeName=" + e + " and element.type=" + this.type)
    },
    _enhance: function() {
      this._updateIcon(this.element[0].checked)
    },
    widget: function() {
      return this.label
    },
    _getRadioGroup: function() {
      var e, i = this.element[0].name,
        s = "input[name='" + t.ui.escapeSelector(i) + "']";
      return i ? (e = this.form.length ? t(this.form[0].elements).filter(s) : t(s).filter(function() {
        return 0 === t(this).form().length
      }), e.not(this.element)) : t([])
    },
    _toggleClasses: function() {
      var e = this.element[0].checked;
      this._toggleClass(this.label, "ui-checkboxradio-checked", "ui-state-active", e), this.options.icon && "checkbox" === this.type && this._toggleClass(this.icon, null, "ui-icon-check ui-state-checked", e)._toggleClass(this.icon, null, "ui-icon-blank", !e), "radio" === this.type && this._getRadioGroup().each(function() {
        var e = t(this).checkboxradio("instance");
        e && e._removeClass(e.label, "ui-checkboxradio-checked", "ui-state-active")
      })
    },
    _destroy: function() {
      this._unbindFormResetHandler(), this.icon && (this.icon.remove(), this.iconSpace.remove())
    },
    _setOption: function(t, e) {
      if ("label" !== t || e) {
        if (this._super(t, e), "disabled" === t) return this._toggleClass(this.label, null, "ui-state-disabled", e), void(this.element[0].disabled = e);
        this.refresh()
      }
    },
    _updateIcon: function(e) {
      var i = "ui-icon ui-icon-background ";
      this.options.icon ? (this.icon || (this.icon = t("<span>"), this.iconSpace = t("<span> </span>"), this._addClass(this.iconSpace, "ui-checkboxradio-icon-space")), "checkbox" === this.type ? (i += e ? "ui-icon-check ui-state-checked" : "ui-icon-blank", this._removeClass(this.icon, null, e ? "ui-icon-blank" : "ui-icon-check")) : i += "ui-icon-blank", this._addClass(this.icon, "ui-checkboxradio-icon", i), e || this._removeClass(this.icon, null, "ui-icon-check ui-state-checked"), this.icon.prependTo(this.label).after(this.iconSpace)) : void 0 !== this.icon && (this.icon.remove(), this.iconSpace.remove(), delete this.icon)
    },
    _updateLabel: function() {
      var t = this.label.contents().not(this.element[0]);
      this.icon && (t = t.not(this.icon[0])), this.iconSpace && (t = t.not(this.iconSpace[0])), t.remove(), this.label.append(this.options.label)
    },
    refresh: function() {
      var t = this.element[0].checked,
        e = this.element[0].disabled;
      this._updateIcon(t), this._toggleClass(this.label, "ui-checkboxradio-checked", "ui-state-active", t), null !== this.options.label && this._updateLabel(), e !== this.options.disabled && this._setOptions({
        disabled: e
      })
    }
  }]);
  t.ui.checkboxradio;
  t.widget("ui.button", {
    version: "1.12.1",
    defaultElement: "<button>",
    options: {
      classes: {
        "ui-button": "ui-corner-all"
      },
      disabled: null,
      icon: null,
      iconPosition: "beginning",
      label: null,
      showLabel: !0
    },
    _getCreateOptions: function() {
      var t, e = this._super() || {};
      return this.isInput = this.element.is("input"), t = this.element[0].disabled, null != t && (e.disabled = t), this.originalLabel = this.isInput ? this.element.val() : this.element.html(), this.originalLabel && (e.label = this.originalLabel), e
    },
    _create: function() {
      !this.option.showLabel & !this.options.icon && (this.options.showLabel = !0), null == this.options.disabled && (this.options.disabled = this.element[0].disabled || !1), this.hasTitle = !!this.element.attr("title"), this.options.label && this.options.label !== this.originalLabel && (this.isInput ? this.element.val(this.options.label) : this.element.html(this.options.label)), this._addClass("ui-button", "ui-widget"), this._setOption("disabled", this.options.disabled), this._enhance(), this.element.is("a") && this._on({
        keyup: function(e) {
          e.keyCode === t.ui.keyCode.SPACE && (e.preventDefault(), this.element[0].click ? this.element[0].click() : this.element.trigger("click"))
        }
      })
    },
    _enhance: function() {
      this.element.is("button") || this.element.attr("role", "button"), this.options.icon && (this._updateIcon("icon", this.options.icon), this._updateTooltip())
    },
    _updateTooltip: function() {
      this.title = this.element.attr("title"), this.options.showLabel || this.title || this.element.attr("title", this.options.label)
    },
    _updateIcon: function(e, i) {
      var s = "iconPosition" !== e,
        n = s ? this.options.iconPosition : i,
        o = "top" === n || "bottom" === n;
      this.icon ? s && this._removeClass(this.icon, null, this.options.icon) : (this.icon = t("<span>"), this._addClass(this.icon, "ui-button-icon", "ui-icon"), this.options.showLabel || this._addClass("ui-button-icon-only")), s && this._addClass(this.icon, null, i), this._attachIcon(n), o ? (this._addClass(this.icon, null, "ui-widget-icon-block"), this.iconSpace && this.iconSpace.remove()) : (this.iconSpace || (this.iconSpace = t("<span> </span>"), this._addClass(this.iconSpace, "ui-button-icon-space")), this._removeClass(this.icon, null, "ui-wiget-icon-block"), this._attachIconSpace(n))
    },
    _destroy: function() {
      this.element.removeAttr("role"), this.icon && this.icon.remove(), this.iconSpace && this.iconSpace.remove(), this.hasTitle || this.element.removeAttr("title")
    },
    _attachIconSpace: function(t) {
      this.icon[/^(?:end|bottom)/.test(t) ? "before" : "after"](this.iconSpace)
    },
    _attachIcon: function(t) {
      this.element[/^(?:end|bottom)/.test(t) ? "append" : "prepend"](this.icon)
    },
    _setOptions: function(t) {
      var e = void 0 === t.showLabel ? this.options.showLabel : t.showLabel,
        i = void 0 === t.icon ? this.options.icon : t.icon;
      e || i || (t.showLabel = !0), this._super(t)
    },
    _setOption: function(t, e) {
      "icon" === t && (e ? this._updateIcon(t, e) : this.icon && (this.icon.remove(), this.iconSpace && this.iconSpace.remove())), "iconPosition" === t && this._updateIcon(t, e), "showLabel" === t && (this._toggleClass("ui-button-icon-only", null, !e), this._updateTooltip()), "label" === t && (this.isInput ? this.element.val(e) : (this.element.html(e), this.icon && (this._attachIcon(this.options.iconPosition), this._attachIconSpace(this.options.iconPosition)))), this._super(t, e), "disabled" === t && (this._toggleClass(null, "ui-state-disabled", e), this.element[0].disabled = e, e && this.element.blur())
    },
    refresh: function() {
      var t = this.element.is("input, button") ? this.element[0].disabled : this.element.hasClass("ui-button-disabled");
      t !== this.options.disabled && this._setOptions({
        disabled: t
      }), this._updateTooltip()
    }
  }), !1 !== t.uiBackCompat && (t.widget("ui.button", t.ui.button, {
    options: {
      text: !0,
      icons: {
        primary: null,
        secondary: null
      }
    },
    _create: function() {
      this.options.showLabel && !this.options.text && (this.options.showLabel = this.options.text), !this.options.showLabel && this.options.text && (this.options.text = this.options.showLabel), this.options.icon || !this.options.icons.primary && !this.options.icons.secondary ? this.options.icon && (this.options.icons.primary = this.options.icon) : this.options.icons.primary ? this.options.icon = this.options.icons.primary : (this.options.icon = this.options.icons.secondary, this.options.iconPosition = "end"), this._super()
    },
    _setOption: function(t, e) {
      if ("text" === t) return void this._super("showLabel", e);
      "showLabel" === t && (this.options.text = e), "icon" === t && (this.options.icons.primary = e), "icons" === t && (e.primary ? (this._super("icon", e.primary), this._super("iconPosition", "beginning")) : e.secondary && (this._super("icon", e.secondary), this._super("iconPosition", "end"))), this._superApply(arguments)
    }
  }), t.fn.button = function(e) {
    return function() {
      return !this.length || this.length && "INPUT" !== this[0].tagName || this.length && "INPUT" === this[0].tagName && "checkbox" !== this.attr("type") && "radio" !== this.attr("type") ? e.apply(this, arguments) : (t.ui.checkboxradio || t.error("Checkboxradio widget missing"), 0 === arguments.length ? this.checkboxradio({
        icon: !1
      }) : this.checkboxradio.apply(this, arguments))
    }
  }(t.fn.button), t.fn.buttonset = function() {
    return t.ui.controlgroup || t.error("Controlgroup widget missing"), "option" === arguments[0] && "items" === arguments[1] && arguments[2] ? this.controlgroup.apply(this, [arguments[0], "items.button", arguments[2]]) : "option" === arguments[0] && "items" === arguments[1] ? this.controlgroup.apply(this, [arguments[0], "items.button"]) : ("object" == typeof arguments[0] && arguments[0].items && (arguments[0].items = {
      button: arguments[0].items
    }), this.controlgroup.apply(this, arguments))
  });
  t.ui.button;
  t.extend(t.ui, {
    datepicker: {
      version: "1.12.1"
    }
  });
  var d;
  t.extend(s.prototype, {
    markerClassName: "hasDatepicker",
    maxRows: 4,
    _widgetDatepicker: function() {
      return this.dpDiv
    },
    setDefaults: function(t) {
      return r(this._defaults, t || {}), this
    },
    _attachDatepicker: function(e, i) {
      var s, n, o;
      s = e.nodeName.toLowerCase(), n = "div" === s || "span" === s, e.id || (this.uuid += 1, e.id = "dp" + this.uuid), o = this._newInst(t(e), n), o.settings = t.extend({}, i || {}), "input" === s ? this._connectDatepicker(e, o) : n && this._inlineDatepicker(e, o)
    },
    _newInst: function(e, i) {
      return {
        id: e[0].id.replace(/([^A-Za-z0-9_\-])/g, "\\\\$1"),
        input: e,
        selectedDay: 0,
        selectedMonth: 0,
        selectedYear: 0,
        drawMonth: 0,
        drawYear: 0,
        inline: i,
        dpDiv: i ? n(t("<div class='" + this._inlineClass + " ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>")) : this.dpDiv
      }
    },
    _connectDatepicker: function(e, i) {
      var s = t(e);
      i.append = t([]), i.trigger = t([]), s.hasClass(this.markerClassName) || (this._attachments(s, i), s.addClass(this.markerClassName).on("keydown", this._doKeyDown).on("keypress", this._doKeyPress).on("keyup", this._doKeyUp), this._autoSize(i), t.data(e, "datepicker", i), i.settings.disabled && this._disableDatepicker(e))
    },
    _attachments: function(e, i) {
      var s, n, o, r = this._get(i, "appendText"),
        a = this._get(i, "isRTL");
      i.append && i.append.remove(), r && (i.append = t("<span class='" + this._appendClass + "'>" + r + "</span>"), e[a ? "before" : "after"](i.append)), e.off("focus", this._showDatepicker), i.trigger && i.trigger.remove(), s = this._get(i, "showOn"), "focus" !== s && "both" !== s || e.on("focus", this._showDatepicker), "button" !== s && "both" !== s || (n = this._get(i, "buttonText"), o = this._get(i, "buttonImage"), i.trigger = t(this._get(i, "buttonImageOnly") ? t("<img/>").addClass(this._triggerClass).attr({
        src: o,
        alt: n,
        title: n
      }) : t("<button type='button'></button>").addClass(this._triggerClass).html(o ? t("<img/>").attr({
        src: o,
        alt: n,
        title: n
      }) : n)), e[a ? "before" : "after"](i.trigger), i.trigger.on("click", function() {
        return t.datepicker._datepickerShowing && t.datepicker._lastInput === e[0] ? t.datepicker._hideDatepicker() : t.datepicker._datepickerShowing && t.datepicker._lastInput !== e[0] ? (t.datepicker._hideDatepicker(), t.datepicker._showDatepicker(e[0])) : t.datepicker._showDatepicker(e[0]), !1
      }))
    },
    _autoSize: function(t) {
      if (this._get(t, "autoSize") && !t.inline) {
        var e, i, s, n, o = new Date(2009, 11, 20),
          r = this._get(t, "dateFormat");
        r.match(/[DM]/) && (e = function(t) {
          for (i = 0, s = 0, n = 0; n < t.length; n++) t[n].length > i && (i = t[n].length, s = n);
          return s
        }, o.setMonth(e(this._get(t, r.match(/MM/) ? "monthNames" : "monthNamesShort"))), o.setDate(e(this._get(t, r.match(/DD/) ? "dayNames" : "dayNamesShort")) + 20 - o.getDay())), t.input.attr("size", this._formatDate(t, o).length)
      }
    },
    _inlineDatepicker: function(e, i) {
      var s = t(e);
      s.hasClass(this.markerClassName) || (s.addClass(this.markerClassName).append(i.dpDiv), t.data(e, "datepicker", i), this._setDate(i, this._getDefaultDate(i), !0), this._updateDatepicker(i), this._updateAlternate(i), i.settings.disabled && this._disableDatepicker(e), i.dpDiv.css("display", "block"))
    },
    _dialogDatepicker: function(e, i, s, n, o) {
      var a, l, h, c, u, d = this._dialogInst;
      return d || (this.uuid += 1, a = "dp" + this.uuid, this._dialogInput = t("<input type='text' id='" + a + "' style='position: absolute; top: -100px; width: 0px;'/>"), this._dialogInput.on("keydown", this._doKeyDown), t("body").append(this._dialogInput), d = this._dialogInst = this._newInst(this._dialogInput, !1), d.settings = {}, t.data(this._dialogInput[0], "datepicker", d)), r(d.settings, n || {}), i = i && i.constructor === Date ? this._formatDate(d, i) : i, this._dialogInput.val(i), this._pos = o ? o.length ? o : [o.pageX, o.pageY] : null, this._pos || (l = document.documentElement.clientWidth, h = document.documentElement.clientHeight, c = document.documentElement.scrollLeft || document.body.scrollLeft, u = document.documentElement.scrollTop || document.body.scrollTop, this._pos = [l / 2 - 100 + c, h / 2 - 150 + u]), this._dialogInput.css("left", this._pos[0] + 20 + "px").css("top", this._pos[1] + "px"), d.settings.onSelect = s, this._inDialog = !0, this.dpDiv.addClass(this._dialogClass), this._showDatepicker(this._dialogInput[0]), t.blockUI && t.blockUI(this.dpDiv), t.data(this._dialogInput[0], "datepicker", d), this
    },
    _destroyDatepicker: function(e) {
      var i, s = t(e),
        n = t.data(e, "datepicker");
      s.hasClass(this.markerClassName) && (i = e.nodeName.toLowerCase(), t.removeData(e, "datepicker"), "input" === i ? (n.append.remove(), n.trigger.remove(), s.removeClass(this.markerClassName).off("focus", this._showDatepicker).off("keydown", this._doKeyDown).off("keypress", this._doKeyPress).off("keyup", this._doKeyUp)) : "div" !== i && "span" !== i || s.removeClass(this.markerClassName).empty(), d === n && (d = null))
    },
    _enableDatepicker: function(e) {
      var i, s, n = t(e),
        o = t.data(e, "datepicker");
      n.hasClass(this.markerClassName) && (i = e.nodeName.toLowerCase(), "input" === i ? (e.disabled = !1, o.trigger.filter("button").each(function() {
        this.disabled = !1
      }).end().filter("img").css({
        opacity: "1.0",
        cursor: ""
      })) : "div" !== i && "span" !== i || (s = n.children("." + this._inlineClass), s.children().removeClass("ui-state-disabled"), s.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled", !1)), this._disabledInputs = t.map(this._disabledInputs, function(t) {
        return t === e ? null : t
      }))
    },
    _disableDatepicker: function(e) {
      var i, s, n = t(e),
        o = t.data(e, "datepicker");
      n.hasClass(this.markerClassName) && (i = e.nodeName.toLowerCase(), "input" === i ? (e.disabled = !0, o.trigger.filter("button").each(function() {
        this.disabled = !0
      }).end().filter("img").css({
        opacity: "0.5",
        cursor: "default"
      })) : "div" !== i && "span" !== i || (s = n.children("." + this._inlineClass), s.children().addClass("ui-state-disabled"), s.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled", !0)), this._disabledInputs = t.map(this._disabledInputs, function(t) {
        return t === e ? null : t
      }), this._disabledInputs[this._disabledInputs.length] = e)
    },
    _isDisabledDatepicker: function(t) {
      if (!t) return !1;
      for (var e = 0; e < this._disabledInputs.length; e++)
        if (this._disabledInputs[e] === t) return !0;
      return !1
    },
    _getInst: function(e) {
      try {
        return t.data(e, "datepicker")
      } catch (t) {
        throw "Missing instance data for this datepicker"
      }
    },
    _optionDatepicker: function(e, i, s) {
      var n, o, a, l, h = this._getInst(e);
      if (2 === arguments.length && "string" == typeof i) return "defaults" === i ? t.extend({}, t.datepicker._defaults) : h ? "all" === i ? t.extend({}, h.settings) : this._get(h, i) : null;
      n = i || {}, "string" == typeof i && (n = {}, n[i] = s), h && (this._curInst === h && this._hideDatepicker(), o = this._getDateDatepicker(e, !0), a = this._getMinMaxDate(h, "min"), l = this._getMinMaxDate(h, "max"), r(h.settings, n), null !== a && void 0 !== n.dateFormat && void 0 === n.minDate && (h.settings.minDate = this._formatDate(h, a)), null !== l && void 0 !== n.dateFormat && void 0 === n.maxDate && (h.settings.maxDate = this._formatDate(h, l)), "disabled" in n && (n.disabled ? this._disableDatepicker(e) : this._enableDatepicker(e)), this._attachments(t(e), h), this._autoSize(h), this._setDate(h, o), this._updateAlternate(h), this._updateDatepicker(h))
    },
    _changeDatepicker: function(t, e, i) {
      this._optionDatepicker(t, e, i)
    },
    _refreshDatepicker: function(t) {
      var e = this._getInst(t);
      e && this._updateDatepicker(e)
    },
    _setDateDatepicker: function(t, e) {
      var i = this._getInst(t);
      i && (this._setDate(i, e), this._updateDatepicker(i), this._updateAlternate(i))
    },
    _getDateDatepicker: function(t, e) {
      var i = this._getInst(t);
      return i && !i.inline && this._setDateFromField(i, e), i ? this._getDate(i) : null
    },
    _doKeyDown: function(e) {
      var i, s, n, o = t.datepicker._getInst(e.target),
        r = !0,
        a = o.dpDiv.is(".ui-datepicker-rtl");
      if (o._keyEvent = !0, t.datepicker._datepickerShowing) switch (e.keyCode) {
        case 9:
          t.datepicker._hideDatepicker(), r = !1;
          break;
        case 13:
          return n = t("td." + t.datepicker._dayOverClass + ":not(." + t.datepicker._currentClass + ")", o.dpDiv), n[0] && t.datepicker._selectDay(e.target, o.selectedMonth, o.selectedYear, n[0]), i = t.datepicker._get(o, "onSelect"), i ? (s = t.datepicker._formatDate(o), i.apply(o.input ? o.input[0] : null, [s, o])) : t.datepicker._hideDatepicker(), !1;
        case 27:
          t.datepicker._hideDatepicker();
          break;
        case 33:
          t.datepicker._adjustDate(e.target, e.ctrlKey ? -t.datepicker._get(o, "stepBigMonths") : -t.datepicker._get(o, "stepMonths"), "M");
          break;
        case 34:
          t.datepicker._adjustDate(e.target, e.ctrlKey ? +t.datepicker._get(o, "stepBigMonths") : +t.datepicker._get(o, "stepMonths"), "M");
          break;
        case 35:
          (e.ctrlKey || e.metaKey) && t.datepicker._clearDate(e.target), r = e.ctrlKey || e.metaKey;
          break;
        case 36:
          (e.ctrlKey || e.metaKey) && t.datepicker._gotoToday(e.target), r = e.ctrlKey || e.metaKey;
          break;
        case 37:
          (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, a ? 1 : -1, "D"), r = e.ctrlKey || e.metaKey, e.originalEvent.altKey && t.datepicker._adjustDate(e.target, e.ctrlKey ? -t.datepicker._get(o, "stepBigMonths") : -t.datepicker._get(o, "stepMonths"), "M");
          break;
        case 38:
          (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, -7, "D"), r = e.ctrlKey || e.metaKey;
          break;
        case 39:
          (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, a ? -1 : 1, "D"), r = e.ctrlKey || e.metaKey, e.originalEvent.altKey && t.datepicker._adjustDate(e.target, e.ctrlKey ? +t.datepicker._get(o, "stepBigMonths") : +t.datepicker._get(o, "stepMonths"), "M");
          break;
        case 40:
          (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, 7, "D"), r = e.ctrlKey || e.metaKey;
          break;
        default:
          r = !1
      } else 36 === e.keyCode && e.ctrlKey ? t.datepicker._showDatepicker(this) : r = !1;
      r && (e.preventDefault(), e.stopPropagation())
    },
    _doKeyPress: function(e) {
      var i, s, n = t.datepicker._getInst(e.target);
      if (t.datepicker._get(n, "constrainInput")) return i = t.datepicker._possibleChars(t.datepicker._get(n, "dateFormat")), s = String.fromCharCode(null == e.charCode ? e.keyCode : e.charCode), e.ctrlKey || e.metaKey || s < " " || !i || i.indexOf(s) > -1
    },
    _doKeyUp: function(e) {
      var i, s = t.datepicker._getInst(e.target);
      if (s.input.val() !== s.lastVal) try {
        i = t.datepicker.parseDate(t.datepicker._get(s, "dateFormat"), s.input ? s.input.val() : null, t.datepicker._getFormatConfig(s)), i && (t.datepicker._setDateFromField(s), t.datepicker._updateAlternate(s), t.datepicker._updateDatepicker(s))
      } catch (t) {}
      return !0
    },
    _showDatepicker: function(e) {
      if (e = e.target || e, "input" !== e.nodeName.toLowerCase() && (e = t("input", e.parentNode)[0]), !t.datepicker._isDisabledDatepicker(e) && t.datepicker._lastInput !== e) {
        var s, n, o, a, l, h, c;
        s = t.datepicker._getInst(e), t.datepicker._curInst && t.datepicker._curInst !== s && (t.datepicker._curInst.dpDiv.stop(!0, !0), s && t.datepicker._datepickerShowing && t.datepicker._hideDatepicker(t.datepicker._curInst.input[0])), n = t.datepicker._get(s, "beforeShow"), o = n ? n.apply(e, [e, s]) : {}, !1 !== o && (r(s.settings, o), s.lastVal = null, t.datepicker._lastInput = e, t.datepicker._setDateFromField(s), t.datepicker._inDialog && (e.value = ""), t.datepicker._pos || (t.datepicker._pos = t.datepicker._findPos(e), t.datepicker._pos[1] += e.offsetHeight), a = !1, t(e).parents().each(function() {
          return !(a |= "fixed" === t(this).css("position"))
        }), l = {
          left: t.datepicker._pos[0],
          top: t.datepicker._pos[1]
        }, t.datepicker._pos = null, s.dpDiv.empty(), s.dpDiv.css({
          position: "absolute",
          display: "block",
          top: "-1000px"
        }), t.datepicker._updateDatepicker(s), l = t.datepicker._checkOffset(s, l, a), s.dpDiv.css({
          position: t.datepicker._inDialog && t.blockUI ? "static" : a ? "fixed" : "absolute",
          display: "none",
          left: l.left + "px",
          top: l.top + "px"
        }), s.inline || (h = t.datepicker._get(s, "showAnim"), c = t.datepicker._get(s, "duration"), s.dpDiv.css("z-index", i(t(e)) + 1), t.datepicker._datepickerShowing = !0, t.effects && t.effects.effect[h] ? s.dpDiv.show(h, t.datepicker._get(s, "showOptions"), c) : s.dpDiv[h || "show"](h ? c : null), t.datepicker._shouldFocusInput(s) && s.input.trigger("focus"), t.datepicker._curInst = s))
      }
    },
    _updateDatepicker: function(e) {
      this.maxRows = 4, d = e, e.dpDiv.empty().append(this._generateHTML(e)), this._attachHandlers(e);
      var i, s = this._getNumberOfMonths(e),
        n = s[1],
        r = e.dpDiv.find("." + this._dayOverClass + " a");
      r.length > 0 && o.apply(r.get(0)), e.dpDiv.removeClass("ui-datepicker-multi-2 ui-datepicker-multi-3 ui-datepicker-multi-4").width(""), n > 1 && e.dpDiv.addClass("ui-datepicker-multi-" + n).css("width", 17 * n + "em"), e.dpDiv[(1 !== s[0] || 1 !== s[1] ? "add" : "remove") + "Class"]("ui-datepicker-multi"), e.dpDiv[(this._get(e, "isRTL") ? "add" : "remove") + "Class"]("ui-datepicker-rtl"), e === t.datepicker._curInst && t.datepicker._datepickerShowing && t.datepicker._shouldFocusInput(e) && e.input.trigger("focus"), e.yearshtml && (i = e.yearshtml, setTimeout(function() {
        i === e.yearshtml && e.yearshtml && e.dpDiv.find("select.ui-datepicker-year:first").replaceWith(e.yearshtml), i = e.yearshtml = null
      }, 0))
    },
    _shouldFocusInput: function(t) {
      return t.input && t.input.is(":visible") && !t.input.is(":disabled") && !t.input.is(":focus")
    },
    _checkOffset: function(e, i, s) {
      var n = e.dpDiv.outerWidth(),
        o = e.dpDiv.outerHeight(),
        r = e.input ? e.input.outerWidth() : 0,
        a = e.input ? e.input.outerHeight() : 0,
        l = document.documentElement.clientWidth + (s ? 0 : t(document).scrollLeft()),
        h = document.documentElement.clientHeight + (s ? 0 : t(document).scrollTop());
      return i.left -= this._get(e, "isRTL") ? n - r : 0, i.left -= s && i.left === e.input.offset().left ? t(document).scrollLeft() : 0, i.top -= s && i.top === e.input.offset().top + a ? t(document).scrollTop() : 0, i.left -= Math.min(i.left, i.left + n > l && l > n ? Math.abs(i.left + n - l) : 0), i.top -= Math.min(i.top, i.top + o > h && h > o ? Math.abs(o + a) : 0), i
    },
    _findPos: function(e) {
      for (var i, s = this._getInst(e), n = this._get(s, "isRTL"); e && ("hidden" === e.type || 1 !== e.nodeType || t.expr.filters.hidden(e));) e = e[n ? "previousSibling" : "nextSibling"];
      return i = t(e).offset(), [i.left, i.top]
    },
    _hideDatepicker: function(e) {
      var i, s, n, o, r = this._curInst;
      !r || e && r !== t.data(e, "datepicker") || this._datepickerShowing && (i = this._get(r, "showAnim"), s = this._get(r, "duration"), n = function() {
        t.datepicker._tidyDialog(r)
      }, t.effects && (t.effects.effect[i] || t.effects[i]) ? r.dpDiv.hide(i, t.datepicker._get(r, "showOptions"), s, n) : r.dpDiv["slideDown" === i ? "slideUp" : "fadeIn" === i ? "fadeOut" : "hide"](i ? s : null, n), i || n(), this._datepickerShowing = !1, o = this._get(r, "onClose"), o && o.apply(r.input ? r.input[0] : null, [r.input ? r.input.val() : "", r]), this._lastInput = null, this._inDialog && (this._dialogInput.css({
        position: "absolute",
        left: "0",
        top: "-100px"
      }), t.blockUI && (t.unblockUI(), t("body").append(this.dpDiv))), this._inDialog = !1)
    },
    _tidyDialog: function(t) {
      t.dpDiv.removeClass(this._dialogClass).off(".ui-datepicker-calendar")
    },
    _checkExternalClick: function(e) {
      if (t.datepicker._curInst) {
        var i = t(e.target),
          s = t.datepicker._getInst(i[0]);
        (i[0].id === t.datepicker._mainDivId || 0 !== i.parents("#" + t.datepicker._mainDivId).length || i.hasClass(t.datepicker.markerClassName) || i.closest("." + t.datepicker._triggerClass).length || !t.datepicker._datepickerShowing || t.datepicker._inDialog && t.blockUI) && (!i.hasClass(t.datepicker.markerClassName) || t.datepicker._curInst === s) || t.datepicker._hideDatepicker()
      }
    },
    _adjustDate: function(e, i, s) {
      var n = t(e),
        o = this._getInst(n[0]);
      this._isDisabledDatepicker(n[0]) || (this._adjustInstDate(o, i + ("M" === s ? this._get(o, "showCurrentAtPos") : 0), s), this._updateDatepicker(o))
    },
    _gotoToday: function(e) {
      var i, s = t(e),
        n = this._getInst(s[0]);
      this._get(n, "gotoCurrent") && n.currentDay ? (n.selectedDay = n.currentDay, n.drawMonth = n.selectedMonth = n.currentMonth, n.drawYear = n.selectedYear = n.currentYear) : (i = new Date, n.selectedDay = i.getDate(), n.drawMonth = n.selectedMonth = i.getMonth(), n.drawYear = n.selectedYear = i.getFullYear()), this._notifyChange(n), this._adjustDate(s)
    },
    _selectMonthYear: function(e, i, s) {
      var n = t(e),
        o = this._getInst(n[0]);
      o["selected" + ("M" === s ? "Month" : "Year")] = o["draw" + ("M" === s ? "Month" : "Year")] = parseInt(i.options[i.selectedIndex].value, 10), this._notifyChange(o), this._adjustDate(n)
    },
    _selectDay: function(e, i, s, n) {
      var o, r = t(e);
      t(n).hasClass(this._unselectableClass) || this._isDisabledDatepicker(r[0]) || (o = this._getInst(r[0]), o.selectedDay = o.currentDay = t("a", n).html(), o.selectedMonth = o.currentMonth = i, o.selectedYear = o.currentYear = s, this._selectDate(e, this._formatDate(o, o.currentDay, o.currentMonth, o.currentYear)))
    },
    _clearDate: function(e) {
      var i = t(e);
      this._selectDate(i, "")
    },
    _selectDate: function(e, i) {
      var s, n = t(e),
        o = this._getInst(n[0]);
      i = null != i ? i : this._formatDate(o), o.input && o.input.val(i), this._updateAlternate(o), s = this._get(o, "onSelect"), s ? s.apply(o.input ? o.input[0] : null, [i, o]) : o.input && o.input.trigger("change"), o.inline ? this._updateDatepicker(o) : (this._hideDatepicker(), this._lastInput = o.input[0], "object" != typeof o.input[0] && o.input.trigger("focus"), this._lastInput = null)
    },
    _updateAlternate: function(e) {
      var i, s, n, o = this._get(e, "altField");
      o && (i = this._get(e, "altFormat") || this._get(e, "dateFormat"), s = this._getDate(e), n = this.formatDate(i, s, this._getFormatConfig(e)), t(o).val(n))
    },
    noWeekends: function(t) {
      var e = t.getDay();
      return [e > 0 && e < 6, ""]
    },
    iso8601Week: function(t) {
      var e, i = new Date(t.getTime());
      return i.setDate(i.getDate() + 4 - (i.getDay() || 7)), e = i.getTime(), i.setMonth(0), i.setDate(1), Math.floor(Math.round((e - i) / 864e5) / 7) + 1
    },
    parseDate: function(e, i, s) {
      if (null == e || null == i) throw "Invalid arguments";
      if ("" === (i = "object" == typeof i ? i.toString() : i + "")) return null;
      var n, o, r, a, l = 0,
        h = (s ? s.shortYearCutoff : null) || this._defaults.shortYearCutoff,
        c = "string" != typeof h ? h : (new Date).getFullYear() % 100 + parseInt(h, 10),
        u = (s ? s.dayNamesShort : null) || this._defaults.dayNamesShort,
        d = (s ? s.dayNames : null) || this._defaults.dayNames,
        p = (s ? s.monthNamesShort : null) || this._defaults.monthNamesShort,
        f = (s ? s.monthNames : null) || this._defaults.monthNames,
        g = -1,
        m = -1,
        v = -1,
        b = -1,
        _ = !1,
        y = function(t) {
          var i = n + 1 < e.length && e.charAt(n + 1) === t;
          return i && n++, i
        },
        w = function(t) {
          var e = y(t),
            s = "@" === t ? 14 : "!" === t ? 20 : "y" === t && e ? 4 : "o" === t ? 3 : 2,
            n = "y" === t ? s : 1,
            o = new RegExp("^\\d{" + n + "," + s + "}"),
            r = i.substring(l).match(o);
          if (!r) throw "Missing number at position " + l;
          return l += r[0].length, parseInt(r[0], 10)
        },
        x = function(e, s, n) {
          var o = -1,
            r = t.map(y(e) ? n : s, function(t, e) {
              return [
                [e, t]
              ]
            }).sort(function(t, e) {
              return -(t[1].length - e[1].length)
            });
          if (t.each(r, function(t, e) {
              var s = e[1];
              if (i.substr(l, s.length).toLowerCase() === s.toLowerCase()) return o = e[0], l += s.length, !1
            }), -1 !== o) return o + 1;
          throw "Unknown name at position " + l
        },
        k = function() {
          if (i.charAt(l) !== e.charAt(n)) throw "Unexpected literal at position " + l;
          l++
        };
      for (n = 0; n < e.length; n++)
        if (_) "'" !== e.charAt(n) || y("'") ? k() : _ = !1;
        else switch (e.charAt(n)) {
          case "d":
            v = w("d");
            break;
          case "D":
            x("D", u, d);
            break;
          case "o":
            b = w("o");
            break;
          case "m":
            m = w("m");
            break;
          case "M":
            m = x("M", p, f);
            break;
          case "y":
            g = w("y");
            break;
          case "@":
            a = new Date(w("@")), g = a.getFullYear(), m = a.getMonth() + 1, v = a.getDate();
            break;
          case "!":
            a = new Date((w("!") - this._ticksTo1970) / 1e4), g = a.getFullYear(), m = a.getMonth() + 1, v = a.getDate();
            break;
          case "'":
            y("'") ? k() : _ = !0;
            break;
          default:
            k()
        }
        if (l < i.length && (r = i.substr(l), !/^\s+/.test(r))) throw "Extra/unparsed characters found in date: " + r;
      if (-1 === g ? g = (new Date).getFullYear() : g < 100 && (g += (new Date).getFullYear() - (new Date).getFullYear() % 100 + (g <= c ? 0 : -100)), b > -1)
        for (m = 1, v = b;;) {
          if (o = this._getDaysInMonth(g, m - 1), v <= o) break;
          m++, v -= o
        }
      if (a = this._daylightSavingAdjust(new Date(g, m - 1, v)), a.getFullYear() !== g || a.getMonth() + 1 !== m || a.getDate() !== v) throw "Invalid date";
      return a
    },
    ATOM: "yy-mm-dd",
    COOKIE: "D, dd M yy",
    ISO_8601: "yy-mm-dd",
    RFC_822: "D, d M y",
    RFC_850: "DD, dd-M-y",
    RFC_1036: "D, d M y",
    RFC_1123: "D, d M yy",
    RFC_2822: "D, d M yy",
    RSS: "D, d M y",
    TICKS: "!",
    TIMESTAMP: "@",
    W3C: "yy-mm-dd",
    _ticksTo1970: 24 * (718685 + Math.floor(492.5) - Math.floor(19.7) + Math.floor(4.925)) * 60 * 60 * 1e7,
    formatDate: function(t, e, i) {
      if (!e) return "";
      var s, n = (i ? i.dayNamesShort : null) || this._defaults.dayNamesShort,
        o = (i ? i.dayNames : null) || this._defaults.dayNames,
        r = (i ? i.monthNamesShort : null) || this._defaults.monthNamesShort,
        a = (i ? i.monthNames : null) || this._defaults.monthNames,
        l = function(e) {
          var i = s + 1 < t.length && t.charAt(s + 1) === e;
          return i && s++, i
        },
        h = function(t, e, i) {
          var s = "" + e;
          if (l(t))
            for (; s.length < i;) s = "0" + s;
          return s
        },
        c = function(t, e, i, s) {
          return l(t) ? s[e] : i[e]
        },
        u = "",
        d = !1;
      if (e)
        for (s = 0; s < t.length; s++)
          if (d) "'" !== t.charAt(s) || l("'") ? u += t.charAt(s) : d = !1;
          else switch (t.charAt(s)) {
            case "d":
              u += h("d", e.getDate(), 2);
              break;
            case "D":
              u += c("D", e.getDay(), n, o);
              break;
            case "o":
              u += h("o", Math.round((new Date(e.getFullYear(), e.getMonth(), e.getDate()).getTime() - new Date(e.getFullYear(), 0, 0).getTime()) / 864e5), 3);
              break;
            case "m":
              u += h("m", e.getMonth() + 1, 2);
              break;
            case "M":
              u += c("M", e.getMonth(), r, a);
              break;
            case "y":
              u += l("y") ? e.getFullYear() : (e.getFullYear() % 100 < 10 ? "0" : "") + e.getFullYear() % 100;
              break;
            case "@":
              u += e.getTime();
              break;
            case "!":
              u += 1e4 * e.getTime() + this._ticksTo1970;
              break;
            case "'":
              l("'") ? u += "'" : d = !0;
              break;
            default:
              u += t.charAt(s)
          }
          return u
    },
    _possibleChars: function(t) {
      var e, i = "",
        s = !1,
        n = function(i) {
          var s = e + 1 < t.length && t.charAt(e + 1) === i;
          return s && e++, s
        };
      for (e = 0; e < t.length; e++)
        if (s) "'" !== t.charAt(e) || n("'") ? i += t.charAt(e) : s = !1;
        else switch (t.charAt(e)) {
          case "d":
          case "m":
          case "y":
          case "@":
            i += "0123456789";
            break;
          case "D":
          case "M":
            return null;
          case "'":
            n("'") ? i += "'" : s = !0;
            break;
          default:
            i += t.charAt(e)
        }
        return i
    },
    _get: function(t, e) {
      return void 0 !== t.settings[e] ? t.settings[e] : this._defaults[e]
    },
    _setDateFromField: function(t, e) {
      if (t.input.val() !== t.lastVal) {
        var i = this._get(t, "dateFormat"),
          s = t.lastVal = t.input ? t.input.val() : null,
          n = this._getDefaultDate(t),
          o = n,
          r = this._getFormatConfig(t);
        try {
          o = this.parseDate(i, s, r) || n
        } catch (t) {
          s = e ? "" : s
        }
        t.selectedDay = o.getDate(), t.drawMonth = t.selectedMonth = o.getMonth(), t.drawYear = t.selectedYear = o.getFullYear(), t.currentDay = s ? o.getDate() : 0, t.currentMonth = s ? o.getMonth() : 0, t.currentYear = s ? o.getFullYear() : 0, this._adjustInstDate(t)
      }
    },
    _getDefaultDate: function(t) {
      return this._restrictMinMax(t, this._determineDate(t, this._get(t, "defaultDate"), new Date))
    },
    _determineDate: function(e, i, s) {
      var n = null == i || "" === i ? s : "string" == typeof i ? function(i) {
        try {
          return t.datepicker.parseDate(t.datepicker._get(e, "dateFormat"), i, t.datepicker._getFormatConfig(e))
        } catch (t) {}
        for (var s = (i.toLowerCase().match(/^c/) ? t.datepicker._getDate(e) : null) || new Date, n = s.getFullYear(), o = s.getMonth(), r = s.getDate(), a = /([+\-]?[0-9]+)\s*(d|D|w|W|m|M|y|Y)?/g, l = a.exec(i); l;) {
          switch (l[2] || "d") {
            case "d":
            case "D":
              r += parseInt(l[1], 10);
              break;
            case "w":
            case "W":
              r += 7 * parseInt(l[1], 10);
              break;
            case "m":
            case "M":
              o += parseInt(l[1], 10), r = Math.min(r, t.datepicker._getDaysInMonth(n, o));
              break;
            case "y":
            case "Y":
              n += parseInt(l[1], 10), r = Math.min(r, t.datepicker._getDaysInMonth(n, o))
          }
          l = a.exec(i)
        }
        return new Date(n, o, r)
      }(i) : "number" == typeof i ? isNaN(i) ? s : function(t) {
        var e = new Date;
        return e.setDate(e.getDate() + t), e
      }(i) : new Date(i.getTime());
      return n = n && "Invalid Date" === n.toString() ? s : n, n && (n.setHours(0), n.setMinutes(0), n.setSeconds(0), n.setMilliseconds(0)), this._daylightSavingAdjust(n)
    },
    _daylightSavingAdjust: function(t) {
      return t ? (t.setHours(t.getHours() > 12 ? t.getHours() + 2 : 0), t) : null
    },
    _setDate: function(t, e, i) {
      var s = !e,
        n = t.selectedMonth,
        o = t.selectedYear,
        r = this._restrictMinMax(t, this._determineDate(t, e, new Date));
      t.selectedDay = t.currentDay = r.getDate(), t.drawMonth = t.selectedMonth = t.currentMonth = r.getMonth(), t.drawYear = t.selectedYear = t.currentYear = r.getFullYear(), n === t.selectedMonth && o === t.selectedYear || i || this._notifyChange(t), this._adjustInstDate(t), t.input && t.input.val(s ? "" : this._formatDate(t))
    },
    _getDate: function(t) {
      return !t.currentYear || t.input && "" === t.input.val() ? null : this._daylightSavingAdjust(new Date(t.currentYear, t.currentMonth, t.currentDay))
    },
    _attachHandlers: function(e) {
      var i = this._get(e, "stepMonths"),
        s = "#" + e.id.replace(/\\\\/g, "\\");
      e.dpDiv.find("[data-handler]").map(function() {
        var e = {
          prev: function() {
            t.datepicker._adjustDate(s, -i, "M")
          },
          next: function() {
            t.datepicker._adjustDate(s, +i, "M")
          },
          hide: function() {
            t.datepicker._hideDatepicker()
          },
          today: function() {
            t.datepicker._gotoToday(s)
          },
          selectDay: function() {
            return t.datepicker._selectDay(s, +this.getAttribute("data-month"), +this.getAttribute("data-year"), this), !1
          },
          selectMonth: function() {
            return t.datepicker._selectMonthYear(s, this, "M"), !1
          },
          selectYear: function() {
            return t.datepicker._selectMonthYear(s, this, "Y"), !1
          }
        };
        t(this).on(this.getAttribute("data-event"), e[this.getAttribute("data-handler")])
      })
    },
    _generateHTML: function(t) {
      var e, i, s, n, o, r, a, l, h, c, u, d, p, f, g, m, v, b, _, y, w, x, k, C, T, S, D, P, I, A, M, H, E, O, N, $, z, W, L, F = new Date,
        j = this._daylightSavingAdjust(new Date(F.getFullYear(), F.getMonth(), F.getDate())),
        q = this._get(t, "isRTL"),
        R = this._get(t, "showButtonPanel"),
        B = this._get(t, "hideIfNoPrevNext"),
        Y = this._get(t, "navigationAsDateFormat"),
        U = this._getNumberOfMonths(t),
        X = this._get(t, "showCurrentAtPos"),
        K = this._get(t, "stepMonths"),
        V = 1 !== U[0] || 1 !== U[1],
        G = this._daylightSavingAdjust(t.currentDay ? new Date(t.currentYear, t.currentMonth, t.currentDay) : new Date(9999, 9, 9)),
        J = this._getMinMaxDate(t, "min"),
        Q = this._getMinMaxDate(t, "max"),
        Z = t.drawMonth - X,
        tt = t.drawYear;
      if (Z < 0 && (Z += 12, tt--), Q)
        for (e = this._daylightSavingAdjust(new Date(Q.getFullYear(), Q.getMonth() - U[0] * U[1] + 1, Q.getDate())), e = J && e < J ? J : e; this._daylightSavingAdjust(new Date(tt, Z, 1)) > e;) --Z < 0 && (Z = 11, tt--);
      for (t.drawMonth = Z, t.drawYear = tt, i = this._get(t, "prevText"), i = Y ? this.formatDate(i, this._daylightSavingAdjust(new Date(tt, Z - K, 1)), this._getFormatConfig(t)) : i, s = this._canAdjustMonth(t, -1, tt, Z) ? "<a class='ui-datepicker-prev ui-corner-all' data-handler='prev' data-event='click' title='" + i + "'><span class='ui-icon ui-icon-circle-triangle-" + (q ? "e" : "w") + "'>" + i + "</span></a>" : B ? "" : "<a class='ui-datepicker-prev ui-corner-all ui-state-disabled' title='" + i + "'><span class='ui-icon ui-icon-circle-triangle-" + (q ? "e" : "w") + "'>" + i + "</span></a>", n = this._get(t, "nextText"), n = Y ? this.formatDate(n, this._daylightSavingAdjust(new Date(tt, Z + K, 1)), this._getFormatConfig(t)) : n, o = this._canAdjustMonth(t, 1, tt, Z) ? "<a class='ui-datepicker-next ui-corner-all' data-handler='next' data-event='click' title='" + n + "'><span class='ui-icon ui-icon-circle-triangle-" + (q ? "w" : "e") + "'>" + n + "</span></a>" : B ? "" : "<a class='ui-datepicker-next ui-corner-all ui-state-disabled' title='" + n + "'><span class='ui-icon ui-icon-circle-triangle-" + (q ? "w" : "e") + "'>" + n + "</span></a>", r = this._get(t, "currentText"), a = this._get(t, "gotoCurrent") && t.currentDay ? G : j, r = Y ? this.formatDate(r, a, this._getFormatConfig(t)) : r, l = t.inline ? "" : "<button type='button' class='ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all' data-handler='hide' data-event='click'>" + this._get(t, "closeText") + "</button>", h = R ? "<div class='ui-datepicker-buttonpane ui-widget-content'>" + (q ? l : "") + (this._isInRange(t, a) ? "<button type='button' class='ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all' data-handler='today' data-event='click'>" + r + "</button>" : "") + (q ? "" : l) + "</div>" : "", c = parseInt(this._get(t, "firstDay"), 10), c = isNaN(c) ? 0 : c, u = this._get(t, "showWeek"), d = this._get(t, "dayNames"), p = this._get(t, "dayNamesMin"), f = this._get(t, "monthNames"), g = this._get(t, "monthNamesShort"), m = this._get(t, "beforeShowDay"), v = this._get(t, "showOtherMonths"), b = this._get(t, "selectOtherMonths"), _ = this._getDefaultDate(t), y = "", x = 0; x < U[0]; x++) {
        for (k = "", this.maxRows = 4, C = 0; C < U[1]; C++) {
          if (T = this._daylightSavingAdjust(new Date(tt, Z, t.selectedDay)), S = " ui-corner-all", D = "", V) {
            if (D += "<div class='ui-datepicker-group", U[1] > 1) switch (C) {
              case 0:
                D += " ui-datepicker-group-first", S = " ui-corner-" + (q ? "right" : "left");
                break;
              case U[1] - 1:
                D += " ui-datepicker-group-last", S = " ui-corner-" + (q ? "left" : "right");
                break;
              default:
                D += " ui-datepicker-group-middle", S = ""
            }
            D += "'>"
          }
          for (D += "<div class='ui-datepicker-header ui-widget-header ui-helper-clearfix" + S + "'>" + (/all|left/.test(S) && 0 === x ? q ? o : s : "") + (/all|right/.test(S) && 0 === x ? q ? s : o : "") + this._generateMonthYearHeader(t, Z, tt, J, Q, x > 0 || C > 0, f, g) + "</div><table class='ui-datepicker-calendar'><thead><tr>", P = u ? "<th class='ui-datepicker-week-col'>" + this._get(t, "weekHeader") + "</th>" : "", w = 0; w < 7; w++) I = (w + c) % 7, P += "<th scope='col'" + ((w + c + 6) % 7 >= 5 ? " class='ui-datepicker-week-end'" : "") + "><span title='" + d[I] + "'>" + p[I] + "</span></th>";
          for (D += P + "</tr></thead><tbody>", A = this._getDaysInMonth(tt, Z), tt === t.selectedYear && Z === t.selectedMonth && (t.selectedDay = Math.min(t.selectedDay, A)), M = (this._getFirstDayOfMonth(tt, Z) - c + 7) % 7, H = Math.ceil((M + A) / 7), E = V && this.maxRows > H ? this.maxRows : H, this.maxRows = E, O = this._daylightSavingAdjust(new Date(tt, Z, 1 - M)), N = 0; N < E; N++) {
            for (D += "<tr>", $ = u ? "<td class='ui-datepicker-week-col'>" + this._get(t, "calculateWeek")(O) + "</td>" : "", w = 0; w < 7; w++) z = m ? m.apply(t.input ? t.input[0] : null, [O]) : [!0, ""], W = O.getMonth() !== Z, L = W && !b || !z[0] || J && O < J || Q && O > Q, $ += "<td class='" + ((w + c + 6) % 7 >= 5 ? " ui-datepicker-week-end" : "") + (W ? " ui-datepicker-other-month" : "") + (O.getTime() === T.getTime() && Z === t.selectedMonth && t._keyEvent || _.getTime() === O.getTime() && _.getTime() === T.getTime() ? " " + this._dayOverClass : "") + (L ? " " + this._unselectableClass + " ui-state-disabled" : "") + (W && !v ? "" : " " + z[1] + (O.getTime() === G.getTime() ? " " + this._currentClass : "") + (O.getTime() === j.getTime() ? " ui-datepicker-today" : "")) + "'" + (W && !v || !z[2] ? "" : " title='" + z[2].replace(/'/g, "&#39;") + "'") + (L ? "" : " data-handler='selectDay' data-event='click' data-month='" + O.getMonth() + "' data-year='" + O.getFullYear() + "'") + ">" + (W && !v ? "&#xa0;" : L ? "<span class='ui-state-default'>" + O.getDate() + "</span>" : "<a class='ui-state-default" + (O.getTime() === j.getTime() ? " ui-state-highlight" : "") + (O.getTime() === G.getTime() ? " ui-state-active" : "") + (W ? " ui-priority-secondary" : "") + "' href='#'>" + O.getDate() + "</a>") + "</td>", O.setDate(O.getDate() + 1), O = this._daylightSavingAdjust(O);
            D += $ + "</tr>"
          }
          Z++, Z > 11 && (Z = 0, tt++), D += "</tbody></table>" + (V ? "</div>" + (U[0] > 0 && C === U[1] - 1 ? "<div class='ui-datepicker-row-break'></div>" : "") : ""), k += D
        }
        y += k
      }
      return y += h, t._keyEvent = !1, y
    },
    _generateMonthYearHeader: function(t, e, i, s, n, o, r, a) {
      var l, h, c, u, d, p, f, g, m = this._get(t, "changeMonth"),
        v = this._get(t, "changeYear"),
        b = this._get(t, "showMonthAfterYear"),
        _ = "<div class='ui-datepicker-title'>",
        y = "";
      if (o || !m) y += "<span class='ui-datepicker-month'>" + r[e] + "</span>";
      else {
        for (l = s && s.getFullYear() === i, h = n && n.getFullYear() === i, y += "<select class='ui-datepicker-month' data-handler='selectMonth' data-event='change'>", c = 0; c < 12; c++)(!l || c >= s.getMonth()) && (!h || c <= n.getMonth()) && (y += "<option value='" + c + "'" + (c === e ? " selected='selected'" : "") + ">" + a[c] + "</option>");
        y += "</select>"
      }
      if (b || (_ += y + (!o && m && v ? "" : "&#xa0;")), !t.yearshtml)
        if (t.yearshtml = "", o || !v) _ += "<span class='ui-datepicker-year'>" + i + "</span>";
        else {
          for (u = this._get(t, "yearRange").split(":"), d = (new Date).getFullYear(), p = function(t) {
              var e = t.match(/c[+\-].*/) ? i + parseInt(t.substring(1), 10) : t.match(/[+\-].*/) ? d + parseInt(t, 10) : parseInt(t, 10);
              return isNaN(e) ? d : e
            }, f = p(u[0]), g = Math.max(f, p(u[1] || "")), f = s ? Math.max(f, s.getFullYear()) : f, g = n ? Math.min(g, n.getFullYear()) : g, t.yearshtml += "<select class='ui-datepicker-year' data-handler='selectYear' data-event='change'>"; f <= g; f++) t.yearshtml += "<option value='" + f + "'" + (f === i ? " selected='selected'" : "") + ">" + f + "</option>";
          t.yearshtml += "</select>", _ += t.yearshtml, t.yearshtml = null
        }
      return _ += this._get(t, "yearSuffix"), b && (_ += (!o && m && v ? "" : "&#xa0;") + y), _ += "</div>"
    },
    _adjustInstDate: function(t, e, i) {
      var s = t.selectedYear + ("Y" === i ? e : 0),
        n = t.selectedMonth + ("M" === i ? e : 0),
        o = Math.min(t.selectedDay, this._getDaysInMonth(s, n)) + ("D" === i ? e : 0),
        r = this._restrictMinMax(t, this._daylightSavingAdjust(new Date(s, n, o)));
      t.selectedDay = r.getDate(), t.drawMonth = t.selectedMonth = r.getMonth(), t.drawYear = t.selectedYear = r.getFullYear(), "M" !== i && "Y" !== i || this._notifyChange(t)
    },
    _restrictMinMax: function(t, e) {
      var i = this._getMinMaxDate(t, "min"),
        s = this._getMinMaxDate(t, "max"),
        n = i && e < i ? i : e;
      return s && n > s ? s : n
    },
    _notifyChange: function(t) {
      var e = this._get(t, "onChangeMonthYear");
      e && e.apply(t.input ? t.input[0] : null, [t.selectedYear, t.selectedMonth + 1, t])
    },
    _getNumberOfMonths: function(t) {
      var e = this._get(t, "numberOfMonths");
      return null == e ? [1, 1] : "number" == typeof e ? [1, e] : e
    },
    _getMinMaxDate: function(t, e) {
      return this._determineDate(t, this._get(t, e + "Date"), null)
    },
    _getDaysInMonth: function(t, e) {
      return 32 - this._daylightSavingAdjust(new Date(t, e, 32)).getDate()
    },
    _getFirstDayOfMonth: function(t, e) {
      return new Date(t, e, 1).getDay()
    },
    _canAdjustMonth: function(t, e, i, s) {
      var n = this._getNumberOfMonths(t),
        o = this._daylightSavingAdjust(new Date(i, s + (e < 0 ? e : n[0] * n[1]), 1));
      return e < 0 && o.setDate(this._getDaysInMonth(o.getFullYear(), o.getMonth())), this._isInRange(t, o)
    },
    _isInRange: function(t, e) {
      var i, s, n = this._getMinMaxDate(t, "min"),
        o = this._getMinMaxDate(t, "max"),
        r = null,
        a = null,
        l = this._get(t, "yearRange");
      return l && (i = l.split(":"), s = (new Date).getFullYear(), r = parseInt(i[0], 10), a = parseInt(i[1], 10), i[0].match(/[+\-].*/) && (r += s), i[1].match(/[+\-].*/) && (a += s)), (!n || e.getTime() >= n.getTime()) && (!o || e.getTime() <= o.getTime()) && (!r || e.getFullYear() >= r) && (!a || e.getFullYear() <= a)
    },
    _getFormatConfig: function(t) {
      var e = this._get(t, "shortYearCutoff");
      return e = "string" != typeof e ? e : (new Date).getFullYear() % 100 + parseInt(e, 10), {
        shortYearCutoff: e,
        dayNamesShort: this._get(t, "dayNamesShort"),
        dayNames: this._get(t, "dayNames"),
        monthNamesShort: this._get(t, "monthNamesShort"),
        monthNames: this._get(t, "monthNames")
      }
    },
    _formatDate: function(t, e, i, s) {
      e || (t.currentDay = t.selectedDay, t.currentMonth = t.selectedMonth, t.currentYear = t.selectedYear);
      var n = e ? "object" == typeof e ? e : this._daylightSavingAdjust(new Date(s, i, e)) : this._daylightSavingAdjust(new Date(t.currentYear, t.currentMonth, t.currentDay));
      return this.formatDate(this._get(t, "dateFormat"), n, this._getFormatConfig(t))
    }
  }), t.fn.datepicker = function(e) {
    if (!this.length) return this;
    t.datepicker.initialized || (t(document).on("mousedown", t.datepicker._checkExternalClick), t.datepicker.initialized = !0), 0 === t("#" + t.datepicker._mainDivId).length && t("body").append(t.datepicker.dpDiv);
    var i = Array.prototype.slice.call(arguments, 1);
    return "string" != typeof e || "isDisabled" !== e && "getDate" !== e && "widget" !== e ? "option" === e && 2 === arguments.length && "string" == typeof arguments[1] ? t.datepicker["_" + e + "Datepicker"].apply(t.datepicker, [this[0]].concat(i)) : this.each(function() {
      "string" == typeof e ? t.datepicker["_" + e + "Datepicker"].apply(t.datepicker, [this].concat(i)) : t.datepicker._attachDatepicker(this, e)
    }) : t.datepicker["_" + e + "Datepicker"].apply(t.datepicker, [this[0]].concat(i))
  }, t.datepicker = new s, t.datepicker.initialized = !1, t.datepicker.uuid = (new Date).getTime(), t.datepicker.version = "1.12.1";
  var p = (t.datepicker, t.ui.ie = !!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase()), !1);
  t(document).on("mouseup", function() {
    p = !1
  });
  t.widget("ui.mouse", {
    version: "1.12.1",
    options: {
      cancel: "input, textarea, button, select, option",
      distance: 1,
      delay: 0
    },
    _mouseInit: function() {
      var e = this;
      this.element.on("mousedown." + this.widgetName, function(t) {
        return e._mouseDown(t)
      }).on("click." + this.widgetName, function(i) {
        if (!0 === t.data(i.target, e.widgetName + ".preventClickEvent")) return t.removeData(i.target, e.widgetName + ".preventClickEvent"), i.stopImmediatePropagation(), !1
      }), this.started = !1
    },
    _mouseDestroy: function() {
      this.element.off("." + this.widgetName), this._mouseMoveDelegate && this.document.off("mousemove." + this.widgetName, this._mouseMoveDelegate).off("mouseup." + this.widgetName, this._mouseUpDelegate)
    },
    _mouseDown: function(e) {
      if (!p) {
        this._mouseMoved = !1, this._mouseStarted && this._mouseUp(e), this._mouseDownEvent = e;
        var i = this,
          s = 1 === e.which,
          n = !("string" != typeof this.options.cancel || !e.target.nodeName) && t(e.target).closest(this.options.cancel).length;
        return !(s && !n && this._mouseCapture(e)) || (this.mouseDelayMet = !this.options.delay, this.mouseDelayMet || (this._mouseDelayTimer = setTimeout(function() {
          i.mouseDelayMet = !0
        }, this.options.delay)), this._mouseDistanceMet(e) && this._mouseDelayMet(e) && (this._mouseStarted = !1 !== this._mouseStart(e), !this._mouseStarted) ? (e.preventDefault(), !0) : (!0 === t.data(e.target, this.widgetName + ".preventClickEvent") && t.removeData(e.target, this.widgetName + ".preventClickEvent"), this._mouseMoveDelegate = function(t) {
          return i._mouseMove(t)
        }, this._mouseUpDelegate = function(t) {
          return i._mouseUp(t)
        }, this.document.on("mousemove." + this.widgetName, this._mouseMoveDelegate).on("mouseup." + this.widgetName, this._mouseUpDelegate), e.preventDefault(), p = !0, !0))
      }
    },
    _mouseMove: function(e) {
      if (this._mouseMoved) {
        if (t.ui.ie && (!document.documentMode || document.documentMode < 9) && !e.button) return this._mouseUp(e);
        if (!e.which)
          if (e.originalEvent.altKey || e.originalEvent.ctrlKey || e.originalEvent.metaKey || e.originalEvent.shiftKey) this.ignoreMissingWhich = !0;
          else if (!this.ignoreMissingWhich) return this._mouseUp(e)
      }
      return (e.which || e.button) && (this._mouseMoved = !0), this._mouseStarted ? (this._mouseDrag(e), e.preventDefault()) : (this._mouseDistanceMet(e) && this._mouseDelayMet(e) && (this._mouseStarted = !1 !== this._mouseStart(this._mouseDownEvent, e), this._mouseStarted ? this._mouseDrag(e) : this._mouseUp(e)), !this._mouseStarted)
    },
    _mouseUp: function(e) {
      this.document.off("mousemove." + this.widgetName, this._mouseMoveDelegate).off("mouseup." + this.widgetName, this._mouseUpDelegate), this._mouseStarted && (this._mouseStarted = !1, e.target === this._mouseDownEvent.target && t.data(e.target, this.widgetName + ".preventClickEvent", !0), this._mouseStop(e)), this._mouseDelayTimer && (clearTimeout(this._mouseDelayTimer), delete this._mouseDelayTimer), this.ignoreMissingWhich = !1, p = !1, e.preventDefault()
    },
    _mouseDistanceMet: function(t) {
      return Math.max(Math.abs(this._mouseDownEvent.pageX - t.pageX), Math.abs(this._mouseDownEvent.pageY - t.pageY)) >= this.options.distance
    },
    _mouseDelayMet: function() {
      return this.mouseDelayMet
    },
    _mouseStart: function() {},
    _mouseDrag: function() {},
    _mouseStop: function() {},
    _mouseCapture: function() {
      return !0
    }
  }), t.ui.plugin = {
    add: function(e, i, s) {
      var n, o = t.ui[e].prototype;
      for (n in s) o.plugins[n] = o.plugins[n] || [], o.plugins[n].push([i, s[n]])
    },
    call: function(t, e, i, s) {
      var n, o = t.plugins[e];
      if (o && (s || t.element[0].parentNode && 11 !== t.element[0].parentNode.nodeType))
        for (n = 0; n < o.length; n++) t.options[o[n][0]] && o[n][1].apply(t.element, i)
    }
  }, t.ui.safeBlur = function(e) {
    e && "body" !== e.nodeName.toLowerCase() && t(e).trigger("blur")
  };
  t.widget("ui.draggable", t.ui.mouse, {
    version: "1.12.1",
    widgetEventPrefix: "drag",
    options: {
      addClasses: !0,
      appendTo: "parent",
      axis: !1,
      connectToSortable: !1,
      containment: !1,
      cursor: "auto",
      cursorAt: !1,
      grid: !1,
      handle: !1,
      helper: "original",
      iframeFix: !1,
      opacity: !1,
      refreshPositions: !1,
      revert: !1,
      revertDuration: 500,
      scope: "default",
      scroll: !0,
      scrollSensitivity: 20,
      scrollSpeed: 20,
      snap: !1,
      snapMode: "both",
      snapTolerance: 20,
      stack: !1,
      zIndex: !1,
      drag: null,
      start: null,
      stop: null
    },
    _create: function() {
      "original" === this.options.helper && this._setPositionRelative(), this.options.addClasses && this._addClass("ui-draggable"), this._setHandleClassName(), this._mouseInit()
    },
    _setOption: function(t, e) {
      this._super(t, e), "handle" === t && (this._removeHandleClassName(), this._setHandleClassName())
    },
    _destroy: function() {
      if ((this.helper || this.element).is(".ui-draggable-dragging")) return void(this.destroyOnClear = !0);
      this._removeHandleClassName(), this._mouseDestroy()
    },
    _mouseCapture: function(e) {
      var i = this.options;
      return !(this.helper || i.disabled || t(e.target).closest(".ui-resizable-handle").length > 0) && (this.handle = this._getHandle(e), !!this.handle && (this._blurActiveElement(e), this._blockFrames(!0 === i.iframeFix ? "iframe" : i.iframeFix), !0))
    },
    _blockFrames: function(e) {
      this.iframeBlocks = this.document.find(e).map(function() {
        var e = t(this);
        return t("<div>").css("position", "absolute").appendTo(e.parent()).outerWidth(e.outerWidth()).outerHeight(e.outerHeight()).offset(e.offset())[0]
      })
    },
    _unblockFrames: function() {
      this.iframeBlocks && (this.iframeBlocks.remove(), delete this.iframeBlocks)
    },
    _blurActiveElement: function(e) {
      var i = t.ui.safeActiveElement(this.document[0]);
      t(e.target).closest(i).length || t.ui.safeBlur(i)
    },
    _mouseStart: function(e) {
      var i = this.options;
      return this.helper = this._createHelper(e), this._addClass(this.helper, "ui-draggable-dragging"), this._cacheHelperProportions(), t.ui.ddmanager && (t.ui.ddmanager.current = this), this._cacheMargins(), this.cssPosition = this.helper.css("position"), this.scrollParent = this.helper.scrollParent(!0), this.offsetParent = this.helper.offsetParent(), this.hasFixedAncestor = this.helper.parents().filter(function() {
        return "fixed" === t(this).css("position")
      }).length > 0, this.positionAbs = this.element.offset(), this._refreshOffsets(e), this.originalPosition = this.position = this._generatePosition(e, !1), this.originalPageX = e.pageX, this.originalPageY = e.pageY, i.cursorAt && this._adjustOffsetFromHelper(i.cursorAt), this._setContainment(), !1 === this._trigger("start", e) ? (this._clear(), !1) : (this._cacheHelperProportions(), t.ui.ddmanager && !i.dropBehaviour && t.ui.ddmanager.prepareOffsets(this, e), this._mouseDrag(e, !0), t.ui.ddmanager && t.ui.ddmanager.dragStart(this, e), !0)
    },
    _refreshOffsets: function(t) {
      this.offset = {
        top: this.positionAbs.top - this.margins.top,
        left: this.positionAbs.left - this.margins.left,
        scroll: !1,
        parent: this._getParentOffset(),
        relative: this._getRelativeOffset()
      }, this.offset.click = {
        left: t.pageX - this.offset.left,
        top: t.pageY - this.offset.top
      }
    },
    _mouseDrag: function(e, i) {
      if (this.hasFixedAncestor && (this.offset.parent = this._getParentOffset()), this.position = this._generatePosition(e, !0), this.positionAbs = this._convertPositionTo("absolute"), !i) {
        var s = this._uiHash();
        if (!1 === this._trigger("drag", e, s)) return this._mouseUp(new t.Event("mouseup", e)), !1;
        this.position = s.position
      }
      return this.helper[0].style.left = this.position.left + "px", this.helper[0].style.top = this.position.top + "px", t.ui.ddmanager && t.ui.ddmanager.drag(this, e), !1
    },
    _mouseStop: function(e) {
      var i = this,
        s = !1;
      return t.ui.ddmanager && !this.options.dropBehaviour && (s = t.ui.ddmanager.drop(this, e)), this.dropped && (s = this.dropped, this.dropped = !1), "invalid" === this.options.revert && !s || "valid" === this.options.revert && s || !0 === this.options.revert || t.isFunction(this.options.revert) && this.options.revert.call(this.element, s) ? t(this.helper).animate(this.originalPosition, parseInt(this.options.revertDuration, 10), function() {
        !1 !== i._trigger("stop", e) && i._clear()
      }) : !1 !== this._trigger("stop", e) && this._clear(), !1
    },
    _mouseUp: function(e) {
      return this._unblockFrames(), t.ui.ddmanager && t.ui.ddmanager.dragStop(this, e), this.handleElement.is(e.target) && this.element.trigger("focus"), t.ui.mouse.prototype._mouseUp.call(this, e)
    },
    cancel: function() {
      return this.helper.is(".ui-draggable-dragging") ? this._mouseUp(new t.Event("mouseup", {
        target: this.element[0]
      })) : this._clear(), this
    },
    _getHandle: function(e) {
      return !this.options.handle || !!t(e.target).closest(this.element.find(this.options.handle)).length
    },
    _setHandleClassName: function() {
      this.handleElement = this.options.handle ? this.element.find(this.options.handle) : this.element, this._addClass(this.handleElement, "ui-draggable-handle")
    },
    _removeHandleClassName: function() {
      this._removeClass(this.handleElement, "ui-draggable-handle")
    },
    _createHelper: function(e) {
      var i = this.options,
        s = t.isFunction(i.helper),
        n = s ? t(i.helper.apply(this.element[0], [e])) : "clone" === i.helper ? this.element.clone().removeAttr("id") : this.element;
      return n.parents("body").length || n.appendTo("parent" === i.appendTo ? this.element[0].parentNode : i.appendTo), s && n[0] === this.element[0] && this._setPositionRelative(), n[0] === this.element[0] || /(fixed|absolute)/.test(n.css("position")) || n.css("position", "absolute"), n
    },
    _setPositionRelative: function() {
      /^(?:r|a|f)/.test(this.element.css("position")) || (this.element[0].style.position = "relative")
    },
    _adjustOffsetFromHelper: function(e) {
      "string" == typeof e && (e = e.split(" ")), t.isArray(e) && (e = {
        left: +e[0],
        top: +e[1] || 0
      }), "left" in e && (this.offset.click.left = e.left + this.margins.left), "right" in e && (this.offset.click.left = this.helperProportions.width - e.right + this.margins.left), "top" in e && (this.offset.click.top = e.top + this.margins.top), "bottom" in e && (this.offset.click.top = this.helperProportions.height - e.bottom + this.margins.top)
    },
    _isRootNode: function(t) {
      return /(html|body)/i.test(t.tagName) || t === this.document[0]
    },
    _getParentOffset: function() {
      var e = this.offsetParent.offset(),
        i = this.document[0];
      return "absolute" === this.cssPosition && this.scrollParent[0] !== i && t.contains(this.scrollParent[0], this.offsetParent[0]) && (e.left += this.scrollParent.scrollLeft(), e.top += this.scrollParent.scrollTop()), this._isRootNode(this.offsetParent[0]) && (e = {
        top: 0,
        left: 0
      }), {
        top: e.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
        left: e.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)
      }
    },
    _getRelativeOffset: function() {
      if ("relative" !== this.cssPosition) return {
        top: 0,
        left: 0
      };
      var t = this.element.position(),
        e = this._isRootNode(this.scrollParent[0]);
      return {
        top: t.top - (parseInt(this.helper.css("top"), 10) || 0) + (e ? 0 : this.scrollParent.scrollTop()),
        left: t.left - (parseInt(this.helper.css("left"), 10) || 0) + (e ? 0 : this.scrollParent.scrollLeft())
      }
    },
    _cacheMargins: function() {
      this.margins = {
        left: parseInt(this.element.css("marginLeft"), 10) || 0,
        top: parseInt(this.element.css("marginTop"), 10) || 0,
        right: parseInt(this.element.css("marginRight"), 10) || 0,
        bottom: parseInt(this.element.css("marginBottom"), 10) || 0
      }
    },
    _cacheHelperProportions: function() {
      this.helperProportions = {
        width: this.helper.outerWidth(),
        height: this.helper.outerHeight()
      }
    },
    _setContainment: function() {
      var e, i, s, n = this.options,
        o = this.document[0];
      return this.relativeContainer = null, n.containment ? "window" === n.containment ? void(this.containment = [t(window).scrollLeft() - this.offset.relative.left - this.offset.parent.left, t(window).scrollTop() - this.offset.relative.top - this.offset.parent.top, t(window).scrollLeft() + t(window).width() - this.helperProportions.width - this.margins.left, t(window).scrollTop() + (t(window).height() || o.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]) : "document" === n.containment ? void(this.containment = [0, 0, t(o).width() - this.helperProportions.width - this.margins.left, (t(o).height() || o.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]) : n.containment.constructor === Array ? void(this.containment = n.containment) : ("parent" === n.containment && (n.containment = this.helper[0].parentNode), i = t(n.containment), void((s = i[0]) && (e = /(scroll|auto)/.test(i.css("overflow")), this.containment = [(parseInt(i.css("borderLeftWidth"), 10) || 0) + (parseInt(i.css("paddingLeft"), 10) || 0), (parseInt(i.css("borderTopWidth"), 10) || 0) + (parseInt(i.css("paddingTop"), 10) || 0), (e ? Math.max(s.scrollWidth, s.offsetWidth) : s.offsetWidth) - (parseInt(i.css("borderRightWidth"), 10) || 0) - (parseInt(i.css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left - this.margins.right, (e ? Math.max(s.scrollHeight, s.offsetHeight) : s.offsetHeight) - (parseInt(i.css("borderBottomWidth"), 10) || 0) - (parseInt(i.css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top - this.margins.bottom], this.relativeContainer = i))) : void(this.containment = null)
    },
    _convertPositionTo: function(t, e) {
      e || (e = this.position);
      var i = "absolute" === t ? 1 : -1,
        s = this._isRootNode(this.scrollParent[0]);
      return {
        top: e.top + this.offset.relative.top * i + this.offset.parent.top * i - ("fixed" === this.cssPosition ? -this.offset.scroll.top : s ? 0 : this.offset.scroll.top) * i,
        left: e.left + this.offset.relative.left * i + this.offset.parent.left * i - ("fixed" === this.cssPosition ? -this.offset.scroll.left : s ? 0 : this.offset.scroll.left) * i
      }
    },
    _generatePosition: function(t, e) {
      var i, s, n, o, r = this.options,
        a = this._isRootNode(this.scrollParent[0]),
        l = t.pageX,
        h = t.pageY;
      return a && this.offset.scroll || (this.offset.scroll = {
        top: this.scrollParent.scrollTop(),
        left: this.scrollParent.scrollLeft()
      }), e && (this.containment && (this.relativeContainer ? (s = this.relativeContainer.offset(), i = [this.containment[0] + s.left, this.containment[1] + s.top, this.containment[2] + s.left, this.containment[3] + s.top]) : i = this.containment, t.pageX - this.offset.click.left < i[0] && (l = i[0] + this.offset.click.left), t.pageY - this.offset.click.top < i[1] && (h = i[1] + this.offset.click.top), t.pageX - this.offset.click.left > i[2] && (l = i[2] + this.offset.click.left), t.pageY - this.offset.click.top > i[3] && (h = i[3] + this.offset.click.top)), r.grid && (n = r.grid[1] ? this.originalPageY + Math.round((h - this.originalPageY) / r.grid[1]) * r.grid[1] : this.originalPageY, h = i ? n - this.offset.click.top >= i[1] || n - this.offset.click.top > i[3] ? n : n - this.offset.click.top >= i[1] ? n - r.grid[1] : n + r.grid[1] : n, o = r.grid[0] ? this.originalPageX + Math.round((l - this.originalPageX) / r.grid[0]) * r.grid[0] : this.originalPageX, l = i ? o - this.offset.click.left >= i[0] || o - this.offset.click.left > i[2] ? o : o - this.offset.click.left >= i[0] ? o - r.grid[0] : o + r.grid[0] : o), "y" === r.axis && (l = this.originalPageX), "x" === r.axis && (h = this.originalPageY)), {
        top: h - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.offset.scroll.top : a ? 0 : this.offset.scroll.top),
        left: l - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.offset.scroll.left : a ? 0 : this.offset.scroll.left)
      }
    },
    _clear: function() {
      this._removeClass(this.helper, "ui-draggable-dragging"), this.helper[0] === this.element[0] || this.cancelHelperRemoval || this.helper.remove(), this.helper = null, this.cancelHelperRemoval = !1, this.destroyOnClear && this.destroy()
    },
    _trigger: function(e, i, s) {
      return s = s || this._uiHash(), t.ui.plugin.call(this, e, [i, s, this], !0), /^(drag|start|stop)/.test(e) && (this.positionAbs = this._convertPositionTo("absolute"), s.offset = this.positionAbs), t.Widget.prototype._trigger.call(this, e, i, s)
    },
    plugins: {},
    _uiHash: function() {
      return {
        helper: this.helper,
        position: this.position,
        originalPosition: this.originalPosition,
        offset: this.positionAbs
      }
    }
  }), t.ui.plugin.add("draggable", "connectToSortable", {
    start: function(e, i, s) {
      var n = t.extend({}, i, {
        item: s.element
      });
      s.sortables = [], t(s.options.connectToSortable).each(function() {
        var i = t(this).sortable("instance");
        i && !i.options.disabled && (s.sortables.push(i), i.refreshPositions(), i._trigger("activate", e, n))
      })
    },
    stop: function(e, i, s) {
      var n = t.extend({}, i, {
        item: s.element
      });
      s.cancelHelperRemoval = !1, t.each(s.sortables, function() {
        var t = this;
        t.isOver ? (t.isOver = 0, s.cancelHelperRemoval = !0, t.cancelHelperRemoval = !1, t._storedCSS = {
          position: t.placeholder.css("position"),
          top: t.placeholder.css("top"),
          left: t.placeholder.css("left")
        }, t._mouseStop(e), t.options.helper = t.options._helper) : (t.cancelHelperRemoval = !0, t._trigger("deactivate", e, n))
      })
    },
    drag: function(e, i, s) {
      t.each(s.sortables, function() {
        var n = !1,
          o = this;
        o.positionAbs = s.positionAbs, o.helperProportions = s.helperProportions, o.offset.click = s.offset.click, o._intersectsWith(o.containerCache) && (n = !0, t.each(s.sortables, function() {
          return this.positionAbs = s.positionAbs, this.helperProportions = s.helperProportions, this.offset.click = s.offset.click, this !== o && this._intersectsWith(this.containerCache) && t.contains(o.element[0], this.element[0]) && (n = !1), n
        })), n ? (o.isOver || (o.isOver = 1, s._parent = i.helper.parent(), o.currentItem = i.helper.appendTo(o.element).data("ui-sortable-item", !0), o.options._helper = o.options.helper, o.options.helper = function() {
          return i.helper[0]
        }, e.target = o.currentItem[0], o._mouseCapture(e, !0), o._mouseStart(e, !0, !0), o.offset.click.top = s.offset.click.top, o.offset.click.left = s.offset.click.left, o.offset.parent.left -= s.offset.parent.left - o.offset.parent.left, o.offset.parent.top -= s.offset.parent.top - o.offset.parent.top, s._trigger("toSortable", e), s.dropped = o.element, t.each(s.sortables, function() {
          this.refreshPositions()
        }), s.currentItem = s.element, o.fromOutside = s), o.currentItem && (o._mouseDrag(e), i.position = o.position)) : o.isOver && (o.isOver = 0, o.cancelHelperRemoval = !0, o.options._revert = o.options.revert, o.options.revert = !1, o._trigger("out", e, o._uiHash(o)), o._mouseStop(e, !0), o.options.revert = o.options._revert, o.options.helper = o.options._helper, o.placeholder && o.placeholder.remove(), i.helper.appendTo(s._parent), s._refreshOffsets(e), i.position = s._generatePosition(e, !0), s._trigger("fromSortable", e), s.dropped = !1, t.each(s.sortables, function() {
          this.refreshPositions()
        }))
      })
    }
  }), t.ui.plugin.add("draggable", "cursor", {
    start: function(e, i, s) {
      var n = t("body"),
        o = s.options;
      n.css("cursor") && (o._cursor = n.css("cursor")), n.css("cursor", o.cursor)
    },
    stop: function(e, i, s) {
      var n = s.options;
      n._cursor && t("body").css("cursor", n._cursor)
    }
  }), t.ui.plugin.add("draggable", "opacity", {
    start: function(e, i, s) {
      var n = t(i.helper),
        o = s.options;
      n.css("opacity") && (o._opacity = n.css("opacity")), n.css("opacity", o.opacity)
    },
    stop: function(e, i, s) {
      var n = s.options;
      n._opacity && t(i.helper).css("opacity", n._opacity)
    }
  }), t.ui.plugin.add("draggable", "scroll", {
    start: function(t, e, i) {
      i.scrollParentNotHidden || (i.scrollParentNotHidden = i.helper.scrollParent(!1)), i.scrollParentNotHidden[0] !== i.document[0] && "HTML" !== i.scrollParentNotHidden[0].tagName && (i.overflowOffset = i.scrollParentNotHidden.offset())
    },
    drag: function(e, i, s) {
      var n = s.options,
        o = !1,
        r = s.scrollParentNotHidden[0],
        a = s.document[0];
      r !== a && "HTML" !== r.tagName ? (n.axis && "x" === n.axis || (s.overflowOffset.top + r.offsetHeight - e.pageY < n.scrollSensitivity ? r.scrollTop = o = r.scrollTop + n.scrollSpeed : e.pageY - s.overflowOffset.top < n.scrollSensitivity && (r.scrollTop = o = r.scrollTop - n.scrollSpeed)),
        n.axis && "y" === n.axis || (s.overflowOffset.left + r.offsetWidth - e.pageX < n.scrollSensitivity ? r.scrollLeft = o = r.scrollLeft + n.scrollSpeed : e.pageX - s.overflowOffset.left < n.scrollSensitivity && (r.scrollLeft = o = r.scrollLeft - n.scrollSpeed))) : (n.axis && "x" === n.axis || (e.pageY - t(a).scrollTop() < n.scrollSensitivity ? o = t(a).scrollTop(t(a).scrollTop() - n.scrollSpeed) : t(window).height() - (e.pageY - t(a).scrollTop()) < n.scrollSensitivity && (o = t(a).scrollTop(t(a).scrollTop() + n.scrollSpeed))), n.axis && "y" === n.axis || (e.pageX - t(a).scrollLeft() < n.scrollSensitivity ? o = t(a).scrollLeft(t(a).scrollLeft() - n.scrollSpeed) : t(window).width() - (e.pageX - t(a).scrollLeft()) < n.scrollSensitivity && (o = t(a).scrollLeft(t(a).scrollLeft() + n.scrollSpeed)))), !1 !== o && t.ui.ddmanager && !n.dropBehaviour && t.ui.ddmanager.prepareOffsets(s, e)
    }
  }), t.ui.plugin.add("draggable", "snap", {
    start: function(e, i, s) {
      var n = s.options;
      s.snapElements = [], t(n.snap.constructor !== String ? n.snap.items || ":data(ui-draggable)" : n.snap).each(function() {
        var e = t(this),
          i = e.offset();
        this !== s.element[0] && s.snapElements.push({
          item: this,
          width: e.outerWidth(),
          height: e.outerHeight(),
          top: i.top,
          left: i.left
        })
      })
    },
    drag: function(e, i, s) {
      var n, o, r, a, l, h, c, u, d, p, f = s.options,
        g = f.snapTolerance,
        m = i.offset.left,
        v = m + s.helperProportions.width,
        b = i.offset.top,
        _ = b + s.helperProportions.height;
      for (d = s.snapElements.length - 1; d >= 0; d--) l = s.snapElements[d].left - s.margins.left, h = l + s.snapElements[d].width, c = s.snapElements[d].top - s.margins.top, u = c + s.snapElements[d].height, v < l - g || m > h + g || _ < c - g || b > u + g || !t.contains(s.snapElements[d].item.ownerDocument, s.snapElements[d].item) ? (s.snapElements[d].snapping && s.options.snap.release && s.options.snap.release.call(s.element, e, t.extend(s._uiHash(), {
        snapItem: s.snapElements[d].item
      })), s.snapElements[d].snapping = !1) : ("inner" !== f.snapMode && (n = Math.abs(c - _) <= g, o = Math.abs(u - b) <= g, r = Math.abs(l - v) <= g, a = Math.abs(h - m) <= g, n && (i.position.top = s._convertPositionTo("relative", {
        top: c - s.helperProportions.height,
        left: 0
      }).top), o && (i.position.top = s._convertPositionTo("relative", {
        top: u,
        left: 0
      }).top), r && (i.position.left = s._convertPositionTo("relative", {
        top: 0,
        left: l - s.helperProportions.width
      }).left), a && (i.position.left = s._convertPositionTo("relative", {
        top: 0,
        left: h
      }).left)), p = n || o || r || a, "outer" !== f.snapMode && (n = Math.abs(c - b) <= g, o = Math.abs(u - _) <= g, r = Math.abs(l - m) <= g, a = Math.abs(h - v) <= g, n && (i.position.top = s._convertPositionTo("relative", {
        top: c,
        left: 0
      }).top), o && (i.position.top = s._convertPositionTo("relative", {
        top: u - s.helperProportions.height,
        left: 0
      }).top), r && (i.position.left = s._convertPositionTo("relative", {
        top: 0,
        left: l
      }).left), a && (i.position.left = s._convertPositionTo("relative", {
        top: 0,
        left: h - s.helperProportions.width
      }).left)), !s.snapElements[d].snapping && (n || o || r || a || p) && s.options.snap.snap && s.options.snap.snap.call(s.element, e, t.extend(s._uiHash(), {
        snapItem: s.snapElements[d].item
      })), s.snapElements[d].snapping = n || o || r || a || p)
    }
  }), t.ui.plugin.add("draggable", "stack", {
    start: function(e, i, s) {
      var n, o = s.options,
        r = t.makeArray(t(o.stack)).sort(function(e, i) {
          return (parseInt(t(e).css("zIndex"), 10) || 0) - (parseInt(t(i).css("zIndex"), 10) || 0)
        });
      r.length && (n = parseInt(t(r[0]).css("zIndex"), 10) || 0, t(r).each(function(e) {
        t(this).css("zIndex", n + e)
      }), this.css("zIndex", n + r.length))
    }
  }), t.ui.plugin.add("draggable", "zIndex", {
    start: function(e, i, s) {
      var n = t(i.helper),
        o = s.options;
      n.css("zIndex") && (o._zIndex = n.css("zIndex")), n.css("zIndex", o.zIndex)
    },
    stop: function(e, i, s) {
      var n = s.options;
      n._zIndex && t(i.helper).css("zIndex", n._zIndex)
    }
  });
  t.ui.draggable;
  t.widget("ui.resizable", t.ui.mouse, {
    version: "1.12.1",
    widgetEventPrefix: "resize",
    options: {
      alsoResize: !1,
      animate: !1,
      animateDuration: "slow",
      animateEasing: "swing",
      aspectRatio: !1,
      autoHide: !1,
      classes: {
        "ui-resizable-se": "ui-icon ui-icon-gripsmall-diagonal-se"
      },
      containment: !1,
      ghost: !1,
      grid: !1,
      handles: "e,s,se",
      helper: !1,
      maxHeight: null,
      maxWidth: null,
      minHeight: 10,
      minWidth: 10,
      zIndex: 90,
      resize: null,
      start: null,
      stop: null
    },
    _num: function(t) {
      return parseFloat(t) || 0
    },
    _isNumber: function(t) {
      return !isNaN(parseFloat(t))
    },
    _hasScroll: function(e, i) {
      if ("hidden" === t(e).css("overflow")) return !1;
      var s = i && "left" === i ? "scrollLeft" : "scrollTop",
        n = !1;
      return e[s] > 0 || (e[s] = 1, n = e[s] > 0, e[s] = 0, n)
    },
    _create: function() {
      var e, i = this.options,
        s = this;
      this._addClass("ui-resizable"), t.extend(this, {
        _aspectRatio: !!i.aspectRatio,
        aspectRatio: i.aspectRatio,
        originalElement: this.element,
        _proportionallyResizeElements: [],
        _helper: i.helper || i.ghost || i.animate ? i.helper || "ui-resizable-helper" : null
      }), this.element[0].nodeName.match(/^(canvas|textarea|input|select|button|img)$/i) && (this.element.wrap(t("<div class='ui-wrapper' style='overflow: hidden;'></div>").css({
        position: this.element.css("position"),
        width: this.element.outerWidth(),
        height: this.element.outerHeight(),
        top: this.element.css("top"),
        left: this.element.css("left")
      })), this.element = this.element.parent().data("ui-resizable", this.element.resizable("instance")), this.elementIsWrapper = !0, e = {
        marginTop: this.originalElement.css("marginTop"),
        marginRight: this.originalElement.css("marginRight"),
        marginBottom: this.originalElement.css("marginBottom"),
        marginLeft: this.originalElement.css("marginLeft")
      }, this.element.css(e), this.originalElement.css("margin", 0), this.originalResizeStyle = this.originalElement.css("resize"), this.originalElement.css("resize", "none"), this._proportionallyResizeElements.push(this.originalElement.css({
        position: "static",
        zoom: 1,
        display: "block"
      })), this.originalElement.css(e), this._proportionallyResize()), this._setupHandles(), i.autoHide && t(this.element).on("mouseenter", function() {
        i.disabled || (s._removeClass("ui-resizable-autohide"), s._handles.show())
      }).on("mouseleave", function() {
        i.disabled || s.resizing || (s._addClass("ui-resizable-autohide"), s._handles.hide())
      }), this._mouseInit()
    },
    _destroy: function() {
      this._mouseDestroy();
      var e, i = function(e) {
        t(e).removeData("resizable").removeData("ui-resizable").off(".resizable").find(".ui-resizable-handle").remove()
      };
      return this.elementIsWrapper && (i(this.element), e = this.element, this.originalElement.css({
        position: e.css("position"),
        width: e.outerWidth(),
        height: e.outerHeight(),
        top: e.css("top"),
        left: e.css("left")
      }).insertAfter(e), e.remove()), this.originalElement.css("resize", this.originalResizeStyle), i(this.originalElement), this
    },
    _setOption: function(t, e) {
      switch (this._super(t, e), t) {
        case "handles":
          this._removeHandles(), this._setupHandles()
      }
    },
    _setupHandles: function() {
      var e, i, s, n, o, r = this.options,
        a = this;
      if (this.handles = r.handles || (t(".ui-resizable-handle", this.element).length ? {
          n: ".ui-resizable-n",
          e: ".ui-resizable-e",
          s: ".ui-resizable-s",
          w: ".ui-resizable-w",
          se: ".ui-resizable-se",
          sw: ".ui-resizable-sw",
          ne: ".ui-resizable-ne",
          nw: ".ui-resizable-nw"
        } : "e,s,se"), this._handles = t(), this.handles.constructor === String)
        for ("all" === this.handles && (this.handles = "n,e,s,w,se,sw,ne,nw"), s = this.handles.split(","), this.handles = {}, i = 0; i < s.length; i++) e = t.trim(s[i]), n = "ui-resizable-" + e, o = t("<div>"), this._addClass(o, "ui-resizable-handle " + n), o.css({
          zIndex: r.zIndex
        }), this.handles[e] = ".ui-resizable-" + e, this.element.append(o);
      this._renderAxis = function(e) {
        var i, s, n, o;
        e = e || this.element;
        for (i in this.handles) this.handles[i].constructor === String ? this.handles[i] = this.element.children(this.handles[i]).first().show() : (this.handles[i].jquery || this.handles[i].nodeType) && (this.handles[i] = t(this.handles[i]), this._on(this.handles[i], {
          mousedown: a._mouseDown
        })), this.elementIsWrapper && this.originalElement[0].nodeName.match(/^(textarea|input|select|button)$/i) && (s = t(this.handles[i], this.element), o = /sw|ne|nw|se|n|s/.test(i) ? s.outerHeight() : s.outerWidth(), n = ["padding", /ne|nw|n/.test(i) ? "Top" : /se|sw|s/.test(i) ? "Bottom" : /^e$/.test(i) ? "Right" : "Left"].join(""), e.css(n, o), this._proportionallyResize()), this._handles = this._handles.add(this.handles[i])
      }, this._renderAxis(this.element), this._handles = this._handles.add(this.element.find(".ui-resizable-handle")), this._handles.disableSelection(), this._handles.on("mouseover", function() {
        a.resizing || (this.className && (o = this.className.match(/ui-resizable-(se|sw|ne|nw|n|e|s|w)/i)), a.axis = o && o[1] ? o[1] : "se")
      }), r.autoHide && (this._handles.hide(), this._addClass("ui-resizable-autohide"))
    },
    _removeHandles: function() {
      this._handles.remove()
    },
    _mouseCapture: function(e) {
      var i, s, n = !1;
      for (i in this.handles)((s = t(this.handles[i])[0]) === e.target || t.contains(s, e.target)) && (n = !0);
      return !this.options.disabled && n
    },
    _mouseStart: function(e) {
      var i, s, n, o = this.options,
        r = this.element;
      return this.resizing = !0, this._renderProxy(), i = this._num(this.helper.css("left")), s = this._num(this.helper.css("top")), o.containment && (i += t(o.containment).scrollLeft() || 0, s += t(o.containment).scrollTop() || 0), this.offset = this.helper.offset(), this.position = {
        left: i,
        top: s
      }, this.size = this._helper ? {
        width: this.helper.width(),
        height: this.helper.height()
      } : {
        width: r.width(),
        height: r.height()
      }, this.originalSize = this._helper ? {
        width: r.outerWidth(),
        height: r.outerHeight()
      } : {
        width: r.width(),
        height: r.height()
      }, this.sizeDiff = {
        width: r.outerWidth() - r.width(),
        height: r.outerHeight() - r.height()
      }, this.originalPosition = {
        left: i,
        top: s
      }, this.originalMousePosition = {
        left: e.pageX,
        top: e.pageY
      }, this.aspectRatio = "number" == typeof o.aspectRatio ? o.aspectRatio : this.originalSize.width / this.originalSize.height || 1, n = t(".ui-resizable-" + this.axis).css("cursor"), t("body").css("cursor", "auto" === n ? this.axis + "-resize" : n), this._addClass("ui-resizable-resizing"), this._propagate("start", e), !0
    },
    _mouseDrag: function(e) {
      var i, s, n = this.originalMousePosition,
        o = this.axis,
        r = e.pageX - n.left || 0,
        a = e.pageY - n.top || 0,
        l = this._change[o];
      return this._updatePrevProperties(), !!l && (i = l.apply(this, [e, r, a]), this._updateVirtualBoundaries(e.shiftKey), (this._aspectRatio || e.shiftKey) && (i = this._updateRatio(i, e)), i = this._respectSize(i, e), this._updateCache(i), this._propagate("resize", e), s = this._applyChanges(), !this._helper && this._proportionallyResizeElements.length && this._proportionallyResize(), t.isEmptyObject(s) || (this._updatePrevProperties(), this._trigger("resize", e, this.ui()), this._applyChanges()), !1)
    },
    _mouseStop: function(e) {
      this.resizing = !1;
      var i, s, n, o, r, a, l, h = this.options,
        c = this;
      return this._helper && (i = this._proportionallyResizeElements, s = i.length && /textarea/i.test(i[0].nodeName), n = s && this._hasScroll(i[0], "left") ? 0 : c.sizeDiff.height, o = s ? 0 : c.sizeDiff.width, r = {
        width: c.helper.width() - o,
        height: c.helper.height() - n
      }, a = parseFloat(c.element.css("left")) + (c.position.left - c.originalPosition.left) || null, l = parseFloat(c.element.css("top")) + (c.position.top - c.originalPosition.top) || null, h.animate || this.element.css(t.extend(r, {
        top: l,
        left: a
      })), c.helper.height(c.size.height), c.helper.width(c.size.width), this._helper && !h.animate && this._proportionallyResize()), t("body").css("cursor", "auto"), this._removeClass("ui-resizable-resizing"), this._propagate("stop", e), this._helper && this.helper.remove(), !1
    },
    _updatePrevProperties: function() {
      this.prevPosition = {
        top: this.position.top,
        left: this.position.left
      }, this.prevSize = {
        width: this.size.width,
        height: this.size.height
      }
    },
    _applyChanges: function() {
      var t = {};
      return this.position.top !== this.prevPosition.top && (t.top = this.position.top + "px"), this.position.left !== this.prevPosition.left && (t.left = this.position.left + "px"), this.size.width !== this.prevSize.width && (t.width = this.size.width + "px"), this.size.height !== this.prevSize.height && (t.height = this.size.height + "px"), this.helper.css(t), t
    },
    _updateVirtualBoundaries: function(t) {
      var e, i, s, n, o, r = this.options;
      o = {
        minWidth: this._isNumber(r.minWidth) ? r.minWidth : 0,
        maxWidth: this._isNumber(r.maxWidth) ? r.maxWidth : 1 / 0,
        minHeight: this._isNumber(r.minHeight) ? r.minHeight : 0,
        maxHeight: this._isNumber(r.maxHeight) ? r.maxHeight : 1 / 0
      }, (this._aspectRatio || t) && (e = o.minHeight * this.aspectRatio, s = o.minWidth / this.aspectRatio, i = o.maxHeight * this.aspectRatio, n = o.maxWidth / this.aspectRatio, e > o.minWidth && (o.minWidth = e), s > o.minHeight && (o.minHeight = s), i < o.maxWidth && (o.maxWidth = i), n < o.maxHeight && (o.maxHeight = n)), this._vBoundaries = o
    },
    _updateCache: function(t) {
      this.offset = this.helper.offset(), this._isNumber(t.left) && (this.position.left = t.left), this._isNumber(t.top) && (this.position.top = t.top), this._isNumber(t.height) && (this.size.height = t.height), this._isNumber(t.width) && (this.size.width = t.width)
    },
    _updateRatio: function(t) {
      var e = this.position,
        i = this.size,
        s = this.axis;
      return this._isNumber(t.height) ? t.width = t.height * this.aspectRatio : this._isNumber(t.width) && (t.height = t.width / this.aspectRatio), "sw" === s && (t.left = e.left + (i.width - t.width), t.top = null), "nw" === s && (t.top = e.top + (i.height - t.height), t.left = e.left + (i.width - t.width)), t
    },
    _respectSize: function(t) {
      var e = this._vBoundaries,
        i = this.axis,
        s = this._isNumber(t.width) && e.maxWidth && e.maxWidth < t.width,
        n = this._isNumber(t.height) && e.maxHeight && e.maxHeight < t.height,
        o = this._isNumber(t.width) && e.minWidth && e.minWidth > t.width,
        r = this._isNumber(t.height) && e.minHeight && e.minHeight > t.height,
        a = this.originalPosition.left + this.originalSize.width,
        l = this.originalPosition.top + this.originalSize.height,
        h = /sw|nw|w/.test(i),
        c = /nw|ne|n/.test(i);
      return o && (t.width = e.minWidth), r && (t.height = e.minHeight), s && (t.width = e.maxWidth), n && (t.height = e.maxHeight), o && h && (t.left = a - e.minWidth), s && h && (t.left = a - e.maxWidth), r && c && (t.top = l - e.minHeight), n && c && (t.top = l - e.maxHeight), t.width || t.height || t.left || !t.top ? t.width || t.height || t.top || !t.left || (t.left = null) : t.top = null, t
    },
    _getPaddingPlusBorderDimensions: function(t) {
      for (var e = 0, i = [], s = [t.css("borderTopWidth"), t.css("borderRightWidth"), t.css("borderBottomWidth"), t.css("borderLeftWidth")], n = [t.css("paddingTop"), t.css("paddingRight"), t.css("paddingBottom"), t.css("paddingLeft")]; e < 4; e++) i[e] = parseFloat(s[e]) || 0, i[e] += parseFloat(n[e]) || 0;
      return {
        height: i[0] + i[2],
        width: i[1] + i[3]
      }
    },
    _proportionallyResize: function() {
      if (this._proportionallyResizeElements.length)
        for (var t, e = 0, i = this.helper || this.element; e < this._proportionallyResizeElements.length; e++) t = this._proportionallyResizeElements[e], this.outerDimensions || (this.outerDimensions = this._getPaddingPlusBorderDimensions(t)), t.css({
          height: i.height() - this.outerDimensions.height || 0,
          width: i.width() - this.outerDimensions.width || 0
        })
    },
    _renderProxy: function() {
      var e = this.element,
        i = this.options;
      this.elementOffset = e.offset(), this._helper ? (this.helper = this.helper || t("<div style='overflow:hidden;'></div>"), this._addClass(this.helper, this._helper), this.helper.css({
        width: this.element.outerWidth(),
        height: this.element.outerHeight(),
        position: "absolute",
        left: this.elementOffset.left + "px",
        top: this.elementOffset.top + "px",
        zIndex: ++i.zIndex
      }), this.helper.appendTo("body").disableSelection()) : this.helper = this.element
    },
    _change: {
      e: function(t, e) {
        return {
          width: this.originalSize.width + e
        }
      },
      w: function(t, e) {
        var i = this.originalSize;
        return {
          left: this.originalPosition.left + e,
          width: i.width - e
        }
      },
      n: function(t, e, i) {
        var s = this.originalSize;
        return {
          top: this.originalPosition.top + i,
          height: s.height - i
        }
      },
      s: function(t, e, i) {
        return {
          height: this.originalSize.height + i
        }
      },
      se: function(e, i, s) {
        return t.extend(this._change.s.apply(this, arguments), this._change.e.apply(this, [e, i, s]))
      },
      sw: function(e, i, s) {
        return t.extend(this._change.s.apply(this, arguments), this._change.w.apply(this, [e, i, s]))
      },
      ne: function(e, i, s) {
        return t.extend(this._change.n.apply(this, arguments), this._change.e.apply(this, [e, i, s]))
      },
      nw: function(e, i, s) {
        return t.extend(this._change.n.apply(this, arguments), this._change.w.apply(this, [e, i, s]))
      }
    },
    _propagate: function(e, i) {
      t.ui.plugin.call(this, e, [i, this.ui()]), "resize" !== e && this._trigger(e, i, this.ui())
    },
    plugins: {},
    ui: function() {
      return {
        originalElement: this.originalElement,
        element: this.element,
        helper: this.helper,
        position: this.position,
        size: this.size,
        originalSize: this.originalSize,
        originalPosition: this.originalPosition
      }
    }
  }), t.ui.plugin.add("resizable", "animate", {
    stop: function(e) {
      var i = t(this).resizable("instance"),
        s = i.options,
        n = i._proportionallyResizeElements,
        o = n.length && /textarea/i.test(n[0].nodeName),
        r = o && i._hasScroll(n[0], "left") ? 0 : i.sizeDiff.height,
        a = o ? 0 : i.sizeDiff.width,
        l = {
          width: i.size.width - a,
          height: i.size.height - r
        },
        h = parseFloat(i.element.css("left")) + (i.position.left - i.originalPosition.left) || null,
        c = parseFloat(i.element.css("top")) + (i.position.top - i.originalPosition.top) || null;
      i.element.animate(t.extend(l, c && h ? {
        top: c,
        left: h
      } : {}), {
        duration: s.animateDuration,
        easing: s.animateEasing,
        step: function() {
          var s = {
            width: parseFloat(i.element.css("width")),
            height: parseFloat(i.element.css("height")),
            top: parseFloat(i.element.css("top")),
            left: parseFloat(i.element.css("left"))
          };
          n && n.length && t(n[0]).css({
            width: s.width,
            height: s.height
          }), i._updateCache(s), i._propagate("resize", e)
        }
      })
    }
  }), t.ui.plugin.add("resizable", "containment", {
    start: function() {
      var e, i, s, n, o, r, a, l = t(this).resizable("instance"),
        h = l.options,
        c = l.element,
        u = h.containment,
        d = u instanceof t ? u.get(0) : /parent/.test(u) ? c.parent().get(0) : u;
      d && (l.containerElement = t(d), /document/.test(u) || u === document ? (l.containerOffset = {
        left: 0,
        top: 0
      }, l.containerPosition = {
        left: 0,
        top: 0
      }, l.parentData = {
        element: t(document),
        left: 0,
        top: 0,
        width: t(document).width(),
        height: t(document).height() || document.body.parentNode.scrollHeight
      }) : (e = t(d), i = [], t(["Top", "Right", "Left", "Bottom"]).each(function(t, s) {
        i[t] = l._num(e.css("padding" + s))
      }), l.containerOffset = e.offset(), l.containerPosition = e.position(), l.containerSize = {
        height: e.innerHeight() - i[3],
        width: e.innerWidth() - i[1]
      }, s = l.containerOffset, n = l.containerSize.height, o = l.containerSize.width, r = l._hasScroll(d, "left") ? d.scrollWidth : o, a = l._hasScroll(d) ? d.scrollHeight : n, l.parentData = {
        element: d,
        left: s.left,
        top: s.top,
        width: r,
        height: a
      }))
    },
    resize: function(e) {
      var i, s, n, o, r = t(this).resizable("instance"),
        a = r.options,
        l = r.containerOffset,
        h = r.position,
        c = r._aspectRatio || e.shiftKey,
        u = {
          top: 0,
          left: 0
        },
        d = r.containerElement,
        p = !0;
      d[0] !== document && /static/.test(d.css("position")) && (u = l), h.left < (r._helper ? l.left : 0) && (r.size.width = r.size.width + (r._helper ? r.position.left - l.left : r.position.left - u.left), c && (r.size.height = r.size.width / r.aspectRatio, p = !1), r.position.left = a.helper ? l.left : 0), h.top < (r._helper ? l.top : 0) && (r.size.height = r.size.height + (r._helper ? r.position.top - l.top : r.position.top), c && (r.size.width = r.size.height * r.aspectRatio, p = !1), r.position.top = r._helper ? l.top : 0), n = r.containerElement.get(0) === r.element.parent().get(0), o = /relative|absolute/.test(r.containerElement.css("position")), n && o ? (r.offset.left = r.parentData.left + r.position.left, r.offset.top = r.parentData.top + r.position.top) : (r.offset.left = r.element.offset().left, r.offset.top = r.element.offset().top), i = Math.abs(r.sizeDiff.width + (r._helper ? r.offset.left - u.left : r.offset.left - l.left)), s = Math.abs(r.sizeDiff.height + (r._helper ? r.offset.top - u.top : r.offset.top - l.top)), i + r.size.width >= r.parentData.width && (r.size.width = r.parentData.width - i, c && (r.size.height = r.size.width / r.aspectRatio, p = !1)), s + r.size.height >= r.parentData.height && (r.size.height = r.parentData.height - s, c && (r.size.width = r.size.height * r.aspectRatio, p = !1)), p || (r.position.left = r.prevPosition.left, r.position.top = r.prevPosition.top, r.size.width = r.prevSize.width, r.size.height = r.prevSize.height)
    },
    stop: function() {
      var e = t(this).resizable("instance"),
        i = e.options,
        s = e.containerOffset,
        n = e.containerPosition,
        o = e.containerElement,
        r = t(e.helper),
        a = r.offset(),
        l = r.outerWidth() - e.sizeDiff.width,
        h = r.outerHeight() - e.sizeDiff.height;
      e._helper && !i.animate && /relative/.test(o.css("position")) && t(this).css({
        left: a.left - n.left - s.left,
        width: l,
        height: h
      }), e._helper && !i.animate && /static/.test(o.css("position")) && t(this).css({
        left: a.left - n.left - s.left,
        width: l,
        height: h
      })
    }
  }), t.ui.plugin.add("resizable", "alsoResize", {
    start: function() {
      var e = t(this).resizable("instance"),
        i = e.options;
      t(i.alsoResize).each(function() {
        var e = t(this);
        e.data("ui-resizable-alsoresize", {
          width: parseFloat(e.width()),
          height: parseFloat(e.height()),
          left: parseFloat(e.css("left")),
          top: parseFloat(e.css("top"))
        })
      })
    },
    resize: function(e, i) {
      var s = t(this).resizable("instance"),
        n = s.options,
        o = s.originalSize,
        r = s.originalPosition,
        a = {
          height: s.size.height - o.height || 0,
          width: s.size.width - o.width || 0,
          top: s.position.top - r.top || 0,
          left: s.position.left - r.left || 0
        };
      t(n.alsoResize).each(function() {
        var e = t(this),
          s = t(this).data("ui-resizable-alsoresize"),
          n = {},
          o = e.parents(i.originalElement[0]).length ? ["width", "height"] : ["width", "height", "top", "left"];
        t.each(o, function(t, e) {
          var i = (s[e] || 0) + (a[e] || 0);
          i && i >= 0 && (n[e] = i || null)
        }), e.css(n)
      })
    },
    stop: function() {
      t(this).removeData("ui-resizable-alsoresize")
    }
  }), t.ui.plugin.add("resizable", "ghost", {
    start: function() {
      var e = t(this).resizable("instance"),
        i = e.size;
      e.ghost = e.originalElement.clone(), e.ghost.css({
        opacity: .25,
        display: "block",
        position: "relative",
        height: i.height,
        width: i.width,
        margin: 0,
        left: 0,
        top: 0
      }), e._addClass(e.ghost, "ui-resizable-ghost"), !1 !== t.uiBackCompat && "string" == typeof e.options.ghost && e.ghost.addClass(this.options.ghost), e.ghost.appendTo(e.helper)
    },
    resize: function() {
      var e = t(this).resizable("instance");
      e.ghost && e.ghost.css({
        position: "relative",
        height: e.size.height,
        width: e.size.width
      })
    },
    stop: function() {
      var e = t(this).resizable("instance");
      e.ghost && e.helper && e.helper.get(0).removeChild(e.ghost.get(0))
    }
  }), t.ui.plugin.add("resizable", "grid", {
    resize: function() {
      var e, i = t(this).resizable("instance"),
        s = i.options,
        n = i.size,
        o = i.originalSize,
        r = i.originalPosition,
        a = i.axis,
        l = "number" == typeof s.grid ? [s.grid, s.grid] : s.grid,
        h = l[0] || 1,
        c = l[1] || 1,
        u = Math.round((n.width - o.width) / h) * h,
        d = Math.round((n.height - o.height) / c) * c,
        p = o.width + u,
        f = o.height + d,
        g = s.maxWidth && s.maxWidth < p,
        m = s.maxHeight && s.maxHeight < f,
        v = s.minWidth && s.minWidth > p,
        b = s.minHeight && s.minHeight > f;
      s.grid = l, v && (p += h), b && (f += c), g && (p -= h), m && (f -= c), /^(se|s|e)$/.test(a) ? (i.size.width = p, i.size.height = f) : /^(ne)$/.test(a) ? (i.size.width = p, i.size.height = f, i.position.top = r.top - d) : /^(sw)$/.test(a) ? (i.size.width = p, i.size.height = f, i.position.left = r.left - u) : ((f - c <= 0 || p - h <= 0) && (e = i._getPaddingPlusBorderDimensions(this)), f - c > 0 ? (i.size.height = f, i.position.top = r.top - d) : (f = c - e.height, i.size.height = f, i.position.top = r.top + o.height - f), p - h > 0 ? (i.size.width = p, i.position.left = r.left - u) : (p = h - e.width, i.size.width = p, i.position.left = r.left + o.width - p))
    }
  });
  t.ui.resizable;
  t.widget("ui.dialog", {
    version: "1.12.1",
    options: {
      appendTo: "body",
      autoOpen: !0,
      buttons: [],
      classes: {
        "ui-dialog": "ui-corner-all",
        "ui-dialog-titlebar": "ui-corner-all"
      },
      closeOnEscape: !0,
      closeText: "Close",
      draggable: !0,
      hide: null,
      height: "auto",
      maxHeight: null,
      maxWidth: null,
      minHeight: 150,
      minWidth: 150,
      modal: !1,
      position: {
        my: "center",
        at: "center",
        of: window,
        collision: "fit",
        using: function(e) {
          var i = t(this).css(e).offset().top;
          i < 0 && t(this).css("top", e.top - i)
        }
      },
      resizable: !0,
      show: null,
      title: null,
      width: 300,
      beforeClose: null,
      close: null,
      drag: null,
      dragStart: null,
      dragStop: null,
      focus: null,
      open: null,
      resize: null,
      resizeStart: null,
      resizeStop: null
    },
    sizeRelatedOptions: {
      buttons: !0,
      height: !0,
      maxHeight: !0,
      maxWidth: !0,
      minHeight: !0,
      minWidth: !0,
      width: !0
    },
    resizableRelatedOptions: {
      maxHeight: !0,
      maxWidth: !0,
      minHeight: !0,
      minWidth: !0
    },
    _create: function() {
      this.originalCss = {
        display: this.element[0].style.display,
        width: this.element[0].style.width,
        minHeight: this.element[0].style.minHeight,
        maxHeight: this.element[0].style.maxHeight,
        height: this.element[0].style.height
      }, this.originalPosition = {
        parent: this.element.parent(),
        index: this.element.parent().children().index(this.element)
      }, this.originalTitle = this.element.attr("title"), null == this.options.title && null != this.originalTitle && (this.options.title = this.originalTitle), this.options.disabled && (this.options.disabled = !1), this._createWrapper(), this.element.show().removeAttr("title").appendTo(this.uiDialog), this._addClass("ui-dialog-content", "ui-widget-content"), this._createTitlebar(), this._createButtonPane(), this.options.draggable && t.fn.draggable && this._makeDraggable(), this.options.resizable && t.fn.resizable && this._makeResizable(), this._isOpen = !1, this._trackFocus()
    },
    _init: function() {
      this.options.autoOpen && this.open()
    },
    _appendTo: function() {
      var e = this.options.appendTo;
      return e && (e.jquery || e.nodeType) ? t(e) : this.document.find(e || "body").eq(0)
    },
    _destroy: function() {
      var t, e = this.originalPosition;
      this._untrackInstance(), this._destroyOverlay(), this.element.removeUniqueId().css(this.originalCss).detach(), this.uiDialog.remove(), this.originalTitle && this.element.attr("title", this.originalTitle), t = e.parent.children().eq(e.index), t.length && t[0] !== this.element[0] ? t.before(this.element) : e.parent.append(this.element)
    },
    widget: function() {
      return this.uiDialog
    },
    disable: t.noop,
    enable: t.noop,
    close: function(e) {
      var i = this;
      this._isOpen && !1 !== this._trigger("beforeClose", e) && (this._isOpen = !1, this._focusedElement = null, this._destroyOverlay(), this._untrackInstance(), this.opener.filter(":focusable").trigger("focus").length || t.ui.safeBlur(t.ui.safeActiveElement(this.document[0])), this._hide(this.uiDialog, this.options.hide, function() {
        i._trigger("close", e)
      }))
    },
    isOpen: function() {
      return this._isOpen
    },
    moveToTop: function() {
      this._moveToTop()
    },
    _moveToTop: function(e, i) {
      var s = !1,
        n = this.uiDialog.siblings(".ui-front:visible").map(function() {
          return +t(this).css("z-index")
        }).get(),
        o = Math.max.apply(null, n);
      return o >= +this.uiDialog.css("z-index") && (this.uiDialog.css("z-index", o + 1), s = !0), s && !i && this._trigger("focus", e), s
    },
    open: function() {
      var e = this;
      if (this._isOpen) return void(this._moveToTop() && this._focusTabbable());
      this._isOpen = !0, this.opener = t(t.ui.safeActiveElement(this.document[0])), this._size(), this._position(), this._createOverlay(), this._moveToTop(null, !0), this.overlay && this.overlay.css("z-index", this.uiDialog.css("z-index") - 1), this._show(this.uiDialog, this.options.show, function() {
        e._focusTabbable(), e._trigger("focus")
      }), this._makeFocusTarget(), this._trigger("open")
    },
    _focusTabbable: function() {
      var t = this._focusedElement;
      t || (t = this.element.find("[autofocus]")), t.length || (t = this.element.find(":tabbable")), t.length || (t = this.uiDialogButtonPane.find(":tabbable")), t.length || (t = this.uiDialogTitlebarClose.filter(":tabbable")), t.length || (t = this.uiDialog), t.eq(0).trigger("focus")
    },
    _keepFocus: function(e) {
      function i() {
        var e = t.ui.safeActiveElement(this.document[0]);
        this.uiDialog[0] === e || t.contains(this.uiDialog[0], e) || this._focusTabbable()
      }
      e.preventDefault(), i.call(this), this._delay(i)
    },
    _createWrapper: function() {
      this.uiDialog = t("<div>").hide().attr({
        tabIndex: -1,
        role: "dialog"
      }).appendTo(this._appendTo()), this._addClass(this.uiDialog, "ui-dialog", "ui-widget ui-widget-content ui-front"), this._on(this.uiDialog, {
        keydown: function(e) {
          if (this.options.closeOnEscape && !e.isDefaultPrevented() && e.keyCode && e.keyCode === t.ui.keyCode.ESCAPE) return e.preventDefault(), void this.close(e);
          if (e.keyCode === t.ui.keyCode.TAB && !e.isDefaultPrevented()) {
            var i = this.uiDialog.find(":tabbable"),
              s = i.filter(":first"),
              n = i.filter(":last");
            e.target !== n[0] && e.target !== this.uiDialog[0] || e.shiftKey ? e.target !== s[0] && e.target !== this.uiDialog[0] || !e.shiftKey || (this._delay(function() {
              n.trigger("focus")
            }), e.preventDefault()) : (this._delay(function() {
              s.trigger("focus")
            }), e.preventDefault())
          }
        },
        mousedown: function(t) {
          this._moveToTop(t) && this._focusTabbable()
        }
      }), this.element.find("[aria-describedby]").length || this.uiDialog.attr({
        "aria-describedby": this.element.uniqueId().attr("id")
      })
    },
    _createTitlebar: function() {
      var e;
      this.uiDialogTitlebar = t("<div>"), this._addClass(this.uiDialogTitlebar, "ui-dialog-titlebar", "ui-widget-header ui-helper-clearfix"), this._on(this.uiDialogTitlebar, {
        mousedown: function(e) {
          t(e.target).closest(".ui-dialog-titlebar-close") || this.uiDialog.trigger("focus")
        }
      }), this.uiDialogTitlebarClose = t("<button type='button'></button>").button({
        label: t("<a>").text(this.options.closeText).html(),
        icon: "ui-icon-closethick",
        showLabel: !1
      }).appendTo(this.uiDialogTitlebar), this._addClass(this.uiDialogTitlebarClose, "ui-dialog-titlebar-close"), this._on(this.uiDialogTitlebarClose, {
        click: function(t) {
          t.preventDefault(), this.close(t)
        }
      }), e = t("<span>").uniqueId().prependTo(this.uiDialogTitlebar), this._addClass(e, "ui-dialog-title"), this._title(e), this.uiDialogTitlebar.prependTo(this.uiDialog), this.uiDialog.attr({
        "aria-labelledby": e.attr("id")
      })
    },
    _title: function(t) {
      this.options.title ? t.text(this.options.title) : t.html("&#160;")
    },
    _createButtonPane: function() {
      this.uiDialogButtonPane = t("<div>"), this._addClass(this.uiDialogButtonPane, "ui-dialog-buttonpane", "ui-widget-content ui-helper-clearfix"), this.uiButtonSet = t("<div>").appendTo(this.uiDialogButtonPane), this._addClass(this.uiButtonSet, "ui-dialog-buttonset"), this._createButtons()
    },
    _createButtons: function() {
      var e = this,
        i = this.options.buttons;
      if (this.uiDialogButtonPane.remove(), this.uiButtonSet.empty(), t.isEmptyObject(i) || t.isArray(i) && !i.length) return void this._removeClass(this.uiDialog, "ui-dialog-buttons");
      t.each(i, function(i, s) {
        var n, o;
        s = t.isFunction(s) ? {
          click: s,
          text: i
        } : s, s = t.extend({
          type: "button"
        }, s), n = s.click, o = {
          icon: s.icon,
          iconPosition: s.iconPosition,
          showLabel: s.showLabel,
          icons: s.icons,
          text: s.text
        }, delete s.click, delete s.icon, delete s.iconPosition, delete s.showLabel, delete s.icons, "boolean" == typeof s.text && delete s.text, t("<button></button>", s).button(o).appendTo(e.uiButtonSet).on("click", function() {
          n.apply(e.element[0], arguments)
        })
      }), this._addClass(this.uiDialog, "ui-dialog-buttons"), this.uiDialogButtonPane.appendTo(this.uiDialog)
    },
    _makeDraggable: function() {
      function e(t) {
        return {
          position: t.position,
          offset: t.offset
        }
      }
      var i = this,
        s = this.options;
      this.uiDialog.draggable({
        cancel: ".ui-dialog-content, .ui-dialog-titlebar-close",
        handle: ".ui-dialog-titlebar",
        containment: "document",
        start: function(s, n) {
          i._addClass(t(this), "ui-dialog-dragging"), i._blockFrames(), i._trigger("dragStart", s, e(n))
        },
        drag: function(t, s) {
          i._trigger("drag", t, e(s))
        },
        stop: function(n, o) {
          var r = o.offset.left - i.document.scrollLeft(),
            a = o.offset.top - i.document.scrollTop();
          s.position = {
            my: "left top",
            at: "left" + (r >= 0 ? "+" : "") + r + " top" + (a >= 0 ? "+" : "") + a,
            of: i.window
          }, i._removeClass(t(this), "ui-dialog-dragging"), i._unblockFrames(), i._trigger("dragStop", n, e(o))
        }
      })
    },
    _makeResizable: function() {
      function e(t) {
        return {
          originalPosition: t.originalPosition,
          originalSize: t.originalSize,
          position: t.position,
          size: t.size
        }
      }
      var i = this,
        s = this.options,
        n = s.resizable,
        o = this.uiDialog.css("position"),
        r = "string" == typeof n ? n : "n,e,s,w,se,sw,ne,nw";
      this.uiDialog.resizable({
        cancel: ".ui-dialog-content",
        containment: "document",
        alsoResize: this.element,
        maxWidth: s.maxWidth,
        maxHeight: s.maxHeight,
        minWidth: s.minWidth,
        minHeight: this._minHeight(),
        handles: r,
        start: function(s, n) {
          i._addClass(t(this), "ui-dialog-resizing"), i._blockFrames(), i._trigger("resizeStart", s, e(n))
        },
        resize: function(t, s) {
          i._trigger("resize", t, e(s))
        },
        stop: function(n, o) {
          var r = i.uiDialog.offset(),
            a = r.left - i.document.scrollLeft(),
            l = r.top - i.document.scrollTop();
          s.height = i.uiDialog.height(), s.width = i.uiDialog.width(), s.position = {
            my: "left top",
            at: "left" + (a >= 0 ? "+" : "") + a + " top" + (l >= 0 ? "+" : "") + l,
            of: i.window
          }, i._removeClass(t(this), "ui-dialog-resizing"), i._unblockFrames(), i._trigger("resizeStop", n, e(o))
        }
      }).css("position", o)
    },
    _trackFocus: function() {
      this._on(this.widget(), {
        focusin: function(e) {
          this._makeFocusTarget(), this._focusedElement = t(e.target)
        }
      })
    },
    _makeFocusTarget: function() {
      this._untrackInstance(), this._trackingInstances().unshift(this)
    },
    _untrackInstance: function() {
      var e = this._trackingInstances(),
        i = t.inArray(this, e); - 1 !== i && e.splice(i, 1)
    },
    _trackingInstances: function() {
      var t = this.document.data("ui-dialog-instances");
      return t || (t = [], this.document.data("ui-dialog-instances", t)), t
    },
    _minHeight: function() {
      var t = this.options;
      return "auto" === t.height ? t.minHeight : Math.min(t.minHeight, t.height)
    },
    _position: function() {
      var t = this.uiDialog.is(":visible");
      t || this.uiDialog.show(), this.uiDialog.position(this.options.position), t || this.uiDialog.hide()
    },
    _setOptions: function(e) {
      var i = this,
        s = !1,
        n = {};
      t.each(e, function(t, e) {
        i._setOption(t, e), t in i.sizeRelatedOptions && (s = !0), t in i.resizableRelatedOptions && (n[t] = e)
      }), s && (this._size(), this._position()), this.uiDialog.is(":data(ui-resizable)") && this.uiDialog.resizable("option", n)
    },
    _setOption: function(e, i) {
      var s, n, o = this.uiDialog;
      "disabled" !== e && (this._super(e, i), "appendTo" === e && this.uiDialog.appendTo(this._appendTo()), "buttons" === e && this._createButtons(), "closeText" === e && this.uiDialogTitlebarClose.button({
          label: t("<a>").text("" + this.options.closeText).html()
        }), "draggable" === e && (s = o.is(":data(ui-draggable)"), s && !i && o.draggable("destroy"), !s && i && this._makeDraggable()), "position" === e && this._position(), "resizable" === e && (n = o.is(":data(ui-resizable)"), n && !i && o.resizable("destroy"), n && "string" == typeof i && o.resizable("option", "handles", i), n || !1 === i || this._makeResizable()),
        "title" === e && this._title(this.uiDialogTitlebar.find(".ui-dialog-title")))
    },
    _size: function() {
      var t, e, i, s = this.options;
      this.element.show().css({
        width: "auto",
        minHeight: 0,
        maxHeight: "none",
        height: 0
      }), s.minWidth > s.width && (s.width = s.minWidth), t = this.uiDialog.css({
        height: "auto",
        width: s.width
      }).outerHeight(), e = Math.max(0, s.minHeight - t), i = "number" == typeof s.maxHeight ? Math.max(0, s.maxHeight - t) : "none", "auto" === s.height ? this.element.css({
        minHeight: e,
        maxHeight: i,
        height: "auto"
      }) : this.element.height(Math.max(0, s.height - t)), this.uiDialog.is(":data(ui-resizable)") && this.uiDialog.resizable("option", "minHeight", this._minHeight())
    },
    _blockFrames: function() {
      this.iframeBlocks = this.document.find("iframe").map(function() {
        var e = t(this);
        return t("<div>").css({
          position: "absolute",
          width: e.outerWidth(),
          height: e.outerHeight()
        }).appendTo(e.parent()).offset(e.offset())[0]
      })
    },
    _unblockFrames: function() {
      this.iframeBlocks && (this.iframeBlocks.remove(), delete this.iframeBlocks)
    },
    _allowInteraction: function(e) {
      return !!t(e.target).closest(".ui-dialog").length || !!t(e.target).closest(".ui-datepicker").length
    },
    _createOverlay: function() {
      if (this.options.modal) {
        var e = !0;
        this._delay(function() {
          e = !1
        }), this.document.data("ui-dialog-overlays") || this._on(this.document, {
          focusin: function(t) {
            e || this._allowInteraction(t) || (t.preventDefault(), this._trackingInstances()[0]._focusTabbable())
          }
        }), this.overlay = t("<div>").appendTo(this._appendTo()), this._addClass(this.overlay, null, "ui-widget-overlay ui-front"), this._on(this.overlay, {
          mousedown: "_keepFocus"
        }), this.document.data("ui-dialog-overlays", (this.document.data("ui-dialog-overlays") || 0) + 1)
      }
    },
    _destroyOverlay: function() {
      if (this.options.modal && this.overlay) {
        var t = this.document.data("ui-dialog-overlays") - 1;
        t ? this.document.data("ui-dialog-overlays", t) : (this._off(this.document, "focusin"), this.document.removeData("ui-dialog-overlays")), this.overlay.remove(), this.overlay = null
      }
    }
  }), !1 !== t.uiBackCompat && t.widget("ui.dialog", t.ui.dialog, {
    options: {
      dialogClass: ""
    },
    _createWrapper: function() {
      this._super(), this.uiDialog.addClass(this.options.dialogClass)
    },
    _setOption: function(t, e) {
      "dialogClass" === t && this.uiDialog.removeClass(this.options.dialogClass).addClass(e), this._superApply(arguments)
    }
  });
  t.ui.dialog;
  t.widget("ui.droppable", {
    version: "1.12.1",
    widgetEventPrefix: "drop",
    options: {
      accept: "*",
      addClasses: !0,
      greedy: !1,
      scope: "default",
      tolerance: "intersect",
      activate: null,
      deactivate: null,
      drop: null,
      out: null,
      over: null
    },
    _create: function() {
      var e, i = this.options,
        s = i.accept;
      this.isover = !1, this.isout = !0, this.accept = t.isFunction(s) ? s : function(t) {
        return t.is(s)
      }, this.proportions = function() {
        if (!arguments.length) return e || (e = {
          width: this.element[0].offsetWidth,
          height: this.element[0].offsetHeight
        });
        e = arguments[0]
      }, this._addToManager(i.scope), i.addClasses && this._addClass("ui-droppable")
    },
    _addToManager: function(e) {
      t.ui.ddmanager.droppables[e] = t.ui.ddmanager.droppables[e] || [], t.ui.ddmanager.droppables[e].push(this)
    },
    _splice: function(t) {
      for (var e = 0; e < t.length; e++) t[e] === this && t.splice(e, 1)
    },
    _destroy: function() {
      var e = t.ui.ddmanager.droppables[this.options.scope];
      this._splice(e)
    },
    _setOption: function(e, i) {
      if ("accept" === e) this.accept = t.isFunction(i) ? i : function(t) {
        return t.is(i)
      };
      else if ("scope" === e) {
        var s = t.ui.ddmanager.droppables[this.options.scope];
        this._splice(s), this._addToManager(i)
      }
      this._super(e, i)
    },
    _activate: function(e) {
      var i = t.ui.ddmanager.current;
      this._addActiveClass(), i && this._trigger("activate", e, this.ui(i))
    },
    _deactivate: function(e) {
      var i = t.ui.ddmanager.current;
      this._removeActiveClass(), i && this._trigger("deactivate", e, this.ui(i))
    },
    _over: function(e) {
      var i = t.ui.ddmanager.current;
      i && (i.currentItem || i.element)[0] !== this.element[0] && this.accept.call(this.element[0], i.currentItem || i.element) && (this._addHoverClass(), this._trigger("over", e, this.ui(i)))
    },
    _out: function(e) {
      var i = t.ui.ddmanager.current;
      i && (i.currentItem || i.element)[0] !== this.element[0] && this.accept.call(this.element[0], i.currentItem || i.element) && (this._removeHoverClass(), this._trigger("out", e, this.ui(i)))
    },
    _drop: function(e, i) {
      var s = i || t.ui.ddmanager.current,
        n = !1;
      return !(!s || (s.currentItem || s.element)[0] === this.element[0]) && (this.element.find(":data(ui-droppable)").not(".ui-draggable-dragging").each(function() {
        var i = t(this).droppable("instance");
        if (i.options.greedy && !i.options.disabled && i.options.scope === s.options.scope && i.accept.call(i.element[0], s.currentItem || s.element) && f(s, t.extend(i, {
            offset: i.element.offset()
          }), i.options.tolerance, e)) return n = !0, !1
      }), !n && (!!this.accept.call(this.element[0], s.currentItem || s.element) && (this._removeActiveClass(), this._removeHoverClass(), this._trigger("drop", e, this.ui(s)), this.element)))
    },
    ui: function(t) {
      return {
        draggable: t.currentItem || t.element,
        helper: t.helper,
        position: t.position,
        offset: t.positionAbs
      }
    },
    _addHoverClass: function() {
      this._addClass("ui-droppable-hover")
    },
    _removeHoverClass: function() {
      this._removeClass("ui-droppable-hover")
    },
    _addActiveClass: function() {
      this._addClass("ui-droppable-active")
    },
    _removeActiveClass: function() {
      this._removeClass("ui-droppable-active")
    }
  });
  var f = t.ui.intersect = function() {
    function t(t, e, i) {
      return t >= e && t < e + i
    }
    return function(e, i, s, n) {
      if (!i.offset) return !1;
      var o = (e.positionAbs || e.position.absolute).left + e.margins.left,
        r = (e.positionAbs || e.position.absolute).top + e.margins.top,
        a = o + e.helperProportions.width,
        l = r + e.helperProportions.height,
        h = i.offset.left,
        c = i.offset.top,
        u = h + i.proportions().width,
        d = c + i.proportions().height;
      switch (s) {
        case "fit":
          return h <= o && a <= u && c <= r && l <= d;
        case "intersect":
          return h < o + e.helperProportions.width / 2 && a - e.helperProportions.width / 2 < u && c < r + e.helperProportions.height / 2 && l - e.helperProportions.height / 2 < d;
        case "pointer":
          return t(n.pageY, c, i.proportions().height) && t(n.pageX, h, i.proportions().width);
        case "touch":
          return (r >= c && r <= d || l >= c && l <= d || r < c && l > d) && (o >= h && o <= u || a >= h && a <= u || o < h && a > u);
        default:
          return !1
      }
    }
  }();
  t.ui.ddmanager = {
    current: null,
    droppables: {
      default: []
    },
    prepareOffsets: function(e, i) {
      var s, n, o = t.ui.ddmanager.droppables[e.options.scope] || [],
        r = i ? i.type : null,
        a = (e.currentItem || e.element).find(":data(ui-droppable)").addBack();
      t: for (s = 0; s < o.length; s++)
        if (!(o[s].options.disabled || e && !o[s].accept.call(o[s].element[0], e.currentItem || e.element))) {
          for (n = 0; n < a.length; n++)
            if (a[n] === o[s].element[0]) {
              o[s].proportions().height = 0;
              continue t
            }
          o[s].visible = "none" !== o[s].element.css("display"), o[s].visible && ("mousedown" === r && o[s]._activate.call(o[s], i), o[s].offset = o[s].element.offset(), o[s].proportions({
            width: o[s].element[0].offsetWidth,
            height: o[s].element[0].offsetHeight
          }))
        }
    },
    drop: function(e, i) {
      var s = !1;
      return t.each((t.ui.ddmanager.droppables[e.options.scope] || []).slice(), function() {
        this.options && (!this.options.disabled && this.visible && f(e, this, this.options.tolerance, i) && (s = this._drop.call(this, i) || s), !this.options.disabled && this.visible && this.accept.call(this.element[0], e.currentItem || e.element) && (this.isout = !0, this.isover = !1, this._deactivate.call(this, i)))
      }), s
    },
    dragStart: function(e, i) {
      e.element.parentsUntil("body").on("scroll.droppable", function() {
        e.options.refreshPositions || t.ui.ddmanager.prepareOffsets(e, i)
      })
    },
    drag: function(e, i) {
      e.options.refreshPositions && t.ui.ddmanager.prepareOffsets(e, i), t.each(t.ui.ddmanager.droppables[e.options.scope] || [], function() {
        if (!this.options.disabled && !this.greedyChild && this.visible) {
          var s, n, o, r = f(e, this, this.options.tolerance, i),
            a = !r && this.isover ? "isout" : r && !this.isover ? "isover" : null;
          a && (this.options.greedy && (n = this.options.scope, o = this.element.parents(":data(ui-droppable)").filter(function() {
            return t(this).droppable("instance").options.scope === n
          }), o.length && (s = t(o[0]).droppable("instance"), s.greedyChild = "isover" === a)), s && "isover" === a && (s.isover = !1, s.isout = !0, s._out.call(s, i)), this[a] = !0, this["isout" === a ? "isover" : "isout"] = !1, this["isover" === a ? "_over" : "_out"].call(this, i), s && "isout" === a && (s.isout = !1, s.isover = !0, s._over.call(s, i)))
        }
      })
    },
    dragStop: function(e, i) {
      e.element.parentsUntil("body").off("scroll.droppable"), e.options.refreshPositions || t.ui.ddmanager.prepareOffsets(e, i)
    }
  }, !1 !== t.uiBackCompat && t.widget("ui.droppable", t.ui.droppable, {
    options: {
      hoverClass: !1,
      activeClass: !1
    },
    _addActiveClass: function() {
      this._super(), this.options.activeClass && this.element.addClass(this.options.activeClass)
    },
    _removeActiveClass: function() {
      this._super(), this.options.activeClass && this.element.removeClass(this.options.activeClass)
    },
    _addHoverClass: function() {
      this._super(), this.options.hoverClass && this.element.addClass(this.options.hoverClass)
    },
    _removeHoverClass: function() {
      this._super(), this.options.hoverClass && this.element.removeClass(this.options.hoverClass)
    }
  });
  t.ui.droppable, t.widget("ui.progressbar", {
    version: "1.12.1",
    options: {
      classes: {
        "ui-progressbar": "ui-corner-all",
        "ui-progressbar-value": "ui-corner-left",
        "ui-progressbar-complete": "ui-corner-right"
      },
      max: 100,
      value: 0,
      change: null,
      complete: null
    },
    min: 0,
    _create: function() {
      this.oldValue = this.options.value = this._constrainedValue(), this.element.attr({
        role: "progressbar",
        "aria-valuemin": this.min
      }), this._addClass("ui-progressbar", "ui-widget ui-widget-content"), this.valueDiv = t("<div>").appendTo(this.element), this._addClass(this.valueDiv, "ui-progressbar-value", "ui-widget-header"), this._refreshValue()
    },
    _destroy: function() {
      this.element.removeAttr("role aria-valuemin aria-valuemax aria-valuenow"), this.valueDiv.remove()
    },
    value: function(t) {
      if (void 0 === t) return this.options.value;
      this.options.value = this._constrainedValue(t), this._refreshValue()
    },
    _constrainedValue: function(t) {
      return void 0 === t && (t = this.options.value), this.indeterminate = !1 === t, "number" != typeof t && (t = 0), !this.indeterminate && Math.min(this.options.max, Math.max(this.min, t))
    },
    _setOptions: function(t) {
      var e = t.value;
      delete t.value, this._super(t), this.options.value = this._constrainedValue(e), this._refreshValue()
    },
    _setOption: function(t, e) {
      "max" === t && (e = Math.max(this.min, e)), this._super(t, e)
    },
    _setOptionDisabled: function(t) {
      this._super(t), this.element.attr("aria-disabled", t), this._toggleClass(null, "ui-state-disabled", !!t)
    },
    _percentage: function() {
      return this.indeterminate ? 100 : 100 * (this.options.value - this.min) / (this.options.max - this.min)
    },
    _refreshValue: function() {
      var e = this.options.value,
        i = this._percentage();
      this.valueDiv.toggle(this.indeterminate || e > this.min).width(i.toFixed(0) + "%"), this._toggleClass(this.valueDiv, "ui-progressbar-complete", null, e === this.options.max)._toggleClass("ui-progressbar-indeterminate", null, this.indeterminate), this.indeterminate ? (this.element.removeAttr("aria-valuenow"), this.overlayDiv || (this.overlayDiv = t("<div>").appendTo(this.valueDiv), this._addClass(this.overlayDiv, "ui-progressbar-overlay"))) : (this.element.attr({
        "aria-valuemax": this.options.max,
        "aria-valuenow": e
      }), this.overlayDiv && (this.overlayDiv.remove(), this.overlayDiv = null)), this.oldValue !== e && (this.oldValue = e, this._trigger("change")), e === this.options.max && this._trigger("complete")
    }
  }), t.widget("ui.selectable", t.ui.mouse, {
    version: "1.12.1",
    options: {
      appendTo: "body",
      autoRefresh: !0,
      distance: 0,
      filter: "*",
      tolerance: "touch",
      selected: null,
      selecting: null,
      start: null,
      stop: null,
      unselected: null,
      unselecting: null
    },
    _create: function() {
      var e = this;
      this._addClass("ui-selectable"), this.dragged = !1, this.refresh = function() {
        e.elementPos = t(e.element[0]).offset(), e.selectees = t(e.options.filter, e.element[0]), e._addClass(e.selectees, "ui-selectee"), e.selectees.each(function() {
          var i = t(this),
            s = i.offset(),
            n = {
              left: s.left - e.elementPos.left,
              top: s.top - e.elementPos.top
            };
          t.data(this, "selectable-item", {
            element: this,
            $element: i,
            left: n.left,
            top: n.top,
            right: n.left + i.outerWidth(),
            bottom: n.top + i.outerHeight(),
            startselected: !1,
            selected: i.hasClass("ui-selected"),
            selecting: i.hasClass("ui-selecting"),
            unselecting: i.hasClass("ui-unselecting")
          })
        })
      }, this.refresh(), this._mouseInit(), this.helper = t("<div>"), this._addClass(this.helper, "ui-selectable-helper")
    },
    _destroy: function() {
      this.selectees.removeData("selectable-item"), this._mouseDestroy()
    },
    _mouseStart: function(e) {
      var i = this,
        s = this.options;
      this.opos = [e.pageX, e.pageY], this.elementPos = t(this.element[0]).offset(), this.options.disabled || (this.selectees = t(s.filter, this.element[0]), this._trigger("start", e), t(s.appendTo).append(this.helper), this.helper.css({
        left: e.pageX,
        top: e.pageY,
        width: 0,
        height: 0
      }), s.autoRefresh && this.refresh(), this.selectees.filter(".ui-selected").each(function() {
        var s = t.data(this, "selectable-item");
        s.startselected = !0, e.metaKey || e.ctrlKey || (i._removeClass(s.$element, "ui-selected"), s.selected = !1, i._addClass(s.$element, "ui-unselecting"), s.unselecting = !0, i._trigger("unselecting", e, {
          unselecting: s.element
        }))
      }), t(e.target).parents().addBack().each(function() {
        var s, n = t.data(this, "selectable-item");
        if (n) return s = !e.metaKey && !e.ctrlKey || !n.$element.hasClass("ui-selected"), i._removeClass(n.$element, s ? "ui-unselecting" : "ui-selected")._addClass(n.$element, s ? "ui-selecting" : "ui-unselecting"), n.unselecting = !s, n.selecting = s, n.selected = s, s ? i._trigger("selecting", e, {
          selecting: n.element
        }) : i._trigger("unselecting", e, {
          unselecting: n.element
        }), !1
      }))
    },
    _mouseDrag: function(e) {
      if (this.dragged = !0, !this.options.disabled) {
        var i, s = this,
          n = this.options,
          o = this.opos[0],
          r = this.opos[1],
          a = e.pageX,
          l = e.pageY;
        return o > a && (i = a, a = o, o = i), r > l && (i = l, l = r, r = i), this.helper.css({
          left: o,
          top: r,
          width: a - o,
          height: l - r
        }), this.selectees.each(function() {
          var i = t.data(this, "selectable-item"),
            h = !1,
            c = {};
          i && i.element !== s.element[0] && (c.left = i.left + s.elementPos.left, c.right = i.right + s.elementPos.left, c.top = i.top + s.elementPos.top, c.bottom = i.bottom + s.elementPos.top, "touch" === n.tolerance ? h = !(c.left > a || c.right < o || c.top > l || c.bottom < r) : "fit" === n.tolerance && (h = c.left > o && c.right < a && c.top > r && c.bottom < l), h ? (i.selected && (s._removeClass(i.$element, "ui-selected"), i.selected = !1), i.unselecting && (s._removeClass(i.$element, "ui-unselecting"), i.unselecting = !1), i.selecting || (s._addClass(i.$element, "ui-selecting"), i.selecting = !0, s._trigger("selecting", e, {
            selecting: i.element
          }))) : (i.selecting && ((e.metaKey || e.ctrlKey) && i.startselected ? (s._removeClass(i.$element, "ui-selecting"), i.selecting = !1, s._addClass(i.$element, "ui-selected"), i.selected = !0) : (s._removeClass(i.$element, "ui-selecting"), i.selecting = !1, i.startselected && (s._addClass(i.$element, "ui-unselecting"), i.unselecting = !0), s._trigger("unselecting", e, {
            unselecting: i.element
          }))), i.selected && (e.metaKey || e.ctrlKey || i.startselected || (s._removeClass(i.$element, "ui-selected"), i.selected = !1, s._addClass(i.$element, "ui-unselecting"), i.unselecting = !0, s._trigger("unselecting", e, {
            unselecting: i.element
          })))))
        }), !1
      }
    },
    _mouseStop: function(e) {
      var i = this;
      return this.dragged = !1, t(".ui-unselecting", this.element[0]).each(function() {
        var s = t.data(this, "selectable-item");
        i._removeClass(s.$element, "ui-unselecting"), s.unselecting = !1, s.startselected = !1, i._trigger("unselected", e, {
          unselected: s.element
        })
      }), t(".ui-selecting", this.element[0]).each(function() {
        var s = t.data(this, "selectable-item");
        i._removeClass(s.$element, "ui-selecting")._addClass(s.$element, "ui-selected"), s.selecting = !1, s.selected = !0, s.startselected = !0, i._trigger("selected", e, {
          selected: s.element
        })
      }), this._trigger("stop", e), this.helper.remove(), !1
    }
  }), t.widget("ui.selectmenu", [t.ui.formResetMixin, {
    version: "1.12.1",
    defaultElement: "<select>",
    options: {
      appendTo: null,
      classes: {
        "ui-selectmenu-button-open": "ui-corner-top",
        "ui-selectmenu-button-closed": "ui-corner-all"
      },
      disabled: null,
      icons: {
        button: "ui-icon-triangle-1-s"
      },
      position: {
        my: "left top",
        at: "left bottom",
        collision: "none"
      },
      width: !1,
      change: null,
      close: null,
      focus: null,
      open: null,
      select: null
    },
    _create: function() {
      var e = this.element.uniqueId().attr("id");
      this.ids = {
        element: e,
        button: e + "-button",
        menu: e + "-menu"
      }, this._drawButton(), this._drawMenu(), this._bindFormResetHandler(), this._rendered = !1, this.menuItems = t()
    },
    _drawButton: function() {
      var e, i = this,
        s = this._parseOption(this.element.find("option:selected"), this.element[0].selectedIndex);
      this.labels = this.element.labels().attr("for", this.ids.button), this._on(this.labels, {
        click: function(t) {
          this.button.focus(), t.preventDefault()
        }
      }), this.element.hide(), this.button = t("<span>", {
        tabindex: this.options.disabled ? -1 : 0,
        id: this.ids.button,
        role: "combobox",
        "aria-expanded": "false",
        "aria-autocomplete": "list",
        "aria-owns": this.ids.menu,
        "aria-haspopup": "true",
        title: this.element.attr("title")
      }).insertAfter(this.element), this._addClass(this.button, "ui-selectmenu-button ui-selectmenu-button-closed", "ui-button ui-widget"), e = t("<span>").appendTo(this.button), this._addClass(e, "ui-selectmenu-icon", "ui-icon " + this.options.icons.button), this.buttonItem = this._renderButtonItem(s).appendTo(this.button), !1 !== this.options.width && this._resizeButton(), this._on(this.button, this._buttonEvents), this.button.one("focusin", function() {
        i._rendered || i._refreshMenu()
      })
    },
    _drawMenu: function() {
      var e = this;
      this.menu = t("<ul>", {
        "aria-hidden": "true",
        "aria-labelledby": this.ids.button,
        id: this.ids.menu
      }), this.menuWrap = t("<div>").append(this.menu), this._addClass(this.menuWrap, "ui-selectmenu-menu", "ui-front"), this.menuWrap.appendTo(this._appendTo()), this.menuInstance = this.menu.menu({
        classes: {
          "ui-menu": "ui-corner-bottom"
        },
        role: "listbox",
        select: function(t, i) {
          t.preventDefault(), e._setSelection(), e._select(i.item.data("ui-selectmenu-item"), t)
        },
        focus: function(t, i) {
          var s = i.item.data("ui-selectmenu-item");
          null != e.focusIndex && s.index !== e.focusIndex && (e._trigger("focus", t, {
            item: s
          }), e.isOpen || e._select(s, t)), e.focusIndex = s.index, e.button.attr("aria-activedescendant", e.menuItems.eq(s.index).attr("id"))
        }
      }).menu("instance"), this.menuInstance._off(this.menu, "mouseleave"), this.menuInstance._closeOnDocumentClick = function() {
        return !1
      }, this.menuInstance._isDivider = function() {
        return !1
      }
    },
    refresh: function() {
      this._refreshMenu(), this.buttonItem.replaceWith(this.buttonItem = this._renderButtonItem(this._getSelectedItem().data("ui-selectmenu-item") || {})), null === this.options.width && this._resizeButton()
    },
    _refreshMenu: function() {
      var t, e = this.element.find("option");
      this.menu.empty(), this._parseOptions(e), this._renderMenu(this.menu, this.items), this.menuInstance.refresh(), this.menuItems = this.menu.find("li").not(".ui-selectmenu-optgroup").find(".ui-menu-item-wrapper"), this._rendered = !0, e.length && (t = this._getSelectedItem(), this.menuInstance.focus(null, t), this._setAria(t.data("ui-selectmenu-item")), this._setOption("disabled", this.element.prop("disabled")))
    },
    open: function(t) {
      this.options.disabled || (this._rendered ? (this._removeClass(this.menu.find(".ui-state-active"), null, "ui-state-active"), this.menuInstance.focus(null, this._getSelectedItem())) : this._refreshMenu(), this.menuItems.length && (this.isOpen = !0, this._toggleAttr(), this._resizeMenu(), this._position(), this._on(this.document, this._documentClick), this._trigger("open", t)))
    },
    _position: function() {
      this.menuWrap.position(t.extend({
        of: this.button
      }, this.options.position))
    },
    close: function(t) {
      this.isOpen && (this.isOpen = !1, this._toggleAttr(), this.range = null, this._off(this.document), this._trigger("close", t))
    },
    widget: function() {
      return this.button
    },
    menuWidget: function() {
      return this.menu
    },
    _renderButtonItem: function(e) {
      var i = t("<span>");
      return this._setText(i, e.label), this._addClass(i, "ui-selectmenu-text"), i
    },
    _renderMenu: function(e, i) {
      var s = this,
        n = "";
      t.each(i, function(i, o) {
        var r;
        o.optgroup !== n && (r = t("<li>", {
          text: o.optgroup
        }), s._addClass(r, "ui-selectmenu-optgroup", "ui-menu-divider" + (o.element.parent("optgroup").prop("disabled") ? " ui-state-disabled" : "")), r.appendTo(e), n = o.optgroup), s._renderItemData(e, o)
      })
    },
    _renderItemData: function(t, e) {
      return this._renderItem(t, e).data("ui-selectmenu-item", e)
    },
    _renderItem: function(e, i) {
      var s = t("<li>"),
        n = t("<div>", {
          title: i.element.attr("title")
        });
      return i.disabled && this._addClass(s, null, "ui-state-disabled"), this._setText(n, i.label), s.append(n).appendTo(e)
    },
    _setText: function(t, e) {
      e ? t.text(e) : t.html("&#160;")
    },
    _move: function(t, e) {
      var i, s, n = ".ui-menu-item";
      this.isOpen ? i = this.menuItems.eq(this.focusIndex).parent("li") : (i = this.menuItems.eq(this.element[0].selectedIndex).parent("li"), n += ":not(.ui-state-disabled)"), s = "first" === t || "last" === t ? i["first" === t ? "prevAll" : "nextAll"](n).eq(-1) : i[t + "All"](n).eq(0), s.length && this.menuInstance.focus(e, s)
    },
    _getSelectedItem: function() {
      return this.menuItems.eq(this.element[0].selectedIndex).parent("li")
    },
    _toggle: function(t) {
      this[this.isOpen ? "close" : "open"](t)
    },
    _setSelection: function() {
      var t;
      this.range && (window.getSelection ? (t = window.getSelection(), t.removeAllRanges(), t.addRange(this.range)) : this.range.select(), this.button.focus())
    },
    _documentClick: {
      mousedown: function(e) {
        this.isOpen && (t(e.target).closest(".ui-selectmenu-menu, #" + t.ui.escapeSelector(this.ids.button)).length || this.close(e))
      }
    },
    _buttonEvents: {
      mousedown: function() {
        var t;
        window.getSelection ? (t = window.getSelection(), t.rangeCount && (this.range = t.getRangeAt(0))) : this.range = document.selection.createRange()
      },
      click: function(t) {
        this._setSelection(), this._toggle(t)
      },
      keydown: function(e) {
        var i = !0;
        switch (e.keyCode) {
          case t.ui.keyCode.TAB:
          case t.ui.keyCode.ESCAPE:
            this.close(e), i = !1;
            break;
          case t.ui.keyCode.ENTER:
            this.isOpen && this._selectFocusedItem(e);
            break;
          case t.ui.keyCode.UP:
            e.altKey ? this._toggle(e) : this._move("prev", e);
            break;
          case t.ui.keyCode.DOWN:
            e.altKey ? this._toggle(e) : this._move("next", e);
            break;
          case t.ui.keyCode.SPACE:
            this.isOpen ? this._selectFocusedItem(e) : this._toggle(e);
            break;
          case t.ui.keyCode.LEFT:
            this._move("prev", e);
            break;
          case t.ui.keyCode.RIGHT:
            this._move("next", e);
            break;
          case t.ui.keyCode.HOME:
          case t.ui.keyCode.PAGE_UP:
            this._move("first", e);
            break;
          case t.ui.keyCode.END:
          case t.ui.keyCode.PAGE_DOWN:
            this._move("last", e);
            break;
          default:
            this.menu.trigger(e), i = !1
        }
        i && e.preventDefault()
      }
    },
    _selectFocusedItem: function(t) {
      var e = this.menuItems.eq(this.focusIndex).parent("li");
      e.hasClass("ui-state-disabled") || this._select(e.data("ui-selectmenu-item"), t)
    },
    _select: function(t, e) {
      var i = this.element[0].selectedIndex;
      this.element[0].selectedIndex = t.index, this.buttonItem.replaceWith(this.buttonItem = this._renderButtonItem(t)), this._setAria(t), this._trigger("select", e, {
        item: t
      }), t.index !== i && this._trigger("change", e, {
        item: t
      }), this.close(e)
    },
    _setAria: function(t) {
      var e = this.menuItems.eq(t.index).attr("id");
      this.button.attr({
        "aria-labelledby": e,
        "aria-activedescendant": e
      }), this.menu.attr("aria-activedescendant", e)
    },
    _setOption: function(t, e) {
      if ("icons" === t) {
        var i = this.button.find("span.ui-icon");
        this._removeClass(i, null, this.options.icons.button)._addClass(i, null, e.button)
      }
      this._super(t, e), "appendTo" === t && this.menuWrap.appendTo(this._appendTo()), "width" === t && this._resizeButton()
    },
    _setOptionDisabled: function(t) {
      this._super(t), this.menuInstance.option("disabled", t), this.button.attr("aria-disabled", t), this._toggleClass(this.button, null, "ui-state-disabled", t), this.element.prop("disabled", t), t ? (this.button.attr("tabindex", -1), this.close()) : this.button.attr("tabindex", 0)
    },
    _appendTo: function() {
      var e = this.options.appendTo;
      return e && (e = e.jquery || e.nodeType ? t(e) : this.document.find(e).eq(0)), e && e[0] || (e = this.element.closest(".ui-front, dialog")), e.length || (e = this.document[0].body), e
    },
    _toggleAttr: function() {
      this.button.attr("aria-expanded", this.isOpen), this._removeClass(this.button, "ui-selectmenu-button-" + (this.isOpen ? "closed" : "open"))._addClass(this.button, "ui-selectmenu-button-" + (this.isOpen ? "open" : "closed"))._toggleClass(this.menuWrap, "ui-selectmenu-open", null, this.isOpen), this.menu.attr("aria-hidden", !this.isOpen)
    },
    _resizeButton: function() {
      var t = this.options.width;
      if (!1 === t) return void this.button.css("width", "");
      null === t && (t = this.element.show().outerWidth(), this.element.hide()), this.button.outerWidth(t)
    },
    _resizeMenu: function() {
      this.menu.outerWidth(Math.max(this.button.outerWidth(), this.menu.width("").outerWidth() + 1))
    },
    _getCreateOptions: function() {
      var t = this._super();
      return t.disabled = this.element.prop("disabled"), t
    },
    _parseOptions: function(e) {
      var i = this,
        s = [];
      e.each(function(e, n) {
        s.push(i._parseOption(t(n), e))
      }), this.items = s
    },
    _parseOption: function(t, e) {
      var i = t.parent("optgroup");
      return {
        element: t,
        index: e,
        value: t.val(),
        label: t.text(),
        optgroup: i.attr("label") || "",
        disabled: i.prop("disabled") || t.prop("disabled")
      }
    },
    _destroy: function() {
      this._unbindFormResetHandler(), this.menuWrap.remove(), this.button.remove(), this.element.show(), this.element.removeUniqueId(), this.labels.attr("for", this.ids.element)
    }
  }]), t.widget("ui.sortable", t.ui.mouse, {
    version: "1.12.1",
    widgetEventPrefix: "sort",
    ready: !1,
    options: {
      appendTo: "parent",
      axis: !1,
      connectWith: !1,
      containment: !1,
      cursor: "auto",
      cursorAt: !1,
      dropOnEmpty: !0,
      forcePlaceholderSize: !1,
      forceHelperSize: !1,
      grid: !1,
      handle: !1,
      helper: "original",
      items: "> *",
      opacity: !1,
      placeholder: !1,
      revert: !1,
      scroll: !0,
      scrollSensitivity: 20,
      scrollSpeed: 20,
      scope: "default",
      tolerance: "intersect",
      zIndex: 1e3,
      activate: null,
      beforeStop: null,
      change: null,
      deactivate: null,
      out: null,
      over: null,
      receive: null,
      remove: null,
      sort: null,
      start: null,
      stop: null,
      update: null
    },
    _isOverAxis: function(t, e, i) {
      return t >= e && t < e + i
    },
    _isFloating: function(t) {
      return /left|right/.test(t.css("float")) || /inline|table-cell/.test(t.css("display"))
    },
    _create: function() {
      this.containerCache = {}, this._addClass("ui-sortable"), this.refresh(), this.offset = this.element.offset(), this._mouseInit(), this._setHandleClassName(), this.ready = !0
    },
    _setOption: function(t, e) {
      this._super(t, e), "handle" === t && this._setHandleClassName()
    },
    _setHandleClassName: function() {
      var e = this;
      this._removeClass(this.element.find(".ui-sortable-handle"), "ui-sortable-handle"), t.each(this.items, function() {
        e._addClass(this.instance.options.handle ? this.item.find(this.instance.options.handle) : this.item, "ui-sortable-handle")
      })
    },
    _destroy: function() {
      this._mouseDestroy();
      for (var t = this.items.length - 1; t >= 0; t--) this.items[t].item.removeData(this.widgetName + "-item");
      return this
    },
    _mouseCapture: function(e, i) {
      var s = null,
        n = !1,
        o = this;
      return !this.reverting && (!this.options.disabled && "static" !== this.options.type && (this._refreshItems(e), t(e.target).parents().each(function() {
        if (t.data(this, o.widgetName + "-item") === o) return s = t(this), !1
      }), t.data(e.target, o.widgetName + "-item") === o && (s = t(e.target)), !!s && (!(this.options.handle && !i && (t(this.options.handle, s).find("*").addBack().each(function() {
        this === e.target && (n = !0)
      }), !n)) && (this.currentItem = s, this._removeCurrentsFromItems(), !0))))
    },
    _mouseStart: function(e, i, s) {
      var n, o, r = this.options;
      if (this.currentContainer = this, this.refreshPositions(), this.helper = this._createHelper(e), this._cacheHelperProportions(), this._cacheMargins(), this.scrollParent = this.helper.scrollParent(), this.offset = this.currentItem.offset(), this.offset = {
          top: this.offset.top - this.margins.top,
          left: this.offset.left - this.margins.left
        }, t.extend(this.offset, {
          click: {
            left: e.pageX - this.offset.left,
            top: e.pageY - this.offset.top
          },
          parent: this._getParentOffset(),
          relative: this._getRelativeOffset()
        }), this.helper.css("position", "absolute"), this.cssPosition = this.helper.css("position"), this.originalPosition = this._generatePosition(e), this.originalPageX = e.pageX, this.originalPageY = e.pageY, r.cursorAt && this._adjustOffsetFromHelper(r.cursorAt), this.domPosition = {
          prev: this.currentItem.prev()[0],
          parent: this.currentItem.parent()[0]
        }, this.helper[0] !== this.currentItem[0] && this.currentItem.hide(), this._createPlaceholder(), r.containment && this._setContainment(), r.cursor && "auto" !== r.cursor && (o = this.document.find("body"), this.storedCursor = o.css("cursor"), o.css("cursor", r.cursor), this.storedStylesheet = t("<style>*{ cursor: " + r.cursor + " !important; }</style>").appendTo(o)), r.opacity && (this.helper.css("opacity") && (this._storedOpacity = this.helper.css("opacity")), this.helper.css("opacity", r.opacity)), r.zIndex && (this.helper.css("zIndex") && (this._storedZIndex = this.helper.css("zIndex")), this.helper.css("zIndex", r.zIndex)), this.scrollParent[0] !== this.document[0] && "HTML" !== this.scrollParent[0].tagName && (this.overflowOffset = this.scrollParent.offset()), this._trigger("start", e, this._uiHash()), this._preserveHelperProportions || this._cacheHelperProportions(), !s)
        for (n = this.containers.length - 1; n >= 0; n--) this.containers[n]._trigger("activate", e, this._uiHash(this));
      return t.ui.ddmanager && (t.ui.ddmanager.current = this), t.ui.ddmanager && !r.dropBehaviour && t.ui.ddmanager.prepareOffsets(this, e), this.dragging = !0, this._addClass(this.helper, "ui-sortable-helper"), this._mouseDrag(e), !0
    },
    _mouseDrag: function(e) {
      var i, s, n, o, r = this.options,
        a = !1;
      for (this.position = this._generatePosition(e), this.positionAbs = this._convertPositionTo("absolute"), this.lastPositionAbs || (this.lastPositionAbs = this.positionAbs), this.options.scroll && (this.scrollParent[0] !== this.document[0] && "HTML" !== this.scrollParent[0].tagName ? (this.overflowOffset.top + this.scrollParent[0].offsetHeight - e.pageY < r.scrollSensitivity ? this.scrollParent[0].scrollTop = a = this.scrollParent[0].scrollTop + r.scrollSpeed : e.pageY - this.overflowOffset.top < r.scrollSensitivity && (this.scrollParent[0].scrollTop = a = this.scrollParent[0].scrollTop - r.scrollSpeed), this.overflowOffset.left + this.scrollParent[0].offsetWidth - e.pageX < r.scrollSensitivity ? this.scrollParent[0].scrollLeft = a = this.scrollParent[0].scrollLeft + r.scrollSpeed : e.pageX - this.overflowOffset.left < r.scrollSensitivity && (this.scrollParent[0].scrollLeft = a = this.scrollParent[0].scrollLeft - r.scrollSpeed)) : (e.pageY - this.document.scrollTop() < r.scrollSensitivity ? a = this.document.scrollTop(this.document.scrollTop() - r.scrollSpeed) : this.window.height() - (e.pageY - this.document.scrollTop()) < r.scrollSensitivity && (a = this.document.scrollTop(this.document.scrollTop() + r.scrollSpeed)), e.pageX - this.document.scrollLeft() < r.scrollSensitivity ? a = this.document.scrollLeft(this.document.scrollLeft() - r.scrollSpeed) : this.window.width() - (e.pageX - this.document.scrollLeft()) < r.scrollSensitivity && (a = this.document.scrollLeft(this.document.scrollLeft() + r.scrollSpeed))), !1 !== a && t.ui.ddmanager && !r.dropBehaviour && t.ui.ddmanager.prepareOffsets(this, e)), this.positionAbs = this._convertPositionTo("absolute"), this.options.axis && "y" === this.options.axis || (this.helper[0].style.left = this.position.left + "px"), this.options.axis && "x" === this.options.axis || (this.helper[0].style.top = this.position.top + "px"), i = this.items.length - 1; i >= 0; i--)
        if (s = this.items[i], n = s.item[0], (o = this._intersectsWithPointer(s)) && s.instance === this.currentContainer && !(n === this.currentItem[0] || this.placeholder[1 === o ? "next" : "prev"]()[0] === n || t.contains(this.placeholder[0], n) || "semi-dynamic" === this.options.type && t.contains(this.element[0], n))) {
          if (this.direction = 1 === o ? "down" : "up", "pointer" !== this.options.tolerance && !this._intersectsWithSides(s)) break;
          this._rearrange(e, s), this._trigger("change", e, this._uiHash());
          break
        }
      return this._contactContainers(e), t.ui.ddmanager && t.ui.ddmanager.drag(this, e), this._trigger("sort", e, this._uiHash()), this.lastPositionAbs = this.positionAbs, !1
    },
    _mouseStop: function(e, i) {
      if (e) {
        if (t.ui.ddmanager && !this.options.dropBehaviour && t.ui.ddmanager.drop(this, e), this.options.revert) {
          var s = this,
            n = this.placeholder.offset(),
            o = this.options.axis,
            r = {};
          o && "x" !== o || (r.left = n.left - this.offset.parent.left - this.margins.left + (this.offsetParent[0] === this.document[0].body ? 0 : this.offsetParent[0].scrollLeft)), o && "y" !== o || (r.top = n.top - this.offset.parent.top - this.margins.top + (this.offsetParent[0] === this.document[0].body ? 0 : this.offsetParent[0].scrollTop)), this.reverting = !0, t(this.helper).animate(r, parseInt(this.options.revert, 10) || 500, function() {
            s._clear(e)
          })
        } else this._clear(e, i);
        return !1
      }
    },
    cancel: function() {
      if (this.dragging) {
        this._mouseUp(new t.Event("mouseup", {
          target: null
        })), "original" === this.options.helper ? (this.currentItem.css(this._storedCSS), this._removeClass(this.currentItem, "ui-sortable-helper")) : this.currentItem.show();
        for (var e = this.containers.length - 1; e >= 0; e--) this.containers[e]._trigger("deactivate", null, this._uiHash(this)), this.containers[e].containerCache.over && (this.containers[e]._trigger("out", null, this._uiHash(this)), this.containers[e].containerCache.over = 0)
      }
      return this.placeholder && (this.placeholder[0].parentNode && this.placeholder[0].parentNode.removeChild(this.placeholder[0]), "original" !== this.options.helper && this.helper && this.helper[0].parentNode && this.helper.remove(), t.extend(this, {
        helper: null,
        dragging: !1,
        reverting: !1,
        _noFinalSort: null
      }), this.domPosition.prev ? t(this.domPosition.prev).after(this.currentItem) : t(this.domPosition.parent).prepend(this.currentItem)), this
    },
    serialize: function(e) {
      var i = this._getItemsAsjQuery(e && e.connected),
        s = [];
      return e = e || {}, t(i).each(function() {
        var i = (t(e.item || this).attr(e.attribute || "id") || "").match(e.expression || /(.+)[\-=_](.+)/);
        i && s.push((e.key || i[1] + "[]") + "=" + (e.key && e.expression ? i[1] : i[2]))
      }), !s.length && e.key && s.push(e.key + "="), s.join("&")
    },
    toArray: function(e) {
      var i = this._getItemsAsjQuery(e && e.connected),
        s = [];
      return e = e || {}, i.each(function() {
        s.push(t(e.item || this).attr(e.attribute || "id") || "")
      }), s
    },
    _intersectsWith: function(t) {
      var e = this.positionAbs.left,
        i = e + this.helperProportions.width,
        s = this.positionAbs.top,
        n = s + this.helperProportions.height,
        o = t.left,
        r = o + t.width,
        a = t.top,
        l = a + t.height,
        h = this.offset.click.top,
        c = this.offset.click.left,
        u = "x" === this.options.axis || s + h > a && s + h < l,
        d = "y" === this.options.axis || e + c > o && e + c < r,
        p = u && d;
      return "pointer" === this.options.tolerance || this.options.forcePointerForContainers || "pointer" !== this.options.tolerance && this.helperProportions[this.floating ? "width" : "height"] > t[this.floating ? "width" : "height"] ? p : o < e + this.helperProportions.width / 2 && i - this.helperProportions.width / 2 < r && a < s + this.helperProportions.height / 2 && n - this.helperProportions.height / 2 < l
    },
    _intersectsWithPointer: function(t) {
      var e, i, s = "x" === this.options.axis || this._isOverAxis(this.positionAbs.top + this.offset.click.top, t.top, t.height),
        n = "y" === this.options.axis || this._isOverAxis(this.positionAbs.left + this.offset.click.left, t.left, t.width);
      return !(!s || !n) && (e = this._getDragVerticalDirection(), i = this._getDragHorizontalDirection(), this.floating ? "right" === i || "down" === e ? 2 : 1 : e && ("down" === e ? 2 : 1))
    },
    _intersectsWithSides: function(t) {
      var e = this._isOverAxis(this.positionAbs.top + this.offset.click.top, t.top + t.height / 2, t.height),
        i = this._isOverAxis(this.positionAbs.left + this.offset.click.left, t.left + t.width / 2, t.width),
        s = this._getDragVerticalDirection(),
        n = this._getDragHorizontalDirection();
      return this.floating && n ? "right" === n && i || "left" === n && !i : s && ("down" === s && e || "up" === s && !e)
    },
    _getDragVerticalDirection: function() {
      var t = this.positionAbs.top - this.lastPositionAbs.top;
      return 0 !== t && (t > 0 ? "down" : "up")
    },
    _getDragHorizontalDirection: function() {
      var t = this.positionAbs.left - this.lastPositionAbs.left;
      return 0 !== t && (t > 0 ? "right" : "left")
    },
    refresh: function(t) {
      return this._refreshItems(t), this._setHandleClassName(), this.refreshPositions(), this
    },
    _connectWith: function() {
      var t = this.options;
      return t.connectWith.constructor === String ? [t.connectWith] : t.connectWith
    },
    _getItemsAsjQuery: function(e) {
      function i() {
        a.push(this)
      }
      var s, n, o, r, a = [],
        l = [],
        h = this._connectWith();
      if (h && e)
        for (s = h.length - 1; s >= 0; s--)
          for (o = t(h[s], this.document[0]), n = o.length - 1; n >= 0; n--)(r = t.data(o[n], this.widgetFullName)) && r !== this && !r.options.disabled && l.push([t.isFunction(r.options.items) ? r.options.items.call(r.element) : t(r.options.items, r.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), r]);
      for (l.push([t.isFunction(this.options.items) ? this.options.items.call(this.element, null, {
          options: this.options,
          item: this.currentItem
        }) : t(this.options.items, this.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), this]), s = l.length - 1; s >= 0; s--) l[s][0].each(i);
      return t(a)
    },
    _removeCurrentsFromItems: function() {
      var e = this.currentItem.find(":data(" + this.widgetName + "-item)");
      this.items = t.grep(this.items, function(t) {
        for (var i = 0; i < e.length; i++)
          if (e[i] === t.item[0]) return !1;
        return !0
      })
    },
    _refreshItems: function(e) {
      this.items = [], this.containers = [this];
      var i, s, n, o, r, a, l, h, c = this.items,
        u = [
          [t.isFunction(this.options.items) ? this.options.items.call(this.element[0], e, {
            item: this.currentItem
          }) : t(this.options.items, this.element), this]
        ],
        d = this._connectWith();
      if (d && this.ready)
        for (i = d.length - 1; i >= 0; i--)
          for (n = t(d[i], this.document[0]), s = n.length - 1; s >= 0; s--)(o = t.data(n[s], this.widgetFullName)) && o !== this && !o.options.disabled && (u.push([t.isFunction(o.options.items) ? o.options.items.call(o.element[0], e, {
            item: this.currentItem
          }) : t(o.options.items, o.element), o]), this.containers.push(o));
      for (i = u.length - 1; i >= 0; i--)
        for (r = u[i][1], a = u[i][0], s = 0, h = a.length; s < h; s++) l = t(a[s]), l.data(this.widgetName + "-item", r), c.push({
          item: l,
          instance: r,
          width: 0,
          height: 0,
          left: 0,
          top: 0
        })
    },
    refreshPositions: function(e) {
      this.floating = !!this.items.length && ("x" === this.options.axis || this._isFloating(this.items[0].item)), this.offsetParent && this.helper && (this.offset.parent = this._getParentOffset());
      var i, s, n, o;
      for (i = this.items.length - 1; i >= 0; i--) s = this.items[i], s.instance !== this.currentContainer && this.currentContainer && s.item[0] !== this.currentItem[0] || (n = this.options.toleranceElement ? t(this.options.toleranceElement, s.item) : s.item, e || (s.width = n.outerWidth(), s.height = n.outerHeight()), o = n.offset(), s.left = o.left, s.top = o.top);
      if (this.options.custom && this.options.custom.refreshContainers) this.options.custom.refreshContainers.call(this);
      else
        for (i = this.containers.length - 1; i >= 0; i--) o = this.containers[i].element.offset(), this.containers[i].containerCache.left = o.left, this.containers[i].containerCache.top = o.top, this.containers[i].containerCache.width = this.containers[i].element.outerWidth(), this.containers[i].containerCache.height = this.containers[i].element.outerHeight();
      return this
    },
    _createPlaceholder: function(e) {
      e = e || this;
      var i, s = e.options;
      s.placeholder && s.placeholder.constructor !== String || (i = s.placeholder, s.placeholder = {
        element: function() {
          var s = e.currentItem[0].nodeName.toLowerCase(),
            n = t("<" + s + ">", e.document[0]);
          return e._addClass(n, "ui-sortable-placeholder", i || e.currentItem[0].className)._removeClass(n, "ui-sortable-helper"), "tbody" === s ? e._createTrPlaceholder(e.currentItem.find("tr").eq(0), t("<tr>", e.document[0]).appendTo(n)) : "tr" === s ? e._createTrPlaceholder(e.currentItem, n) : "img" === s && n.attr("src", e.currentItem.attr("src")), i || n.css("visibility", "hidden"), n
        },
        update: function(t, n) {
          i && !s.forcePlaceholderSize || (n.height() || n.height(e.currentItem.innerHeight() - parseInt(e.currentItem.css("paddingTop") || 0, 10) - parseInt(e.currentItem.css("paddingBottom") || 0, 10)), n.width() || n.width(e.currentItem.innerWidth() - parseInt(e.currentItem.css("paddingLeft") || 0, 10) - parseInt(e.currentItem.css("paddingRight") || 0, 10)))
        }
      }), e.placeholder = t(s.placeholder.element.call(e.element, e.currentItem)), e.currentItem.after(e.placeholder), s.placeholder.update(e, e.placeholder)
    },
    _createTrPlaceholder: function(e, i) {
      var s = this;
      e.children().each(function() {
        t("<td>&#160;</td>", s.document[0]).attr("colspan", t(this).attr("colspan") || 1).appendTo(i)
      })
    },
    _contactContainers: function(e) {
      var i, s, n, o, r, a, l, h, c, u, d = null,
        p = null;
      for (i = this.containers.length - 1; i >= 0; i--)
        if (!t.contains(this.currentItem[0], this.containers[i].element[0]))
          if (this._intersectsWith(this.containers[i].containerCache)) {
            if (d && t.contains(this.containers[i].element[0], d.element[0])) continue;
            d = this.containers[i], p = i
          } else this.containers[i].containerCache.over && (this.containers[i]._trigger("out", e, this._uiHash(this)), this.containers[i].containerCache.over = 0);
      if (d)
        if (1 === this.containers.length) this.containers[p].containerCache.over || (this.containers[p]._trigger("over", e, this._uiHash(this)), this.containers[p].containerCache.over = 1);
        else {
          for (n = 1e4, o = null, c = d.floating || this._isFloating(this.currentItem), r = c ? "left" : "top", a = c ? "width" : "height", u = c ? "pageX" : "pageY", s = this.items.length - 1; s >= 0; s--) t.contains(this.containers[p].element[0], this.items[s].item[0]) && this.items[s].item[0] !== this.currentItem[0] && (l = this.items[s].item.offset()[r], h = !1, e[u] - l > this.items[s][a] / 2 && (h = !0), Math.abs(e[u] - l) < n && (n = Math.abs(e[u] - l), o = this.items[s], this.direction = h ? "up" : "down"));
          if (!o && !this.options.dropOnEmpty) return;
          if (this.currentContainer === this.containers[p]) return void(this.currentContainer.containerCache.over || (this.containers[p]._trigger("over", e, this._uiHash()), this.currentContainer.containerCache.over = 1));
          o ? this._rearrange(e, o, null, !0) : this._rearrange(e, null, this.containers[p].element, !0), this._trigger("change", e, this._uiHash()), this.containers[p]._trigger("change", e, this._uiHash(this)), this.currentContainer = this.containers[p], this.options.placeholder.update(this.currentContainer, this.placeholder), this.containers[p]._trigger("over", e, this._uiHash(this)), this.containers[p].containerCache.over = 1
        }
    },
    _createHelper: function(e) {
      var i = this.options,
        s = t.isFunction(i.helper) ? t(i.helper.apply(this.element[0], [e, this.currentItem])) : "clone" === i.helper ? this.currentItem.clone() : this.currentItem;
      return s.parents("body").length || t("parent" !== i.appendTo ? i.appendTo : this.currentItem[0].parentNode)[0].appendChild(s[0]), s[0] === this.currentItem[0] && (this._storedCSS = {
        width: this.currentItem[0].style.width,
        height: this.currentItem[0].style.height,
        position: this.currentItem.css("position"),
        top: this.currentItem.css("top"),
        left: this.currentItem.css("left")
      }), s[0].style.width && !i.forceHelperSize || s.width(this.currentItem.width()), s[0].style.height && !i.forceHelperSize || s.height(this.currentItem.height()), s
    },
    _adjustOffsetFromHelper: function(e) {
      "string" == typeof e && (e = e.split(" ")), t.isArray(e) && (e = {
        left: +e[0],
        top: +e[1] || 0
      }), "left" in e && (this.offset.click.left = e.left + this.margins.left), "right" in e && (this.offset.click.left = this.helperProportions.width - e.right + this.margins.left), "top" in e && (this.offset.click.top = e.top + this.margins.top), "bottom" in e && (this.offset.click.top = this.helperProportions.height - e.bottom + this.margins.top)
    },
    _getParentOffset: function() {
      this.offsetParent = this.helper.offsetParent();
      var e = this.offsetParent.offset();
      return "absolute" === this.cssPosition && this.scrollParent[0] !== this.document[0] && t.contains(this.scrollParent[0], this.offsetParent[0]) && (e.left += this.scrollParent.scrollLeft(), e.top += this.scrollParent.scrollTop()), (this.offsetParent[0] === this.document[0].body || this.offsetParent[0].tagName && "html" === this.offsetParent[0].tagName.toLowerCase() && t.ui.ie) && (e = {
        top: 0,
        left: 0
      }), {
        top: e.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
        left: e.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)
      }
    },
    _getRelativeOffset: function() {
      if ("relative" === this.cssPosition) {
        var t = this.currentItem.position();
        return {
          top: t.top - (parseInt(this.helper.css("top"), 10) || 0) + this.scrollParent.scrollTop(),
          left: t.left - (parseInt(this.helper.css("left"), 10) || 0) + this.scrollParent.scrollLeft()
        }
      }
      return {
        top: 0,
        left: 0
      }
    },
    _cacheMargins: function() {
      this.margins = {
        left: parseInt(this.currentItem.css("marginLeft"), 10) || 0,
        top: parseInt(this.currentItem.css("marginTop"), 10) || 0
      }
    },
    _cacheHelperProportions: function() {
      this.helperProportions = {
        width: this.helper.outerWidth(),
        height: this.helper.outerHeight()
      }
    },
    _setContainment: function() {
      var e, i, s, n = this.options;
      "parent" === n.containment && (n.containment = this.helper[0].parentNode), "document" !== n.containment && "window" !== n.containment || (this.containment = [0 - this.offset.relative.left - this.offset.parent.left, 0 - this.offset.relative.top - this.offset.parent.top, "document" === n.containment ? this.document.width() : this.window.width() - this.helperProportions.width - this.margins.left, ("document" === n.containment ? this.document.height() || document.body.parentNode.scrollHeight : this.window.height() || this.document[0].body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]), /^(document|window|parent)$/.test(n.containment) || (e = t(n.containment)[0], i = t(n.containment).offset(), s = "hidden" !== t(e).css("overflow"), this.containment = [i.left + (parseInt(t(e).css("borderLeftWidth"), 10) || 0) + (parseInt(t(e).css("paddingLeft"), 10) || 0) - this.margins.left, i.top + (parseInt(t(e).css("borderTopWidth"), 10) || 0) + (parseInt(t(e).css("paddingTop"), 10) || 0) - this.margins.top, i.left + (s ? Math.max(e.scrollWidth, e.offsetWidth) : e.offsetWidth) - (parseInt(t(e).css("borderLeftWidth"), 10) || 0) - (parseInt(t(e).css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left, i.top + (s ? Math.max(e.scrollHeight, e.offsetHeight) : e.offsetHeight) - (parseInt(t(e).css("borderTopWidth"), 10) || 0) - (parseInt(t(e).css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top])
    },
    _convertPositionTo: function(e, i) {
      i || (i = this.position);
      var s = "absolute" === e ? 1 : -1,
        n = "absolute" !== this.cssPosition || this.scrollParent[0] !== this.document[0] && t.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent,
        o = /(html|body)/i.test(n[0].tagName);
      return {
        top: i.top + this.offset.relative.top * s + this.offset.parent.top * s - ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : o ? 0 : n.scrollTop()) * s,
        left: i.left + this.offset.relative.left * s + this.offset.parent.left * s - ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : o ? 0 : n.scrollLeft()) * s
      }
    },
    _generatePosition: function(e) {
      var i, s, n = this.options,
        o = e.pageX,
        r = e.pageY,
        a = "absolute" !== this.cssPosition || this.scrollParent[0] !== this.document[0] && t.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent,
        l = /(html|body)/i.test(a[0].tagName);
      return "relative" !== this.cssPosition || this.scrollParent[0] !== this.document[0] && this.scrollParent[0] !== this.offsetParent[0] || (this.offset.relative = this._getRelativeOffset()), this.originalPosition && (this.containment && (e.pageX - this.offset.click.left < this.containment[0] && (o = this.containment[0] + this.offset.click.left), e.pageY - this.offset.click.top < this.containment[1] && (r = this.containment[1] + this.offset.click.top), e.pageX - this.offset.click.left > this.containment[2] && (o = this.containment[2] + this.offset.click.left), e.pageY - this.offset.click.top > this.containment[3] && (r = this.containment[3] + this.offset.click.top)), n.grid && (i = this.originalPageY + Math.round((r - this.originalPageY) / n.grid[1]) * n.grid[1], r = this.containment ? i - this.offset.click.top >= this.containment[1] && i - this.offset.click.top <= this.containment[3] ? i : i - this.offset.click.top >= this.containment[1] ? i - n.grid[1] : i + n.grid[1] : i, s = this.originalPageX + Math.round((o - this.originalPageX) / n.grid[0]) * n.grid[0], o = this.containment ? s - this.offset.click.left >= this.containment[0] && s - this.offset.click.left <= this.containment[2] ? s : s - this.offset.click.left >= this.containment[0] ? s - n.grid[0] : s + n.grid[0] : s)), {
        top: r - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : l ? 0 : a.scrollTop()),
        left: o - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : l ? 0 : a.scrollLeft())
      }
    },
    _rearrange: function(t, e, i, s) {
      i ? i[0].appendChild(this.placeholder[0]) : e.item[0].parentNode.insertBefore(this.placeholder[0], "down" === this.direction ? e.item[0] : e.item[0].nextSibling), this.counter = this.counter ? ++this.counter : 1;
      var n = this.counter;
      this._delay(function() {
        n === this.counter && this.refreshPositions(!s)
      })
    },
    _clear: function(t, e) {
      function i(t, e, i) {
        return function(s) {
          i._trigger(t, s, e._uiHash(e))
        }
      }
      this.reverting = !1;
      var s, n = [];
      if (!this._noFinalSort && this.currentItem.parent().length && this.placeholder.before(this.currentItem), this._noFinalSort = null, this.helper[0] === this.currentItem[0]) {
        for (s in this._storedCSS) "auto" !== this._storedCSS[s] && "static" !== this._storedCSS[s] || (this._storedCSS[s] = "");
        this.currentItem.css(this._storedCSS), this._removeClass(this.currentItem, "ui-sortable-helper")
      } else this.currentItem.show();
      for (this.fromOutside && !e && n.push(function(t) {
          this._trigger("receive", t, this._uiHash(this.fromOutside))
        }), !this.fromOutside && this.domPosition.prev === this.currentItem.prev().not(".ui-sortable-helper")[0] && this.domPosition.parent === this.currentItem.parent()[0] || e || n.push(function(t) {
          this._trigger("update", t, this._uiHash())
        }), this !== this.currentContainer && (e || (n.push(function(t) {
          this._trigger("remove", t, this._uiHash())
        }), n.push(function(t) {
          return function(e) {
            t._trigger("receive", e, this._uiHash(this))
          }
        }.call(this, this.currentContainer)), n.push(function(t) {
          return function(e) {
            t._trigger("update", e, this._uiHash(this))
          }
        }.call(this, this.currentContainer)))), s = this.containers.length - 1; s >= 0; s--) e || n.push(i("deactivate", this, this.containers[s])), this.containers[s].containerCache.over && (n.push(i("out", this, this.containers[s])), this.containers[s].containerCache.over = 0);
      if (this.storedCursor && (this.document.find("body").css("cursor", this.storedCursor), this.storedStylesheet.remove()), this._storedOpacity && this.helper.css("opacity", this._storedOpacity), this._storedZIndex && this.helper.css("zIndex", "auto" === this._storedZIndex ? "" : this._storedZIndex), this.dragging = !1, e || this._trigger("beforeStop", t, this._uiHash()), this.placeholder[0].parentNode.removeChild(this.placeholder[0]), this.cancelHelperRemoval || (this.helper[0] !== this.currentItem[0] && this.helper.remove(), this.helper = null), !e) {
        for (s = 0; s < n.length; s++) n[s].call(this, t);
        this._trigger("stop", t, this._uiHash())
      }
      return this.fromOutside = !1, !this.cancelHelperRemoval
    },
    _trigger: function() {
      !1 === t.Widget.prototype._trigger.apply(this, arguments) && this.cancel()
    },
    _uiHash: function(e) {
      var i = e || this;
      return {
        helper: i.helper,
        placeholder: i.placeholder || t([]),
        position: i.position,
        originalPosition: i.originalPosition,
        offset: i.positionAbs,
        item: i.currentItem,
        sender: e ? e.element : null
      }
    }
  });
  t.widget("ui.spinner", {
    version: "1.12.1",
    defaultElement: "<input>",
    widgetEventPrefix: "spin",
    options: {
      classes: {
        "ui-spinner": "ui-corner-all",
        "ui-spinner-down": "ui-corner-br",
        "ui-spinner-up": "ui-corner-tr"
      },
      culture: null,
      icons: {
        down: "ui-icon-triangle-1-s",
        up: "ui-icon-triangle-1-n"
      },
      incremental: !0,
      max: null,
      min: null,
      numberFormat: null,
      page: 10,
      step: 1,
      change: null,
      spin: null,
      start: null,
      stop: null
    },
    _create: function() {
      this._setOption("max", this.options.max), this._setOption("min", this.options.min), this._setOption("step", this.options.step), "" !== this.value() && this._value(this.element.val(), !0), this._draw(), this._on(this._events), this._refresh(), this._on(this.window, {
        beforeunload: function() {
          this.element.removeAttr("autocomplete")
        }
      })
    },
    _getCreateOptions: function() {
      var e = this._super(),
        i = this.element;
      return t.each(["min", "max", "step"], function(t, s) {
        var n = i.attr(s);
        null != n && n.length && (e[s] = n)
      }), e
    },
    _events: {
      keydown: function(t) {
        this._start(t) && this._keydown(t) && t.preventDefault()
      },
      keyup: "_stop",
      focus: function() {
        this.previous = this.element.val()
      },
      blur: function(t) {
        if (this.cancelBlur) return void delete this.cancelBlur;
        this._stop(), this._refresh(), this.previous !== this.element.val() && this._trigger("change", t)
      },
      mousewheel: function(t, e) {
        if (e) {
          if (!this.spinning && !this._start(t)) return !1;
          this._spin((e > 0 ? 1 : -1) * this.options.step, t), clearTimeout(this.mousewheelTimer), this.mousewheelTimer = this._delay(function() {
            this.spinning && this._stop(t)
          }, 100), t.preventDefault()
        }
      },
      "mousedown .ui-spinner-button": function(e) {
        function i() {
          this.element[0] === t.ui.safeActiveElement(this.document[0]) || (this.element.trigger("focus"), this.previous = s, this._delay(function() {
            this.previous = s
          }))
        }
        var s;
        s = this.element[0] === t.ui.safeActiveElement(this.document[0]) ? this.previous : this.element.val(), e.preventDefault(), i.call(this), this.cancelBlur = !0, this._delay(function() {
          delete this.cancelBlur, i.call(this)
        }), !1 !== this._start(e) && this._repeat(null, t(e.currentTarget).hasClass("ui-spinner-up") ? 1 : -1, e)
      },
      "mouseup .ui-spinner-button": "_stop",
      "mouseenter .ui-spinner-button": function(e) {
        if (t(e.currentTarget).hasClass("ui-state-active")) return !1 !== this._start(e) && void this._repeat(null, t(e.currentTarget).hasClass("ui-spinner-up") ? 1 : -1, e)
      },
      "mouseleave .ui-spinner-button": "_stop"
    },
    _enhance: function() {
      this.uiSpinner = this.element.attr("autocomplete", "off").wrap("<span>").parent().append("<a></a><a></a>")
    },
    _draw: function() {
      this._enhance(), this._addClass(this.uiSpinner, "ui-spinner", "ui-widget ui-widget-content"), this._addClass("ui-spinner-input"), this.element.attr("role", "spinbutton"), this.buttons = this.uiSpinner.children("a").attr("tabIndex", -1).attr("aria-hidden", !0).button({
        classes: {
          "ui-button": ""
        }
      }), this._removeClass(this.buttons, "ui-corner-all"), this._addClass(this.buttons.first(), "ui-spinner-button ui-spinner-up"), this._addClass(this.buttons.last(), "ui-spinner-button ui-spinner-down"), this.buttons.first().button({
        icon: this.options.icons.up,
        showLabel: !1
      }), this.buttons.last().button({
        icon: this.options.icons.down,
        showLabel: !1
      }), this.buttons.height() > Math.ceil(.5 * this.uiSpinner.height()) && this.uiSpinner.height() > 0 && this.uiSpinner.height(this.uiSpinner.height())
    },
    _keydown: function(e) {
      var i = this.options,
        s = t.ui.keyCode;
      switch (e.keyCode) {
        case s.UP:
          return this._repeat(null, 1, e), !0;
        case s.DOWN:
          return this._repeat(null, -1, e), !0;
        case s.PAGE_UP:
          return this._repeat(null, i.page, e), !0;
        case s.PAGE_DOWN:
          return this._repeat(null, -i.page, e), !0
      }
      return !1
    },
    _start: function(t) {
      return !(!this.spinning && !1 === this._trigger("start", t)) && (this.counter || (this.counter = 1), this.spinning = !0, !0)
    },
    _repeat: function(t, e, i) {
      t = t || 500, clearTimeout(this.timer), this.timer = this._delay(function() {
        this._repeat(40, e, i)
      }, t), this._spin(e * this.options.step, i)
    },
    _spin: function(t, e) {
      var i = this.value() || 0;
      this.counter || (this.counter = 1), i = this._adjustValue(i + t * this._increment(this.counter)), this.spinning && !1 === this._trigger("spin", e, {
        value: i
      }) || (this._value(i), this.counter++)
    },
    _increment: function(e) {
      var i = this.options.incremental;
      return i ? t.isFunction(i) ? i(e) : Math.floor(e * e * e / 5e4 - e * e / 500 + 17 * e / 200 + 1) : 1
    },
    _precision: function() {
      var t = this._precisionOf(this.options.step);
      return null !== this.options.min && (t = Math.max(t, this._precisionOf(this.options.min))), t
    },
    _precisionOf: function(t) {
      var e = t.toString(),
        i = e.indexOf(".");
      return -1 === i ? 0 : e.length - i - 1
    },
    _adjustValue: function(t) {
      var e, i, s = this.options;
      return e = null !== s.min ? s.min : 0, i = t - e, i = Math.round(i / s.step) * s.step, t = e + i, t = parseFloat(t.toFixed(this._precision())), null !== s.max && t > s.max ? s.max : null !== s.min && t < s.min ? s.min : t
    },
    _stop: function(t) {
      this.spinning && (clearTimeout(this.timer), clearTimeout(this.mousewheelTimer), this.counter = 0, this.spinning = !1, this._trigger("stop", t))
    },
    _setOption: function(t, e) {
      var i, s, n;
      if ("culture" === t || "numberFormat" === t) return i = this._parse(this.element.val()), this.options[t] = e, void this.element.val(this._format(i));
      "max" !== t && "min" !== t && "step" !== t || "string" == typeof e && (e = this._parse(e)), "icons" === t && (s = this.buttons.first().find(".ui-icon"), this._removeClass(s, null, this.options.icons.up), this._addClass(s, null, e.up),
        n = this.buttons.last().find(".ui-icon"), this._removeClass(n, null, this.options.icons.down), this._addClass(n, null, e.down)), this._super(t, e)
    },
    _setOptionDisabled: function(t) {
      this._super(t), this._toggleClass(this.uiSpinner, null, "ui-state-disabled", !!t), this.element.prop("disabled", !!t), this.buttons.button(t ? "disable" : "enable")
    },
    _setOptions: a(function(t) {
      this._super(t)
    }),
    _parse: function(t) {
      return "string" == typeof t && "" !== t && (t = window.Globalize && this.options.numberFormat ? Globalize.parseFloat(t, 10, this.options.culture) : +t), "" === t || isNaN(t) ? null : t
    },
    _format: function(t) {
      return "" === t ? "" : window.Globalize && this.options.numberFormat ? Globalize.format(t, this.options.numberFormat, this.options.culture) : t
    },
    _refresh: function() {
      this.element.attr({
        "aria-valuemin": this.options.min,
        "aria-valuemax": this.options.max,
        "aria-valuenow": this._parse(this.element.val())
      })
    },
    isValid: function() {
      var t = this.value();
      return null !== t && t === this._adjustValue(t)
    },
    _value: function(t, e) {
      var i;
      "" !== t && null !== (i = this._parse(t)) && (e || (i = this._adjustValue(i)), t = this._format(i)), this.element.val(t), this._refresh()
    },
    _destroy: function() {
      this.element.prop("disabled", !1).removeAttr("autocomplete role aria-valuemin aria-valuemax aria-valuenow"), this.uiSpinner.replaceWith(this.element)
    },
    stepUp: a(function(t) {
      this._stepUp(t)
    }),
    _stepUp: function(t) {
      this._start() && (this._spin((t || 1) * this.options.step), this._stop())
    },
    stepDown: a(function(t) {
      this._stepDown(t)
    }),
    _stepDown: function(t) {
      this._start() && (this._spin((t || 1) * -this.options.step), this._stop())
    },
    pageUp: a(function(t) {
      this._stepUp((t || 1) * this.options.page)
    }),
    pageDown: a(function(t) {
      this._stepDown((t || 1) * this.options.page)
    }),
    value: function(t) {
      if (!arguments.length) return this._parse(this.element.val());
      a(this._value).call(this, t)
    },
    widget: function() {
      return this.uiSpinner
    }
  }), !1 !== t.uiBackCompat && t.widget("ui.spinner", t.ui.spinner, {
    _enhance: function() {
      this.uiSpinner = this.element.attr("autocomplete", "off").wrap(this._uiSpinnerHtml()).parent().append(this._buttonHtml())
    },
    _uiSpinnerHtml: function() {
      return "<span>"
    },
    _buttonHtml: function() {
      return "<a></a><a></a>"
    }
  });
  t.ui.spinner;
  t.widget("ui.tabs", {
    version: "1.12.1",
    delay: 300,
    options: {
      active: null,
      classes: {
        "ui-tabs": "ui-corner-all",
        "ui-tabs-nav": "ui-corner-all",
        "ui-tabs-panel": "ui-corner-bottom",
        "ui-tabs-tab": "ui-corner-top"
      },
      collapsible: !1,
      event: "click",
      heightStyle: "content",
      hide: null,
      show: null,
      activate: null,
      beforeActivate: null,
      beforeLoad: null,
      load: null
    },
    _isLocal: function() {
      return function(t) {
        var e, i;
        e = t.href.replace(/#.*$/, ""), i = location.href.replace(/#.*$/, "");
        try {
          e = decodeURIComponent(e)
        } catch (t) {}
        try {
          i = decodeURIComponent(i)
        } catch (t) {}
        return t.hash.length > 1 && e === i
      }
    }(),
    _create: function() {
      var e = this,
        i = this.options;
      this.running = !1, this._addClass("ui-tabs", "ui-widget ui-widget-content"), this._toggleClass("ui-tabs-collapsible", null, i.collapsible), this._processTabs(), i.active = this._initialActive(), t.isArray(i.disabled) && (i.disabled = t.unique(i.disabled.concat(t.map(this.tabs.filter(".ui-state-disabled"), function(t) {
        return e.tabs.index(t)
      }))).sort()), !1 !== this.options.active && this.anchors.length ? this.active = this._findActive(i.active) : this.active = t(), this._refresh(), this.active.length && this.load(i.active)
    },
    _initialActive: function() {
      var e = this.options.active,
        i = this.options.collapsible,
        s = location.hash.substring(1);
      return null === e && (s && this.tabs.each(function(i, n) {
        if (t(n).attr("aria-controls") === s) return e = i, !1
      }), null === e && (e = this.tabs.index(this.tabs.filter(".ui-tabs-active"))), null !== e && -1 !== e || (e = !!this.tabs.length && 0)), !1 !== e && -1 === (e = this.tabs.index(this.tabs.eq(e))) && (e = !i && 0), !i && !1 === e && this.anchors.length && (e = 0), e
    },
    _getCreateEventData: function() {
      return {
        tab: this.active,
        panel: this.active.length ? this._getPanelForTab(this.active) : t()
      }
    },
    _tabKeydown: function(e) {
      var i = t(t.ui.safeActiveElement(this.document[0])).closest("li"),
        s = this.tabs.index(i),
        n = !0;
      if (!this._handlePageNav(e)) {
        switch (e.keyCode) {
          case t.ui.keyCode.RIGHT:
          case t.ui.keyCode.DOWN:
            s++;
            break;
          case t.ui.keyCode.UP:
          case t.ui.keyCode.LEFT:
            n = !1, s--;
            break;
          case t.ui.keyCode.END:
            s = this.anchors.length - 1;
            break;
          case t.ui.keyCode.HOME:
            s = 0;
            break;
          case t.ui.keyCode.SPACE:
            return e.preventDefault(), clearTimeout(this.activating), void this._activate(s);
          case t.ui.keyCode.ENTER:
            return e.preventDefault(), clearTimeout(this.activating), void this._activate(s !== this.options.active && s);
          default:
            return
        }
        e.preventDefault(), clearTimeout(this.activating), s = this._focusNextTab(s, n), e.ctrlKey || e.metaKey || (i.attr("aria-selected", "false"), this.tabs.eq(s).attr("aria-selected", "true"), this.activating = this._delay(function() {
          this.option("active", s)
        }, this.delay))
      }
    },
    _panelKeydown: function(e) {
      this._handlePageNav(e) || e.ctrlKey && e.keyCode === t.ui.keyCode.UP && (e.preventDefault(), this.active.trigger("focus"))
    },
    _handlePageNav: function(e) {
      return e.altKey && e.keyCode === t.ui.keyCode.PAGE_UP ? (this._activate(this._focusNextTab(this.options.active - 1, !1)), !0) : e.altKey && e.keyCode === t.ui.keyCode.PAGE_DOWN ? (this._activate(this._focusNextTab(this.options.active + 1, !0)), !0) : void 0
    },
    _findNextTab: function(e, i) {
      for (var s = this.tabs.length - 1; - 1 !== t.inArray(function() {
          return e > s && (e = 0), e < 0 && (e = s), e
        }(), this.options.disabled);) e = i ? e + 1 : e - 1;
      return e
    },
    _focusNextTab: function(t, e) {
      return t = this._findNextTab(t, e), this.tabs.eq(t).trigger("focus"), t
    },
    _setOption: function(t, e) {
      if ("active" === t) return void this._activate(e);
      this._super(t, e), "collapsible" === t && (this._toggleClass("ui-tabs-collapsible", null, e), e || !1 !== this.options.active || this._activate(0)), "event" === t && this._setupEvents(e), "heightStyle" === t && this._setupHeightStyle(e)
    },
    _sanitizeSelector: function(t) {
      return t ? t.replace(/[!"$%&'()*+,.\/:;<=>?@\[\]\^`{|}~]/g, "\\$&") : ""
    },
    refresh: function() {
      var e = this.options,
        i = this.tablist.children(":has(a[href])");
      e.disabled = t.map(i.filter(".ui-state-disabled"), function(t) {
        return i.index(t)
      }), this._processTabs(), !1 !== e.active && this.anchors.length ? this.active.length && !t.contains(this.tablist[0], this.active[0]) ? this.tabs.length === e.disabled.length ? (e.active = !1, this.active = t()) : this._activate(this._findNextTab(Math.max(0, e.active - 1), !1)) : e.active = this.tabs.index(this.active) : (e.active = !1, this.active = t()), this._refresh()
    },
    _refresh: function() {
      this._setOptionDisabled(this.options.disabled), this._setupEvents(this.options.event), this._setupHeightStyle(this.options.heightStyle), this.tabs.not(this.active).attr({
        "aria-selected": "false",
        "aria-expanded": "false",
        tabIndex: -1
      }), this.panels.not(this._getPanelForTab(this.active)).hide().attr({
        "aria-hidden": "true"
      }), this.active.length ? (this.active.attr({
        "aria-selected": "true",
        "aria-expanded": "true",
        tabIndex: 0
      }), this._addClass(this.active, "ui-tabs-active", "ui-state-active"), this._getPanelForTab(this.active).show().attr({
        "aria-hidden": "false"
      })) : this.tabs.eq(0).attr("tabIndex", 0)
    },
    _processTabs: function() {
      var e = this,
        i = this.tabs,
        s = this.anchors,
        n = this.panels;
      this.tablist = this._getList().attr("role", "tablist"), this._addClass(this.tablist, "ui-tabs-nav", "ui-helper-reset ui-helper-clearfix ui-widget-header"), this.tablist.on("mousedown" + this.eventNamespace, "> li", function(e) {
        t(this).is(".ui-state-disabled") && e.preventDefault()
      }).on("focus" + this.eventNamespace, ".ui-tabs-anchor", function() {
        t(this).closest("li").is(".ui-state-disabled") && this.blur()
      }), this.tabs = this.tablist.find("> li:has(a[href])").attr({
        role: "tab",
        tabIndex: -1
      }), this._addClass(this.tabs, "ui-tabs-tab", "ui-state-default"), this.anchors = this.tabs.map(function() {
        return t("a", this)[0]
      }).attr({
        role: "presentation",
        tabIndex: -1
      }), this._addClass(this.anchors, "ui-tabs-anchor"), this.panels = t(), this.anchors.each(function(i, s) {
        var n, o, r, a = t(s).uniqueId().attr("id"),
          l = t(s).closest("li"),
          h = l.attr("aria-controls");
        e._isLocal(s) ? (n = s.hash, r = n.substring(1), o = e.element.find(e._sanitizeSelector(n))) : (r = l.attr("aria-controls") || t({}).uniqueId()[0].id, n = "#" + r, o = e.element.find(n), o.length || (o = e._createPanel(r), o.insertAfter(e.panels[i - 1] || e.tablist)), o.attr("aria-live", "polite")), o.length && (e.panels = e.panels.add(o)), h && l.data("ui-tabs-aria-controls", h), l.attr({
          "aria-controls": r,
          "aria-labelledby": a
        }), o.attr("aria-labelledby", a)
      }), this.panels.attr("role", "tabpanel"), this._addClass(this.panels, "ui-tabs-panel", "ui-widget-content"), i && (this._off(i.not(this.tabs)), this._off(s.not(this.anchors)), this._off(n.not(this.panels)))
    },
    _getList: function() {
      return this.tablist || this.element.find("ol, ul").eq(0)
    },
    _createPanel: function(e) {
      return t("<div>").attr("id", e).data("ui-tabs-destroy", !0)
    },
    _setOptionDisabled: function(e) {
      var i, s, n;
      for (t.isArray(e) && (e.length ? e.length === this.anchors.length && (e = !0) : e = !1), n = 0; s = this.tabs[n]; n++) i = t(s), !0 === e || -1 !== t.inArray(n, e) ? (i.attr("aria-disabled", "true"), this._addClass(i, null, "ui-state-disabled")) : (i.removeAttr("aria-disabled"), this._removeClass(i, null, "ui-state-disabled"));
      this.options.disabled = e, this._toggleClass(this.widget(), this.widgetFullName + "-disabled", null, !0 === e)
    },
    _setupEvents: function(e) {
      var i = {};
      e && t.each(e.split(" "), function(t, e) {
        i[e] = "_eventHandler"
      }), this._off(this.anchors.add(this.tabs).add(this.panels)), this._on(!0, this.anchors, {
        click: function(t) {
          t.preventDefault()
        }
      }), this._on(this.anchors, i), this._on(this.tabs, {
        keydown: "_tabKeydown"
      }), this._on(this.panels, {
        keydown: "_panelKeydown"
      }), this._focusable(this.tabs), this._hoverable(this.tabs)
    },
    _setupHeightStyle: function(e) {
      var i, s = this.element.parent();
      "fill" === e ? (i = s.height(), i -= this.element.outerHeight() - this.element.height(), this.element.siblings(":visible").each(function() {
        var e = t(this),
          s = e.css("position");
        "absolute" !== s && "fixed" !== s && (i -= e.outerHeight(!0))
      }), this.element.children().not(this.panels).each(function() {
        i -= t(this).outerHeight(!0)
      }), this.panels.each(function() {
        t(this).height(Math.max(0, i - t(this).innerHeight() + t(this).height()))
      }).css("overflow", "auto")) : "auto" === e && (i = 0, this.panels.each(function() {
        i = Math.max(i, t(this).height("").height())
      }).height(i))
    },
    _eventHandler: function(e) {
      var i = this.options,
        s = this.active,
        n = t(e.currentTarget),
        o = n.closest("li"),
        r = o[0] === s[0],
        a = r && i.collapsible,
        l = a ? t() : this._getPanelForTab(o),
        h = s.length ? this._getPanelForTab(s) : t(),
        c = {
          oldTab: s,
          oldPanel: h,
          newTab: a ? t() : o,
          newPanel: l
        };
      e.preventDefault(), o.hasClass("ui-state-disabled") || o.hasClass("ui-tabs-loading") || this.running || r && !i.collapsible || !1 === this._trigger("beforeActivate", e, c) || (i.active = !a && this.tabs.index(o), this.active = r ? t() : o, this.xhr && this.xhr.abort(), h.length || l.length || t.error("jQuery UI Tabs: Mismatching fragment identifier."), l.length && this.load(this.tabs.index(o), e), this._toggle(e, c))
    },
    _toggle: function(e, i) {
      function s() {
        o.running = !1, o._trigger("activate", e, i)
      }

      function n() {
        o._addClass(i.newTab.closest("li"), "ui-tabs-active", "ui-state-active"), r.length && o.options.show ? o._show(r, o.options.show, s) : (r.show(), s())
      }
      var o = this,
        r = i.newPanel,
        a = i.oldPanel;
      this.running = !0, a.length && this.options.hide ? this._hide(a, this.options.hide, function() {
        o._removeClass(i.oldTab.closest("li"), "ui-tabs-active", "ui-state-active"), n()
      }) : (this._removeClass(i.oldTab.closest("li"), "ui-tabs-active", "ui-state-active"), a.hide(), n()), a.attr("aria-hidden", "true"), i.oldTab.attr({
        "aria-selected": "false",
        "aria-expanded": "false"
      }), r.length && a.length ? i.oldTab.attr("tabIndex", -1) : r.length && this.tabs.filter(function() {
        return 0 === t(this).attr("tabIndex")
      }).attr("tabIndex", -1), r.attr("aria-hidden", "false"), i.newTab.attr({
        "aria-selected": "true",
        "aria-expanded": "true",
        tabIndex: 0
      })
    },
    _activate: function(e) {
      var i, s = this._findActive(e);
      s[0] !== this.active[0] && (s.length || (s = this.active), i = s.find(".ui-tabs-anchor")[0], this._eventHandler({
        target: i,
        currentTarget: i,
        preventDefault: t.noop
      }))
    },
    _findActive: function(e) {
      return !1 === e ? t() : this.tabs.eq(e)
    },
    _getIndex: function(e) {
      return "string" == typeof e && (e = this.anchors.index(this.anchors.filter("[href$='" + t.ui.escapeSelector(e) + "']"))), e
    },
    _destroy: function() {
      this.xhr && this.xhr.abort(), this.tablist.removeAttr("role").off(this.eventNamespace), this.anchors.removeAttr("role tabIndex").removeUniqueId(), this.tabs.add(this.panels).each(function() {
        t.data(this, "ui-tabs-destroy") ? t(this).remove() : t(this).removeAttr("role tabIndex aria-live aria-busy aria-selected aria-labelledby aria-hidden aria-expanded")
      }), this.tabs.each(function() {
        var e = t(this),
          i = e.data("ui-tabs-aria-controls");
        i ? e.attr("aria-controls", i).removeData("ui-tabs-aria-controls") : e.removeAttr("aria-controls")
      }), this.panels.show(), "content" !== this.options.heightStyle && this.panels.css("height", "")
    },
    enable: function(e) {
      var i = this.options.disabled;
      !1 !== i && (void 0 === e ? i = !1 : (e = this._getIndex(e), i = t.isArray(i) ? t.map(i, function(t) {
        return t !== e ? t : null
      }) : t.map(this.tabs, function(t, i) {
        return i !== e ? i : null
      })), this._setOptionDisabled(i))
    },
    disable: function(e) {
      var i = this.options.disabled;
      if (!0 !== i) {
        if (void 0 === e) i = !0;
        else {
          if (e = this._getIndex(e), -1 !== t.inArray(e, i)) return;
          i = t.isArray(i) ? t.merge([e], i).sort() : [e]
        }
        this._setOptionDisabled(i)
      }
    },
    load: function(e, i) {
      e = this._getIndex(e);
      var s = this,
        n = this.tabs.eq(e),
        o = n.find(".ui-tabs-anchor"),
        r = this._getPanelForTab(n),
        a = {
          tab: n,
          panel: r
        },
        l = function(t, e) {
          "abort" === e && s.panels.stop(!1, !0), s._removeClass(n, "ui-tabs-loading"), r.removeAttr("aria-busy"), t === s.xhr && delete s.xhr
        };
      this._isLocal(o[0]) || (this.xhr = t.ajax(this._ajaxSettings(o, i, a)), this.xhr && "canceled" !== this.xhr.statusText && (this._addClass(n, "ui-tabs-loading"), r.attr("aria-busy", "true"), this.xhr.done(function(t, e, n) {
        setTimeout(function() {
          r.html(t), s._trigger("load", i, a), l(n, e)
        }, 1)
      }).fail(function(t, e) {
        setTimeout(function() {
          l(t, e)
        }, 1)
      })))
    },
    _ajaxSettings: function(e, i, s) {
      var n = this;
      return {
        url: e.attr("href").replace(/#.*$/, ""),
        beforeSend: function(e, o) {
          return n._trigger("beforeLoad", i, t.extend({
            jqXHR: e,
            ajaxSettings: o
          }, s))
        }
      }
    },
    _getPanelForTab: function(e) {
      var i = t(e).attr("aria-controls");
      return this.element.find(this._sanitizeSelector("#" + i))
    }
  }), !1 !== t.uiBackCompat && t.widget("ui.tabs", t.ui.tabs, {
    _processTabs: function() {
      this._superApply(arguments), this._addClass(this.tabs, "ui-tab")
    }
  });
  t.ui.tabs;
  t.widget("ui.tooltip", {
    version: "1.12.1",
    options: {
      classes: {
        "ui-tooltip": "ui-corner-all ui-widget-shadow"
      },
      content: function() {
        var e = t(this).attr("title") || "";
        return t("<a>").text(e).html()
      },
      hide: !0,
      items: "[title]:not([disabled])",
      position: {
        my: "left top+15",
        at: "left bottom",
        collision: "flipfit flip"
      },
      show: !0,
      track: !1,
      close: null,
      open: null
    },
    _addDescribedBy: function(e, i) {
      var s = (e.attr("aria-describedby") || "").split(/\s+/);
      s.push(i), e.data("ui-tooltip-id", i).attr("aria-describedby", t.trim(s.join(" ")))
    },
    _removeDescribedBy: function(e) {
      var i = e.data("ui-tooltip-id"),
        s = (e.attr("aria-describedby") || "").split(/\s+/),
        n = t.inArray(i, s); - 1 !== n && s.splice(n, 1), e.removeData("ui-tooltip-id"), s = t.trim(s.join(" ")), s ? e.attr("aria-describedby", s) : e.removeAttr("aria-describedby")
    },
    _create: function() {
      this._on({
        mouseover: "open",
        focusin: "open"
      }), this.tooltips = {}, this.parents = {}, this.liveRegion = t("<div>").attr({
        role: "log",
        "aria-live": "assertive",
        "aria-relevant": "additions"
      }).appendTo(this.document[0].body), this._addClass(this.liveRegion, null, "ui-helper-hidden-accessible"), this.disabledTitles = t([])
    },
    _setOption: function(e, i) {
      var s = this;
      this._super(e, i), "content" === e && t.each(this.tooltips, function(t, e) {
        s._updateContent(e.element)
      })
    },
    _setOptionDisabled: function(t) {
      this[t ? "_disable" : "_enable"]()
    },
    _disable: function() {
      var e = this;
      t.each(this.tooltips, function(i, s) {
        var n = t.Event("blur");
        n.target = n.currentTarget = s.element[0], e.close(n, !0)
      }), this.disabledTitles = this.disabledTitles.add(this.element.find(this.options.items).addBack().filter(function() {
        var e = t(this);
        if (e.is("[title]")) return e.data("ui-tooltip-title", e.attr("title")).removeAttr("title")
      }))
    },
    _enable: function() {
      this.disabledTitles.each(function() {
        var e = t(this);
        e.data("ui-tooltip-title") && e.attr("title", e.data("ui-tooltip-title"))
      }), this.disabledTitles = t([])
    },
    open: function(e) {
      var i = this,
        s = t(e ? e.target : this.element).closest(this.options.items);
      s.length && !s.data("ui-tooltip-id") && (s.attr("title") && s.data("ui-tooltip-title", s.attr("title")), s.data("ui-tooltip-open", !0), e && "mouseover" === e.type && s.parents().each(function() {
        var e, s = t(this);
        s.data("ui-tooltip-open") && (e = t.Event("blur"), e.target = e.currentTarget = this, i.close(e, !0)), s.attr("title") && (s.uniqueId(), i.parents[this.id] = {
          element: this,
          title: s.attr("title")
        }, s.attr("title", ""))
      }), this._registerCloseHandlers(e, s), this._updateContent(s, e))
    },
    _updateContent: function(t, e) {
      var i, s = this.options.content,
        n = this,
        o = e ? e.type : null;
      if ("string" == typeof s || s.nodeType || s.jquery) return this._open(e, t, s);
      (i = s.call(t[0], function(i) {
        n._delay(function() {
          t.data("ui-tooltip-open") && (e && (e.type = o), this._open(e, t, i))
        })
      })) && this._open(e, t, i)
    },
    _open: function(e, i, s) {
      function n(t) {
        h.of = t, r.is(":hidden") || r.position(h)
      }
      var o, r, a, l, h = t.extend({}, this.options.position);
      if (s) {
        if (o = this._find(i)) return void o.tooltip.find(".ui-tooltip-content").html(s);
        i.is("[title]") && (e && "mouseover" === e.type ? i.attr("title", "") : i.removeAttr("title")), o = this._tooltip(i), r = o.tooltip, this._addDescribedBy(i, r.attr("id")), r.find(".ui-tooltip-content").html(s), this.liveRegion.children().hide(), l = t("<div>").html(r.find(".ui-tooltip-content").html()), l.removeAttr("name").find("[name]").removeAttr("name"), l.removeAttr("id").find("[id]").removeAttr("id"), l.appendTo(this.liveRegion), this.options.track && e && /^mouse/.test(e.type) ? (this._on(this.document, {
          mousemove: n
        }), n(e)) : r.position(t.extend({
          of: i
        }, this.options.position)), r.hide(), this._show(r, this.options.show), this.options.track && this.options.show && this.options.show.delay && (a = this.delayedShow = setInterval(function() {
          r.is(":visible") && (n(h.of), clearInterval(a))
        }, t.fx.interval)), this._trigger("open", e, {
          tooltip: r
        })
      }
    },
    _registerCloseHandlers: function(e, i) {
      var s = {
        keyup: function(e) {
          if (e.keyCode === t.ui.keyCode.ESCAPE) {
            var s = t.Event(e);
            s.currentTarget = i[0], this.close(s, !0)
          }
        }
      };
      i[0] !== this.element[0] && (s.remove = function() {
        this._removeTooltip(this._find(i).tooltip)
      }), e && "mouseover" !== e.type || (s.mouseleave = "close"), e && "focusin" !== e.type || (s.focusout = "close"), this._on(!0, i, s)
    },
    close: function(e) {
      var i, s = this,
        n = t(e ? e.currentTarget : this.element),
        o = this._find(n);
      if (!o) return void n.removeData("ui-tooltip-open");
      i = o.tooltip, o.closing || (clearInterval(this.delayedShow), n.data("ui-tooltip-title") && !n.attr("title") && n.attr("title", n.data("ui-tooltip-title")), this._removeDescribedBy(n), o.hiding = !0, i.stop(!0), this._hide(i, this.options.hide, function() {
        s._removeTooltip(t(this))
      }), n.removeData("ui-tooltip-open"), this._off(n, "mouseleave focusout keyup"), n[0] !== this.element[0] && this._off(n, "remove"), this._off(this.document, "mousemove"), e && "mouseleave" === e.type && t.each(this.parents, function(e, i) {
        t(i.element).attr("title", i.title), delete s.parents[e]
      }), o.closing = !0, this._trigger("close", e, {
        tooltip: i
      }), o.hiding || (o.closing = !1))
    },
    _tooltip: function(e) {
      var i = t("<div>").attr("role", "tooltip"),
        s = t("<div>").appendTo(i),
        n = i.uniqueId().attr("id");
      return this._addClass(s, "ui-tooltip-content"), this._addClass(i, "ui-tooltip", "ui-widget ui-widget-content"), i.appendTo(this._appendTo(e)), this.tooltips[n] = {
        element: e,
        tooltip: i
      }
    },
    _find: function(t) {
      var e = t.data("ui-tooltip-id");
      return e ? this.tooltips[e] : null
    },
    _removeTooltip: function(t) {
      t.remove(), delete this.tooltips[t.attr("id")]
    },
    _appendTo: function(t) {
      var e = t.closest(".ui-front, dialog");
      return e.length || (e = this.document[0].body), e
    },
    _destroy: function() {
      var e = this;
      t.each(this.tooltips, function(i, s) {
        var n = t.Event("blur"),
          o = s.element;
        n.target = n.currentTarget = o[0], e.close(n, !0), t("#" + i).remove(), o.data("ui-tooltip-title") && (o.attr("title") || o.attr("title", o.data("ui-tooltip-title")), o.removeData("ui-tooltip-title"))
      }), this.liveRegion.remove()
    }
  }), !1 !== t.uiBackCompat && t.widget("ui.tooltip", t.ui.tooltip, {
    options: {
      tooltipClass: null
    },
    _tooltip: function() {
      var t = this._superApply(arguments);
      return this.options.tooltipClass && t.tooltip.addClass(this.options.tooltipClass), t
    }
  });
  t.ui.tooltip
}),
function(t) {
  "object" == typeof module && "object" == typeof module.exports ? t(require("jquery"), window, document) : t(jQuery, window, document)
}(function(t, e, i, s) {
  var n = [],
    o = function() {
      return n.length ? n[n.length - 1] : null
    },
    r = function() {
      var t, e = !1;
      for (t = n.length - 1; t >= 0; t--) n[t].$blocker && (n[t].$blocker.toggleClass("current", !e).toggleClass("behind", e), e = !0)
    };
  t.modal = function(e, i) {
    var s, r;
    if (this.$body = t("body"), this.options = t.extend({}, t.modal.defaults, i), this.options.doFade = !isNaN(parseInt(this.options.fadeDuration, 10)), this.$blocker = null, this.options.closeExisting)
      for (; t.modal.isActive();) t.modal.close();
    if (n.push(this), e.is("a"))
      if (r = e.attr("href"), /^#/.test(r)) {
        if (this.$elm = t(r), 1 !== this.$elm.length) return null;
        this.$body.append(this.$elm), this.open()
      } else this.$elm = t("<div>"), this.$body.append(this.$elm), s = function(t, e) {
        e.elm.remove()
      }, this.showSpinner(), e.trigger(t.modal.AJAX_SEND), t.get(r).done(function(i) {
        if (t.modal.isActive()) {
          e.trigger(t.modal.AJAX_SUCCESS);
          var n = o();
          n.$elm.empty().append(i).on(t.modal.CLOSE, s), n.hideSpinner(), n.open(), e.trigger(t.modal.AJAX_COMPLETE)
        }
      }).fail(function() {
        e.trigger(t.modal.AJAX_FAIL), o().hideSpinner(), n.pop(), e.trigger(t.modal.AJAX_COMPLETE)
      });
    else this.$elm = e, this.$body.append(this.$elm), this.open()
  }, t.modal.prototype = {
    constructor: t.modal,
    open: function() {
      var e = this;
      this.block(), this.options.doFade ? setTimeout(function() {
        e.show()
      }, this.options.fadeDuration * this.options.fadeDelay) : this.show(), t(i).off("keydown.modal").on("keydown.modal", function(t) {
        var e = o();
        27 == t.which && e.options.escapeClose && e.close()
      }), this.options.clickClose && this.$blocker.click(function(e) {
        e.target == this && t.modal.close()
      })
    },
    close: function() {
      n.pop(), this.unblock(), this.hide(), t.modal.isActive() || t(i).off("keydown.modal")
    },
    block: function() {
      this.$elm.trigger(t.modal.BEFORE_BLOCK, [this._ctx()]), this.$body.css("overflow", "hidden"), this.$blocker = t('<div class="jquery-modal blocker current"></div>').appendTo(this.$body), r(), this.options.doFade && this.$blocker.css("opacity", 0).animate({
        opacity: 1
      }, this.options.fadeDuration), this.$elm.trigger(t.modal.BLOCK, [this._ctx()])
    },
    unblock: function(e) {
      !e && this.options.doFade ? this.$blocker.fadeOut(this.options.fadeDuration, this.unblock.bind(this, !0)) : (this.$blocker.children().appendTo(this.$body), this.$blocker.remove(), this.$blocker = null, r(), t.modal.isActive() || this.$body.css("overflow", ""))
    },
    show: function() {
      this.$elm.trigger(t.modal.BEFORE_OPEN, [this._ctx()]), this.options.showClose && (this.closeButton = t('<a href="#close-modal" rel="modal:close" class="close-modal ' + this.options.closeClass + '">' + this.options.closeText + "</a>"), this.$elm.append(this.closeButton)), this.$elm.addClass(this.options.modalClass).appendTo(this.$blocker), this.options.doFade ? this.$elm.css("opacity", 0).show().animate({
        opacity: 1
      }, this.options.fadeDuration) : this.$elm.show(), this.$elm.trigger(t.modal.OPEN, [this._ctx()])
    },
    hide: function() {
      this.$elm.trigger(t.modal.BEFORE_CLOSE, [this._ctx()]), this.closeButton && this.closeButton.remove();
      var e = this;
      this.options.doFade ? this.$elm.fadeOut(this.options.fadeDuration, function() {
        e.$elm.trigger(t.modal.AFTER_CLOSE, [e._ctx()])
      }) : this.$elm.hide(0, function() {
        e.$elm.trigger(t.modal.AFTER_CLOSE, [e._ctx()])
      }), this.$elm.trigger(t.modal.CLOSE, [this._ctx()])
    },
    showSpinner: function() {
      this.options.showSpinner && (this.spinner = this.spinner || t('<div class="' + this.options.modalClass + '-spinner"></div>').append(this.options.spinnerHtml), this.$body.append(this.spinner), this.spinner.show())
    },
    hideSpinner: function() {
      this.spinner && this.spinner.remove()
    },
    _ctx: function() {
      return {
        elm: this.$elm,
        $blocker: this.$blocker,
        options: this.options
      }
    }
  }, t.modal.close = function(e) {
    if (t.modal.isActive()) {
      e && e.preventDefault();
      var i = o();
      return i.close(), i.$elm
    }
  }, t.modal.isActive = function() {
    return n.length > 0
  }, t.modal.getCurrent = o, t.modal.defaults = {
    closeExisting: !0,
    escapeClose: !0,
    clickClose: !0,
    closeText: "Close",
    closeClass: "",
    modalClass: "modal",
    spinnerHtml: null,
    showSpinner: !0,
    showClose: !0,
    fadeDuration: null,
    fadeDelay: 1
  }, t.modal.BEFORE_BLOCK = "modal:before-block", t.modal.BLOCK = "modal:block", t.modal.BEFORE_OPEN = "modal:before-open", t.modal.OPEN = "modal:open", t.modal.BEFORE_CLOSE = "modal:before-close", t.modal.CLOSE = "modal:close", t.modal.AFTER_CLOSE = "modal:after-close", t.modal.AJAX_SEND = "modal:ajax:send", t.modal.AJAX_SUCCESS = "modal:ajax:success", t.modal.AJAX_FAIL = "modal:ajax:fail", t.modal.AJAX_COMPLETE = "modal:ajax:complete", t.fn.modal = function(e) {
    return 1 === this.length && new t.modal(this, e), this
  }, t(i).on("click.modal", 'a[rel~="modal:close"]', t.modal.close), t(i).on("click.modal", 'a[rel~="modal:open"]', function(e) {
    e.preventDefault(), t(this).modal()
  })
}), $(document).ready(function() {
    $("input.styler, select.styler").styler({
      selectSearch: !0
    })
  }),
  function(t) {
    "function" == typeof define && define.amd ? define(["jquery"], t) : "object" == typeof exports ? module.exports = t($ || require("jquery")) : t(jQuery)
  }(function(t) {
    "use strict";

    function e(e, i) {
      this.element = e, this.options = t.extend({}, n, i);
      var s = this.options.locale;
      void 0 !== this.options.locales[s] && t.extend(this.options, this.options.locales[s]), this.init()
    }

    function i(e) {
      if (!t(e.target).parents().hasClass("jq-selectbox") && "OPTION" != e.target.nodeName && t("div.jq-selectbox.opened").length) {
        var i = t("div.jq-selectbox.opened"),
          n = t("div.jq-selectbox__search input", i),
          o = t("div.jq-selectbox__dropdown", i);
        i.find("select").data("_" + s).options.onSelectClosed.call(i), n.length && n.val("").keyup(), o.hide().find("li.sel").addClass("selected"), i.removeClass("focused opened dropup dropdown")
      }
    }
    var s = "styler",
      n = {
        idSuffix: "-styler",
        filePlaceholder: "Файл не выбран",
        fileBrowse: "Обзор...",
        fileNumber: "Выбрано файлов: %s",
        selectPlaceholder: "Выберите...",
        selectSearch: !1,
        selectSearchLimit: 10,
        selectSearchNotFound: "Совпадений не найдено",
        selectSearchPlaceholder: "Поиск...",
        selectVisibleOptions: 0,
        singleSelectzIndex: "100",
        selectSmartPositioning: !0,
        locale: "ru",
        locales: {
          en: {
            filePlaceholder: "No file selected",
            fileBrowse: "Browse...",
            fileNumber: "Selected files: %s",
            selectPlaceholder: "Select...",
            selectSearchNotFound: "No matches found",
            selectSearchPlaceholder: "Search..."
          }
        },
        onSelectOpened: function() {},
        onSelectClosed: function() {},
        onFormStyled: function() {}
      };
    e.prototype = {
      init: function() {
        function e() {
          void 0 !== s.attr("id") && "" !== s.attr("id") && (this.id = s.attr("id") + n.idSuffix), this.title = s.attr("title"), this.classes = s.attr("class"), this.data = s.data()
        }
        var s = t(this.element),
          n = this.options,
          o = !(!navigator.userAgent.match(/(iPad|iPhone|iPod)/i) || navigator.userAgent.match(/(Windows\sPhone)/i)),
          r = !(!navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/(Windows\sPhone)/i));
        if (s.is(":checkbox")) {
          var a = function() {
            var i = new e,
              n = t('<div class="jq-checkbox"><div class="jq-checkbox__div"></div></div>').attr({
                id: i.id,
                title: i.title
              }).addClass(i.classes).data(i.data);
            s.css({
              position: "absolute",
              zIndex: "-1",
              opacity: 0,
              margin: 0,
              padding: 0
            }).after(n).prependTo(n), n.attr("unselectable", "on").css({
              "-webkit-user-select": "none",
              "-moz-user-select": "none",
              "-ms-user-select": "none",
              "-o-user-select": "none",
              "user-select": "none",
              display: "inline-block",
              position: "relative",
              overflow: "hidden"
            }), s.is(":checked") && n.addClass("checked"), s.is(":disabled") && n.addClass("disabled"), n.click(function(t) {
              t.preventDefault(), n.is(".disabled") || (s.is(":checked") ? (s.prop("checked", !1), n.removeClass("checked")) : (s.prop("checked", !0), n.addClass("checked")), s.focus().change())
            }), s.closest("label").add('label[for="' + s.attr("id") + '"]').on("click.styler", function(e) {
              t(e.target).is("a") || t(e.target).closest(n).length || (n.triggerHandler("click"), e.preventDefault())
            }), s.on("change.styler", function() {
              s.is(":checked") ? n.addClass("checked") : n.removeClass("checked")
            }).on("keydown.styler", function(t) {
              32 == t.which && n.click()
            }).on("focus.styler", function() {
              n.is(".disabled") || n.addClass("focused")
            }).on("blur.styler", function() {
              n.removeClass("focused")
            })
          };
          a(), s.on("refresh", function() {
            s.closest("label").add('label[for="' + s.attr("id") + '"]').off(".styler"), s.off(".styler").parent().before(s).remove(), a()
          })
        } else if (s.is(":radio")) {
          var l = function() {
            var i = new e,
              n = t('<div class="jq-radio"><div class="jq-radio__div"></div></div>').attr({
                id: i.id,
                title: i.title
              }).addClass(i.classes).data(i.data);
            s.css({
              position: "absolute",
              zIndex: "-1",
              opacity: 0,
              margin: 0,
              padding: 0
            }).after(n).prependTo(n), n.attr("unselectable", "on").css({
              "-webkit-user-select": "none",
              "-moz-user-select": "none",
              "-ms-user-select": "none",
              "-o-user-select": "none",
              "user-select": "none",
              display: "inline-block",
              position: "relative"
            }), s.is(":checked") && n.addClass("checked"), s.is(":disabled") && n.addClass("disabled"), t.fn.commonParents = function() {
              var e = this;
              return e.first().parents().filter(function() {
                return t(this).find(e).length === e.length
              })
            }, t.fn.commonParent = function() {
              return t(this).commonParents().first()
            }, n.click(function(e) {
              if (e.preventDefault(), !n.is(".disabled")) {
                var i = t('input[name="' + s.attr("name") + '"]');
                i.commonParent().find(i).prop("checked", !1).parent().removeClass("checked"), s.prop("checked", !0).parent().addClass("checked"), s.focus().change()
              }
            }), s.closest("label").add('label[for="' + s.attr("id") + '"]').on("click.styler", function(e) {
              t(e.target).is("a") || t(e.target).closest(n).length || (n.triggerHandler("click"), e.preventDefault())
            }), s.on("change.styler", function() {
              s.parent().addClass("checked")
            }).on("focus.styler", function() {
              n.is(".disabled") || n.addClass("focused")
            }).on("blur.styler", function() {
              n.removeClass("focused")
            })
          };
          l(), s.on("refresh", function() {
            s.closest("label").add('label[for="' + s.attr("id") + '"]').off(".styler"), s.off(".styler").parent().before(s).remove(), l()
          })
        } else if (s.is(":file")) {
          s.css({
            position: "absolute",
            top: 0,
            right: 0,
            margin: 0,
            padding: 0,
            opacity: 0,
            fontSize: "100px"
          });
          var h = function() {
            var i = new e,
              o = s.data("placeholder");
            void 0 === o && (o = n.filePlaceholder);
            var r = s.data("browse");
            void 0 !== r && "" !== r || (r = n.fileBrowse);
            var a = t('<div class="jq-file"><div class="jq-file__name">' + o + '</div><div class="jq-file__browse">' + r + "</div></div>").css({
              display: "inline-block",
              position: "relative",
              overflow: "hidden"
            }).attr({
              id: i.id,
              title: i.title
            }).addClass(i.classes).data(i.data);
            s.after(a).appendTo(a), s.is(":disabled") && a.addClass("disabled"), s.on("change.styler", function() {
              var e = s.val(),
                i = t("div.jq-file__name", a);
              if (s.is("[multiple]")) {
                e = "";
                var r = s[0].files.length;
                if (r > 0) {
                  var l = s.data("number");
                  void 0 === l && (l = n.fileNumber), l = l.replace("%s", r), e = l
                }
              }
              i.text(e.replace(/.+[\\\/]/, "")), "" === e ? (i.text(o), a.removeClass("changed")) : a.addClass("changed")
            }).on("focus.styler", function() {
              a.addClass("focused")
            }).on("blur.styler", function() {
              a.removeClass("focused")
            }).on("click.styler", function() {
              a.removeClass("focused")
            })
          };
          h(), s.on("refresh", function() {
            s.off(".styler").parent().before(s).remove(), h()
          })
        } else if (s.is('input[type="number"]')) {
          var c = function() {
            var i = new e,
              n = t('<div class="jq-number"><div class="jq-number__spin minus"></div><div class="jq-number__spin plus"></div></div>').attr({
                id: i.id,
                title: i.title
              }).addClass(i.classes).data(i.data);
            s.after(n).prependTo(n).wrap('<div class="jq-number__field"></div>'), s.is(":disabled") && n.addClass("disabled");
            var o, r, a, l = null,
              h = null;
            void 0 !== s.attr("min") && (o = s.attr("min")), void 0 !== s.attr("max") && (r = s.attr("max")), a = void 0 !== s.attr("step") && t.isNumeric(s.attr("step")) ? Number(s.attr("step")) : Number(1);
            var c = function(e) {
              var i, n = s.val();
              t.isNumeric(n) || (n = 0, s.val("0")), e.is(".minus") ? i = Number(n) - a : e.is(".plus") && (i = Number(n) + a);
              var l = (a.toString().split(".")[1] || []).length;
              if (l > 0) {
                for (var h = "1"; h.length <= l;) h += "0";
                i = Math.round(i * h) / h
              }
              t.isNumeric(o) && t.isNumeric(r) ? i >= o && i <= r && s.val(i) : t.isNumeric(o) && !t.isNumeric(r) ? i >= o && s.val(i) : !t.isNumeric(o) && t.isNumeric(r) ? i <= r && s.val(i) : s.val(i)
            };
            n.is(".disabled") || (n.on("mousedown", "div.jq-number__spin", function() {
              var e = t(this);
              c(e), l = setTimeout(function() {
                h = setInterval(function() {
                  c(e)
                }, 40)
              }, 350)
            }).on("mouseup mouseout", "div.jq-number__spin", function() {
              clearTimeout(l), clearInterval(h)
            }).on("mouseup", "div.jq-number__spin", function() {
              s.change()
            }), s.on("focus.styler", function() {
              n.addClass("focused")
            }).on("blur.styler", function() {
              n.removeClass("focused")
            }))
          };
          c(), s.on("refresh", function() {
            s.off(".styler").closest(".jq-number").before(s).remove(), c()
          })
        } else if (s.is("select")) {
          var u = function() {
            function a(e) {
              e.off("mousewheel DOMMouseScroll").on("mousewheel DOMMouseScroll", function(e) {
                var i = null;
                "mousewheel" == e.type ? i = -1 * e.originalEvent.wheelDelta : "DOMMouseScroll" == e.type && (i = 40 * e.originalEvent.detail), i && (e.stopPropagation(),
                  e.preventDefault(), t(this).scrollTop(i + t(this).scrollTop()))
              })
            }

            function l() {
              for (var t = 0; t < h.length; t++) {
                var e = h.eq(t),
                  i = "",
                  s = "",
                  o = "",
                  r = "",
                  a = "",
                  l = "",
                  u = "",
                  d = "",
                  p = "";
                e.prop("selected") && (s = "selected sel"), e.is(":disabled") && (s = "disabled"), e.is(":selected:disabled") && (s = "selected sel disabled"), void 0 !== e.attr("id") && "" !== e.attr("id") && (r = ' id="' + e.attr("id") + n.idSuffix + '"'), void 0 !== e.attr("title") && "" !== h.attr("title") && (a = ' title="' + e.attr("title") + '"'), void 0 !== e.attr("class") && (u = " " + e.attr("class"), p = ' data-jqfs-class="' + e.attr("class") + '"');
                var f = e.data();
                for (var g in f) "" !== f[g] && (l += " data-" + g + '="' + f[g] + '"');
                s + u !== "" && (o = ' class="' + s + u + '"'), i = "<li" + p + l + o + a + r + ">" + e.html() + "</li>", e.parent().is("optgroup") && (void 0 !== e.parent().attr("class") && (d = " " + e.parent().attr("class")), i = "<li" + p + l + ' class="' + s + u + " option" + d + '"' + a + r + ">" + e.html() + "</li>", e.is(":first-child") && (i = '<li class="optgroup' + d + '">' + e.parent().attr("label") + "</li>" + i)), c += i
              }
            }
            var h = t("option", s),
              c = "";
            if (s.is("[multiple]")) {
              if (r || o) return;
              ! function() {
                var i = new e,
                  n = t('<div class="jq-select-multiple jqselect"></div>').css({
                    display: "inline-block",
                    position: "relative"
                  }).attr({
                    id: i.id,
                    title: i.title
                  }).addClass(i.classes).data(i.data);
                s.css({
                  margin: 0,
                  padding: 0
                }).after(n), l(), n.append("<ul>" + c + "</ul>");
                var o = t("ul", n).css({
                    position: "relative",
                    "overflow-x": "hidden",
                    "-webkit-overflow-scrolling": "touch"
                  }),
                  r = t("li", n).attr("unselectable", "on"),
                  u = s.attr("size"),
                  d = o.outerHeight(),
                  p = r.outerHeight();
                void 0 !== u && u > 0 ? o.css({
                  height: p * u
                }) : o.css({
                  height: 4 * p
                }), d > n.height() && (o.css("overflowY", "scroll"), a(o), r.filter(".selected").length && o.scrollTop(o.scrollTop() + r.filter(".selected").position().top)), s.prependTo(n).css({
                  position: "absolute",
                  left: 0,
                  top: 0,
                  width: "100%",
                  height: "100%",
                  opacity: 0
                }), s.is(":disabled") ? (n.addClass("disabled"), h.each(function() {
                  t(this).is(":selected") && r.eq(t(this).index()).addClass("selected")
                })) : (r.filter(":not(.disabled):not(.optgroup)").click(function(e) {
                  s.focus();
                  var i = t(this);
                  if (e.ctrlKey || e.metaKey || i.addClass("selected"), e.shiftKey || i.addClass("first"), e.ctrlKey || e.metaKey || e.shiftKey || i.siblings().removeClass("selected first"), (e.ctrlKey || e.metaKey) && (i.is(".selected") ? i.removeClass("selected first") : i.addClass("selected first"), i.siblings().removeClass("first")), e.shiftKey) {
                    var n = !1,
                      o = !1;
                    i.siblings().removeClass("selected").siblings(".first").addClass("selected"), i.prevAll().each(function() {
                      t(this).is(".first") && (n = !0)
                    }), i.nextAll().each(function() {
                      t(this).is(".first") && (o = !0)
                    }), n && i.prevAll().each(function() {
                      if (t(this).is(".selected")) return !1;
                      t(this).not(".disabled, .optgroup").addClass("selected")
                    }), o && i.nextAll().each(function() {
                      if (t(this).is(".selected")) return !1;
                      t(this).not(".disabled, .optgroup").addClass("selected")
                    }), 1 == r.filter(".selected").length && i.addClass("first")
                  }
                  h.prop("selected", !1), r.filter(".selected").each(function() {
                    var e = t(this),
                      i = e.index();
                    e.is(".option") && (i -= e.prevAll(".optgroup").length), h.eq(i).prop("selected", !0)
                  }), s.change()
                }), h.each(function(e) {
                  t(this).data("optionIndex", e)
                }), s.on("change.styler", function() {
                  r.removeClass("selected");
                  var e = [];
                  h.filter(":selected").each(function() {
                    e.push(t(this).data("optionIndex"))
                  }), r.not(".optgroup").filter(function(i) {
                    return t.inArray(i, e) > -1
                  }).addClass("selected")
                }).on("focus.styler", function() {
                  n.addClass("focused")
                }).on("blur.styler", function() {
                  n.removeClass("focused")
                }), d > n.height() && s.on("keydown.styler", function(t) {
                  38 != t.which && 37 != t.which && 33 != t.which || o.scrollTop(o.scrollTop() + r.filter(".selected").position().top - p), 40 != t.which && 39 != t.which && 34 != t.which || o.scrollTop(o.scrollTop() + r.filter(".selected:last").position().top - o.innerHeight() + 2 * p)
                }))
              }()
            } else ! function() {
              var r = new e,
                u = "",
                d = s.data("placeholder"),
                p = s.data("search"),
                f = s.data("search-limit"),
                g = s.data("search-not-found"),
                m = s.data("search-placeholder"),
                v = s.data("z-index"),
                b = s.data("smart-positioning");
              void 0 === d && (d = n.selectPlaceholder), void 0 !== p && "" !== p || (p = n.selectSearch), void 0 !== f && "" !== f || (f = n.selectSearchLimit), void 0 !== g && "" !== g || (g = n.selectSearchNotFound), void 0 === m && (m = n.selectSearchPlaceholder), void 0 !== v && "" !== v || (v = n.singleSelectzIndex), void 0 !== b && "" !== b || (b = n.selectSmartPositioning);
              var _ = t('<div class="jq-selectbox jqselect"><div class="jq-selectbox__select" style="position: relative"><div class="jq-selectbox__select-text"></div><div class="jq-selectbox__trigger"><div class="jq-selectbox__trigger-arrow"></div></div></div></div>').css({
                display: "inline-block",
                position: "relative",
                zIndex: v
              }).attr({
                id: r.id,
                title: r.title
              }).addClass(r.classes).data(r.data);
              s.css({
                margin: 0,
                padding: 0
              }).after(_).prependTo(_);
              var y = t("div.jq-selectbox__select", _),
                w = t("div.jq-selectbox__select-text", _),
                x = h.filter(":selected");
              l(), p && (u = '<div class="jq-selectbox__search"><input type="search" autocomplete="off" placeholder="' + m + '"></div><div class="jq-selectbox__not-found">' + g + "</div>");
              var k = t('<div class="jq-selectbox__dropdown" style="position: absolute">' + u + '<ul style="position: relative; list-style: none; overflow: auto; overflow-x: hidden">' + c + "</ul></div>");
              _.append(k);
              var C = t("ul", k),
                T = t("li", k),
                S = t("input", k),
                D = t("div.jq-selectbox__not-found", k).hide();
              T.length < f && S.parent().hide(), "" === h.first().text() && h.first().is(":selected") && !1 !== d ? w.text(d).addClass("placeholder") : w.text(x.text());
              var P = 0,
                I = 0;
              if (T.css({
                  display: "inline-block"
                }), T.each(function() {
                  var e = t(this);
                  e.innerWidth() > P && (P = e.innerWidth(), I = e.width())
                }), T.css({
                  display: ""
                }), w.is(".placeholder") && w.width() > P) w.width(w.width());
              else {
                var A = _.clone().appendTo("body").width("auto"),
                  M = A.outerWidth();
                A.remove(), M == _.outerWidth() && w.width(I)
              }
              P > _.width() && k.width(P), "" === h.first().text() && "" !== s.data("placeholder") && T.first().hide(), s.css({
                position: "absolute",
                left: 0,
                top: 0,
                width: "100%",
                height: "100%",
                opacity: 0
              });
              var H = _.outerHeight(!0),
                E = S.parent().outerHeight(!0) || 0,
                O = C.css("max-height"),
                N = T.filter(".selected");
              if (N.length < 1 && T.first().addClass("selected sel"), void 0 === T.data("li-height")) {
                var $ = T.outerHeight();
                !1 !== d && ($ = T.eq(1).outerHeight()), T.data("li-height", $)
              }
              var z = k.css("top");
              if ("auto" == k.css("left") && k.css({
                  left: 0
                }), "auto" == k.css("top") && (k.css({
                  top: H
                }), z = H), k.hide(), N.length && (h.first().text() != x.text() && _.addClass("changed"), _.data("jqfs-class", N.data("jqfs-class")), _.addClass(N.data("jqfs-class"))), s.is(":disabled")) return _.addClass("disabled"), !1;
              y.click(function() {
                if (t("div.jq-selectbox").filter(".opened").length && n.onSelectClosed.call(t("div.jq-selectbox").filter(".opened")), s.focus(), !o) {
                  var e = t(window),
                    i = T.data("li-height"),
                    r = _.offset().top,
                    l = e.height() - H - (r - e.scrollTop()),
                    c = s.data("visible-options");
                  void 0 !== c && "" !== c || (c = n.selectVisibleOptions);
                  var u = 5 * i,
                    d = i * c;
                  c > 0 && c < 6 && (u = d), 0 === c && (d = "auto");
                  var p = function() {
                    k.height("auto").css({
                      bottom: "auto",
                      top: z
                    });
                    var t = function() {
                      C.css("max-height", Math.floor((l - 20 - E) / i) * i)
                    };
                    t(), C.css("max-height", d), "none" != O && C.css("max-height", O), l < k.outerHeight() + 20 && t()
                  };
                  !0 === b || 1 === b ? l > u + E + 20 ? (p(), _.removeClass("dropup").addClass("dropdown")) : (function() {
                    k.height("auto").css({
                      top: "auto",
                      bottom: z
                    });
                    var t = function() {
                      C.css("max-height", Math.floor((r - e.scrollTop() - 20 - E) / i) * i)
                    };
                    t(), C.css("max-height", d), "none" != O && C.css("max-height", O), r - e.scrollTop() - 20 < k.outerHeight() + 20 && t()
                  }(), _.removeClass("dropdown").addClass("dropup")) : !1 === b || 0 === b ? l > u + E + 20 && (p(), _.removeClass("dropup").addClass("dropdown")) : (k.height("auto").css({
                    bottom: "auto",
                    top: z
                  }), C.css("max-height", d), "none" != O && C.css("max-height", O)), _.offset().left + k.outerWidth() > e.width() && k.css({
                    left: "auto",
                    right: 0
                  }), t("div.jqselect").css({
                    zIndex: v - 1
                  }).removeClass("opened"), _.css({
                    zIndex: v
                  }), k.is(":hidden") ? (t("div.jq-selectbox__dropdown:visible").hide(), k.show(), _.addClass("opened focused"), n.onSelectOpened.call(_)) : (k.hide(), _.removeClass("opened dropup dropdown"), t("div.jq-selectbox").filter(".opened").length && n.onSelectClosed.call(_)), S.length && (S.val("").keyup(), D.hide(), S.keyup(function() {
                    var e = t(this).val();
                    T.each(function() {
                      t(this).html().match(new RegExp(".*?" + e + ".*?", "i")) ? t(this).show() : t(this).hide()
                    }), "" === h.first().text() && "" !== s.data("placeholder") && T.first().hide(), T.filter(":visible").length < 1 ? D.show() : D.hide()
                  })), T.filter(".selected").length && ("" === s.val() ? C.scrollTop(0) : (C.innerHeight() / i % 2 != 0 && (i /= 2), C.scrollTop(C.scrollTop() + T.filter(".selected").position().top - C.innerHeight() / 2 + i))), a(C)
                }
              }), T.hover(function() {
                t(this).siblings().removeClass("selected")
              });
              var W = T.filter(".selected").text();
              T.filter(":not(.disabled):not(.optgroup)").click(function() {
                s.focus();
                var e = t(this),
                  i = e.text();
                if (!e.is(".selected")) {
                  var o = e.index();
                  o -= e.prevAll(".optgroup").length, e.addClass("selected sel").siblings().removeClass("selected sel"), h.prop("selected", !1).eq(o).prop("selected", !0), W = i, w.text(i), _.data("jqfs-class") && _.removeClass(_.data("jqfs-class")), _.data("jqfs-class", e.data("jqfs-class")), _.addClass(e.data("jqfs-class")), s.change()
                }
                k.hide(), _.removeClass("opened dropup dropdown"), n.onSelectClosed.call(_)
              }), k.mouseout(function() {
                t("li.sel", k).addClass("selected")
              }), s.on("change.styler", function() {
                w.text(h.filter(":selected").text()).removeClass("placeholder"), T.removeClass("selected sel").not(".optgroup").eq(s[0].selectedIndex).addClass("selected sel"), h.first().text() != T.filter(".selected").text() ? _.addClass("changed") : _.removeClass("changed")
              }).on("focus.styler", function() {
                _.addClass("focused"), t("div.jqselect").not(".focused").removeClass("opened dropup dropdown").find("div.jq-selectbox__dropdown").hide()
              }).on("blur.styler", function() {
                _.removeClass("focused")
              }).on("keydown.styler keyup.styler", function(t) {
                var e = T.data("li-height");
                "" === s.val() ? w.text(d).addClass("placeholder") : w.text(h.filter(":selected").text()), T.removeClass("selected sel").not(".optgroup").eq(s[0].selectedIndex).addClass("selected sel"), 38 != t.which && 37 != t.which && 33 != t.which && 36 != t.which || ("" === s.val() ? C.scrollTop(0) : C.scrollTop(C.scrollTop() + T.filter(".selected").position().top)), 40 != t.which && 39 != t.which && 34 != t.which && 35 != t.which || C.scrollTop(C.scrollTop() + T.filter(".selected").position().top - C.innerHeight() + e), 13 == t.which && (t.preventDefault(), k.hide(), _.removeClass("opened dropup dropdown"), n.onSelectClosed.call(_))
              }).on("keydown.styler", function(t) {
                32 == t.which && (t.preventDefault(), y.click())
              }), i.registered || (t(document).on("click", i), i.registered = !0)
            }()
          };
          u(), s.on("refresh", function() {
            s.off(".styler").parent().before(s).remove(), u()
          })
        } else s.is(":reset") && s.on("click", function() {
          setTimeout(function() {
            s.closest("form").find("input, select").trigger("refresh")
          }, 1)
        })
      },
      destroy: function() {
        var e = t(this.element);
        e.is(":checkbox") || e.is(":radio") ? (e.removeData("_" + s).off(".styler refresh").removeAttr("style").parent().before(e).remove(), e.closest("label").add('label[for="' + e.attr("id") + '"]').off(".styler")) : e.is('input[type="number"]') ? e.removeData("_" + s).off(".styler refresh").closest(".jq-number").before(e).remove() : (e.is(":file") || e.is("select")) && e.removeData("_" + s).off(".styler refresh").removeAttr("style").parent().before(e).remove()
      }
    }, t.fn[s] = function(i) {
      var n = arguments;
      if (void 0 === i || "object" == typeof i) return this.each(function() {
        t.data(this, "_" + s) || t.data(this, "_" + s, new e(this, i))
      }).promise().done(function() {
        var e = t(this[0]).data("_" + s);
        e && e.options.onFormStyled.call()
      }), this;
      if ("string" == typeof i && "_" !== i[0] && "init" !== i) {
        var o;
        return this.each(function() {
          var r = t.data(this, "_" + s);
          r instanceof e && "function" == typeof r[i] && (o = r[i].apply(r, Array.prototype.slice.call(n, 1)))
        }), void 0 !== o ? o : this
      }
    }, i.registered = !1
  }),
  function(t, e, i, s) {
    function n(e, i) {
      var o = this;
      "object" == typeof i && (delete i.refresh, delete i.render, t.extend(this, i)), this.$element = t(e), !this.imageSrc && this.$element.is("img") && (this.imageSrc = this.$element.attr("src"));
      var r = (this.position + "").toLowerCase().match(/\S+/g) || [];
      if (r.length < 1 && r.push("center"), 1 == r.length && r.push(r[0]), "top" != r[0] && "bottom" != r[0] && "left" != r[1] && "right" != r[1] || (r = [r[1], r[0]]), this.positionX != s && (r[0] = this.positionX.toLowerCase()), this.positionY != s && (r[1] = this.positionY.toLowerCase()), o.positionX = r[0], o.positionY = r[1], "left" != this.positionX && "right" != this.positionX && (isNaN(parseInt(this.positionX)) ? this.positionX = "center" : this.positionX = parseInt(this.positionX)), "top" != this.positionY && "bottom" != this.positionY && (isNaN(parseInt(this.positionY)) ? this.positionY = "center" : this.positionY = parseInt(this.positionY)), this.position = this.positionX + (isNaN(this.positionX) ? "" : "px") + " " + this.positionY + (isNaN(this.positionY) ? "" : "px"), navigator.userAgent.match(/(iPod|iPhone|iPad)/)) return this.imageSrc && this.iosFix && !this.$element.is("img") && this.$element.css({
        backgroundImage: "url(" + this.imageSrc + ")",
        backgroundSize: "cover",
        backgroundPosition: this.position
      }), this;
      if (navigator.userAgent.match(/(Android)/)) return this.imageSrc && this.androidFix && !this.$element.is("img") && this.$element.css({
        backgroundImage: "url(" + this.imageSrc + ")",
        backgroundSize: "cover",
        backgroundPosition: this.position
      }), this;
      this.$mirror = t("<div />").prependTo("body");
      var a = this.$element.find(">.parallax-slider"),
        l = !1;
      0 == a.length ? this.$slider = t("<img />").prependTo(this.$mirror) : (this.$slider = a.prependTo(this.$mirror), l = !0), this.$mirror.addClass("parallax-mirror").css({
        visibility: "hidden",
        zIndex: this.zIndex,
        position: "fixed",
        top: 0,
        left: 0,
        overflow: "hidden"
      }), this.$slider.addClass("parallax-slider").one("load", function() {
        o.naturalHeight && o.naturalWidth || (o.naturalHeight = this.naturalHeight || this.height || 1, o.naturalWidth = this.naturalWidth || this.width || 1), o.aspectRatio = o.naturalWidth / o.naturalHeight, n.isSetup || n.setup(), n.sliders.push(o), n.isFresh = !1, n.requestRender()
      }), l || (this.$slider[0].src = this.imageSrc), (this.naturalHeight && this.naturalWidth || this.$slider[0].complete || a.length > 0) && this.$slider.trigger("load")
    }

    function o(s) {
      return this.each(function() {
        var o = t(this),
          r = "object" == typeof s && s;
        this == e || this == i || o.is("body") ? n.configure(r) : o.data("px.parallax") ? "object" == typeof s && t.extend(o.data("px.parallax"), r) : (r = t.extend({}, o.data(), r), o.data("px.parallax", new n(this, r))), "string" == typeof s && ("destroy" == s ? n.destroy(this) : n[s]())
      })
    }! function() {
      for (var t = 0, i = ["ms", "moz", "webkit", "o"], s = 0; s < i.length && !e.requestAnimationFrame; ++s) e.requestAnimationFrame = e[i[s] + "RequestAnimationFrame"], e.cancelAnimationFrame = e[i[s] + "CancelAnimationFrame"] || e[i[s] + "CancelRequestAnimationFrame"];
      e.requestAnimationFrame || (e.requestAnimationFrame = function(i) {
        var s = (new Date).getTime(),
          n = Math.max(0, 16 - (s - t)),
          o = e.setTimeout(function() {
            i(s + n)
          }, n);
        return t = s + n, o
      }), e.cancelAnimationFrame || (e.cancelAnimationFrame = function(t) {
        clearTimeout(t)
      })
    }(), t.extend(n.prototype, {
      speed: .2,
      bleed: 0,
      zIndex: -100,
      iosFix: !0,
      androidFix: !0,
      position: "center",
      overScrollFix: !1,
      refresh: function() {
        this.boxWidth = this.$element.outerWidth(), this.boxHeight = this.$element.outerHeight() + 2 * this.bleed, this.boxOffsetTop = this.$element.offset().top - this.bleed, this.boxOffsetLeft = this.$element.offset().left, this.boxOffsetBottom = this.boxOffsetTop + this.boxHeight;
        var t = n.winHeight,
          e = n.docHeight,
          i = Math.min(this.boxOffsetTop, e - t),
          s = Math.max(this.boxOffsetTop + this.boxHeight - t, 0),
          o = this.boxHeight + (i - s) * (1 - this.speed) | 0,
          r = (this.boxOffsetTop - i) * (1 - this.speed) | 0;
        if (o * this.aspectRatio >= this.boxWidth) {
          this.imageWidth = o * this.aspectRatio | 0, this.imageHeight = o, this.offsetBaseTop = r;
          var a = this.imageWidth - this.boxWidth;
          "left" == this.positionX ? this.offsetLeft = 0 : "right" == this.positionX ? this.offsetLeft = -a : isNaN(this.positionX) ? this.offsetLeft = -a / 2 | 0 : this.offsetLeft = Math.max(this.positionX, -a)
        } else {
          this.imageWidth = this.boxWidth, this.imageHeight = this.boxWidth / this.aspectRatio | 0, this.offsetLeft = 0;
          var a = this.imageHeight - o;
          "top" == this.positionY ? this.offsetBaseTop = r : "bottom" == this.positionY ? this.offsetBaseTop = r - a : isNaN(this.positionY) ? this.offsetBaseTop = r - a / 2 | 0 : this.offsetBaseTop = r + Math.max(this.positionY, -a)
        }
      },
      render: function() {
        var t = n.scrollTop,
          e = n.scrollLeft,
          i = this.overScrollFix ? n.overScroll : 0,
          s = t + n.winHeight;
        this.boxOffsetBottom > t && this.boxOffsetTop <= s ? (this.visibility = "visible", this.mirrorTop = this.boxOffsetTop - t, this.mirrorLeft = this.boxOffsetLeft - e, this.offsetTop = this.offsetBaseTop - this.mirrorTop * (1 - this.speed)) : this.visibility = "hidden", this.$mirror.css({
          transform: "translate3d(0px, 0px, 0px)",
          visibility: this.visibility,
          top: this.mirrorTop - i,
          left: this.mirrorLeft,
          height: this.boxHeight,
          width: this.boxWidth
        }), this.$slider.css({
          transform: "translate3d(0px, 0px, 0px)",
          position: "absolute",
          top: this.offsetTop,
          left: this.offsetLeft,
          height: this.imageHeight,
          width: this.imageWidth,
          maxWidth: "none"
        })
      }
    }), t.extend(n, {
      scrollTop: 0,
      scrollLeft: 0,
      winHeight: 0,
      winWidth: 0,
      docHeight: 1 << 30,
      docWidth: 1 << 30,
      sliders: [],
      isReady: !1,
      isFresh: !1,
      isBusy: !1,
      setup: function() {
        if (!this.isReady) {
          var s = t(i),
            o = t(e),
            r = function() {
              n.winHeight = o.height(), n.winWidth = o.width(), n.docHeight = s.height(), n.docWidth = s.width()
            },
            a = function() {
              var t = o.scrollTop(),
                e = n.docHeight - n.winHeight,
                i = n.docWidth - n.winWidth;
              n.scrollTop = Math.max(0, Math.min(e, t)), n.scrollLeft = Math.max(0, Math.min(i, o.scrollLeft())), n.overScroll = Math.max(t - e, Math.min(t, 0))
            };
          o.on("resize.px.parallax load.px.parallax", function() {
            r(), n.isFresh = !1, n.requestRender()
          }).on("scroll.px.parallax load.px.parallax", function() {
            a(), n.requestRender()
          }), r(), a(), this.isReady = !0
        }
      },
      configure: function(e) {
        "object" == typeof e && (delete e.refresh, delete e.render, t.extend(this.prototype, e))
      },
      refresh: function() {
        t.each(this.sliders, function() {
          this.refresh()
        }), this.isFresh = !0
      },
      render: function() {
        this.isFresh || this.refresh(), t.each(this.sliders, function() {
          this.render()
        })
      },
      requestRender: function() {
        var t = this;
        this.isBusy || (this.isBusy = !0, e.requestAnimationFrame(function() {
          t.render(), t.isBusy = !1
        }))
      },
      destroy: function(i) {
        var s, o = t(i).data("px.parallax");
        for (o.$mirror.remove(), s = 0; s < this.sliders.length; s += 1) this.sliders[s] == o && this.sliders.splice(s, 1);
        t(i).data("px.parallax", !1), 0 === this.sliders.length && (t(e).off("scroll.px.parallax resize.px.parallax load.px.parallax"), this.isReady = !1, n.isSetup = !1)
      }
    });
    var r = t.fn.parallax;
    t.fn.parallax = o, t.fn.parallax.Constructor = n, t.fn.parallax.noConflict = function() {
      return t.fn.parallax = r, this
    }, t(function() {
      t('[data-parallax="scroll"]').parallax()
    })
  }(jQuery, window, document),
  function(t) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], t) : "undefined" != typeof exports ? module.exports = t(require("jquery")) : t(jQuery)
  }(function(t) {
    "use strict";
    var e = window.Slick || {};
    e = function() {
      function e(e, s) {
        var n, o = this;
        o.defaults = {
          accessibility: !0,
          adaptiveHeight: !1,
          appendArrows: t(e),
          appendDots: t(e),
          arrows: !0,
          asNavFor: null,
          prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button">Previous</button>',
          nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button">Next</button>',
          autoplay: !1,
          autoplaySpeed: 3e3,
          centerMode: !1,
          centerPadding: "50px",
          cssEase: "ease",
          customPaging: function(t, e) {
            return '<button type="button" data-role="none" role="button" aria-required="false" tabindex="0">' + (e + 1) + "</button>"
          },
          dots: !1,
          dotsClass: "slick-dots",
          draggable: !0,
          easing: "linear",
          edgeFriction: .35,
          fade: !1,
          focusOnSelect: !1,
          infinite: !0,
          initialSlide: 0,
          lazyLoad: "ondemand",
          mobileFirst: !1,
          pauseOnHover: !0,
          pauseOnDotsHover: !1,
          respondTo: "window",
          responsive: null,
          rows: 1,
          rtl: !1,
          slide: "",
          slidesPerRow: 1,
          slidesToShow: 1,
          slidesToScroll: 1,
          speed: 500,
          swipe: !0,
          swipeToSlide: !1,
          touchMove: !0,
          touchThreshold: 5,
          useCSS: !0,
          useTransform: !1,
          variableWidth: !1,
          vertical: !1,
          verticalSwiping: !1,
          waitForAnimate: !0,
          zIndex: 1e3
        }, o.initials = {
          animating: !1,
          dragging: !1,
          autoPlayTimer: null,
          currentDirection: 0,
          currentLeft: null,
          currentSlide: 0,
          direction: 1,
          $dots: null,
          listWidth: null,
          listHeight: null,
          loadIndex: 0,
          $nextArrow: null,
          $prevArrow: null,
          slideCount: null,
          slideWidth: null,
          $slideTrack: null,
          $slides: null,
          sliding: !1,
          slideOffset: 0,
          swipeLeft: null,
          $list: null,
          touchObject: {},
          transformsEnabled: !1,
          unslicked: !1
        }, t.extend(o, o.initials), o.activeBreakpoint = null, o.animType = null, o.animProp = null, o.breakpoints = [], o.breakpointSettings = [], o.cssTransitions = !1, o.hidden = "hidden", o.paused = !1, o.positionProp = null, o.respondTo = null, o.rowCount = 1, o.shouldClick = !0, o.$slider = t(e), o.$slidesCache = null, o.transformType = null, o.transitionType = null, o.visibilityChange = "visibilitychange", o.windowWidth = 0, o.windowTimer = null, n = t(e).data("slick") || {}, o.options = t.extend({}, o.defaults, n, s), o.currentSlide = o.options.initialSlide, o.originalSettings = o.options, void 0 !== document.mozHidden ? (o.hidden = "mozHidden", o.visibilityChange = "mozvisibilitychange") : void 0 !== document.webkitHidden && (o.hidden = "webkitHidden", o.visibilityChange = "webkitvisibilitychange"), o.autoPlay = t.proxy(o.autoPlay, o), o.autoPlayClear = t.proxy(o.autoPlayClear, o), o.changeSlide = t.proxy(o.changeSlide, o), o.clickHandler = t.proxy(o.clickHandler, o), o.selectHandler = t.proxy(o.selectHandler, o), o.setPosition = t.proxy(o.setPosition, o), o.swipeHandler = t.proxy(o.swipeHandler, o), o.dragHandler = t.proxy(o.dragHandler, o), o.keyHandler = t.proxy(o.keyHandler, o), o.autoPlayIterator = t.proxy(o.autoPlayIterator, o), o.instanceUid = i++, o.htmlExpr = /^(?:\s*(<[\w\W]+>)[^>]*)$/, o.registerBreakpoints(), o.init(!0), o.checkResponsive(!0)
      }
      var i = 0;
      return e
    }(), e.prototype.addSlide = e.prototype.slickAdd = function(e, i, s) {
      var n = this;
      if ("boolean" == typeof i) s = i, i = null;
      else if (0 > i || i >= n.slideCount) return !1;
      n.unload(), "number" == typeof i ? 0 === i && 0 === n.$slides.length ? t(e).appendTo(n.$slideTrack) : s ? t(e).insertBefore(n.$slides.eq(i)) : t(e).insertAfter(n.$slides.eq(i)) : !0 === s ? t(e).prependTo(n.$slideTrack) : t(e).appendTo(n.$slideTrack), n.$slides = n.$slideTrack.children(this.options.slide), n.$slideTrack.children(this.options.slide).detach(), n.$slideTrack.append(n.$slides), n.$slides.each(function(e, i) {
        t(i).attr("data-slick-index", e)
      }), n.$slidesCache = n.$slides, n.reinit()
    }, e.prototype.animateHeight = function() {
      var t = this;
      if (1 === t.options.slidesToShow && !0 === t.options.adaptiveHeight && !1 === t.options.vertical) {
        var e = t.$slides.eq(t.currentSlide).outerHeight(!0);
        t.$list.animate({
          height: e
        }, t.options.speed)
      }
    }, e.prototype.animateSlide = function(e, i) {
      var s = {},
        n = this;
      n.animateHeight(), !0 === n.options.rtl && !1 === n.options.vertical && (e = -e), !1 === n.transformsEnabled ? !1 === n.options.vertical ? n.$slideTrack.animate({
        left: e
      }, n.options.speed, n.options.easing, i) : n.$slideTrack.animate({
        top: e
      }, n.options.speed, n.options.easing, i) : !1 === n.cssTransitions ? (!0 === n.options.rtl && (n.currentLeft = -n.currentLeft), t({
        animStart: n.currentLeft
      }).animate({
        animStart: e
      }, {
        duration: n.options.speed,
        easing: n.options.easing,
        step: function(t) {
          t = Math.ceil(t), !1 === n.options.vertical ? (s[n.animType] = "translate(" + t + "px, 0px)", n.$slideTrack.css(s)) : (s[n.animType] = "translate(0px," + t + "px)", n.$slideTrack.css(s))
        },
        complete: function() {
          i && i.call()
        }
      })) : (n.applyTransition(), e = Math.ceil(e), !1 === n.options.vertical ? s[n.animType] = "translate3d(" + e + "px, 0px, 0px)" : s[n.animType] = "translate3d(0px," + e + "px, 0px)", n.$slideTrack.css(s), i && setTimeout(function() {
        n.disableTransition(), i.call()
      }, n.options.speed))
    }, e.prototype.asNavFor = function(e) {
      var i = this,
        s = i.options.asNavFor;
      s && null !== s && (s = t(s).not(i.$slider)), null !== s && "object" == typeof s && s.each(function() {
        var i = t(this).slick("getSlick");
        i.unslicked || i.slideHandler(e, !0)
      })
    }, e.prototype.applyTransition = function(t) {
      var e = this,
        i = {};
      !1 === e.options.fade ? i[e.transitionType] = e.transformType + " " + e.options.speed + "ms " + e.options.cssEase : i[e.transitionType] = "opacity " + e.options.speed + "ms " + e.options.cssEase, !1 === e.options.fade ? e.$slideTrack.css(i) : e.$slides.eq(t).css(i)
    }, e.prototype.autoPlay = function() {
      var t = this;
      t.autoPlayTimer && clearInterval(t.autoPlayTimer), t.slideCount > t.options.slidesToShow && !0 !== t.paused && (t.autoPlayTimer = setInterval(t.autoPlayIterator, t.options.autoplaySpeed))
    }, e.prototype.autoPlayClear = function() {
      var t = this;
      t.autoPlayTimer && clearInterval(t.autoPlayTimer)
    }, e.prototype.autoPlayIterator = function() {
      var t = this;
      !1 === t.options.infinite ? 1 === t.direction ? (t.currentSlide + 1 === t.slideCount - 1 && (t.direction = 0), t.slideHandler(t.currentSlide + t.options.slidesToScroll)) : (t.currentSlide - 1 == 0 && (t.direction = 1), t.slideHandler(t.currentSlide - t.options.slidesToScroll)) : t.slideHandler(t.currentSlide + t.options.slidesToScroll)
    }, e.prototype.buildArrows = function() {
      var e = this;
      !0 === e.options.arrows && (e.$prevArrow = t(e.options.prevArrow).addClass("slick-arrow"), e.$nextArrow = t(e.options.nextArrow).addClass("slick-arrow"), e.slideCount > e.options.slidesToShow ? (e.$prevArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"), e.$nextArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"), e.htmlExpr.test(e.options.prevArrow) && e.$prevArrow.prependTo(e.options.appendArrows), e.htmlExpr.test(e.options.nextArrow) && e.$nextArrow.appendTo(e.options.appendArrows), !0 !== e.options.infinite && e.$prevArrow.addClass("slick-disabled").attr("aria-disabled", "true")) : e.$prevArrow.add(e.$nextArrow).addClass("slick-hidden").attr({
        "aria-disabled": "true",
        tabindex: "-1"
      }))
    }, e.prototype.buildDots = function() {
      var e, i, s = this;
      if (!0 === s.options.dots && s.slideCount > s.options.slidesToShow) {
        for (i = '<ul class="' + s.options.dotsClass + '">', e = 0; e <= s.getDotCount(); e += 1) i += "<li>" + s.options.customPaging.call(this, s, e) + "</li>";
        i += "</ul>", s.$dots = t(i).appendTo(s.options.appendDots), s.$dots.find("li").first().addClass("slick-active").attr("aria-hidden", "false")
      }
    }, e.prototype.buildOut = function() {
      var e = this;
      e.$slides = e.$slider.children(e.options.slide + ":not(.slick-cloned)").addClass("slick-slide"), e.slideCount = e.$slides.length, e.$slides.each(function(e, i) {
        t(i).attr("data-slick-index", e).data("originalStyling", t(i).attr("style") || "")
      }), e.$slider.addClass("slick-slider"), e.$slideTrack = 0 === e.slideCount ? t('<div class="slick-track"/>').appendTo(e.$slider) : e.$slides.wrapAll('<div class="slick-track"/>').parent(), e.$list = e.$slideTrack.wrap('<div aria-live="polite" class="slick-list"/>').parent(), e.$slideTrack.css("opacity", 0), (!0 === e.options.centerMode || !0 === e.options.swipeToSlide) && (e.options.slidesToScroll = 1), t("img[data-lazy]", e.$slider).not("[src]").addClass("slick-loading"), e.setupInfinite(), e.buildArrows(), e.buildDots(), e.updateDots(), e.setSlideClasses("number" == typeof e.currentSlide ? e.currentSlide : 0), !0 === e.options.draggable && e.$list.addClass("draggable")
    }, e.prototype.buildRows = function() {
      var t, e, i, s, n, o, r, a = this;
      if (s = document.createDocumentFragment(), o = a.$slider.children(), a.options.rows > 1) {
        for (r = a.options.slidesPerRow * a.options.rows, n = Math.ceil(o.length / r), t = 0; n > t; t++) {
          var l = document.createElement("div");
          for (e = 0; e < a.options.rows; e++) {
            var h = document.createElement("div");
            for (i = 0; i < a.options.slidesPerRow; i++) {
              var c = t * r + (e * a.options.slidesPerRow + i);
              o.get(c) && h.appendChild(o.get(c))
            }
            l.appendChild(h)
          }
          s.appendChild(l)
        }
        a.$slider.html(s), a.$slider.children().children().children().css({
          width: 100 / a.options.slidesPerRow + "%",
          display: "inline-block"
        })
      }
    }, e.prototype.checkResponsive = function(e, i) {
      var s, n, o, r = this,
        a = !1,
        l = r.$slider.width(),
        h = window.innerWidth || t(window).width();
      if ("window" === r.respondTo ? o = h : "slider" === r.respondTo ? o = l : "min" === r.respondTo && (o = Math.min(h, l)), r.options.responsive && r.options.responsive.length && null !== r.options.responsive) {
        n = null;
        for (s in r.breakpoints) r.breakpoints.hasOwnProperty(s) && (!1 === r.originalSettings.mobileFirst ? o < r.breakpoints[s] && (n = r.breakpoints[s]) : o > r.breakpoints[s] && (n = r.breakpoints[s]));
        null !== n ? null !== r.activeBreakpoint ? (n !== r.activeBreakpoint || i) && (r.activeBreakpoint = n, "unslick" === r.breakpointSettings[n] ? r.unslick(n) : (r.options = t.extend({}, r.originalSettings, r.breakpointSettings[n]), !0 === e && (r.currentSlide = r.options.initialSlide), r.refresh(e)), a = n) : (r.activeBreakpoint = n, "unslick" === r.breakpointSettings[n] ? r.unslick(n) : (r.options = t.extend({}, r.originalSettings, r.breakpointSettings[n]), !0 === e && (r.currentSlide = r.options.initialSlide), r.refresh(e)), a = n) : null !== r.activeBreakpoint && (r.activeBreakpoint = null, r.options = r.originalSettings, !0 === e && (r.currentSlide = r.options.initialSlide), r.refresh(e), a = n), e || !1 === a || r.$slider.trigger("breakpoint", [r, a])
      }
    }, e.prototype.changeSlide = function(e, i) {
      var s, n, o, r = this,
        a = t(e.target);
      switch (a.is("a") && e.preventDefault(), a.is("li") || (a = a.closest("li")), o = r.slideCount % r.options.slidesToScroll != 0, s = o ? 0 : (r.slideCount - r.currentSlide) % r.options.slidesToScroll, e.data.message) {
        case "previous":
          n = 0 === s ? r.options.slidesToScroll : r.options.slidesToShow - s, r.slideCount > r.options.slidesToShow && r.slideHandler(r.currentSlide - n, !1, i);
          break;
        case "next":
          n = 0 === s ? r.options.slidesToScroll : s, r.slideCount > r.options.slidesToShow && r.slideHandler(r.currentSlide + n, !1, i);
          break;
        case "index":
          var l = 0 === e.data.index ? 0 : e.data.index || a.index() * r.options.slidesToScroll;
          r.slideHandler(r.checkNavigable(l), !1, i), a.children().trigger("focus");
          break;
        default:
          return
      }
    }, e.prototype.checkNavigable = function(t) {
      var e, i;
      if (e = this.getNavigableIndexes(), i = 0, t > e[e.length - 1]) t = e[e.length - 1];
      else
        for (var s in e) {
          if (t < e[s]) {
            t = i;
            break
          }
          i = e[s]
        }
      return t
    }, e.prototype.cleanUpEvents = function() {
      var e = this;
      e.options.dots && null !== e.$dots && (t("li", e.$dots).off("click.slick", e.changeSlide), !0 === e.options.pauseOnDotsHover && !0 === e.options.autoplay && t("li", e.$dots).off("mouseenter.slick", t.proxy(e.setPaused, e, !0)).off("mouseleave.slick", t.proxy(e.setPaused, e, !1))), !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow && e.$prevArrow.off("click.slick", e.changeSlide), e.$nextArrow && e.$nextArrow.off("click.slick", e.changeSlide)), e.$list.off("touchstart.slick mousedown.slick", e.swipeHandler), e.$list.off("touchmove.slick mousemove.slick", e.swipeHandler), e.$list.off("touchend.slick mouseup.slick", e.swipeHandler), e.$list.off("touchcancel.slick mouseleave.slick", e.swipeHandler), e.$list.off("click.slick", e.clickHandler), t(document).off(e.visibilityChange, e.visibility), e.$list.off("mouseenter.slick", t.proxy(e.setPaused, e, !0)), e.$list.off("mouseleave.slick", t.proxy(e.setPaused, e, !1)), !0 === e.options.accessibility && e.$list.off("keydown.slick", e.keyHandler), !0 === e.options.focusOnSelect && t(e.$slideTrack).children().off("click.slick", e.selectHandler), t(window).off("orientationchange.slick.slick-" + e.instanceUid, e.orientationChange), t(window).off("resize.slick.slick-" + e.instanceUid, e.resize), t("[draggable!=true]", e.$slideTrack).off("dragstart", e.preventDefault), t(window).off("load.slick.slick-" + e.instanceUid, e.setPosition), t(document).off("ready.slick.slick-" + e.instanceUid, e.setPosition)
    }, e.prototype.cleanUpRows = function() {
      var t, e = this;
      e.options.rows > 1 && (t = e.$slides.children().children(), t.removeAttr("style"), e.$slider.html(t))
    }, e.prototype.clickHandler = function(t) {
      !1 === this.shouldClick && (t.stopImmediatePropagation(), t.stopPropagation(), t.preventDefault())
    }, e.prototype.destroy = function(e) {
      var i = this;
      i.autoPlayClear(), i.touchObject = {}, i.cleanUpEvents(), t(".slick-cloned", i.$slider).detach(), i.$dots && i.$dots.remove(), i.$prevArrow && i.$prevArrow.length && (i.$prevArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), i.htmlExpr.test(i.options.prevArrow) && i.$prevArrow.remove()), i.$nextArrow && i.$nextArrow.length && (i.$nextArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), i.htmlExpr.test(i.options.nextArrow) && i.$nextArrow.remove()), i.$slides && (i.$slides.removeClass("slick-slide slick-active slick-center slick-visible slick-current").removeAttr("aria-hidden").removeAttr("data-slick-index").each(function() {
        t(this).attr("style", t(this).data("originalStyling"))
      }), i.$slideTrack.children(this.options.slide).detach(), i.$slideTrack.detach(), i.$list.detach(), i.$slider.append(i.$slides)), i.cleanUpRows(), i.$slider.removeClass("slick-slider"), i.$slider.removeClass("slick-initialized"), i.unslicked = !0, e || i.$slider.trigger("destroy", [i])
    }, e.prototype.disableTransition = function(t) {
      var e = this,
        i = {};
      i[e.transitionType] = "", !1 === e.options.fade ? e.$slideTrack.css(i) : e.$slides.eq(t).css(i)
    }, e.prototype.fadeSlide = function(t, e) {
      var i = this;
      !1 === i.cssTransitions ? (i.$slides.eq(t).css({
        zIndex: i.options.zIndex
      }), i.$slides.eq(t).animate({
        opacity: 1
      }, i.options.speed, i.options.easing, e)) : (i.applyTransition(t), i.$slides.eq(t).css({
        opacity: 1,
        zIndex: i.options.zIndex
      }), e && setTimeout(function() {
        i.disableTransition(t), e.call()
      }, i.options.speed))
    }, e.prototype.fadeSlideOut = function(t) {
      var e = this;
      !1 === e.cssTransitions ? e.$slides.eq(t).animate({
        opacity: 0,
        zIndex: e.options.zIndex - 2
      }, e.options.speed, e.options.easing) : (e.applyTransition(t), e.$slides.eq(t).css({
        opacity: 0,
        zIndex: e.options.zIndex - 2
      }))
    }, e.prototype.filterSlides = e.prototype.slickFilter = function(t) {
      var e = this;
      null !== t && (e.$slidesCache = e.$slides, e.unload(), e.$slideTrack.children(this.options.slide).detach(), e.$slidesCache.filter(t).appendTo(e.$slideTrack), e.reinit())
    }, e.prototype.getCurrent = e.prototype.slickCurrentSlide = function() {
      return this.currentSlide
    }, e.prototype.getDotCount = function() {
      var t = this,
        e = 0,
        i = 0,
        s = 0;
      if (!0 === t.options.infinite)
        for (; e < t.slideCount;) ++s, e = i + t.options.slidesToScroll, i += t.options.slidesToScroll <= t.options.slidesToShow ? t.options.slidesToScroll : t.options.slidesToShow;
      else if (!0 === t.options.centerMode) s = t.slideCount;
      else
        for (; e < t.slideCount;) ++s, e = i + t.options.slidesToScroll, i += t.options.slidesToScroll <= t.options.slidesToShow ? t.options.slidesToScroll : t.options.slidesToShow;
      return s - 1
    }, e.prototype.getLeft = function(t) {
      var e, i, s, n = this,
        o = 0;
      return n.slideOffset = 0, i = n.$slides.first().outerHeight(!0), !0 === n.options.infinite ? (n.slideCount > n.options.slidesToShow && (n.slideOffset = n.slideWidth * n.options.slidesToShow * -1, o = i * n.options.slidesToShow * -1), n.slideCount % n.options.slidesToScroll != 0 && t + n.options.slidesToScroll > n.slideCount && n.slideCount > n.options.slidesToShow && (t > n.slideCount ? (n.slideOffset = (n.options.slidesToShow - (t - n.slideCount)) * n.slideWidth * -1, o = (n.options.slidesToShow - (t - n.slideCount)) * i * -1) : (n.slideOffset = n.slideCount % n.options.slidesToScroll * n.slideWidth * -1, o = n.slideCount % n.options.slidesToScroll * i * -1))) : t + n.options.slidesToShow > n.slideCount && (n.slideOffset = (t + n.options.slidesToShow - n.slideCount) * n.slideWidth, o = (t + n.options.slidesToShow - n.slideCount) * i), n.slideCount <= n.options.slidesToShow && (n.slideOffset = 0, o = 0), !0 === n.options.centerMode && !0 === n.options.infinite ? n.slideOffset += n.slideWidth * Math.floor(n.options.slidesToShow / 2) - n.slideWidth : !0 === n.options.centerMode && (n.slideOffset = 0, n.slideOffset += n.slideWidth * Math.floor(n.options.slidesToShow / 2)), e = !1 === n.options.vertical ? t * n.slideWidth * -1 + n.slideOffset : t * i * -1 + o, !0 === n.options.variableWidth && (s = n.slideCount <= n.options.slidesToShow || !1 === n.options.infinite ? n.$slideTrack.children(".slick-slide").eq(t) : n.$slideTrack.children(".slick-slide").eq(t + n.options.slidesToShow), e = !0 === n.options.rtl ? s[0] ? -1 * (n.$slideTrack.width() - s[0].offsetLeft - s.width()) : 0 : s[0] ? -1 * s[0].offsetLeft : 0, !0 === n.options.centerMode && (s = n.slideCount <= n.options.slidesToShow || !1 === n.options.infinite ? n.$slideTrack.children(".slick-slide").eq(t) : n.$slideTrack.children(".slick-slide").eq(t + n.options.slidesToShow + 1), e = !0 === n.options.rtl ? s[0] ? -1 * (n.$slideTrack.width() - s[0].offsetLeft - s.width()) : 0 : s[0] ? -1 * s[0].offsetLeft : 0, e += (n.$list.width() - s.outerWidth()) / 2)), e
    }, e.prototype.getOption = e.prototype.slickGetOption = function(t) {
      return this.options[t]
    }, e.prototype.getNavigableIndexes = function() {
      var t, e = this,
        i = 0,
        s = 0,
        n = [];
      for (!1 === e.options.infinite ? t = e.slideCount : (i = -1 * e.options.slidesToScroll, s = -1 * e.options.slidesToScroll, t = 2 * e.slideCount); t > i;) n.push(i), i = s + e.options.slidesToScroll, s += e.options.slidesToScroll <= e.options.slidesToShow ? e.options.slidesToScroll : e.options.slidesToShow;
      return n
    }, e.prototype.getSlick = function() {
      return this
    }, e.prototype.getSlideCount = function() {
      var e, i, s = this;
      return i = !0 === s.options.centerMode ? s.slideWidth * Math.floor(s.options.slidesToShow / 2) : 0, !0 === s.options.swipeToSlide ? (s.$slideTrack.find(".slick-slide").each(function(n, o) {
        return o.offsetLeft - i + t(o).outerWidth() / 2 > -1 * s.swipeLeft ? (e = o, !1) : void 0
      }), Math.abs(t(e).attr("data-slick-index") - s.currentSlide) || 1) : s.options.slidesToScroll
    }, e.prototype.goTo = e.prototype.slickGoTo = function(t, e) {
      this.changeSlide({
        data: {
          message: "index",
          index: parseInt(t)
        }
      }, e)
    }, e.prototype.init = function(e) {
      var i = this;
      t(i.$slider).hasClass("slick-initialized") || (t(i.$slider).addClass("slick-initialized"), i.buildRows(), i.buildOut(), i.setProps(), i.startLoad(), i.loadSlider(), i.initializeEvents(), i.updateArrows(), i.updateDots()), e && i.$slider.trigger("init", [i]), !0 === i.options.accessibility && i.initADA()
    }, e.prototype.initArrowEvents = function() {
      var t = this;
      !0 === t.options.arrows && t.slideCount > t.options.slidesToShow && (t.$prevArrow.on("click.slick", {
        message: "previous"
      }, t.changeSlide), t.$nextArrow.on("click.slick", {
        message: "next"
      }, t.changeSlide))
    }, e.prototype.initDotEvents = function() {
      var e = this;
      !0 === e.options.dots && e.slideCount > e.options.slidesToShow && t("li", e.$dots).on("click.slick", {
        message: "index"
      }, e.changeSlide), !0 === e.options.dots && !0 === e.options.pauseOnDotsHover && !0 === e.options.autoplay && t("li", e.$dots).on("mouseenter.slick", t.proxy(e.setPaused, e, !0)).on("mouseleave.slick", t.proxy(e.setPaused, e, !1))
    }, e.prototype.initializeEvents = function() {
      var e = this;
      e.initArrowEvents(), e.initDotEvents(), e.$list.on("touchstart.slick mousedown.slick", {
        action: "start"
      }, e.swipeHandler), e.$list.on("touchmove.slick mousemove.slick", {
        action: "move"
      }, e.swipeHandler), e.$list.on("touchend.slick mouseup.slick", {
        action: "end"
      }, e.swipeHandler), e.$list.on("touchcancel.slick mouseleave.slick", {
        action: "end"
      }, e.swipeHandler), e.$list.on("click.slick", e.clickHandler), t(document).on(e.visibilityChange, t.proxy(e.visibility, e)), e.$list.on("mouseenter.slick", t.proxy(e.setPaused, e, !0)), e.$list.on("mouseleave.slick", t.proxy(e.setPaused, e, !1)), !0 === e.options.accessibility && e.$list.on("keydown.slick", e.keyHandler), !0 === e.options.focusOnSelect && t(e.$slideTrack).children().on("click.slick", e.selectHandler), t(window).on("orientationchange.slick.slick-" + e.instanceUid, t.proxy(e.orientationChange, e)), t(window).on("resize.slick.slick-" + e.instanceUid, t.proxy(e.resize, e)), t("[draggable!=true]", e.$slideTrack).on("dragstart", e.preventDefault), t(window).on("load.slick.slick-" + e.instanceUid, e.setPosition), t(document).on("ready.slick.slick-" + e.instanceUid, e.setPosition)
    }, e.prototype.initUI = function() {
      var t = this;
      !0 === t.options.arrows && t.slideCount > t.options.slidesToShow && (t.$prevArrow.show(), t.$nextArrow.show()), !0 === t.options.dots && t.slideCount > t.options.slidesToShow && t.$dots.show(), !0 === t.options.autoplay && t.autoPlay()
    }, e.prototype.keyHandler = function(t) {
      var e = this;
      t.target.tagName.match("TEXTAREA|INPUT|SELECT") || (37 === t.keyCode && !0 === e.options.accessibility ? e.changeSlide({
        data: {
          message: "previous"
        }
      }) : 39 === t.keyCode && !0 === e.options.accessibility && e.changeSlide({
        data: {
          message: "next"
        }
      }))
    }, e.prototype.lazyLoad = function() {
      function e(e) {
        t("img[data-lazy]", e).each(function() {
          var e = t(this),
            i = t(this).attr("data-lazy"),
            s = document.createElement("img");
          s.onload = function() {
            e.animate({
              opacity: 0
            }, 100, function() {
              e.attr("src", i).animate({
                opacity: 1
              }, 200, function() {
                e.removeAttr("data-lazy").removeClass("slick-loading")
              })
            })
          }, s.src = i
        })
      }
      var i, s, n, o, r = this;
      !0 === r.options.centerMode ? !0 === r.options.infinite ? (n = r.currentSlide + (r.options.slidesToShow / 2 + 1), o = n + r.options.slidesToShow + 2) : (n = Math.max(0, r.currentSlide - (r.options.slidesToShow / 2 + 1)), o = r.options.slidesToShow / 2 + 1 + 2 + r.currentSlide) : (n = r.options.infinite ? r.options.slidesToShow + r.currentSlide : r.currentSlide, o = n + r.options.slidesToShow, !0 === r.options.fade && (n > 0 && n--, o <= r.slideCount && o++)), i = r.$slider.find(".slick-slide").slice(n, o), e(i), r.slideCount <= r.options.slidesToShow ? (s = r.$slider.find(".slick-slide"), e(s)) : r.currentSlide >= r.slideCount - r.options.slidesToShow ? (s = r.$slider.find(".slick-cloned").slice(0, r.options.slidesToShow), e(s)) : 0 === r.currentSlide && (s = r.$slider.find(".slick-cloned").slice(-1 * r.options.slidesToShow), e(s))
    }, e.prototype.loadSlider = function() {
      var t = this;
      t.setPosition(), t.$slideTrack.css({
        opacity: 1
      }), t.$slider.removeClass("slick-loading"), t.initUI(), "progressive" === t.options.lazyLoad && t.progressiveLazyLoad()
    }, e.prototype.next = e.prototype.slickNext = function() {
      this.changeSlide({
        data: {
          message: "next"
        }
      })
    }, e.prototype.orientationChange = function() {
      var t = this;
      t.checkResponsive(), t.setPosition()
    }, e.prototype.pause = e.prototype.slickPause = function() {
      var t = this;
      t.autoPlayClear(), t.paused = !0
    }, e.prototype.play = e.prototype.slickPlay = function() {
      var t = this;
      t.paused = !1, t.autoPlay()
    }, e.prototype.postSlide = function(t) {
      var e = this;
      e.$slider.trigger("afterChange", [e, t]), e.animating = !1, e.setPosition(), e.swipeLeft = null, !0 === e.options.autoplay && !1 === e.paused && e.autoPlay(), !0 === e.options.accessibility && e.initADA()
    }, e.prototype.prev = e.prototype.slickPrev = function() {
      this.changeSlide({
        data: {
          message: "previous"
        }
      })
    }, e.prototype.preventDefault = function(t) {
      t.preventDefault()
    }, e.prototype.progressiveLazyLoad = function() {
      var e, i = this;
      t("img[data-lazy]", i.$slider).length > 0 && (e = t("img[data-lazy]", i.$slider).first(), e.attr("src", null), e.attr("src", e.attr("data-lazy")).removeClass("slick-loading").load(function() {
        e.removeAttr("data-lazy"), i.progressiveLazyLoad(), !0 === i.options.adaptiveHeight && i.setPosition()
      }).error(function() {
        e.removeAttr("data-lazy"), i.progressiveLazyLoad()
      }))
    }, e.prototype.refresh = function(e) {
      var i, s, n = this;
      s = n.slideCount - n.options.slidesToShow, n.options.infinite || (n.slideCount <= n.options.slidesToShow ? n.currentSlide = 0 : n.currentSlide > s && (n.currentSlide = s)), i = n.currentSlide, n.destroy(!0), t.extend(n, n.initials, {
        currentSlide: i
      }), n.init(), e || n.changeSlide({
        data: {
          message: "index",
          index: i
        }
      }, !1)
    }, e.prototype.registerBreakpoints = function() {
      var e, i, s, n = this,
        o = n.options.responsive || null;
      if ("array" === t.type(o) && o.length) {
        n.respondTo = n.options.respondTo || "window";
        for (e in o)
          if (s = n.breakpoints.length - 1, i = o[e].breakpoint, o.hasOwnProperty(e)) {
            for (; s >= 0;) n.breakpoints[s] && n.breakpoints[s] === i && n.breakpoints.splice(s, 1), s--;
            n.breakpoints.push(i), n.breakpointSettings[i] = o[e].settings
          }
        n.breakpoints.sort(function(t, e) {
          return n.options.mobileFirst ? t - e : e - t
        })
      }
    }, e.prototype.reinit = function() {
      var e = this;
      e.$slides = e.$slideTrack.children(e.options.slide).addClass("slick-slide"), e.slideCount = e.$slides.length, e.currentSlide >= e.slideCount && 0 !== e.currentSlide && (e.currentSlide = e.currentSlide - e.options.slidesToScroll), e.slideCount <= e.options.slidesToShow && (e.currentSlide = 0), e.registerBreakpoints(), e.setProps(), e.setupInfinite(), e.buildArrows(), e.updateArrows(), e.initArrowEvents(), e.buildDots(), e.updateDots(), e.initDotEvents(), e.checkResponsive(!1, !0), !0 === e.options.focusOnSelect && t(e.$slideTrack).children().on("click.slick", e.selectHandler), e.setSlideClasses(0), e.setPosition(), e.$slider.trigger("reInit", [e]), !0 === e.options.autoplay && e.focusHandler()
    }, e.prototype.resize = function() {
      var e = this;
      t(window).width() !== e.windowWidth && (clearTimeout(e.windowDelay), e.windowDelay = window.setTimeout(function() {
        e.windowWidth = t(window).width(), e.checkResponsive(), e.unslicked || e.setPosition()
      }, 50))
    }, e.prototype.removeSlide = e.prototype.slickRemove = function(t, e, i) {
      var s = this;
      return "boolean" == typeof t ? (e = t, t = !0 === e ? 0 : s.slideCount - 1) : t = !0 === e ? --t : t, !(s.slideCount < 1 || 0 > t || t > s.slideCount - 1) && (s.unload(), !0 === i ? s.$slideTrack.children().remove() : s.$slideTrack.children(this.options.slide).eq(t).remove(), s.$slides = s.$slideTrack.children(this.options.slide), s.$slideTrack.children(this.options.slide).detach(), s.$slideTrack.append(s.$slides), s.$slidesCache = s.$slides, void s.reinit())
    }, e.prototype.setCSS = function(t) {
      var e, i, s = this,
        n = {};
      !0 === s.options.rtl && (t = -t), e = "left" == s.positionProp ? Math.ceil(t) + "px" : "0px", i = "top" == s.positionProp ? Math.ceil(t) + "px" : "0px", n[s.positionProp] = t, !1 === s.transformsEnabled ? s.$slideTrack.css(n) : (n = {}, !1 === s.cssTransitions ? (n[s.animType] = "translate(" + e + ", " + i + ")", s.$slideTrack.css(n)) : (n[s.animType] = "translate3d(" + e + ", " + i + ", 0px)", s.$slideTrack.css(n)))
    }, e.prototype.setDimensions = function() {
      var t = this;
      !1 === t.options.vertical ? !0 === t.options.centerMode && t.$list.css({
        padding: "0px " + t.options.centerPadding
      }) : (t.$list.height(t.$slides.first().outerHeight(!0) * t.options.slidesToShow), !0 === t.options.centerMode && t.$list.css({
        padding: t.options.centerPadding + " 0px"
      })), t.listWidth = t.$list.width(), t.listHeight = t.$list.height(), !1 === t.options.vertical && !1 === t.options.variableWidth ? (t.slideWidth = Math.ceil(t.listWidth / t.options.slidesToShow), t.$slideTrack.width(Math.ceil(t.slideWidth * t.$slideTrack.children(".slick-slide").length))) : !0 === t.options.variableWidth ? t.$slideTrack.width(5e3 * t.slideCount) : (t.slideWidth = Math.ceil(t.listWidth), t.$slideTrack.height(Math.ceil(t.$slides.first().outerHeight(!0) * t.$slideTrack.children(".slick-slide").length)));
      var e = t.$slides.first().outerWidth(!0) - t.$slides.first().width();
      !1 === t.options.variableWidth && t.$slideTrack.children(".slick-slide").width(t.slideWidth - e)
    }, e.prototype.setFade = function() {
      var e, i = this;
      i.$slides.each(function(s, n) {
        e = i.slideWidth * s * -1, !0 === i.options.rtl ? t(n).css({
          position: "relative",
          right: e,
          top: 0,
          zIndex: i.options.zIndex - 2,
          opacity: 0
        }) : t(n).css({
          position: "relative",
          left: e,
          top: 0,
          zIndex: i.options.zIndex - 2,
          opacity: 0
        })
      }), i.$slides.eq(i.currentSlide).css({
        zIndex: i.options.zIndex - 1,
        opacity: 1
      })
    }, e.prototype.setHeight = function() {
      var t = this;
      if (1 === t.options.slidesToShow && !0 === t.options.adaptiveHeight && !1 === t.options.vertical) {
        var e = t.$slides.eq(t.currentSlide).outerHeight(!0);
        t.$list.css("height", e)
      }
    }, e.prototype.setOption = e.prototype.slickSetOption = function(e, i, s) {
      var n, o, r = this;
      if ("responsive" === e && "array" === t.type(i))
        for (o in i)
          if ("array" !== t.type(r.options.responsive)) r.options.responsive = [i[o]];
          else {
            for (n = r.options.responsive.length - 1; n >= 0;) r.options.responsive[n].breakpoint === i[o].breakpoint && r.options.responsive.splice(n, 1), n--;
            r.options.responsive.push(i[o])
          } else r.options[e] = i;
      !0 === s && (r.unload(), r.reinit())
    }, e.prototype.setPosition = function() {
      var t = this;
      t.setDimensions(), t.setHeight(), !1 === t.options.fade ? t.setCSS(t.getLeft(t.currentSlide)) : t.setFade(), t.$slider.trigger("setPosition", [t])
    }, e.prototype.setProps = function() {
      var t = this,
        e = document.body.style;
      t.positionProp = !0 === t.options.vertical ? "top" : "left", "top" === t.positionProp ? t.$slider.addClass("slick-vertical") : t.$slider.removeClass("slick-vertical"), (void 0 !== e.WebkitTransition || void 0 !== e.MozTransition || void 0 !== e.msTransition) && !0 === t.options.useCSS && (t.cssTransitions = !0), t.options.fade && ("number" == typeof t.options.zIndex ? t.options.zIndex < 3 && (t.options.zIndex = 3) : t.options.zIndex = t.defaults.zIndex), void 0 !== e.OTransform && (t.animType = "OTransform", t.transformType = "-o-transform", t.transitionType = "OTransition", void 0 === e.perspectiveProperty && void 0 === e.webkitPerspective && (t.animType = !1)), void 0 !== e.MozTransform && (t.animType = "MozTransform", t.transformType = "-moz-transform", t.transitionType = "MozTransition", void 0 === e.perspectiveProperty && void 0 === e.MozPerspective && (t.animType = !1)), void 0 !== e.webkitTransform && (t.animType = "webkitTransform", t.transformType = "-webkit-transform", t.transitionType = "webkitTransition", void 0 === e.perspectiveProperty && void 0 === e.webkitPerspective && (t.animType = !1)), void 0 !== e.msTransform && (t.animType = "msTransform", t.transformType = "-ms-transform", t.transitionType = "msTransition", void 0 === e.msTransform && (t.animType = !1)), void 0 !== e.transform && !1 !== t.animType && (t.animType = "transform", t.transformType = "transform", t.transitionType = "transition"), t.transformsEnabled = t.options.useTransform && null !== t.animType && !1 !== t.animType
    }, e.prototype.setSlideClasses = function(t) {
      var e, i, s, n, o = this;
      i = o.$slider.find(".slick-slide").removeClass("slick-active slick-center slick-current").attr("aria-hidden", "true"), o.$slides.eq(t).addClass("slick-current"), !0 === o.options.centerMode ? (e = Math.floor(o.options.slidesToShow / 2), !0 === o.options.infinite && (t >= e && t <= o.slideCount - 1 - e ? o.$slides.slice(t - e, t + e + 1).addClass("slick-active").attr("aria-hidden", "false") : (s = o.options.slidesToShow + t, i.slice(s - e + 1, s + e + 2).addClass("slick-active").attr("aria-hidden", "false")), 0 === t ? i.eq(i.length - 1 - o.options.slidesToShow).addClass("slick-center") : t === o.slideCount - 1 && i.eq(o.options.slidesToShow).addClass("slick-center")), o.$slides.eq(t).addClass("slick-center")) : t >= 0 && t <= o.slideCount - o.options.slidesToShow ? o.$slides.slice(t, t + o.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false") : i.length <= o.options.slidesToShow ? i.addClass("slick-active").attr("aria-hidden", "false") : (n = o.slideCount % o.options.slidesToShow, s = !0 === o.options.infinite ? o.options.slidesToShow + t : t, o.options.slidesToShow == o.options.slidesToScroll && o.slideCount - t < o.options.slidesToShow ? i.slice(s - (o.options.slidesToShow - n), s + n).addClass("slick-active").attr("aria-hidden", "false") : i.slice(s, s + o.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false")), "ondemand" === o.options.lazyLoad && o.lazyLoad()
    }, e.prototype.setupInfinite = function() {
      var e, i, s, n = this;
      if (!0 === n.options.fade && (n.options.centerMode = !1), !0 === n.options.infinite && !1 === n.options.fade && (i = null, n.slideCount > n.options.slidesToShow)) {
        for (s = !0 === n.options.centerMode ? n.options.slidesToShow + 1 : n.options.slidesToShow, e = n.slideCount; e > n.slideCount - s; e -= 1) i = e - 1, t(n.$slides[i]).clone(!0).attr("id", "").attr("data-slick-index", i - n.slideCount).prependTo(n.$slideTrack).addClass("slick-cloned");
        for (e = 0; s > e; e += 1) i = e, t(n.$slides[i]).clone(!0).attr("id", "").attr("data-slick-index", i + n.slideCount).appendTo(n.$slideTrack).addClass("slick-cloned");
        n.$slideTrack.find(".slick-cloned").find("[id]").each(function() {
          t(this).attr("id", "")
        })
      }
    }, e.prototype.setPaused = function(t) {
      var e = this;
      !0 === e.options.autoplay && !0 === e.options.pauseOnHover && (e.paused = t, t ? e.autoPlayClear() : e.autoPlay())
    }, e.prototype.selectHandler = function(e) {
      var i = this,
        s = t(e.target).is(".slick-slide") ? t(e.target) : t(e.target).parents(".slick-slide"),
        n = parseInt(s.attr("data-slick-index"));
      return n || (n = 0), i.slideCount <= i.options.slidesToShow ? (i.setSlideClasses(n), void i.asNavFor(n)) : void i.slideHandler(n)
    }, e.prototype.slideHandler = function(t, e, i) {
      var s, n, o, r, a = null,
        l = this;
      return e = e || !1, !0 === l.animating && !0 === l.options.waitForAnimate || !0 === l.options.fade && l.currentSlide === t || l.slideCount <= l.options.slidesToShow ? void 0 : (!1 === e && l.asNavFor(t), s = t, a = l.getLeft(s), r = l.getLeft(l.currentSlide), l.currentLeft = null === l.swipeLeft ? r : l.swipeLeft, !1 === l.options.infinite && !1 === l.options.centerMode && (0 > t || t > l.getDotCount() * l.options.slidesToScroll) ? void(!1 === l.options.fade && (s = l.currentSlide, !0 !== i ? l.animateSlide(r, function() {
        l.postSlide(s)
      }) : l.postSlide(s))) : !1 === l.options.infinite && !0 === l.options.centerMode && (0 > t || t > l.slideCount - l.options.slidesToScroll) ? void(!1 === l.options.fade && (s = l.currentSlide, !0 !== i ? l.animateSlide(r, function() {
        l.postSlide(s)
      }) : l.postSlide(s))) : (!0 === l.options.autoplay && clearInterval(l.autoPlayTimer), n = 0 > s ? l.slideCount % l.options.slidesToScroll != 0 ? l.slideCount - l.slideCount % l.options.slidesToScroll : l.slideCount + s : s >= l.slideCount ? l.slideCount % l.options.slidesToScroll != 0 ? 0 : s - l.slideCount : s, l.animating = !0, l.$slider.trigger("beforeChange", [l, l.currentSlide, n]), o = l.currentSlide, l.currentSlide = n, l.setSlideClasses(l.currentSlide), l.updateDots(), l.updateArrows(), !0 === l.options.fade ? (!0 !== i ? (l.fadeSlideOut(o), l.fadeSlide(n, function() {
        l.postSlide(n)
      })) : l.postSlide(n), void l.animateHeight()) : void(!0 !== i ? l.animateSlide(a, function() {
        l.postSlide(n)
      }) : l.postSlide(n))))
    }, e.prototype.startLoad = function() {
      var t = this;
      !0 === t.options.arrows && t.slideCount > t.options.slidesToShow && (t.$prevArrow.hide(), t.$nextArrow.hide()), !0 === t.options.dots && t.slideCount > t.options.slidesToShow && t.$dots.hide(), t.$slider.addClass("slick-loading")
    }, e.prototype.swipeDirection = function() {
      var t, e, i, s, n = this;
      return t = n.touchObject.startX - n.touchObject.curX, e = n.touchObject.startY - n.touchObject.curY, i = Math.atan2(e, t), s = Math.round(180 * i / Math.PI), 0 > s && (s = 360 - Math.abs(s)), 45 >= s && s >= 0 ? !1 === n.options.rtl ? "left" : "right" : 360 >= s && s >= 315 ? !1 === n.options.rtl ? "left" : "right" : s >= 135 && 225 >= s ? !1 === n.options.rtl ? "right" : "left" : !0 === n.options.verticalSwiping ? s >= 35 && 135 >= s ? "left" : "right" : "vertical"
    }, e.prototype.swipeEnd = function(t) {
      var e, i = this;
      if (i.dragging = !1, i.shouldClick = !(i.touchObject.swipeLength > 10), void 0 === i.touchObject.curX) return !1;
      if (!0 === i.touchObject.edgeHit && i.$slider.trigger("edge", [i, i.swipeDirection()]), i.touchObject.swipeLength >= i.touchObject.minSwipe) switch (i.swipeDirection()) {
        case "left":
          e = i.options.swipeToSlide ? i.checkNavigable(i.currentSlide + i.getSlideCount()) : i.currentSlide + i.getSlideCount(), i.slideHandler(e), i.currentDirection = 0, i.touchObject = {}, i.$slider.trigger("swipe", [i, "left"]);
          break;
        case "right":
          e = i.options.swipeToSlide ? i.checkNavigable(i.currentSlide - i.getSlideCount()) : i.currentSlide - i.getSlideCount(), i.slideHandler(e), i.currentDirection = 1, i.touchObject = {}, i.$slider.trigger("swipe", [i, "right"])
      } else i.touchObject.startX !== i.touchObject.curX && (i.slideHandler(i.currentSlide), i.touchObject = {})
    }, e.prototype.swipeHandler = function(t) {
      var e = this;
      if (!(!1 === e.options.swipe || "ontouchend" in document && !1 === e.options.swipe || !1 === e.options.draggable && -1 !== t.type.indexOf("mouse"))) switch (e.touchObject.fingerCount = t.originalEvent && void 0 !== t.originalEvent.touches ? t.originalEvent.touches.length : 1, e.touchObject.minSwipe = e.listWidth / e.options.touchThreshold, !0 === e.options.verticalSwiping && (e.touchObject.minSwipe = e.listHeight / e.options.touchThreshold), t.data.action) {
        case "start":
          e.swipeStart(t);
          break;
        case "move":
          e.swipeMove(t);
          break;
        case "end":
          e.swipeEnd(t)
      }
    }, e.prototype.swipeMove = function(t) {
      var e, i, s, n, o, r = this;
      return o = void 0 !== t.originalEvent ? t.originalEvent.touches : null, !(!r.dragging || o && 1 !== o.length) && (e = r.getLeft(r.currentSlide), r.touchObject.curX = void 0 !== o ? o[0].pageX : t.clientX, r.touchObject.curY = void 0 !== o ? o[0].pageY : t.clientY, r.touchObject.swipeLength = Math.round(Math.sqrt(Math.pow(r.touchObject.curX - r.touchObject.startX, 2))), !0 === r.options.verticalSwiping && (r.touchObject.swipeLength = Math.round(Math.sqrt(Math.pow(r.touchObject.curY - r.touchObject.startY, 2)))), i = r.swipeDirection(), "vertical" !== i ? (void 0 !== t.originalEvent && r.touchObject.swipeLength > 4 && t.preventDefault(), n = (!1 === r.options.rtl ? 1 : -1) * (r.touchObject.curX > r.touchObject.startX ? 1 : -1), !0 === r.options.verticalSwiping && (n = r.touchObject.curY > r.touchObject.startY ? 1 : -1), s = r.touchObject.swipeLength, r.touchObject.edgeHit = !1, !1 === r.options.infinite && (0 === r.currentSlide && "right" === i || r.currentSlide >= r.getDotCount() && "left" === i) && (s = r.touchObject.swipeLength * r.options.edgeFriction, r.touchObject.edgeHit = !0), !1 === r.options.vertical ? r.swipeLeft = e + s * n : r.swipeLeft = e + s * (r.$list.height() / r.listWidth) * n, !0 === r.options.verticalSwiping && (r.swipeLeft = e + s * n), !0 !== r.options.fade && !1 !== r.options.touchMove && (!0 === r.animating ? (r.swipeLeft = null, !1) : void r.setCSS(r.swipeLeft))) : void 0)
    }, e.prototype.swipeStart = function(t) {
      var e, i = this;
      return 1 !== i.touchObject.fingerCount || i.slideCount <= i.options.slidesToShow ? (i.touchObject = {}, !1) : (void 0 !== t.originalEvent && void 0 !== t.originalEvent.touches && (e = t.originalEvent.touches[0]), i.touchObject.startX = i.touchObject.curX = void 0 !== e ? e.pageX : t.clientX, i.touchObject.startY = i.touchObject.curY = void 0 !== e ? e.pageY : t.clientY, void(i.dragging = !0))
    }, e.prototype.unfilterSlides = e.prototype.slickUnfilter = function() {
      var t = this;
      null !== t.$slidesCache && (t.unload(), t.$slideTrack.children(this.options.slide).detach(), t.$slidesCache.appendTo(t.$slideTrack), t.reinit())
    }, e.prototype.unload = function() {
      var e = this;
      t(".slick-cloned", e.$slider).remove(), e.$dots && e.$dots.remove(), e.$prevArrow && e.htmlExpr.test(e.options.prevArrow) && e.$prevArrow.remove(), e.$nextArrow && e.htmlExpr.test(e.options.nextArrow) && e.$nextArrow.remove(), e.$slides.removeClass("slick-slide slick-active slick-visible slick-current").attr("aria-hidden", "true").css("width", "")
    }, e.prototype.unslick = function(t) {
      var e = this;
      e.$slider.trigger("unslick", [e, t]), e.destroy()
    }, e.prototype.updateArrows = function() {
      var t = this;
      Math.floor(t.options.slidesToShow / 2), !0 === t.options.arrows && t.slideCount > t.options.slidesToShow && !t.options.infinite && (t.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false"), t.$nextArrow.removeClass("slick-disabled").attr("aria-disabled", "false"), 0 === t.currentSlide ? (t.$prevArrow.addClass("slick-disabled").attr("aria-disabled", "true"), t.$nextArrow.removeClass("slick-disabled").attr("aria-disabled", "false")) : t.currentSlide >= t.slideCount - t.options.slidesToShow && !1 === t.options.centerMode ? (t.$nextArrow.addClass("slick-disabled").attr("aria-disabled", "true"), t.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false")) : t.currentSlide >= t.slideCount - 1 && !0 === t.options.centerMode && (t.$nextArrow.addClass("slick-disabled").attr("aria-disabled", "true"), t.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false")))
    }, e.prototype.updateDots = function() {
      var t = this;
      null !== t.$dots && (t.$dots.find("li").removeClass("slick-active").attr("aria-hidden", "true"), t.$dots.find("li").eq(Math.floor(t.currentSlide / t.options.slidesToScroll)).addClass("slick-active").attr("aria-hidden", "false"))
    }, e.prototype.visibility = function() {
      var t = this;
      document[t.hidden] ? (t.paused = !0, t.autoPlayClear()) : !0 === t.options.autoplay && (t.paused = !1, t.autoPlay())
    }, e.prototype.initADA = function() {
      var e = this;
      e.$slides.add(e.$slideTrack.find(".slick-cloned")).attr({
        "aria-hidden": "true",
        tabindex: "-1"
      }).find("a, input, button, select").attr({
        tabindex: "-1"
      }), e.$slideTrack.attr("role", "listbox"), e.$slides.not(e.$slideTrack.find(".slick-cloned")).each(function(i) {
        t(this).attr({
          role: "option",
          "aria-describedby": "slick-slide" + e.instanceUid + i
        })
      }), null !== e.$dots && e.$dots.attr("role", "tablist").find("li").each(function(i) {
        t(this).attr({
          role: "presentation",
          "aria-selected": "false",
          "aria-controls": "navigation" + e.instanceUid + i,
          id: "slick-slide" + e.instanceUid + i
        })
      }).first().attr("aria-selected", "true").end().find("button").attr("role", "button").end().closest("div").attr("role", "toolbar"), e.activateADA()
    }, e.prototype.activateADA = function() {
      this.$slideTrack.find(".slick-active").attr({
        "aria-hidden": "false"
      }).find("a, input, button, select").attr({
        tabindex: "0"
      })
    }, e.prototype.focusHandler = function() {
      var e = this;
      e.$slider.on("focus.slick blur.slick", "*", function(i) {
        i.stopImmediatePropagation();
        var s = t(this);
        setTimeout(function() {
          e.isPlay && (s.is(":focus") ? (e.autoPlayClear(), e.paused = !0) : (e.paused = !1, e.autoPlay()))
        }, 0)
      })
    }, t.fn.slick = function() {
      var t, i, s = this,
        n = arguments[0],
        o = Array.prototype.slice.call(arguments, 1),
        r = s.length;
      for (t = 0; r > t; t++)
        if ("object" == typeof n || void 0 === n ? s[t].slick = new e(s[t], n) : i = s[t].slick[n].apply(s[t].slick, o), void 0 !== i) return i;
      return s
    }
  }), $(document).ready(function() {
    $(".slick-user").slick({
      slidesToShow: 4,
      slidesToScroll: 3,
      autoplay: !1,
      dots: !0,
      arrows: !0,
      responsive: [{
        breakpoint: 991,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1
        }
      }, {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }]
    }), $(".slick-banner").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: !1,
      dots: !0,
      arrows: !1
    }), $(".slick-logo").slick({
      slidesToShow: 5,
      slidesToScroll: 1,
      autoplay: !1,
      dots: !1,
      arrows: !0,
      responsive: [{
        breakpoint: 991,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1
        }
      }, {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }]
    }), $(".slick-gallery").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: !1,
      dots: !1,
      arrows: !0
    })
  }), $(document).ready(function() {
    $(".datepicker").datepicker()
  }),
  function(t) {
    "function" == typeof define && define.amd ? define(["../widgets/datepicker"], t) : t(jQuery.datepicker)
  }(function(t) {
    return t.regional.ru = {
      closeText: "Закрыть",
      prevText: "&#x3C;Пред",
      nextText: "След&#x3E;",
      currentText: "Сегодня",
      monthNames: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
      monthNamesShort: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"],
      dayNames: ["воскресенье", "понедельник", "вторник", "среда", "четверг", "пятница", "суббота"],
      dayNamesShort: ["вск", "пнд", "втр", "срд", "чтв", "птн", "сбт"],
      dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
      weekHeader: "Нед",
      dateFormat: "dd.mm.yy",
      firstDay: 1,
      isRTL: !1,
      showMonthAfterYear: !1,
      yearSuffix: ""
    }, t.setDefaults(t.regional.ru), t.regional.ru
  }), $(document).ready(function() {
    $(".promoCode").hide(), $(".promoCodeClick").click(function() {
      $(this).parent().parent().find(".promoCode").toggle()
    })
  }), $(document).ready(function() {
    $(".toggle").click(function(t) {
      t.preventDefault();
      var e = $(this);
      e.hasClass("current") ? e.removeClass("current") : (e.parent().parent().find("li .accordion__title").removeClass("current"), e.toggleClass("current")), e.next().hasClass("show") ? (e.next().removeClass("show"), e.next().slideUp(350)) : (e.parent().parent().find("li .accordion__content").removeClass("show"), e.parent().parent().find("li .accordion__content").slideUp(350), e.next().toggleClass("show"), e.next().slideToggle(350))
    })
  }), $(document).ready(function() {
    $(".seo__toggle").on("click", function(t) {
      $(this).text("Скрыть" == $(this).text() ? "Показать полностью" : "Скрыть"), $(this).parents(".seo").toggleClass("expanded")
    }), $(".seo-clinic__toggle").on("click", function(t) {
      $(this).text("Скрыть" == $(this).text() ? "Показать все направления" : "Скрыть"), $(this).parents(".seo").toggleClass("expanded")
    }), $(".header__menu").on("click", function(t) {
      $(this).toggleClass("current"), $(".header__menu-content").toggleClass("show")
    })
  }), $(document).ready(function() {
    $("ul.tabs li a").click(function() {
      var t = $(this).attr("data-tab");
      $("ul.tabs li").removeClass("current"), $(".tabs-content").removeClass("current"), $(this).parent().addClass("current"), $("#" + t).addClass("current")
    })
  });
