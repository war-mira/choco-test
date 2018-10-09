class GridRow {
    constructor(grid = null, maxWidth = 4) {
        this.columns = new Map();
        this.instance = null; // DOMElement
        this.grid = grid;
        this.id = null;
        this.maxWidth = maxWidth; //4 items or 2 items with size 2 and etc.
        this.itemsWidth = 0;
        this.emptyWidth = 0;
        this.addAction = false;
        this.sortable = null;
        this.inActionColumn = null;
    }

    /**
     * Если row не null, то добавляем строку после этого row
     * @param container
     * @param row
     * @param id
     */
    add(container, row = null, id) {
        let block = this.getTemplate(id, this.maxWidth);
        block = GridHelper.parseHTML(block);
        block = block[0];
        if (row !== null) {
            row.parentNode.insertBefore(block, row.nextSibling);
        } else {
            container.appendChild(block);
        }
        this.instance = block;
        this.id = id;
        this.init();
        this.addColumn(this.maxWidth);
    }
    addFromRaw(container,row){
        let block = this.getTemplate(row.id, this.maxWidth);
        let _self = this;
        block = GridHelper.parseHTML(block);
        block = block[0];

        container.appendChild(block);
        this.instance = block;
        this.id = row.id;
        this.emptyWidth = row.emptyWidth;
        this.itemsWidth = row.itemsWidth;
        this.maxWidth = row.maxWidth;
        this.init();
        if(row.hasOwnProperty('columns')){
            row.columns.forEach(function(column){
                let grid_column = new GridColumn(_self,column.width);
                grid_column.addFromRaw(column);
                _self.addColumnToRow(column.id,grid_column)
            })
        }
    }

    addColumn(defaultColumnWidth = 1, addItem = false) {
        let id = this.getNewElementId();
        let column = new GridColumn(this, defaultColumnWidth);
        if (this.canAddColumn(column.getWidth())) {
            column.add(id,this.inActionColumn);
            this.addColumnToRow(id, column);
            this.setWidth(column.getWidth(), column.isEmpty());
            if (addItem) {
                if (this.grid.options.hasOwnProperty('defaultItem')) {
                    column.addItem(this.grid.options.defaultItem);

                }

            }
        } else {
            throw new Error('No space in row');
        }
        return column;
    }

    addColumnFromAnotherRow(column) {
        let new_id = this.getNewElementId();
        this.addAction = true;
        column.row = this;
        column.id = new_id;
        column.updateDataId();
        this.removeOrChangeEmptyColumn(column.getWidth());
        this.setWidth(column.getWidth(), column.isEmpty());
        this.addColumnToRow(new_id, column);
        this.addAction = false;
    }

    addColumnToRow(id, column) {
        this.columns.set(id, column);
    }

    addOrChangeEmptyColumn(times = 1,decreaseAction = false) {
        for (let i = 0; i < times; i++) {
            if (this.getAvailableWidth() > 0) {
                let emptyItem = this.hasEmptyColumns(decreaseAction);
                if (!emptyItem) {
                    this.addColumn(1);
                } else {
                    emptyItem.increaseWidth();
                }
            }
        }
    }

    canAddColumn(columnWidth) {
        let nextWidth = this.getAvailableWidth() - columnWidth;
        return nextWidth >= 0;
    }

    canChangeColumnWidth(decrease = false) {
        let available = this.getAvailableWidth();
        if (decrease) {
            if (this.addAction) {
                return true;
            }
            if ((available + 1) < this.maxWidth) {
                return true;
            }
        } else {
            if ((available - 1) >= 0) {
                return true;
            }
        }
        return false;
    }

    collapse(row) {
        let parent = row.closest('.grid__row');

        let content = function () {
            let block = row.find('.editable,textarea');
            if (block.length) {
                if (block.hasClass('editable')) {
                    return block.text().trim().substring(0, 70).replace(/[\r\n +(?= )]+/g, ' ');
                } else {
                    return block.val().trim().substring(0, 70).replace(/[\r\n +(?= )]+/g, ' ');
                }
            }
            return '';

        }();
        parent.find('.grid__row--move_title').html(content);
        parent.toggleClass('collapsed');
        if (parent.hasClass('collapsed')) {
            $('.collapse_all').attr('data-state', 1);
        }
        row.slideToggle();
    }

    collectColumnData(row) {
        let column = new GridColumn(this.grid);
        let _self = this;
        let columns = [];
        row.find('.grid__column').each(function () {
            columns.push(column.collectItemData($(this)));
        });
        return {
            'columns': columns
        };
    }

    getAvailableWidth() {
        return this.maxWidth - (this.itemsWidth);
    }

    getColumnById(id) {
        id = parseInt(id);
        return this.columns.get(id);
    }

    getNewElementId() {

        let keys = [...this.columns.keys()];
        if (keys.length > 0) {
            return Math.max(...keys) + 1;
        } else {
            return 1;
        }

    }

    getTemplate(id, columns = 4) {
        let template = `<div class="grid__row col_${columns}" data-id="${id}">
        <div class="white_background">
            <div class="grid__row--control">
                <div class="grid__row--move">
                    <i class="fa fa-arrows"></i>
                    <span class="grid__row--move_title"></span>
                </div>
                <div class="grid__row--remove"><i class="fa fa-trash"></i> Удалить ряд</div>
                <div class="grid__row--collapse"><i class="fa fa-caret-up"></i></div>
            </div>
            <div class="grid__row--container">
            </div>
        </div>
        <div class="grid__row--add">
            <div class="btn add-inblock" data-type="row"><i class="fa fa-plus"></i> Добавить ряд</div>
        </div>
    </div>`;
        return template.trim();
    }

    getTemplateId() {
        return 'rowBlock';
    }

    hasEmptyColumns(decreaseAction = false) {
        let has = false;
        let _self = this;
        let items = {
            'before':[],
            'after':[]
        };
        let arrName = 'before';
        this.columns.forEach(function(item){
            if(item == _self.inActionColumn){
                arrName = 'after';
            } else{
                items[arrName].push(item);
            }

        });
        for (let item of items.after ) {
            if (item.isEmpty()) {
                has = item;
                return has;
            } else{
                if(decreaseAction){
                    return false;
                }
            }

        }
        if(decreaseAction){
            if(!items.after.length){
                return false;
            }
        }

        for (let item of items.before) {
            if (item.isEmpty()) {
                has = item;
                return has;
            }
        }
        return has;

    }

    init() {
        this.initButtons();
        //this.initColumnSorting();
    }

    initButtons() {
        let _self = this;
        this.instance.addEventListener('click', function (event) {
            let target = event.target;
            if (target.matches('.grid__row--remove')) {
                _self.removeRow();
            }
        });
    }

    initColumnSorting() {
        let _self = this;


        let sortable = Sortable.create(_self.instance.querySelector('.grid__row--container'), {
            group: 'columns',
            animation: 150,
            ghostClass: "ghost",
            handle: ".grid__column--move", // Restricts sort start click/touch to the specified element
            draggable: ".grid__column", // Specifies which items inside the element should be sortable
            onMove: function (evt, originalEvent) {
                if(evt.to !== evt.from){
                    _self.hideOrResizeEmpty(evt);
                } else{
                    _self.removeTempWidth();
                }
            },
            onStart: function (evt) {
                _self._temp_sortOrder = _self.sortable.toArray();
            },
            onAdd: function (evt) {
                _self.moveColumnToAnotherRow(evt);
                _self._temp_sortOrder = null;
            },
            onSort: function (evt) {
                _self.updateColumnsOrder()
            },
            onEnd:function(evt){

              _self.removeTempWidth();

            }
        });

        this.sortable = sortable;
    }
    updateColumnsOrder(){
        this.sortColumns(GridHelper.arrayToSortPattern(this.sortable.toArray()));

    }
    removeTempWidth(rowInstance){
        this.grid.container.querySelectorAll('.grid__column.empty').forEach(function(item){
            item.removeAttribute('temp_width');
        })
    }
    hideOrResizeEmpty(event){

        let newRow = this.grid.getRowById(event.to.closest('.grid__row').getAttribute('data-id'));
        let item = event.dragged;
        let itemSize = parseInt(item.getAttribute('data-width'));
        let emptyColumn = newRow.hasEmptyColumns();
        let emptyColumnNewSize = emptyColumn.width - itemSize;
        if(emptyColumn){
            emptyColumn.instance.setAttribute('temp_width',emptyColumnNewSize)
        }

    }
    moveColumnToAnotherRow(e) {
        let oldRow = this.grid.getRowById(e.from.closest('.grid__row').getAttribute('data-id'));
        let newRow = this.grid.getRowById(e.target.closest('.grid__row').getAttribute('data-id'));
        let column = oldRow.getColumnById(e.item.getAttribute('data-id'));
        let clone = Object.assign(Object.create(Object.getPrototypeOf(column)), column);
        if (newRow.canAddColumn(column.getWidth())) {
            newRow.addColumnFromAnotherRow(column);
            oldRow.removeColumnToAnotherRow(clone);

        } else {
            this.reverseSortedColumn(e);
            console.warn('No free space in row');
            //throw new Error('No free space in row');
        }

    }

    removeColumnToAnotherRow(column) {
        this.columns.delete(column.id);
        this.setWidth(-column.getWidth(), column.isEmpty());
        for (let i = 0; i < column.getWidth(); i++) {
            this.addOrChangeEmptyColumn()
        }
        //Отсортировать добавленную колонку так, чтобы она встала на место перемещенного
        let oldSort = GridHelper.uniqueArray(this._temp_sortOrder);
        let removedIndex = GridHelper.getFilterd(oldSort, this.sortable.toArray()).join();
        let newIndex = GridHelper.getFilterd(this.sortable.toArray(), this._temp_sortOrder).join();
        oldSort = oldSort.map(function (name) {
            if (name == removedIndex) {
                return newIndex;
            } else {
                return name;
            }
        });
        this.sortable.sort(oldSort);
    }

    removeOrChangeEmptyColumn(times = 1) {
        for (let i = 0; i < times; i++) {
            let emptyItem = this.hasEmptyColumns();
            if (emptyItem) {
                if (this.emptyWidth == 1) {
                    emptyItem.removeColumn();
                    this.emptyWidth = 0;
                } else {
                    if (emptyItem.getWidth() == 1) {
                        emptyItem.removeColumn();
                    } else {
                        emptyItem.decreaseWidth();
                    }
                }
            }
        }
    }

    removeRow() {
        let removeConfirm = confirm('Are you sure to delete?');
        if (removeConfirm) {
            this.instance.remove();
            this.grid.rows.delete(this.id);
        }
        return false;
    }

    reverseSortedColumn(e) {
        let oldRow = this.grid.getRowById(e.from.closest('.grid__row').getAttribute('data-id'));
        e.from.appendChild(e.item);
        oldRow.sortable.sort(oldRow._temp_sortOrder);

    }

    setWidth(columnWidth, emptyItem) {
        if (emptyItem) {
            this.emptyWidth += columnWidth;
        } else {
            this.itemsWidth += columnWidth;
        }

    }

    sortColumns(pattern) {
        this.columns = new Map([...this.columns.entries()].sort(function (x, y) {
            return pattern[x[0]] - pattern[y[0]];
        }));
    }
    getObject(){
        let columns = [];
        this.columns.forEach(function (column) {
           columns.push(column.getObject());
        });
        return {
            columns:columns,
            id: this.id,
            maxWidth: this.maxWidth,
            itemsWidth: this.itemsWidth,
            emptyWidth: this.emptyWidth,
        }
    }
}