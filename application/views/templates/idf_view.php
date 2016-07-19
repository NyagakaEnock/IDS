
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
						<div class="row">
						<div class="col-lg-7">
                         Import Declaration Form (I.D.F) Details
                        </div>
						
						<div class="col-lg-5">
                            Select a record to Print or Edit <select class="form-control select2" style="width:58%;" onchange="loadData(this.value)">
														<option ></option>
														<?PHP foreach($searchIDFRecord as $key)
														{
														?>
														<option ><?php echo $key->IndentNo?></option>
														<?php
														}
														?>
														</select>
                        </div>
						</div>
						</div>
                        <!-- /.panel-heading -->
                    <!-- /.panel --> 
					 <div class="panel-body panel-default">
					 <div class="panel panel-default">
                        <div class="panel-heading">
                            Main IDF Details
											<ul class="nav  navbar-right" style="margin-top:-10px;">		  
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                         <i class="fa fa-caret-down"></i>
						More IDF Information 
                    </a>
                    <ul class="dropdown-menu dropdown-user">
					
                        <li><a href="<?php echo base_url();?>idf/idfShippingInfo"> Shipping Information</a>
                        </li>
                        <li><a href="<?php echo base_url();?>idf/ProcesedAmendments"> Items / Items Information</a>
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
	<form id="idfmain" role="form" action="idf/createidfmain" method="POST">					
						<div class="col-lg-4">
					<label>Select Indent No</label>
					<select class="form-control select2" style="width:95%" onchange="loadData(this.value)">
					<option><?php if(isset($loadData)){
						foreach($loadData as $row);
						echo $row->IndentNo;
					}elseif(isset($editIDFRecord)){
						foreach($editIDFRecord as $row);
						echo $row->IndentNo;
					}?></option>
					<?php foreach($loadIndentNos as $key):?>
					<option><?php echo $key->IndentNo;?></option>
					<?php endforeach;?>
					</select>
					<input type="hidden" id="IndentNo" value="<?php if(isset($loadData)){
						foreach($loadData as $row);
						echo $row->IndentNo;
					}?>"class="form-control input-sm"name="IndentNo" style="width:95%">	
					
					<label>Expected Date</label>
					<?php $date=date_create(date("Y-m-d"));
						date_add($date,date_interval_create_from_date_string("30 days"));
						//echo date_format($date,"d/m/Y");
						?>
					<input type="text" id="reservation2" class="form-control input-sm" name="ExpectedDate"
					value="<?PHP
					if(isset($editIDFRecord)){
						foreach($editIDFRecord as $row);
						echo substr($row->LastExpected,0,10);
					}else{
						echo date_format($date,"d/m/Y");
					}
					?>" style="width:95%">	
					
					<label>Select Importer</label>
					<select class="form-control select2" style="width:95%" onchange="fillCombo('ImporterCode',this.value)">
					<option><?php if(isset($loadData)){
						foreach($loadData as $row);
						echo $row->ImporterName;
					}elseif(isset($editIDFRecord)){
						foreach($editIDFRecord as $row);
						echo $row->ImporterName;
					}?></option>
					</select>
					<input type="hidden" id="ImporterCode" name="ImporterCode" value="<?php if(isset($loadData)){
						foreach($loadData as $row);
						echo $row->ImporterCode;
					}elseif(isset($editIDFRecord)){
						foreach($editIDFRecord as $row);
						echo $row->ImporterCode;
					}?>">
					<label>Select Exporter</label>
					<select class="form-control select2" style="width:95%" name="ExporterName" onchange="fillCombo('ExporterCode',this.value)">
					<option> <?php if(isset($loadData)){
						foreach($loadData as $row);
						echo $row->ExporterName;
					}elseif(isset($editIDFRecord)){
						foreach($editIDFRecord as $row);
						echo $row->ExporterName;
					}?></option>
					</select>
						<input type="hidden" id="ExporterCode" name="ExporterCode"value="<?php if(isset($loadData)){
						foreach($loadData as $row);
						echo $row->ExporterCode;
					}elseif(isset($editIDFRecord)){
						foreach($editIDFRecord as $row);
						echo $row->ExporterCode;
					}?>">
					<label>Intervention Code</label>
					<input type="text" id="InterventionCode" class="form-control input-sm"name="InterventionCode" value="<?PHP if(isset($editIDFRecord)){
						foreach($editIDFRecord as $row);
						echo $row->InterventionCode;
					}else echo 3; ?>" style="width:95%">	
					</div>
					<div class="col-lg-4">
						<div class="form-group">
					<label>Exporter's Postal Address</label>
					<input type="text" id="Address" class="form-control input-sm"name="Address" value="<?php if(isset($loadData)){
						foreach($loadData as $row);
						echo $row->PostalAddress;
					}elseif(isset($editIDFRecord)){
						foreach($editIDFRecord as $row);
						echo $row->ExpPostAddress;
					}?>" style="width:95%">	
					<label>Country </label>
					<select class="form-control select2" style="width:95%" name="Country">
					<option><?php if(isset($loadData)){
						foreach($loadData as $row);
						echo $row->Country;
					}elseif(isset($editIDFRecord)){
						foreach($editIDFRecord as $row);
						echo $row->ExpCountry;
					}?></option>
					</select>
					<label>Town</label>
					<select class="form-control select2" style="width:95%" name="TownCity">
					<option><?php if(isset($loadData)){
						foreach($loadData as $row);
						echo $row->TownCity;
					}elseif(isset($editIDFRecord)){
						foreach($editIDFRecord as $row);
						echo $row->ExpTownCity;
					}?></option>
					<?php
					foreach($loadTownCity as $row2):
					?>
					<option><?php echo $row2->TownCity;?></option>
					<?php
					endforeach;
					?>
					</select>
					
					<label>Postal Code</label>
					<input type="text" name="PostalCode" value="<?php if(isset($loadData)){
						foreach($loadData as $row);
						echo $row->PostalCode;
					}elseif(isset($editIDFRecord)){
						foreach($editIDFRecord as $row);
						echo $row->PostalCode;
					}?>" class="form-control input-sm"name="Invoice" style="width:95%">
                                    <label>Select Contact  Person</label>
									<select class="form-control select2" style="width:95%" name="Contact">
									<option value="<?php if(isset($editIDFRecord)){
						foreach($editIDFRecord as $row);
						echo $row->StaffIDNo;
					}?>"><?php if(isset($editIDFRecord)){
						foreach($editIDFRecord as $row);
						echo $row->AllNames;
					}?></option>
									<?php foreach($loadContactPeople as $key):?>
					<option value="<?php echo $key->StaffIDNo;?>"><?php echo $key->AllNames;?></option>
					<?php endforeach;?>
									</select>					
						</div>

					</div>
					
					<div class="col-lg-4">
					<div class="form-group">
									<div class="checkbox">
									<label><input type="checkbox" value="0" <?php 
									if(isset($editIDFRecord)){
						foreach($editIDFRecord as $row);
						if($row->PSIConfirm==1) echo "checked";
					}?>
					
					id="psiCheckbox" onchange="showPSI()">PSI Confirmation to Seller 
									</label>
									<input type="hidden" id="psivalue" value="<?php 
									if(isset($editIDFRecord)){
						foreach($editIDFRecord as $row);
						echo $row->PSIConfirm;
					}else echo 0;
									
									?>" name="psivalue">
									</div>
							<div id="psi" hidden>
									<label>Select PSI Agent </label>
									<select class="form-control select2" style="width:95%" name="psi">
									<option><?php 
									if(isset($editIDFRecord)){
						foreach($editIDFRecord as $row);
						echo $row->PSIAgency;
					}
									
									?></option>
									<?php foreach($loadPSIAgencyName as $key):?>
					<option><?php echo $key->PSIAgencyName;?></option>
					<?php endforeach;?>
									</select>	
							</div>
									<div class="checkbox">
									<label>
									<input type="checkbox" value="0" <?php 
									if(isset($editIDFRecord)){
						foreach($editIDFRecord as $row);
						if($row->PriorApproval==1) echo "checked";
					}?> id="PriorApproval" name="PriorApproval" onchange="showPriorApprovalvalue()">Applicable Prior Approval
									</label>
									<input type="hidden" id="PriorApprovalvalue" value="<?php 
									if(isset($editIDFRecord)){
						foreach($editIDFRecord as $row);
						echo $row->PriorApproval;
					}else echo 0;
									
									?>" name="PriorApprovalvalue">
									</div>

						
                  </div>
				  <div class="form-group">
<input type="hidden" id="IndentType" class=""name="IndentType" value="<?php if(isset($loadData)){
foreach($loadData as $row);
echo $row->IndentType;
}elseif(isset($editIDFRecord)){
						foreach($editIDFRecord as $row);
						echo $row->IndentType;
					}?>" style="width:45%">	
<input type="hidden" id="IndentDate" class=""name="IndentDate" value="<?php if(isset($loadData)){
foreach($loadData as $row);
echo $row->IndentDate;
}elseif(isset($editIDFRecord)){
						foreach($editIDFRecord as $row);
						echo $row->IndentDate;
					}?>" style="width:45%">	
<input type="hidden" id="CustomsCode" class=""name="CustomsCode" value="<?php if(isset($loadData)){
foreach($loadData as $row);
echo $row->CustomsCode;
}elseif(isset($editIDFRecord)){
						foreach($editIDFRecord as $row);
						echo $row->CustomsCode;
					}?>" style="width:45%">	

<input type="hidden" id="Currency" class=""name="Currency" value="<?php if(isset($FindTheUSDValues)){
foreach($FindTheUSDValues as $row);
echo $row->MCurrency;
}?>" style="width:45%">	
<input type="hidden" id="FOBValue" class=""name="FOBValue" value="<?php if(isset($FindTheUSDValues)){
foreach($FindTheUSDValues as $row);
echo number_format($row->TOTAL,'2');
}?>" style="width:45%">	
<input type="hidden" id="FOBValueUSD" class=""name="FOBValueUSD" value="<?php if(isset($CalculateAmountUSD)){
foreach($CalculateAmountUSD as $row);
echo $CalculateAmountUSD['CalculateAmountUSD'];
}
?>
" style="width:45%"/>	
<input type="hidden" id="ExchRate" class=""name="ExchRate" value="<?php if(isset($CalculateAmountUSD)){
foreach($CalculateAmountUSD as $row);
echo $CalculateAmountUSD['ExchRate'];
}
?>
"style="width:45%">
<input type="hidden" id="PrepaidAmount" class="" name="PrepaidAmount" value="<?php if(isset($GetMyPrepaidAmount)){
echo number_format($GetMyPrepaidAmount, 2, '.', '');

}elseif(isset($editIDFRecord)){
						foreach($editIDFRecord as $row);
						echo $row->PrepaidAmount;
					}
?>
"style="width:45%">
<input type="hidden" id="GOKProcessingFee" class=""name="GOKProcessingFee" value="<?php if(isset($editIDFRecord)){
						foreach($editIDFRecord as $row);
						echo $row->GOKFee;
					}else echo 0;
?>"style="width:45%">
<?php 
			if(isset($editIDFRecord)){
				?>
 <a href="<?php echo base_url()?>idf/reports/<?php if(isset($editIDFRecord)){
						foreach($editIDFRecord as $row);
						echo $row->IndentNo;
					}
?>" target="_blank" id="" 	class="btn btn-primary btn-sm pull-left"/>Print IDF Form</a>		
<?PHP
}								
?>
		 <input   type="submit" id="createidfmain" value="<?php 
									if(isset($editIDFRecord)){
						
						echo "Save  Changes";
					}else echo "Save  Details";
									
									?>" class="btn btn-success btn-sm pull-right"/>
		 <p id="loadingxx"></p>
							</DIV>
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

	function loadData(val)
 {  

	 if(val == "")
	 {
		 return;
	 } else {
		 window.location ="<?php echo base_url();?>idf/index/"+val;
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
	
}else{
	$('#PriorApprovalvalue').val('0');
}
 }
 
</script>
</body>

</html>
