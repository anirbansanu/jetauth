<!-- plugins:js -->
<script src="{{ env('SITE_URL') }}admin/assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ env('SITE_URL') }}admin/assets/vendors/chart.js/Chart.min.js"></script>
<script src="{{ env('SITE_URL') }}admin/assets/vendors/progressbar.js/progressbar.min.js"></script>
<script src="{{ env('SITE_URL') }}admin/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
<script src="{{ env('SITE_URL') }}admin/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="{{ env('SITE_URL') }}admin/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
<script src="{{ env('SITE_URL') }}admin/assets/js/jquery.cookie.js" type="text/javascript"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ env('SITE_URL') }}admin/assets/js/off-canvas.js"></script>
<script src="{{ env('SITE_URL') }}admin/assets/js/hoverable-collapse.js"></script>
<script src="{{ env('SITE_URL') }}admin/assets/js/misc.js"></script>
<script src="{{ env('SITE_URL') }}admin/assets/js/settings.js"></script>
<script src="{{ env('SITE_URL') }}admin/assets/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="{{ env('SITE_URL') }}admin/assets/js/dashboard.js"></script>
<script>
    $('.dropify').dropify({
        messages: {
        'default': 'Drag and drop a file here or click',
        'replace': 'Drag and drop or click to replace',
        'remove':  'Remove',
        'error':   'Ooops, something wrong happended.'
        }
        
    });
</script>
<!-- End custom js for this page -->