<?php
$this->load->view('vwHeader');

?>


<div class="row">
                    <div class="col-lg-12">
                        <h1>Start survey</h1>
                        <p>Start survey.</p>
                        <p>All questions are mendetry.</p>
                    </div>
                </div>
<div class="row">
    <div class="col-sm-12">
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
                        <?php echo $succ; ?><a href="<?php echo base_url(); ?>home" class="btn btn-sm btn-warning">Go to list of Inspections</a>
                    </div>
        <?php
        }
        ?>
        <form enctype="multipart/form-data" method="post" class="form-signin panel">
          <input type="hidden" name="noq" value="<?php echo count($quiz); ?>" >
            <?php

             foreach($quiz as $key => $ques){
               $key = $key+1; 
                 echo '<div class="col-xs-12">';
               echo "<h4>".$ques['aspects']."</h4>";
                 echo "<br/><hr/><h4>".$ques['question_group']."</h4>";
                 echo "<div id='err_".$key."'></div>";
                 
                 echo '<div class="row"><div class="col-xs-6">';
               echo "<h5>(". $key . ") ".$ques['question'] ."</h5>";
                echo '<input type="hidden" name="question_'.$key.'" value="'.$ques['qid'].'" >';
                //Options starts here 
                 if($ques['option_A'] != ''){
                     echo '<div class="form-group">';
                     echo '<label class="radio"><input type="radio" value="'.$ques['option_A_score'].'" name="option_'.$key.'">'.$ques['option_A'].'</label>';
                     echo '</div>';
                  }
                 if($ques['option_B'] != ''){
                     echo '<div class="form-group">';
                     echo '<label class="radio"><input type="radio" value="'.$ques['option_B_score'].'" name="option_'.$key.'">'.$ques['option_B'].'</label>';
                     echo '</div>';
                  }
                 
                 if($ques['option_C'] != ''){
                     echo '<div class="form-group">';
                     echo '<label class="radio"><input type="radio" value="'.$ques['option_C_score'].'" name="option_'.$key.'">'.$ques['option_C'].'</label>';
                     echo '</div>';
                  }
                 
                 if($ques['option_D'] != ''){
                     echo '<div class="form-group">';
                     echo '<label class="radio"><input type="radio" value="'.$ques['option_D_score'].'" name="option_'.$key.'">'.$ques['option_D'].'</label>';
                     echo '</div>';
                  }
                 ?>
            <div class="col-xs-6">
                <div class="form-group">
                    <label class="btn btn-danger btn-file">
                       <span>Record Video</span> <input type="file" class="video" name="video_<?php echo $key; ?>" accept="video/*" capture="camcoder">
                    </label>
                </div>
            </div>
            <div class="col-xs-6">
            <div class="form-group">
                    <label class="btn btn-warning btn-file">
                       <span>Capture Image</span> <input type="file" class="image" name="image_<?php echo $key; ?>" accept="image/*" capture="camera">
                    </label>
                </div>
            </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <p>Suggesstion</p>
                    <textarea name="suggesstion_<?php echo $key; ?>"></textarea>
                 </div>
                    <div class="form-group">
                    <p>Remark</p>
                    <textarea name="remark_<?php echo $key; ?>"></textarea>
                 </div>
            </div>
        </div> 
            <div class="question_footer">
               <?php if($key !=1){ ?> <a class="prev btn btn-sm btn-success"href="#">prev</a><?php } ?>&nbsp;&nbsp;<a id="check_<?php echo $key; ?>" class="next btn btn-sm btn-success"href="#">next</a>&nbsp;&nbsp;

        </div>
             <?php
                 
                 // last line of div class xs-12  
                echo '</div>'; 
             }
            ?>
       <div class="col-xs-12">
        <div class="form-group">
                    <p>Comment</p>
                    <textarea name="finam_comment"></textarea>
            <input type="hidden" id="latilong" name="latilong" value="">
         </div>
           <div class="form-group">
               <button class="btn btn-sm btn-primary" type="submit">Submit</button>
           </div>
    </div>
       
        </form> 
    </div>
</div>
<script>
        $(document).ready(function () {
    var divs = $('form>div');
    var now = 0; // currently shown div
    var key;
    divs.hide().first().show();
    $(".next").click(function (e) {
        e.preventDefault();
        key = now + 1;
        /*
        if (!$("input[name='option_"+key+"']:checked").val()) {
            $('#err_'+key).html("<div class='alert alert-danger'>Please anser this question!</div>");
        return false;
    }
    else {*/
        divs.eq(now).hide();
        $('#err_'+key).html("");
        now = (now + 1 < divs.length) ? now + 1 : 0;
        divs.eq(now).show(); // show next
        getLocation();
   /* } */
    });
    $(".prev").click(function (e) {
        e.preventDefault();
        divs.eq(now).hide();
        now = (now > 0) ? now - 1 : divs.length - 1;
        divs.eq(now).show(); // or .css('display','block');
    });
            $('.video').change(function() {
    var a = $(this).val();
    if(a == "") {
        $(this).siblings('span').text("Record Video");
    } else {
        var theSplit = a.split('\\');
        $(this).siblings('span').text("Video Recorder");
    }
});
            $('.image').change(function() {
    var a = $(this).val();
    if(a == "") {
        $(this).siblings('span').text("Capture Image");
    } else {
        var theSplit = a.split('\\');
        $(this).siblings('span').text("Image Uploaded");
    }
});
    });
function getLocation() {
  if (navigator.geolocation)
    {
    navigator.geolocation.getCurrentPosition(showPosition);
    }
  else{ document.getElementById("latilong").value = "";}
  }
function showPosition(position)
  {
      document.getElementById("latilong").value = 'lat: '+ position.coords.latitude+', lng:'+ position.coords.longitude;  
  }
 </script>
<style>
    input[type="file"].video, input[type="file"].image {
        display: none;
    }
</style>
<?php
$this->load->view('vwFooter');
?>