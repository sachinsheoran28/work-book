<?php
$this->load->view('admin/vwHeader');
?>
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>

<div id="page-wrapper">
    <div class="row">
          <div class="col-lg-12">
            <h1>Checklist <small>Manage Checklist</small></h1>
            <ol class="breadcrumb">
              <li><a href="Questions"><i class="icon-dashboard"></i> Checklist</a></li>
              <li class="active"><i class="icon-file-alt"></i> Checklist</li>
              
              
              <a class="btn btn-primary" href="<?php echo site_url('admin/Checklist/add_checklist') ?>" style="float:right;">Add New Checklist</a>
              <div style="clear: both;"></div>
            </ol> 
          </div>
        </div><!-- /.row -->
		<?php if(isset($succ) && $succ !='') {?>
			<div class="alert alert-success">
				<?php echo $succ; ?>
			</div>
        <?php } ?>
		<div class="row">
			<div class="col-lg-12">
				<form method="post" class="clearfix" action="<?php echo site_url('admin/Checklist');?>">
					<select name="search_type" class="form-control" style="width:150px;float:left;">
						<option value="assessors.firstname" <?php if($search_type =='assessors.firstname'){ echo 'selected="selected"';}?> >Client Name</option>    
						<option value="inspection.insname" <?php if($search_type =='inspection.insname'){ echo 'selected="selected"';}?> >Inspection Name</option>    
						<option value="center.center_name" <?php if($search_type =='center.center_name'){ echo 'selected="selected"';}?> >Office Name</option>    
						<option value="users.first_name" <?php if($search_type =='users.first_name'){ echo 'selected="selected"';}?> >Auditor Name</option>   
					</select> 
					<input type="text" name="search" class="form-control" style="width:150px;float:left;margin-left:10px;" value="<?php echo $search;?>"> 
					<input type="submit" value="Search" class="btn btn-default" style="float:left;margin-left:10px;">
				</form>
			</div>
		</div>
        
            
            <div class="table-responsive">
              <table class="table table-hover tablesorter">
                <thead>
                  <tr>
                     <th class="header">S.No <i class="fa fa-sort"></i></th>
                    <th class="header">Checklist <i class="fa fa-sort"></i></th>
                    <th class="header">Start Date <i class="fa fa-sort"></i></th>
                    <th class="header">End Date <i class="fa fa-sort"></i></th>
                    <th class="header">Client<i class="fa fa-sort"></i></th>
                    <th class="header">Office<i class="fa fa-sort"></i></th>
                    <th class="header">Auditor<i class="fa fa-sort"></i></th>
                    <th class="header">Action</th>
                  </tr>
                </thead>
  <?php  if (empty($list)) {
                           echo '<tr>';
                           echo '<td colspan="4">Not Checklist Found.</td>';
                            echo '</tr>';
                       } else {
                           if(isset($_POST['search']) || (isset($succ) && $succ !='')) { 
      $limit++;
                    foreach($list as $key => $ass){
                      if($ass["ins_delete"] == 'N'){
                        echo '<tbody ><tr>';
                        echo '<td>'.$limit++.'</td>';
                        echo '<td>'.$ass["insname"].'</td>';
                        echo '<td>'.date('m/d/Y h:i A', $ass["date"]).'</td>';
                        echo '<td>'.date('m/d/Y h:i A', $ass["enddate"]).'</td>';
                        echo '<td>'.$ass["firstname"].'</td>';
                        echo '<td>'.$ass["center_name"].'</td>';
                        echo '<td>'.$ass["first_name"].' '.$ass["last_name"].'</td>';
                        echo '<td><a href="'. base_url().'admin/checklist/edit_ins/'.$ass["insid"].'" class="btn btn-xs btn-success">edit</a>   <a href="'. base_url().'admin/checklist/get_ques/'.$ass["insid"].'" class="btn btn-xs btn-warning">add Checklist Question</a>  <a href="'. base_url().'admin/checklist/delete_ins/'.$ass["insid"].'" class="btn btn-xs btn-danger">delete</a></td>';
                        echo '</tr>';
                      }
                      }   
                } else { ?>              
                <tbody id="target-content"></tbody> <?php }?>
              </table>
            </div>
          <?php 
          if(isset($succ) && !isset($_POST)) {  
               $this->load->view('admin/vwPaginate1'); 
               
          } else { 
              $this->load->view('admin/vwPaginate');
              
  }  } ?>
</div><!-- /#page-wrapper -->
<?php
$this->load->view('admin/vwFooter');
?>
<script>
jQuery(document).ready(function() {
jQuery("#target-content").load("checklist/index1/page/1");
    jQuery("#pagination li").live('click',function(e){
        e.preventDefault();
        jQuery("#target-content").html('loading...');
        jQuery("#pagination li").removeClass('active');
        jQuery(this).addClass('active');
        var pageNum = this.id;
        jQuery("#target-content").load("checklist/index1/page/" + pageNum);
    });
    });
</script>