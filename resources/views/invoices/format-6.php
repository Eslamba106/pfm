<?php 
ini_set('memory_limit', '2048M');
header("Access-Control-Allow-Origin: *");
header("content-type:application/json");
$root = (isset($option['generate_pdf'])) ? '../../' : '../../../';
require_once($root.'lib/settings.php');
include_once(root.'site/auth/validate.php');
include_once(root.'classes/mpdf/vendor/autoload.php');
include_once(root.'classes/class/PDFData.php');

$guid = (isset($option['generate_pdf'])) ? $option['pdf_order_id'] : $_REQUEST['id'];

$data = find_one($guid, 'erp_sales_sales');
$item = findOne("SELECT * FROM erp_sales_sales_items WHERE order_guid=$guid");

$dn_refs = $data['dn_ref'];
if($dn_refs){
	$dn = findOne("SELECT MIN(date) AS startdate, MAX(date) AS enddate FROM erp_deliverynote_master WHERE id IN ($dn_refs)");
}

if(!$data){
	$json['errormsg'] = 'Invalid Data.';
	echo json_encode($json);
    exit;
}

$customerData = PDFData::customer($data['customer_id']);
$customer_name = $customerData['customer_name'];
$customer_address = $customerData['customer_address'];
if($customerData['vat_no']){
	$customer_vat = '<br>VAT Account No: '.$customerData['vat_no'];
}

$currency = PDFData::currency(0);
$currency_code = $currency['code'];

$company = PDFData::company();

$header = $body = $footer = '';
$logourl = siteurl.'upload/logo/company/logo.png';
if(get_erp_branch() === '1023' || get_erp_branch() === '1024'){
	$logourl = siteurl.'assets/client/1023/logo-with-name.png';
}

// $header .= '<table width="100%" style="vertical-align:top; margin-bottom:15px;">
// 				<tr>
// 					<td width="65%">
// 						<div style="font-size:16px; margin:8px 0 4px 0;">
// 							<b>'.$company['name'].'</b>
// 						</div>
// 						<div style="">
// 							'.$company['address'].'
// 						</div>
// 					</td>
// 					<td width="35%" align="right">
// 						<img src="'.$logourl.'" style="width:auto; height:90px" />
// 					</td>
// 				</tr>
// 			</table>';

$header .= '<table width="100%" style="vertical-align:top; margin-bottom:15px;">
				<tr>
					<td width="10%" align="center">
						<img src="'.$logourl.'" style="width:auto; height:90px" />
					</td>
				</tr>
			</table>';

$header .= '<div style="text-align:center;vertical-align:middle; font-size:16px; padding:10px 0; border:1px solid #111; border-bottom:0;">
				<b>TAX INVOICE</b>
			</div>';

$header .= '<table width="100%" style="vertical-align:top; margin-bottom:15px; border:1px solid #111;">
				<tr>
					<td width="65%" style="padding:8px;">
						<div style="margin-top:10px;"><b>'.$customer_name.'</b></div>
						'.$customer_address.'
						'.$customer_vat.'
					</td>
					<td width="35%">
						<table class="doc-info">
							<tr><td>Invoice No.</td>
								<td>: '.$data['trn_no'].'</td>
							</tr>
							<tr><td>Invoice Date</td>
								<td>: '.formatDate($data['trn_date']).'</td>
							</tr>
							<tr><td>VAT Regn. No.</td>
								<td>: '.$company['vat_no'].'</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>';

$body .= '<style>
			.doc-info td { padding:3px; }
			.transactions thead th{ padding:6px 8px; border-right:1px solid #111; border-bottom:1px solid #111; }
			.transactions tbody td{ padding:6px 8px; border-right:1px solid #111; padding-bottom:150px; }
			.totals tbody td{ padding:6px 8px; border-right:1px solid #111; border-bottom:1px solid #111; }
		  </style>';
$body .= '<table class="transactions" width="100%" cellspacing="0" style="vertical-align:top; border:1px solid #111; border-right:0; margin-top:10px;">
			<thead>
				<tr>
					<th align="center">Sl. No.</th>
					<th align="center">Description</th>
					<th align="center">Net Amount Excl. VAT</th>
					<th align="center">VAT %</th>
					<th align="center">VAT Amount</th>
					<th align="center">Total Amount Incl. VAT</th>
				</tr>
		  	</thead>
			<tbody>';
	$body .= "<tr>";
	$body .= "<td>".($i+1)."</td>";
	$body .= "<td>Commission Receivable from $customer_name for the period ".formatDate($dn['startdate'])." to ".formatDate($dn['enddate'])."</td>";
	$body .= "<td align='right'>".toComma($item['g_grosstotal'])."</td>";
	$body .= "<td align='right'>".toComma($item['vat'])."</td>";
	$body .= "<td align='right'>".toComma($item['g_vat'])."</td>";
	$body .= "<td align='right'>".toComma($item['g_nettotal'])."</td>";
	$body .= "</tr>";

$body .= '</tbody></table>';

$in_words_grosstotal = PDFData::amount_in_words($item['g_grosstotal']);
$in_words_vat_amount = PDFData::amount_in_words($item['g_vat']);
$in_words_nettotal = PDFData::amount_in_words($item['g_nettotal']);

if((float)$item['g_vat']){
	$in_words .= '<p style="margin-top:5px;margin-bottom:0px;"><b>Total Excl. VAT : </b><br>'.$in_words_grosstotal.'</p>';
	$in_words .= '<p style="margin-top:5px;margin-bottom:0px;"><b>VAT Amount : </b><br>'.$in_words_vat_amount.'</p>';
}
$in_words .= '<p style="margin-top:5px;margin-bottom:0px;"><b>Total Incl. VAT : </b><br>'.$in_words_nettotal.'</p>';

$body .= '<table class="totals" width="100%" cellspacing="0" style="vertical-align:middle; border-top:1px solid #111; border-left:1px solid #111; margin-top:10px;">
			<tbody>
				<tr>
					<td rowspan="3" width="68%">
						'.$in_words.'
					</td>
					<td>Total Excl. VAT</td>
					<td align="right">'.toComma($item['g_grosstotal']).'</td>
				</tr>
				<tr>
					<td>VAT Amount</td>
					<td align="right">'.toComma($item['g_vat']).'</td>
				</tr>
				<tr>
					<td>Total Incl. VAT</td>
					<td align="right">'.toComma($item['g_nettotal']).'</td>
				</tr>
		  	</tbody>
		  </table>';

// $in_words = PDFData::amount_in_words($item['g_nettotal']);

// $body .= "<br><p>In Words : $in_words</p>";

$body .= '<p style="text-align:right;">For <b>'.$company['name'].'</b></p>';

$footer  = '<p style="text-align:center; color:#f25544; border-bottom:1px solid #111;">
				Licensed by the Central Bank of Bahrain as Insurance Broker (License No. '.$company['license_no'].')
			</p>

			<table style="vertical-align:top;">
				<tr>
					<td>
			<table style="vertical-align:top;">
				<tr><td align="right">
						<img src="'.siteurl.'assets/images/icons/phone-alt.png" style="width:15px;">
						<img src="'.siteurl.'assets/images/icons/whatsapp.png" style="width:15px;">
					</td>
					<td> '.$company['mobile'].'</td>
				</tr>
				<tr><td align="right">
						<img src="'.siteurl.'assets/images/icons/envelope.png" style="width:15px;">
					</td>
					<td> P.O. Box : '.$company['po_box'].', '.$company['city'].'</td>
				</tr>
				<tr><td align="right">
						<img src="'.siteurl.'assets/images/icons/at.png" style="width:15px;">
					</td>
					<td>'.$company['email'].'</td>
				</tr>
			</table>
					</td>
					<td style="width:35%;">
			<table style="vertical-align:top;">
				<tr><td align="right">
						<img src="'.siteurl.'assets/images/icons/map-marked-alt.png" style="width:15px;">
					</td>
					<td>
						'.nl2br($company['address']).'<br>
						'.$company['countryName'].'<br>
						'.($company['cr_no'] ? 'C.R. No. '.$company['cr_no'] : '').'
					</td>
				</tr>
			</table>
					</td>
				</tr>
			</table>';

$mpdf = new \Mpdf\Mpdf([
	'mode' => 'utf-8',
	'format' => 'A4',
	'setAutoTopMargin' => 'stretch',
	'setAutoBottomMargin' => 'stretch',
	'autoMarginPadding' => 0,
	'margin_top' => 0,
	'margin_bottom' => 0,
	'margin_left' => 8,
	'margin_right' => 8,
	'margin_header' => 8,
	'margin_footer' => 8
]);

$mpdf->packTableData = true;
$mpdf->keep_table_proportions = TRUE;
$mpdf->shrink_tables_to_fit=1;
$mpdf->SetDefaultFont('calibri');
$mpdf->SetDefaultFontSize('10');

$mpdf->SetHTMLHeader($header);
$mpdf->WriteHTML($body);
$mpdf->SetHTMLFooter($footer);

if ($_SERVER['HTTP_HOST'] != 'localhost' && $_SERVER['HTTP_HOST'] != 'localhost:8012'){
    $save_path= $_SERVER['DOCUMENT_ROOT'].'/upload/pdf/';
} else {
    $save_path= $_SERVER['DOCUMENT_ROOT'].'\\'.site_folder.'upload\\pdf\\';
}

if(!file_exists($save_path)) {
    mkdir($save_path, 0777, true);
}
$file_name = str_replace('/', '-', $data['trn_no']);

if(isset($_REQUEST['dinline'])){
	$mpdf->Output($file_name . '.pdf','I' ); exit;
}

$mpdf->Output($save_path.$file_name.'.pdf' );
$json['saveStatus'] = 1;
$json['path'] = $save_path;
$json['url'] = siteurl.'upload/pdf/'.$file_name.'.pdf';
$json['name'] = $file_name.'.pdf';
$json['entity_type'] = 'customer';
$json['entity_guid'] = $customer_id;
$json['attachment']= $save_path.$file_name.'.pdf';
echo json_encode($json);
exit;


?>