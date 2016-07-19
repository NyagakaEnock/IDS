
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
	
					<div class="col-lg-5">
     <div class="table-responsive table-bordered" style="" >
	<p></p>					<div class="dataTable_wrapper" style="width:1700px;height:300px" id="pendingInvoices">	

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
				<th>Ship Type</th>
				<th>Define By</th>
				<th>Total Parts</th>
				
				
				
				
			</tr>
		</thead>
<tbody>
	 <?php 
 $IndentNo= "";
 $Currency= "";
 $OtherCharges= "";
 $Freight= "";
 $Insurance = "";
	 if(isset($GetOrdersWithTypeData)){
		
		 foreach($GetOrdersWithTypeData as $key);
		 $IndentNo = $key->IndentNo;
		  $Currency = $key->Currency;
		   $OtherCharges = $key->OtherChargesValue;
		    $Freight = $key->FreightValue;
			$Insurance = $key->InsuranceValue;
	 }
		// print_r($AllPendingIDFData);} else echo "checked";
		 ?>
	<?php 
	if(isset($GetOrdersWithType)){
	foreach($GetOrdersWithType as $key1):
		
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
		<td><?php echo $key1->Types?></td>
		<td><?php echo $key1->PartsBy?></td>
		<td><?php echo $key1->TotalParts?></td>
			
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

				<div class="col-lg-7">
									  <div class="panel panel-default">
									  						 <div class="panel-heading">
                        Order Confirmation Details
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
<small>
	<form role="form" id="Amendments" action="shiptracking/saveShippingDetails">
	<div class="col-lg-3">
		                            <div class="form-group">
												  <label>Insurance</label>                                
<input class="form-control input-sm" type="text" value="<?php echo $Insurance;?>" name="Insurance"  id="" placeholder="" style="width:100%">
<input class="form-control input-sm" type="hidden" value="<?php echo $IndentNo?>" name="IndentNo"  id="IndentNo" placeholder="" style="width:100%">

	 								</div>
	   </div> 
	<div class="col-lg-3">
		                            <div class="form-group">
												  <label>Other Charges</label>                                
<input class="form-control input-sm" type="text" value="<?php echo $OtherCharges;?>" name="OtherCharges"  id="" placeholder="" style="width:100%">

	 								</div>
	   </div>  
	<div class="col-lg-3">
		                            <div class="form-group">
												  <label>Freight Val</label>                                
<input class="form-control input-sm" type="text" value="<?php echo $Freight;?>" name="Freightvalue"  id="" placeholder="" style="width:100%">

	 								</div>
	   </div> 
	<div class="col-lg-3">
		                            <div class="form-group">
												  <label>Currency</label>                                
<select class="form-control select2" style="width:100%"   name="Currency" id="">
		<option  ><?php echo  $Currency;?></option>
		<?php foreach($getCurrency as $row):


		?>
		<option value="<?php echo $row->Currency;?>"><?php echo $row->Currency;?></option>

		<?php

		endforeach;
		?>
</select>

	 								</div>
	   </div> 

	<div class="col-lg-6">
		                            <div class="form-group">
												  <label>Loading Port</label>                                
<select class="form-control select2" style="width:100%"   name="LoadingPort" id="">
		<option  ><?php //echo  $AttentionTo;?></option>
		<?php foreach($ParamPorts as $row):


		?>
		<option value="<?php echo $row->PortName;?>"><?php echo $row->PortName;?></option>

		<?php

		endforeach;
		?>
</select>

	 								</div>
	   </div>  
	<div class="col-lg-6">
		                            <div class="form-group">
												  <label>Transhipping Port</label>                                
<select class="form-control select2" style="width:100%"   name="TranshippingPort" id="">
		<option  ><?php echo  "N/A";?></option>
		<?php foreach($ParamPorts as $row):


		?>
		<option value="<?php echo $row->PortName;?>"><?php echo $row->PortName;?></option>

		<?php

		endforeach;
		?>
</select>

	 								</div>
	   </div>  
	<div class="col-lg-6">
		                            <div class="form-group">
												  <label>Vessel Name</label>                                
<input class="form-control input-sm" type="text" value="<?php //echo $date;?>" name="VesselName"  id="" placeholder="" style="width:100%">

	 								</div>
	   </div>  
	<div class="col-lg-6">
		                            <div class="form-group">
												  <label>Transhipping Vessel</label>                                
<input class="form-control input-sm" type="text" value="<?php //echo $date;?>" name="TranshippingVessel"  id="" placeholder="" style="width:100%">

	 								</div>
	   </div>  
	<div class="col-lg-3">
		                            <div class="form-group">
												  <label>Discharge Port</label>                                
<select class="form-control select2" style="width:100%"   name="DischargePort" id="">
		<option  ><?php //echo  $AttentionTo;?></option>
		<?php foreach($DischargePorts as $row):


		?>
		<option value="<?php echo $row->PortName;?>"><?php echo $row->PortName;?></option>

		<?php

		endforeach;
		?>
</select>

	 								</div>
	   </div> 
	<div class="col-lg-3">
		                            <div class="form-group">
												  <label>Packing Mode</label>                                
<select class="form-control select2" style="width:100%"   name="PackingMode" id="">
		<option  ><?php //echo  $AttentionTo;?></option>
		<?php foreach($ParamPackingModes as $row):


		?>
		<option value="<?php echo $row->PackingMode;?>"><?php echo $row->PackingModeName;?></option>

		<?php

		endforeach;
		?>
</select>

	 								</div>
	   </div>  
	<div class="col-lg-3">
		                            <div class="form-group">
												  <label>Total No</label>                                
					<input type="number" class="form-control input-sm" style="width:100%;" id="Total"  name="Total"
					onmousedown="getTotalNo()"  />

	 								</div>
	   </div> 
	<div class="col-lg-3">
		                            <div class="form-group">
												  <label>Description</label>                                
<select class="form-control select2" style="width:100%"   name="Description" id="" onchange="getMarks(this.value)">
		<option  ><?php //echo  $AttentionTo;?></option>
		<?php foreach($CNTypeName as $row):


		?>
		<option value="<?php echo $row->CNTypeName;?>"><?php echo $row->CNTypeName;?></option>

		<?php

		endforeach;
		?>
</select>

	 								</div>
	   </div> 	
	<div class="col-lg-12">
		                            <div class="form-group">
												  <label>Marks and Numbers</label>                                
<textarea class="form-control input-sm" rows="2"  name="MarksandNumbers"  id="MarksandNumbers" style="width:100%"></textarea>

	 								</div>
	   </div> 
	<div class="col-lg-3">
		                            <div class="form-group">
												  <label>Shipping Date</label>                                
<input class="form-control input-sm" type="text" value="<?php //echo $date;?>" name="ShippingDate"  id="reservation2" placeholder="" style="width:100%">

	 								</div>
	   </div>  
	<div class="col-lg-3">
		                            <div class="form-group">
												  <label>Date Expected</label>                                
<input class="form-control input-sm" type="text" value="<?php //echo $date;?>" name="DateExpected"  id="reservation3" placeholder="" style="width:100%">

	 								</div>
	   </div> 
	<div class="col-lg-6">
		                            <div class="form-group">
												  <label>Name of Declarant</label>                                
<select class="form-control select2" style="width:100%"   name="NameofDeclarant" id="">
		<option  ><?php //echo  $AttentionTo;?></option>
		<?php foreach($DeclarantName as $row):


		?>
		<option value="<?php echo $row->DeclarantNo;?>"><?php echo $row->DeclarantName;?></option>

		<?php

		endforeach;
		?>
</select>

	 								</div>
	   </div> 	   
					<button type="submit" id="saveShippingDetails" class="btn btn-success btn-sm pull-right">Save Details</button>
							</form>
						</small>
						<p id="loading2" class="pull-left"></p>
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

	function loadData(val)
 {  
	 if(val == "")
	 {
		 return;
	 } else {
		 window.location ="<?php echo base_url();?>shiptracking/ShippingDetails/"+val;
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

	$("#Total").attr("max","100");
	$("#Total").attr("min","0");	
	
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
 
 function getMarks(x)
 {
	 if(x=="NOT APPLICABLE")
	 {
		 $('#MarksandNumbers').val('AIR FREIGHT CONSIGNMENT S.T.C.'); 
	 }
	 
 }
  function deny(x)
 {

 }
</script>
</body>

</html>
