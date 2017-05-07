   </div>
       

   
<footer>
     <p>&copy; Company <?php echo date('Y') ?>.</p>
      </footer>
   </div>
        <!-- /#page-content-wrapper --> 
    </div> <!-- /container -->
  
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo HTTP_JS_PATH; ?>bootstrap.min.js"></script>
 <script src="<?php echo HTTP_JS_PATH; ?>tablesorter/jquery.tablesorter.js"></script>
    <script src="<?php echo HTTP_JS_PATH; ?>tablesorter/tables.js"></script>
 <script src="<?php echo HTTP_JS_PATH; ?>jquery.cycle.all.js"></script>
  <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
        $('.slider').each(function() {
var p = this.parentNode;
$('.slider').cycle({
    fx: 'fade',
    speed: 'slow',
   // timeout: 0,
    next: $('#next', p),
    prev: $('#prev', p),
    nowrap: 1,
    loop: 1,
   // fit: 1,
    finished: function (e, opts, API) {
           // console.log(opts.slideCount);
        alert('The slideshow has ended.');
},
});
        $(this).on('cycle-finished', function(event, opts) {
   alert('The slideshow has ended.');
});
});
        $('.cycle-slideshow').cycle();
  
        
   
    </script>
<script>
        $('.cycle-slideshow').on('cycle-finished', function(event, opts ) {
            alert ("done");
        });

</script>
  </body>
</html>
