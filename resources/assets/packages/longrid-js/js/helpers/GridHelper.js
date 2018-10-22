class GridHelper {
    static arrayToSortPattern(arr) {
        let obj = {};
        arr.forEach(function (item, index) {
            obj[item] = index;
        });
        return obj;
    };

    static getFilterd(arr, arr2) {
        return arr.filter((el) => !arr2.includes(el));
    }

    static getHtml(id) {
        return document.getElementById(id).innerHTML;
    }
    static decodeHtml(html){
            var doc = new DOMParser().parseFromString(html, "text/html");
            return doc.documentElement.textContent;

    }
    static parseHTML(str) {
        let tmp = document.implementation.createHTMLDocument();
        tmp.body.innerHTML = str;
        return tmp.body.children;
    }

    static uniqueArray(arrArg) {
        return Array.from(new Set(arrArg));
    }

}

