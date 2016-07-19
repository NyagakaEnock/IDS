
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
								Tracking of Shipments
                        </div>
                        <!-- /.panel-heading -->
                    <!-- /.panel --> 
					 <div class="panel-body panel-default">
					 <div class="panel panel-default">
                        <div class="panel-heading">
                            INSTRUCTIONS TO CLEARING AND FORWARDING AGENTS

                        </div>
                        <!-- /.panel-heading -->
<div class="panel-body">												
					<div class="row">

		 <div class="col-lg-7">
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
                        Acknowledged  Orders Having Documents
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

     <div class="table-responsive table-bordered" style="" >
	<p></p>					<div class="dataTable_wrapper" style="width:1800px;height:300px" id="pendingInvoices">	

	<table class="table">
		<thead>
			<tr>
				<th><input type="radio" id=""></th>
				<th>Part Indent No</th>
				<th>Indent No</th>
				<th>Dispatch Date</th>
				<th>Loading Port</th>
				<th>Date Due</th>				
				<th>Discharge Port</th>
				<th>Vessel Code</th>
				<th>Packing Mode</th>			
				<th>Marks / Nos</th>	
				<th>Transhipping Port</th>
				<th>Transhipping Vessel</th>
				<th>Exporter Code</th>
				<th>Importer Code</th>
				<th>IDF Number</th>
				<th>Declarant No</th>
			</tr>
		</thead>
<tbody>
	 <?php 
	 $IndentNo= "";
	 $Freight ="";
	 $Charges="";
	 $CarbonCopy = "";
	 $AttentionTo  = "";
	 $DeclarantNo = "";
	 if(isset($ShowWithDocumentsData)){
		
		 foreach($ShowWithDocumentsData as $key);
		 $IndentNo = $key->IndentNo;
		 $DeclarantNo = $key->DeclarantNo;
		 
	 }
		// print_r($AllPendingIDFData);} else echo "checked";
		 ?>
	<?php 
	if(isset($ShowWithDocuments)){
	foreach($ShowWithDocuments as $key1):
		
	?>

	 <tr <?php if($IndentNo==$key1->IndentNo){echo "style='background-color:#FF00CC'";}?>>
		<td ><input type="radio" <?php if($IndentNo==$key1->IndentNo){echo "checked";}?> name="invoice" onchange="loadIDFNumber('<?php echo $key1->IndentNo?>')"></td>
		<td ><?php echo $key1->PartIndentNo?></td>
		<td ><?php echo $key1->IndentNo?></td>
		<td><?php echo substr($key1->ShippingDate,0,10)?></td>
		<td><?php echo $key1->LoadingPort?></td>
		<td><?php echo substr($key1->DateExpected,0,10)?></td>
		<td><?php echo $key1->DischargePort?></td>
		<td><?php echo $key1->VesselName?></td>
		<td><?php echo $key1->PackingMode?></td>
		<td><?php echo $key1->MarksNumbers?></td>	
		<td><?php echo $key1->TranshipPort?></td>
		<td><?php echo $key1->TranshipVessel?></td>
		<td><?php echo $key1->ExporterCode?></td>
		<td><?php echo $key1->ImporterCode?></td>
		<td><?php echo $key1->IDFNumber?></td>
		<td><?php echo $key1->DeclarantNo?></td>
			
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
										<div class="col-lg-5">
									  <div class="panel panel-default">
									  						 <div class="panel-heading">
						PURCHASE ORDER PARTICULARS
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

	<form role="form" id="Amendments" action="shiptracking/SaveInstructions">
		                                        <div class="form-group">
												
  <?php

    $date=date_create(date('Y-m-d'));
date_add($date,date_interval_create_from_date_string("30 days"));
$date = date_format($date,"Y-m-d");
?>                                     
<input class="form-control input-sm" type="hidden" value="<?php echo $IndentNo?>" name="IndentNo"  id="IndentNo" placeholder="" style="width:95%">

	 								</div>
	                                       
                                         <div class="form-group">
										 <div class="row">
		 <div class="col-lg-12">
		                                             <label>Declarant No</label>
                                         
<select class="form-control select2" style="width:95%"  name="Terms" id="">
		<option ><?php echo  $DeclarantNo;?></option>
		<?php foreach($DeclarantName as $row):


		?>
		<option value="<?php echo $row->DeclarantNo;?>"><?php echo $row->DeclarantName;?></option>

		<?php

		endforeach;
		?>
		</select>
		 </div>
		</div>
								</div>
                                    
								                                     <div class="form-group">
                                            <label>Subject</label>
                                         
<input class="form-control input-sm" type="text" value="INSTRUCTIONS TO CLEARING AND FORWARDING AGENTS" name="Subject"  id="Subject" placeholder="" style="width:95%">

								</div>
								 <div class="form-group" id="showReason" >
                                            <label> Message</label>
                                         
<textarea class="form-control"   name="Message" rows="5"  style="width:95%"><?php if(isset($FindInstructMessage)){echo $FindInstructMessage;
}?></textarea>
	 								</div>
					<button type="submit" id="SaveInstructions" class="btn btn-success btn-sm">Save Details</button>
							</form>
						
						<p id="loading2"></p>
						</div>
									</div>
									</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
                     <div class="panel-body">
			 <div class="panel panel-default">		 
<div align="center"><label>  Received Documents Under Selected Order</label></DIV>
     <div class="table-responsive table-bordered" style="" >
				<div class="dataTable_wrapper" style="width:800px;height:200px" id="pendingInvoices">	

                                <table class="table">
                                    <thead>
                                        <tr style='background-color:#FF00CC'>
                                            <th><input type="checkbox" id="checkAll"></th>
                                            <th>Doc Code</th>
											 <th>Doc No</th>
											  <th>Doc Date</th>
                                            <th>Document Name</th>
                                            <th>Issued?</th>
                                        </tr>
                                    </thead>
<tbody>
	<?php 
	$counter=1;
	if(isset($ShowReceivedDocuments)){
		$items = "";
		
	foreach($ShowReceivedDocuments as $key1):
		
	?>
	 <tr>
				<td><input type="checkbox" name="invoice" value="<?php echo $key1->DocumentCode?>" ></td>
				<td><?php echo $key1->DocumentCode?></td>
				<td><?php echo $key1->DocumentNo?></td>
				<td><?php echo $key1->DocumentDate?></td>
				<td><?php echo $key1->DocumentName?></td>
				<td><?php if($key1->Issued==1)echo "Yes"; else echo "No";?></td>
	
	</tr>
<?php 
$counter= $counter+1;
endforeach;
$counter = $counter-1;	
	}
	
	?>
<input class="form-control input-sm" type="hidden" value="<?php echo $counter?>" name="counter"  id="counter" placeholder="" style="width:95%">
                                    </tbody>
                                </table>
								
                            </div>
							</div>
							</div>
							</div>
</div>						
																	
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
		 window.location ="<?php echo base_url();?>shiptracking/Instructions/"+val;
		
		 
	 } 
 }
 	function loadIDFNumber2(val)
 {  

	 if(val == "")
	 {
		 return;
	 } else {
		 window.location ="<?php echo base_url();?>confirmation/NonIDFIndents/"+val;
		
		 
	 } 
 }
 
 	function showPSI()
 {  

if($('#Approved').is(":checked")){
	$('#showReason').hide();
	$('#Approvedvalue').val('Y');
	
}else{
	
	$('#Approvedvalue').val('N');
}
 }
  	function ApprovedNotFunc()
 {  
if($('#ApprovedNot').is(":checked")){
	
	$('#showReason').show();
	$('#ApprovedNotvalue').val('Y');

}else{
	$('#ApprovedNotvalue').val('N');

}
 }
 

</script>
</body>

</html>
