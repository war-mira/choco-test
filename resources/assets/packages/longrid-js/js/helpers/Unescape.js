/**
 * lodash (Custom Build) <https://lodash.com/>
 * Build: `lodash modularize exports="npm" -o ./`
 * Copyright jQuery Foundation and other contributors <https://jquery.org/>
 * Released under MIT license <https://lodash.com/license>
 * Based on Underscore.js 1.8.3 <http://underscorejs.org/LICENSE>
 * Copyright Jeremy Ashkenas, DocumentCloud and Investigative Reporters & Editors
 */
function Unescape(text) {

    let INFINITY = 1 / 0;
    let symbolTag = '[object Symbol]';
    let reEscapedHtml = /&(?:amp|lt|gt|quot|#39|#96);/g;
    let reHasEscapedHtml = RegExp(reEscapedHtml.source);

    let htmlUnescapes = {
        '&amp;': '&',
        '&lt;': '<',
        '&gt;': '>',
        '&quot;': '"',
        '&#39;': "'",
        '&#96;': '`'
    };

    let freeGlobal = typeof global == 'object' && global && global.Object === Object && global;

    let freeSelf = typeof self == 'object' && self && self.Object === Object && self;

    let root = freeGlobal || freeSelf || Function('return this')();

    let unescapeHtmlChar = basePropertyOf(htmlUnescapes);

    let objectProto = Object.prototype;


    let objectToString = objectProto.toString;

    let Symbol = root.Symbol;

    let symbolProto = Symbol ? Symbol.prototype : undefined;
    let symbolToString = symbolProto ? symbolProto.toString : undefined;


    function basePropertyOf(object) {
        return function (key) {
            return object == null ? undefined : object[key];
        };
    }

    function baseToString(value) {
        // Exit early for strings to avoid a performance hit in some environments.
        if (typeof value == 'string') {
            return value;
        }
        if (isSymbol(value)) {
            return symbolToString ? symbolToString.call(value) : '';
        }
        var result = (value + '');
        return (result == '0' && (1 / value) == -INFINITY) ? '-0' : result;
    }

    function isObjectLike(value) {
        return !!value && typeof value == 'object';
    }

    function isSymbol(value) {
        return typeof value == 'symbol' ||
            (isObjectLike(value) && objectToString.call(value) == symbolTag);
    }

    function toString(value) {
        return value == null ? '' : baseToString(value);
    }

    function unescape(string) {
        string = toString(string);
        return (string && reHasEscapedHtml.test(string))
            ? string.replace(reEscapedHtml, unescapeHtmlChar)
            : string;
    }

    return unescape(text);
} 