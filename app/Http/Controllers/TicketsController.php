<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketFormRequest;
use App\Ticket;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $tickets = Ticket::latest()->get();

        return view('cms.tickets.index', ['tickets'=> $tickets]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function myIindex()
    {
        $user = Auth::user();
        $tickets = $user->tickets()->latest()->get();

        return view('cms.tickets.index', ['tickets'=> $tickets]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('cms.tickets.create');
    }


    /**
     * Store a newly created resource in storage.
     * @param TicketFormRquest $request
     * @return Response
     */
    public function store(TicketFormRequest $request)
    {

        $slug = uniqid();

        $ticket = new Ticket(array(
                'title' => $request->get('title'),
                'content' => $request->get('content'),
                'slug' => $slug

            ));

        Auth::user()->tickets()->save($ticket);


        $data = array(
                 'ticket' => $slug
                ,'titleTicket'=> $request->get('title')
                ,'contentTicket'=> $request->get('content')
        );

        Mail::send('cms.tickets.emails.new_ticket', $data, function ($message) {
            $message->from('noreplay@prima-posizione.it', 'Learning Laravel');
            $message->to( Auth::user()->email)->subject('Learning Laravel test email');
        });

        return redirect('/ticket/create')->with('status', 'Your ticket has been created! Its unique id is:'.$slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slug)
    {
        $ticket = Ticket::whereSlug($slug)->firstOrFail();
        $comments = $ticket->comments()->get();
        return view('cms.tickets.show', compact('ticket', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($slug)
    {
        $ticket = Ticket::whereSlug($slug)->firstOrFail();
        return view('cms.tickets.edit', compact('ticket'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($slug, TicketFormRequest $request)
    {
        $ticket = Ticket::whereSlug($slug)->firstOrFail();
        $ticket->title = $request->get('title');
        $ticket->content = $request->get('content');
        if($request->get('status') != null) {
            $ticket->status = 0;
        } else {
            $ticket->status = 1;
        }
        $ticket->save();
        return redirect(action('TicketsController@edit', $ticket->slug))->with('custom_success', 'The ticket '.$slug.' has been updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($slug)
    {
        $ticket = Ticket::whereSlug($slug)->firstOrFail();
        $ticket->delete();
        return redirect('/tickets')->with('custom_success', 'The ticket '.$slug.' has been deleted!');
    }
}
