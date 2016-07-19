
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
						Pre-Shipping Insurance Cover
                            
											<ul class="nav  navbar-right" style="margin-top:-10px;">		  

				</ul>  
                        </div>
                        <!-- /.panel-heading -->
<div class="panel-body">												
					<div class="row">

		 <div class="col-lg-6">
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
                         Select Insurance
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

     <div class="table-responsive table-bordered" style="" >
	<p></p>					<div class="dataTable_wrapper" style="width:3000px; height:200px" id="pendingInvoices">	

	<table class="table">
		<thead>
			<tr>
				<th>#</th>
				<th>Part Indent No</th>
				<th>Indent No</th>
				<th>Part No</th>
				<th>Ship Type</th>
				<th>IDF No</th>
				<th>Expoter Code</th>
				<th>Importer Code</th>		
				<th>Freight Type</th>
				<th>Loading Port</th>
				<th>Vessel Name.</th>
				<th>Transhipping Port</th>
				<th>Transhipping Vessel</th>
				<th>Shipping Date</th>
				<th>Date Expected</th>
				<th>Discharge Port</th>
				<th>Packing Mode</th>
				<th>Marks / Numbers</th>
				<th>Define By</th>
				<th>Total FOB Value</th>
				<th>Freight Value</th>
				<th>Other Charges</th>
				<th>Supplier's Currency</th>
				<th>Freight Currency</th>
				<th>Declarant No</th>
			</tr>
		</thead>
<tbody>
	 <?php 
	 $IndentNo= "";
	 $ActPacks = "";
	 $OtherCharges = "";
	 $TotalFreight = "";
	 $Currency = "";
	 $LoadingPort = "";
	 $DeclarantNo = "";
	 
	 if(isset($ShowDeterminedTypesData)){
		
		 foreach($ShowDeterminedTypesData as $key);
		 $IndentNo = $key->IndentNo;
		$OtherCharges = $key->TotalOtherCharges;	
		$TotalFreight = $key->TotalFreight;
		$Currency = $key->Currency;
		$LoadingPort = $key->LoadingPort;
		$DeclarantNo = $key->DeclarantNo;
		
	 }
		 ?>
	<?php 
	if(isset($ShowDeterminedTypes)){
	foreach($ShowDeterminedTypes as $key1):
		
	?>

	 <tr <?php if($IndentNo==$key1->IndentNo){echo "style='background-color:#FF00CC'";}?>>
		<td><input type="radio" <?php if($IndentNo==$key1->IndentNo){echo "checked";}?> name="" onchange="loadIDFNumber('<?php echo $key1->IndentNo?>')"></td>
		<td><?php echo $key1->PartIndentNo?></td>
		<td style="cell-padding:55px"><?php echo $key1->IndentNo?></td>
		<td><?php echo $key1->PartNo?></td>
		<td><?php echo $key1->ShipmentType?></td>
		<td><?php echo $key1->IDFNumber?></td>
		<td><?php echo $key1->ExporterCode?></td>
		<td><?php echo $key1->ImporterCode?></td>
		<td><?php echo $key1->TransMode?></td>
		<td><?php echo $key1->LoadingPort?></td>
		<td><?php echo $key1->VesselName?></td>
		<td><?php echo $key1->TranshipPort?></td>
		<td><?php echo $key1->TranshipVessel?></td>
		<td><?php echo substr($key1->ShippingDate,0,10)?></td>
		<td><?php echo substr($key1->DateExpected,0,10)?></td>
		<td><?php echo $key1->DischargePort?></td>
		<td><?php echo $key1->PackingMode?></td>
		<td><?php echo $key1->MarksNumbers?></td>
		
		<td><?php echo $key1->DefinedBy?></td>
		<td><?php echo $key1->TotalFOBValue?></td>
		<td><?php echo $key1->TotalFreight?></td>
		<td><?php echo $key1->TotalOtherCharges?></td>
		<td><?php echo $key1->Currency?></td>
		<td><?php echo $key1->FreightCurrency?></td>
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
						<div class="panel panel-default">
						<?php if(isset($ComputeInsuranceFigures))
					{?>	
				 <div class="" align="center">
														 
						<h5>Calculated Amounts</h5>									 
						 </div>
						 <table class="" border="1px" width="100%">
		<thead>
			<tr>
				<th></th>
				<th>Marine</th>
				<th>War Strike</th>
			
			</tr>
		</thead>
		<tbody>
			<tr>
			<td>Insured</td>
			<td><?php echo number_format($ComputeInsuranceFigures['MarineInsured'], 2, '.', ',');?></td>
			<td><?php echo number_format($ComputeInsuranceFigures['WarStrikeInsured'], 2, '.', ',');?></td>
			</tr>
			<tr>
			<td>Rate (%)</td>
			<td><?php echo number_format($ComputeInsuranceFigures['MarineRate'], 4, '.', '');?></td>
			<td><?php echo number_format($ComputeInsuranceFigures['WarStrikeRate'], 4, '.', '');?></td>
			</tr>
			<tr>
			<td>Premium</td>
			<td><?php echo number_format($ComputeInsuranceFigures['MarineValue'], 2, '.', ',');?></td>
			<td><?php echo number_format($ComputeInsuranceFigures['WarStrikeValue'], 2, '.', ',');?></td>
			</tr>
			<tr>
			<th>Declared Amount</th>
			<th>Total Premium</th>
			<th></th>
			</tr>
			<td><?php echo number_format($ComputeInsuranceFigures['DeclaredAmount'], 2, '.', ',');?></td>
			<td><?php echo number_format($ComputeInsuranceFigures['TotalValue'], 2, '.', ',');?></td>
			</tr>
		</tbody>
		 </table>
		 
		
             <?php
		 
					}?>  
</div>					<!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

					</div>
					 

					</div>
										<div class="col-lg-6">
									  <div class="panel panel-default">
									  						 <div class="panel-heading">
								Insurance Details
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
	 <?php 
	 $ProductCode= "";
	 
	 if(isset($ShowProductsUnderIndentData)){
		
		 foreach($ShowProductsUnderIndentData as $key);
		 $ProductCode = $key->ProductCode;
		
		 
	 }
	 ?>
	<form role="form" id="Amendments" action="shiptracking/saveInsuranceCover">
								<div class="col-lg-4">
		                            <div class="form-group">
												  <label>Other Charges</label>
 <input class="form-control input-sm" type="" value="<?php echo $OtherCharges?>" name="OtherCharges"  id="" placeholder="" style="width:100%">                             
<input class="form-control input-sm" type="hidden" value="<?php echo $IndentNo?>" name="IndentNo"  id="IndentNo" placeholder="" style="width:95%">

	 								</div>
	                                       
								</div>
								<div class="col-lg-4">
		                            <div class="form-group">
												  <label>Total Freight</label>
 <input class="form-control input-sm" type="" value="<?php echo $TotalFreight?>" name="Freight"  id="" placeholder="" style="width:100%">                             


	 								</div>
	                                       
								</div>
										<div class="col-lg-4">
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
												  <label>Insured From (Loading Port)</label>
<select class="form-control select2" style="width:100%"   name="LoadingPort" id="">
		<option  ><?php echo  $LoadingPort;?></option>
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
												  <label>Insured To (City)</label>

<select class="form-control select2" style="width:100%"   name="InsuredTo" id="">
		<option  >NAIROBI</option>
		<?php foreach($TownCity as $row):


		?>
		<option value="<?php echo $row->TownCity;?>"><?php echo $row->TownCity;?></option>

		<?php

		endforeach;
		?>
</select>  


	 								</div>
	                                       
								</div>
								<div class="col-lg-6">
		                            <div class="form-group">
												  <label>AWB/BL. No</label>
 <input class="form-control input-sm" type="" value="<?php if(isset($FindBillOfLadingNo)) echo $FindBillOfLadingNo ?>" name="AWBNo"  id="" placeholder="" style="width:100%">                             


	 								</div>
	                                       
								</div>
								<div class="col-lg-6">
		                            <div class="form-group">
												  <label>AWB/BL. Date</label>
 <input class="form-control input-sm" type="" value="<?php  if(isset($FindBillOfLadingDate)) echo $FindBillOfLadingDate  ?>" name="AWBDate"  id="reservation3" placeholder="" style="width:100%">                             


	 								</div>
	                                       
								</div>
								<div class="col-lg-6">
		                            <div class="form-group">
												  <label>Declarant No</label>                          
<select class="form-control select2" style="width:100%"   name="DeclarantNo" id="">
		<option  ><?php echo  $DeclarantNo;?></option>
		<?php foreach($DeclarantName as $row):


		?>
		<option value="<?php echo $row->DeclarantNo;?>"><?php echo $row->DeclarantName;?></option>

		<?php

		endforeach;
		?>
</select> 

	 								</div>
	                                       
								</div>
								<div class="col-lg-6">
		                            <div class="form-group">
												  <label>Date Insured</label>
 <input class="form-control input-sm" type="" value="<?php echo date('Y-m-d')?>" name="DateInsured"  id="reservation2" placeholder="" style="width:100%">                             


	 								</div>
	                                       
								</div>
								<div class="col-lg-6">
		                            <div class="form-group">
												  <label>Goods Description</label>                          
<select class="form-control select2" style="width:100%"   name="GoodsDescription" id="">
		<option  ></option>
		<?php foreach($GoodsDescription as $row):


		?>
		<option value="<?php echo $row->GoodsDescription;?>"><?php echo $row->GoodsDescription;?></option>

		<?php

		endforeach;
		?>
</select> 


	 								</div>
	                                       
								</div>
								<div class="col-lg-6">
		                            <div class="form-group">
												  <label>Insurance Broker</label>
<select class="form-control select2" style="width:100%"   name="InsuranceBroker" id="">
		<option  ></option>
		<?php foreach($BrokersName as $row):


		?>
		<option value="<?php echo $row->BrokersCode;?>"><?php echo $row->BrokersName;?></option>

		<?php

		endforeach;
		?>
</select>  


	 								</div>
	                                       
								</div>
								
								<div class="col-lg-6">
		                            <div class="form-group">
												  <label>Insurance Company</label>                     

<select class="form-control select2" style="width:100%"   name="InsuranceCompany" >
		<option  ></option>
		<?php foreach($InsurersName as $row):


		?>
		<option value="<?php echo $row->InsurersCode;?>" id="<?php //echo $row->OpenCoverNO;?>"><?php echo $row->InsurersName;?></option>

		<?php

		endforeach;
		?>
</select> 
	 	
		</div>
	                                       
								</div>
								<div class="col-lg-6">
		                            <div class="form-group">
												  <label>Cover Note No</label>
 <input class="form-control input-sm" type="" value="<?php echo $ActPacks?>" name="CoverNoteNo"  id="" placeholder="" style="width:100%">                             


	 								</div>
	                                       
								</div>
								
					<button type="submit" id="saveInsuranceCover" class="btn btn-success btn-sm pull-right">Save Details</button>
							</form>
						
						<p id="loading2"></p>
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
		 
		 window.location ="<?php echo base_url();?>shiptracking/InsuranceCover/"+val;
		 
		 
	 } 
 }
 
 	function loadIDFNumber2(val,product)
 {  

	 if(val == "")
	 {
		 return;
	 } else {
		 
		 window.location ="<?php echo base_url();?>shiptracking/commoditiesInfo/"+val+"/"+product;
		 
		 
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
 
function fillCombo(valx)
{
	alert(valx);
	//$('#OpenCoverNO').val(val);
}
</script>
</body>

</html>
