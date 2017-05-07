<?php $this->load->view('admin/vwHeader'); ?>
<script>
    function goBack() {
        window.history.back();
    }
</script>
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Offices <small>Manage Office</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/center"><i class="icon-dashboard"></i> offices</a></li>
                <?php if (isset($user) && $user->parentid == '0') { ?>
                    <li><a href="<?php echo base_url(); ?>admin/center"><i class="icon-dashboard"></i> <?php echo $user->center_name; ?></a></li>
                <?php } else if (isset($user) && $user->parentid > 0) { ?>
                    <li><a href="<?php echo base_url(); ?>admin/center/sub_center/<?php echo $user->parentid . '/' . $user->aid; ?>"><i class="icon-dashboard"></i> <?php echo $user->center_name; ?></a></li>
                <?php } ?>
                <li class="active"><i class="icon-file-alt"></i> Office List</li>
                <?php if ($id != '0') { ?>
                    <a class="btn btn-primary" href="<?php echo site_url('admin/center/add_center/' . $aid->centid . "/" . $aid->aid); ?>" style="float:right;">Add New Sub office</a>
                <?php } else { ?>
                    <a class="btn btn-primary" href="<?php echo site_url('admin/center/add_center/'); ?>" style="float:right;">Add New office</a>
                <?php } ?>
                <br/><br/>
                <a class="btn btn-info btn-xs" onClick="goBack()" href="#" style="float:right;">❮ Back</a>
                <div style="clear: both;"></div>
            </ol>
        </div>
        <?php if ($id > 0) {
            ?>
            <div class="searchbox form-group" id="importbox">
                <?php echo form_open('admin/center/import/' . $id . '/' . $aid->aid . '/' . $succ, array('enctype' => 'multipart/form-data')); ?>

                <h3>Import Sub Office</h3> 
                <p>Upload Excel file ( .xls only )</p>
                <input type="hidden" name="size" value="3500000">
                <input type="file" name="xlsfile">
                <div style="clear:both;"></div>
                <input type="submit" value="Import" style="margin-top:5px;" class="btn btn-default">

                <!--<a href="https://www.glocalthinkers.in/xls/sample/sub_center_sample.xls" target="new">Click here</a> to download sample file to know file format.
                --><a href="https://glocalthinkers.in/xls/sample/sub_center_sample.xls" target="new">Click here</a> to download sample file to know file format.
                </form><br> </div> <?php } ?>

    </div><!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <form method="post" class="clearfix" action="<?php if($id !='0' && $aid !='0'){ echo site_url('admin/center/sub_center/'.$id.'/'.$aid); } else{ echo site_url('admin/center');} ?>">
          
                <select name="search_type" class="form-control" style="width:150px;float:left;">
                    <option value="assessors.firstname" <?php if ($search_type == 'assessors.first_name') {
            echo 'selected="selected"';
        } ?> >Client Name</option>    
                    <option value="center.center_name" <?php if ($search_type == 'center.center_name') {
            echo 'selected="selected"';
        } ?> >Office Name</option>    
                    <option value="center.center_address_city" <?php if ($search_type == 'center.center_address_city') {
            echo 'selected="selected"';
        } ?> >Office City</option>    
                </select> 
                <input type="text" name="search" class="form-control" style="width:150px;float:left;margin-left:10px;" value="<?php echo $search; ?>"> 
                <input type="submit" value="Search" class="btn btn-default" style="float:left;margin-left:10px;">
                <?php if($search !=''){ ?>
                <a href=""><input type="button" value="Clear Search" class="btn btn-default" style="float:left;margin-left:10px;"></a>
                <?php } ?>
            </form>
        </div>
    </div>
<?php if (isset($succ) && $succ != '' && !is_numeric($succ)) { ?>
        <div class="alert alert-success">
    <?php echo $succ; ?>
        </div>
<?php } ?>
    <div class="table-responsive">
        <table class="table table-hover tablesorter">
            <thead>
                <tr>
                    <th class="header">S.No <i class="fa fa-sort"></i></th>
                    <th class="header">Office Name <i class="fa fa-sort"></i></th>
                    <th class="header">Client Name <i class="fa fa-sort"></i></th>
                    <th class="header">Phone Number <i class="fa fa-sort"></i></th>
                    <th class="header">City<i class="fa fa-sort"></i></th>
                    <th class="header">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (empty($list)) {
                    echo '<tr>';
                    echo '<td colspan="4">No sub office for this office</td>';
                    //echo '<td colspan="1"><a href="'. base_url().'admin/center/add_center/'.$id.'/'.$aid->aid.'" class="btn btn-xs btn-success">Add Office</a></td>';
                    echo '</tr>';
                }
                $limit++;
                foreach ($list as $key => $ass) {
                    if ($ass["deleted_cn"] == 'N' && $ass["parentid"] == $id) {
                        echo '<tr>';
                        echo '<td>' . $limit++ . '</td>';
                        echo '<td>' . $ass["center_name"] . '</td>';
                        echo '<td>' . $ass["firstname"] . '</td>';
                        echo '<td>' . $ass["center_phone"] . '</td>';
                        echo '<td>' . $ass["center_address_city"] . '</td>';
                        echo '<td><a href="' . base_url() . 'admin/center/edit_center/' . $ass["centid"] . '" class="btn btn-xs btn-success">edit</a>  <a href="' . base_url() . 'admin/center/sub_center/' . $ass["centid"] . '/' . $ass["aid"] . '" class="btn btn-xs btn-warning">Sub office</a>  <a href="' . base_url() . 'admin/center/delete_center/' . $ass["centid"] . '" class="btn btn-xs btn-danger">delete</a></td>';
                        echo '</tr>';
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
</div>
<?php
$this->load->view('admin/vwFooter');
?>