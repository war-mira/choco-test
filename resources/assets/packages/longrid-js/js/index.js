class Longread{
    constructor(){
        this.data = {};
        this.grid = null;
        this.textarea = document.querySelector('#grid__textarea');
    }
    initButtons(){

    }
    init(){
        Dropzone.autoDiscover = false;

        this.grid =  new Grid({
            container:document.getElementById('grid__container'),
            raw:this.textarea.innerHTML
        });
        this.grid.init();
        this.initButtons();
        document.addEventListener("updateGridTextarea", (e) => this.save())
    }

    save(){
        let _self = this;
        this.textarea.innerHTML = this.grid.toJson();

    }
}


    let longridMaker = new Longread();
    longridMaker.init();
