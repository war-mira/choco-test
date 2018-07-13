<div id="edit-img-modal" class="mfp-hide popup-window popup-window_upload">
    <div class="popup-window__inner">
        <div class="upload-photo">
            <form id="upload-photo__form">
                <div class="upload-photo__heading">Загрузка фотографии</div>
                <div class="upload-photo__container">
                    <img src="#" id="blah"  style="display: none">
                </div>
                <input type="file" id="upload-photo__input" name="avatar" style="display: none" onchange="readURL(this);">
                <div class="upload-photo__upload-btn">
                    <button type="button" class="btn btn_theme_usual not-ready-for-upload">Выберите фотографию</button>
                    <button type="button" class="btn btn_theme_usual ready-for-upload" style="display: none">Загрузить фотографию</button>
                </div>
            </form>
        </div>
    </div>
</div>