<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * get all categories
     */
    public function index()
    {
        $categories = Category::with('user')->get();
        $order_count_normal = Order::where('category_id','=','1')->count('category_id');// count the normal ticket
        $order_count_student = Order::where('category_id','=','2')->count('category_id');// count the student ticket
        $i = 0;
        return view('home' ,compact('categories', 'i','order_count_normal','order_count_student'));
    }

    /**
     * @param Request $request
     * To create request new Ticket
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'ticket' => 'required_without_all',
        ]);// Validated user must check at least one checkbox

        if (Order::where('user_id', '=', auth()->user()->id )->exists() ) { // check if user exists user has ticket or not
            Session::flash('booked', 'You are already booked');
            return view('success');
        }else{
            $order_count_normal = Order::where('category_id','=','1')->count('category_id');// count the normal ticket
            $order_count_student = Order::where('category_id','=','2')->count('category_id');// count the student ticket

            if ( $order_count_normal <= 200 || $order_count_student <= 200 )
            {
                foreach ($validatedData['ticket'] as $value) {
                   DB::table('orders')->insert([
                        'category_id' => $value ,
                        'user_id' => auth()->user()->id ,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ]);
                }
                Session::flash('message', 'Congratulations The ticket has been successfully booked');
                return view('success');
            }else{
                Session::flash('booked', 'The tickets are over.');
                return view('success');
            }

        }



    }

}
