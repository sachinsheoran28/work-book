(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create','UA-43091346-1','devzone.co.in');ga('send','pageview');

var base_url = 'http://mcd.www.glocalthinkers.in/index.php/';

$(document).ready(function(){
$('#vtp').change(function (){
$("#office > option").remove();
$('#office').append('<option value="0">TOP LEVEL</option>'); 
var ssc = $('#vtp').val();
 event.preventDefault();


    $.getJSON(base_url + "admin/vtp/get_office/"+ssc+"/0", function (data) {

      var items = data.map(function (item) {
          if(item.parentid == 0){
           $('#office').append('<option value="'+ item.centid +'">'+ item.center_name +'</option>'); 
         } else{
               $('#office').append('<option value="'+ item.centid +'">- '+ item.center_name +'</option>'); 
            }
      }); 
    });
    
});
    
 $('#office').change(function (){
     $("#innertops > div").remove();
     select_p('select[name="parentid"]');
 });
    select_p('select[name="parentid"]');
    
});
function select_p(div) {
    return $(div).change(function (){
// $("#office > option").remove();
//$('#office').append('<option value="0">TOP LEVEL</option>');  
var ssc = $('#vtp').val();
        
var offid = 0;
offid = $(div).val();
var offtext = $(div +' option:selected').text();
//$("#innertops > div").remove();

if(offid != 0){
    $("#innertops  div#child"+offid+"").remove();
     $(div).attr('name', 'other_amount');
    $("#innertops").append("<div id='child"+offid+"'><select name='parentid' class='form-control' id='office"+offid+"'></select></div>"); 
    
}
    
 event.preventDefault();

    $.getJSON(base_url + "admin/vtp/get_office/"+ssc+"/"+offid, function (data) {
        $(div+" > option").remove();
      $(div).append('<option value="'+offid+'">keep under '+offtext+'</option>'); 
     
      var items = data.map(function (item) {
           $('#office'+offid+'').append('<option value="'+ item.centid +'">-'+ item.center_name +'</option>'); 
      });
    });
    select_p(div); 
    $('select[name="other_amount"]').change(function(){
       //select_p(this); 
        $(this).attr('name', 'parentid');
        //$('select[name="parentid"]').closest('div').remove();
        $(this).closest('div').nextAll().remove();
        var ssc = $('#vtp').val();
            var text = $(this).attr('id');
            var res = text.replace("office", "");
            var ofid = 0;
            ofid = $(this).val();
          console.log(ofid);
            offtext = $('select[name="parentid"] option:selected').text();
        
       //$(this).attr('name', 'parentid');
        if(ofid != res){
        // $("#innertops  div#child"+offid+"").remove();
         $(this).attr('name', 'other_amounto');
          $("#innertops").append("<div id='child"+ofid+"'><select name='parentid' class='form-control' id='office"+ofid+"'></select></div>"); 
    
      } else{
          $(this).attr('name', 'parentid');
      }
         event.preventDefault();

    $.getJSON(base_url + "admin/vtp/get_office/"+ssc+"/"+ofid, function (data) {
        
        $("select[name='parentid'] > option").remove();
      $("select[name='parentid']").append('<option value="'+ofid+'">keep under '+offtext+'</option>'); 
      var items = data.map(function (item) {
           $('#office'+ofid+'').append('<option value="'+ item.centid +'">-'+ item.center_name +'</option>'); 
      });  
       
       
    });
        
      select_p(div);   
        
    });
        
       
       //$('.parentid').attr('name', 'parentid');
 
});
 
}

