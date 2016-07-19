
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
								Purchase Order Processing
                        </div>
                        <!-- /.panel-heading -->
                    <!-- /.panel --> 
					 <div class="panel-body panel-default">
					 <div class="panel panel-default">
                        <div class="panel-heading">
                            Confirmation of Purchase Orders
											<ul class="nav  navbar-right" style="margin-top:-10px;">		  
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                         <i class="fa fa-caret-down"></i>
						More Display Options 
                    </a>
                    <ul class="dropdown-menu dropdown-user">
					
                          <li><a href="<?php echo base_url()?>confirmation"> New IDF Indents</a>
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
                         New Indents to Confirm
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

     <div class="table-responsive table-bordered" style="" >
	<p></p>					<div class="dataTable_wrapper" style="width:800px;height:300px" id="pendingInvoices">	

	<table class="table">
		<thead>
			<tr>
				<th><input type="radio" id=""></th>
				<th>Indent No</th>
				<th>Importer Code</th>
				<th>Exporter Code</th>
				<th>Exporter Name.</th>
				<th>Indent Date</th>	
			</tr>
		</thead>
<tbody>
	 <?php 
	 $IndentNo= "";
	 $Freight ="";
	 $Charges="";
	 $TotFOBCurrent = "";
	 $AmendNo  = "";
	 if(isset($ShowAllNewIndentData)){
		
		 foreach($ShowAllNewIndentData as $key);
		 $IndentNo = $key->IndentNo;
		 
	 }
		// print_r($AllPendingIDFData);} else echo "checked";
		 ?>
	<?php 
	if(isset($ShowAllNewNonIDF)){
	foreach($ShowAllNewNonIDF as $key1):
		
	?>

	 <tr <?php if($IndentNo==$key1->IndentNo){echo "style='background-color:#FF00CC'";}?>>
		<td ><input type="radio" <?php if($IndentNo==$key1->IndentNo){echo "checked";}?> name="invoice" onchange="loadIDFNumber2('<?php echo $key1->IndentNo?>')"></td>
			<td style="cell-padding:55px"><?php echo $key1->IndentNo?></td>
		 <td><?php echo $key1->ImporterCode?></td>
		  <td><?php echo $key1->ExporterCode?></td>
		  <td><?php echo $key1->ExporterName?></td>
		<td><?php echo substr($key1->IndentDate,0,10)?></td>
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

	<form role="form" id="Amendments" action="confirmation/safeConfirmationNonIndent">
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
                                            <label>Select Port of Discharge</label>
                                         
<select class="form-control select2" style="width:95%"   name="Discharge" id="indentNo">
		<option ></option>
		<?php foreach($portsofDischarge as $row):


		?>
		<option value="<?php echo $row->PortCode;?>"><?php echo $row->PortName;?></option>

		<?php

		endforeach;
		?>
		</select>
								</div>
                                     <div class="form-group">
                                            <label>Terms of Payment</label>
                                         
<select class="form-control select2" style="width:95%"  name="Terms" id="indentNo">
		<option ></option>
		<?php foreach($ParamTransactionTerms as $row):


		?>
		<option value="<?php echo $row->TransTerm;?>"><?php echo $row->TransTermName;?></option>

		<?php

		endforeach;
		?>
		</select>
								</div>
								                                     <div class="form-group">
                                            <label>Select Bank</label>
                                         
<select class="form-control select2" style="width:95%"  name="Bank" id="indentNo">
		<option ></option>
		<?php foreach($ParamBankBranches as $row):


		?>
		<option value="<?php echo $row->BankCode;?>"><?php echo $row->BankName;?></option>

		<?php

		endforeach;
		?>
		</select>
								</div>
								 <div class="form-group" id="showReason" >
                                            <label>Confirmation Message</label>
                                         
<textarea class="form-control"   name="Message" rows="5"  style="width:95%"><?php if(isset($FindConfirmMessage)){echo $FindConfirmMessage;
}?></textarea>
	 								</div>
					<button type="submit" id="safeConfirmation" class="btn btn-success btn-sm">Save Details</button>
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
<div align="center"><label> Select Products to for Confirmation</label></DIV>
     <div class="table-responsive table-bordered" style="" >
				<div class="dataTable_wrapper" style="width:1500px;height:200px" id="pendingInvoices">	

                                <table class="table">
                                    <thead>
                                        <tr style='background-color:#FF00CC'>
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
	 <tr>
				<td><input type="checkbox" name="invoice" value="<?php echo $key1->ProductCode?>" ></td>
				<td><?php echo $key1->ProductCode?></td>
				<td><?php echo $key1->ProductName?></td>
				<td><?php echo $key1->UnitsPerPack?></td>
				<td><?php echo $key1->UnitSize?></td>
				<td><?php echo $key1->QttyUnits?></td>
				<td><?php echo $key1->CountryOrigin?></td>
				<td><?php echo $key1->Currency?></td>
				<td><?php echo $key1->ExchRate?></td>
				<td><?php echo $key1->PackageType?></td>
				<td><?php echo $key1->PackagesReceived?></td>
				<td><?php echo $key1->TotalValue?></td>
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
		 window.location ="<?php echo base_url();?>confirmation/index/"+val;
		
		 
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
