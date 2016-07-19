
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
								Purchase Order Acknowledgement
                        </div>
                        <!-- /.panel-heading -->
                    <!-- /.panel --> 
					 <div class="panel-body panel-default">
					 <div class="panel panel-default">
                        <div class="panel-heading">
						Purchase Order Acknowledgement
                            
											<ul class="nav  navbar-right" style="margin-top:-10px;">		  
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                         <i class="fa fa-caret-down"></i>
						More Display Options 
                    </a>
                    <ul class="dropdown-menu dropdown-user">
					 <li><a href="<?php echo base_url()?>confirmation/acknowledgeOrders"> New / Pending Purchase Orders</a>
                        </li>
                          <li><a href="<?php echo base_url()?>confirmation/acknowledgeOrders/old"> Old / Received Purchase Orders</a>
                        </li> 
                        <li><a href="<?php echo base_url()?>confirmation/acknowledgeOrders/all"> ALL Purchase Orders</a>
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
                         Purchase Orders Pending Acknowledgement
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

     <div class="table-responsive table-bordered" style="" >
	<p></p>					<div class="dataTable_wrapper" style="width:600px;height:200px" id="pendingInvoices">	

	<table class="table">
		<thead>
			<tr>
				<th><input type="radio" id=""></th>
				<th>Indent No</th>
				<th>IDF. No</th>
				
				<th>Order Date</th>
				<th>Date Expected</th>
				<th>Exporter Name.</th>
				
				<th>Total Items</th>
				
			
				
			</tr>
		</thead>
<tbody>
	 <?php 
	 $IndentNo= "";
	 $ExporterName ="";
	 $Charges="";
	 $TotFOBCurrent = "";
	 $AmendNo  = "";
	 if(isset($ShowAllNewPurchaseDataInfo)){
		
		 foreach($ShowAllNewPurchaseDataInfo as $key);
		 $IndentNo = $key->IndentNo;
		 $ExporterName = $key->ExporterName;
		 
	 }
		// print_r($AllPendingIDFData);} else echo "checked";
		 ?>
	<?php 
	if(isset($ShowAllNewPurchaseData)){
	foreach($ShowAllNewPurchaseData as $key1):
		
	?>

	 <tr <?php if($IndentNo==$key1->IndentNo){echo "style='background-color:#FF00CC'";}?>>
		<td ><input type="radio" <?php if($IndentNo==$key1->IndentNo){echo "checked";}?> name="invoice" onchange="loadIDFNumber('<?php echo $key1->IndentNo.",".$type?>')"></td>
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
										<div class="col-lg-4">
									  <div class="panel panel-default">
									  						 <div class="panel-heading">
                        Order Confirmation Details
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

	<form role="form" id="Amendments" action="confirmation/safeAcknowledement">
		                                        <div class="form-group">
												  <label>Date Acknowledged</label>
  <?php

    $date=date_create(date('Y-m-d'));
date_add($date,date_interval_create_from_date_string("0 days"));
$date = date_format($date,"Y-m-d");
?>                                     
<input class="form-control input-sm" type="text" value="<?php //echo $date;?>" name="Date"  id="reservation2" placeholder="" style="width:95%">
<input class="form-control input-sm" type="hidden" value="<?php echo $IndentNo?>" name="IndentNo"  id="IndentNo" placeholder="" style="width:95%">

	 								</div>
	                                       

								 <div class="form-group" id="showReason" >
                                            <label>Name of Exporter Selected</label>
                                         
<input class="form-control input-sm" type="text" value="<?php echo $ExporterName?>" name="ExporterName"  id="ExporterName" placeholder="" style="width:95%">

	 								</div>
					<button type="submit" id="safeAcknowledement" class="btn btn-success btn-sm">Save Details</button>
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
<div align="center"><label> Products  that will be affected by the Acknowledgement</label></DIV>
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
	if(isset($ShowCommodityUnderIndentPurchase)){
		$items = "";
		
	foreach($ShowCommodityUnderIndentPurchase as $key1):
		
	?>
	 <tr>
				<td><input type="checkbox" name="invoice" checked hidden value="<?php echo $key1->ProductCode?>"><?php echo $counter?></td>
				<td><?php echo $key1->ProductCode?></td>
				<td><?php echo $key1->ProductName?></td>
				<td><?php echo $key1->UnitsPerPack?></td>
				<td><?php echo $key1->UnitSize?></td>
				<td><?php echo $key1->QttyUnits?></td>
				<td><?php echo $key1->Country?></td>
				<td><?php echo $key1->Currency?></td>
				<td><?php echo $key1->ExchRate?></td>
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

val = val.split(",");
	 if(val == "")
	 {
		 return;
	 } else {
		 if(val[1]==""){
		 window.location ="<?php echo base_url();?>confirmation/acknowledgeOrders/"+val[0];
		 }else{
			 window.location ="<?php echo base_url();?>confirmation/acknowledgeOrders/"+val[1]+"/"+val[0]; 
		 }
		 
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
