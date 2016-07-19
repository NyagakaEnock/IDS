
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
						Comodities / Items Information
                            
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
                         Select Record
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

     <div class="table-responsive table-bordered" style="" >
	<p></p>					<div class="dataTable_wrapper" style="width:1500px;height:200px" id="pendingInvoices">	

	<table class="table">
		<thead>
			<tr>
				<th>#</th>
				<th>Part Indent No</th>
				<th>Indent No</th>
				<th>Part No</th>
				<th>Ship Type</th>
				<th>Loading Port</th>
				<th>Vessel Name.</th>
				<th>Transhipping Port</th>
				<th>Transhipping Vessel</th>
				<th>Shipping Date</th>
				<th>Date Expected</th>
				<th>Discharge Port</th>
				<th>Packing Mode</th>
				<th>Marks / Numbers</th>
				<th>Declarant No</th>
				<th>Define By</th>
				
			</tr>
		</thead>
<tbody>
	 <?php 
	 $IndentNo= "";
	 $ActPacks = "";
	 if(isset($GetItemsNewOrdersData)){
		
		 foreach($GetItemsNewOrdersData as $key);
		 $IndentNo = $key->IndentNo;
			
		 
	 }
		 ?>
	<?php 
	if(isset($GetItemsNewOrders)){
	foreach($GetItemsNewOrders as $key1):
		
	?>

	 <tr <?php if($IndentNo==$key1->IndentNo){echo "style='background-color:#FF00CC'";}?>>
		<td><input type="radio" <?php if($IndentNo==$key1->IndentNo){echo "checked";}?> name="" onchange="loadIDFNumber('<?php echo $key1->IndentNo?>')"></td>
		<td><?php echo $key1->PartIndentNo?></td>
		<td style="cell-padding:55px"><?php echo $key1->IndentNo?></td>
		<td><?php echo $key1->PartNo?></td>
		<td><?php echo $key1->ShipmentType?></td>
		<td><?php echo $key1->LoadingPort?></td>
		<td><?php echo $key1->VesselName?></td>
		<td><?php echo $key1->TranshipPort?></td>
		<td><?php echo $key1->TranshipVessel?></td>
		<td><?php echo substr($key1->ShippingDate,0,10)?></td>
		<td><?php echo substr($key1->DateExpected,0,10)?></td>
		<td><?php echo $key1->DischargePort?></td>
		<td><?php echo $key1->PackingMode?></td>
		<td><?php echo $key1->MarksNumbers?></td>
		<td><?php echo $key1->DeclarantNo?></td>
		<td><?php echo $key1->DefinedBy?></td>
	
		
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
                        Invoice Details
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
	 <?php 
	 $ProductCode= "";
	 if(isset($ShowProductsUnderIndentData)){
		
		 foreach($ShowProductsUnderIndentData as $key);
		 $ProductCode = $key->ProductCode;
		$ActPacks = $key->ActPacks;	
		 
	 }
	 ?>
	<form role="form" id="Amendments" action="shiptracking/saveComoditiesInvoice">
		                                        <div class="form-group">
												  <label>Total Allocated Packs</label>
 <input class="form-control input-sm" type="" value="<?php echo $ActPacks?>" name="PackagesReceived"  id="PackagesReceived" placeholder="" style="width:95%">                             
<input class="form-control input-sm" type="hidden" value="<?php echo $IndentNo?>" name="IndentNo"  id="IndentNo" placeholder="" style="width:95%">

	 								</div>
	                                       

								 <div class="form-group" id="showReason" >
					

	 								</div>
					<button type="submit" id="saveComoditiesInvoice" class="btn btn-success btn-sm">Save Details</button>
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
<div align="center"><label> Commodities Under Current [Part] Shipment</label></DIV>
     <div class="table-responsive table-bordered" style="" >
				<div class="dataTable_wrapper" style="width:1500px;height:200px" id="pendingInvoices">	

                                <table class="table">
                                    <thead>
                                        <tr style='background-color:#FF00CC'>
                                            <th>#</th>
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>Units/Pack</th>
											<th>Unit Size</th>
											<th>Qtty Units</th>
											<th>Country</th>
											<th>Currency</th>
											<th>Exch. Rate</th>
											<th>Pack. Type</th>
											<th>Actual Packs</th>
											<th>Avail. Packs</th>
											<th>Total Value</th>
											<th>Gross Weight</th>
											<th>Net Weight</th>
											<th>Commodity Code</th>
											<th>S.I.T.C.</th>
                                        </tr>
                                    </thead>
<tbody>

		<?php 
	$counter=1;
	if(isset($ShowProductsUnderIndent)){
		$items = "";
		
	foreach($ShowProductsUnderIndent as $key1):
		
	?>
	 <tr <?php if($ProductCode==$key1->ProductCode){echo "style='background-color:#337ab7'";}?>>
		<td ><input type="radio" <?php if($ProductCode==$key1->ProductCode){echo "checked";}?> name="invoice" onchange="loadIDFNumber2('<?php echo $IndentNo?>','<?php echo $key1->ProductCode?>')" value="<?php echo $key1->ProductCode?>"></td>
				<td><?php echo $key1->ProductCode?></td>
				<td><?php echo $key1->ProductName?></td>
				<td><?php echo $key1->UnitsPerPack?></td>
				<td><?php echo $key1->UnitSize?></td>
				<td><?php echo $key1->QttyUnits?></td>
				<td><?php echo $key1->Country?></td>
				<td><?php echo $key1->Currency?></td>
				<td><?php echo $key1->ExchRate?></td>
				<td><?php echo $key1->PackageType?></td>
				<td><?php echo $key1->ActPacks?></td>
				<td><?php echo $key1->ShipTypeBal?></td>
				
				<td><?php echo $key1->ActTotVal?></td>
				<td><?php echo $key1->ActGross?></td>
				<td><?php echo $key1->ActNetWt?></td>
				<td><?php echo $key1->CommodityCode?></td>
				<td><?php echo $key1->SITC?></td>
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
		 
		 window.location ="<?php echo base_url();?>shiptracking/commoditiesInfo/"+val;
		 
		 
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
 

</script>
</body>

</html>
