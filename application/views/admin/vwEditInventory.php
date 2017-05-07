<?php
$this->load->view('admin/vwHeader');
?>
<!--  
-->

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Inspection <small><?php echo $result;?></small></h1>
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url('admin/inventory/get_ques/'.$parent); ?>"><i class="icon-dashboard"></i> Questions</a></li>
              <li class="active"><i class="icon-file-alt"></i>Add  Question</li>
              
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
                        <a href="index" class="btn btn-sm btn-success">Go back</a> <a href="<?php echo base_url(); ?>admin/inventry/add_question" class="btn btn-sm btn-warning">Add more Question</a>
                    </div>
        <?php
        }
        ?>
                    <form class="form-signin panel" method="post" action="">
                     
                        <div class="form-group">
                                <label>Item Code</label>
                                <input class="form-control" required="" name="code" value="<?php echo $list->code; ?>">
                          </div>
                        <div class="form-group">
                                <label>Inventry Items</label>
                                <input class="form-control"  required="" name="question" value="<?php echo $list->question; ?>">
                          </div> 
                        <div class="form-group">
                                <button class="btn btn-lg btn-primary btn-block" type="submit">Update Question</button>
                          </div>
                    </form>
                </div>
 
            </div>
        
        
      </div><!-- /#page-wrapper -->


<?php
$this->load->view('admin/vwFooter');
?>
