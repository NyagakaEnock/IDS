
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
                           Request for Shipping Documents

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
	<p></p>					<div class="dataTable_wrapper" style="width:1500px;height:300px" id="pendingInvoices">	

	<table class="table">
		<thead>
			<tr>
				<th><input type="radio" id=""></th>
				<th>Indent No</th>
				<th>IDF. No</th>
				<th>Exporter Name.</th>
				<th>Exporter Code</th>				
				<th>Contact Person</th>
				<th>Carbon Copy</th>
				<th>Fax No</th>			
				<th>Importer Code</th>			
			</tr>
		</thead>
<tbody>
	 <?php 
	 $IndentNo= "";
	 $Freight ="";
	 $Charges="";
	 $CarbonCopy = "";
	 $AttentionTo  = "";
	 if(isset($ShowNewAcknowledgedData)){
		
		 foreach($ShowNewAcknowledgedData as $key);
		 $IndentNo = $key->IndentNo;
		 $AttentionTo = $key->AttentionTo;
		 $CarbonCopy = $key->CarbonCopy;
	 }
		// print_r($AllPendingIDFData);} else echo "checked";
		 ?>
	<?php 
	if(isset($ShowNewAcknowledged)){
	foreach($ShowNewAcknowledged as $key1):
		
	?>

	 <tr <?php if($IndentNo==$key1->IndentNo){echo "style='background-color:#FF00CC'";}?>>
		<td ><input type="radio" <?php if($IndentNo==$key1->IndentNo){echo "checked";}?> name="invoice" onchange="loadIDFNumber('<?php echo $key1->IndentNo?>')"></td>
		<td style="cell-padding:55px"><?php echo $key1->IndentNo?></td>
		<td><?php echo $key1->IDFNumber?></td>
		<td><?php echo $key1->ExporterCode?></td>
		<td><?php echo $key1->ExporterName?></td>
		<td><?php echo $key1->AttentionTo?></td>
		<td><?php echo $key1->CarbonCopy?></td>
		<td><?php echo $key1->FaxNo?></td>
		<td><?php echo $key1->ImporterCode?></td>	
			
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

	<form role="form" id="Amendments" action="doctracking/safeShippingDocs">
		                                        <div class="form-group">
												  <label>Date Expected</label>
  <?php

    $date=date_create(date('Y-m-d'));
date_add($date,date_interval_create_from_date_string("30 days"));
$date = date_format($date,"Y-m-d");
?>                                     
<input class="form-control input-sm" type="text" value="<?php echo $date;?>" name="Date"  id="reservation2" placeholder="" style="width:95%">
<input class="form-control input-sm" type="hidden" value="<?php echo $IndentNo?>" name="IndentNo"  id="IndentNo" placeholder="" style="width:95%">

	 								</div>
	                                       
                                         <div class="form-group">
										 <div class="row">
										 <div class="col-lg-6">
                                            <label>Attention To</label>
                                         
<select class="form-control select2" style="width:95%"   name="AttentionTo" id="indentNo">
		<option  ><?php echo  $AttentionTo;?></option>
		<?php foreach($portsofDischarge as $row):


		?>
		<option value="<?php echo $row->PortCode;?>"><?php echo $row->PortName;?></option>

		<?php

		endforeach;
		?>
		</select>
		</div>
		 <div class="col-lg-6">
		                                             <label>Carbon Copy</label>
                                         
<select class="form-control select2" style="width:95%"  name="Terms" id="">
		<option ><?php echo  $CarbonCopy;?></option>
		<?php foreach($ParamTransactionTerms as $row):


		?>
		<option value="<?php echo $row->TransTerm;?>"><?php echo $row->TransTermName;?></option>

		<?php

		endforeach;
		?>
		</select>
		 </div>
		</div>
								</div>
                                    
								                                     <div class="form-group">
                                            <label>Subject</label>
                                         
<input class="form-control input-sm" type="text" value="REQUEST FOR SHIPPING DOCUMENTS" name="Subject"  id="Subject" placeholder="" style="width:95%">

								</div>
								 <div class="form-group" id="showReason" >
                                            <label> Message</label>
                                         
<textarea class="form-control"   name="Message" rows="5"  style="width:95%"><?php if(isset($FindRequestMessage)){echo $FindRequestMessage;
}?></textarea>
	 								</div>
					<button type="submit" id="safeShippingDocs" class="btn btn-success btn-sm">Save Details</button>
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
<div align="center"><label> Shipping Documents</label></DIV>
     <div class="table-responsive table-bordered" style="" >
				<div class="dataTable_wrapper" style="width:800px;height:200px" id="pendingInvoices">	

                                <table class="table">
                                    <thead>
                                        <tr style='background-color:#FF00CC'>
                                            <th><input type="checkbox" id="checkAll"></th>
                                            <th>Code</th>
                                            <th>Document Name</th>
                                            <th>Notes/Comments</th>
                                        </tr>
                                    </thead>
<tbody>
	<?php 
	$counter=1;
	if(isset($ShowShippingDocumentMain)){
		$items = "";
		
	foreach($ShowShippingDocumentMain as $key1):
		
	?>
	 <tr>
				<td><input type="checkbox" name="invoice" value="<?php echo $key1->DocumentCode?>" ></td>
				<td><?php echo $key1->DocumentCode?></td>
				<td><?php echo $key1->DocumentName?></td>
				<td><?php echo $key1->Notes?></td>
	
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
		 window.location ="<?php echo base_url();?>doctracking/index/"+val;
		
		 
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
