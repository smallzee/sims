<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Supervised by Mrs. Ogunleye</b>
  </div>
  <strong>Design and implementation of student information system </strong>
 </footer>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<script type="text/javascript" src="../lib/jquery/jquery.min.js"></script>
<script type="text/javascript" src="../lib/bootstrap/js/bootstrap.min.js"></script>

<?php
    if(isset($page)){
        ?>
        <script type="text/javascript" src="lib/datepicker/jquery.plugin.min.js"></script>
        <script type="text/javascript" src="lib/datepicker/jquery.datepick.min.js"></script>

        <script>
            $('#popupDatepicker').datepick({
                dateFormat: 'dd-M-yyyy',
                minDate: new Date()
            });
        </script>

        <?php
    }
?>
<script src="lib/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="lib/fastclick/fastclick.js"></script>
<script src="lib/DataTables/datatables.min.js"></script>
<script type="text/javascript" src="lib/trumbowyg/dist/trumbowyg.min.js"></script>
<script type="text/javascript" src="lib/datepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tables').DataTable();

        $("#c_all").click(function(e) {
           var a = $(this).prop("checked");
           $(".cbox").prop("checked",a);
        });

        $(".btn-delete-cats").click(function(event) {
            /* Act on the event */
            //console.log("a");
            var a  = confirm("Are you sure you want to delete this category \n(All questions will be deleted)?");
            if(a == false){
                event.preventDefault();
                return false;
            }

            //btn-delete-question
        });


        $(".btn-delete-question").click(function(event) {
            /* Act on the event */
            //console.log("a");
            var a  = confirm("Are you sure you want to delete this question?");
            if(a == false){
                event.preventDefault();
                return false;
            }

            //btn-delete-question
        });


        $(".btn-delete-result").click(function(event) {
            /* Act on the event */
            //console.log("a");
            var a  = confirm("Are you sure you want to delete the selected results??");
            if(a == false){
                event.preventDefault();
                return false;
            }

            //btn-delete-question
        });

        //btn-delete-result


	});
</script>
<!-- select2 -->
        <script src="js/select2.full.js"></script>
        <!-- select2 -->
        <script>
            $(document).ready(function () {
                $(".select2_single").select2({
                    placeholder: "Select an option",
                    allowClear: true
                });
                $(".select2_group").select2({});
                $(".select2_multiple").select2({
                    maximumSelectionLength: 4,
                    placeholder: "With Max Selection limit 4",
                    allowClear: true
                });
            });
        </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.trumbowyg').trumbowyg();
        });
    </script>
<script src="js/admin.js"></script>
<script type="text/javascript" src='js/main.js'></script>

<script type="text/javascript" src="js/game.js"></script>
<script src="js/app.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
</body>
</html>