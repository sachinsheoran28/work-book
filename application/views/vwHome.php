<?php
$this->load->view('vwHeaderC');
?>


<div class="row">
                    <div class="col-lg-12">
                        <h1>Offices</h1>
                        <p>Office List.</p>
                         <?php
if(isset($succ) && $succ !='') {
        ?>
                    <div class="alert alert-success">
                        <?php echo $succ; ?>
                    </div>
        <?php
        }
        ?>
                    </div>
                </div>
				<div class="row">
					<div class="col-lg-12">
						<form method="post" class="clearfix" action="<?php echo site_url('home/loggedin');?>">
							<select name="search_type" class="form-control" style="width:150px;float:left;">
								<option value="center.center_name" <?php if($search_type =='center.center_name'){ echo 'selected="selected"';}?> >Office Name</option>    
								<option value="center.center_address_city" <?php if($search_type =='center.center_address_city'){ echo 'selected="selected"';}?> >Office City</option>
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
                    <th class="header">Office Name <i class="fa fa-sort"></i></th>
                      <th class="header">Office City <i class="fa fa-sort"></i></th>
                    <th class="header">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach($list as $key => $ass){
                      if($ass["deleted"] == 'N'){
                        echo '<tr>';
                        echo '<td>'.$ass["firstname"].'</td>';
                        echo '<td>'.$ass["city"].'</td>';
                        echo '<td><a href="'. base_url().'home/center/'.$ass["aid"].'" class="btn btn-xs btn-success">Select Head Office</a></td>';
                        echo '</tr>';
                      }
                      }   
                     ?>
                </tbody>
              </table>
            </div>
<?php
$this->load->view('vwFooter');
?>