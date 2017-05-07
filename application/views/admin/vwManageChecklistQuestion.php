<?php
$this->load->view('admin/vwHeader');
?>
<!--  
Author : Abhishek R. Kaushik 
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Questions <small>Manage Checklist</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url('admin/questions/'); ?>"><i class="icon-dashboard"></i> Questions</a></li>
                <li class="active"><i class="icon-file-alt"></i> Checklist Questions List</li>


                <a class="btn btn-primary" href="<?php echo base_url('admin/checklist/add_question/' . $subid); ?>" style="float:right;">Add New Question</a>

                <div style="clear: both;"></div>
                <div class="searchbox form-group" id="importbox">
                    <?php echo form_open('admin/checklist/import/' . $subid, array('enctype' => 'multipart/form-data')); ?>
                    <h3>Import Question</h3> 
                    <p>Upload Excel file ( .xls only )</p>
                    <input type="hidden" name="size" value="3500000">
                    <input type="file" name="xlsfile">
                    <div style="clear:both;"></div>
                    <input type="submit" value="Import" style="margin-top:5px;" class="btn btn-default">
                    <a href="http://glocalthinkers.in/xls/sample/checklist_sample.xls" target="new">Click here</a> to download sample file to know file format.
                    </form><br> 
                </div>
            </ol>
        </div>
    </div><!-- /.row -->

    <?php
    if (isset($succ) && $succ != '') {
        ?>
        <div class="alert alert-success">
            <?php echo $succ; ?>
        </div>
        <?php
    }
    ?>

    <div class="table-responsive">
        <table class="table table-hover tablesorter">
            <thead>
                <tr>
                    <!--<th class="header">Category <i class="fa fa-sort"></i></th>-->
                    <th class="header">Question Group <i class="fa fa-sort"></i></th>
                    <th class="header">Question<i class="fa fa-sort"></i></th>
                    <th class="header">Weight<i class="fa fa-sort"></i></th>
                    <th class="header">Max. Score<i class="fa fa-sort"></i></th> 
                    <th class="header">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (is_array($list)) {
                    foreach ($list as $key => $ass) {
                        if ($ass["deleted"] == 'N') {
                            echo '<tr>';
                            //echo '<td>' . $ass["aspects"] . '</td>';
                            echo '<td>' . $ass["question_group"] . '</td>';
                            echo '<td>' . $ass["question"] . '</td>';
                            echo '<td>' . $ass["weight"] . '</td>';
                            echo '<td>' . $ass["max_score"] . '</td>';
                            echo '<td><a href="' . base_url() . 'admin/checklist/edit_ques/' . $ass["qid"] . '" class="btn btn-xs btn-success">edit</a>  <a href="' . base_url() . 'admin/checklist/delete_ques/' . $ass["qid"] . '" class="btn btn-xs btn-danger">delete</a></td>';
                            echo '</tr>';
                        }
                    }
                } else {
                    echo '<tr><td colspan="6">' . $list . '</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

   <?php $this->load->view('admin/vwPaginate');  ?>

</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>