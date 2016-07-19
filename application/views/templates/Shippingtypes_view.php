
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
                           Determination of Shipping Types
											<ul class="nav  navbar-right" style="margin-top:-10px;">		  
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                         <i class="fa fa-caret-down"></i>
						More Shipment Information 
                    </a>
                    <ul class="dropdown-menu dropdown-user">
						<li><a href="<?php echo base_url();?>shiptracking/Shippingtypes"> Determination of Shipping Types</a>
                        </li>
                        <li><a href="<?php echo base_url();?>shiptracking/ShippingDetails"> Specify Shipping Details</a>
                        </li>
                        <li><a href="<?php echo base_url();?>shiptracking/commoditiesInfo"> Comodities Information</a>
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
	
					<div class="col-lg-8">
     <div class="table-responsive table-bordered" style="" >
	<p></p>					<div class="dataTable_wrapper" style="width:1500px;height:300px" id="pendingInvoices">	

	<table class="table">
		<thead>
			<tr>
				<th><input type="radio" id=""></th>
				<th>Indent No</th>
				<th>IDF Number</th>
				<th>Order Date</th>
				<th>Duty Free</th>
								
				<th>Date Expected</th>
				<th>Importer Code</th>
				<th>Exporter Code</th>
				<th>Shipped to</th>
				
				<th>Trans Terms</th>
				<th>Bank Code</th>
				<th>Currency</th>
				<th>Total FOB Value</th>
				<th>Total Freight</th>
				<th>Total Insurance</th>
				<th>Other Charges</th>
				<th>Ins Prepaid?</th>
				
				
				
				
			</tr>
		</thead>
<tbody>
	 <?php 
 $IndentNo= "";
	 if(isset($GetNewAcknowledgedData)){
		
		 foreach($GetNewAcknowledgedData as $key);
		 $IndentNo = $key->IndentNo;
	 }
		// print_r($AllPendingIDFData);} else echo "checked";
		 ?>
	<?php 
	if(isset($GetNewAcknowledged)){
	foreach($GetNewAcknowledged as $key1):
		
	?>

	 <tr <?php if($IndentNo==$key1->IndentNo){echo "style='background-color:#FF00CC'";}?>>
		<td ><input type="radio" <?php if($IndentNo==$key1->IndentNo){echo "checked";}?> name="invoice" onchange="loadData('<?php echo $key1->IndentNo?>')"></td>
		<td style="cell-padding:55px"><?php echo $key1->IndentNo?></td>
		
		<td><?php echo $key1->IDFNumber?></td>
		<td><?php echo substr($key1->OrderDate,0,10)?></td>
		<td><?php echo $key1->DutyFree?></td>
		<td><?php echo substr($key1->ACKExpected,0,10)?></td>
		<td><?php echo $key1->ImporterCode?></td>
		<td><?php echo $key1->ExporterCode?></td>
		<td><?php echo $key1->ShipTo?></td>
		<td><?php echo $key1->TransTerm?></td>
		<td><?php echo $key1->BankCode?></td>
		<td><?php echo $key1->Currency?></td>
		<td><?php echo number_format($key1->TotalFOBValue, 2, '.', '');?></td>
		 
		<td><?php echo $key1->FreightValue?></td>
		<td><?php echo $key1->InsuranceValue?></td>
		<td><?php echo $key1->OtherChargesValue?></td>
		<td><?php echo $key1->InsuranceLocal?></td>
			
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
	<form id="idfmain" role="form" action="shiptracking/saveShippingType" method="POST">					
			<input type="hidden" id="IndentNo" value="<?php echo $IndentNo?>" name="IndentNo">	
				<div class="col-lg-4">
					<div class="form-group">
					<label>Choose the Type of Shipment</label>
					<div class="checkbox">
					<label>
					<input type="radio" value="0" id="psiCheckbox" onchange="showPSI()" name="Type">Full Shipment (All Items Shiped Once) 
					</label>
					<input type="hidden" id="psivalue" value="" name="psivalue">
					</div>
				</div>
				<div class="form-group">

					<div class="checkbox">
					<label>
					<input type="radio" value="0" id="PriorApproval" name="Type" onchange="showPriorApprovalvalue()">Part Shipment (Items Shiped in Parts)
					</label>
					<input type="hidden" id="PriorApprovalvalue" value="0" name="PriorApprovalvalue">
					</div>


				</div>
				<div id="div" hidden>
					<div class="form-group">
					<label>How to Handle Part Shipment</label>
					<div class="checkbox">
					<label>
					<input type="radio" value="0" id="whole" onchange="getHandle('H')" name="Handle">Define Parts by whole Comodities 
					</label>
					<input type="hidden" id="Handleval" value="" name="Handleval">
					</div>
				</div>
				<div class="form-group">

					<div class="checkbox">
					<label>
					<input type="radio" value="1" id="packages" name="Handle" onchange="getHandle('Q')">Define Parts by packages/Quantities 
					</label>
					<input type="hidden" id="packagesvalue" value="0" name="packagesvalue">
					</div>


				</div>
				
				<div class="form-group">

					<div class="checkbox">
					<label>
					<input type="radio" value="2" id="Combosite" name="Handle" onchange="getHandle('C')">Combosite (Combine the 2 above)
					</label>
					<input type="hidden" id="PriorApprovalvalue" value="0" name="PriorApprovalvalue">
					</div>


				</div>
				</div>
				<div class="form-group">
<label>Total parts</label>
					<input type="number" class="form-control input-sm" style="width:50%;" id="Total"  name="Total"
					onmousedown="getTotalNo()" onkeydown="deny()" />


				</div>
				  <div class="form-group">


		 <input   type="submit" id="saveShippingType" value="Save  Details" class="btn btn-success btn-sm pull-right"/>
		 <p id="loading2"></p>
							</DIV>
					</div>
					</form>
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

	function loadData(val)
 {  

	 if(val == "")
	 {
		 return;
	 } else {
		 window.location ="<?php echo base_url();?>shiptracking/Shippingtypes/"+val;
		 //document.getElementById(Id).value = val
		 
	 } 
 }
 
 	function showPSI()
 {  

if($('#psiCheckbox').is(":checked")){
	$('#psivalue').val('F');
	$('#Total').val('1');
	$('#Handleval').val('X');
	$('#div').hide();
}else{
	$('#psivalue').val('');
	$('#Total').val('');
}
 }
  	function showPriorApprovalvalue()
 {  

if($('#PriorApproval').is(":checked")){
	
		$('#div').show();
	$('#psivalue').val('P');
	$('#Total').val('2');
	
}else{
	$('#div').hide();
	$('#psivalue').val('');
	$('#Total').val('');
}
 }
   	function getTotalNo()
 {  

if($('#PriorApproval').is(":checked")){
	$("#Total").attr("max","100");
	$("#Total").attr("min","2");	
}else if($('#psiCheckbox').is(":checked")){
	$("#Total").attr("max","1");
	$("#Total").attr("min","1");	
}else{return;}
 }
 
 function getHandle(x)
 {
	 if($('#PriorApproval').is(":checked"))
	 {
		 $('#Handleval').val(x);
	 }else{
		 $('#Handleval').val('');
		 return;
	 }
 }
 
 
  function deny(x)
 {

 }
</script>
</body>

</html>
