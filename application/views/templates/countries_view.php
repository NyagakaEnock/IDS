
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
                    <div class="panel panel-primary" >
                        <div class="panel-heading" >
                         Specify Exorters and Assign Products 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
							<?PHP
							$Indent = $this->uri->segment(3,"");
							?>
                            <ul class="nav nav-tabs">
                                <li class="<?php if($Indent!="") echo "";else echo "active";?>"><a href="#home" data-toggle="tab">Exporter Details</a>
                                </li>
                                <li class="<?php if($Indent!="") echo "active";else echo "";?>"><a href="#profile" data-toggle="tab">Exporter Products</a>
                                </li>
                              
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class=" <?php if($Indent!="") echo "tab-pane fade";else echo "tab-pane fade in active";?>" id="home">
                                    <h4></h4>
									<div class="row">
									<div class="col-lg-4">
									  <div class="panel panel-default">
                       
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						
						 <form role="form" id="Amendments" action="Settings/SaveExporter">
												
												<div class="form-group">
												<label>Exporter Code</label>
												
						<input type="text" id="ExporterCode" class="form-control input-sm"name="ExporterCode" style="width:95%" value="<?php if(isset($get_ExportersName)){
							echo $get_ExportersName[0]->ExporterCode;
						}else{echo $genearateExporterCodes;}?>" readonly>
												</div>
												<div class="form-group">
												<label>Exporter Name</label>
												
				<input type="text" id="Fax" class="form-control input-sm"name="ExporterName" value="<?php if(isset($get_ExportersName)){
							echo $get_ExportersName[0]->ExporterName;
						}?>"style="width:95%">
												</div>
												<div id="countryFax">
												<div class="form-group">
												<label>Country of Supply</label>
												<select class="form-control select2" style="width:95%" name="Country">
												<option><?php if(isset($get_ExportersName)){
							echo $get_ExportersName[0]->Country;
						}?></option>
												<?php foreach($ParamCountries as $row):


												?>
												<option value="<?php echo $row->Country;?>"><?php echo $row->CountryName;?></option>

												<?php

												endforeach;
												?>
												</select>
													</div>
												<div class="form-group">
												<label>Fax</label>
												
												<input type="text" id="Fax" class="form-control input-sm"name="Fax" style="width:95%" value="<?php if(isset($get_ExportersName)){
							echo $get_ExportersName[0]->FaxNo;
						}?>">
												</div>
																								
												</div>
										

												

						
						</div>
							
							
									</div>
									<p id="loading"></p>
									</div>
									
						
									<div class="col-lg-4">
									  <div class="panel panel-default">
                       
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						
						 
										
												<div class="form-group">
												<label>Default Currency</label>
												<select class="form-control select2" style="width:95%" name="Currency">
												<option><?php if(isset($get_ExportersName)){
							echo $get_ExportersName[0]->Currency;
						}?></option>
												<?php foreach($get_Currency as $row):


												?>
												<option value="<?php echo $row->Currency;?>"><?php echo $row->CurrencyDesc;?></option>

												<?php

												endforeach;
												?>
												</select>
												</div>
												<div class="form-group">
												<label>Address</label>
												<div class="form-group">
												
												
												<input type="text" class="form-control input-sm" value="" id="" name="Address" value="<?php if(isset($get_ExportersName)){
							echo $get_ExportersName[0]->PostalAddress;
						}?>" style="width:95%"/>
												
												
												</div>
												</div>
												<div class="form-group">
												<label>Phone No</label>
											
												<input type="text" id="" name="Phone" class="form-control input-sm" style="width:95%" value="<?php if(isset($get_ExportersName)){
							echo $get_ExportersName[0]->PhoneNo;
						}?>">
												</div>
										
										
												<div class="form-group">
												<label>Email Address</label>
												
												<input type="text" id="OrderNumber" class="form-control input-sm"name="Email" style="width:95%" value="<?php if(isset($get_ExportersName)){
							echo $get_ExportersName[0]->EmailAddress;
						}?>">
												</div>
												
												

												

						
						</div>

							
						
						
									</div>
									</div>
									<div class="col-lg-4">
									  <div class="panel panel-default">
                       
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						
							<div class="form-group">
												<label>Contact Person</label>
												
												<input type="text" id="ContactPerson" class="form-control input-sm" name="ContactPerson" style="width:95%" value="<?php if(isset($get_ExportersName)){
							echo $get_ExportersName[0]->ContactPerson;
						}?>">
												</div>	
	<input   type="submit" id="SaveExporter" value="Save  Details" class="btn btn-success btn-sm pull-right"/>
													<p id="loading2"></p>
						 							 </form >


						
						</div>

							
						
						
									</div>
									</div>
									</div>
		
                                     </div>
                                <div class="<?php if($Indent!="") echo "tab-pane fade in active";else echo "tab-pane fade";?>" id="profile">
                                    <h4></h4>
                                   									<div class="row">
									<div class="col-lg-4">
									  <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							   <form role="form" id="assign" action="Settings/assignProduct">
                                        <div class="form-group">
                                            <label>Select Exporter Name</label>
                                         
											<select class="form-control select2" style="width:95%"  id="ExporterCode2" name="ExporterCode2" onchange="loadData(this.value)">
												<option value="<?php
												if(isset($get_ExportersName))
												{
													echo $get_ExportersName[0]->ExporterCode;
												}
												?>"><?php
												if(isset($get_ExportersName))
												{
													echo $get_ExportersName[0]->ExporterName;
												}
												?></option>
												<?php foreach($get_Exporters as $row):


												?>
												<option value="<?php echo $row->ExporterCode;?>"><?php echo $row->ExporterName;?></option>

												<?php

												endforeach;
												?>
												</select>

										</div>
										
										
										<button type="submit" id="assignProduct" class="btn btn-success btn-sm">Save Details</button>
							</form>
						
						<p id="myloading"></p>
						</div>
									</div>
									</div>
									 <div class="col-lg-8">
									 																		<p></p>
								
					 <div id="MainData">
                    <div class="panel panel-default">
					<div class="row">
					<div class="col-lg-4">

			
						</DIV>

						</div>	
                        <div class="panel-heading">
                          Select Products to Assign the Select Supplier
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
								<div class="table-responsive table-bordered" style="" >
                             <div class="dataTable_wrapper"  style="width:1500px;height:350px">
                         <table  class="table table-striped table-bordered table-hover" id="">
            
	
                                    <thead>
                                        <tr >
                                            <th>#</th>
                                            <th>Product Code</th>
                                            <th>Product Name</th>
											<th>Pack. Type</th>
                                            <th>Units/Pack</th>
											<th>Unit Size</th>
											<th>Qtty Units</th>
											<th>Qty Per Case</th>
											<th>Units of Case</th>
											<th>Commodity Code</th>
											<th>New Commodity Code</th>
											<th style="width:100px">SITC</th>
											
											
											
											
                                        </tr>
                                    </thead>
<tbody>
	<?php 
	$counter=1;
	if(isset($ShowActiveCommodityBrands)){
		$items = "";
		
	foreach($ShowActiveCommodityBrands as $key1):
		
	?>
	 <tr>
				<td><input type="checkbox" name="invoice" value="<?php echo $key1->ProductCode?>"></td>
				<td><?php echo $key1->ProductCode?></td>
				<td><?php echo $key1->ProductName?></td>
				<td><?php echo $key1->PackageType?></td>
				<td><?php echo $key1->UnitsPerPack?></td>
				<td><?php echo $key1->PackageSize?></td>
				<td><?php echo $key1->QttyUnits?></td>
				<td><?php echo $key1->QtyPerCase?></td>
				<td><?php echo $key1->UnitsofQty?></td>
				<td><?php echo $key1->CommodityCode?></td>
				<td><?php echo $key1->NewCommodityCode?></td>
				
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
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                           
									</div>      </div>
                       
				
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
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
		 
		 window.location="<?php echo base_url()?>Settings/index/"+val;
	 }

 }
 
  

	
</script>

</body>

</html>
