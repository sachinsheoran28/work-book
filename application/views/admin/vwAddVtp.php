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
            <h1>Clients <small><?php echo $result; ?></small></h1>
            <ol class="breadcrumb">
                <li><a href="index"><i class="icon-dashboard"></i> Client</a></li>
                <li class="active"><i class="icon-file-alt"></i>Add  Client</li>
                <a class="btn btn-info btn-xs" onClick="goBack()" href="#" style="float:right;">❮ Back</a>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->


    <div class="row">
        <div class="col-lg-8">
            <?php
            if (isset($error) && $error != '') {
                ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
                <?php
            }
            if (isset($succ) && $succ != '') {
                ?>
                <div class="alert alert-success">
                    <?php echo $succ; ?>
                </div>
                <?php
            }
            ?>
            <form class="form-signin panel" method="post" action="">
                <div class="form-group">
                    <label>Client Name <span class="red_req">*</span></label>
                    <input class="form-control" name="firstname" placeholder="Client Name" value="<?= set_value('firstname') ?>" required>
                </div>
                <div class="form-group">
                    <label>Address <span class="red_req">*</span></label>
                    <input class="form-control" type="text" name="vchaddress" placeholder="Address" value="<?= set_value('vchaddress') ?>" required>
                </div>
                <div class="form-group">
                    <label>City</label>
                    <input class="form-control" name="city" placeholder="City" value="<?= set_value('city') ?>">
                </div>
                <div class="form-group">
                    <label>State <span class="red_req">*</span></label>
                    <input class="form-control" name="state" placeholder="State" value="<?= set_value('state') ?>" required>
                </div>
                <div class="form-group">
                    <label>Country <span class="red_req">*</span></label>
                    <input class="form-control" name="contryid" placeholder="Country" value="<?= set_value('contryid') ?>" required>
                </div>
                <div class="form-group">
                    <label>Pin/Zip</label>
                    <?php
                    $value = set_value("pincode") ? set_value("pincode") : '';
                    $data = array(
                        'id' => 'pincode',
                        'name' => 'pincode',
                        'value' => $value,
                        'class' => 'form-control',
                        'maxlength' => 6,
                        'placeholder' => 'Pin/Zip',
                        'onkeydown' => 'return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )',
                    );
                    echo form_input($data);
                    ?>
                </div>
                <div class="form-group">
                    <label>Representative One <span class="red_req">*</span></label>
                    <input class="form-control" name="vtp_rep" placeholder="Representative One" value="<?= set_value('vtp_rep') ?>" required>
                </div>

                <div class="form-group">
                    <label>Designations <span class="red_req">*</span></label>
                    <input class="form-control" name="designations" placeholder="Designations" value="<?= set_value('designations') ?>" required>
                </div>

                <div class="form-group">
                    <label>Email <span class="red_req">*</span></label>
                    <input class="form-control" name="email" placeholder="Email" type="email" value="<?= set_value('email') ?>" required>
                </div>
                <div class="form-group">
                    <label>Phone <span class="red_req">*</span></label>
                    <?php
                    $value = set_value("phone") ? set_value("phone") : '';
                    $data = array(
                        'id' => 'phone',
                        'name' => 'phone',
                        'value' => $value,
                        'class' => 'form-control',
                        'required' => 'required',
                        'maxlength' => 16,
                        'placeholder' => 'Phone',
                        'onkeydown' => 'return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )',
                    );
                    echo form_input($data);
                    ?>
                </div>
                <hr/>
                <div class="form-group">
                    <label>Second Representative</label>
                    <input class="form-control" name="vtp_rep2" placeholder="Second Representative" value="<?= set_value('vtp_rep2') ?>">
                </div>

                <div class="form-group">
                    <label>Designations </label>
                    <input class="form-control" name="designations2" placeholder="Designations" value="<?= set_value('designations2') ?>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" name="pemail" placeholder="Email" value="<?= set_value('pemail') ?>">
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <?php
                    $value = set_value("pmobile") ? set_value("pmobile") : '';
                    $data = array(
                        'id' => 'pmobile',
                        'name' => 'pmobile',
                        'value' => $value,
                        'class' => 'form-control',
                        'maxlength' => 16,
                        'placeholder' => 'Phone',
                        'onkeydown' => 'return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )',
                    );
                    echo form_input($data);
                    ?>
                </div>
                <hr/>
                <div class="form-group">
                    <label>Landline</label>
                    <?php
                    $value = set_value("plandline") ? set_value("plandline") : '';
                    $data = array(
                        'id' => 'plandline',
                        'name' => 'plandline',
                        'value' => $value,
                        'class' => 'form-control',
                        'maxlength' => 16,
                        'placeholder' => 'Landline',
                        'onkeydown' => 'return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )',
                    );
                    echo form_input($data);
                    ?>
                    <input type="hidden" name="address_country" value="India">
                </div>

                <div class="form-group">
                    <label>Website</label>
                    <input type="url" class="form-control" name="link" placeholder="Website" value="<?= set_value('link') ?>">
                    <input type="hidden" name="address_country" value="India">
                </div>
                <div class="form-group">
                    <label>Comment</label>
                    <input class="form-control" name="body" placeholder="Comment" value="<?= set_value('body') ?>">
                </div>
                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Add Client</button>
                </div>
            </form>
        </div>

    </div>


</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>