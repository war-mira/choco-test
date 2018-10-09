class Longread{
    constructor(){
        this.data = {};
        this.grid = null;
        this.textarea = document.querySelector('#grid__textarea');
    }
    initButtons(){

    }
    init(){
        this.grid =  new Grid({
            container:document.getElementById('grid__container'),
            raw:this.textarea.innerHTML
        });
        this.grid.init();
        this.initButtons();
    }

    save(){
        let _self = this;

    }
}


    let longridMaker = new Longread();
    longridMaker.init();
