
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
								Tracking of Shipping
                        </div>
                        <!-- /.panel-heading -->
                    <!-- /.panel --> 
					 <div class="panel-body panel-default">
					 <div class="panel panel-default">
                        <div class="panel-heading">
                           Commercial Invoice Verification

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
                         Purchase Orders Pending Verification
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

     <div class="table-responsive table-bordered" style="" >
	<p></p>					<div class="dataTable_wrapper" style="width:800px;height:200px" id="pendingInvoices">	

	<table class="table">
		<thead>
			<tr>
				<th><input type="radio" id=""></th>
				<th>Indent No</th>
				<th>IDF Number</th>
				<th>Order Date</th>							
				<th>Date Expected</th>
				<th>Exporter Name</th>
				<th>Total Items</th>			
			</tr>
		</thead>
<tbody>
	 <?php 
	 $ProductCode= "";
	 if((isset($ShowCommodityUnderIndent))&&($ShowCommodityUnderIndent!=null)){
		
		 foreach($ShowCommodityUnderIndent as $key);
	$ProductCode = $key->ProductCode;
	 }
		  
	 $IndentNo= "";
	 $Freight ="";
	 $Charges="";
	 $CarbonCopy = "";
	 $AttentionTo  = "";
	 if(isset($ShowNewAcknowledgedInfo)){
		
		 foreach($ShowNewAcknowledgedInfo as $key);
		 $IndentNo = $key->IndentNo;
	 }
		// print_r($AllPendingIDFData);} else echo "checked";
		 ?>
	<?php 
	if(isset($ShowAllNewPurchaseData)){
	foreach($ShowAllNewPurchaseData as $key1):
		
	?>

	 <tr <?php if($IndentNo==$key1->IndentNo){echo "style='background-color:#FF00CC'";}?>>
		<td ><input type="radio" <?php if($IndentNo==$key1->IndentNo){echo "checked";}?> name="invoice" onchange="loadIDFNumber('<?php echo $key1->IndentNo?>')"></td>
		<td style="cell-padding:55px"><?php echo $key1->IndentNo?></td>
		
		<td><?php echo $key1->IDFNumber?></td>
		<td><?php echo substr($key1->OrderDate,0,10)?></td>
		<td><?php echo substr($key1->ACKExpected,0,10)?></td>
		<td><?php echo $key1->ExporterName?></td>
		<td><?php echo $key1->TotalItems?></td>
			
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
						Edit/Verify Value on Commercial Invoice
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

	<form role="form" id="Amendments" action="shiptracking/CommercialInvoice" method="POST">
		                                        <div class="form-group">
<?php
$ProductName="";
$TotalPackages = "";
$GrossWeight = "";
$NetWeight = "";
$FOBValue = "";
$ProductCode ="";
 if(isset($ShowCommodityUnderIndentInfo)){
	$ProductName = $ShowCommodityUnderIndentInfo[0]->ProductName;
	$TotalPackages = $ShowCommodityUnderIndentInfo[0]->TotalPackages;
	$GrossWeight = $ShowCommodityUnderIndentInfo[0]->GrossWeight;
	$NetWeight = $ShowCommodityUnderIndentInfo[0]->NetWeight;
	$ProductCode = $ShowCommodityUnderIndentInfo[0]->ProductCode;
	$FOBValue = $ShowCommodityUnderIndentInfo[0]->FOBValue;
}
	?>
												  <label>Selected Product</label>                                  
<input class="form-control input-sm" type="text" value="<?php echo $ProductName;?>" name="Date"  id="" readonly style="width:95%">
<input class="form-control input-sm" type="hidden" value="<?php echo $IndentNo?>" name="IndentNo"  id="IndentNo" placeholder="" style="width:95%">
	 								</div>
                                     
                                         <div class="form-group">
				<div class="row">
				<div class="col-lg-6">
				<label>Packages</label>

				<input class="form-control input-sm" type="text" value="<?php echo $TotalPackages;?>" name="PackagesReceived"  id="IndentNo" placeholder="" style="width:95%">
				</div>
				<div class="col-lg-6">
				<label>Gross Weight</label>

				<input class="form-control input-sm" type="text" value="<?php echo $GrossWeight;?>" name="GrossWeight"  id="GrossWeight" placeholder="" style="width:95%">
				</div>
				</div>	
				<div class="row">
				<div class="col-lg-6">
				<label>Net Weight</label>

				<input class="form-control input-sm" type="text" value="<?php echo $NetWeight;?>" name="NetWeight"  id="NetWeight" placeholder="" style="width:95%">
				</div>
				<div class="col-lg-6">
				<label>FOB Value</label>

				<input class="form-control input-sm" type="text" value="<?php echo $FOBValue;?>" name="TotalValue"  id="Amount" placeholder="" style="width:95%">
				</div>
				</div>	
				</div>
                                    
					<button type="submit" id="CommercialInvoice" class="btn btn-success btn-sm">Save Details</button>
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
<div align="center"><label> Details of Comodities under the selected Order</label></DIV>
     <div class="table-responsive table-bordered" style="" >
				<div class="dataTable_wrapper" style="width:1500px;height:200px" id="pendingInvoices">	

                                <table class="table">
                                    <thead>
                                        <tr style='background-color:#337ab7'>
                                            <th><input type="checkbox" id="checkAll"></th>
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>Units/Pack</th>
											<th>Unit Size</th>
											<th>Qtty Units</th>
											<th>Country</th>
											<th>Currency</th>
											<th>Exch. Rate</th>
											
											<th>Pack. Type</th>
											<th>Total Packs</th>
											<th>F.O.B. Value</th>
											<th>Gross Weight</th>
											<th>Net Weight</th>
											<th>Commodity Code</th>
											<th>S.I.T.C.</th>
                                        </tr>
                                    </thead>
<tbody>
	<?php 
	$counter=1;
	if(isset($ShowCommodityUnderIndent)){
		$items = "";
		
	foreach($ShowCommodityUnderIndent as $key1):
		
	?>
	 <tr <?php if($ProductCode==$key1->ProductCode){echo "style='background-color:#FF00CC'";}?>>
				<td><input type="checkbox" name="invoice" value="<?php echo $key1->ProductCode?>" onchange="loadIDFNumber2('<?php echo $IndentNo?>','<?php echo $key1->ProductCode?>')"
				<?php if($ProductCode==$key1->ProductCode){echo "checked";}?>
				></td>
				<td><?php echo $key1->ProductCode?></td>
				<td><?php echo $key1->ProductName?></td>
				<td><?php echo $key1->UnitsPerPack?></td>
				<td><?php echo $key1->UnitSize?></td>
				<td><?php echo $key1->QttyUnits?></td>
				<td><?php echo $key1->Country?></td>
				<td><?php echo $key1->Currency?></td>
				<td><?php echo substr($key1->ExchRate,0,6)?></td>
				<td><?php echo $key1->PackageType?></td>
				<td><?php echo $key1->TotalPackages?></td>
				<td><?php echo $key1->FOBValue?></td>
				<td><?php echo $key1->GrossWeight?></td>
				<td><?php echo $key1->NetWeight?></td>
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
		 window.location ="<?php echo base_url();?>shiptracking/index/"+val;
		
		 
	 } 
 }
 	function loadIDFNumber2(No,val)
 {  

	 if(val == "")
	 {
		 return;
	 } else {
		 window.location ="<?php echo base_url();?>shiptracking/index/"+No+"/"+val;
		
		 
	 } 
 }
 

 

</script>
</body>

</html>
