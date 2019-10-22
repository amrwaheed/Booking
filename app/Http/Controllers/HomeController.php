<?php

namespace App\Http\Controllers;


use App\Ticket;
use App\TicketUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\FormDataRequest;


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
     *
     * get all categories
     */
    public function index()
    {

    return view('home' ,
        ['tickets'=> Ticket::get(),
        'i' =>$i =0 ,
        'order_count_normal' => TicketUser::where('ticket_id', '1')->count('ticket_id'), // count to normal ticket
        'order_count_student' => TicketUser::where('ticket_id', '2')->count('ticket_id'), // count to student ticket
        'users' => User::with('ticket')->where('id' , auth()->user()->id)->first()
         ]);
    }

    /**
     *
     * To create request new Ticket
     */
    public function create(FormDataRequest  $request)
    {

        $validatedData = $request->validated();// Validated user must check at least one checkbox

        // check Each user can only book 1 ticket of each type
        if (  TicketUser::where('user_id',  auth()->user()->id )->whereIn('ticket_id',$validatedData['ticket'] )->exists() ){
            Session::flash('booked', 'You are already booked');
            return redirect()->back();

        }else{
            $order_count_normal = TicketUser::where('ticket_id', '1')->count('ticket_id');// count the normal ticket
            $order_count_student = TicketUser::where('ticket_id', '2')->count('ticket_id');// count the student ticket
            if ( $order_count_normal <= 200 || $order_count_student <= 200 )
            {


                $array= array();
                foreach ($validatedData['ticket'] as $ticket){
                    $array[] = array(
                        'ticket_id' => $ticket ,
                        'user_id' => auth()->user()->id,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    );

                    TicketUser::insert($array);
                    Session::flash('message', 'Congratulations The ticket has been successfully booked');
                    return redirect()->back();
                }
            }else{
                Session::flash('booked', 'The tickets are over.');
                return redirect()->back();
            }// end of if condition to check if number of ticket < 200
        }



    }









}
