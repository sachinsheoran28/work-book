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
                <a class="btn btn-info btn-xs" href="<?php echo base_url(); ?>admin/assetsresults" style="float:right;">❮ Back</a>
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> Fixed Assets Inspection
                    <small class="pull-right">Date of the Inspection: <?php echo $list->date; ?></small>              </h2>
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

        <div class="row">
            <div class="col-lg-12">
                <form method="post" action="<?php echo site_url('assets/pdfreport/' . $list->rid); ?>">
                    <span style="float:left;margin-left:10px;">Generate report In PDF</span>
                    &nbsp;

                    <input type="submit" name="generate" value="Generate PDF"  class="btn btn-default" style="float:left;margin-left:10px;">

                </form>
            </div>
        </div>
        
        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr style="background:#006699; color:#FFFFFF">
                            <th>Sl</th>
                            <th>Assets</th>
                            <th>Model</th>
                            <th>Tag</th>
                            <th>Remark</th>
                            <th>Images</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach (explode("~", $list->model) as $k => $score) {
                            ?>
                            <tr>
                                <td><?= $k + 1 ?></td>
                                <td> <?php echo $ques[$k]['question']; ?> </td>
                                <td><?php echo $score; ?></td>
                                <td> <?php echo explode("~", $list->tag)[$k]; ?></td>
                                <td> <?php echo explode("~", $list->remark)[$k]; ?></td>

                                <td>
                                    <?php if (explode('~', $list->images)[$k] != '' || explode('~', $list->images)[$k] != ' ') { ?>
                                            <!--<img src="https://mcd.glocalthinkers.in/uploads/image/<?php echo explode('~', $list->images)[$k]; ?>" width=75 height=75 />-->
                                        <?php $base_url = str_replace('index.php/', '', base_url()); ?>
                                        <?php if (file_exists("uploads/image/" . explode('~', $list->images)[$k])) { ?>
                                            <img src="<?php echo $base_url; ?>uploads/image/<?php echo explode('~', $list->images)[$k]; ?>" width=75 height=75 />
                                        <?php } else { ?> 
                                            <img src="<?php echo $base_url; ?>uploads/image/no-image.jpg" width=75 height=75 />
                                        <?php } ?>	
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
            <h4>Inspection Location </h4>
            <!-- accepted payments column -->
            <hr>
            <div class="col-xs-12">

                <div id="map" style="height:250px;width:100%;"></div>
            </div><!-- /.col -->
            <!-- /.col -->
        </div><!-- /.row -->

        <!-- this row will not appear when printing -->
        <hr>
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