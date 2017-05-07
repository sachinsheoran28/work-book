<?php $this->load->view('admin/vwHeader'); ?>

	<div id="page-wrapper">

        <div class="row">
			<div class="col-lg-12">
				<h1>Center <small><?php echo $result;?></small></h1>
				<ol class="breadcrumb">
					<?php if($user->parentid > 0){?>
						<li><a href="<?php echo base_url();?>admin/center/sub_center/<?php echo $user->parentid.'/'.$user->aid;?>"><i class="icon-dashboard"></i> Center</a></li>
					<?php } else {?>
						<li><a href="<?php echo base_url();?>admin/center/"><i class="icon-dashboard"></i> Center</a></li>
					<?php }?>
					<li class="active"><i class="icon-file-alt"></i>Edit Center</li>
					<?php if($user->parentid > 0){?>
						<a class="btn btn-info btn-xs" href="<?php echo base_url();?>admin/center/sub_center/<?php echo $user->parentid.'/'.$user->aid;?>" style="float:right;">❮ Back</a>
					<?php } else {?>
						<a class="btn btn-info btn-xs" href="<?php echo base_url();?>admin/center/" style="float:right;">❮ Back</a>	
					<?php }?>
					<div style="clear: both;"></div>
				</ol>
			</div>
        </div>
			
            <div class="row">
                <div class="col-lg-8">
                    <?php if(isset($error) && $error !=''){?>
						<div class="alert alert-danger">
							<?php echo $error; ?>
						</div>
					<?php } if(isset($succ) && $succ !='') {?>
                    <div class="alert alert-success">
                        <?php echo $succ; ?>
                        <a href="index" class="btn btn-sm btn-success">Go back</a> <a href="<?php echo base_url(); ?>admin/center/add_center" class="btn btn-sm btn-warning">Add more center</a>
                    </div>
					<?php } ?>
					
                    <form class="form-signin panel" method="post" action="">
                        <div class="form-group">
							<label>Client </label>
                            <select class="form-control" name="aid" id="vtp" disabled>
                                <option value="">Select a Client</option>
									<?php foreach($vtps as $vtp){
                                    if($data->aid == $vtp['aid']) {
                                    echo "<option value='".$vtp['aid']."' selected='selected'>".$vtp['firstname']."</option>";
                                    }
                                    else {
                                        echo "<option value='".$vtp['aid']."'>".$vtp['firstname']."</option>";
                                    }
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
						function printTree($tree, $r = 0, $p = null ) {
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
						<?php 
							//getting main office (21-02-2017 code)
							if($data->parentid > 0)
							{
								$p_id = $data->parentid;
								$this->db->where('center.centid', $p_id);
								$query = $this->db->get('center');
								$result = $query->row();
						?>	
                        <div class="form-group">
							<label> Select Hierarchy Level</label>
                            <div id="innertops">
								<select class="form-control" name="parentid" id="office" disabled>
									<option value="<?php echo $result->parentid; ?>"><?php echo $result->center_name;?></option>
								</select>
                                <p class="help-block">Parent of this Center to make Hierarchy.</p>
							</div>
                        </div>
						<?php } else{?> 
						<div class="form-group">
							<label> Select Hierarchy Level</label>
                            <div id="innertops">
								<select class="form-control" name="parentid" id="office" disabled>
									<option value="">TOP LEVEL</option>
								</select>
                                <p class="help-block">Parent of this Center to make Hierarchy.</p>
							</div>
                        </div>
						<?php }?>
						<input type="hidden" name="centid" value="<?php echo $data->centid;?>"/>
						<input type="hidden" name="aid" value="<?php echo $data->aid;?>"/>
						<input type="hidden" name="uid" value="<?php echo $data->uid;?>"/>
						<input type="hidden" name="parentid" value="<?php echo $data->parentid;?>"/>
                        <div class="form-group">
                                <label>Name of center</label>
                                <input class="form-control" name="center_name" value="<?php echo $data->center_name ?>">
                          </div>
                        <div class="form-group">
                                <label>Center Representetive</label>
                                <input class="form-control" name="center_rep" value="<?php echo $data->center_rep ?>">
                          </div>
                        <div class="form-group">
                                <label>Email for the center</label>
                                <input class="form-control" name="email" type="email" value="<?php echo $data->email ?>">
                          </div>
                        <div class="form-group">
                                <label>Phone Number for the center</label>
                                <input class="form-control" name="center_phone" value="<?php echo $data->center_phone ?>">
                          </div>
                        <div class="form-group">
                                <label>Address</label>
                                <input class="form-control" name="center_address_one" value="<?php echo $data->center_address_one ?>">
                          </div>
                        <div class="form-group">
                                <label>City</label>
                                <input class="form-control" name="center_address_city" value="<?php echo $data->center_address_city ?>">
                          </div>
                        <div class="form-group">
                                <label>State</label>
                                <input class="form-control" name="center_address_state" value="<?php echo $data->center_address_state ?>">
                          </div>
                        <div class="form-group">
                                <label>Pin code</label>
                                <input class="form-control" name="center_address_zip" value="<?php echo $data->center_address_zip ?>">
                          </div>
                        <div class="form-group">
                                <button class="btn btn-lg btn-primary btn-block" type="submit">Edit Center</button>
                          </div>
                    </form>
                </div>
 
            </div>
        
        
      </div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>