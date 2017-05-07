<?php
$this->load->view('vwHeaderC');
?>
<!--  
Author : Abhishek R. Kaushik 
Downloaded from http://devzone.co.in
-->

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Saved <small>Video Lists</small></h1>
            <ol class="breadcrumb">
              <li><a href="Results"><i class="icon-dashboard"></i> Video</a></li>
              <li class="active"><i class="icon-file-alt"></i> Video List</li>
              
              <div style="clear: both;"></div>
            </ol>
          </div>
        </div><!-- /.row -->  
		<div class="row">
			<div class="col-lg-12">
				<form method="post" class="clearfix" action="<?php echo site_url('home/saved_videos');?>">
					<select name="search_type" class="form-control" style="width:150px;float:left;">
						<option value="videos.vid" <?php if($search_type =='videos.vid'){ echo 'selected="selected"';}?> >ID</option>
						<option value="users.first_name" <?php if($search_type =='users.first_name'){ echo 'selected="selected"';}?> >Auditor Name</option>   
					</select> 
					<input type="text" name="search" class="form-control" style="width:150px;float:left;margin-left:10px;" value="<?php echo $search;?>"> 
					<input type="submit" value="Search" class="btn btn-default" style="float:left;margin-left:10px;">
				</form>
			</div>
		</div>
    <div id="capture"></div>
        
            
            <div class="table-responsive">
              <table class="table table-hover tablesorter">
                <thead>
                  <tr>
                    <th class="header">Video ID <i class="fa fa-sort"></i></th>
                    <th class="header">Auditor Name <i class="fa fa-sort"></i></th>
                    <th class="header">Video<i class="fa fa-sort"></i></th>
                      
                    <th class="header">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach($list as $key => $ass){
  
                        echo '<tr>';
                        echo '<td>'.$ass["vid"].'</td>';
                        echo '<td>'.$ass["first_name"].' '.$ass["last_name"].'</td>';
                        echo '<td>'.$ass["vid_url"].'</td>';
                        echo '<td><a href="'. base_url().'videos/view_video/'.$ass["vid"].'" class="btn btn-xs btn-success">View</a>  </td>';
                        echo '</tr>';
                      }   
                     ?>
                </tbody>
              </table>
            </div>
        
          <?php
         if (!empty($list)) {
          $this->load->view('vwPaginate');
         }
        ?>
        
        
      </div><!-- /#page-wrapper -->

<?php
$this->load->view('vwFooter');
?>