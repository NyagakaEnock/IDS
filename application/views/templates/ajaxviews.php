<?php 	
$ExchangeRate = "";
if(isset($getIndentNo)){
$indentNo = "";
if($id=="PD"){
$indentNo = $getIndentNo.$id;
}else{
$indentNo = $id.$getIndentNo;

}

?>
	
			<div class="form-group">
			<input type="text"  id="IndentNumber" name="IndentNumber"  value ="<?php echo $indentNo?>" class="form-control input-sm" style="width:95%">
			</div>
<?php
		
}elseif(isset($countryFax)){
?>
			<div class="form-group">
			<label>Country of Supply</label>
			<select class="form-control select2" style="width:95%"  onchange="fillCombo('SupplyCountry',this.value)">
			<?php foreach($countryFax as $row);
			$query = $this->db->query("SELECT * FROM ParamCountries WHERE Country='{$row->Country}'");
			$query->result_array();
			foreach($query->result() as $key);
			?>
			<option value="<?php echo $row->Country;?>"><?php echo $key->CountryName;?></option>
			
			<?php foreach($ParamCountries as $row2):
			?>
			<option value="<?php echo $row2->Country;?>"><?php echo $row2->CountryName;?></option>

			<?php

			endforeach;
			?>
			</select>
			<input type="hidden" value="<?php echo $row->Country;?>"id="SupplyCountry" name="SupplyCountry">
			</div>
			<div class="form-group">
			<label>Fax</label>

			<input type="text" id="Fax" class="form-control input-sm" value="<?php echo $row->FaxNo;?>" name="Fax" style="width:95%">
			</div>
			<div class="form-group">
			<label>Attention to</label>
			<?php
			$query = $this->db->query("SELECT * FROM ParamExportersContacts WHERE ExporterCode='{$row->ExporterCode}' ORDER BY ContactName");
			$query->result_array();
			
			?>
			<select class="form-control select2" style="width:95%"  onchange="fillCombo('AttentionTo',this.value)">
			<option value="<?php echo $row->ContactPerson;?>"><?php echo $row->ContactPerson;?></option>

			
			</select>
			<input type="hidden" id="AttentionTo" value="<?php echo $row->ContactPerson;?>" class="form-control input-sm"name="AttentionTo" style="width:95%">
			</div>
<?php
		
}elseif(isset($ProformaClosing)){

			$query = $this->db->query("SELECT ParamCompanyBranch.* FROM ParamCompanyBranch WHERE ParamCompanyBranch.BranchCode='{$id}'");
			$query->result_array();
			foreach($query->result() as $key1);
foreach($ProformaClosing as $key);

?>
				<div class="form-group">
				 <div class="checkbox">
				<label>
					<input id="DutyFree" type="checkbox" disabled <?php if($key1->DutyFree==1) echo "checked";?> value="<?php echo $key1->DutyFree?>">Checked if Goods are of Duty-Free Shops
				</label>
				</div>
				<input type="hidden" id="country" class="" value="<?php echo $key1->Country?>" name="country" style="width:50%">
				
				</div>
				<div class="form-group">
				<label>Subject</label>

				<input type="text" id="Subject" class="form-control input-sm" name="Subject" value="<?php echo trim($key->DefaultTitle);?>" style="width:100%">
				</div>
				<div class="form-group">
				<label>Leading Message</label>

				<textarea rows="5" id="LeadingMessage" name="LeadingMessage"  value="<?php echo trim($key->ProformaLeading);?>" class="form-control input-sm"><?php echo trim($key->ProformaLeading);?>
				</textarea>
				</div>
				<div class="form-group">
				<label>Clossing Message</label>

				<textarea rows="5" id="ClossingMessage" name="ClossingMessage"  class="form-control input-sm"><?php echo trim($key->ProformaClosing);?></textarea>
				</div>

				<div class="form-group">
				<label>Other Information </label>

				<input type="text" id="OtherInformation" class="form-control input-sm" name="OtherInformation" value="Best Regards." style="width:100%">
				</div>
				<div class="form-group">

				</div>
<?php
}elseif(isset($MainData)){

$query = $this->db->query("SELECT ProformaInvoiceRequest.* FROM ProformaInvoiceRequest WHERE ProformaInvoiceRequest.IndentNo='{$id}'");
$query->result_array();
foreach($query->result() as $key1);

?>

							
							                    <div class="panel panel-default">
						<div class="panel-heading" style="color: #333;background-color: #f5f5f5;border-color: #ddd;">
                           Product Details
                        </div>
					<div class="row">
					
							<div class="col-lg-5" style="margin-left:15px">
 <input class="form-control input-sm" name="ExporterCode2"  id="ExporterCode2"  value="<?php echo $key1->ExporterCode?>"  type="hidden" style="width:100%" placeholder="" >
						
						
						</DIV>
						<div class="col-lg-5">
	
										   </div>
						</div>	
						 <div  style="width:730px;height:330px;overflow-x:scroll;overflow-y:scroll">
                       
                        <!-- /.panel-heading -->
                        <div class="panel-body"   >

  <div class="dataTable_wrapper" style="width:1500px;">
						<font color="red">Select one Product From the List Below</font>
                                 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
				<th ># </th>
				<th >Product Code </th>
				<th >Product Name </th>
				<th>Units/Pack </th>
				<th>UnitSize </th>
				<th>QttyUnits </th>
				<th style="width:200px">CommodityCode </th>
				<th style="width:100px">SITC. </th>
				<th>Department </th>
                                        </tr>
                                    </thead>
									
                                    <tbody>
			<?PHP 
			$ExporterCode = $key1->ExporterCode;
		
			
			foreach($MainData as $key)
			{
				if($this->invoiceprocessing_model->ItemsAlreadyExists($id,$key->ProductCode)==NULL)
					
			{
			?>
			<tr class="odd gradeX" >
			<td><input type="radio" name="product" onchange="loadProdctDetails('<?php echo $key->ProductCode?>')"></td>
			<td style="width:15%"><?php echo $key->ProductCode?></td>
			<td style="width:25%"><?php echo $key->ProductName?></td>
			<td style="width:10%"><?php echo $key->UnitsPerPack?></td>
			<td class="center" style="width:5%"><?php echo $key->PackageSize?></td>
			<td class="center" style="width:10%"><?php echo $key->QttyUnits?></td>
			
			<td><?php echo $key->CommodityCode?> </td>
			<td style="width:100px"><?php echo $key->SITC?></td>
			<td><?php echo $key->Depart?></td>
			</tr>
			<?php
			}
			}
			?>

                                    </tbody>
									
                                </table>
                            </div>
</div>
</div>
                            <!-- /.table-responsive -->
                        </div>
<script>

</script>
						

<?php
}elseif(isset($productdetails)){

	foreach($productdetails as $key);
?>
										<div class="form-group">
                         <label>Name of Selected Product</label>
                        <input class="form-control input-sm" name="" id=""  value="<?php echo $key->ProductName?>" disabled style="width:100%" placeholder="" >
						</div>
						 <input class="form-control input-sm" name="ProductName"  id="ProductName"  value="<?php echo $key->ProductName?>"  type="hidden" style="width:100%" placeholder="" >
						
	                                        <div class="form-group">
                                            <label>Total Packages</label>
                                            <input class="form-control input-sm" id="TotalPackages" value="<?php //echo $key->ProductCode?>"  name="TotalPackages" placeholder="">
										</div>
										 <div class="form-group">
                                            <label>Unit Size</label>
                       <input class="form-control input-sm" id="UnitSize" value="<?php echo $key->PackageSize?>" name="UnitSize" placeholder="" >
										</div>	
<div class="form-group">
<input class="form-control input-sm" type="hidden" id="ProductCode" value="<?php echo $key->ProductCode?>"  name="ProductCode" placeholder="">
<input class="form-control input-sm" type="hidden" id="PackageType" value="<?php echo $key->PackageType?>"  name="PackageType" placeholder="">
<input class="form-control input-sm" type="text" id="UnitsPerPack" value="<?php echo $key->UnitsPerPack?>"  name="UnitsPerPack" placeholder="">
<input class="form-control input-sm" type="hidden" id="QttyUnits" value="<?php echo $key->QttyUnits?>"  name="QttyUnits" placeholder="">
<input class="form-control input-sm" type="hidden" id="CommodityCode" value="<?php echo $key->SITC?>"  name="CommodityCode" placeholder="">


</div>										
							
<?php
}elseif(isset($PendingProformaInvoiceRequests)){
?>
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
			<?php foreach($PendingProformaInvoiceRequests as $key):?>
			 <tr>
				<td><input type="radio" name="invoice" ></td>
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
		<?php endforeach;?>
		</tbody>
	</table>
<?php
}elseif(isset($ShowCommodityUnderIndent)){

?><small>
  <p id="loadingxx"></p>
                    <div class="panel panel-default">
                        <div class="panel-heading">
				<ul class="nav  navbar-right" style="margin-top:-10px;">		  
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                         <i class="fa fa-caret-down"></i>
						More Options 
                    </a>
                    <ul class="dropdown-menu dropdown-user">
					
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
				</ul>   
							 
							 
						   Particulars of Commodities of Selected Indent

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
									
                            <div class="table-responsive table-bordered" style="" >
	<p></p>					<div class="dataTable_wrapper" style="width:1000px;height:200px" id="pendingInvoices">	

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
                                        <?php foreach($ShowCommodityUnderIndent as $key1):
											
										?>
										 <tr>
                                            <td><input type="radio" name="invoice" onchange="ShowCommodityUnderIndentProduct('<?php echo $key1->ProductCode?>','<?php echo $indentNo?>')" ></td>
                                            <td><?php echo $key1->ProductCode?></td>
                                           <td><?php echo $key1->ProductName?></td>
                                           <td><?php echo $key1->PackagesOrdered?></td>
										    <td><?php echo $key1->PackageType?></td>
											 <td><?php echo $key1->UnitsPerPack?></td>
											  <td><?php echo $key1->UnitSize?></td>
											    <td><?php echo $key1->SITC?></td>
											   <td><?php echo $key1->CommodityCode?></td>
											   <td><?php echo $key1->Country?></td>
                                        </tr>
									<?php endforeach;?>
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
		<?php
		foreach($InvoiceRequests as $key);
		if($InvoiceRequests==NULL)
		{
			echo "All Items Under this Indent have Been Received";
			return ;
		}
		$curency = $key->Currency;
		$sellingRate = $this->proformainvoices_model->GetCurrentSellingRate($curency);
		if($sellingRate!=null){
		foreach($sellingRate as $cur);	
		?>

			<label>Selected Supplier Name <b id="ProductName" style="color:red"><?php echo $key->ExporterName;?></b></label>				
			
<input type="hidden" id="IndentNo" class=""name="IndentNo" value="<?php echo $key->IndentNo;?>" style="width:97%">			
			<div class="row">
				<div class="col-lg-6">
			<label>Date Received</label>
	<input type="text" id="DateReceived" value="<?php echo date('Y-m-d');?>" class="form-control input-sm"name="DateReceived" style="width:95%">	
			</div>
							<div class="col-lg-6">
				
						<label>Proforma Invoice No</label>
			<input type="text" id="Invoice" class="form-control input-sm" value="" name="Invoice" style="width:95%">	
															
				</div>
			</div>
			<div class="row">

				<div class="col-lg-6">
				<div class="form-group">
<label>Proforma Invoice Date</label>
			<input type="text" id="InvoiceDate" class="form-control input-sm" value="<?php echo date('Y-m-d');?>" name="InvoiceDate" style="width:95%">	
			<input type="hidden" id="ExchRate" class="" value="<?php echo $cur->SellingRate?>" name="ExchRate" style="width:95%">	
			<input type="hidden" id="Units" class="" value="<?php echo $cur->Units?>" name="Units" style="width:95%">	
				
				</div>
			</div>
			
			<div class="col-lg-6">
				<div class="form-group">
<label>Currency</label>
<select class="form-control select2" id="Currency" name="Currency">
<option><?php echo $key->Currency;?></option>
<option></option>
</select>
</div>
			</div>
				</div>
							 
							
							  </div></small>
<?php
		}else {
			echo "<font color='red'>This Week's Customs Exchange(Selling) Rate for the Selected Currency is Missing. Please Consult System Administrator and Try again.</font>";
		?>
			<input type="hidden" id="ExchRate" class="" value="" name="ExchRate" style="width:95%">	
			<input type="hidden" id="Units" class="" value="" name="Units" style="width:95%">			
		<?php
}
}elseif(isset($ShowCommodityUnderIndentProduct)){
foreach($ShowCommodityUnderIndentProduct as $key);
?>

					   <div class="panel-heading">
Enter Values of the Proforma Invoice
</div>
<p id="loading3"><p>
	<div class="panel-body">			
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
			
		<input type="hidden" id="CountryOrigin" class="form-control input-sm"name="CountryOrigin" value="<?php echo $key->Country;?>" style="width:98%">	
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
}elseif(isset($loadReminderDetails)){
	foreach($loadReminderDetails as $key);
	
	?>						
			<div class="row">

			<div class="col-lg-6">
			<label>Indent No</label>
<input type="text" disabled id="IndentNo" value="<?php echo $key->IndentNo;?>" class="form-control input-sm"name="IndentNo" style="width:95%">	
			</div>
			<div class="col-lg-6">
			<label>Importer</label>
<input type="text" id="ImporterCode" disabled value="<?php echo $key->ImporterCode;?>" class="form-control input-sm"name="ImporterCode" style="width:95%">	

			</div>
			</div>
			<div class="row">
				
			
				<div class="col-lg-6">
				
<label>Supplier/Exporter</label><input type="text" id="PackagesReceived" disabled value="<?php echo $key->ExporterName;?>" class="form-control input-sm"name="PackagesReceived" style="width:95%">	
		<input type="hidden" id="ExporterCode" disabled value="<?php echo $key->ExporterCode;?>" class=""name="ExporterCode" style="width:95%">	
			</div>
		<div class="col-lg-6">
			
		<label>Select Contact Person</label>
		<select class="form-control select2" style="width:95%" onchange="fillCombo('StaffIDNo',this.value)">
		<option></option>
		<?php 
		foreach($loadContactPeople as $key1):
		?>
		
		<option value="<?php echo $key1->AllNames;?>"><?php echo $key1->AllNames;?></option>
		<?php
		endforeach;
		foreach($FindReminderMessage as $row)
		?>
		</select>	
	<input type="hidden" id="StaffIDNo" disabled value="" class=""name="StaffIDNo" style="width:95%">	
		</div>
		
		</div>
		<div class="row">
		
			<div class="col-lg-12">
			<div class="form-group">
		<label>Subject</label>
		<input type="text" id="Subject"value="<?php echo "PROPOSED INDENT NO ".$key->IndentNo;?>" class="form-control input-sm"name="Subject" style="width:95%">	
		</div>
		<div class="form-group">
		<label>Reminder Message</label>
		<textarea  id="ReminderMessage" class="form-control" rows="3" name="ReminderMessage" style="width:95%"><?php echo $row->ProformaReminder;?>"</textarea>
		</div>
		<div class="form-group">
		<label>Clossing Message</label>
		<textarea  id="ReminderClosing" class="form-control" rows="3" name="ReminderClosing" style="width:95%"><?php echo  $row->ProformaRemClosing;;?>"</textarea>
		</div>
		</div>
		</div>
		
<?php
}
?>
<script>
	
</script>