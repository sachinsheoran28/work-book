<?php
$this->load->view('admin/vwHeader');
?>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Auditors <small>Manage Auditor</small></h1>
            <ol class="breadcrumb">
              <li><a href="Users"><i class="icon-dashboard"></i> Auditors</a></li>
              <li class="active"><i class="icon-file-alt"></i> Auditors</li>
              
              
              <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/users/add_user" style="float:right;">Add New Auditor</a>
              <div style="clear: both;"></div>
            </ol>
          </div>
        </div><!-- /.row -->
		<form method="post" class="clearfix" action="<?php echo site_url('admin/users');?>">
			<select name="search_type" class="form-control" style="width:150px;float:left;">
				 <option value="users.first_name" <?php if($search_type =='users.first_name'){ echo 'selected="selected"';}?> >Auditor Name</option>    
				 <option value="users.email" <?php if($search_type =='users.email'){ echo 'selected="selected"';}?> >Auditor Email</option>    
				 <option value="users.phone_mobile" <?php if($search_type =='users.phone_mobile'){ echo 'selected="selected"';}?> >Auditor Phone</option>    
				 <option value="users.address_city" <?php if($search_type =='users.address_city'){ echo 'selected="selected"';}?> >Auditor City</option>  
				 <option value="users.address_state" <?php if($search_type =='users.address_state'){ echo 'selected="selected"';}?> >Auditor State</option>  
				 <option value="users.industry" <?php if($search_type =='users.industry'){ echo 'selected="selected"';}?> >Industry Type</option>     
			</select> 
			<input type="text" name="search" class="form-control" style="width:150px;float:left;margin-left:10px;" value="<?php echo $search; ?>">
			<input type="submit" value="Search" class="btn btn-default" style="float:left;margin-left:10px;">
		</form>

        <?php if(isset($succ) && $succ !='') {?>
			<div class="alert alert-success">
				<?php echo $succ; ?>
			</div>
        <?php } ?>
            
            <div class="table-responsive">
              <table class="table table-hover tablesorter">
                <thead>
                  <tr>
                      <th class="header">S.No <i class="fa fa-sort"></i></th>
                    <th class="header">Auditor Id <i class="fa fa-sort"></i></th>
                    <th class="header">Auditor Name <i class="fa fa-sort"></i></th>
                    <th class="header">Email <i class="fa fa-sort"></i></th>
                    <th class="header">Added Date<i class="fa fa-sort"></i></th>
                    <th class="header">Action</th>
                  </tr>
                </thead>
                <tbody>
                    
                    <?php  if (empty($list)) {
                           echo '<tr>';
                           echo '<td colspan="4">No Auditor Found</td>';
                           echo '<td colspan="1"><a href="'. base_url().'admin/users/add_user/" class="btn btn-xs btn-success">Add Auditor</a></td>';
                            echo '</tr>';
                       } else {
                           $limit++;
                           
                     foreach($list as $key => $ass){
                      if($ass["deleted"] == 'N'){
                        echo '<tr>';
                        echo '<td>'.$limit++;'</td>';
                        echo '<td>'.$ass["user_name"].'</td>';
                        echo '<td>'.$ass["first_name"].' '.$ass["last_name"].'</td>';
                        echo '<td>'.$ass["email"].'</td>';
                        echo '<td>'.$ass["signup_date"].'</td>';
                        echo '<td><a href="'. base_url().'admin/users/edit_user/'.$ass["id"].'" class="btn btn-xs btn-success">edit</a>  <a href="'. base_url().'admin/users/delete_user/'.$ass["id"].'" class="btn btn-xs btn-danger">delete</a></td>';
                        echo '</tr>';
                      }
                      }  
                     }
                     ?>
                </tbody>
              </table>
            </div>
        
                        
        <?php
 if (!empty($list)) {
          $this->load->view('admin/vwPaginate');
 }
        ?>
        
        
      </div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>