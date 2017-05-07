<?php $this->load->view('admin/vwHeader'); ?>
<script>
    function goBack() {
        window.history.back();
    }
</script>
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Center <small><?php echo $result; ?></small></h1>
            <ol class="breadcrumb">
                <li><a href="index"><i class="icon-dashboard"></i> Center</a></li>
                <li class="active"><i class="icon-file-alt"></i>Add Center</li>
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
                    <a href="index" class="btn btn-sm btn-success">Go back</a> <a href="<?php echo base_url(); ?>admin/center/add_center" class="btn btn-sm btn-warning">Add more center</a>
                </div>
                <?php
            }
            ?>
            <form class="form-signin panel" method="post" action="" >
                <?php
                if ($id != '' && $aid != '') {
                    echo '<input type="hidden" name="aid" value="' . $aid . '"/>';
                    echo '<input type="hidden" name="parentid" value="' . $id . '"/>';
                    ?>		
                    <div class="form-group">
                        <label>Client </label>
                        <select class="form-control " name="aid" required="" disabled>
                            <option value=''>Select a Client</option>
                            <?php foreach ($vtps as $vtp) { ?>
                                <option value="<?php echo $vtp['aid']; ?>" <?php
                                if ($vtp['aid'] == $aid) {
                                    echo 'selected="selecetd"';
                                }
                                ?> ><?php echo $vtp['firstname']; ?> </option>";
    <?php } ?>
                        </select>
                        <p class="help-block">For which Client.</p>
                    </div>

                    <div class="form-group">
                        <label> Select Hierarchy Level</label>
                        <div id="innertops">
                            <select class="form-control office" name="parentid" disabled>
                                <option value="0">Select Client First</option>
                                <?php
                                $this->db->select('centid,aid,center_name');
                                $this->db->where('aid', $aid);
                                $query = $this->db->get('center');
                                $users = $query->result_array();
                                foreach ($users as $hierarchy) {
                                    ?>
                                    <option value="<?php echo $hierarchy['centid']; ?>" <?php
                                            if ($hierarchy['centid'] == $id) {
                                                echo 'selected="selecetd"';
                                            }
                                            ?> ><?php echo $hierarchy['center_name']; ?> </option>";
                    <?php } ?>
                            </select>
                            <p class="help-block">Parent of this Center to make Hierarchy.</p>
                        </div>
                    </div>
                        <?php } else { ?>
                    <div class="form-group">
                        <label>Client </label>
                        <select class="form-control client_id" required name="aid">
                            <option value="">Select a Client</option>
                            <?php
                            foreach ($vtps as $vtp) {
                                echo "<option value='" . $vtp['aid'] . "'>" . $vtp['firstname'] . "</option>";
                            }
                            ?>
                        </select>
                        <p class="help-block">For which Client.</p>
                    </div>

                    <div class="form-group">
                        <label> Select Hierarchy Level</label>
                        <select class="form-control office" name="parentid">
                            <option value="0">Select Client First</option>
                        </select>
                        <p class="help-block">Parent of this Center to make Hierarchy.</p>
                    </div>

<?php } ?> 

                <input type="hidden" name="uid" value="1"/>
                <div class="form-group">
                    <label>Name of center</label>
                    <input class="form-control" name="center_name" required="" value="<?= set_value('center_name') ?>">
                </div>
                <div class="form-group">
                    <label>Center Representetive</label>
                    <input class="form-control" name="center_rep" value="<?= set_value('center_rep') ?>">
                </div>
                <div class="form-group">
                    <label>Email for the center</label>
                    <input class="form-control" name="email" type="email" value="<?= set_value('email') ?>">
                </div>
                <div class="form-group">
                    <label>Phone Number for the center</label>
                    <input class="form-control" name="center_phone" value="<?= set_value('center_phone') ?>">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input class="form-control" name="center_address_one" value="<?= set_value('center_address_one') ?>">
                </div>
                <div class="form-group">
                    <label>City</label>
                    <input class="form-control" name="center_address_city" value="<?= set_value('center_address_city') ?>">
                </div>
                <div class="form-group">
                    <label>State</label>
                    <input class="form-control" name="center_address_state" value="<?= set_value('center_address_state') ?>">
                </div>
                <div class="form-group">
                    <label>Pin code</label>
                    <input class="form-control" name="center_address_zip" value="<?= set_value('center_address_zip') ?>">
                </div>
                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Add Center</button>
                </div>
            </form>
        </div>

    </div>

</div><!-- /#page-wrapper -->

<script type="text/javascript">
    $(document).on('change', '.client_id', function () {
        var val = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>admin/center/get_hierarchy",
            data: {'client_id': val},
            async: false,
            success: function (msg)
            {
                $('.office').html(msg);
            }
        });
    });
</script>	  
<?php $this->load->view('admin/vwFooter'); ?>