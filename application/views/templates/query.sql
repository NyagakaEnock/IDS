INSERT INTO ProformaInvoiceRequest(IndentNo,
									IndentType,
									DutyFree,
									BranchCode,
									DestCountry,
									ImporterCode,
									ExporterCode,
									Country,
									Subject,
									AttentionTo,
									CarbonCopy,
									LeadMessage,
									ClosingMessage,
									OtherInformation,
									PreparedBy,
									IndentDate,
									DateExpected,
									DeliveryType,
									FaxNo,
									StaffIDNo,
									OwnerNo,
									OrderNo,
									CreatedBy,
									DateCreated,
									AccPeriod)
VALUES('" & Trim(.txtIndentNumber.Text) & "','" & Trim(.cboTypeOfIndent.Text) & "','" & .chkDutyFree.Value & "','" & .cboDestStore & "','" & .cboDestCountry & "','" & GetImporterCode & "','" & Trim(.cboExporterCode.Text) & "','" & Trim(.cboCountryCode.Text) & "','" & Trim(.txtSubject.Text) & "','" & .cboAttentionTO.Text & "'"
",'" & .cboCarbonCopy.Text & "','" & .txtLeadMessage.Text & "','" & .txtEndMessage.Text & "','" & .txtOtherInformation.Text & "','" & GetCurrentStaffID & "','" & MyCurrentDate & "','" & Format(.txtDateExpected.Text, "MMMM dd,yyyy") & "','" & GetDefaultMailDelivery & "','" & Trim(.txtFaxNumber.Text) & "','" & Trim(.cboOurContact.Text) & "'"
",'" & Trim(.cboOwnerNo.Text) & "','" & Trim(.txtOrderNo.Text) & "','" & CurrentUserName & "','" & MyCurrentDate & "','" & MyCurrentPeriod & "');"
         