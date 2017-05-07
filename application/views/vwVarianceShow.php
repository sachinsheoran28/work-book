<link href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>font-awesome/css/font-awesome.min.css" />
<link href="<?php echo HTTP_CSS_PATH; ?>simple-sidebar.css" rel="stylesheet">
<link href="<?php echo HTTP_CSS_PATH; ?>main.css" rel="stylesheet">

<div class="row">
    <div class="col-lg-12">
        <h1>Variance Report</h1>
        <p></p>
    </div>

</div>
</div>
<div class="row">
    <form id ="feedInput">

        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Top 10 Food Variance Loss</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-3">Raw Matl</th>
                                <th class="col-md-3">Qty</th>
                                <th class="col-md-3">Value</th>
                                <th class="col-md-3">% Usg Val</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($fvg as $fvgg){?>
                            <tr>
                                <td><?php echo $fvgg['raw_name'];?></td>
                                <td><?php echo $fvgg['quantity'];?></td>
                                <td><?php echo $fvgg['value'];?></td>
                                <td><?php echo $fvgg['per_usg_val'];?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr/>

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Top 5 Food Variance Gain</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-3">Raw Matl</th>
                                <th class="col-md-3">Qty</th>
                                <th class="col-md-3">Value</th>
                                <th class="col-md-3">% Usg Val</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($fvl as $fvll){?>
                            <tr>
                                <td><?php echo $fvll['raw_name'];?></td>
                                <td><?php echo $fvll['quantity'];?></td>
                                <td><?php echo $fvll['value'];?></td>
                                <td><?php echo $fvll['per_usg_val'];?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr/>

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Top 5 Food Yield Loss</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-3">Raw Matl</th>
                                <th class="col-md-3">Qty</th>
                                <th class="col-md-3">Value</th>
                                <th class="col-md-3">% Usg Val</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($fyg as $fygg){?>
                            <tr>
                                <td><?php echo $fygg['raw_name'];?></td>
                                <td><?php echo $fygg['quantity'];?></td>
                                <td><?php echo $fygg['value'];?></td>
                                <td><?php echo $fygg['per_usg_val'];?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr/>

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Top 5 Food Yield Gain</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-3">Raw Matl</th>
                                <th class="col-md-3">Qty</th>
                                <th class="col-md-3">Value</th>
                                <th class="col-md-3">% Usg Val</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($fyl as $fyll){?>
                            <tr>
                                <td><?php echo $fyll['raw_name'];?></td>
                                <td><?php echo $fyll['quantity'];?></td>
                                <td><?php echo $fyll['value'];?></td>
                                <td><?php echo $fyll['per_usg_val'];?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Top 5 Paper Variance Loss</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-3">Raw Matl</th>
                                <th class="col-md-3">Qty</th>
                                <th class="col-md-3">Value</th>
                                <th class="col-md-3">% Usg Val</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($pvl as $pvll){?>
                            <tr>
                                <td><?php echo $pvll['raw_name'];?></td>
                                <td><?php echo $pvll['quantity'];?></td>
                                <td><?php echo $pvll['value'];?></td>
                                <td><?php echo $pvll['per_usg_val'];?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr/>

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Top 5 Paper Variance Gain</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-3">Raw Matl</th>
                                <th class="col-md-3">Qty</th>
                                <th class="col-md-3">Value</th>
                                <th class="col-md-3">% Usg Val</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($pvg as $pvgg){?>
                            <tr>
                                <td><?php echo $pvgg['raw_name'];?></td>
                                <td><?php echo $pvgg['quantity'];?></td>
                                <td><?php echo $pvgg['value'];?></td>
                                <td><?php echo $pvgg['per_usg_val'];?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr/>

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Food Condiments:</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-3">Raw Matl</th>
                                <th class="col-md-3">Qty</th>
                                <th class="col-md-3">Value</th>
                                <th class="col-md-3">% Usg Val</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($foc as $focc){?>
                            <tr>
                                <td><?php echo $focc['raw_name'];?></td>
                                <td><?php echo $focc['quantity'];?></td>
                                <td><?php echo $focc['value'];?></td>
                                <td><?php echo $focc['per_usg_val'];?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr/>

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Paper Condiments:</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-3">Raw Matl</th>
                                <th class="col-md-3">Qty</th>
                                <th class="col-md-3">Value</th>
                                <th class="col-md-3">% Usg Val</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($fpc as $fpcc){?>
                            <tr>
                                <td><?php echo $fpcc['raw_name'];?></td>
                                <td><?php echo $fpcc['quantity'];?></td>
                                <td><?php echo $fpcc['value'];?></td>
                                <td><?php echo $fpcc['per_usg_val'];?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>
<?php $this->load->view('vwFooter'); ?>