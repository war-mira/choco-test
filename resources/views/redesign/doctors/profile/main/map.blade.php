<div class="single-page-item-widget">
    <div class="single-page-item-widget__container">
        <div class="single-page-item-widget__address">
            Алматы, ул. Розыбакиева, 124
            <span>уг. ул. Пирогова</span>
        </div>
        <div class="single-page-item-widget__map" id="doctorMap">
        </div>
    </div>
</div>
@push('scripts')
    <script>
        ymaps.ready(function () {
            var map = new ymaps.Map("doctorMap", {
                center: [55.76, 37.64],
                zoom: 7
            });
        });
    </script>
@endpush