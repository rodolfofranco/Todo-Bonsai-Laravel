<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Rest\ApiContext;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;

/**
 * Controlador PayPal que se encarga de las funcionalidades del pago de los Productos
 */
class PaypalController extends Controller
{

  private $_api_context;

/**
 * Función que crea una nueva instancia del controlador
 */
  public function __construct()
  {
    // setup PayPal api context
    $paypal_conf = config('paypal');
    $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
    $this->_api_context->setConfig($paypal_conf['settings']);
  }

  /**
   * Función que permite desplegar la vista del form
   */
  // show paypal form view
  public function showForm(Request $request)
  {
    return view('payments.paypal');
  }
  
/**
 * Función que se encarga del procedimiento para pago con PayPal
 */
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'amount' => 'required|numeric'
    ]);
  
    if ($validator->fails()) {
      return redirect('payment/add-funds/paypal')
        ->withErrors($validator)
        ->withInput();
    }
    
    $payer = new Payer();
    $payer->setPaymentMethod('paypal');
  
    $item = new Item();
    $item->setName('Amount to Add')// item name
      ->setCurrency('USD')
      ->setQuantity(1)
      ->setPrice($request->input('amount')); // unit price
    
    // add item to list
    $item_list = new ItemList();
    $item_list->setItems([$item]);
    
    $amount = new Amount();
    $amount->setCurrency('USD')
      ->setTotal($request->input('amount'));
    
    $transaction = new Transaction();
    $transaction->setAmount($amount)
      ->setItemList($item_list)
      ->setDescription('Amount to Add');
    
    $redirect_urls = new RedirectUrls();
    // Specify return & cancel URL
    $redirect_urls->setReturnUrl(url('/payment/add-funds/paypal/status'))
      ->setCancelUrl(url('/payment/add-funds/paypal/status'));
  
    $payment = new Payment();
    $payment->setIntent('Sale')
      ->setPayer($payer)
      ->setRedirectUrls($redirect_urls)
      ->setTransactions(array($transaction));
  
    try {
      $payment->create($this->_api_context);
    } catch (\PayPal\Exception\PayPalConnectionException $ex) {
      Session::flash('alert', 'Something Went wrong, funds could not be loaded');
      Session::flash('alertClass', 'danger no-auto-close');
      return redirect('/payment/add-funds/paypal');
    }
  
    foreach ($payment->getLinks() as $link) {
      if ($link->getRel() == 'approval_url') {
        $redirect_url = $link->getHref();
        break;
      }
    }
  
    // add payment ID to session
    Session::put('paypal_payment_id', $payment->getId());
  
    if (isset($redirect_url)) {
      // redirect to paypal
      return redirect($redirect_url);
    }
  
  
    Session::flash('alert', 'Unknown error occurred');
    Session::flash('alertClass', 'danger no-auto-close');
    return redirect('/payment/add-funds/paypal');
  }

/**
 * Función que se encarga de comprobar el pago realizado luego de haber hecho la compra
 */
  public function getPaymentStatus(Request $request)
  {
    // Get the payment ID before session clear
    $payment_id = Session::get('paypal_payment_id');

    // clear the session payment ID
    Session::forget('paypal_payment_id');
    
    if (empty($request->input('PayerID')) || empty($request->input('token'))) {
      Session::flash('alert', 'Payment failed');
      Session::flash('alertClass', 'danger no-auto-close');
      return redirect('/payment/add-funds/paypal');
    }
    
    $payment = Payment::get($payment_id, $this->_api_context);
    
    // PaymentExecution object includes information necessary
    // to execute a PayPal account payment.
    // The payer_id is added to the request query parameters
    // when the user is redirected from paypal back to your site
    $execution = new PaymentExecution();
    $execution->setPayerId($request->input('PayerID'));
    
    //Execute the payment
    $result = $payment->execute($execution, $this->_api_context);
    
    if ($result->getState() == 'approved') { // payment made
      // Payment is successful do your business logic here
      //dd($result); 
      
      Session::flash('alert', 'Funds Loaded Successfully!');
      Session::flash('alertClass', 'success');
      return redirect('/payment/add-funds/paypal');
    }
    
    Session::flash('alert', 'Unexpected error occurred & payment has been failed.');
    Session::flash('alertClass', 'danger no-auto-close');
    return redirect('/payment/add-funds/paypal');
  }
  
}