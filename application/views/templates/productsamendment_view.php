
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
                           Products / Items Amendments
											<ul class="nav  navbar-right" style="margin-top:-10px;">		  
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                         <i class="fa fa-caret-down"></i>
						More IDF Amendments 
                    </a>
                    <ul class="dropdown-menu dropdown-user">
					
                          <li><a href="<?php echo base_url()?>idf/amendements"> IDF Amendments</a>
                        </li>
                        <li><a href="<?php echo base_url()?>idf/ProcesedAmendments"> Procesed Amendments Manager</a>
                        </li>
						 
               
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

		 <div class="col-lg-8">
						 <div class="panel panel-default">
						 <div class="panel-body">
									 	<p></p>

					 <div id="MainData">
					 <div class="form-group">
					 	 <?php 
	 $IndentNo= "";
	 $ProductCode = $this->uri->segment(4,"");
	 $Freight ="";
	 $Charges="";
	 $TotFOBCurrent = "";
	 if(isset($ShowProductsUnderIndent)){
		 foreach($ShowProductsUnderIndent as $key);
			 $IndentNo = $key->IndentNo;
	 }
		 ?>

                         <label>Select Indent Number</label>
<select class="form-control select2" style="width:40%"  id="IndentNo" onchange="loadIDFNumber(this.value)" name="CommodityDesc">
		<option ><?php 	echo $IndentNo; ?></option>
		<?php if(isset($ShowDataSheet)){
			foreach($ShowDataSheet as $key):
					?>
					 <option ><?php 	echo $key->IndentNo; ?></option>
					<?php
				
			endforeach;
		}
		?>
		</select>
		</div>
                    <div class="panel panel-default">

					<div class="row">
					<div class="col-lg-4">

			
						</DIV>

						</div>	
                        <div class="panel-heading">
                          Products Under the Selected Indent
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

     <div class="table-responsive table-bordered" style="" >
	<p></p>					<div class="dataTable_wrapper" style="width:1500px;height:225px" id="pendingInvoices">	

	<table class="table">
		<thead>
			<tr>
				<th>#</th>
				<th>Product Code</th>
				<th>Product Name</th>
				<th>Units/Pack</th>
				<th>Unit Size</th>
				<th>Country</th>
				<th>Pack. Type</th>
				<th>Total Packs</th>
				<th>FOB Value</th>
				<th>Gross Weight</th>
				<th>Net Weight</th>
				<th>Currency</th>
				<th>Exch. Rate</th>
				<th>Comm. Code</th>
				<th>S.I.T.C.</th>
			</tr>
		</thead>
<tbody>
	<?php 
	if(isset($ShowProductsUnderIndent)){
		$items = "";
	foreach($ShowProductsUnderIndent as $key1):
		
	?>

	 <tr <?php if($ProductCode==$key1->ProductCode){echo "style='background-color:#FF00CC'";}?>>
		<td><input type="checkbox" name="invoice" onchange="loadProductsData('<?php echo $key1->ProductCode?>')"<?php if($ProductCode==$key1->ProductCode){echo "checked";}?> ></td>
		<td><?php echo $key1->ProductCode?></td>
	   <td><?php echo $key1->ProductName?></td>
	   <td><?php echo $key1->UnitsPerPack?></td>
		<td><?php echo $key1->UnitSize?></td>
		  <td><?php echo $key1->Country?></td>		
			<td><?php echo $key1->PackageType?></td>
		   <td><?php echo $key1->TotalPackages?></td>
		   <td><?php echo $key1->FOBValue?></td>
		   <td><?php echo $key1->GrossWeight?></td>
		    <td><?php echo $key1->NetWeight?></td>
		   <td><?php echo $key1->Currency?></td>
		       <td><?php echo number_format($key1->ExchRate,2)?></td>   
		
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
										<div class="col-lg-4">
									  <div class="panel panel-default">
									                          <div class="panel-heading">
                          Amend Product Details
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
	<form role="form" id="Amendments" action="idf/safeProductAmendments">
		<?php 
	if(isset($ShowProductsUnderIndent)&&$checkProductsUnderIndent==1){
	foreach($ShowProductsUnderIndent as $key1);
	?>
	<div class="form-group">
                  <label>Selected Product Name</label>
                                         
<p><?php 	echo $key1->ProductName;?></p>

	 								</div>	                                        <div class="form-group">
                                            <label>Packages</label>
                                         
<input class="form-control input-sm" type="text" value="<?php 	echo $key1->TotalPackages;
	?>" name="TotalPackages"  id="TotalPackages" placeholder="" style="width:95%">
<input class="" type="hidden" value="<?php 	echo $key1->ProductCode;
	?>" name="ProductCode"  id="ProductCode" placeholder="" style="width:95%">
	<input class="" type="hidden" value="<?php 	echo $key1->IndentNo;
	?>" name="IndentNo"  id="IndentNo" placeholder="" style="width:95%">
		<input class="" type="hidden" value="<?php 	echo $ShowDataSheet[0]->AmendNo;
	?>" name="AmendNo"  id="AmendNo" placeholder="" style="width:95%">
	 								</div>
		                                        <div class="form-group">
                                            <label>Total FOB Value</label>
                                         
<input class="form-control input-sm" type="text" value="<?php 	echo $key1->FOBValue;
	?>" name="FOBValue"  id="FOBValue" placeholder="" style="width:95%">
	 								</div>
	                                        <div class="form-group">
                                            <label>Gross Weight</label>
                                         
<input class="form-control input-sm" type="text" value="<?php echo $key1->GrossWeight;
	?>" name="GrossWeight"  id="GrossWeight" placeholder="" style="width:95%">

	 								</div>
                                        <div class="form-group">
                                            <label>Net Weight</label>
                                         
<input class="form-control input-sm" type="text" value="<?php 
	echo $key1->NetWeight;
	?>" name="NetWeight"  id="NetWeight" placeholder="" style="width:95%">
										</div>
	<button type="submit" id="safeProductAmendments" class="btn btn-success btn-sm">Save Details</button>
<?PHP
	}else{
		echo "<font color='red'>No Product Selected.</font>";
	}
?>

							</form>
						
						<p id="loading2"></p>
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

	function loadIDFNumber(val)
 {  

	 if(val == "")
	 {
		 return;
	 } else {
		 window.location ="<?php echo base_url();?>idf/Productsamendements/"+val;
	
	 } 
 }

   function loadProductsData(val)
 {
	 var IndentNo = $('#IndentNo').val();
	 if(val == "")
	 {
		 return;
	 } else {
		 window.location ="<?php echo base_url();?>idf/Productsamendements/"+IndentNo+"/"+val;
		
		 
	 } 
 }

</script>
</body>

</html>
