</div>
<footer id="footer">
    &copy; 2017-{{ date("Y")}} <a href="#">Punnaka.com</a>, All rights reserved.
</footer>
<!-- common functions -->
<script type="text/javascript" src="{{ asset('admin/assets/js/attachments.js') }}"></script>
<script src="{{ asset('admin/assets/js/common.min.js') }}"></script>
<!-- uikit functions -->
<script src="{{ asset('admin/assets/js/uikit_custom.min.js') }}"></script>
<!-- altair common functions/helpers -->
<script src="{{ asset('admin/assets/js/altair_admin_common.min.js') }}"></script>

<!-- page specific plugins -->
<!-- parsley (validation) -->
<script>
    // load parsley config (altair_admin_common.js)
    altair_forms.parsley_validation_config();
    altair_forms.parsley_extra_validators();
</script>
<script src="{{ asset('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
<!--  forms validation functions -->
<script src="{{ asset('admin/assets/js/pages/forms_validation.min.js') }}"></script>

<!-- page specific plugins -->
<!-- d3 -->
<script src="{{ asset('admin/bower_components/d3/d3.min.j') }}s"></script>
<!-- metrics graphics (charts) -->
{{-- <script src="{{asset('admin/bower_components/metrics-graphics/dist/metricsgraphics.min.js')}}"></script> --}}
<!-- chartist (charts) -->
{{-- <script src="{{asset('admin/bower_components/chartist/dist/chartist.min.js')}}"></script> --}}
<!-- maplace (google maps) -->
{{-- <script src="https://maps.google.com/maps/api/js?key=AIzaSyC2FodI8g-iCz1KHRFE7_4r8MFLA7Zbyhk"></script> --}}
<script src="{{ asset('admin/bower_components/maplace-js/dist/maplace.min.js') }}"></script>
<!-- peity (small charts) -->
<script src="{{ asset('admin/bower_components/peity/jquery.peity.min.js') }}"></script>
<!-- easy-pie-chart (circular statistics) -->
{{-- <script src="{{asset('admin/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js')}}"></script> --}}
<!-- countUp -->
<script src="{{ asset('admin/bower_components/countUp.js/dist/countUp.min.js') }}"></script>
<!-- handlebars.js -->
<script src="{{ asset('admin/bower_components/handlebars/handlebars.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/custom/handlebars_helpers.min.js') }}"></script>
<!-- CLNDR -->
<script src="{{ asset('admin/bower_components/clndr/clndr.min.js') }}"></script>

<!--  dashbord functions -->
<script src="{{ asset('admin/assets/js/pages/dashboard.min.js') }}"></script>


<!-- page specific plugins -->
<!-- datatables -->
<script src="{{ asset('admin/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<!-- datatables buttons-->
<script src="{{ asset('admin/bower_components/datatables-buttons/js/dataTables.buttons.js') }}"></script>
<script src="{{ asset('admin/assets/js/custom/datatables/buttons.uikit.js') }}"></script>
<script src="{{ asset('admin/bower_components/jszip/dist/jszip.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin/bower_components/datatables-buttons/js/buttons.colVis.js') }}"></script>
<script src="{{ asset('admin/bower_components/datatables-buttons/js/buttons.html5.js') }}"></script>
<script src="{{ asset('admin/bower_components/datatables-buttons/js/buttons.print.js') }}"></script>
<script src="{{ asset('admin/assets/js/pages/forms_wizard.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/custom/datatables/datatables.uikit.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('admin/assets/js/custom/wizard_steps.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/pages/plugins_datatables.min.js') }}"></script>
<script>
    function copyToClipboard(url) {
        navigator.clipboard.writeText(url)
            .then(() => {
                M.toast({
                    html: 'Path copied to clipboard!',
                    classes: 'green darken-1',
                    displayLength: 2000
                });
            })
            .catch(err => alert("Failed to copy: " + err));
    }
</script>

</body>

</html>
