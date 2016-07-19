<div class="form-group col-lg-4">
                                            <label>Quantity per Case</label>
                                         
<input class="form-control input-sm " type="text" value="" name="QuantityPerCase"  id=""  style="width:95%">
			</div>
						<div class="form-group col-lg-4">
                                            <label>Units of Quantity</label>
                                         
<select class="form-control select2" style="width:95%"  name="UnitsOfQuantity" id="">
		<option ></option>
		<?php foreach($UnitsofQtyName as $row):


		?>
		<option value="<?php echo $row->UnitsofQty;?>"><?php echo $row->UnitsofQtyName;?></option>

		<?php

		endforeach;
		?>
		</select>
			</div>
						<div class="form-group col-lg-4">
                                            <label>Department</label>
                                         
<select class="form-control select2" style="width:95%"  name="Department" id="">
		<option ></option>
		<?php foreach($DepartName as $row):


		?>
		<option value="<?php echo $row->Depart;?>"><?php echo $row->DepartName;?></option>

		<?php

		endforeach;
		?>
		</select>
			</div>
									<div class="form-group col-lg-4">
                                            <label>Source</label>
                                         
<select class="form-control select2" style="width:95%"  name="Source" id="">
		<option ></option>
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
		<option ></option>
		
		<option>Trade Item</option>
		<option>Non Trade Item</option>
		
		</select>
			</div>
			</div>
								 <div class="form-group col-lg-8" id="showReason" >
                                            <label>Notes/ Comments</label>
                                         
<textarea class="form-control"   name="Notes" rows="3"  style="width:95%"><?php if(isset($FindConfirmMessage)){echo $FindConfirmMessage;
}?></textarea>
	 								</div>