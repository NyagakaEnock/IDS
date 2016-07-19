
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
								Tracking of Documents
                        </div>
                        <!-- /.panel-heading -->
                    <!-- /.panel --> 
					 <div class="panel-body panel-default">
					 <div class="panel panel-default">
                        <div class="panel-heading">
                           Receiving Shipping Documents

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
                        Acknowledged Purchase Orders
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
				<th>Exporter Code</th>
				<th>Exporter Name.</th>							
				<th>Currency</th>
				<th>Exch Rate</th>
<th>IDF. No</th>				
			</tr>
		</thead>
<tbody>
	 <?php 
	 $DocumentCode= "";
	 $DocumentName = "";
	 if(isset($loadDocs)){
		
		 foreach($loadDocs as $key);
		 $DocumentCode = $key->DocumentCode;
		 $DocumentName = $key->DocumentName;
	 }
		  
	 $IndentNo= "";
	 $Freight ="";
	 $Charges="";
	 $CarbonCopy = "";
	 $AttentionTo  = "";
	 if(isset($ShowRequestsNotReceivedData)){
		
		 foreach($ShowRequestsNotReceivedData as $key);
		 $IndentNo = $key->IndentNo;
	 }
		// print_r($AllPendingIDFData);} else echo "checked";
		 ?>
	<?php 
	if(isset($ShowRequestsNotReceived)){
	foreach($ShowRequestsNotReceived as $key1):
		
	?>

	 <tr <?php if($IndentNo==$key1->IndentNo){echo "style='background-color:#FF00CC'";}?>>
		<td ><input type="radio" <?php if($IndentNo==$key1->IndentNo){echo "checked";}?> name="invoice" onchange="loadIDFNumber('<?php echo $key1->IndentNo?>')"></td>
		<td style="cell-padding:55px"><?php echo $key1->IndentNo?></td>
		
		<td><?php echo $key1->ExporterCode?></td>
		<td><?php echo $key1->ExporterName?></td>
		<td><?php echo $key1->currency?></td>
		<td><?php echo $key1->ExchRate?></td>
		<td><?php echo $key1->IDFNumber?></td>
			
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
						Details of Current Request
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

	<form role="form" id="Amendments" action="doctracking/receiveDocument">
		                                        <div class="form-group">
<?php
$DocumentNumber="";
$IDFDate  = "";
$Amount  = "";
$Currency = "";
$ExchRate = "";
 if(isset($FindTheIDF)){
	$IDFDate = $FindTheIDF[0]->IDFDate;
	$DocumentNumber = $FindTheIDF[0]->IDFNumber;
}elseif(isset($FindProformaInvoice)){
		$IDFDate = $FindProformaInvoice['DocumentDate'];
	$DocumentNumber = $FindProformaInvoice['DocumentNo'];
	$Amount = $FindProformaInvoice['total'];
	$ExchRate = $FindProformaInvoice['ExchRate'];
	$Currency = $FindProformaInvoice['Currency'];
	$Amount  = number_format($Amount,2,'.', '');
}
	?>
												  <label>Document Date</label>                                  
<input class="form-control input-sm" type="text" value="<?php echo $IDFDate;?>" name="Date"  id="reservation2" placeholder="" style="width:95%">
<input class="form-control input-sm" type="hidden" value="<?php echo $IndentNo?>" name="IndentNo"  id="IndentNo" placeholder="" style="width:95%">
<input class="form-control input-sm" type="hidden" value="<?php echo $ExchRate?>" name="ExchRate"  id="" placeholder="" style="width:95%">
<input class="form-control input-sm" type="hidden" value="<?php echo $Currency?>" name="Currency"  id="" placeholder="" style="width:95%">

	 								</div>
		                                        <div class="form-group">
												  <label>Document Name</label>                                   
<input class="form-control input-sm" type="text" value="<?php echo $DocumentName?>" name="Name"  id="" placeholder="" style="width:95%">

	 								</div>	                                       
                                         <div class="form-group">
										 <div class="row">
										 <div class="col-lg-6">
                                            <label>Document No</label>
                                         
<input class="form-control input-sm" type="text" value="<?php echo $DocumentNumber;?>" name="DocumentNo"  id="IndentNo" placeholder="" style="width:95%">
		</div>
		 <div class="col-lg-6">
		                                             <label>Value / Amount</label>
                                         
<input class="form-control input-sm" type="text" value="<?php echo $Amount;?>" name="Amount"  id="Amount" placeholder="" style="width:95%">
		 </div>
		</div>						</div>
                                    
					<button type="submit" id="receiveDocument" class="btn btn-success btn-sm">Save Details</button>
							</form>
						
						<p id="loading2"><?php if($ExchRate=='0.00'){
							echo "<font color='red'>This week's Exchange Rate has not been Set. Contact System Admin.</font>";
						}?></p>
						</div>
									</div>
									</div>
					</div>
					<div class="row">
						<div class="col-lg-7">
                     <div class="panel-body">
			 <div class="panel panel-default">		 
<div align="center"><label> Shipping Documents</label></DIV>
     <div class="table-responsive table-bordered" style="" >
				<div class="dataTable_wrapper" style="width:500px;height:200px" id="pendingInvoices">	

                                <table class=""  cellspacing="20px">
                                    <thead>
                                        <tr style='background-color:#NONE'>
                                            <th>#</th>
                                            <th>Code</th>
                                            <th>Document Name</th>
                                            <th>Notes/Comments</th>
											 <th>Type</th>
                                        </tr>
                                    </thead>
<tbody>
	<?php 
	$counter=1;
	if(isset($ShowShippingDocumentRec)){
		$items = "";
		
	foreach($ShowShippingDocumentRec as $key1):
		
	?>
	 <tr <?php if($DocumentCode==$key1->DocumentCode){echo "style='background-color:#FF00CC'";}?>>
		<td><input type="checkbox" 
		<?php if($DocumentCode==$key1->DocumentCode){echo "checked";}?> name="invoice2" onchange="loadIDFNumber2('<?php echo $key1->DocumentCode?>','<?php echo $IndentNo?>')" Value="<?php echo $key1->DocumentCode?>" ></td>
				
				<td><?php echo $key1->DocumentCode?></td>
				<td><?php echo $key1->DocumentName?></td>
				<td><?php echo $key1->Notes?></td>
				<td><?php echo $key1->DocumentType?></td>
	
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
		 window.location ="<?php echo base_url();?>doctracking/receivingdocuments/"+val;
		
		 
	 } 
 }
 	function loadIDFNumber2(val,No)
 {  

	 if(val == "")
	 {
		 return;
	 } else {
		 window.location ="<?php echo base_url();?>doctracking/receivingdocuments/"+No+"/"+val;
		
		 
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
