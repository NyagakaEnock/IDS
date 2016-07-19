<table width="100%" border="1px">

	<?php if(isset($printNewOrders))
	{
	if($printNewOrders!=NULL)
	{
		foreach($printNewOrders as $key)
		{
		$ExporterCode = $key->ExporterCode;
		$IndentNo = $key->IndentNo;
	?>
		<tr>
		<th>Indent No</th>
		<th colspan="">Order No</th>
		<th colspan="">Indent Date</th>
		<th colspan="">Indent Type</th>
		<th colspan="5">Date Expected</th>
	</tr>
	<tr>
		<td><?php echo $key->IndentNo;?></td>
		<td><?php echo $key->OrderNo;?></td>
		<td><?php echo $key->IndentDate;?></td>
		<td colspan=""><?php echo $key->IndentType;?></td>
		<td colspan="5"><?php echo $key->DateExpected;?></td>
	</tr>
		<tr>
		<th rowspan="2"></th>
		<th rowspan="">Exporter Code</th>
		<th colspan="4">Exporter Name</th>
	</tr>
	<?php
	foreach($this->Reports_model->getExporters($ExporterCode) as $key2);
	@$Count = count($this->Reports_model->printNewOrders($IndentNo,$dates));
	?>
	<tr>
		<td ><?php echo $key2->ExporterCode;?></td>
		<td colspan=""><?php echo $key2->ExporterName;?></td>

	</tr>
		<tr>
		<th colspan="2" rowspan="<?php echo $Count+2;?>"></th>
		<th rowspan="">Product Code</th>
		<th>Product Name</th>
		<th >Packages Ordered</th>
		<th >Unit Size</th>
		
		
	</tr>	
	<?php
	@$dates = $dates;
	$PackagesOrdered = 0;
	 foreach($this->Reports_model->printNewOrders($IndentNo,$dates) as $key)
	{
		
		?>
		
		<tr>
		<td><?php echo $key->ProductCode;?></td>
		<td ><?php echo $key->ProductName;?></td>
		<td ><?php echo $key->PackagesOrdered;?></td>
		<td ><?php echo $key->UnitSize." ".$key->QttyUnits;?></td>
		</tr>
		
		<?php
		$PackagesOrdered = $key->PackagesOrdered+$PackagesOrdered;
	}
	?>
		<tr>
		<td></td>
		<th>Total Packages</th>
		<th ><?php echo $PackagesOrdered;?></th>
		<td ></td>
		</tr>
	<?php
	
	
	}
	}
	}
	?>
	
</table>