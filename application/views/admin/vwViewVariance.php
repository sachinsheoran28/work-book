<?php $this->load->view('admin/vwHeader'); ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1>Variance <small>View Variance</small></h1>
            <ol class="breadcrumb">
                <li><a href="variance"><i class="icon-dashboard"></i> Variance</a></li>
                <li class="active"><i class="icon-file-alt"></i> Variance List</li>

                <div style="clear: both;"></div>
            </ol>
            <h3 style="color:green;"><?php
                echo $this->session->userdata("msg");
                $this->session->unset_userdata("msg");
                ?></h3>
        </div>
    </div><!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <h3>Search Variance</h3>
            <form method="post" class="clearfix" action="<?php echo site_url('admin/variance'); ?>">
                <select name="search_type" class="form-control" style="width:150px;float:left;">
                    <option value="inspection.insid" <?php if ($search_type == 'inspection.insid') {
                    echo 'selected="selected"';
                } ?> >ID</option>
                    <option value="inspection.insname" <?php if ($search_type == 'inspection.insname') {
                    echo 'selected="selected"';
                } ?> >Inspection Title</option>
                    <option value="center.center_name" <?php if ($search_type == 'center.center_name') {
                    echo 'selected="selected"';
                } ?> >Client Office Name</option>    
                </select> 
                <input type="text" name="search" class="form-control" style="width:150px;float:left;margin-left:10px;" value="<?php echo $search; ?>">
                <input type="submit"   value="Search"  class="btn btn-default" style="float:left;margin-left:10px;">
            </form>
            <hr/>
        </div>
    </div>

    <div id="capture"></div>


    <div class="table-responsive">
        <table class="table table-hover tablesorter">
            <thead>
                <tr>
                    <th class="header">S.No <i class="fa fa-sort"></i></th>
                    <th class="header">Result ID <i class="fa fa-sort"></i></th>
                    <th class="header">Inspection Title <i class="fa fa-sort"></i></th>
                    <th class="header">Client office name<i class="fa fa-sort"></i></th>
                    <th class="header">Inspection Date<i class="fa fa-sort"></i></th>
                    <th class="header">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //echo '<pre/>';print_r($list);exit;
                if ($list) {
                    $i = 1;
                    foreach ($list as $key => $ass) {
                        echo '<tr>';
                        echo '<td>' . $i . '</td>';
                        echo '<td>' . $ass["insid"] . '</td>';
                        echo '<td>' . $ass["insname"] . '</td>';
                        echo '<td>' . $ass["center_name"] . '</td>';
                        echo '<td>' . date('Y-m-d h:i:s a', $ass["date"]) . '</td>';
                        if ($ass["status"] == '0') {
                            echo '<td><a href="' . base_url() . 'admin/variance/download/' . $ass["insid"] . '" class="btn btn-xs btn-success"><i class="fa fa-share-square" aria-hidden="true"></i> Send Variance</a></td>';
                        } else {
                            echo '<td><a class="btn btn-xs btn-success"> Sent</a> <a href="' . base_url() . 'admin/variance/pdf/' . $ass["insid"] . '" class="btn btn-xs btn-success"><i class="fa fa-download" aria-hidden="true"></i> Get Report</a></td>';
                        }
                        echo '</tr>';
                        $i++;
                    }
                } else {
                    echo '<tr>';
                    echo '<td colspan="4">No Variance Found.</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

<?php
if (!empty($list)) {
    // $this->load->view('admin/vwPaginate');
}
?>


</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>