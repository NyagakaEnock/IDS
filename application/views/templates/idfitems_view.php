
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
                            IDF  Items / Comodities Details
											<ul class="nav  navbar-right" style="margin-top:-10px;">		  
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                         <i class="fa fa-caret-down"></i>
						More IDF Information 
                    </a>
                    <ul class="dropdown-menu dropdown-user">
					
                          <li><a href="<?php echo base_url();?>idf/"> Main IDF Information</a>
                        </li>
                        <li><a href="<?php echo base_url();?>idf/idfShippingInfo"> Shipping Information</a>
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
					<div class="col-lg-3">
									  <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
	<form role="form" id="IDFItems" action="idf/saveIDFItems">
                                        <div class="form-group">
                                            <label>Select Indent Number</label>
                                         
<select class="form-control select2" style="width:95%"  onchange="loadItemsData(this.value)" id="indentNo">
		<option ><?php if(isset($loadExporterDetails)){
			foreach($loadExporterDetails as $key);
					echo $key->IndentNo;
		}
		?></option>
		<?php foreach($idfItemsIndentNos as $row):


		?>
		<option value="<?php echo $row->SelectField;?>"><?php echo $row->SelectField;?></option>

		<?php

		endforeach;
		?>
		</select>
												 <input class="form-control input-sm" type="hidden" name="indentNo2" id="indentNo2" placeholder="" style="width:95%">
										</div>
										
										<div id="productDetails">
										<div class="form-group">
                         <label>Name of Selected Product</label>
                        <input class="form-control input-sm" name="ProductName" id="ProductName"  disabled style="width:100%" value="<?php if(isset($loadExporterDetails)){
						foreach($loadExporterDetails as $key);
						echo $key->ExporterName;
												}
												?>" >
						</div>
						<div class="form-group">
                        
						 									<div class="checkbox">
									<label>
									<input type="checkbox" value="0" id="COMESA" name="COMESA" onchange="COMESAApplication()">Check if Used
									</label>
<input type="hidden" id="COMESAvalue" value="0" name="COMESAvalue">
									</div>
                        <input class="form-control input-sm" name="ItemUsedYear" id="ItemUsedYear"   style="width:100%" value="N/A" >
						</div>
	                   
										
										</div>
										<button type="submit" id="saveIDFItems" class="btn btn-success btn-sm">Save Details</button>
							</form>
						
						<p id="loading2"></p>
						</div>
									</div>
									</div>
														 <div class="col-lg-9">
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
                           Select Product/s
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

     <div class="table-responsive table-bordered" style="" >
				<div class="dataTable_wrapper" style="width:1500px;height:200px" id="pendingInvoices">	

                                <table class="table">
                                    <thead>
                                        <tr>
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

	function loadItemsData(val)
 {  

	 if(val == "")
	 {
		 return;
	 } else {
		 window.location ="<?php echo base_url();?>idf/idfitemsInfo/"+val;
		
		 
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
