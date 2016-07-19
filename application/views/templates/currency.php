
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
                        					<div class="row">
						
						<div class="col-lg-3">
                        Set Weekly Currency Exchange Rates
                        </div>
						
					
					
					
					
						</div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" style="font-family:Times New Roman">
						 <div class="row">
						<form role="form" id="neworders" action="Settings/SellingRate/">
						<div class="col-lg-2">
                       Start Date <label style="color:red"><?php echo $getFirstDay?></label></br>
					   Last Date <label style="color:red"><?php echo $getLastDay?></label>
                        </div>
						<div class="col-lg-2">
                       Current Week <label style="color:red"><?php echo date('W')?></label></br>
					   Current Year <label style="color:red"><?php echo date('Y')?></label>
					</div>
					
						<div class="col-lg-3">
							<input type="hidden" id="" name="Currency" placeholder="" value="<?php 	if(isset($get_CurrencyData))
						{
						if($get_CurrencyData!=NULL)
						{
							echo $get_CurrencyData[0]->Currency;
						}
						}?>" class="form-control input-sm" style="width:50%">
						<label>Buying Rate</label>
						<input type="text" id="" name="BuyingRate" placeholder="" value="<?php 	if(isset($WeeklyCurrency))
						{
						if($WeeklyCurrency!=NULL)
						{
							echo number_format($WeeklyCurrency[0]->BuyingRate, 2, '.', '');
						}
						}?>" class="form-control input-sm" style="width:50%">
						 
                        </div>
						<div class="col-lg-3">
						<label>Selling Rate</label>
							<input type="text" id="" name="SellingRate" placeholder="" value="<?php 	if(isset($WeeklyCurrency))
						{
							if($WeeklyCurrency!=NULL)
						{
							echo number_format($WeeklyCurrency[0]->SellingRate, 2, '.', '');
						}
						}?>" class="form-control input-sm" style="width:50%">
						 
                        </div>
						<div class="col-lg-2">
						
						<input type="submit" id="saveSellingRate" name="" class="btn btn-success btn-sm" value="Save Settings">
						 
                        </div>
						<p id="loading2"></p>
						</form>
						</div>
     <div class="table-responsive table-bordered" style="margin-top:30px" >
				<div class="dataTable_wrapper" style="width:970px;height:400px" id="pendingInvoices">	

                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Currency</th>
                                            <th>Currency Name</th>
                                            <th>Units</th>
											<th>Buying Rate</th>
											<th>Selling Rate</th>
											<th>Start Date</th>
											<th>End Date</th>
											<th>Week</th>
                                        </tr>
                                    </thead>
<tbody>
	<?php 
		$SellingRate = 0.0;
		$BuyingRate = 0.0;
		$StartDate = "";
		$LastDate = "";
		$Week = "";
	if(isset($get_CurrencyData)){
		foreach($get_CurrencyData as $key1);
	if($this->Settings_model->WeeklyCurrency($key1->Currency)!=NULL)
		{
			$SellingRate = $this->Settings_model->WeeklyCurrency($key1->Currency)[0]->SellingRate;
			$BuyingRate = $this->Settings_model->WeeklyCurrency($key1->Currency)[0]->BuyingRate;
			$StartDate = $this->Settings_model->WeeklyCurrency($key1->Currency)[0]->StartDate;
			$LastDate = $this->Settings_model->WeeklyCurrency($key1->Currency)[0]->LastDate;
			$Week = $this->Settings_model->WeeklyCurrency($key1->Currency)[0]->Week;
		}		
		?>
	<tr style="background-color:#FFCC00">
		<td><input type="checkbox" name="invoice" onchange="loadData('<?php echo $key1->Currency?>')" value="<?php echo $key1->Currency?>" ></td>
		<td><?php echo $key1->Currency?></td>
		<td><?php echo $key1->CurrencyDesc?></td>
		<td><?php echo $key1->Units?></td>
		<td><?php echo number_format($SellingRate, 2, '.', '');?></td>
		<td><?php echo number_format($BuyingRate, 2, '.', '');?></td>
		<td><?php echo substr($StartDate,0,10)?></td>
		<td><?php echo substr($LastDate,0,10)?></td>
		<td><?php echo $Week?></td>
		</tr>	
		<?php
	}
	if(isset($get_Currency)){

	foreach($get_Currency as $key1):
		if($this->Settings_model->WeeklyCurrency($key1->Currency)!=NULL)
		{
			$SellingRate = $this->Settings_model->WeeklyCurrency($key1->Currency)[0]->SellingRate;
			$BuyingRate = $this->Settings_model->WeeklyCurrency($key1->Currency)[0]->BuyingRate;
			$StartDate = $this->Settings_model->WeeklyCurrency($key1->Currency)[0]->StartDate;
			$LastDate = $this->Settings_model->WeeklyCurrency($key1->Currency)[0]->LastDate;
			$Week = $this->Settings_model->WeeklyCurrency($key1->Currency)[0]->Week;
		}
	?>
		<tr>
		<td><input type="checkbox" name="invoice" onchange="loadData('<?php echo $key1->Currency?>')" value="<?php echo $key1->Currency?>" ></td>
		<td><?php echo $key1->Currency?></td>
		<td><?php echo $key1->CurrencyDesc?></td>
		<td><?php echo $key1->Units?></td>
		<td><?php echo number_format($SellingRate, 2, '.', '');?></td>
		<td><?php echo number_format($BuyingRate, 2, '.', '');?></td>
		<td><?php echo substr($StartDate,0,10)?></td>
		<td><?php echo substr($LastDate,0,10)?></td>
		<td><?php echo $Week?></td>
		</tr>
<?php 
		$SellingRate = 0.0;
		$BuyingRate = 0.0;
		$StartDate = "";
		$LastDate = "";
		$Week = "";	
endforeach;
	}
				
	?>
                                    </tbody>
                                </table>
								
                            </div>
							</div>
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
		 
		 window.location="<?php echo base_url()?>Settings/Currency/"+val;
	 }

 }
 
  

	
</script>

</body>

</html>
