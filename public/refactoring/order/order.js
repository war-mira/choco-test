$(function () {
    const
        $loader    = $('#loader'),
        daysOfWeek = {
            0: "Воскресенье",
            1: "Понедельник",
            2: "Вторник",
            3: "Среда",
            4: "Четверг",
            5: "Пятница",
            6: "Суббота",
        };

    let Doctor         = {},
        timeInputsHtml = '';

    $(document)
        .on('change', '[name="day"], [name="_day"]', function (event) {
            let
                $this               = $(this),
                $parent             = $this.closest('[data-doctor]'),
                $timeContainer      = $parent.find('.time-list'),
                $actionContainer    = $parent.find('.widget-datepick-order-section > .inner'),
                $extendedOrderModal = $('#extended-order-modal'),
                doctorAlias         = $parent.data('doctor');

            if ($this.attr('type') === 'text') {
                $this.css({
                    'color'              : 'black',
                    'border-bottom-color': '#00a8ff',
                });

                $(`input[type="radio"][name="${$this.attr('name')}"]`).prop('checked', false);
            } else {
                $(`input[type="text"][name="${$this.attr('name')}"]`)
                    .css({
                        'color'              : '#00a8ff',
                        'border-bottom-color': 'transparent',
                    })
                    .val($this.val());
            }

            $timeContainer.add($actionContainer)
                          .slideUp('fast');

            $loader.show();

            $.get(route('refactoring.get-schedule-records', doctorAlias))
             .done((response) => {
                 if (response.doctor.jobs.length) {
                     let
                         timeValues = [];

                     Doctor = response.doctor;

                     for (let jobIndex in response.doctor.jobs) {
                         let
                             job       = response.doctor.jobs[jobIndex],
                             medCenter = job.medcenter;

                         for (let scheduleIndex in job.schedules) {
                             let
                                 schedule = job.schedules[scheduleIndex];

                             if (schedule.status) {
                                 for (let recordIndex in schedule.records) {
                                     let
                                         record      = schedule.records[recordIndex],
                                         selectedDay = moment($this.val(), 'DD-MM-YYYY').day();

                                     if (Number(record.day) === Number(selectedDay)) {
                                         let time = record.time.replace(':00', '');

                                         if (timeValues.indexOf(time) === -1) {
                                             timeValues.push({
                                                 date            : $this.val(),
                                                 day             : selectedDay,
                                                 time            : time,
                                                 price           : job.min_price,
                                                 medCenterAddress: medCenter.map,
                                                 medCenterName   : medCenter.name,
                                                 medCenterId     : medCenter.id,
                                             });
                                         }
                                     }
                                 }
                             }
                         }
                     }

                     if (timeValues.length) {
                         timeValues.sort();

                         timeInputsHtml = '';

                         for (let timeValueIndex in timeValues) {
                             let timeValue = timeValues[timeValueIndex];

                             if (timeValue) {
                                 timeInputsHtml += `<li
                                                    class="time-select-item"
                                                    data-date="${timeValue.date}"
                                                    data-day="${timeValue.day}"
                                                    data-time="${timeValue.time}"
                                                    data-price="${timeValue.price}"
                                                    data-med-address="${timeValue.medCenterAddress}"
                                                    data-med-name="${timeValue.medCenterName}"
                                                    data-med-id="${timeValue.medCenterId}">`;

                                 timeInputsHtml += `<input type="radio" name="time" value="${timeValue.time}">`;

                                 timeInputsHtml += `<label>${timeValue.time}</label>`;
                                 timeInputsHtml += `</li>`;
                             }
                         }
                     } else {
                         timeInputsHtml = `<div style="font-size: 18px; text-align: center;">На этот день записи нет!</div>`;
                     }

                     if (timeInputsHtml) {
                         if ($this.attr('name') === 'day') {
                             $timeContainer.html(timeInputsHtml).slideDown('fast');
                         }

                         $extendedOrderModal.find('.time-list')
                                            .html(timeInputsHtml.split('name="time"').join('name="_time"'))
                                            .slideDown('fast');
                     }

                     $loader.hide();
                 }
             })
             .fail(() => {
                 $loader.hide();
             });
        })
        .on('change', '[name="time"], [name="_time"]', function () {
            let
                $this               = $(this),
                $parent             = $this.parent(),
                $topParent          = $this.closest('[data-doctor]'),
                $actionContainer    = $topParent.find('.widget-datepick-order-section > .inner'),
                $extendedOrderModal = $('#extended-order-modal');

            $extendedOrderModal.find('span.price-container').text($parent.data('price'));
            $extendedOrderModal.find('span.med-container').text($parent.data('med-name'));
            $extendedOrderModal.find('span.address-container').text($parent.data('med-address'));
            $extendedOrderModal.find('input[name="doctor_alias"]').val(Doctor.alias);
            $extendedOrderModal.find('input[name="med_center_id"]').val($parent.data('med-id'));
            $extendedOrderModal.find('input[name="appointment_date"]').val($parent.data('date'));
            $extendedOrderModal.find('input[name="appointment_time"]').val($parent.data('time'));
            $extendedOrderModal.find('#modal-date').val(`${$parent.data('date')}, в ${$parent.data('time')}`);

            if ($this.attr('name') === 'time') {
                $actionContainer.slideUp('fast', function () {
                    $actionContainer.find('span.price-container').text($parent.data('price'));
                    $actionContainer.find('span.med-container').text($parent.data('med-name'));
                    $actionContainer.find('span.address-container').text($parent.data('med-address'));

                    $actionContainer.slideDown('fast');
                });

                // Set modal doctor data
                $extendedOrderModal.find('.doctor-info__photo img').attr('src', Doctor.avatar);
                $extendedOrderModal.find('.search-result-item__name').text(Doctor.name);
                $extendedOrderModal.find('.search-result-item__name').text(Doctor.skills_list);

                // Set modal date/time data
                $extendedOrderModal.find('input[type="text"][name="_day"]').val($parent.data('date'));

                if ($extendedOrderModal.find(`input[type="radio"][name="_day"][value="${$parent.data('date')}"]`).length) {
                    $extendedOrderModal.find(`input[type="radio"][name="_day"][value="${$parent.data('date')}"]`)
                                       .prop('checked', true);
                } else {
                    $extendedOrderModal.find('input[type="text"][name="_day"]').css({
                        'color'              : 'black',
                        'border-bottom-color': '#00a8ff',
                    });

                    $extendedOrderModal.find(`input[type="radio"][name="_day"]`).prop('checked', false);
                }

                $extendedOrderModal.find('.time-list')
                                   .html(timeInputsHtml.split('name="time"').join('name="_time"'))
                                   .slideDown('fast', function () {
                                       $extendedOrderModal.find(`input[type="radio"][name="_time"][value="${$parent.data('time')}"]`)
                                                          .prop('checked', true);
                                   });

                if ($this.closest('.single-page-widget-section').length) {
                    $extendedOrderModal.find('.modal-steps__inner').addClass('modal-steps--form-step');

                    modalOpen('extended-order-modal');
                }
            } else if ($this.attr('name') === '_time') {
                $extendedOrderModal.find('.modal-steps__inner').addClass('modal-steps--form-step');
            }
        })
        .on('click', '[data-role="open-order-modal"]', function (event) {
            event.preventDefault();

            let
                $this               = $(this),
                $extendedOrderModal = $('#extended-order-modal');

            $extendedOrderModal.find('.modal-steps__inner').addClass('modal-steps--form-step');

            modalOpen('extended-order-modal');
        })
        .on('focusin', '.date-trigger', function (event) {
            $('input#birthday-modal').prop('checked', false);

            $(".modal-steps__inner").removeClass("modal-steps--form-step");
        })
        .on('focusout', 'input#phone-modal', function (event) {
            let
                $this            = $(this),
                $appointmentForm = $('form#appointment-form');

            if ($this.val().length === 18) {
                $.post(route('refactoring.store-callback', Doctor.alias), {
                    '_token'  : $appointmentForm.find('[name="_token"]').val(),
                    'formData': $appointmentForm.serializeObject(),
                }).done((response) => {
                    $appointmentForm.find('input[name="callback_id"]').val(response.callback.id);
                });
            }
        })
        .on('submit', 'form#appointment-form', function (event) {
            event.preventDefault();

            let
                $this = $(this);

            $loader.show();

            $.post(route('refactoring.store-appointment', Doctor.alias), {
                '_token'  : $this.find('[name="_token"]').val(),
                'formData': $this.serializeObject(),
            }).done((response) => {
                $loader.hide();

                swal(response.message, '', {
                    icon: 'success',
                }).then(() => {
                    location.reload();
                });
            }).fail(() => {
                $loader.hide();

                swal("Вохникла ошибка!", '', {
                    icon: 'success',
                });
            });
        });

    $.fn.serializeObject = function () {
        let o = {},
            a = this.serializeArray();

        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }

                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });

        return o;
    };
});