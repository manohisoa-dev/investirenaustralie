<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use URL;
use Session;
use Redirect;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Illuminate\Support\Facades\Input;

class Paypal extends Controller {
    private $_api_context;

    public function __construct() {
        parent::__construct();

        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'],
            $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function payWithPaypal() {
        return view('paypal/paypalwithpayments');
    }

    public function postPaymentWithpaypal(Request $request) {
        $this->validate($request, ['name' => 'required', 'item_qty' =>
            'required|numeric', 'amount' => 'required|numeric']);
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $live_item_1 = new Item();
        $live_item_1->setName($request->get('name'))->setCurrency('USD')->setQuantity($request->get
            ('item_qty'))->setPrice($request->get('amount'));
        $item_list = new ItemList();
        $item_list->setItems(array($live_item_1));
        $total_amount = new Amount();
        $total_amount->setCurrency('USD')->setTotal(($request->get('amount') * $request->get
            ('item_qty')));
        $pay_transaction = new Transaction();
        $pay_transaction->setAmount($total_amount)->setItemList($item_list)->setDescription('Live Your simple transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status'))->setCancelUrl(URL::route
            ('payment.status'));
        $pay_paypal = new Payment();
        $pay_paypal->setIntent('Sale')->setPayer($payer)->setRedirectUrls($redirect_urls)->setTransactions(array
            ($pay_transaction));
        try {
            $pay_paypal->create($this->_api_context);
        }
        catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
                return Redirect::route('paypal.paypalwithpayments');
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::route('paypal.paypalwithpayments');

            }
        }
        foreach ($pay_paypal->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        Session::put('paypal_payment_id', $pay_paypal->getId());
        if (isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }
        \Session::put('error', 'Unknown error occurred');
        return Redirect::route('paypal.paypalwithpayments');
    }

    public function getPaymentStatus() {
        $payment_id = Session::get('paypal_payment_id');
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error', 'Payment failed');
            return Redirect::route('paypal.paypalwithpayments');
        }
        $pay_paypal = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        $result = $pay_paypal->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            //info transaction
            $trans = $result->getTransactions();
            $acheteur = $result->getPayer();
            $a = array($trans,$acheteur);
            dd($a);
            /*$Subtotal = $trans[0]->getAmount()->getDetails()->getSubtotal();
            $currency = $trans[0]->getAmount()->currency();
            $Tax = $trans[0]->getAmount()->getDetails()->getTax();*/

            //info acheteur
            
            
            echo $nom = $acheteur[0]->getPayerInfo()->getFirstname();
            var_dump($acheteur);
            /*$mode_payement = $acheteur[0]->getPayment_method();
            $email = $acheteur[0]->getPayerInfo()()->email();
            $nom = $acheteur[0]->getPayerInfo()->first_name();
            $prenom = $acheteur[0]->getPayerInfo()->last_name();

            $info = array(
                'total' => $Subtotal,
                'currency' => $currency,
                'mode p' => $mode_payement,
                'email' => $email,
                'nom' => $nom,
                'prenom' => $prenom);*/
            dd('virta');

            \Session::put('success', 'Payment success');
            return Redirect::route('paypal.paypalwithpayments');
        }
        \Session::put('error', 'Payment failed');
        return Redirect::route('paypal.paypalwithpayments');
    }
}
