
<body>
	<small>
    <div id="wrapper">

        <!-- Navigation -->


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header"></h4>
                </div>
				<div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Import Declaration Form (I.D.F) Details
                        </div>
                        <!-- /.panel-heading -->
                    <!-- /.panel --> 
					 <div class="panel-body panel-default">
					 <div class="panel panel-default">
                        <div class="panel-heading">
                            Update IDF Number
											<ul class="nav  navbar-right" style="margin-top:-10px;">		  
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                         <i class="fa fa-caret-down"></i>
						More IDF Information 
                    </a>
                    <ul class="dropdown-menu dropdown-user">
					
                          <li><a href="<?php echo base_url();?>idf/"> Main IDF Information</a>
                        </li>
                        <li><a href="<?php echo base_url();?>idf/idfShippingInfo"> Shipping Information</a>
                        </li>
                        <li class="divider"></li>
                        
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
				</ul>  
                        </div>
                        <!-- /.panel-heading -->
<div class="panel-body">												
					<div class="row">

		 <div class="col-lg-9">
						 <div class="panel panel-default">
						 <div class="panel-body">
									 	<p></p>

					 <div id="MainData">
                    <div class="panel panel-default">
					<div class="row">
					<div class="col-lg-4">

			
						</DIV>

						</div>	
                        <div class="panel-heading">
                           Select a Record to Update
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

     <div class="table-responsive table-bordered" style="" >
	<p></p>					<div class="dataTable_wrapper" style="width:1000px;height:200px" id="pendingInvoices">	

	<table class="table">
		<thead>
			<tr>
				<th><input type="checkbox" id="checkAll"></th>
				<th>Indent No</th>
				<th>Amount Expected</th>
				<th>Date IDF Applied</th>
				<th>Date IDF Expected</th>
				<th>PSI Agency</th>
				<th>Exporter Name</th>
				<th>Indent Date</th>
				<th>Prepared By</th>
			</tr>
		</thead>
<tbody>
	 <?php 
	 $IndentNo= "";
	 if(isset($AllPendingIDFData)){
		 foreach($AllPendingIDFData as $key);
		 
			 $IndentNo = $key->IndentNo;
	 }
		// print_r($AllPendingIDFData);} else echo "checked";
		 ?>
	<?php 
	if(isset($ShowAllPendingIDF)){
		$items = "";
	foreach($ShowAllPendingIDF as $key1):
		
	?>

	 <tr <?php if($IndentNo==$key1->IndentNo){echo "style='background-color:#FF00CC'";}?>>
		<td ><input type="checkbox" <?php if($IndentNo==$key1->IndentNo){echo "checked";}?> name="invoice" onchange="loadIDFNumber('<?php echo $key1->IndentNo?>')"></td>
			<td style="cell-padding:55px"><?php echo $key1->IndentNo?></td>
		<td><?php echo $key1->PrepaidAmount?></td>
	   <td><?php echo substr($key1->DateApplied,0,10)?></td>
	   <td><?php echo substr($key1->LastExpected,0,10)?></td>
		<td><?php echo $key1->PSIAgency?></td>
		 <td><?php echo $key1->ExporterName?></td>
		  <td><?php echo $key1->IndentDate?></td>
			<td><?php echo $key1->StaffIDNo?></td>
	</tr>
<?php 
endforeach;
	}
				
	?>
                                    </tbody>
                                </table>
								
                            </div>
							</div>
</div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
					</div>
					</div>
										<div class="col-lg-3">
									  <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
	<form role="form" id="IDFNumber" action="idf/updateIDFNo">
	                                        <div class="form-group">
                                            <label>Indent Number</label>
                                         
<input class="form-control input-sm" type="text" value="<?php echo $IndentNo;?>" name="indentNo2" readonly id="indentNo2" placeholder="" style="width:95%">
										</div>
                                        <div class="form-group">
                                            <label>I.D.F Number</label>
                                         
<input class="form-control input-sm" type="text" name="IDFNumber" id="indentNo2" placeholder="" style="width:95%">
										</div>
										
										<div id="productDetails">
										<div class="form-group">
                         <label>I.D.F Date</label>
                        <input class="form-control input-sm" name="IDFDate" id="reservation3"  style="width:100%" value="" >
						</div>
						<div class="form-group">
                         <label> Date Received</label>
                        <input class="form-control input-sm" name="DateReceived" id="reservation2"  style="width:100%" value="" >
						</div>
	
	                   
										
										</div>
					<button type="submit" id="updateIDFNo" class="btn btn-success btn-sm">Save Details</button>
							</form>
						
						<p id="loading2"></p>
						</div>
									</div>
									</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
						
																	
						</div>
						
					</div>
						</div>
							 
								  </div>
								  </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default" hidden>
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body" >
                            <div id="morris-area-chart"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default" hidden>
          
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-8" >
                                    <div id="morris-bar-chart"></div>
                                </div>
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                   
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    
                    <!-- /.panel -->
                   
                        <div class="panel-body" hidden>
                            <div id="morris-donut-chart"></div>
                           
                        </div>
                        <!-- /.panel-body -->
                   
                    <!-- /.panel -->
                    
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -==================================================================================->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Footer -->

	</small>

<script>

	function loadIDFNumber(val)
 {  

	 if(val == "")
	 {
		 return;
	 } else {
		 window.location ="<?php echo base_url();?>idf/IDFNumber/"+val;
		
		 
	 } 
 }
 
 	function showPSI()
 {  

if($('#psiCheckbox').is(":checked")){
	$('#psi').show();
	$('#psivalue').val('1');
	
}else{
	$('#psi').hide();
	$('#psivalue').val('0');
}
 }
  	function showPriorApprovalvalue()
 {  
if($('#PriorApproval').is(":checked")){
	$('#PriorApprovalvalue').val('1');
	$('#psi2').show();
}else{
	$('#PriorApprovalvalue').val('0');
	$('#psi2').hide();
}
 }
 
 function localInspection()
 {
	 if($('#Inspection').is(":checked")){
	$('#Inspectionvalue').val('1');
}else{
	$('#Inspectionvalue').val('0');

}
 }
 
  function COMESAApplication()
 {
	 if($('#COMESA').is(":checked")){
	$('#COMESAvalue').val('1');
}else{
	$('#COMESAvalue').val('0');

}
 }
 
   function getDate()
 {
	 $('#EDT').val($('#reservation3').val());
 }

</script>
</body>

</html>
