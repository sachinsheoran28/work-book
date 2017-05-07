<?php
$this->load->view('admin/vwHeader');
?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#myform").validate();
    });
</script>
<script>
function goBack() {
    window.history.back();
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyAQOyAZKOIb1ykHa_q5YrfU_BvA8PUxdJs"></script>
<script>
    var autocomplete;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'long_name',
        country: 'long_name',
        postal_code: 'short_name'
    };
    function initialize() {
        autocomplete = new google.maps.places.Autocomplete(
                (document.getElementById('address')));
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            fillInAddress();
        });

    }
    function fillInAddress() {
        var place = autocomplete.getPlace();
        $('.lat').val(place.geometry.location.lat());
        $('.long').val(place.geometry.location.lng());

        //to get city
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
//            alert(addressType);
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                //alert(val);
                if (addressType == 'locality') {
                    $('#city_namee').val(val);
                }
                if (addressType == 'administrative_area_level_1' || addressType == 'administrative_area_level_2') {
                    $('#region').val(val);
                }
                if (addressType == 'country') {
                    $('#country').val(val);
               }
            }   
        }   
    }
    window.onload = initialize;
</script>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Users <small><?php echo $result;?></small></h1>
            <ol class="breadcrumb">
              <li><a href="index"><i class="icon-dashboard"></i> Users</a></li>
              <li class="active"><i class="icon-file-alt"></i>Add  Users</li>
              <a class="btn btn-info btn-xs" onClick="goBack()" href="#" style="float:right;">❮ Back</a>
              <div style="clear: both;"></div>
            </ol>
          </div>
        </div><!-- /.row -->

        
            <div class="row">
                <div class="col-lg-8">
                    <?php
        if(isset($error) && $error !='')
        {
            ?>
        <div class="alert alert-danger">
        <?php echo $error; ?>
      </div>
        <?php
        }
if(isset($succ) && $succ !='') {
        ?>
                    <div class="alert alert-success">
                        <?php echo $succ; ?>
                    </div>
        <?php
        }
        ?>
                    <form class="form-signin panel" id="myform" method="post" action="">
                         <div class="form-group">
                                <label>Auditor Id <span class="red_req">*</span></label>
                                <input class="form-control" name="user_name" value="<?= set_value('user_name') ?>" placeholder="Auditor Id" required> 
								<p class="help-block">Auditor Id, Used for login to front End.</p>
                          </div>
                        <div class="form-group">
                                <label>Password <span class="red_req">*</span></label>
                                <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                                <p class="help-block">Password, Used for login to front End.</p>
                          </div>
                        <div class="form-group">
                                <label>Confirm Password <span class="red_req">*</span></label>
								<input class="form-control" type="password" name="con_password" id="con_password" placeholder="Confirm password" required>
                                <p class="help-block">Must be same as Password.</p>
                         </div>
                        <div class="form-group">
                                <label>First Name <span class="red_req">*</span></label>
                                <input class="form-control" name="first_name" placeholder="First Name" value="<?= set_value('first_name') ?>" required>
                          </div>
                        <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control" name="last_name" placeholder="Last Name" value="<?= set_value('last_name') ?>">
                          </div>
                        
                        <div class="form-group">
                                <label>Qualification</label>
                                <input class="form-control" name="qualification" placeholder="Qualification" value="<?= set_value('qualification') ?>">
                          </div>
                        <div class="form-group">
                                <label>Auditor Type</label>
                                <select name="type" class="form-control">
                                    <option value="Chartered Accountant">Chartered Accountant</option>
                                    <option value="Industry Expert">Industry Expert</option>
                                </select>
						</div>		
						<div class="form-group">
                            <label>Industry Expert in <span class="red_req">*</span></label>
                            <input class="form-control" name="industry" placeholder="Industry Expert in" value="<?= set_value('industry') ?>" required>
						</div>
                        <div class="form-group">
                                <label>Email <span class="red_req">*</span></label>
                                <input class="form-control" name="email" placeholder="Email" type="email" value="<?= set_value('email') ?>" required>
                          </div>
                        <div class="form-group">
                                <label>Mobile Number <span class="red_req">*</span></label>
								<?php
                                    $value = set_value("phone_mobile") ? set_value("phone_mobile") : '';
                                    $data = array(
                                        'id' => 'phone_mobile',
                                        'name' => 'phone_mobile',
                                        'value' => $value,
                                        'class' => 'form-control required',
                                        'maxlength' => 16,
                                        'required'=>'required',
                                        'placeholder' => 'Mobile Number',
                                        'onkeydown' => 'return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )',
                                    );
                                    echo form_input($data);
								?>
                          </div>
                        <input type="hidden" value="<?php echo date("Y-m-d H:i:s"); ?>" name="signup_date">
                        
                        <div class="form-group">
                                <input class="form-control" name="status" type="hidden" value="0">
                          </div>
                        <div class="form-group">
                                <label>Address <span class="red_req">*</span></label>
                                <input class="form-control" name="address_street" id="address" placeholder="Address" value="<?= set_value('address_street') ?>" required>
                          </div>
                        
                        
						<input type="hidden" class="form-control" id="city_namee" name="address_city" placeholder="City" value="<?= set_value('address_city') ?>">
                        
						<input type="hidden" class="form-control" name="address_state" id="region" placeholder="State" value="<?= set_value('address_state') ?>">
						
						<input type="hidden" name="address_country" id="country" value="">
                        
                        <div class="form-group">
                                <label>Pin code</label>
								<?php
                                    $value = set_value("address_postalcode") ? set_value("address_postalcode") : '';
                                    $data = array(
                                        'id' => 'address_postalcode',
                                        'name' => 'address_postalcode',
                                        'value' => $value,
                                        'class' => 'form-control',
                                        'maxlength' => 6,
                                        'placeholder' => 'Pin code',
                                        'onkeydown' => 'return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )',
                                    );
                                    echo form_input($data);
								?>
                          </div>
                        <div class="form-group">
                                <button class="btn btn-lg btn-primary btn-block" type="submit">Add Auditor</button>
                          </div>
                    </form>
                </div>
 
            </div>
        
        
      </div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>