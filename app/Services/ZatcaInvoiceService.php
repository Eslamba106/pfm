<?php
namespace App\Services\Zatca;

use App\Services\Zatca\Invoice\AdditionalDocumentReference;
use App\Services\Zatca\Invoice\AllowanceCharge;
use App\Services\Zatca\Invoice\BillingReference;
use App\Services\Zatca\Invoice\Client;
use App\Services\Zatca\Invoice\Delivery;
use App\Services\Zatca\Invoice\InvoiceGenerator;
use App\Services\Zatca\Invoice\InvoiceLine;
use App\Services\Zatca\Invoice\LegalMonetaryTotal;
use App\Services\Zatca\Invoice\LineTaxCategory;
use App\Services\Zatca\Invoice\PaymentType;
use App\Services\Zatca\Invoice\PIH;
use App\Services\Zatca\Invoice\ReturnReason;
use App\Services\Zatca\Invoice\Supplier;
use App\Services\Zatca\Invoice\TaxesTotal;
use App\Services\Zatca\Invoice\TaxSubtotal;
use Carbon\Carbon;
// include "./vendor/autoload.php";
// use Allam\Zatca\Invoice\Client;
// use Allam\Zatca\Invoice\Supplier;
// use Allam\Zatca\Invoice\Delivery;
// use Allam\Zatca\Invoice\PaymentType;
// use Allam\Zatca\Invoice\PIH;
// use Allam\Zatca\Invoice\ReturnReason;
// use Allam\Zatca\Invoice\BillingReference;
// use Allam\Zatca\Invoice\AdditionalDocumentReference;
// use Allam\Zatca\Invoice\LegalMonetaryTotal;
// use Allam\Zatca\Invoice\TaxesTotal;
// use Allam\Zatca\Invoice\TaxSubtotal;
// use Allam\Zatca\Invoice\LineTaxCategory;
// use Allam\Zatca\Invoice\InvoiceLine;
// use Allam\Zatca\Invoice\AllowanceCharge;
// use Allam\Zatca\Invoice\InvoiceGenerator;

$client = (new Client())
    ->setVatNumber('300000000000003')
    ->setStreetName('STREET')
    ->setBuildingNumber('1111')
    ->setPlotIdentification('2223')
    ->setSubDivisionName('JEDDAH')
    ->setCityName('JEDDAH')
    ->setPostalNumber('12222')
    ->setCountryName('SA')
    ->setClientName('TSTCO');

$supplier = (new Supplier())
    ->setCrn('1000000000')
    ->setStreetName('RIYADH')
    ->setBuildingNumber('2322')
    ->setPlotIdentification('2223')
    ->setSubDivisionName('RIYADH')
    ->setCityName('RIYADH')
    ->setPostalNumber('11633')
    ->setCountryName('SA')
    ->setVatNumber('300000000000003')
    ->setVatName('TSTCO');

$delivery = (new Delivery())
    ->setDeliveryDateTime('2022-09-07');

$paymentType = (new PaymentType())
    ->setPaymentType('10');

$returnReason = (new ReturnReason())
    ->setReturnReason('SET_RETURN_REASON');

$previous_hash = (new PIH())
    ->setPIH('X+zrZv/IbzjZUnhsbWlsecLbwjndTpG0ZynXOif7V+k=');

$billingReference = (new BillingReference())
    ->setBillingReference('23'); // note this used when type credit or debit this value of parent invoice id

$additionalDocumentReference = (new AdditionalDocumentReference())
    ->setInvoiceID('55');

$legalMonetaryTotal = (new LegalMonetaryTotal())
    ->setTotalCurrency('SAR')
    ->setLineExtensionAmount(4)
    ->setTaxExclusiveAmount(4)
    ->setTaxInclusiveAmount(4.60)
    ->setAllowanceTotalAmount(0)
    ->setPrepaidAmount(0)
    ->setPayableAmount(4.60);

$taxesTotal = (new TaxesTotal())
    ->setTaxCurrencyCode('SAR')
    ->setTaxTotal(0.60);

$taxSubtotal = (new TaxSubtotal())
    ->setTaxCurrencyCode('SAR')
    ->setTaxableAmount(4.00)
    ->setTaxAmount(0.60)
    ->setTaxCategory('S')
    ->setTaxPercentage(15)
    ->getElement();

$itemTaxCategory = (new LineTaxCategory())
    ->setTaxCategory('S')
    ->setTaxPercentage(15)
    ->getElement();

$invoiceLines[] = (new InvoiceLine())
    ->setLineID('1')
    ->setLineName('TST Item')
    ->setLineCurrency('SAR')
    ->setLinePrice(2)
    ->setLineQuantity(2)
    ->setLineSubTotal(4)
    ->setLineTaxTotal(0.60)
    ->setLineNetTotal(4.60)
    ->setLineTaxCategories($itemTaxCategory)
    ->setLineDiscountReason('reason')
    ->setLineDiscountAmount(0)
    ->getElement();

$allowanceCharge = (new AllowanceCharge())
    ->setAllowanceChargeCurrency('SAR')
    ->setAllowanceChargeIndex('1')
    ->setAllowanceChargeAmount(0)
    ->setAllowanceChargeTaxCategory('S')
    ->setAllowanceChargeTaxPercentage(15)
    ->getElement();

$response = (new InvoiceGenerator())
    ->setZatcaEnv('developer-portal')
    ->setZatcaLang('en')
    ->setInvoiceNumber('SME00023')
    ->setInvoiceUuid('8d487816-70b8-4ade-a618-9d620b73814a')
    ->setInvoiceIssueDate('2022-09-07')
    ->setInvoiceIssueTime('12:21:28')
    ->setInvoiceType('0200000', '388')
    ->setInvoiceCurrencyCode('SAR')
    ->setInvoiceTaxCurrencyCode('SAR')
//->setInvoiceBillingReference($billingReference)  use this when document type is credit or debit
    ->setInvoiceAdditionalDocumentReference($additionalDocumentReference)
    ->setInvoicePIH($previous_hash)
    ->setInvoiceSupplier($supplier)
    ->setInvoiceClient($client)
    ->setInvoiceDelivery($delivery)
    ->setInvoicePaymentType($paymentType)
//->setInvoiceReturnReason($returnReason) use this when document type is credit or debit
    ->setInvoiceLegalMonetaryTotal($legalMonetaryTotal)
    ->setInvoiceTaxesTotal($taxesTotal)
    ->setInvoiceTaxSubTotal($taxSubtotal)
    ->setInvoiceAllowanceCharges($allowanceCharge)
    ->setInvoiceLines(...$invoiceLines)
    ->setCertificateEncoded("TUlJQjVUQ0NBWXFnQXdJQkFnSUdBWStPTTBOR01Bb0dDQ3FHU000OUJBTUNNQlV4RXpBUkJnTlZCQU1NQ21WSmJuWnZhV05wYm1jd0hoY05NalF3TlRFNU1EQXhORE13V2hjTk1qa3dOVEU0TWpFd01EQXdXakJETVE0d0RBWURWUVFEREFWVVUxUkRUekVSTUE4R0ExVUVDd3dJVkZOVVEwOHRVMEV4RVRBUEJnTlZCQW9NQ0ZSVFZFTlBMVk5CTVFzd0NRWURWUVFHRXdKVFFUQldNQkFHQnlxR1NNNDlBZ0VHQlN1QkJBQUtBMElBQkFsbnRVditjUkFJU0JSekFKTWFSUHdrRE5JblZKdGNXV3l1UWdYN0k2U0s0QytTSU1JQ0psYzN2YXhkYUpQc2pRUlJ4VHE3eDZCbnZHS09JUTVMdDNLamdab3dnWmN3REFZRFZSMFRBUUgvQkFJd0FEQ0JoZ1lEVlIwUkJIOHdmYVI3TUhreEhUQWJCZ05WQkFRTUZERXRVMFJUUVh3eUxVWkhSRk44TXkxVFJFWkhNUjh3SFFZS0NaSW1pWlB5TEdRQkFRd1BNekF3TURBd01EQXdNREF3TURBek1RMHdDd1lEVlFRTURBUXhNVEF3TVE0d0RBWURWUVFhREFWVFFWVkVTVEVZTUJZR0ExVUVEd3dQVkhKaGJuTndiM0owWVhScGIyNXpNQW9HQ0NxR1NNNDlCQU1DQTBrQU1FWUNJUUNIUDZEMDVNRm9rU1lickdNV2RPVzhqL1htU0lwdURwUDRId25IckRxOFFBSWhBTEZ2THg4NGRvUWpaa0U0M1JKZzFXYWdVcm9XQkNpN0kzWk9RdVlCNk9Ibg==")
    ->setPrivateKeyEncoded("LS0tLS1CRUdJTiBQUklWQVRFIEtFWS0tLS0tCk1JR0VBZ0VBTUJBR0J5cUdTTTQ5QWdFR0JTdUJCQUFLQkcwd2F3SUJBUVFnb0pYTGxHRDE4MXZaaFgrUzRDMTQKODRURGVJUWV6dmtKR2l5TkdNZktjck9oUkFOQ0FBUUpaN1ZML25FUUNFZ1Vjd0NUR2tUOEpBelNKMVNiWEZscwpya0lGK3lPa2l1QXZraURDQWlaWE43MnNYV2lUN0kwRVVjVTZ1OGVnWjd4aWppRU9TN2R5Ci0tLS0tRU5EIFBSSVZBVEUgS0VZLS0tLS0K")
    ->setCertificateSecret("srtiZ72Dx+YySBGO22hmr5UEaul5HKl8snfTfUnc/vY=")
    ->sendDocument();
var_dump($response);
