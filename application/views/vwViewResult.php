<?php $this->load->view('vwHeaderC'); ?>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Results <small>Manage Results</small></h1>
            <ol class="breadcrumb">
                <li><a href="Results"><i class="icon-dashboard"></i> Results</a></li>
                <li class="active"><i class="icon-file-alt"></i> Results Detail</li>

                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->
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
    <div class="row">
        <div class="col-lg-12">
            <strong>Name of Auditor:</strong> <?php echo $list->first_name . ' ' . $list->last_name; ?>
            <hr/>
            <hr/>
            <strong>Name &amp; Address of Client:</strong> <?php echo '<br/>' . $list->firstname . '<br/>' . $list->vchaddress . '<br/>' . $list->city; ?>
            <hr/>
            <strong>Name &amp; Address of Client's office:</strong> <?php echo $list->center_name; ?><?php echo '<br/>' . $list->center_address_one . '<br/>' . $list->center_address_city . '<br/>' . $list->center_address_state; ?>
            <hr/>
            <strong>Date of the Inspection:</strong> <?php echo $list->date; ?>
            <hr/>
        </div>


    </div><!-- /#page-wrapper -->
    <div class="row">
        <div class="col-lg-12">
            <form method="post" action="<?php echo site_url('reports/pdfreport/' . $list->rid); ?>">
                <span style="float:left;margin-left:10px;">Generate report In PDF</span>
                &nbsp;

                <input type="submit" name="generate" value="Generate PDF"  class="btn btn-default" style="float:left;margin-left:10px;">

            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover tablesorter">
            <thead>
                <tr>
                    <th class="header">Question</th>
                    <th class="header">Video</th>
                    <th class="header">Image</th>
                    <th class="header">Remark</th>
                    <th class="header">Suggession</th>
                    <th class="header">Score obtained</th>
                </tr>
            </thead>
            <tbody>
                <?php //echo '<pre/>';print_r($list);exit;?>
                <?php foreach (explode(",", $list->scores) as $k => $score) { ?>
                    <tr>
                        <td>
                            <?php echo $ques[$k]['question'] ? $ques[$k]['question'] : 'N/A'; ?> 
                        </td>
                        <td>               
                            <?php $base_url = str_replace('index.php/', '', base_url()); ?>
                            <?php if (explode('~', $list->videos)[$k] != '' || explode('~', $list->videos)[$k] != ' ') { ?>
                                <?php if (file_exists("uploads/video/" . explode('~', $list->videos)[$k])) { ?>
                                    <video width="300" controls>
                                        <source src="https://glocalthinkers.in/uploads/video/<?php echo explode("~", $list->videos)[$k]; ?>" type="video/mp4">
                                    </video>
                                <?php } else { ?> 
                                    <img src="<?php echo $base_url; ?>uploads/video/no-video.png" style="min-widht:75px; min-height:75px;" />
                                <?php }
                            } ?>
                        </td>
                        <td>
                            <?php if (explode('~', $list->images)[$k] != '' || explode('~', $list->images)[$k] != ' ') { ?>
                                <?php if (file_exists("uploads/image/" . explode('~', $list->images)[$k])) { ?>
                                    <img src="https://glocalthinkers.in/uploads/image/<?php echo explode('~', $list->images)[$k]; ?>" width=75 height=75 />
                                <?php } else { ?> 
                                    <img src="<?php echo $base_url; ?>uploads/image/no-image.jpg" width=75 height=75 />
        <?php }
    } ?>
                        </td>
                        <td>
                            <?php
                            $remark = explode("~", $list->remark)[$k];
                            echo $remark == '' || $remark == ' ' || $remark == '~' ? 'N/A' : $remark;
                            ?>
                        </td>
                        <td>
                            <?php
                            $suggestion = explode("~", $list->suggestion)[$k];
                            echo $suggestion == '' || $suggestion == ' ' || $suggestion == '~' ? 'N/A' : $suggestion;
                            ?>
                        </td>
                        <td>
                    <?php echo $score ? $score : '0'; ?>
                        </td>
                    </tr>
<?php } ?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <hr/>
        <div class="col-lg-12">
            <strong>Comment:</strong>
				<?php echo $list->final_comment; ?></div>
        <hr/>

        <div id="map" style="height:400px;width:100%;"></div>  
    </div>

<?php $this->load->view('vwFooter'); ?>