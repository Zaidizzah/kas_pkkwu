        </div>
      </main> <!-- main -->
    </div> <!-- .wrapper -->
    <script src="<?= base_url('assets/tinydash/') ?>js/jquery.min.js"></script>
    <script src="<?= base_url('assets/tinydash/') ?>js/popper.min.js"></script>
    <script src="<?= base_url('assets/tinydash/') ?>js/moment.min.js"></script>
    <script src="<?= base_url('assets/tinydash/') ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/tinydash/') ?>js/simplebar.min.js"></script>
    <script src='<?= base_url('assets/tinydash/') ?>js/daterangepicker.js'></script>
    <script src='<?= base_url('assets/tinydash/') ?>js/jquery.stickOnScroll.js'></script>
    <script src="<?= base_url('assets/tinydash/') ?>js/tinycolor-min.js"></script>
    <script src="<?= base_url('assets/tinydash/') ?>js/config.js"></script>
    <script src="<?= base_url('assets/tinydash/') ?>js/d3.min.js"></script>
    <script src="<?= base_url('assets/tinydash/') ?>js/topojson.min.js"></script>
    <script src="<?= base_url('assets/tinydash/') ?>js/datamaps.all.min.js"></script>
    <script src="<?= base_url('assets/tinydash/') ?>js/datamaps-zoomto.js"></script>
    <script src="<?= base_url('assets/tinydash/') ?>js/datamaps.custom.js"></script>
    <script src="<?= base_url('assets/tinydash/') ?>js/Chart.min.js"></script>
    <script>
        Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
        Chart.defaults.global.defaultFontColor = colors.mutedColor;
    </script>
    <script src="<?= base_url('assets/tinydash/') ?>js/gauge.min.js"></script>
    <script src="<?= base_url('assets/tinydash/') ?>js/jquery.sparkline.min.js"></script>
    <script src="<?= base_url('assets/tinydash/') ?>js/apexcharts.min.js"></script>
    <script src="<?= base_url('assets/tinydash/') ?>js/apexcharts.custom.js"></script>
    <script src='<?= base_url('assets/tinydash/') ?>js/jquery.mask.min.js'></script>
    <script src='<?= base_url('assets/tinydash/') ?>js/select2.min.js'></script>
    <script src='<?= base_url('assets/tinydash/') ?>js/jquery.steps.min.js'></script>
    <script src='<?= base_url('assets/tinydash/') ?>js/jquery.validate.min.js'></script>
    <script src='<?= base_url('assets/tinydash/') ?>js/jquery.timepicker.js'></script>
    <script src='<?= base_url('assets/tinydash/') ?>js/dropzone.min.js'></script>
    <script src='<?= base_url('assets/tinydash/') ?>js/uppy.min.js'></script>
    <script src='<?= base_url('assets/tinydash/') ?>js/quill.min.js'></script>
    <script>
        <?php if ($this->session->flashdata('pesan_data_diri')){ ?>
            $('.container-fluid').append(`
                <div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="verticalModalTitle">Pesan <span style="padding: 5px 10px;" class="badge badge-success">Informasi <span class="spinner-grow spinner-grow-sm"></span></span></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body"> 
                                <p><strong>Apakah</strong> Anda ingin melengkapi data diri yang masih kosong?</p>
                                <p>Isi data diri dan <a href="<?= base_url('profile?username='.$this->session->userdata('username')) ?>">Kujungi profile saya</a></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Tidak</button>
                                <a type="button" class="btn mb-2 btn-primary" href="<?= base_url('profile?username='.$this->session->userdata('username')) ?>">Kunjungi profile</a>
                            </div>
                        </div>
                    </div>
                </div>`);

                $('#modalInfo').modal('show');
        <?php } ?>
        $('.select2').select2(
        {
            theme: 'bootstrap4',
        });
        $('.select2-multi').select2(
        {
            multiple: true,
            theme: 'bootstrap4',
        });
        $('.drgpicker').daterangepicker(
        {
            singleDatePicker: true,
            timePicker: false,
            showDropdowns: true,
            locale:
            {
            format: 'MM/DD/YYYY'
            }
        });
        $('.time-input').timepicker(
        {
            'scrollDefault': 'now',
            'zindex': '9999' /* fix modal open */
        });
        /** date range picker */
        if ($('.datetimes').length)
        {
            $('.datetimes').daterangepicker(
            {
            timePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            locale:
            {
                format: 'M/DD hh:mm A'
            }
            });
        }
        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end)
        {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        $('#reportrange').daterangepicker(
        {
            startDate: start,
            endDate: end,
            ranges:
            {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);
        cb(start, end);
        $('.input-placeholder').mask("00/00/0000",
        {
            placeholder: "__/__/____"
        });
        $('.input-zip').mask('00000-000',
        {
            placeholder: "____-___"
        });
        $('.input-money').mask("#.##0,00",
        {
            reverse: true
        });
        $('.input-phoneus').mask('(000) 000-0000');
        $('.input-mixed').mask('AAA 000-S0S');
        $('.input-ip').mask('0ZZ.0ZZ.0ZZ.0ZZ',
        {
            translation:
            {
            'Z':
            {
                pattern: /[0-9]/,
                optional: true
            }
            },
            placeholder: "___.___.___.___"
        });
        // editor
        var editor = document.getElementById('editor');
        if (editor)
        {
            var toolbarOptions = [
            [
            {
                'font': []
            }],
            [
            {
                'header': [1, 2, 3, 4, 5, 6, false]
            }],
            ['bold', 'italic', 'underline', 'strike'],
            ['blockquote', 'code-block'],
            [
            {
                'header': 1
            },
            {
                'header': 2
            }],
            [
            {
                'list': 'ordered'
            },
            {
                'list': 'bullet'
            }],
            [
            {
                'script': 'sub'
            },
            {
                'script': 'super'
            }],
            [
            {
                'indent': '-1'
            },
            {
                'indent': '+1'
            }], // outdent/indent
            [
            {
                'direction': 'rtl'
            }], // text direction
            [
            {
                'color': []
            },
            {
                'background': []
            }], // dropdown with defaults from theme
            [
            {
                'align': []
            }],
            ['clean'] // remove formatting button
            ];
            var quill = new Quill(editor,
            {
            modules:
            {
                toolbar: toolbarOptions
            },
            theme: 'snow'
            });
        }
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function()
        {
            'use strict';
            window.addEventListener('load', function()
            {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form)
            {
                form.addEventListener('submit', function(event)
                {
                if (form.checkValidity() === false)
                {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
                }, false);
            });
            }, false);
        })();
        </script>
        <script>
        var uptarg = document.getElementById('drag-drop-area');
        if (uptarg)
        {
            var uppy = Uppy.Core().use(Uppy.Dashboard,
            {
            inline: true,
            target: uptarg,
            proudlyDisplayPoweredByUppy: false,
            theme: 'dark',
            width: 770,
            height: 210,
            plugins: ['Webcam']
            }).use(Uppy.Tus,
            {
            endpoint: 'https://master.tus.io/files/'
            });
            uppy.on('complete', (result) =>
            {
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
            });
        }
        </script>
        <script src="<?= base_url('assets/tinydash/') ?>js/apps.js"></script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
        <script>
        window.dataLayer = window.dataLayer || [];

        function gtag()
        {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-56159088-1');
    </script>
    </body>
</html>