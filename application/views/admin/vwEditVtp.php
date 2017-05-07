<?php
$this->load->view('admin/vwHeader');
?>
<script>
function goBack() {
    window.history.back();
}
</script>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Clients <small><?php echo $data->firstname;?></small></h1>
            <ol class="breadcrumb">
              <li><a href="index"><i class="icon-dashboard"></i> Client</a></li>
              <li class="active"><i class="icon-file-alt"></i>Edit Client</li>
              <a class="btn btn-info btn-xs" onClick="goBack()" href="#" style="float:right;">❮ Back</a>
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
                    </div>
        <?php
        }
        ?>
		
                    <form class="form-signin panel" method="post" action="http://localhost/glocalthinkers/index.php/admin/vtp/edit_vtp/<?php echo $data->aid;?>">
                         <div class="form-group">
                                <label>Client Name <span class="red_req">*</span></label>
                                <input class="form-control" name="firstname" placeholder="Client Name" value="<?php echo $data->firstname ?>" required >
                          </div>
                        <div class="form-group">
                                <label>Address <span class="red_req">*</span></label>
                                <input class="form-control" type="text" name="vchaddress" placeholder="Address" value="<?php echo $data->vchaddress ?>" required >
                          </div>
                        <div class="form-group">
                                <label>City</label>
                                <input class="form-control" name="city" placeholder="City" value="<?php echo $data->city ?>">
                          </div>
                        <div class="form-group">
                                <label>State <span class="red_req">*</span></label>
                                <input class="form-control" name="state" placeholder="State" value="<?php echo $data->state ?>" required >
                          </div>
                        <div class="form-group">
                                <label>Country <span class="red_req">*</span></label>
                                <input class="form-control" name="contryid" placeholder="Country" value="<?php echo $data->contryid ?>" required >
                          </div>
                        <div class="form-group">
                                <label>Pin/Zip</label>
								<?php
                                    $value = set_value("pincode") ? set_value("pincode") : isset($data->pincode) ? $data->pincode:'';
                                    $dataa = array(
                                        'id' => 'pincode',
                                        'name' => 'pincode',
                                        'value' => $value,
                                        'class' => 'form-control',
                                        'maxlength' => 6,
                                        'placeholder' => 'Pin/Zip',
                                        'onkeydown' => 'return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )',
                                    );
                                    echo form_input($dataa);
								?>
                          </div>
                        <div class="form-group">
                                <label>Representative <span class="red_req">*</span></label>
                                <input class="form-control" name="vtp_rep" placeholder="Representative" value="<?php echo $data->vtp_rep; ?>" required >
                          </div>
                        <div class="form-group">
                                <label>Designations <span class="red_req">*</span></label>
                                <input class="form-control" name="designations" placeholder="Designations" value="<?php echo $data->designations ?>" required >
                          </div>
                        
                        <div class="form-group">
                                <label>Email <span class="red_req">*</span></label>
                                <input class="form-control" name="email" placeholder="Email" type="email" value="<?php echo $data->email ?>" required >
                          </div>
                        <div class="form-group">
                                <label>Phone <span class="red_req">*</span></label>
								<?php
                                    $value = set_value("phone") ? set_value("phone") : isset($data->phone) ? $data->phone:'';
                                    $dataa = array(
                                        'id' => 'phone',
                                        'name' => 'phone',
                                        'value' => $value,
                                        'class' => 'form-control',
										'required' => 'required',
                                        'maxlength' => 16,
                                        'placeholder' => 'Phone',
                                        'onkeydown' => 'return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )',
                                    );
                                    echo form_input($dataa);
								?>
                          </div>
                        <hr/>
                        <div class="form-group">
                                <label>Second Representative</label>
                                <input class="form-control" name="vtp_rep2" placeholder="Second Representative" value="<?php echo $data->vtp_rep2; ?>">
                          </div>
                        
                        <div class="form-group">
                                <label>Designations </label>
                                <input class="form-control" name="designations2" placeholder="Designations" value="<?php echo $data->designations2; ?>">
                          </div>
                        <div class="form-group">
                                <label>Phone</label>
								<?php
                                    $value = set_value("pmobile") ? set_value("pmobile") : isset($data->pmobile) ? $data->pmobile:'';
                                    $dataa = array(
                                        'id' => 'pmobile',
                                        'name' => 'pmobile',
                                        'value' => $value,
                                        'class' => 'form-control',
                                        'maxlength' => 16,
                                        'placeholder' => 'Phone',
                                        'onkeydown' => 'return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )',
                                    );
                                    echo form_input($dataa);
								?>
                          </div>
                        <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="pemail" placeholder="Email" value="<?php echo $data->pemail ?>">
                          </div>
                        <hr/>
                        <div class="form-group">
                                <label>Landline</label>
                                <input class="form-control" name="plandline" placeholder="Landline" value="<?php echo $data->plandline ?>">
                            <input type="hidden" name="address_country" value="India">
                          </div>
                        <div class="form-group">
                                <label>Website</label>
                                <input type="url" class="form-control" placeholder="Website" name="link" value="<?php echo $data->link ?>">
                            <input type="hidden" name="address_country" value="India">
                          </div>
                        <div class="form-group">
                                <label>Comment</label>
                                <input class="form-control" name="body" placeholder="Comment" value="<?php echo $data->body ?>">
                          </div>
                        <div class="form-group">
                                <button class="btn btn-lg btn-primary btn-block" type="submit">Edit Client</button>
                          </div>
                    </form>
                </div>
 
            </div>
        
        
      </div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>