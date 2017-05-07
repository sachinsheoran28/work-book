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
              <li><a href="<?php echo base_url('admin/questions/get_ques/'.$parent); ?>"><i class="icon-dashboard"></i> Questions</a></li>
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
                        <a href="index" class="btn btn-sm btn-success">Go back</a> <a href="<?php echo base_url(); ?>admin/questions/add_question" class="btn btn-sm btn-warning">Add more Question</a>
                    </div>
        <?php
        }
        ?>
                    <form class="form-signin panel" method="post" action="">
                       
                        <div class="form-group">
                                <label>Question</label>
                                <input class="form-control" required="" name="question" value="<?= set_value('question') ?>">
                          </div>
                        <div class="form-group">
                                <label>Question Group</label>
                                <input class="form-control" name="question_group" value="<?= set_value('question_group') ?>">
                          </div>
                        
                        <div class="form-group">
                                <label>Aspects</label>
                                <input class="form-control" name="aspects" value="<?= set_value('aspects') ?>">
                          </div>
                        
                        <div class="form-group">
                                <label>Option A</label>
                                <input class="form-control" name="option_A" value="<?= set_value('option_A') ?>">
                          </div>
                        <div class="form-group">
                                <label>Option A Score</label>
                                <input class="form-control" name="option_A_score" value="<?= set_value('option_A_score') ?>">
                          </div>
                        <div class="form-group">
                                <label>Option B</label>
                                <input class="form-control" name="option_B" value="<?= set_value('option_B') ?>">
                          </div>
                        <div class="form-group">
                                <label>Option B Score</label>
                                <input class="form-control" name="option_B_score" value="<?= set_value('option_B_score') ?>">
                          </div>
                        
                        <div class="form-group">
                                <label>Option C</label>
                                <input class="form-control" name="option_C" value="<?= set_value('option_C') ?>">
                          </div>
                        <div class="form-group">
                                <label>Option C Score</label>
                                <input class="form-control" name="option_C_score" value="<?= set_value('option_c_score') ?>">
                          </div>
                        <div class="form-group">
                                <label>Option D</label>
                                <input class="form-control" name="option_D" value="<?= set_value('option_D') ?>">
                          </div>
                        <div class="form-group">
                                <label>Option D Score</label>
                                <input class="form-control" name="option_D_score" value="<?= set_value('option_c_score') ?>">
                          </div>
                        <div class="form-group">
                                <label>Maximum score</label>
                                <input class="form-control" name="max_score" value="<?= set_value('option_c_score') ?>">
                          </div>
                        
                        <div class="form-group">
                                <button class="btn btn-lg btn-primary btn-block" type="submit">Add Question</button>
                          </div>
                    </form>
                </div>
 
            </div>
        
        
      </div><!-- /#page-wrapper -->


<?php
$this->load->view('admin/vwFooter');
?>
