class GridColumn {
    constructor(row, width = 1) {
        this.items = new Map();
        this.row = row;
        this.instance = null;
        this.width = width;
        this.id = null;
    }
    getObject(){
        let items = [];
        this.items.forEach(function(item){
            items.push(item.getObject());
        });

        return {
            items:items,
            width:this.getWidth(),
            empty:this.isEmpty(),
            id:this.id
        };
    }
    add(id,column = null) {
        let row = this.row.instance.querySelector('.grid__row--container');
        let block = this.getTemplate(id);
        block = GridHelper.parseHTML(block);
        this.instance = block[0];
        if (column !== null) {
            column.instance.parentNode.insertBefore(this.instance, column.instance.nextSibling);
        } else {
            row.appendChild(this.instance);
        }


        this.id = id;
        this.init();
        Grid.triggerSave();

    }
    addFromRaw(column){
        let _self = this;
       // let empty = column.items.length?false:true;
        let block = this.getTemplate(column.id,column.empty);
        block = GridHelper.parseHTML(block);
        block = block[0];
        let row = this.row.instance.querySelector('.grid__row--container');
        row.appendChild(block);
        this.instance = block;
        this.id = column.id;
        this.init();

        if(column.hasOwnProperty('items')){
            column.items.forEach(function(item){
                let className = _self.getGrid().items[item.type];
                let instance = new className(item.id,_self);
                instance.addFromRaw(item);
                instance.addIcon();
                _self.addItemsToColumn(item.id,instance);
            })
        }
    }


    addItem(type) {
        let classInstance = this.getGrid().items[type];
        let id = this.getNewElementId();
        let item = new classInstance(id,this);
        let block = item.getHtmlBlock(id);
        let container = this.instance.querySelector('.grid__column--container');
        container.innerHTML = '';
        container.appendChild(block);
        item.instance = block;
        item.init();
        item.addIcon();
        this.addItemsToColumn(id,item);
        this.changeColumnStatus();

    }

    addItemsToColumn(id, item) {
        this.items.set(id, item);
    }

    changeColumnStatus() {
        this.instance.classList.remove('empty');
        this.row.emptyWidth -= this.getWidth();
        this.row.itemsWidth += this.getWidth();
    }

    changeDataWidth() {
        this.instance.setAttribute('data-width', this.width);
    }

    decreaseWidth() {
        this.row.inActionColumn = this;
        if (this.width - 1 <= 0) {
            throw new Error(`can't decrease`);
            return false;
        } else {

        }
        if (this.row.canChangeColumnWidth(true) || this.row.addAction) {
            this.width = this.width - 1;
            this.row.setWidth(-1, this.isEmpty());
            if (!this.isEmpty()) {
                this.row.addOrChangeEmptyColumn(1,true)
            }
        } else {
            throw new Error(`can't change column width to -`);
        }
        this.changeDataWidth();
        this.row.inActionColumn = null;
    }

    getColumnItems() {
        let items = this.getGrid().items;
        let template = ``;
        for (let item in items) {
            if (items.hasOwnProperty(item)) {
                let instance = items[item];
                template += ` <div class="grid__column--add_item" data-type="${item}" title="${instance.getTitle()}" >
                       ${instance.getIcon()}
                    </div>`;
            }
        }
        return template;
    }

    getNewElementId() {

        let keys = [...this.items.keys()];
        if (keys.length > 0) {
            return Math.max(...keys) + 1;
        } else {
            return 1;
        }

    }
    getGrid() {
        return this.row.grid;
    }

    getTemplate(id,empty = true) {
        let _self = this;
        let template = ` <div class="grid__column ${empty?'empty':''}" data-width="${_self.getWidth()}" data-id="${id}">
        <div class="grid__column--control"> 
            <div class="grid__column--move">
                <i class="fa fa-arrows"></i>
            </div>
             <div class="grid__column--action" data-action="decreaseWidth">
                -
            </div> 
            <div class="grid__column--action" data-action="increaseWidth">
               +
            </div>
             <div class="grid__column--action" data-action="removeColumn">
                <i class="fa fa-trash"></i>
            </div>
        </div>
        <div class="grid__column--container">
           
            <div class="empty"> 
                <div class="items__list">
                    ${_self.getColumnItems()}                   
                </div>
                <div class="select__item">

                </div>

            </div>
        </div>
    </div>`;
        return template.trim();
    }

    getTemplateId() {
        return 'columnBlock';
    }

    getWidth() {
        return this.width;
    }

    increaseWidth() {
        this.row.inActionColumn = this;
        if (this.width + 1 > this.row.maxWidth) {
            throw new Error(`can't increase`);
            return false;
        }
        if (this.row.canChangeColumnWidth()) {
            this.width = this.width + 1;
            this.row.setWidth(1, this.isEmpty());
            if (!this.isEmpty()) {
                this.row.removeOrChangeEmptyColumn()
            }
        } else {
            throw new Error(`can't change column width to +`);
        }
        this.changeDataWidth();
        this.row.inActionColumn = null;
    }

    init() {
        this.initButtons();
    }

    initButtons() {
        let _self = this;

        this.instance.addEventListener('click', function (event) {
            let target = event.target;
            if (target.matches('.grid__column--add_item')) {
                _self.addItem(target.getAttribute('data-type'));
            }

            if (target.matches('.grid__column--action')) {
                let action = target.getAttribute('data-action');
                if (_self[action] instanceof Function) {
                    if (['increaseWidth', 'decreaseWidth'].includes(action)) {
                        if (!_self.isEmpty()) {
                            _self[action](target);
                        }
                    } else {
                        _self[action](target);
                    }
                }
            }
            Grid.triggerSave();
            //_self.row.updateColumnsOrder();
        });
    }

    isEmpty() {
        return this.instance.classList.contains('empty');
    }

    removeColumn() {
        if (!this.isEmpty()) {
            let removeConfirm = confirm('Are you sure to delete?');
            if (!removeConfirm) {
                return false;
            }
            this.row.setWidth(-this.getWidth());
            //Save Old Sorting
            //let oldSort = GridHelper.uniqueArray(this.row.sortable.toArray());

            let emptyColumn = this.row.addColumn(this.getWidth());
            this.instance.parentNode.replaceChild(emptyColumn.instance, this.instance);
            //Fix this.row.columns ordering
            //this.orderRowColumns(emptyColumn, oldSort,this.id,emptyColumn.id);
        } else {
            this.instance.remove();
        }
        this.row.columns.delete(this.id);
        Grid.triggerSave();
    }

    orderRowColumns(emptyColumn, oldSort,removedIndex,newIndex) {
        oldSort = oldSort.map(function (name) {
            if (name == removedIndex) {
                return newIndex;
            } else {
                return name;
            }
        });
        this.row.sortColumns(GridHelper.arrayToSortPattern(oldSort));
    }

    updateDataId() {
        this.instance.setAttribute('data-id', this.id);
    }
}