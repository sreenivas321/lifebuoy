

<div id="content">
    <h2>Report &raquo; Rejected Twitter </h2>
  

    <dl>           
    <dt>
    Filter By Date:<br />
			<form method="post" id="add_product_form" enctype="multipart/form-data" action="<?php echo site_url('lifebuoy_adm/twitter/rejected_csv');?>">
      <input type="hidden" name="status" value="1" />
        
           <dl>
            <dd>Start Date</dd>
            <dt><input class="txtField date_picker" style="width:100px;margin-right:5px;" type="text" name="start_date" id="start_date" readonly="readonly" value="<?php echo $start_date?>"/><br />
			<a href="#" onclick="$('#start_date').val('');return false;">Clear Date</a></dt>
        </dl>
        <dl>
            <dd>End Date</dd>
            <dt><input class="txtField date_picker" style="width:100px;margin-right:5px;" type="text" name="end_date" id="end_date" readonly="readonly" value="<?php echo $end_date;?>" /><br />
			<a href="#" onclick="$('#end_date').val('');return false;">Clear Date</a></dt>
        </dl>
    <dl>
        <dd></dd>
       <dt><input type="submit" id="add_product_submit" class="defBtn" value="Submit"/> <input type="button" class="defBtn" value="Back" onclick="window.location='<?php echo site_url('lifebuoy_adm/twitter');?>';" /></dt>
    </dl>


        </form>
        
    </dt>
</dl>
<?php   if($twitter){?>

    <div id="submenu">
        <ul>
            <li>
            	<a class="defBtn" href="#" onclick="download_page();"><span>Download</span></a> 
                  
            </li>
            
        </ul>
    </div>    
    
    
 <?php } ?>   
</div>
<script>
$(document).ready(function(){
		$('.date_picker').datepicker({
		showOn: "button",
		buttonImage: base_url+"templates/images/calendar.gif",
		buttonImageOnly: true,
		buttonText: "Select Date",
		numberOfMonths: 1,
		showButtonPanel: true,
		yearRange: "-80:+80",
		changeYear: true,
		dateFormat: "yy-mm-dd",
		minDate: "-100"
	});
	
	});
</script>

<script type="text/javascript">
function download_page(){
	var start_date=$("#start_date").val();
	var end_date=$("#end_date").val();
		
	var url='<?php echo site_url('lifebuoy_adm/twitter/download_rejected_form')?>/'+start_date+'/'+end_date;	
	window.open(url);
}
</script>

    