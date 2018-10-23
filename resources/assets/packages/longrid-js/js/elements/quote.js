class QuoteElement extends AbstractElement {
    constructor(id,column) {
        super();
        this.column = column;
        this.instance = null;
        this.id = id;
        this.type = 'quote';
        this.editors = new Map();
        this.state = 'citate';
        this.states = {
            citate: "Цитата",
            important : 'Важно!',
        };
        this.content = '';
        this.credits = '';
    }

    addFromRaw(item){
        let id = this.column.getNewElementId();
        this.state = item.state;
        this.content = Unescape(item.content);
        this.credits = Unescape(item.credits);
        //  let content = (new Unescape).do(item.content);
        //let content = GridHelper.decodeHtml(item.content);
        let block = this.getHtmlBlock(id);
        let container = this.column.instance.querySelector('.grid__column--container');
        container.innerHTML = '';
        container.appendChild(block);
        this.instance = block;
        this.init();
    }
    static getIcon() {
        return '<i class="fa fa-quote-right"></i>';
    }

    getObject() {
        return {
            type:'quote',
            id:this.id,
            state: this.state,
            content:this.content,
            credits:this.credits
        }
    }

    addIcon() {
        let icon = TextElement.getIcon();
        let html = GridHelper.parseHTML('<div class="grid__row--icon">' + icon + '</div>')[0];
        let controls = this.instance.closest('.grid__column').querySelector('.grid__column--control');
        controls.insertBefore(html, controls.firstChild);
    }
    getTemplateId() {
        return 'quoteBlock';
    }
    getHtmlBlock(id){
        let block = this.getTemplate(id);
        block = GridHelper.parseHTML(block);
        return block[0];
    }
    getTemplate(id){
        return `<div class="grid__item" data-type="quote" data-id="${id}">
            <div class="grid__item--control">
                    <div class="main">
                        ${this.getStates()}
                    </div> 
                </div>
            <div class="grid__item--quote">
                <div class="editable content">
                ${this.content}
                </div> 
                <div class="editable credits">
                ${this.credits}
                </div>
            </div>
        </div>`;
    }
    static getTitle() {
        return "Цитата/Важно";
    }

    init() {
        this.initMedium('.content','Текст цитаты');
        this.initMedium('.credits','Автор цитаты');
        this.instance.addEventListener('click',()=>{
            this.updateState(event, this);
        });
    }
    initMedium(class_name ='.editable',placeholder = 'Введите текст...'){
        let _self =this;
        let selector = this.instance.querySelector(class_name);
        let editor = new MediumEditor(selector,{
            toolbar: {
                /* These are the default options for the toolbar,
                 if nothing is passed this is what is used */
                allowMultiParagraphSelection: true,
                buttons: [
                    'italic',
                    {
                        name: 'anchor',
                        contentDefault: '<i class="fa fa-link"></i>'
                    },
                    'justifyLeft',
                    'justifyCenter',
                    'justifyRight',
                    'removeFormat'
                ],
                diffLeft: 0,
                diffTop: -10,
                firstButtonClass: 'medium-editor-button-first',
                lastButtonClass: 'medium-editor-button-last',
                standardizeSelectionStart: false,
                static: false,
                relativeContainer: null,
                /* options which only apply when static is true */
                align: 'center',
                sticky: false,
                updateOnEmptySelection: false
            },
            placeholder: {
                text: placeholder,
                hideOnClick: true
            },
            imageDragging: false
        });
        editor.subscribe('editableInput', function (event, editorElement) {
            let content = editor.getContent();
            if(class_name == '.content'){
                _self.content = content;
            } else{
                _self.credits = content;
            }
            Grid.triggerSave();
        });
        this.editors.set(class_name,editor)
    }
}