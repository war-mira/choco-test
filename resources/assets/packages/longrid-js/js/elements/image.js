class ImageElement extends AbstractElement {
    constructor(id, column) {
        super();
        this.column = column;
        this.instance = null;
        this.id = id;
        this.type = 'image';
        this.content = '';
        this.state = 'default';
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
            'content': this.content,

        }

    }

    addFromRaw(item) {
        //TODO: implement
    }

    init() {
        this.initControlButtons();
    }

    initControlButtons() {
        let _self = this;
        this.initMedium();
        this.initImageUpload();
        document.addEventListener('click', function (event) {
            let target = event.target;
            if (target.matches('.grid__item--image .image__placeholder .remove')) {
                _self.removeImage(target.closest('.grid__item--image'));
            }
        });
        this.instance.addEventListener('click',function(event){
            let target  = event.target;
            if (target.matches('.grid__item--control_item')) {
                target.parentNode.querySelectorAll('.grid__item--control_item').forEach((item) => item.classList.remove('active'));
                target.classList.add('active');
            }
        });

    }

    getHtmlBlock(id, content = '') {
        let block = this.getTemplate(id, content);
        block = GridHelper.parseHTML(block);
        return block[0];
    }

    static initFromHtml() {
        let _self = new ImageElement();
        _self.initControlButtons();
        _self.initImageUpload();
    }

    initImageUpload() {
        this.dropzone = new Dropzone(this.instance.querySelector('.image__placeholder .preview'), {
            url: "/ajax/image/upload",
            addRemoveLinks:true,
            maxFilesize: 10,
            maxFiles: 1,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        /**
         *

        $('.add-image').fileupload({
            dataType: 'json',
            start: function (e) {
                console.log('init');
                $(this).closest('.grid__item').find('.image__placeholder').addClass('__loading');
            },
            done: function (e, data) {
                // $(this).parent().find('input').hide();
                let container = $(this).closest('.grid__item').find('.image__placeholder');
                container.removeClass('__loading');
                container.addClass('imageAdded');
                container.find('.preview').html('');
                container.find('.preview').append('<img src="' + data.result + '" />');
            },
            fail: function (e, data) {
                alert('failed');
                console.log(data);
            }
        })
         */
    }

    removeImage(container) {
        let src = container.find('img').attr('src');
        container.find('.image__placeholder').removeClass('imageAdded');
        container.find('.preview').html('');
        $.get("/admin.php/pages/longrid/remove-media?url=" + src, function (data) {
        });

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

    getStates(){
        let states = '';
        let _self = this;
        for(let state in this.states){

            states += `<div class="grid__item--control_item ${(state == _self.state)?'active':''}" data-type="${state}">${this.states[state]}</div>`;
        }
        return states;
    }
    getTemplate(id, image = '',content = '') {
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
                        <div class="image__placeholder imageAdded dropzone">
                            <div class="preview">
                                <img src="${this.image}"> 
                            </div>
                        </div>
                        <div class="editable">
                            ${this.content} 
                        </div>

                `;
            } else {
                template +=` 
                        <div class="image__placeholder dropzone">
                            <div class="preview"></div>
                        </div>
                        <div class="editable">
                        </div>`;
            }

            return template;
    }

    initMedium(placeholder = 'Введите текст...'){
        let selector = this.instance.querySelector('.editable');
        this.editor = new MediumEditor(selector,{
            toolbar: {
                /* These are the default options for the toolbar,
                 if nothing is passed this is what is used */
                allowMultiParagraphSelection: true,
                buttons: [
                    'h2',
                    'h3',
                    'h4',
                    'anchor',
                    'h5',
                    'h6',
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
    }
}