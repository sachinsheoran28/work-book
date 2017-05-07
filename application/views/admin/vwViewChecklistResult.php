<?php
$this->load->view('admin/vwHeader');
?>
<!--  
Author : Abhishek R. Kaushik 
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">


    <?php if ($list->lati_longi != '') { ?>
        <script>
            var map;
                    function initMap() {
                    var map = new google.maps.Map(document.getElementById('map'), {
                    center: {<?php echo $list->lati_longi; ?>},
                            zoom: 17
                    });
                            var marker = new google.maps.Marker({
                            position: {<?php echo $list->lati_longi; ?>},
                                    map: map,
                                    title: 'Hello World!'
                            });
                    }
        </script>

        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDeZOAOxt9hXg-eMOe7W0aWely2x9fK698&callback=initMap"
        type="text/javascript"></script>
    <?php } ?>
    <div id="capture"></div>
    <!-- /#page-wrapper -->

    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <a class="btn btn-info btn-xs" href="<?php echo base_url(); ?>admin/checklistresults" style="float:right;">❮ Back</a>
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> Checklist Audit Report
                    <small class="pull-right">Date of the Inspection: <?php echo $list->date; ?></small>
                </h2>		  
            </div><!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-xs-12">
                <div class="col-sm-3 invoice-col">
                    Prepared By
                    <address>
                        <strong>Auditor</strong><br>
                        <?php echo $list->first_name . ' ' . $list->last_name; ?><br>

                        <?= $list->type ?>(<?= $list->industry ?>)<br/>
                        <?= $list->address_street ?><br>
                        <?= $list->address_city ?>
                    </address>
                </div><!-- /.col -->
                <div class="col-sm-3 invoice-col">
                    For 
                    <address>
                        <strong>Client</strong><br>
                        <?= $list->firstname ?><br>
                        <?= $list->vchaddress ?><br>
                        <?= $list->city ?><br>

                    </address>
                </div><!-- /.col -->
                <div class="col-sm-3 invoice-col">
                    Center
                    <address>
                        <strong>Address</strong><br> 
                        <?= $list->center_address_one ?><br>
                        Inspection Date: <?php echo $list->date; ?><br>


                    </address>
                </div>
                <div class="col-sm-3 invoice-col">
                    Audit 
                    <address>
                        <strong>Location</strong><br> 
                        <?= $list->center_name ?><br>
                        <?= $list->center_address_city ?><br>
                        <?= $list->center_address_state ?><br>

                    </address>
                </div>
            </div>
            <!-- /.col -->
        </div><!-- /.row -->

        <!-- Table row -->
        
        <div class="row">
            <div class="col-lg-12">
                <form method="post" action="<?php echo site_url('checklist/pdfreport/' . $list->rid); ?>">
                    <span style="float:left;margin-left:10px;">Generate report In PDF</span>
                    &nbsp;

                    <input type="submit" name="generate" value="Generate PDF"  class="btn btn-default" style="float:left;margin-left:10px;">

                </form>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr style="background:#006699; color:#FFFFFF">
                            <th>Sl</th>
                            <th>Type</th>
                            <th>Details</th>
                            <th>Score</th>
                            <th>Weight</th>
                            <th>Final Score</th>
                            <th>Max Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $maxscore = 0;
                        $finalscore = 0;
                        foreach (explode(",", $list->scores) as $k => $score) {
                            ?>
                            <tr>
                                <td><?= $k + 1 ?></td>
                                <td> <?php echo $ques[$k]['question_group']; ?> </td>
                                <td><?php echo $ques[$k]['question']; ?></td>
                                <td><?php echo $score; ?></td>
                                <td><?php echo $ques[$k]['weight']; ?></td>
                                <td><?= $fscore = $score * $ques[$k]['weight']; ?></td>
                                <td><?php echo number_format($ques[$k]['max_score'], 0); ?></td>
                            </tr>
    <?php $finalscore = $finalscore + $fscore;
    $maxscore = $maxscore + $ques[$k]['max_score'];
} ?>
                        <tr style="background:#006699; color:#FFFFFF">
                            <td colspan="5"><strong>Total</strong> &nbsp; &nbsp; &nbsp; &nbsp;<strong>Benchmark</strong> : 0-Not followed | 1-Partly | 2-Followed | N/A - Not applicable</td>

                            <td><strong><?= $finalscore; ?></strong></td>
                            <td><strong><?php echo $maxscore; ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-9">

                <div id="map" style="height:250px;width:100%;"></div>
            </div><!-- /.col -->
            <div class="col-xs-3" >
                <p class="lead">Result Review</p>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Max Score:</th>
                            <td><?php echo $maxscore; ?></td>
                        </tr>
                        <tr>
                            <th>Final Score</th>
                            <td><?= $finalscore; ?></td>
                        </tr>
                        <tr>
                            <th>Result:</th>
                            <td><?= round((($finalscore * 100) / $maxscore), 0); ?>%</td>
                        </tr>

                    </table>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <div class="col-sm-9">
                    <strong>Comment:</strong>
<?php echo $list->final_comment; ?>
                </div>
                
            </div>
    </section>

<?php
$this->load->view('vwFooter');
?>