class QuoteElement extends AbstractElement{
    getTemplateId(){
        return 'quoteBlock';
    }
    getObject(item){
        return {
            'type':item.data('type'),
            'content':item.find('.editable').html()
        }
    }
}