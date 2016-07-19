					  
<body style="background-color:#FFF;font-family:Times New Roman">
	<small>
	<div class="container">
	
		<div style="margin-top:200px">
					  <div>
	<?php if(isset($printconfirmedOriginal))
	{
	if($printconfirmedOriginal!=NULL)
	{
		foreach($printconfirmedOriginal as $key)
		{
		$ExporterCode = $key->ExporterCode;
		$IndentNo = $key->IndentNo;
	?>


	  <table width="100%"  >
	  <tr >
		<td colspan="2" align="center"><h3>Indent No <?php echo $IndentNo?></h3></td>
		<td colspan="">
		<?php echo substr($key->OrderDate,0,10)?></br>
		
		</td>
		
		</tr>
		<tr >
		<th style="">Please Supply to</th>
		<td colspan="">
		<?php echo $key->ImporterName?></br>
		<?php echo $key->PostalAddress." ".$key->TownCity.", ".$key->CountryName;?>
		</td>
		<td colspan="" align="center"><b>SHIPMENT</BR>MARKS</b></td>
	
		</tr>
		<tr >
		<th style="padding-top:7px" >Ship to the Port of</th>
		<td colspan=""><?php echo $key->ShipTo?> at first opportunity</td>
		<td rowspan="2" height="150px" width="150px" style="background-image: url('<?php echo base_url()?>dist/Indent.png');" align="center">
		 
		<b>KWAL</br>
		
		<P style="padding:7px"><?php echo $IndentNo?></p>
		
		<?php echo $key->ShipTo?></b>
	 
		</td>
		</tr>
		<tr >
		<th valign="top">Payment</th>
		<td colspan="" valign="top"><?php echo $key->TransTermName?> Bill from the Date of Shippment</br>
		<?php echo $key->BankName?>
		</br>
		<?php echo $key->ADDRESS." ".$key->Town." ".$key->CountryName?>
		</td>
		
		</tr>
		<tr>
		<th colspan="3" style="padding:0px"><?php echo strtoupper($this->uri->segment(2,""))?></th>
		</tr>
		<tr  style="border:1px solid #000;">
		<td colspan="3" style="padding:5px" align="center">Detailed Documentation and Insurance Instructions are attached to this Indent</td>
		</tr>
		</table>	
		
	  <table width="100%" border="1px" style="margin-top:20px" >
		<tr >
		<th ><?php echo $key->PackageTypeName?></th>
		<th >Size</th>
		<td >
		Description
		</td>
		<td >
		<?php if(($key->PackageType!='PC') && ($key->PackageType!='UN'))
		{
			echo "PRICE PER UNIT (".$confirmedOriginalDetails[0]->Currency.")";
		}else{
			echo "INVOICE VALUE (".$confirmedOriginalDetails[0]->Currency.")";
		}?>
		</td>
		</tr>
	<?php if(isset($confirmedOriginalDetails))
	{
	if($confirmedOriginalDetails!=NULL)
	{
		$TotalPackages = 0;
		foreach($confirmedOriginalDetails as $key1)
		{
	?>
	<tr>
	<td><?php 
	
	echo number_format($key1->TotalPackages)?></td>
	<td>
		<?php if(($key->PackageType!='PC') && ($key->PackageType!='UN'))
		{
		 if($key->PackageType=='DR')
		 {
			echo number_format($key1->UnitSize)." ".$key1->QttyUnits; 
		 }else{
			 echo number_format($key1->UnitsPerPack)."/".number_format($key1->UnitSize).$key1->QttyUnits; 
		 }
		}?>	
	</td>
	<td style="width:60%">
	<?php if(($key->PackageType=='PC') || ($key->PackageType=='UN'))
		{
			echo number_format($key1->TotalPackages)." ".$key->PackageTypeName." OF ".$key1->ProductName;
		}else{
			echo $key1->ProductName;
		}
		?>
	</td>
	<td>
	<?php if(($key->PackageType!='PC') && ($key->PackageType!='UN'))
		{
			echo number_format($key1->FOBValue/$key1->TotalPackages);
			
		}else{
			
			echo number_format($key1->FOBValue);
		}
		?>
	</td>
	</tr>
	
	<?php
	$TotalPackages = $TotalPackages+$key1->TotalPackages;
		}
	}
	}
	?>
		<tr>
	<th valign="top"><?PHP ECHO $TotalPackages?></th>
	<td></td>
	<td><p ><?php echo $key->ConfirmMessage?></p></td>
	<td></td>
	</tr>
<tr  style="border:1px solid #000;border-bottom:double">
		<td colspan="4" style="padding:5px" align="center">Unit price subject to Commissions and Allowances which must be shown on Invoices</td>
		</tr>	
		</table>
<table width="100%" style="margin-top:20px">
<tr  style="border:1px solid #000;border:double">
	<td width="30%" valign="top" style="padding:10px;border-right:1px solid #000">
	<div width="100%" style="border-bottom:1px solid #000;border-bottom:dotted">To</div>
	<div width="100%" style="border-bottom:1px solid #000;border-bottom:dotted;margin-top:10px">
	<?php echo $key->ExporterName?></div>
	<div width="100%" style="border-bottom:1px solid #000;border-bottom:dotted;margin-top:10px">
	<?php echo $key->PhysicalAddress?>
	</div>
	<div width="100%" style="border-bottom:1px solid #000;border-bottom:dotted;margin-top:10px">
		<?php echo $key->PostalAddress?>
	</div>
	<div width="100%" style="border-bottom:1px solid #000;border-bottom:dotted;margin-top:10px">
		<?php echo $key->TownCity." ".$this->Reports_model->getExporterCountry($key->ExporterCode)[0]->CountryName?>
	</div>
	</td>
	<td>
	<div align="center" style="border-bottom:1px solid #000;padding:7px">
	Our Order Number must be quoted on all correspondence.
	</div>
	<div align="center" style="padding:7px">
	<b style="text-decoration:underline">FOR KENYA WINE AGENCIES LTD.</b>
	
	</div>
	<div align="" style="padding:5px">
	<p>PROCUREMENT MANAGER................................................ Date ................................</p>
	</div>
	<div align="" style="padding:5px">
	<p>Ag. FINANCE MANAGER....................................................... Date ................................</p>
	</div>
	<div align="" style="padding:5px">
	<p>MANAGING DIRECTOR.......................................................... Date ................................</p>
	</div>
	</td>
	</tr>
</table>		
<?php 
		}
	}
	}
?>		
						  
						  </div>
						  		</div>
	</div>
	
	</small>
</body>