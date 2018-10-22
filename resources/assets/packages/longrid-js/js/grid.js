/**
 * columns can be 2 to 12
 */
class Grid {
    constructor(options) {
        this.rows = new Map();
        this.container = options.container;
        this.raw = options.raw;
        this.sortable = null;
        this.options = {
            columns: 6,
            defaultItem: 'text'
        };
        Object.assign(this.options, options.other);
        this.items = {
            'text': TextElement,
            'image': ImageElement,
            'frame': FrameElement,
            'quote': QuoteElement,
        };

    }

    addItem(name, instance_class) {
        let instance = new instance_class(null,null);
        if(!(instance instanceof AbstractElement)){
            throw new Error(`${name} should be instanceof AbstractElement`);
        }
        this.items[name] = instance_class;
    }

    addRowBlock() {
        let row = new GridRow(this, this.options.columns);
        let id = this.getNewElementId();
        row.add(this.container, null, id);
        this.addRowToGrid(id, row);
    }

    addRowBlockAfter(item) {
        let row = new GridRow(this, this.options.columns);
        let id = this.getNewElementId();
        row.add(this.container, item, id);
        this.addRowToGrid(id, row);
        this.sortRows(GridHelper.arrayToSortPattern(this.sortable.toArray()));
    }

    addRowToGrid(id, row) {
        this.rows.set(id, row);
        Grid.triggerSave();
    }

    getCleanClone() {
        let clone = Object.assign(Object.create(this), this);
        let rows = [];
        clone.rows.forEach(function (row, index) {
            rows.push(row.getObject())
        });
        clone.rows = rows;
        delete clone.sortable;
        delete clone.raw;
        delete clone.items;
        clone.container = clone.container.id;
        return clone;
    }

    getNewElementId() {
        let keys = [...this.rows.keys()];
        if (keys.length > 0) {
            return Math.max(...keys) + 1;
        } else {
            return 1;
        }
    }

    getRowById(id) {
        id = parseInt(id);
        return this.rows.get(id)
    }

    init() {
        if(this.hasRaw()){
            this.initRaw();
        }
        //console.log('hello');
        this.initButtons();
        this.initSortable();
        // this.initRowIcons();
    }
    initRaw(){
        let raw = JSON.parse(this.raw);
        let _self = this;
        if(raw.hasOwnProperty('rows')){
            this.checkRawOptions(raw);
            raw.rows.forEach(function(row){
                let grid_row = new GridRow(_self,_self.options.columns);
                grid_row.addFromRaw(_self.container, row);
                _self.addRowToGrid(row.id, grid_row);
            });
        }
    }
    checkRawOptions(raw){
        if(this.container.id !== raw.container){
            console.warn('wrong container ID');
        }
        if(this.options.columns !== raw.options.columns){
            throw new Error(`This JSON has ${raw.options.columns} columns scheme, when Grid has ${this.options.columns} columns`);
        }
    }
    hasRaw(){
        try{
            let r = JSON.parse(this.raw);
            if(r.hasOwnProperty('rows')){
                return true;
            } else{
                return false
            }
        } catch(err){
            console.warn(err);
            return false
        }
    }
    initButtons() {
        let _self = this;
        document.querySelector('.grid__maker').addEventListener('click', function (event) {
            let target = event.target;
            if (target.matches('.add-block')) {
                _self.addRowBlock();
            }
            if (target.matches('.add-inblock')) {
                _self.addRowBlockAfter(target.closest('.grid__row'));
            }
        });

    }

    initSortable() {
        let _self = this;
        let container = document.querySelector("#grid__container");
        let sort = Sortable.create(container, {
            animation: 250, // ms, animation speed moving items when sorting, `0` — without animation
            scrollSpeed: 10,
            scrollSensitivity: 70,
            handle: ".grid__row--move", // Restricts sort start click/touch to the specified element
            draggable: ".grid__row", // Specifies which items inside the element should be sortable
            onSort: function (evt) {
                _self.sortRows(GridHelper.arrayToSortPattern(_self.sortable.toArray()));

            }
        });
        this.sortable = sort;

    }


    sortRows(pattern) {
        this.rows = new Map([...this.rows.entries()].sort(function (x, y) {
            return pattern[x[0]] - pattern[y[0]];
        }));
        Grid.triggerSave();
    }
    static triggerSave(){
        document.dispatchEvent(new CustomEvent('updateGridTextarea'));
    }
    toJson() {
        return JSON.stringify(this.getCleanClone());
    }


}