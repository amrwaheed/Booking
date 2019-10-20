<?php

namespace App\Http\Controllers;


use App\Ticket;
use App\TicketUser;
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
        $tickets = Ticket::with('user')->get();
        $order_count_normal = TicketUser::where('ticket_id', '1')->count('ticket_id');// count the normal ticket
        $order_count_student = TicketUser::where('ticket_id', '2')->count('ticket_id');// count the student ticket
        $i = 0;
        return view('home' ,compact('tickets', 'i','order_count_normal','order_count_student'));
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
        $tickets = $validatedData['ticket']; // array contain ids tickets


            $order_count_normal = TicketUser::where('ticket_id', '1')->count('ticket_id');// count the normal ticket
            $order_count_student = TicketUser::where('ticket_id', '2')->count('ticket_id');// count the student ticket
            if ( $order_count_normal <= 200 || $order_count_student <= 200 )
            {

                $user_id = auth()->user()->id;
                $array= array();
                foreach ($tickets as $ticket){
                    $array[] = array(
                        'ticket_id' => $ticket ,
                        'user_id' => $user_id,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    );
                }
                TicketUser::insert($array);
                Session::flash('message', 'Congratulations The ticket has been successfully booked');
                return view('success');

            }else{
                Session::flash('booked', 'The tickets are over.');
                return view('success');
            }// end of if condition to check if number of ticket < 200
        }// end of check one user have one ticket









}
