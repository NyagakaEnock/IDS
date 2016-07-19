
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
								Products / Brands Definition
                        </div>
                        <!-- /.panel-heading -->
                    <!-- /.panel --> 
					 <div class="panel-body panel-default">
					 <div class="panel panel-default">
                        <div class="panel-heading">
                           
										Products / Brands Definition	
                        </div>
                        <!-- /.panel-heading -->
<div class="panel-body">												
					<div class="row">

		 <div class="col-lg-5">
						 
						 <div class="panel-body">
									 

				
                    <div class="panel panel-default">
					
                        <div class="panel-heading">
                        Select Commodity Code (xx if not Available)
                        </div>
                        <!-- /.panel-heading -->
                      

     <div class="table-responsive table-bordered" style="" >
	 <div class="form-group col-lg-12">
			<div class="dataTable_wrapper" style="width:1000px;height:380px;margin-top:30px" id="">	

	<table class="table">
		<thead>
			<tr>
				<th>#</th>
				<th style="width:150px">Commodity Code</th>
				<th style="width:100px">SITC</th>
				<th>Qtty Units</th>
				<th>Notes</th>
				
</th>
				
			
				
			</tr>
		</thead>
<tbody>
	 <?php 
	 $CommodityCode= "";
	 $Freight ="";
	 $Charges="";
	 $TotFOBCurrent = "";
	 $AmendNo  = "";
	 if(isset($ShowRelevantCustomsData)){
		
		 foreach($ShowRelevantCustomsData as $key1);
	$CommodityCode = $key1->CommodityCode;
		 
		 ?>
		 
	 <tr style='background-color:#990033;color:#FFFFFF'>
		<td ><input type="radio" name="invoice" onchange="loadIDFNumber('<?php echo $key1->CommodityCode?>')"></td>
		<td style="cell-padding:55px"><?php echo $key1->CommodityCode?></td>
		<td><?php echo $key1->SITC?></td>
		<td><?php echo $key1->UnitofQuantity?></td> 
		<td><?php echo $key1->StandardDesc?></td>

	
			
	</tr>
		 <?PHP
		 
	 }

		 ?>
	<?php 
	if(isset($ShowRelevantCustomsTarriffs)){
	foreach($ShowRelevantCustomsTarriffs as $key1):
	
	?>

	 <tr >
		<td ><input type="radio" <?php if($CommodityCode==$key1->CommodityCode){echo "checked";}?> name="invoice" onchange="loadIDFNumber('<?php echo $key1->CommodityCode?>')"></td>
			<td style="cell-padding:55px"><?php echo $key1->CommodityCode?></td>
		<td><?php echo $key1->SITC?></td>
		  <td><?php echo $key1->UnitofQuantity?></td> 
		<td><?php echo $key1->StandardDesc?></td>
	
			
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
               
                    <!-- /.panel -->
                </div>

					
					 

					</div>
										<div class="col-lg-7">
									  <div class="panel panel-default">
									  						 <div class="panel-heading">
                       Product Details 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

	<form role="form" id="assign" action="Settings/saveProduct">
		                                        <div class="col-lg-6">
												  <label>Product Code  <font color="red"><b>*</b></font></label>
                                   
<input class="form-control input-sm " type="text" value="<?php if(isset($ProductDetails)){
	echo $ProductDetails[0]->ProductCode;
}?>" name="ProductCode"  id=""  style="width:95%">

<input class="form-control input-sm " type="hidden" value="<?php echo $CommodityCode;?>" name="CommodityCode"  id=""  style="width:95%">
	 								</div>
	                                       
                                         <div class="col-lg-6">
                                            <label>Package Type  <font color="red"><b>*</b></font></label>
                                         
<select class="form-control select2" style="width:95%"   name="PackegeType" id="">

		<option ><?php if(isset($ProductDetails)){
	echo $ProductDetails[0]->PackageType;
}?></option>
		<?php foreach($PackageTypes as $row):


		?>
		<option value="<?php echo $row->PackageType;?>"><?php echo $row->PackageTypeName;?></option>

		<?php

		endforeach;
		?>
		<option >Others</option >
		</select>
								</div>
                                     <div class="col-lg-12">
                                            <label>Product Name <font color="red"><b>*</b></font></label>
                                         
<input class="form-control input-sm " type="text" value="<?php if(isset($ProductDetails)){
	echo $ProductDetails[0]->ProductName;
}?>" name="ProductName"  id=""  style="width:95%">
								</div>
			<div class="col-lg-4">
                                            <label>Units Per Pack  <font color="red"><b>*</b></font></label>
                                         
<input class="form-control input-sm " type="text" value="<?php if(isset($ProductDetails)){
	echo $ProductDetails[0]->UnitsPerPack;
}?>" name="UnitsPerPack"  id=""  style="width:95%">
			</div>
						<div class="col-lg-4">
                                            <label>Unit Size  <font color="red"><b>*</b></font></label>
                                         
<input class="form-control input-sm " type="text" value="<?php if(isset($ProductDetails)){
	echo $ProductDetails[0]->PackageSize;
}?>" name="UnitSize"  id=""  style="width:95%">
		
			</div>
						<div class="col-lg-4">
                                            <label>Qtty Units  <font color="red"><b>*</b></font></label>
                                         
<select class="form-control select2" style="width:95%"  name="QttyUnits" id="">
		<option ><?php if(isset($ProductDetails)){
	echo $ProductDetails[0]->QttyUnits;
}?></option>
		<?php foreach($QttyUnitsName as $row):


		?>
		<option value="<?php echo $row->QttyUnits;?>"><?php echo $row->QttyUnitsName;?></option>

		<?php

		endforeach;
		?>
		<option >Others</option >
		</select>
			</div>
			
<div class="col-lg-6">
                                            <label>Quantity per Case</label>
                                         
<input class="form-control input-sm " type="text" value="<?php if(isset($ProductDetails)){
	echo $ProductDetails[0]->QtyPerCase;
}?>" name="QuantityPerCase"  id=""  style="width:95%">
			</div>	
<div class="col-lg-6">
                                            <label>Units of Quantity</label>
                                         
<select class="form-control select2" style="width:95%"  name="UnitsOfQuantity" id="">
		<option ><?php if(isset($ProductDetails)){
	echo $ProductDetails[0]->UnitsofQty;
}?></option>
		<?php foreach($UnitsofQtyName as $row):


		?>
		<option value="<?php echo $row->UnitsofQty;?>"><?php echo $row->UnitsofQtyName;?></option>

		<?php

		endforeach;
		?>
	
		</select>
			</div>	


								
	
 <div class="form-group col-lg-8" id="showReason" >
 
                                            <label>Notes/ Comments</label>
                                         
<textarea class="form-control"   name="Notes" rows="5"  style="width:95%"><?php if(isset($ProductDetails)){
	echo $ProductDetails[0]->Notes;
}?></textarea>
	 								</div>
									
									<div class="form-group col-lg-4">
									
		<div class="">
                                            <label>Department</label>
                                         
<select class="form-control select2" style="width:95%"  name="Department" id="">
		<option ><?php if(isset($ProductDetails)){
	echo $ProductDetails[0]->Depart;
}?></option>
		<?php foreach($DepartName as $row):


		?>
		<option value="<?php echo $row->Depart;?>"><?php echo $row->DepartName;?></option>

		<?php

		endforeach;
		?>
		</select>
			</div>
                                            <label>Source</label>
                                         
<select class="select2" style="width:95%"  name="Source" id="">
		<option ><?php if(isset($ProductDetails)){
	echo $ProductDetails[0]->Source;
}?></option>
		<?php foreach($SourceName as $row):


		?>
		<option value="<?php echo $row->Source;?>"><?php echo $row->SourceName;?></option>

		<?php

		endforeach;
		?>
		</select>
								<div class="form-group">
                                            <label>Category</label>
                                         
<select class="form-control select2" style="width:95%"  name="Category" id="">
	
		
		<option value="T">Trade Item</option>
		<option value="N">Non Trade Item</option>
		
		</select>
			</div>
			</div>										
					<button type="submit" id="saveProduct" class="btn btn-success btn-sm pull-right">Save Details</button>
							</form>
						
						<p id="loading2"></p>
						</div>
									</div>
									</div>
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
		 window.location ="<?php echo base_url();?>Settings/products/"+val;
		
		 
	 } 
 }
 	function loadIDFNumber2(val)
 {  

	 if(val == "")
	 {
		 return;
	 } else {
		 window.location ="<?php echo base_url();?>confirmation/NonIDFIndents/"+val;
		
		 
	 } 
 }
 
 	function showPSI()
 {  

if($('#Approved').is(":checked")){
	$('#showReason').hide();
	$('#Approvedvalue').val('Y');
	
}else{
	
	$('#Approvedvalue').val('N');
}
 }
  	function ApprovedNotFunc()
 {  
if($('#ApprovedNot').is(":checked")){
	
	$('#showReason').show();
	$('#ApprovedNotvalue').val('Y');

}else{
	$('#ApprovedNotvalue').val('N');

}
 }
 

</script>
</body>

</html>
