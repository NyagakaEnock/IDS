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
		<th colspan="6">Date Received</th>
	</tr>
	<tr>
		<td><?php echo $key->IndentNo;?></td>
		<td><?php echo $key->OrderNo;?></td>
		<td><?php echo substr($key->IndentDate,0,10);?></td>
		<td colspan=""><?php echo $key->IndentType;?></td>
		<td colspan="6"><?php echo substr($key->DateReceived,0,10);?></td>
	</tr>
		<tr>
		<th rowspan="2"></th>
		<th rowspan="">Exporter Code</th>
		<th colspan="6">Exporter Name</th>
	</tr>
	<?php
	foreach($this->Reports_model->getExporters($ExporterCode) as $key2);
	@$Count = count($this->Reports_model->printConfirmedOrders($IndentNo,$dates));
	?>
	<tr>
		<td ><?php echo $key2->ExporterCode;?></td>
		<td colspan=""><?php echo $key2->ExporterName;?></td>

	</tr>
		<tr>
		<th colspan="2" rowspan="<?php echo $Count+2;?>"></th>
		<th rowspan="">Product Code</th>
		<th>Product Name</th>
		<th >Packs Ordered</th>
		<th >Packs Received</th>
		<th >Unit Size</th>
		<th >Total Value</th>
		
		
	</tr>	
	<?php
	@$dates = $dates;
	$PackagesOrdered = 0;
	$PackagesReceived = 0;
	$TotalValue = 0;
	 foreach($this->Reports_model->printConfirmedOrders($IndentNo,$dates) as $key)
	{
		
		?>
		
		<tr>
		<td><?php echo $key->ProductCode;?></td>
		<td ><?php echo $key->ProductName;?></td>
		<td ><?php echo $key->PackagesOrdered;?></td>
		<td ><?php echo $key->PackagesReceived;?></td>
	
		<td ><?php echo $key->UnitSize." ".$key->QttyUnits;?></td>
			<td ><?php echo $key->TotalValue;?></td>
		</tr>
		
		<?php
		$PackagesOrdered = $key->PackagesOrdered+$PackagesOrdered;
			$PackagesReceived = $key->PackagesReceived+$PackagesReceived;
			$TotalValue = $key->TotalValue+$TotalValue;
	}
	
	?>
		<tr>
		<td></td>
		<th>Summary</th>
		<th ><?php echo $PackagesOrdered;?></th>
		<th ><?php echo $PackagesReceived;?></th>
		<td ></td>
		<th><?php echo number_format($TotalValue);?></th>;
		</tr>
<?php
	foreach($this->Reports_model->confirmationDetails($IndentNo) as $key)
	{
?>
		<tr>
		<td colspan="8" align="center">CONFIRMATION DETAILS</td>
	
		</tr>
		<tr>
		<th colspan="2">Port of Discharge</th>
		<th >Terms of Payment</th>
		<th >Bank</th>
		<th colspan="4">Confirmation Message</th>;
		</tr>
		<tr>
		<td colspan="2"  valign="top"><?php echo $key->PortName?></td>
		<td valign="top"><?php echo $key->TransTermName?></td>
		<td  valign="top"><?php echo $key->BankName?></td>
		<td colspan="4" style="width:30%"><?php echo $key->ConfirmMessage?></td>;
		</tr>
	<?php
	}
	}
	}
	}
	?>
	
</table>