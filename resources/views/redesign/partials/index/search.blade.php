<div class="container">
    <div class="row">
        <div class="col">
            <div class="main-search-block">
                <form class="row" action="{{route('doctors.searchPage')}}" method="get">

                    <div class="col-sm-3">
                        <select id="type" name="type">
                            <!-- <option value="hide">Поиск вр</option> -->
                            <option value="doctor">Поиск врача</option>
                            <option value="medcenter">Поиск медцентра</option>
                        </select>
                    </div>
                    <!-- /Select top -->
                    <div class="col-sm-3">
                        <div class="input-block--text">
                            <input id="search_query" class="input-block__input" name="q" type="text"
                                   placeholder="Специализация или фамилия">
                            <label for="search_query" class="input-block__icon"><img
                                        src="img/icons/search-inactive.png" alt=""></label>
                        </div>

                    </div>
                    <div class="col-sm-3">
                        <select id="district" name="district">
                            <option value="null">Алматы</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" class="main-search-block__search-btn">
                            Найти
                        </button>
                    </div>
                </form>


            </div>
            <div class="heart-bg">
                <img src="img/heart.png" alt="">
            </div>
        </div>
    </div>
</div>