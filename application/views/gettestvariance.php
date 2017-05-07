<?php
tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "PDF Report Of Variance";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title ='', PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 9);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();
ob_start();
// we can have any view part here like HTML, PHP etc
$content = ob_get_contents();

$content = '<html style="background: #fff;">
    <head>

    </head>
    <body>
        <style>
			.Top_sec{font-family: sans-serif; color:#000; padding-bottom: 5px; font-size: 8px;padding-right:10px; font-weight: bold;  padding-left: 10px; text-align: center;padding-left: 0px; width:100%; margin:0px auto;display:block;}
		
			.Top_sec1{
			font-family: sans-serif; color:#000; padding-top: 5px;padding-bottom: 0px; font-size: 6px;padding-right:10px; padding-left: 10px; text-align: center;padding-left: 0px; width:100%; margin:0px auto;display:inline-block;}
			
			.Top_sec2{
			font-family: sans-serif; color:#000; font-size: 8px;padding-right:10px; padding-left: 10px; text-align: center;padding-left: 0px; border-bottom:1px solid #000; margin-bottom:30px; display:block;}
			
			.Top_sec3{
			font-family: sans-serif; color:#000; font-size: 6px;padding-right:10px; font-weight: bold;  padding-left:0px;padding-top:2px;padding-bottom:5px;}
			
			.Top_sec4{
			font-family: sans-serif;  color:#000; padding-top:5px;padding-bottom:5px; font-size: 4px;padding-right:10px; padding-left: 2px;}
			
			.Top_sec5{
			font-family: sans-serif; color:#000; padding-top:5px;padding-bottom:5px;font-size: 4px;padding-right:10px; font-weight: bold;  padding-left: 2px;}
			
			.Top_sec6{
			font-family: sans-serif; color:#000; padding-top:5px;padding-bottom:5px;font-size: 4px;padding-right:10px; font-weight: bold;  padding-left: 2px;border-top:0.1px solid #000;}
			
			.Top_sec7{
			font-family: sans-serif; color:#000;padding-top:5px;padding-bottom:5px; font-size: 4px;padding-right:10px; padding-left: 2px;border-top:0.1px solid #000;}
			
			
			
			.Top_sec_raw{width:45%;font-family: sans-serif; color:#000; padding-top:5px;padding-bottom:5px;font-size: 4px; font-weight: bold;  padding-left: 2px;border-top:1px solid #000;}
			
			.Top_sec_qty{width:20%;font-family: sans-serif; color:#000; padding-top:5px;padding-bottom:5px;font-size: 4px; font-weight: bold;  padding-left: 2px;border-top:0.1px solid #000;}
			
			.Top_sec_value{width:10%;font-family: sans-serif; color:#000; padding-top:5px;padding-bottom:5px;font-size: 4px; font-weight: bold;  padding-left: 2px;border-top:0.1px solid #000;}
			
			.Top_sec_usg{width:25%;font-family: sans-serif; color:#000; padding-top:5px;padding-bottom:5px;font-size: 4px; font-weight: bold;  padding-left: 2px;border-top:0.1px solid #000;}

        </style>    


        <table  width="100%" border="0"   style="">
            <tr>
                <td colspan="4">
                    <table width="100%" style="">
                        <tr>
                            <td class="Top_sec">HARDCASTLE RESTAURANTS PVT LTD.</td>
                        </tr>
                        <tr>
                            <td class="Top_sec1"><U>STOP(Stats+Ops)Report For Store : BENGALURU- CHANNAPATNA From Date :01/February/2016 To Date</u>
                            </td>
                        </tr>
                        <tr>
                            <td class="Top_sec2" >:29/February/2016
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
			<tr>
				<td valign="top" style="width:18%; padding:5px;">
					<table width="100%" style="border: 0.1px solid #000; padding:2px; margin-top:50px; display:block;" >
						<tr>

							<td class="Top_sec3">Qcr 
							</td>
							<td class="Top_sec3">Rs. 
							</td>
							<td class="Top_sec3">% 
							</td>

						</tr>
						<tr>
							<td class="Top_sec3" >Allnet 
							</td>
							<td class="Top_sec3">985337 
							</td>
							<td class="Top_sec3">38.5 
							</td>
						</tr>
						<tr>
							<td class="Top_sec4">Allnet 
							</td>
							<td class="Top_sec4">985337 
							</td>
							<td class="Top_sec4">38.5
							</td>
						</tr>

					</table>
				</td>
				
				<td valign="top" style="width:32%;padding:5px;  margin-top:0px;">
					<table width="100%" style="border: 0.1px solid #000;padding:2px;">
						<tr>
							<td colspan="4" class="Top_sec5">Top 10 Food Variance Loss</td>
						</tr>
						<tr>
							<td class="Top_sec_raw">Raw Matl </td>
							<td class="Top_sec_qty">Qty </td>
							<td class="Top_sec_value">Value </td>
							<td class="Top_sec_usg">% Usg Val </td>
						</tr>';
						foreach($fvg as $fvgg){
							$content .= '<tr>
								<td class="Top_sec4">'.$fvgg["raw_name"].'</td>
								<td class="Top_sec4">'.$fvgg["quantity"].'</td>
								<td class="Top_sec4">'.$fvgg["value"].'</td>
								<td class="Top_sec4">'.$fvgg["per_usg_val"].'</td>
							</tr>';
						}
						$content .='<tr>
							<td class="Top_sec7"></td>
							<td class="Top_sec7">-0.81</td>
							<td class="Top_sec7">346</td>
							<td class="Top_sec7">0.00</td>
						</tr>
					</table>
					<table width="100%" style="border: 0.1px solid #000;padding:2px;">
						<tr>
							<td class="Top_sec5">Top 5 Food Variance Gain</td>
						</tr>
						<tr>
							<td class="Top_sec_raw">Raw Matl</td>
							<td class="Top_sec_qty">Qty </td>
							<td class="Top_sec_value">Value </td>
							<td class="Top_sec_usg">% Usg Val </td>
						</tr>';

						foreach($fvl as $fvll){
							$content .='<tr>
								<td class="Top_sec4">'.$fvll["raw_name"].'</td>
								<td class="Top_sec4">'.$fvll["quantity"].'</td>
								<td class="Top_sec4">'.$fvll["value"].'</td>
								<td class="Top_sec4">'.$fvll["per_usg_val"].'</td>
							</tr>';
						}
						
						$content .= '<tr>
							<td class="Top_sec7"></td>
							<td class="Top_sec7">-0.81</td>
							<td class="Top_sec7">346 </td>
							<td class="Top_sec7">0.00 </td>
						</tr>
					</table>
				</td>
				
				<td valign="top" colspan=""  style="width:50%;padding:5px;">
					<table width="100%" style="margin-left: 20px; padding:2px;">
						<tr>
							<td>
								<table width="100%" style="border:0.1px solid #000; margin-bottom: 10px;padding: 2px; margin-right:5px;">
									<tr>
										<td colspan="4" class="Top_sec5" >Top 5 Food Variance Loss </td>
									</tr>
									<tr>
										<td class="Top_sec_raw">Raw Matl </td>
										<td class="Top_sec_qty">Qty </td>
										<td class="Top_sec_value">Value </td>
										<td class="Top_sec_usg">% Usg Val </td>
									</tr>';
									foreach($fyg as $fygg){
										$content .='<tr>
											<td class="Top_sec4">'.$fygg["raw_name"].'</td>
											<td class="Top_sec4">'.$fygg["quantity"].'</td>
											<td class="Top_sec4">'.$fygg["value"].'</td>
											<td class="Top_sec4">'.$fygg["per_usg_val"].'</td>
										</tr>';
									}
									
									$content .='<tr>
										<td class="Top_sec7"></td>
										<td class="Top_sec7">-0.81 </td>
										<td class="Top_sec7">346 </td>
										<td class="Top_sec7">0.00 </td>
									</tr>
								</table>
							</td>
							<td>
							
								<table width="100%" style="padding: 2px; border: 0.1px solid #000; margin-bottom: 10px;margin-left:2px;">
									<tr>
										<td colspan="4" class="Top_sec7">Top 5 Food Variance Gain </td>
									</tr>
									<tr>
										<td class="Top_sec_raw">Raw Matl </td>
										<td class="Top_sec_qty">Qty </td>
										<td class="Top_sec_value">Value </td>
										<td class="Top_sec_usg">% Usg Val </td>
									</tr>';
									
									foreach($fyl as $fyll){
										$content .='<tr>
											<td class="Top_sec4">'.$fyll["raw_name"].'</td>
											<td class="Top_sec4">'.$fyll["quantity"].'</td>
											<td class="Top_sec4">'.$fyll["value"].'</td>
											<td class="Top_sec4">'.$fyll["per_usg_val"].'</td>
										</tr>';
									}
									
									$content .= '<tr>
										<td class="Top_sec7"></td>
										<td class="Top_sec7">-0.81 </td>
										<td class="Top_sec7">346 </td>
										<td class="Top_sec7">0.00 </td>
									</tr>
								</table>
							</td>
						</tr>
					</table>

					<table width="100%" style="margin-left: 20px;">
						<tr>
							<td>
								<table width="100%" style="border: 0.1px solid #000; margin-bottom: 10px;padding: 2px; margin-right:5px;">
									<tr>
										<td colspan="4" class="Top_sec7">Top 10 Food Variance Loss</td>
									</tr>
									<tr>
										<td class="Top_sec_raw">Raw Matl </td>
										<td class="Top_sec_qty">Qty </td>
										<td class="Top_sec_value">Value </td>
										<td class="Top_sec_usg">% Usg Val </td>
									</tr>';
			
									foreach($pvl as $pvll){
										$content .='<tr>
											<td class="Top_sec4">'.$pvll["raw_name"].'</td>
											<td class="Top_sec4">'.$pvll["quantity"].'</td>
											<td class="Top_sec4">'.$pvll["value"].'</td>
											<td class="Top_sec4">'.$pvll["per_usg_val"].'</td>
										</tr>';
									}	

									$content .='<tr>
										<td class="Top_sec7"></td>
										<td class="Top_sec7">-0.81</td>
										<td class="Top_sec7">346 </td>
										<td class="Top_sec7">0.00</td>
									</tr>
								</table>
							</td>
							<td>

								<table width="100%" style="padding: 2px; border: 0.1px solid #000; margin-bottom: 10px;margin-left:5px;">
									<tr>
										<td colspan="4" class="Top_sec7">Top 10 Food Variance Loss </td>
									</tr>
									<tr>
										<td class="Top_sec_raw">Raw Matl </td>
										<td class="Top_sec_qty">Qty </td>
										<td class="Top_sec_value">Value </td>
										<td class="Top_sec_usg">% Usg Val </td>
									</tr>';

									foreach($pvg as $pvgg){
										$content .='<tr>
											<td class="Top_sec4">'.$pvgg["raw_name"].'</td>
											<td class="Top_sec4">'.$pvgg["quantity"].'</td>
											<td class="Top_sec4">'.$pvgg["value"].'</td>
											<td class="Top_sec4">'.$pvgg["per_usg_val"].'</td>
										</tr>';
									}
							
									$content .='<tr>
										<td class="Top_sec7"></td>
										<td class="Top_sec7">-0.81 </td>
										<td class="Top_sec7">346 </td>
										<td class="Top_sec7">0.00 </td>
									</tr>
								</table>
							</td>
						</tr>
					</table>

					<table width="100%" style="padding:2px; margin-left: 20px;margin-bottom:10px;">

						<tr>
							<td>
								<table width="100%" style="padding: 2px;border:0.1px solid #000">
									<tr>
										<td colspan="4" class="Top_sec7">Top 10 Food Variance Loss </td>
									</tr>
									<tr>
										<td class="Top_sec_raw">Raw Matl </td>
										<td class="Top_sec_qty">Qty </td>
										<td class="Top_sec_value">Value </td>
										<td class="Top_sec_usg">% Usg Val </td>
									</tr>';

									foreach($foc as $focc){
										$content .='<tr>
											<td class="Top_sec4">'.$focc["raw_name"].'</td>
											<td class="Top_sec4">'.$focc["quantity"].'</td>
											<td class="Top_sec4">'.$focc["value"].'</td>
											<td class="Top_sec4">'.$focc["per_usg_val"].'</td>
										</tr>';
									}
									
									$content .='<tr>
										<td class="Top_sec7"></td>
										<td class="Top_sec7">-0.81 </td>
										<td class="Top_sec7">346 </td>
										<td class="Top_sec7">0.00 </td>
									</tr>
								</table>
							</td>
						</tr>
					</table>

					<table width="100%" style="margin-left: 20px;margin-bottom:10px;">

						<tr>
							<td>
								<table width="100%" style="padding: 2px;border:0.1px solid #000">
									<tr>
										<td colspan="4" class="Top_sec7">Top 10 Food Variance Loss</td>
									</tr>
									<tr>
										<td class="Top_sec_raw">Raw Matl </td>
										<td class="Top_sec_qty">Qty </td>
										<td class="Top_sec_value">Value </td>
										<td class="Top_sec_usg">% Usg Val </td>
									</tr>';
									foreach($fpc as $fpcc){
										$content .='<tr>
											<td class="Top_sec4">'.$fpcc["raw_name"].'</td>
											<td class="Top_sec4">'.$fpcc["quantity"].'</td>
											<td class="Top_sec4">'.$fpcc["value"].'</td>
											<td class="Top_sec4">'.$fpcc["per_usg_val"].'</td>
										</tr>';
									}
									$content .='<tr>
										<td class="Top_sec7"></td>
										<td class="Top_sec7">-0.81 </td>
										<td class="Top_sec7">346 </td>
										<td class="Top_sec7">0.00 </td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>			
			</tr>
        </table>
    </body>
</html>';
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');
?>