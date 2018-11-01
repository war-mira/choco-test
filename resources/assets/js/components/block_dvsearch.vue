<template>
    <div class="dv-search-widget" :class="{'filters-opened':search_autocomplete}">
        <div class="dv-autocomplete">
            <div style="display: flex">
                <div v-for="tag in selectedTags"
                     class="dv-tag"
                     :class="{'tag-fixed':tag.fixed}"
                     @click="removeTag(tag)"
                >
                    {{ tag.value }}
                </div>
                <!--<div class="dv-tag-action" v-if="count==1">Перейти к врачу? </div>-->
            </div>

            <input type="text"
                   v-model="search"
                   class="form-control input-sm search-line"
                   :placeholder="search_placeholder"
                   id="dvSearch"
                   @focus="select_focused = true"
                   @blur="select_focused = false"
                   @keyup.enter="selectTag(focused_proposal)"
                   @keyup.tab="selectTag(focused_proposal)"
                   @keyup.esc="handleEsc"
                   @keyup.space="handleSpace"
                   @keyup.delete="handleDel"
                   @keydown.down="focused_proposal = +1"
                   @keydown.up="focused_proposal   = -1"
            >
            <transition name="search">
                <a :href="searchResults_hash!=''?'https://idoctor.kz/'+city+'/doctors?hash='+searchResults_hash:'#'"
                   :class="{'hidden-btn':!can_search}"
                   class="search-btn"
                   target="_blank"
                   v-if="can_search"
                >НАЙТИ</a>
            </transition>

        </div>
        <div class="search-proposals" v-if="search_autocomplete">
            <div class="search-proposals-inner" >
                <div style="width: 100%">
                    <div>
                        <div style="padding-bottom:20px">
                            {{ hint }}
                        </div>
                        <!--<a :href="searchResults_hash!=''?'https://idoctor.kz/almaty/doctors?hash='+searchResults_hash:'#'"-->
                           <!--class="btn btn-sm btn-success"-->
                           <!--v-if="count==1"-->
                           <!--target="_blank"-->
                        <!--&gt;Да</a>-->
                        <div v-if="additional_results">
                                    <span class="hint_tag btn-warning"
                                          v-for="result in additional_results"
                                          @click="selectTag(result)"
                                    >{{ result.value }}</span>
                        </div>
                    </div>
                    <div class="search-group">
                        <div style="flex-grow: 1" v-if="left_results">
                            <div v-for="(group,key) in left_results">
                                <div class="propose-group-header">{{ field_names[key] }}:</div>
                                <div class="propose"
                                     v-for="result in group.items"
                                     @click="selectTag(result)"
                                     @mouseOver="focusProposal(result)"
                                     :class="{'focused-proposal':focused_proposal==result}"
                                >
                                    {{ result.value }}
                                    <transition name="fade">
                                        <strong v-if="result.count"> {{ result.count }}</strong>
                                    </transition>
                                </div>
                            </div>

                        </div>
                        <div style="flex-grow: 1" v-if="right_results">
                            <div v-for="(group,key) in right_results">
                                <div class="propose-group-header">{{ field_names[key] }}:</div>
                                <div class="propose"
                                     v-for="result in group.items"
                                     @click="selectTag(result)"
                                     @mouseOver="focusProposal(result)"
                                     :class="{'focused-proposal':focused_proposal==result}"
                                >
                                    {{ result.value }}
                                    <transition name="fade">
                                        <strong v-if="result.count"> {{ result.count }}</strong>
                                    </transition>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                // model: 'Doctor',
                autocomplete: {
                    'name':[],
                    'firstname':[],
                    'patronymic':[],
                    'lastname':[],
                    'skills':[],
                    'illnesses':[],
                    'qualifications':[],
                    'medcenters':[],
                    'additional':[],
                    // 'city':[],
                },
                field_names:{
                    skills:'Специализация',
                    name:'Врач',
                    firstname:'Имя',
                    lastname:'Фамилия',
                    patronymic:'Отчество',
                    illnesses:'Заболевание',
                    qualifications:'Категория',
                    medcenters:'Клиника',
                    additional:'',
                    city:'Город',
                },
                // predefined: [
                //     {
                //         model:'Doctor',
                //         attrib:'city',
                //         value:'Алматы',
                //         fixed:true
                //     }
                // ],


                search:'',
                select_focused:false,

                count:null,
                searchResults:[],
                searchResults_hash:'',

                focused_proposal_index:0,

                selectedTags:[],
                topTags:[],
            }
        },
        mounted:function () {
            socket.emit('search prepare set',this.model);

            socket.on('search results count',function (msg) {
                this.count = msg;
            }.bind(this));

            socket.on('search top tags',function (msg) {
                this.topTags = msg? msg:[];
            }.bind(this));

            socket.on(`search filtered results`,function (msg) {
                this.searchResults_hash = msg.hash;
                this.count = msg.count
            }.bind(this));

            socket.on('search autocomplete',function (msg) {
                this.receiveAutocomplete(msg)
            }.bind(this));

            this.predefined.every(function (item) {
                this.selectTag(item)
            }.bind(this))
        },
        watch:{
            search:function (val,old) {
                if(val===''){
                    document.querySelector('#dvSearch').focus();
                }

                if(val.length>=2)
                    this.search_in.forEach(function (field) {
                        socket.emit('search inserting',val,[field],this.model,this.selectedTags);
                    }.bind(this));
            },
            selectedTags: function (val, old) {
                this.search = '';

                if(val.length === 0){
                    socket.emit('search prepare set',this.model);
                }
                else
                    this.applyFilters();
            },
            results:function(val,old){
                if(val && val.length>0)
                    this.focused_proposal_index = 0
            }
        },
        computed:{
            city:function () {
                return  this.model.split('-')[1];
            },
            focused_proposal:{
                get:function () {
                    if(this.results && this.results.length > this.focused_proposal_index)
                        return this.results[this.focused_proposal_index];
                    return {};
                },
                set:function (val) {
                    val = this.focused_proposal_index + val;

                    if(val<this.results.length) this.focused_proposal_index = val;
                    if(val<0) this.focused_proposal_index=0;
                }
            },
            search_in:{
                get:function () {
                    return Object.keys(this.autocomplete);
                },
                set:function (val) {
                    // Todo: search state
                }
            },
            results:function () {
                if(this.search==='')
                    return [];

                // if(this.diffTags && this.diffTags.length>0)
                //     return this.diffTags;

                // if(this.leftTags && this.leftTags.length>0)
                //     return this.leftTags;

                return collect(this.autocomplete).transform(function (set) {
                    return set.data
                }).flatten(1).sortBy('distance').all();
            },

            can_search:function(){
                //if(this.search === '' && this.selectedTags.length === 0)
                    //return true;
                if(!this.select_focused && this.search==='')
                    return true;

                return this.search === '' && this.selectedTags.length > 0;



            },
            main_results:function(){
                return collect(this.results)
                    .whereIn('attrib',['firstname','patronymic','lastname'])
                    .all();
            },
            left_results:function(){
                return collect(this.results)
                    .whereIn('attrib',['skills','illnesses'])
                    .groupBy('attrib')
                    .all();
            },
            right_results:function(){
                return collect(this.results)
                    .whereIn('attrib',['name','medcenters'])
                    .groupBy('attrib')
                    .all();

            },
            additional_results:function(){
                // return []
                return collect(this.results)
                    .whereIn('attrib',['additional'])
                    .all();

            },
            search_autocomplete:function(){
                return this.select_focused || this.search!=='' || this.count===1;
            },
            filters:function () {
                return collect(this.selectedTags).unique('value').groupBy('attrib').all();
            },
            hint:function () {

                if(this.selectedTags.length===0 && this.search.length<2)
                    return "👆 Начните вводить ФИО врача, специализацию, заболевание, клинику и тд...";

                if(this.results && this.results.length == 0 && this.search.length>2)
                    return "👆 Введенный в поиске текст не найден. попробуйте стереть часть текста.";

                if(this.selectedTags.length===0 && this.search!=='')
                    return "👇 Выберите один из предложенных вариантов";

                if(this.count === 0)
                    return "🗨 По выбранным фильтрам нет врачей. Попробуйте выбрать другую комбинацию!";

                // if(this.count === 1)
                //     return "Найден 1 врач. Перейти к его профилю?";

                // if(this.count === 2)
                //     return "🗨 Найденные 2 врача отличаются данными характеристиками:";

                if(this.count > 20 && this.selectedTags.length>0)
                    return "🗨  Вы можете продолжить поиск по дополнительным критериям.";

                if(this.selectedTags.length>0)
                    return "Фильтру соответствует врачей: "+this.count+"";

                return "";
            },
            search_placeholder:function () {
                let result_count = this.count;

                if(this.selectedTags.length==0)
                    return 'Начните поиск, например «Стоматологи»';

                if(result_count===0)
                    return '🤔 По таким критериям не найдено ни одного врача!';

                if(this.count===1)
                    return "Найден 1 врач. Перейти к его профилю?";


                if(result_count>0)
                    return 'Будет найдено врачей: '+result_count+(this.selectedTags.length>0?' (можно выбрать еще фильтры!) ':'');

                return 'Поиск врача...';
            }
        },
        methods:{
            selectTag: function (val) {
                if(val && val.value && val.value.length>0) {
                    this.selectedTags.push(val);
                    this.search = '';
                }
            },
            removeTag:function(tag){
                if(!tag.fixed)
                    this.selectedTags.splice(this.selectedTags.indexOf(tag), 1)
            },
            updateTag:function(tag){
                socket.emit('search apply filter',
                    this.model,
                    [tag].concat(this.selectedTags),
                    tag.attrib+':'+tag.value
                );
                socket.on('search filtered results'+tag.attrib+':'+tag.value,function (res) {
                    tag.count = res.count
                });
            },
            applyFilters:function () {
                socket.emit('search apply filter',
                    this.model,
                    this.selectedTags
                );
            },
            receiveAutocomplete:function (data) {
                this.autocomplete[data.set] = data;
            },



            handleSpace:function () {
                tg = collect(this.results).where('distance',0).first();

                if(tg)
                    this.selectTag(tg)
            },
            handleEsc:function () {
                if(this.search==='') this.removeTag(this.selectedTags[this.selectedTags.length-1])
            },
            handleDel:function () {
                if(this.search==='') this.removeTag(this.selectedTags[this.selectedTags.length-1])
            },
            focusProposal:function (item) {
                this.focused_proposal_index = this.results.indexOf(item)
            },

        },
        props:{
            model:{
                type:String,
                default:'Doctor'
            },
            predefined:{
                // type:Array,
                default:()=>[]
            }

        }
    }
</script>
