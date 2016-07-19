
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
						ASSIGNMENT OF AWB/BL AND C.C.R.F. NUMBERS
                            
											<ul class="nav  navbar-right" style="margin-top:-10px;">		  
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                         <i class="fa fa-caret-down"></i>
						More Display Information 
                    </a>
                    <ul class="dropdown-menu dropdown-user">
						<li><a href="<?php echo base_url();?>shiptracking/CCRF"> Assignment of AWB/BL & C.C.R.F. Nos</a>
                        </li>
                        <li><a href="<?php echo base_url();?>shiptracking/ShippingDetails"> Verified C.C.R.F. Particulars</a>
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

		 <div class="col-lg-6">
						
					
									 

					 <div id="MainData">
                    <div class="panel panel-default">
						
                        <div class="panel-heading">
                         Acknowledged Orders Awaiting CCRF Assignment/Allocation
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

     <div class="table-responsive table-bordered" style="" >
				<div class="dataTable_wrapper" style="width:800px;height:200px" id="pendingInvoices">	

	<table class="table">
		<thead>
			<tr>
				<th>#</th>
				<th>Indent No</th>
				<th>Part Indent No</th>
				<th>Ship Type</th>
				<th>Currency</th>
				<th>Total FOB Value</th>
				<th>Other Charges</th>
				<th>Fr. Currency</th>
				<th>Total Freight</th>
				
				
			</tr>
		</thead>
<tbody>
	 <?php 
	 $IndentNo= "";
	 $PartIndentNo = "";
	 if(isset($GetOrdersAwaitingCCRFData)){
			if($GetOrdersAwaitingCCRFData!=null){
		 foreach($GetOrdersAwaitingCCRFData as $key);
		 $IndentNo = $key->IndentNo;
		 $PartIndentNo = $key->PartIndentNo;
		 
			}
			
		 
	 }
		 ?>
	<?php 
	if(isset($GetOrdersAwaitingCCRF)){
	foreach($GetOrdersAwaitingCCRF as $key1):
		
	?>

	 <tr <?php if($IndentNo==$key1->IndentNo){echo "style='background-color:#FF00CC'";}?>>
		<td><input type="radio" <?php if($IndentNo==$key1->IndentNo){echo "checked";}?> name="" onchange="loadIDFNumber('<?php echo $key1->IndentNo?>')"></td>
		<td style="cell-padding:55px"><?php echo $key1->IndentNo?></td>
		<td><?php echo $key1->PartIndentNo?></td>
		<td><?php echo $key1->ShipmentType?></td>
		<td><?php echo $key1->Currency?></td>
		<td><?php echo $key1->TotalFOBValue?></td>
		<td><?php echo $key1->TotalOtherCharges?></td>
		<td><?php echo $key1->FreightCurrency?></td>
		<td><?php echo $key1->TotalFreight?></td>
		
		
		
		
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
										<div class="col-lg-6">
										  <div class="panel panel-default">
									  						 <div class="panel-heading">
                    CCRF Documents Issued Under Selected Order
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
    <div class="table-responsive table-bordered" style="" >
				<div class="dataTable_wrapper" style="width:800px;height:200px" id="pendingInvoices">	

	<table class="table">
		<thead>
			<tr>
				<th><input type="checkbox" id="checkAll"></th>
				<th>Product Code</th>
				<th>Product Name</th>
				<th>Size</th>
				
				<th>Currency</th>
				<th>Invoice Value</th>
				<th>Pack Type</th>
				<th>Total Packs</th>
				
			</tr>
		</thead>
<tbody>

	<?php 
	if(isset($ShowProductsToAssign)){
	foreach($ShowProductsToAssign as $key1):
		
	?>

	 <tr>
		<td><input type="checkbox" name="invoice" value="<?php echo $key1->ProductCode?>"></td>
		<td style="cell-padding:55px"><?php echo $key1->ProductCode?></td>
		<td><?php echo $key1->ProductName1?></td>
		<td><?php echo $key1->UnitSize?></td>
		<td><?php echo $key1->Currency?></td>
		<td><?php echo $key1->TotalValue?></td>
		<td><?php echo $key1->PackageType?></td>
		<td><?php echo $key1->TotalPackages?></td>
			
		
			
		
		

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
									</div>
			
									</div>
					</div>
					<div class="row">
													<div class="col-lg-6">
									  <div class="panel panel-default">
									  						 <div class="panel-heading">
                    CCRF Documents Issued Under Selected Order
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
    <div class="table-responsive table-bordered" style="" >
				<div class="dataTable_wrapper" style="height:auto" id="pendingInvoices">	

	<table class="" width="100%" border="1px">
		<thead>
			<tr>
				<th> # </th>
				<th>Indent No</th>
				<th>Doc Code</th>
				<th>CCRF No</th>
				<th>CCRF Date.</th>
				<th>Currency</th>
				<th>Total Value</th>
				
			</tr>
		</thead>
<tbody>

	<?php 
	$CCRF= "";
	$CCRFDate = "";
	if(isset($ShowCCRFDocumentsData)){
		$CCRF = $ShowCCRFDocumentsData[0]->DocumentNo;
		$CCRFDate = $ShowCCRFDocumentsData[0]->DocumentDate;
		
	}
	if(isset($ShowCCRFDocuments)){
	foreach($ShowCCRFDocuments as $key1):
		
	?>

	 <tr <?php if($CCRF==$key1->DocumentNo){echo "style='background-color:#FF00CC'";
	 $CCRF = $key1->DocumentNo;
	 }?>>
		<td><input type="radio" <?php if($CCRF==$key1->DocumentNo){echo "checked";}?> name="invoice2" onchange="loadCCRF('<?PHP ECHO str_replace("/","_",$key1->DocumentNo)?>','<?PHP ECHO $key1->IndentNo?>')"></td>	
		<td style="cell-padding:55px"><?php echo $key1->IndentNo?></td>
		<td><?php echo $key1->DocumentCode?></td>
		<td><?php echo $key1->DocumentNo?></td>
		<td><?php echo substr($key1->DocumentDate,0,10)?></td>
		
		<td><?php echo $key1->Currency?></td>
			
		
		<td><?php echo number_format($key1->AmountValue,2)?></td>
		
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
									</div>
									</div>
										<div class="col-lg-6">
							  <div class="panel panel-default">
									  						 <div class="panel-heading">
                        AWB/BL Documents Issued Under Selected Order
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
     <div class="table-responsive table-bordered" style="" >
				<div class="dataTable_wrapper" style="height:auto" id="pendingInvoices">	

	<table class="" width="100%" border="1px">
		<thead>
			<tr>
				
				<th>Indent No</th>
				<th>Doc Code</th>
				<th>AWB/BL No</th>
				<th>AWB/BL Date</th>
				<th>Doc Type</th>
				
				
			</tr>
		</thead>
<tbody>

	<?php 
	if(isset($ShowAWBBLDocuments)){
	foreach($ShowAWBBLDocuments as $key1):
		
	?>

	 <tr>
	
		<td style="cell-padding:55px"><?php echo $key1->IndentNo?></td>
		<td><?php echo $key1->DocumentCode?></td>
		<td><?php echo $key1->DocumentNo?></td>
		<td><?php echo substr($key1->DocumentDate,0,10)?></td>
		<td><?php echo $key1->DocumentType?></td>
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
									</div>
			<form role="form" id="Amendments" action="shiptracking/saveCCRF" method="POST">
			<input class="form-control input-sm" type="hidden" value="<?php echo $IndentNo?>" name="IndentNo"  id="IndentNo" placeholder="" style="width:95%">
			<input class="form-control input-sm" type="hidden" value="<?php echo $CCRF?>" name="CCRF"  id="CCRF" placeholder="" style="width:95%">
			<input class="form-control input-sm" type="hidden" value="<?php echo $CCRFDate?>" name="CCRFDATE"  id="CCRFDATE" placeholder="" style="width:95%">
			<input class="form-control input-sm" type="hidden" value="<?php echo $PartIndentNo?>" name="PartIndentNo"  id="PartIndentNo" placeholder="" style="width:95%">
					<button type="submit" id="saveCCRF" class="btn btn-success btn-sm">Save Details</button>
			</form>
						
						<p id="loading2"></p>
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
		 
		 window.location ="<?php echo base_url();?>shiptracking/CCRF/"+val;
		 
		 
	 } 
 }
 

	function loadCCRF(CCRF,val)
 {  
	 if(val == "")
	 {
		 return;
	 } else {
		 
		 window.location ="<?php echo base_url();?>shiptracking/CCRF/"+val+"/"+CCRF;
		 
		 
	 } 
 }

</script>
</body>

</html>
