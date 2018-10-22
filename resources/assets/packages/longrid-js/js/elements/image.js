class ImageElement extends AbstractElement {
    constructor(id, column) {
        super();
        this.column = column;
        this.instance = null;
        this.id = id;
        this.type = 'image';
        this.desc = '';
        this.alt = '';
        this.state = 'default';
        this.editors = new Map();
        this.image = null;
        this.states = {
            default: "Обычный",
            left : 'Слева',
            right : 'Справа',
        };

        this.dropzone = null;
    }

    static getIcon() {
        return '<i class="fa fa-image"></i>';
    }

    static getTitle() {
        return "Изображение";
    }

    getObject() {
        return {
            'type': this.type,
            'id': this.id,
            'state': this.state,
            'image': this.image,
            'desc': this.desc,
            'alt': this.alt,

        }

    }

    addFromRaw(item) {
        let id = this.column.getNewElementId();
        //  let content = (new Unescape).do(item.content);
        this.alt = Unescape(item.alt);
        this.desc = Unescape(item.desc);
        this.image = item.image;
        this.state = item.state;
        //let content = GridHelper.decodeHtml(item.content);
        let block = this.getHtmlBlock(id);
        let container = this.column.instance.querySelector('.grid__column--container');
        container.innerHTML = '';
        container.appendChild(block);
        this.instance = block;
        this.init();
    }

    init() {
        this.initControlButtons();
    }

    initControlButtons() {
        let _self = this;
        this.initMedium('.image_alt','Alt,title etc.');
        this.initMedium('.image_desc','Описание');
        this.initImageUpload();

        this.instance.addEventListener('click',function(event){
            _self.updateState(event);
        });

    }


    getHtmlBlock(id) {
        let block = this.getTemplate(id);
        block = GridHelper.parseHTML(block);
        return block[0];
    }

    static initFromHtml() {
        let _self = new ImageElement();
        _self.initControlButtons();
        _self.initImageUpload();
    }

    initImageUpload() {
        let _self = this;

        this.dropzone = new Dropzone(this.instance.querySelector('.image__placeholder .preview'), {
            url: "/ajax/image/upload",
            addRemoveLinks:true,
            maxFilesize: 10,
            thumbnailWidth:300,
            maxFiles: 1,
            success:function(file, response){
                _self.image = response.src;
                Grid.triggerSave();
            },
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        if(this.image !== null){
            let mock = {name:"",size:1,accepted:true};
            this.dropzone.emit("addedfile", mock);
            this.dropzone.emit("thumbnail", mock, this.image);
            this.dropzone.emit("complete", mock);
            this.dropzone.files.push(mock);
            this.dropzone._updateMaxFilesReachedClass();
        }

    }

    removeImage(container) {

    }

    addIcon() {
        let icon = ImageElement.getIcon();
        let html = GridHelper.parseHTML('<div class="grid__row--icon">' + icon + '</div>')[0];
        let controls = this.instance.closest('.grid__column').querySelector('.grid__column--control');
        controls.insertBefore(html, controls.firstChild);
    }

    getTemplateId() {
        return 'imageBlock';
    }


    getTemplate(id) {
        return `
            <div class="grid__item" data-type="image"  data-id="${id}">
                <div class="grid__item--control">
                    <div class="left">
                                 
                    </div>
                    <div class="main">
                        ${this.getStates()}
                    </div>
                </div>
                <div class="grid__item--image ">
                  ${this.getImageTemplate()}
                </div>
            </div>`;
    }
    getImageTemplate(){
        let template = '';
            if(this.image !== null){
                template +=`
                        <div class="image__placeholder dropzone">
                            <div class="preview">
                               
                            </div>
                        </div>
                        <div class="editable image_alt">
                            ${this.alt} 
                        </div>
                        <div class="editable image_desc">
                            ${this.desc}  
                        </div>

                `;
            } else {
                template +=` 
                        <div class="image__placeholder dropzone">
                            <div class="preview"></div>
                        </div> 
                        <div class="editable image_alt">
                        </div>
                        <div class="editable image_desc">
                        </div>`;
            }

            return template;
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
                    'anchor',
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
            if(class_name == '.image_alt'){
                _self.alt = content;
            } else{
                _self.desc = content;
            }
            Grid.triggerSave();
        });
        this.editors.set(class_name,editor)
    }

}