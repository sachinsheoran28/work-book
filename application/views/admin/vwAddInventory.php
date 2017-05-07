<?php
$this->load->view('admin/vwHeader');
?>
<!--  
-->

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Inventory <small><?php echo $result;?></small></h1>
            <ol class="breadcrumb">
              <li><a href="index"><i class="icon-dashboard"></i> Inventory</a></li>
              <li class="active"><i class="icon-file-alt"></i>Add Inventory</li>
              
              <div style="clear: both;"></div>
            </ol>
          </div>
        </div><!-- /.row -->

        
            <div class="row">
                <div class="col-lg-8">
                    <?php
        if(isset($error) && $error !='')
        {
            ?>
        <div class="alert alert-danger">
        <?php echo $error; ?>
      </div>
        <?php
        }
if(isset($succ) && $succ !='') {
        ?>
                    <div class="alert alert-success">
                        <?php echo $succ; ?>
                        <a href="index" class="btn btn-sm btn-success">Go back</a> <a href="<?php echo base_url(); ?>admin/inventry/add_ins" class="btn btn-sm btn-warning">Add more Inventory inspection</a>
                    </div>
        <?php
        }
        ?>
                    <form class="form-signin panel" method="post" action="">
                         <div class="form-group">
                                <label>Client </label>
                             <div id="inspe"></div>
                             <select class="form-control client_id" name="insaid" id="vtp">
                                 <option value="">Select a Client</option>
                                 <?php foreach($vtps as $vtp){
                                    echo "<option value='".$vtp['aid']."'>".$vtp['firstname']."</option>";
                                    }
                                 ?>
                             </select>
                                <p class="help-block">For which Client.</p>
                          </div>
<?php
function buildTree(Array $varray, $parent = 0) {
    $tree = array();
    foreach ($varray as $d) {
        if ($d['parentid'] == $parent) {
            $children = buildTree($varray, $d['centid']);
            // set a trivial key
            if (!empty($children)) {
                $d['_children'] = $children;
            }
            $tree[] = $d;
        }
    }
    return $tree;
}
$tree = buildTree($center);

function printTree($tree, $r = 0, $p = null) {
    foreach ($tree as $i => $t) {
        $dash = ($t['parentid'] == 0) ? '' : str_repeat('-', $r) .' ';
        printf("\t<option value='%d'>%s%s</option>\n", $t['centid'], $dash, $t['center_name']);
        if ($t['parentid'] == $p) {
            // reset $r
            $r = 0;
        }
        if (isset($t['_children'])) {
            printTree($t['_children'], ++$r, $t['parentid']);
        }
    }
}
?>
                        <div class="form-group">
                                <label> Select Hierarchy Level</label>
                            <div id="innertops">
                             <select class="form-control office" name="parentid" id="office">
                                 <option value="0">Select Client First</option>
                                
                             </select>
                          </div>
                        
                        </div>
                        <div class="form-group">
                                <label>Asign to a auditor</label>
                             <select class="form-control" name="insuid">
                                 <option value="">Select a auditor</option>
                                 <?php foreach($users as $user){
                                    echo "<option value='".$user['id']."'>".$user['first_name']." ".$user['last_name']."</option>";
                                    }
                                 ?>
                             </select>
                                <p class="help-block">select auditor to give right to audit this center.</p>
                          </div>
                        <div class="form-group">
                                <label>Inventory Inpection Title </label>
                                <input class="form-control"  required="" name="insname" value="<?= set_value('insname') ?>">
                          </div>
                        <div class="form-group">
                                <label>Start Date</label>
                                <input id="datetimepicker6" required="" class="form-control" name="date" value="<?= set_value('date') ?>">
                          </div>
                        <div class="form-group">
                                <label>End Date</label>
                                <input id="datetimepicker7"  required="" class="form-control" name="enddate" value="<?= set_value('enddate') ?>">
                          </div>
                        <div class="form-group">
                                <button class="btn btn-lg btn-primary btn-block" type="submit">Add Inventory</button>
                          </div>
                    </form>
                </div>
 
            </div>
        
        
      </div><!-- /#page-wrapper -->
<script type="text/javascript">
    $(function () {
        $('#datetimepicker6').datetimepicker();
        $('#datetimepicker7').datetimepicker({
           // useCurrent: false //Important! See issue #1075
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>
<script type="text/javascript">
$(document).on('change','.client_id',function(){
	var val = $(this).val();
	$.ajax({
		   type: "POST",
		   url: "<?php echo base_url();?>admin/center/get_hierarchy",
		   data:{'client_id':val},  
		   async:false,
		   success: function (msg)
		   {
				$('.office').html(msg);
		   }
	});
});
</script>
<?php
$this->load->view('admin/vwFooter');
?>
