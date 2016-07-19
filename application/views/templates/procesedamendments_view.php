
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
                            Import Declaration Form (I.D.F) Amendment
											<ul class="nav  navbar-right" style="margin-top:-10px;">		  
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                         <i class="fa fa-caret-down"></i>
						More IDF Amendments 
                    </a>
                    <ul class="dropdown-menu dropdown-user">
					 <li><a href="<?php echo base_url()?>idf/amendements"> IDF Amendments</a>
                        </li>
                          <li><a href="<?php echo base_url()?>idf/Productsamendements"> Products Amendments</a>
                        </li>
                      
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
                          Processed Amendments Applications Manager
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

     <div class="table-responsive table-bordered" style="" >
	<p></p>					<div class="dataTable_wrapper" style="width:1500px;height:250px" id="pendingInvoices">	

	<table class="table">
		<thead>
			<tr>
				<th><input type="checkbox" id="checkAll"></th>
				<th>Indent No</th>
				<th>Amend. No</th>
				<th>Date Applied</th>
				<th>I.D.F. Numbero</th>
				<th>I.D.F. Date</th>
				<th>Amend. Type</th>
				<th>Currency</th>
				<th>Tot. FOB Val.</th>
				<th>Amend. FOB Val.</th>
				<th>Amend. Freight</th>
				<th>Other Charges</th>
				<th>Amend. Other</th>
				<th>Approved ?</th>
				<th>PSI Agency</th>
			
				
			</tr>
		</thead>
<tbody>
	 <?php 
	 $IndentNo= "";
	 $Freight ="";
	 $Charges="";
	 $TotFOBCurrent = "";
	 $AmendNo  = "";
	 if(isset($ShowProcessedIndentsData)){
		 foreach($ShowProcessedIndentsData as $key);
		 $IndentNo = $key->IndentNo;
		  $AmendNo = $key->AmendNo;
	 }
		// print_r($AllPendingIDFData);} else echo "checked";
		 ?>
	<?php 
	if(isset($ShowProcessedIndents)){
	foreach($ShowProcessedIndents as $key1):
		
	?>

	 <tr <?php if($IndentNo==$key1->IndentNo){echo "style='background-color:#FF00CC'";}?>>
		<td ><input type="checkbox" <?php if($IndentNo==$key1->IndentNo){echo "checked";}?> name="invoice" onchange="loadIDFNumber('<?php echo $key1->IndentNo?>')"></td>
			<td style="cell-padding:55px"><?php echo $key1->IndentNo?></td>
		<td><?php echo $key1->AmendNo?></td>
	   <td><?php echo substr($key1->DateAmended,0,10)?></td>
	   
		<td><?php echo $key1->IDFNumber?></td>
		<td><?php echo substr($key1->IDFDate,0,10)?></td>
		 <td><?php echo $key1->AmendType?></td>
		  <td><?php echo $key1->Currency?></td>
		  <td><?php echo $key1->TotFOBCurrent?></td>
			<td><?php echo $key1->TotFOBAmend?></td>
			<td><?php echo $key1->FreightCurrent?></td>
			<td><?php echo $key1->FreightAmend?></td>
			<td><?php echo $key1->OtherCurrent?></td>
			<td><?php echo $key1->OtherAmend?></td>
			<td><?php echo $key1->Approved?></td>
			<td><?php echo $key1->PSIAgency?></td>
			
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
                        <!-- /.panel-heading -->
                        <div class="panel-body">
	<form role="form" id="Amendments" action="idf/safeProcesedAmendments">
		                                        <div class="form-group">
                                            <label>Date</label>
                                         
<input class="form-control input-sm" type="text" value="" name="Date"  id="reservation2" placeholder="" style="width:95%">
<input class="form-control input-sm" type="HIDDEN" value="<?php echo $IndentNo?>" name="IndentNo"  id="IndentNo" placeholder="" style="width:95%">
<input class="form-control input-sm" type="HIDDEN" value="<?php echo $AmendNo?>" name="AmendNo"  id="AmendNo" placeholder="" style="width:95%">

	 								</div>
	                                       
                                         <div class="form-group">
									<div class="checkbox">
									<label>
									<input type="radio" value="Y" id="Approved" name="approv" onchange="showPSI()">Amendment Approved?
									</label>
									<input type="hidden" id="Approvedvalue" value="N" name="Approvedvalue">
									</div>
								</div>
								<div class="form-group">
									<div class="checkbox">
									<label>
									<input type="radio" name="approv" value="N" id="ApprovedNot" onchange="ApprovedNotFunc()">Amendment NOT Approved?
									</label>
									<input type="hidden" id="ApprovedNotvalue" value="N" name="ApprovedNotvalue">
									</div>
								</div>
								 <div class="form-group" id="showReason" hidden>
                                            <label>Enter Reason if Amendment is NOT Approved</label>
                                         
<textarea class="form-control"   name="Reason" rows="3"  id="" placeholder="" style="width:95%"></textarea>
	 								</div>
					<button type="submit" id="safeProcesedAmendments" class="btn btn-success btn-sm">Save Details</button>
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
<label> Products Affected by the Amendment</label>
     <div class="table-responsive table-bordered" style="" >
	<p></p>					<div class="dataTable_wrapper" style="width:1500px;height:200px" id="pendingInvoices">	

	<table class="table table-bordered"  >
		<thead>
			<tr>
			
				<th>Product Code</th>
				<th>Product Name</th>
				<th>Units/Pack</th>
				<th>Unit Size</th>
				<th>Qtty Units</th>
				<th>Pack. Type</th>
				<th>Packs Current</th>
				<th>Packs Amend.</th>
				<th>FOB Current</th>
				<th>FOB Amend</th>
				<th>Gross Current</th>
				<th>Gross Amend</th>
				<th>Net Current</th>
				<th>Net Amend</th>
				<th>Net SITC</th>
			</tr>
		</thead>
<tbody>
	<?php 
	if(isset($ShowAmendedProducts)){
		$items = "";
	foreach($ShowAmendedProducts as $key1):
		
	?>

	 <tr >
	
		<td style="height:25px"><?php echo $key1->ProductCode?></td>
	   <td><?php echo $key1->ProductName1?></td>
	   <td><?php echo $key1->UnitsPerPack?></td>
		<td><?php echo $key1->UnitSize?></td>
		  <td><?php echo $key1->QttyUnits?></td>		
			<td><?php echo $key1->PackageType?></td>
		   <td><?php echo $key1->PacksCurrent?></td>
		   <td><?php echo $key1->PacksAmend?></td>
		   <td><?php echo $key1->FOBCurrent?></td>
		    <td><?php echo $key1->FOBAmend?></td>
		   <td><?php echo $key1->GrossCurrent?></td>
		       <td><?php echo number_format($key1->GrossAmend,2)?></td>   
		
			<td><?php echo $key1->NetCurrent?></td>
			
			<td><?php echo $key1->NetAmend?></td>
			<td><?php echo $key1->SITC?></td>
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
		 window.location ="<?php echo base_url();?>idf/ProcesedAmendments/"+val;
		
		 
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
