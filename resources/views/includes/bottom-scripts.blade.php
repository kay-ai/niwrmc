
<script src="/js/jquery1-3.4.1.min.js"></script>
<script src="/js/popper1.min.js"></script>
<script src="/js/bootstrap1.min.js"></script>
<script src="/js/metisMenu.js"></script>

<script src="/vendors/count_up/jquery.waypoints.min.js"></script>
<script src="/vendors/chartlist/Chart.min.js"></script>
<script src="/vendors/count_up/jquery.counterup.min.js"></script>
<script src="/vendors/swiper_slider/js/swiper.min.js"></script>
<script src="/vendors/niceselect/js/jquery.nice-select.min.js"></script>
<script src="/vendors/owl_carousel/js/owl.carousel.min.js"></script>
<script src="/vendors/gijgo/gijgo.min.js"></script>

<script src="/vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="/vendors/datatable/js/dataTables.responsive.min.js"></script>
<script src="/vendors/datatable/js/dataTables.buttons.min.js"></script>
<script src="/vendors/datatable/js/buttons.flash.min.js"></script>
<script src="/vendors/datatable/js/jszip.min.js"></script>
<script src="/vendors/datatable/js/pdfmake.min.js"></script>
<script src="/vendors/datatable/js/vfs_fonts.js"></script>
<script src="/vendors/datatable/js/buttons.html5.min.js"></script>
<script src="/vendors/datatable/js/buttons.print.min.js"></script>
<script src="/js/chart.min.js"></script>

<script src="/vendors/progressbar/jquery.barfiller.js"></script>
<script src="/vendors/tagsinput/tagsinput.js"></script>

<script src="/vendors/text_editor/summernote-bs4.js"></script>
<script src="/vendors/apex_chart/apexcharts.js"></script>

<script src="/js/custom.js"></script>

<script src="/js/active_chart.js"></script>
<script src="/vendors/apex_chart/radial_active.js"></script>
<script src="/vendors/apex_chart/stackbar.js"></script>
<script src="/vendors/apex_chart/area_chart.js"></script>

<script src="/vendors/apex_chart/bar_active_1.js"></script>
<script src="/vendors/chartjs/chartjs_active.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="/js/script.js?v=1.0"></script>
{{-- Select 2 --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2({
            theme: 'default',
            // minimumInputLength: 1,
            placeholder: 'Search for an option',
            tags: true
        });
    });

    $(document).ready(function () {
        $('.select2_multiple').select2({
            theme: 'default',
            // minimumInputLength: 1,
            multiple: true,
            placeholder: 'Search for an option',
            allowClear: true,
        });

        $('.select2-container--default .select2-search--inline .select2-search__field').css('width', '100%');
    });
</script>

@stack('js')
