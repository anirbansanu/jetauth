<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Validator;
use Stripe\Exception\CardException;
use Stripe\StripeClient;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->stripe = new StripeClient(env('STRIPE_SECRET'));
    }
    function getOrder(){
        $u_id = auth()->user()?auth()->user()->id:false;
        if($u_id)
        {
            $o = Order::join('products', 'orders.product_id', '=', 'products.id')
                            ->join('users', 'orders.user_id', '=', 'users.id')
                            ->select('products.*','users.name','users.address','users.phone','orders.*')
                            ->where('orders.user_id','=',$u_id)
                            ->get();
            //return $carts;

            return view("user.order",['orders'=>$o]);
        }
        return redirect('login');
    }
    public function payment(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'card_number' => 'required',
            'month' => 'required',
            'year' => 'required',
            'cvv' => 'required'
        ]);

        if ($validator->fails()) {
            // $request->session()->flash('danger', $validator->errors()->first());
            // return response()->redirectTo('/');
            return $validator->errors();
        }
        // return $request->all();
        $token = $this->createToken($request);
        if (!empty($token['error'])) {
            // $request->session()->flash('danger', $token['error']);
            // return response()->redirectTo('/');
            return $token['error'];
        }
        if (empty($token['id'])) {
            // $request->session()->flash('danger', 'Payment failed.');
            // return response()->redirectTo('/');
            return "Payment failed.";
        }

        $charge = $this->createCharge($token['id'], 2000);
        // if (!empty($charge) && $charge['status'] == 'succeeded') {
        //     $request->session()->flash('success', 'Payment completed.');
        // } else {
        //     $request->session()->flash('danger', 'Payment failed.');
        // }
        // return response()->redirectTo('/');
        return $charge;
    }
    private function createToken($cardData)
    {
        $token = null;
        try {
            $token = $this->stripe->tokens->create([
                'card' => [
                    'number' => $cardData['card_number'],
                    'exp_month' => $cardData['month'],
                    'exp_year' => $cardData['year'],
                    'cvc' => $cardData['cvv']
                ]
            ]);
        } catch (CardException $e) {
            $token['error'] = $e->getError()->message;
        } catch (Exception $e) {
            $token['error'] = $e->getMessage();
        }
        return $token;
    }

    private function createCharge($tokenId, $amount)
    {
        $charge = null;
        try {
            $charge = $this->stripe->charges->create([
                'amount' => $amount,
                'currency' => 'usd',
                'source' => $tokenId,
                'description' => 'My first payment'
            ]);
        } catch (Exception $e) {
            $charge['error'] = $e->getMessage();
        }
        return $charge;
    }
}
