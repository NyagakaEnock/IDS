$pass = "administrator$";
				$user = 'sa';
				$db = 'IDSYSTEM';
				$connection = odbc_connect("Driver={SQL Server};Server=NYAGAKAENOCK\SQLSERVER;Database=$db;",$user , $pass ) or die (odbc_errormsg());	
		
INSERT INTO ParamCommodityBrands(
						ProductCode,
						ProductName,
						CommodityCode,
						NewCommodityCode,
						SITC,NewSITC,
						PackageType,
						UnitsPerPack,
						PackageSize,
						QttyUnits,
						QtyPerCase,
						UnitsofQty,
						Source,
						Depart,
						Category,
						Notes,
						CreatedBy,
						DateCreated,
						AccPeriod)"
                SQL2 = "VALUES('" & Trim(.txtProductCode.Text) & "','" & Trim(.txtProductName.Text) & "','" & Trim(.txtCommodityCode.Text) & "','" & Trim(.txtNewCommodityCode.Text) & "','" & Trim(.txtSITC.Text) & "','" & Trim(.txtNewSITC.Text) & "'"
                SQL3 = ",'" & Trim(.cboPackageType.Text) & "'," & CDbl(.txtUnitsPerPack.Text) & "," & CDbl(.txtUnitSize.Text) & ",'" & Trim(.cboQttyUnits.Text) & "'," & CDbl(.txtQtyPerCase.Text) & ",'" & Trim(.cboUnitsofQty.Text) & "'"
                SQL4 = ",'" & Trim(.cboSource.Text) & "','" & Trim(.cboDepart.Text) & "','" & Trim(.cboCategory.Text) & "','" & Trim(.txtNotes.Text) & "','" & Trim(CurrentUserName) & "','" & Trim(MyCurrentDate) & "','" & Trim(MyCurrentPeriod) & "')