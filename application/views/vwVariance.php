<?php $this->load->view('vwHeader'); ?>
<div class="row">
	<div class="col-lg-12">
		<h1>Select Center</h1>
		<p>Select Center to upload Variance.</p>
		<?php if(isset($succ) && $succ !='') {?>
		<div class="alert alert-success">
			<?php echo $succ; ?>
		</div>
		<?php } ?>
	</div>
</div>
<div class="table-responsive">
	<table class="table table-hover tablesorter">
		<thead>
			<tr>
				<th class="header">Inspection <i class="fa fa-sort"></i></th>
				<th class="header">Client Name <i class="fa fa-sort"></i></th>
				<th class="header">Center Name <i class="fa fa-sort"></i></th>
				<th class="header">Action</th>
			</tr>
		</thead>
	<tbody>
		<?php 
                
		 $count = 0;
		//echo '<pre/>';print_r($list);exit;	
		 foreach($list as $key => $ass){
                
		  if($ass["date"] <= time() && $ass["enddate"] >= time() ){
			  $count = $count+1;
			echo '<tr>';
			echo '<td>'.$ass["insname"].'</td>';
			echo '<td>'.$ass["firstname"].'</td>';
			echo '<td>'.$ass["center_name"].'</td>';
			echo '<td><a href="'. base_url().'home/start_variance/'.$ass["insid"].'" class="btn btn-xs btn-success">Update Variance</a></td>';
			echo '</tr>';
		  }
		  }
		  if($count == 0){
			  echo '<tr>';
			  echo '<td colspan="4">No audit for today</td>';
			  echo '</tr>';
		  }
		 ?>
	</tbody>
  </table>
</div>
<?php $this->load->view('vwFooter'); ?>