<?php
tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "PDF Report";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
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

$content = '<style>
    table {
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        font-size: 14px;
        line-height: 1.42857143;
        color: #333;
        float:left;
        background:#eff0f1;
        margin-left:30px;
        margin-bottom: 10px;
        border-collapse: collapse;
    }
    table, th, td {
        /*border: 1px solid black;*/
        border-bottom: 1px solid #ddd;
    }
    th, td {
        padding: 3px;
        text-align: left;

    }
    tr:hover {background-color: #f5f5f5}</style>

<table>
    <tr>
        <td valign="top" style="width:18%;    padding:5px;">
            <table align="center" width="100%" border="0" style="    border: 2px solid #000; padding:5px;" >
                <tr>
                    <td style="font-family: sans-serif; line-height: 23px; color:#000; font-size: 11px;padding-right:10px; font-weight: bold;  padding-left: 10px;padding-left:0px;padding-top:5px;padding-bottom:5px;">Qcr 
                    </td>
                    <td style="font-family: sans-serif; line-height: 23px; color:#000; font-size: 11px;padding-right:10px; font-weight: bold; padding-left: 10px;padding-left: 0px;padding-top:5px;padding-bottom:5px;">Rs. 
                    </td>
                    <td style="font-family: sans-serif; line-height: 23px; color:#000; font-size: 11px;padding-right:10px; font-weight: bold; padding-left: 10px; padding-left: 0px;padding-top:5px;padding-bottom:5px;">% 
                    </td>
                </tr>
                <tr>
                    <td style="font-family: sans-serif; line-height: 23px; color:#000; font-size: 11px;padding-right:10px;padding-left: 10px;padding-left:0px;border-top:2px solid #000;padding-top:5px;padding-bottom:5px;">Allnet 
                    </td>
                    <td  style="font-family: sans-serif; line-height: 23px; color:#000; font-size: 11px;padding-right:10px;padding-left: 10px;padding-left: 0px;border-top:2px solid #000;padding-top:5px;padding-bottom:5px;">985337 
                    </td>
                    <td  style="font-family: sans-serif; line-height: 23px; color:#000; font-size: 11px;padding-right:10px; font-weight: bold; padding-left: 10px; padding-left: 0px;border-top:2px solid #000;padding-top:5px;padding-bottom:5px;">38.5 
                    </td>
                </tr>
                <tr>
                    <td colspan="" class="program" style="font-family: sans-serif; line-height: 23px; color:#000; padding-top:5px;padding-bottom:5px; font-size: 11px;padding-right:10px; padding-left: 10px;padding-left:0px;border-top:1px solid #ccc;">Allnet 
                    </td>
                    <td colspan="" class="program" style="font-family: sans-serif; line-height: 23px; color:#000; padding-top:5px;padding-bottom:5px;font-size:11px;padding-right:10px;padding-left:10px;padding-left:0px;border-top:1px solid #ccc;">985337 
                    </td>
                    <td colspan="" class="program" style="font-family: sans-serif; line-height: 23px; color:#000; padding-top:5px;padding-bottom:5px; font-size: 11px;padding-right:10px;padding-left: 10px; padding-left: 0px;border-top:1px solid #ccc;">38.5
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table>
    <tr>
        <th>Raw Malt</th>
        <th>Qty</th>
        <th>Value</th>
        <th>% Usg Val</th>
    </tr>
    <tr>
        <td>BUNS REGULAR - 15 X 2 X 2   </td>
        <td>-0.81</td>
        <td>346</td>
        <td>0.00</td>
    </tr>
</table>';
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');
?>