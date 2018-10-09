class GalleryElement extends AbstractElement {

    init(container) {
        this.initControlButtons();
        this.initImageUpload();
        this.container = container.find('.grid__item--gallery').get(0);
        this.initSortable();
    }

    getItemTemplate() {
        return '<div class="grid__item--gallery__item empty">\n' +
            '            <div class="image__placeholder">\n' +
            '            </div>\n' +
            '            <div class="editable"></div>\n' +
            '            <div class="grid__btn remove"><i class="fa fa-trash"></i> Удалить фото</div>\n' +
            '        </div>';
    }

    initImageUpload() {
        let _self = this;
        $('.add-images').fileupload({
            dataType: 'json',
            add: function (e, data) {
                let self =  $(this);
                $.each(data.files, function (index, file) {
                    _self.createPlaceholder(self);
                });
                if (e.isDefaultPrevented()) {
                    return false;
                }
                if (data.autoUpload || (data.autoUpload !== false &&
                        $(this).fileupload('option', 'autoUpload'))) {
                    data.process().done(function () {
                        data.submit();
                    });
                }
            },
            done: function (e, data) {
                // $(this).parent().find('input').hide();
                _self.addImagesToContainer($(this), data);
            },
            fail: function (e, data) {
                alert('failed');
                console.log(data);
            }
        })
    }
    static initFromHtml(){
        let _self = new GalleryElement();
        _self.initControlButtons();
        _self.initImageUpload();
        $('.grid__item--gallery').each(function(){
            _self.initSortable($(this).get(0));
        });
    }
    initSortable(container = null){
        let _self = this;
        let _container;
        if(container === null){
             _container = _self.container;
        } else{
             _container = container;
        }

        let sort = Sortable.create(_container, {
            animation: 150, // ms, animation speed moving items when sorting, `0` — without animation
            scrollSpeed: 10,
            scrollSensitivity: 70,
            handle: ".image__placeholder", // Restricts sort start click/touch to the specified element
            draggable: ".grid__item--gallery__item", // Specifies which items inside the element should be sortable
        });
    }
    createPlaceholder(self) {
        let item = $.parseHTML(this.getItemTemplate())[0];
        item = $(item);
         self.closest('.grid__row').find('.grid__item--gallery').append(item);
        this.initMedium('Описание фото...');
    }

    addImagesToContainer(self, data) {
       let block = self.closest('.grid__row').find('.grid__item--gallery__item.empty').first();
       block.removeClass('empty');
       block.find('.image__placeholder').append('<img src="' + data.result + '" />');
    }

    initControlButtons() {
        let _self = this;
        $(document).on("click",'.grid__item--gallery__item .remove',function(){
            _self.removeImage($(this).closest(".grid__item--gallery__item"));
        });
    }
    removeImage(container){
        let src = container.find('img').attr('src');
        $.get( "/admin.php/pages/longrid/remove-media?url="+src, function( data) {
        });
        container.remove();
    }

    getTemplateId(){
        return 'galleryBlock';
    }
    getItemsObject(item){
        let items = [];
        item.find('.grid__item--gallery__item').each(function(){
            items.push({
                'image':$(this).find('.image__placeholder img').attr('src'),
                'content':$(this).find('.editable').html()
            })
        });
        return items;
    }
    getObject(item) {
        return {
            'type': item.data('type'),
            'items': this.getItemsObject(item),
        }
    }
}