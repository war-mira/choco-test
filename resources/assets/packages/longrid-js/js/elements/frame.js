class FrameElement extends AbstractElement{
    constructor(id = null,column= null) {
        super();
        this.column = column;
        this.instance = null;
        this.id = id;
        this.type = 'frame';
        this.content = null;
    }
    static getIcon() {
        return '<i class="fa fa-code"></i>';
    }
    addFromRaw(item){
        let id = this.column.getNewElementId();
        //  let content = (new Unescape).do(item.content);
        let content = Unescape(item.content);
        //let content = GridHelper.decodeHtml(item.content);
        let block = this.getHtmlBlock(id,content);
        let container = this.column.instance.querySelector('.grid__column--container');
        container.innerHTML = '';
        container.appendChild(block);
        this.instance = block;
        this.init();
    }
    addIcon() {
        let icon = FrameElement.getIcon();
        let html = GridHelper.parseHTML('<div class="grid__row--icon">' + icon + '</div>')[0];
        let controls = this.instance.closest('.grid__column').querySelector('.grid__column--control');
        controls.insertBefore(html, controls.firstChild);
    }
    getHtmlBlock(id,content = ''){
        let block = this.getTemplate(id,content);
        block = GridHelper.parseHTML(block);
        return block[0];
    }

    getTemplate(id,content = ''){
        return `<div class="grid__item" data-type="frame" data-id="${id}">
            <div class="grid__item--frame">
                <textarea>${content}</textarea>
            </div>
        </div>`;
    }
    static getTitle() {
        return "iFrame/HTML";
    }
    init() {

    }
    getObject() {
        return {
            type:'frame',
            id:this.id,
            content:this.instance.querySelector('textarea').value
        }
    }

}