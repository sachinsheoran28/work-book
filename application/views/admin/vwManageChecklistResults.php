<?php
$this->load->view('admin/vwHeader');
?>
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Results <small>Manage  Checklist Results</small></h1>
            <ol class="breadcrumb">
                <li><a href="checklistresults"><i class="icon-dashboard"></i> Results</a></li>
                <li class="active"><i class="icon-file-alt"></i>Checklist Results List</li>

                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <h3>Search Result</h3>
            <form method="post" class="clearfix" action="<?php echo site_url('admin/checklistresults'); ?>">
                <select name="search_type" class="form-control" style="width:150px;float:left;">
                    <option value="results_checklist.rid" <?php if ($search_type == 'results_checklist.rid') {
    echo 'selected="selected"';
} ?> >ID</option>
                    <option value="users.first_name" <?php if ($search_type == 'users.first_name') {
    echo 'selected="selected"';
} ?> >Auditor Name</option>
                    <option value="assessors.firstname" <?php if ($search_type == 'assessors.firstname') {
    echo 'selected="selected"';
} ?> >Client Name</option>
                    <option value="center.center_name" <?php if ($search_type == 'center.center_name') {
    echo 'selected="selected"';
} ?> >Client Office Name</option>    
                </select> 
                <input type="text" name="search" class="form-control" style="width:150px;float:left;margin-left:10px;" value="<?php echo $search; ?>"> 
                <input type="submit" value="Search" class="btn btn-default" style="float:left;margin-left:10px;">
            </form>
            <hr/>
        </div>
    </div>

    <div id="capture"></div>


    <div class="table-responsive">
        <table class="table table-hover tablesorter">
            <thead>
                <tr>
                    <th class="header">S.no <i class="fa fa-sort"></i></th>
                    <th class="header">Result ID <i class="fa fa-sort"></i></th>
                    <th class="header">Auditor name <i class="fa fa-sort"></i></th>
                    <th class="header">Client office name<i class="fa fa-sort"></i></th>
                    <th class="header">Mark<i class="fa fa-sort"></i></th>

                    <th class="header">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
               if (empty($list)) {
                           echo '<tr>';
                           echo '<td colspan="4">Not Checklist Resluts Found.</td>';
                            echo '</tr>';
                       } else { $limit++;
                    foreach ($list as $key => $ass) {
                        echo '<tr>';
                        echo '<td>' . $limit++ . '</td>';
                        echo '<td>' . $ass["rid"] . '</td>';
                        echo '<td>' . $ass["first_name"] . ' ' . $ass["last_name"] . '</td>';
                        echo '<td>' . $ass["center_name"] . '</td>';
                        echo '<td>' . $ass["final_score"] . '</td>';
                        if ($ass['pending'] == '0') {
                            echo '<td><a href="' . base_url() . 'admin/checklistresults/view_result/' . $ass["rid"] . '" class="btn btn-xs btn-success">View</a> <a href="' . base_url() . 'admin/checklistresults/report_result/' . $ass["rid"] . '" class="btn btn-xs btn-warning">Approve</a>  </td>';
                        } else {
                            echo '<td><a href="' . base_url() . 'admin/checklistresults/view_result/' . $ass["rid"] . '" class="btn btn-xs btn-success">View</a> Report Approved</td>';
                        }
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
</div><!-- /#page-wrapper -->
<?php
$this->load->view('admin/vwFooter');
?>