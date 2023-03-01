<?php
require_once FCPATH . "/vendor/autoload.php";

use CoinbaseCommerce\ApiClient;
use CoinbaseCommerce\Resources\Charge;
use CoinbaseCommerce\Resources\Checkout;
use CoinbaseCommerce\Webhook;
use PHPUnit\Framework\TestCase;
use CoinbaseCommerce\Resources\Event;

/**
 * Coinbase Payment Library
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is available through the world-wide-web at this URL:
 * https://choosealicense.com/licenses/gpl-3.0/
 *
 * @category        Coinbase
 * @package         codeigniter/libraries
 * @version         1.0
 * @author          Axis96 <axis96.co>
 * @copyright       Copyright (c) 2020 Axis96
 * @license         https://choosealicense.com/licenses/gpl-3.0/
 *
 * EXTENSION INFORMATION
 *
 * COINBASE       https://coinbase.com
 *
 */
class Coinbaselib
{
    private $api_key = '';                                      // api Key
    private $secret = '';
    private $name = '';
    private $description = '';
    private $amount = '';
    private $currency = 'USD';
    private $customer_id = '';
    private $customer_name = '';
    private $redirect_url = '';
    private $cancel_url = '';


    /**
     * Constructor.
     *
     * @param string $config
     *
     */
    public function __construct($config = false)
    {
        if (isset($config['api_key'])) $this->api_key = $config['api_key'];
        if (isset($config['secret'])) $this->secret = $config['secret'];
        if (isset($config['name'])) $this->name = $config['name'];
        if (isset($config['description'])) $this->description = $config['description'];
        if (isset($config['amount'])) $this->amount = $config['amount'];
        if (isset($config['currency'])) $this->currency = $config['currency'];
        if (isset($config['customer_id'])) $this->customer_id = $config['customer_id'];
        if (isset($config['customer_name'])) $this->customer_name = $config['customer_name'];
        if (isset($config['redirect_url'])) $this->redirect_url = $config['redirect_url'];
        if (isset($config['cancel_url'])) $this->cancel_url = $config['cancel_url'];

        
    }

    public function charge()
    {
        //Initiate API Client
        ApiClient::init($this->api_key);
        
        $chargeObj = new Charge(
            [
                "name" => $this->name,
                "description" => $this->description,
                "local_price" => [
                    "amount" => $this->amount,
                    "currency" => $this->currency
                ],
                "metadata" => [
                    "customer_id" => $this->customer_id,
                    "customer_name" => $this->customer_name
                ],
                "payments" => [],
                "pricing_type" => "fixed_price",
                "redirect_url" => $this->redirect_url,
                "cancel_url" => $this->cancel_url
            ] 
        );

        try {
            $chargeObj->save();
            //echo sprintf("Successfully created new charge with id: %s \n", $chargeObj->id);
        } catch (\Exception $exception) {
            //echo sprintf("Enable to create charge. Error: %s \n", $exception->getMessage());
        }

        if ($chargeObj->id) {
            $chargeObj->description = "New description";
            // Refresh attributes to previous values
            try {
                $chargeObj->refresh();
                //echo sprintf("Successfully refreshed checkout.\n");
            } catch (\Exception $exception) {
                //echo sprintf("Enable to refresh checkout. Error: %s \n", $exception->getMessage());
            }

            // Retrieve charge by "id"
            try {
                $retrievedCharge = Charge::retrieve($chargeObj->id);
                //echo sprintf("Successfully retrieved charge\n");
                $array = array(
                    'id'=>$chargeObj->id,
                    'url'=>$retrievedCharge['hosted_url']
                );
                return $array;
            } catch (\Exception $exception) {
                echo sprintf("Enable to retrieve charge. Error: %s \n", $exception->getMessage());
            }
        }

    }

    public function webhook()
    {
        /**
         * To run this example please read README.md file
         * Past your Webhook Secret Key from Settings/Webhook section
         * Make sure you don't store your Secret Key in your source code!
         */
        $secret = $this->secret;
        $headerName = 'X-CC-Webhook-Signature';
        $headers = getallheaders();
        $signatureHeader = isset($headers[$headerName]) ? $headers[$headerName] : null;
        
        //if not in getallheaders, it might be in $_SERVER['HTTP_X_CC_WEBHOOK_SIGNATURE'];
        if($signatureHeader == null){
            $signatureHeader = $_SERVER['HTTP_X_CC_WEBHOOK_SIGNATURE'];
        }

        $payload = trim(file_get_contents('php://input'));

        try {
            $event = Webhook::buildEvent($payload, $signatureHeader, $secret);
            http_response_code(200);
            $array = array(
                'id'=>$event->id,
                'type'=>$event->type
            );
            return $array;
            //echo sprintf('Successully verified event with id %s and type %s.', $event->id, $event->type);
        } catch (\Exception $exception) {
            http_response_code(200);
            return false;
            //echo 'Error occured. ' . $exception->getMessage();
        }
    }

    public function testSuccessfullyVerifyBody()
    {
        $secret = '30291a20-0bd1-4267-9b0f-e6e7b123c0bf';
        $payload = '{"id":1,"scheduled_for":"2017-01-31T20:50:02Z","attempt_number":1,"event":{"id":"24934862-d980-46cb-9402-43c81b0cdba6","type":"charge:created","api_version":"2018-03-22","created_at":"2017-01-31T20:49:02Z","data":{"code":"66BEOV2A","name":"The Sovereign Individual","description":"Mastering the Transition to the Information Age","hosted_url":"https://commerce.coinbase.com/charges/66BEOV2A","created_at":"2017-01-31T20:49:02Z","expires_at":"2017-01-31T21:04:02Z","timeline":[{"time":"2017-01-31T20:49:02Z","status":"NEW"}],"metadata":{},"pricing_type":"no_price","payments":[],"addresses":{"bitcoin":"0000000000000000000000000000000000","ethereum":"0x0000000000000000000000000000000000000000","litecoin":"3000000000000000000000000000000000","bitcoincash":"bitcoincash:000000000000000000000000000000000000000000"}}}}';
        $headerSignature = '8be7742c7d372f08a6a3224edadf18a22b65fa9e28f3f2de97376cdaa092590d';

        try {
            $event = Webhook::buildEvent($payload, $headerSignature, $secret);

            http_response_code(200);
            $array = array(
                'id'=>$event->id,
                'type'=>$event->type
            );
            return $array;
        } catch (\Exception $exception) {
            http_response_code(200);
            return false;
            //echo 'Error occured. ' . $exception->getMessage();
        }
    }

}