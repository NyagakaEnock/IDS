
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
					
                         
                          <li><a href="<?php echo base_url()?>idf/Productsamendements"> Products Amendments</a>
                        </li>
                       <li><a href="<?php echo base_url()?>idf/ProcesedAmendments"> Processed Amendments Manager</a>
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
                           Select a Record to Amend
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
				<th>I.D.F. Number</th>
				<th>I.D.F. Date</th>
				<th>Proforma No</th>
				<th>Proforma Date</th>
				<th>Currency</th>
				<th>Exch. Rate</th>
				<th>Freight Value</th>
				<th>Other Charges</th>
				<th>Tot. FOB Val</th>
				
			</tr>
		</thead>
<tbody>
	 <?php 
	 $IndentNo= "";
	 $Freight ="";
	 $Charges="";
	 $TotFOBCurrent = "";
	 if(isset($ShowAllNewIndentsData)){
		 foreach($ShowAllNewIndentsData as $key);
		 $Charges = $key->OtherChargesValue;
			 $IndentNo = $key->IndentNo;
			 $Freight = $key->FreightValue;
			 $TotFOBCurrent = $key->TotalFOBValue;
	 }
		// print_r($AllPendingIDFData);} else echo "checked";
		 ?>
	<?php 
	if(isset($ShowAllNewIndents)){
		$items = "";
	foreach($ShowAllNewIndents as $key1):
		
	?>

	 <tr <?php if($IndentNo==$key1->IndentNo){echo "style='background-color:#FF00CC'";}?>>
		<td ><input type="checkbox" <?php if($IndentNo==$key1->IndentNo){echo "checked";}?> name="invoice" onchange="loadIDFNumber('<?php echo $key1->IndentNo?>')"></td>
			<td style="cell-padding:55px"><?php echo $key1->IndentNo?></td>
		<td><?php echo $key1->IDFNumber?></td>
	   <td><?php echo substr($key1->IDFDate,0,10)?></td>
	   <td><?php echo substr($key1->ProfInvoiceNo,0,10)?></td>
		<td><?php echo $key1->ProfInvoiceDate?></td>
		 <td><?php echo $key1->Currency?></td>
		  <td><?php echo $key1->ExchRate?></td>
		  <td><?php echo $key1->FreightValue?></td>
			<td><?php echo $key1->OtherChargesValue?></td>
			<td><?php echo $key1->TotalFOBValue?></td>
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
	<form role="form" id="Amendments" action="idf/safeAmendments">
		                                        <div class="form-group">
                                            <label>Total FOB Value</label>
                                         
<input class="form-control input-sm" type="text" value="<?php echo $TotFOBCurrent;?>" name="TotFOBAmend"  id="<?php echo $TotFOBCurrent;?>" placeholder="" style="width:95%">
	 								</div>
	                                        <div class="form-group">
                                            <label>Total Freight Value</label>
                                         
<input class="form-control input-sm" type="text" value="<?php echo $Freight;?>" name="Freight"  id="<?php echo $Freight;?>" placeholder="" style="width:95%">
<input class="form-control input-sm" type="hidden" value="<?php echo $IndentNo;?>" name="IndentNo"  id="IndentNo" placeholder="" style="width:95%">
	 								</div>
                                        <div class="form-group">
                                            <label>Other Charges</label>
                                         
<input class="form-control input-sm" type="text" name="Charges" id="<?php echo $Charges;?>" value="<?php echo $Charges;?>" placeholder="" style="width:95%">
										</div>
										
										<div id="productDetails">
										<div class="form-group">
                         <label>Commodity Description</label>
<select class="form-control select2" style="width:95%"  id="" name="CommodityDesc">
		<option ></option>
		<?php if(isset($GoodsDescription)){
			foreach($GoodsDescription as $key):
					?>
					 <option ><?php 	echo $key->GoodsDescription; ?></option>
					<?php
				
			endforeach;
		}
		?>
		<?php foreach($idfItemsIndentNos as $row):


		?>
		

		<?php

		endforeach;
		?>
		</select>
						</div>
						<div class="form-group">
                         <label> Type of Amendment</label>
<select class="form-control select2" style="width:95%"   id="" name="AmendType">
		<option ></option>
		<?php if(isset($amendmentTypes)){
			foreach($amendmentTypes as $key):
					?>
					 <option value="<?php echo $key->AmendType; ?>"  ><?php echo $key->AmendName; ?></option>
					<?php
				
			endforeach;
		}
		?>
		<?php foreach($idfItemsIndentNos as $row):


		?>
		

		<?php

		endforeach;
		?>
		</select>
						</div>
						<div class="form-group">
                         <label> Purpose of Amendment</label>
<select class="form-control select2" style="width:95%"   id="" name="AmendPurpose">
		<option ></option>
		<?php if(isset($amendmentPurpose)){
			foreach($amendmentPurpose as $key):
					?>
					 <option <?php echo $key->AmendPurpose; ?>><?php echo $key->PurposeDescription; ?></option>
					<?php
				
			endforeach;
		}
		?>
		<?php foreach($idfItemsIndentNos as $row):


		?>
		

		<?php

		endforeach;
		?>
		</select>
						</div>
	
	                   
										
										</div>
					<button type="submit" id="safeAmendments" class="btn btn-success btn-sm">Save Details</button>
							</form>
						
						<p id="loading2"></p>
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

	function loadIDFNumber(val)
 {  

	 if(val == "")
	 {
		 return;
	 } else {
		 window.location ="<?php echo base_url();?>idf/amendements/"+val;
		
		 
	 } 
 }
 
 	function showPSI()
 {  

if($('#psiCheckbox').is(":checked")){
	$('#psi').show();
	$('#psivalue').val('1');
	
}else{
	$('#psi').hide();
	$('#psivalue').val('0');
}
 }
  	function showPriorApprovalvalue()
 {  
if($('#PriorApproval').is(":checked")){
	$('#PriorApprovalvalue').val('1');
	$('#psi2').show();
}else{
	$('#PriorApprovalvalue').val('0');
	$('#psi2').hide();
}
 }
 
 function localInspection()
 {
	 if($('#Inspection').is(":checked")){
	$('#Inspectionvalue').val('1');
}else{
	$('#Inspectionvalue').val('0');

}
 }
 
  function COMESAApplication()
 {
	 if($('#COMESA').is(":checked")){
	$('#COMESAvalue').val('1');
}else{
	$('#COMESAvalue').val('0');

}
 }
 
   function getDate()
 {
	 $('#EDT').val($('#reservation3').val());
 }

</script>
</body>

</html>
