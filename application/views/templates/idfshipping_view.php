
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
                            IDF  Shipping Details
											<ul class="nav  navbar-right" style="margin-top:-10px;">		  
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                         <i class="fa fa-caret-down"></i>
						More IDF Information 
                    </a>
                    <ul class="dropdown-menu dropdown-user">
					
                          <li><a href="<?php echo base_url();?>idf/"> Main IDF Information</a>
                        </li>
                        <li><a href="<?php echo base_url();?>idf/idfitemsInfo"> Items / Items Information</a>
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
	<form id="idfmainidfshipping" role="form" action="idf/createidfshipping" method="POST">					
						<div class="col-lg-4">
					<label>Select Indent No</label>
					<select class="form-control select2" style="width:95%" onchange="loadShippingData('IndentNo',this.value)">
					<option><?php if(isset($loadShippingData)){
						foreach($loadShippingData as $row);
						echo $row->IndentNo;
					}?></option>
					<?php foreach($loadShippingIndentNos as $key):?>
					<option><?php echo $key->IndentNo;?></option>
					<?php endforeach;?>
					</select>
					<input type="hidden" id="IndentNo" value="<?php if(isset($loadShippingData)){
						foreach($loadShippingData as $row);
						echo $row->IndentNo;
					}?>"class="form-control input-sm"name="IndentNo" style="width:95%">		
					<label>Select Country of Supply</label>
					<select class="form-control select2" style="width:95%" name="Country">
					<option><?php if(isset($loadShippingData)){
						foreach($loadShippingData as $row);
						echo $row->Country;
					}?></option>
					<?php
					foreach($coutryofSupply as $row):
					?>
					<option value="<?php echo $row->Country;?>"><?php echo $row->CountryName;?></option>
					<?php
					endforeach;
					?>
					</select>		
					<label>Proforma Invoice No</label>
					<input type="text" id="ProfInvoiceNo" class="form-control input-sm"name="ProfInvoiceNo" value="<?php if(isset($loadShippingData)){
						foreach($loadShippingData as $row);
						echo $row->ProfInvoiceNo;
					}?>" style="width:95%">		
					<label>Proforma Invoice Date</label>

					<input type="text" id="reservation2" class="form-control input-sm" name="InvoiceDate"
					value="<?php if(isset($loadShippingData)){
						foreach($loadShippingData as $row);
						echo substr($row->ProfInvoiceDate,0,10);
					}?>" style="width:95%">	
					<label>Port of Discharge</label>
					<select class="form-control select2" style="width:95%" name="Discharge">
					<option>Mombasa</option>
					<?php
					foreach($portofDischarge as $row):
					?>
					<option value="<?php echo $row->PortCode;?>"><?php echo $row->PortName;?></option>
					<?php
					endforeach;
					?>
					</select>
					<label>Port of Customs Clearance</label>
					<select class="form-control select2" style="width:95%"  name="Clearance">
					<option>ICD-EMBAKASI</option>
					<?php
					foreach($portofDischarge as $row):
					?>
					<option value="<?php echo $row->PortCode;?>"><?php echo $row->PortName;?></option>
					<?php
					endforeach;
					?>
					</select>						
					</div>
					<div class="col-lg-4">
					<label>Original Certificate Ref</label>

					<input type="text" id="Certificate" class="form-control input-sm" name="Certificate"
					value="NONE" style="width:95%">	
					<label>Transaction Terms</label>
					<select class="form-control select2" style="width:95%"  name="transactionTerms">
					<option>90 DAYS</option>
					<?php
					foreach($transactionTerms as $row):
					?>
					<option value="<?php echo $row->TransTerm;?>"><?php echo $row->TransTermName;?></option>
					<?php
					endforeach;
					?>
					</select>	
					<label>Transportation Mode</label>
					<select class="form-control select2" style="width:95%"  name="Transportation">
					<option></option>
					<?php
					foreach($transportationMode as $row):
					?>
					<option value="<?php echo $row->TransMode;?>"><?php echo $row->TransModeName;?></option>
					<?php
					endforeach;
					?>
					</select>	
					<label>E.T.D</label>

					<input type="text" id="reservation3" onchange="getDate()" class="form-control input-sm" name=""
					value="" style="width:95%">	
					<input type="hidden" id="EDT"  class="form-control input-sm" value="SOONEST" name="EDT"
					value="" style="width:95%">	
					<label>Incoterm</label>
					<select class="form-control select2" style="width:95%"  name="Incoterm">
					<option></option>
					<?php
					foreach($IncotermName as $row):
					?>
					<option value="<?php echo $row->Incoterm;?>"><?php echo $row->IncotermName;?></option>
					<?php
					endforeach;
					?>
					</select>	
					<label>Other Charges</label>

					<input type="text" id="OtherCharges" class="form-control input-sm" name="OtherCharges"
					value="0.00" style="width:95%">	
					</div>
					
					<div class="col-lg-4">
									<div class="checkbox">
									<label>
									<input type="checkbox" value="0" id="psiCheckbox" onchange="showPSI()">Freight Payable Locally ?
									</label>
									<input type="hidden" id="psivalue" value="0" name="Freight">
									</div>
							<div id="psi" hidden>
									
									<input type="text" id="OtherCharges" class="form-control input-sm" name="FreightValue"
					value="0.00" style="width:95%">	
							</div>
									<div class="checkbox">
									<label>
		<input type="checkbox" value="0" id="PriorApproval" name="PriorApproval" onchange="showPriorApprovalvalue()">Insurance Payable Locally ?
									</label>

									</div>	
	<div id="psi2" hidden>
									<input type="hidden" id="PriorApprovalvalue" value="0" name="Insurance">
		<input type="text" id="OtherCharges" class="form-control input-sm" name="Insurancevalue"
					value="0.00" style="width:95%">		
</div>	
<label>Other Charges Description</label>	
<textarea rows="2" class="form-control" name="OtherChargesDesc"></textarea>
									<div class="checkbox">
									<label>
									<input type="checkbox" value="0" id="COMESA" name="COMESA" onchange="COMESAApplication()">COMESA Tariff Application
									</label>
<input type="hidden" id="COMESAvalue" value="0" name="COMESAvalue">
									</div>
									<div class="checkbox">
									<label>
		<input type="checkbox" value="0" id="Inspection" name="Inspection" onchange="localInspection()">Subject to Local Inspection
									</label>
<input type="hidden" id="Inspectionvalue" value="0" name="Inspectionvalue">
<input type="hidden" id="DutyFree" value="NO" name="DutyFree">
<?php if(isset($GetTotalPackages)){
?>
<input type="TEXT" id="ShipCurrency" value="<?php echo $GetTotalPackages['MCurrency']?>" name="ShipCurrency">
<input type="hidden" id="ExchangeRate" value="<?php echo number_format($GetTotalPackages['MExchRate'], 4, '.', '')?>" name="ExchangeRate">
<input type="hidden" id="TotalPackages" value="<?php echo $GetTotalPackages['TOTAL']?>" name="TotalPackages">
<input type="hidden" id="PackageType" value="<?php echo $GetTotalPackages['PackageType']?>" name="PackageType">
<input type="hidden" id="TotalFOBValue" value="<?php echo number_format($SumofReceivedItems, 2, '.', '');?>" name="TotalFOBValue">
<?php
}
?>

									</div>
				 <input   type="submit" id="createidfshipping" value="Save  Details" class="btn btn-success btn-sm pull-right"/>
		 <p id="loadingxx"></p>
					</div>
					</form>
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

	function loadShippingData(Id,val)
 {  

	 if(val == "")
	 {
		 return;
	 } else {
		 window.location ="<?php echo base_url();?>idf/idfShippingInfo/"+val;
		 //document.getElementById(Id).value = val
		 
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
