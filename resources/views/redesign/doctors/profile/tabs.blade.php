<div class="single-page-tabs-container" id="profile-tabs-container">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <ul class="nav nav-tabs page-tabs-links">
                    <li class="tab-option">
                        <a data-toggle="tab" href="#about">О враче</a>
                    </li>
                    <li class="tab-option ">
                        <a data-toggle="tab" class="active show" href="#feedbacks">Отзывы</a>
                    </li>
                    <li class="tab-option ">
                        <a data-toggle="tab" href="#services">Услуги</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="tab-content">
            <div class="page-tab tab-pane fade" id="about">
                @include('redesign.doctors.profile.tabs.about')
            </div>
            <!-- /Page "About" -->
            <div class="page-tab tab-pane fade in active show" id="feedbacks">
                @include('redesign.doctors.profile.tabs.comments')
            </div>
            <!-- /Page "Feedbacks" -->
            <div class="page-tab tab-pane fade" id="services">
                @include('redesign.doctors.profile.tabs.services')
            </div>
        </div>
    </div>
</div>