
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
                            Receiving Proforma Invoices
                        </div>
						
						<div class="col-lg-5">
                            Select a record to Print or Edit <select class="form-control select2" style="width:58%;" onchange="loadData(this.value)">
														<option ></option>
														<?PHP foreach($searchIndent as $key):
								
						//$ID = $this->proformainvoices_model->ShowCurrentIndentItems($key->IndentNo,$ProductCode="");
											
														?>
														<option ><?php echo $key->IndentNo?></option>
														<?php
												
														endforeach;
														?>
														</select>
                        </div>
						</div>
						</div>
							
						
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							 <div class="row">
							 <div class="col-lg-6">
                    <div class="panel panel-default">
					
                        <div class="panel-heading">
				
						  Select a Pending Proforma Invoice Requests

                        </div>
						<small>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
									<?php 
									$IndentNo = "";
									$Currency = "";
									if(isset($PendingProformaInvoiceData))
									{
										$IndentNo = $PendingProformaInvoiceData[0]->IndentNo;
										if($getCurrencyUnits==NULL)
										{
											$Currency = $PendingProformaInvoiceData[0]->Currency;
										
										}else{
											$Currency = $getCurrencyUnits[0]->Currency;
										
										}
										
									}
									?>		
								
                            <div class="table-responsive table-bordered" style="" >
							
	<p></p>					<div class="dataTable_wrapper" style="width:1100px;height:200px" id="pendingInvoices">	

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Indent No</th>
                                            <th>Indent Type</th>
                                            <th>Supplier/Exporter</th>
											<th>Date of Indent</th>
											<th>Attention To</th>
											<th>Delivered By</th>
											<th>Fax No</th>
											<th>Country</th>
											<th>Currency</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php 
									if(isset($PendingProformaInvoiceData))
									{
									foreach($PendingProformaInvoiceData as $key):?>
										 <tr <?php if($IndentNo==$key->IndentNo){echo "style='background-color:#FF00CC'";}?>>
                                <td><input type="radio" name="invoice" onchange="loadData('<?php echo $key->IndentNo?>')"></td>
                                            <td><?php echo $key->IndentNo?></td>
                                           <td><?php echo $key->IndentType?></td>
                                           <td><?php echo $key->ExporterName?></td>
										    <td><?php echo substr($key->IndentDate,0,10)?></td>
											 <td><?php echo $key->AttentionTO?></td>
											  <td><?php echo $key->DeliveryType?></td>
											    <td><?php echo $key->FaxNo?></td>
											   <td><?php echo $key->Country?></td>
											   <td><?php echo $Currency?></td>
                                        </tr>
									<?php endforeach;
									}
									?>
                                        <?php 
										if(isset($PendingProformaInvoiceRequests))
										{
											
										
										foreach($PendingProformaInvoiceRequests as $key):
										if($this->proformainvoices_model->ShowCommodityUnderIndent($key->IndentNo,$ProductCode="")!=NULL){
										?>
										 <tr>
                                <td><input type="radio" name="invoice" onchange="loadData('<?php echo $key->IndentNo?>')"></td>
                                            <td><?php echo $key->IndentNo?></td>
                                           <td><?php echo $key->IndentType?></td>
                                           <td><?php echo $key->ExporterName?></td>
										    <td><?php echo substr($key->IndentDate,0,10)?></td>
											 <td><?php echo $key->AttentionTO?></td>
											  <td><?php echo $key->DeliveryType?></td>
											    <td><?php echo $key->FaxNo?></td>
											   <td><?php echo $key->Country?></td>
											   <td><?php echo $key->Currency?></td>
                                        </tr>
									<?php
										}
									endforeach;
										
										}
									?>
                                    </tbody>
                                </table>
                            </div>
							</div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
<form role="form" id="ProformaInvoice" action="invoiceprocessing/createProformaInvoice">
												   <div class="panel panel-default" id="indentProduct">
											    
										<?php
										IF(isset($ShowCommodityUnderIndentData))
										{
											foreach($ShowCommodityUnderIndentData as $key);
										?>
							                           <div class="panel-heading">
                         Enter Values of the Proforma Invoice 
                        </div>						<div class="panel-body">						
			
				<label>Selected Product Name <b id="ProductName" style="color:red"><?php echo $key->ProductName;?></b></label>
	<input type="hidden" id="ProductCode" class=""name="ProductCode" value="<?php echo $key->ProductCode;?>" style="width:97%">
	
				<div class="row">
					
				<div class="col-lg-6">
				<label>Unit Size</label>
				<input type="text" id="UnitSize" class="form-control input-sm"name="UnitSize" value="<?php echo $key->UnitSize;?>" style="width:95%">	
				</div>
									<div class="col-lg-6">
					
				<label>Total Packages</label>
				<input type="text" id="PackagesReceived" class="form-control input-sm"name="PackagesReceived"  onchange="calculation()" value="<?php echo $key->PackagesOrdered;?>" style="width:95%">	
				
				</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
				<label>Gross Weight</label>
				<input type="text" id="GrossWeight" class="form-control input-sm"name="GrossWeight" value="0" style="width:95%">	
				</div>
							<div class="col-lg-6">
					
				<label>Total Value / Amount</label>
<input type="text" id="TotalValue" class="form-control input-sm"name="TotalValue"  onchange="calculation()" value="" style="width:95%">	
				
				</div>

				</div>
				<div class="row">
				
					<div class="col-lg-6">
					<div class="form-group">
				<label>Net Weight</label>
				<input type="text" id="NetWeight" class="form-control input-sm"name="NetWeight" value="0" style="width:95%">	
				</div>
				</div>
	
				
				<div class="col-lg-6">
			
		<input type="hidden" id="CountryOrigin" class="form-control input-sm"name="CountryOrigin" value="<?php // echo $key->Country;?>" style="width:98%">	
				</div>
				</div>
				
<input type="hidden" id="UnitsPerPack" class=""name="UnitsPerPack" value="<?php echo $key->UnitsPerPack;?>" style="width:97%">
<input type="hidden" id="QttyUnits" class=""name="QttyUnits" value="<?php echo $key->QttyUnits;?>" style="width:25%">	
<input type="hidden" id="ValuePerPack" class=""name="ValuePerPack" value="" style="width:25%">
<input type="hidden" id="UnitValue" class=""name="UnitValue" value="0" style="width:25%">
<input type="hidden" id="UnitValueKsh" class=""name="UnitValueKsh" value="" style="width:20%">
<input type="hidden" id="FullDescription" class=""name="FullDescription" value="" style="width:97%">
<input type="hidden" id="PackageType" class=""name="PackageType" value="<?php echo $key->PackageType;?>" style="width:97%">
												</div>
												<?php
										}
										?>
													</div>
													</small>
													<p id="loading" class="pull-left"></p>
							
																					<div class="col-lg-6">
												
												<input type="hidden" id="Country" class="form-control input-sm"name="Country" style="width:95%">	
												</div>
							 
							  </div>
							  <div class="col-lg-6" id="pendingIndents">
							  <p id="loadingxx"></p>
                    <div class="panel panel-default">
                        <div class="panel-heading">
				
							 
							 
						   Particulars of Commodities of Selected Indent

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
									
								
                            <div class="table-responsive table-bordered" style="" >
	<p></p>					<div class="dataTable_wrapper" style="width:1500px;height:185px" id="pendingInvoices">	

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>Total Packages</th>
											<th>Package Type</th>
											<th>Units/Package</th>
											<th>Unit Size</th>
											<th>S.I.T.C.</th>
											<th>Commodity Code</th>
											<th>Country of Origin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
										$ProductCode="";
										IF(isset($ShowCommodityUnderIndentData))
										{
											$ProductCode = $ShowCommodityUnderIndentData[0]->ProductCode;
										}
										
										IF(isset($ShowCommodityUnderIndent))
										{
											if($ShowCommodityUnderIndent==NULL)
											{
											echo "<font color='red'>No Products Found Under the Selected Indent.</font>";	
											}else{
											foreach($ShowCommodityUnderIndent as $key1):
											
										?>
									<tr <?php if($ProductCode==$key1->ProductCode){echo "style='background-color:#FF00CC'";}?>>
                                            <td><input type="radio" name="invoice" onchange="showData('<?php echo $key1->ProductCode?>','<?php echo $IndentNo?>')" ></td>
                                            <td><?php echo $key1->ProductCode?></td>
                                           <td><?php echo $key1->ProductName?></td>
                                           <td><?php echo $key1->PackagesOrdered?></td>
										    <td><?php echo $key1->PackageType?></td>
											 <td><?php echo $key1->UnitsPerPack?></td>
											  <td><?php echo $key1->UnitSize?></td>
											    <td><?php echo $key1->SITC?></td>
											   <td><?php echo $key1->CommodityCode?></td>
											   <td><?php //echo $key1->Country?></td>
                                        </tr>
									<?php
									endforeach;
										}
										}
										
										?>
                                    </tbody>
                                </table>           
                            </div>
							</div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
							                     <div class="panel panel-default">
                        <div class="panel-heading">
                            Details of Selected Indent 
                        </div>
                        <!-- /.panel-heading -->
<div class="panel-body">												
					<div class="row">
					
						<div class="col-lg-6">
					<label>Date Received</label>
					<input type="text" id="reservation2" class="form-control input-sm"name="DateReceived" style="width:95%" value="<?php if(isset($PendingProformaInvoiceData)){
						echo substr($PendingProformaInvoiceData[0]->DateReceived,0,10);
					}else{echo date('Y-m-d');}?>">	
					</div>
					<div class="col-lg-6">
						<div class="form-group">
					<label>Proforma Invoice No</label>
					<input type="text" id="Invoice" class="form-control input-sm"name="Invoice" style="width:95%" value="<?php if(isset($PendingProformaInvoiceData)){
						echo $PendingProformaInvoiceData[0]->ProfInvoiceNo;
					}?>">	
						</div>
		
		
					</div>
					<div class="col-lg-6">
						<div class="form-group">				
	<label>Proforma Invoice Date</label>
			<input type="text" id="InvoiceDate" class="form-control input-sm" value="<?php if(isset($PendingProformaInvoiceData)){
						echo substr($PendingProformaInvoiceData[0]->ProfInvoiceDate,0,10);
					}else{echo date('Y-m-d');}?>" name="InvoiceDate" style="width:95%">	
</div>
</div>

<div class="col-lg-6">
						<div class="form-group">				
	<label>Currency</label>
<select class="form-control select2" name="Currency">
<option><?php echo $Currency;?></option>
<?php 
if(isset($get_Currency))
{
	foreach($get_Currency as $key)
	{
		?>
<option><?php echo $key->Currency;?></option>		
		<?php
	}
}

?>
</select>
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
	<?php 
	$ProductCode="";
	IF(isset($ShowCommodityUnderIndentData))
	{
		foreach($ShowCommodityUnderIndentData as $key);
	?>
<input type="hidden" id="UnitsPerPack" class=""name="UnitsPerPack" value="<?php echo $key->UnitsPerPack;?>" style="width:97%">
<input type="hidden" id="QttyUnits" class=""name="QttyUnits" value="<?php echo $key->QttyUnits;?>" style="width:25%">	
<input type="hidden" id="ValuePerPack" class=""name="ValuePerPack" value="" style="width:25%">
<input type="hidden" id="UnitValue" class=""name="UnitValue" value="0" style="width:25%">
<input type="hidden" id="UnitValueKsh" class=""name="UnitValueKsh" value="" style="width:20%">
<input type="hidden" id="FullDescription" class=""name="FullDescription" value="" style="width:97%">
<input type="hidden" id="PackageType" class=""name="PackageType" value="<?php echo $key->PackageType;?>" style="width:97%">		
<input type="hidden" id="IndentNo" class=""name="IndentNo" value="<?php echo $IndentNo;?>" style="width:97%">
<?php
}
	?>					  
 <input   type="submit" id="saveProformaInvoice" value="Save   Details" class="btn btn-success btn-sm pull-right"/>
							<p id="invoiceloading"></p>
</form>
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
	window.location = "<?php echo base_url()?>invoiceprocessing/proformainvoices/"+val;
}
function showData(product,val)
{
	window.location = "<?php echo base_url()?>invoiceprocessing/proformainvoices/"+val+"/"+product;
}

	function ShowCommodityUnderIndent(x)
{
			 var xmlhttp;
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
 	  document.getElementById("loadingxx").innerHTML='';
	 document.getElementById("pendingIndents").innerHTML= xmlhttp.responseText;
    }
  }

  document.getElementById("loadingxx").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
xmlhttp.open("POST","<?php echo base_url()?>invoiceprocessing/ShowCommodityUnderIndent?Indent="+x,true);
xmlhttp.send();
}

	function ShowCommodityUnderIndentProduct(x,y)
{
var ExchRate = $('#ExchRate').val();
if(ExchRate==""){
document.getElementById("indentProduct").innerHTML="<font color='red'>This Week's Customs Exchange(Selling) Rate for the Selected Currency is Missing. Please Consult System Administrator and Try again.</font>";
return;
}
			 var xmlhttp;
			
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
 	  document.getElementById("loading3").innerHTML='';
	 document.getElementById("indentProduct").innerHTML= xmlhttp.responseText;
    }
  }

  document.getElementById("loading3").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
xmlhttp.open("POST","<?php echo base_url()?>invoiceprocessing/ShowCommodityUnderIndentProduct?ProductCode="+x+"&indentNo="+y,true);
xmlhttp.send();
}


</script>

</body>

</html>
