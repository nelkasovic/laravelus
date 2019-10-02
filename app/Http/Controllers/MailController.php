<?php

namespace App\Http\Controllers;

use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Event;
use App\User;
use App\Person;
use App\File;
use Lang;
use Carbon;

class MailController extends Controller
{
    private $sender;
    private $from;
    /**
     * Create a new controller instance with authentication
     *
     * @return void
     */
    public function __construct()
    {
        $this->sender = env("MAIL_FROM", "app@sqedule.ch");
        $this->from = config('app.name');
        //$this->from = config('app.name') . " - " . Lang::get('common.AppTitle');

        //$this->middleware('role:user');
        //$this->middleware('permission:read mails');
    }

        
    public function eventStatusChanged($event_id, $person_id, $state)
    {
        $event = Event::findOrFail($event_id);
        $person = Person::findOrFail($person_id);
        $user = User::where('person_id', $person_id)->first();
        $client = Auth()->user()->client;
        $date = Carbon::now()->format('d.m.Y');
        $time = Carbon::now()->format('H:i');

        // Set sender information.
        $this->sender = $client->email;
        $this->from = $client->name;
        
        // Get the attachmend in confirmed state.
        if ($state == 'confirmed') {
            // New instance of FileController to get basepath and file data.
            $fc = new FileController;
            
            // Find the right assignment.
            $query = $event->teachers()
                ->wherePivot('person_id', $person_id)
                ->wherePivot('event_id', $event_id)
                ->first();
            
            $pivot = ($query) ? $query->pivot : null;
            $file_id = ($pivot) ? $pivot->file_id : null;
            $file = ($file_id) ? File::findOrFail($file_id) : null;
            $attachment = ($file) ? public_path('data'). DIRECTORY_SEPARATOR . $fc->basePath().$file->path : null;
        } else {
            $attachment = null;
        }

        // Translation strings.
        if ($state === 'applied') {
            $status = Lang::get('common.Applied');
            $notification = false;
        } elseif ($state === 'declined') {
            $status = Lang::get('common.Declined');
            $notification = $user->getMeta('receive_event_declined');
        } elseif ($state === 'confirmed') {
            $status = Lang::get('common.Confirmed');
            $notification = $user->getMeta('receive_event_confirmed');
        } elseif ($state === 'unconfirmed') {
            $status = Lang::get('common.NotConfirmed');
            $notification = $user->getMeta('receive_event_confirmed');
        } elseif ($state === 'assigned') {
            $status = Lang::get('common.Assigned');
            $notification = $user->getMeta('receive_event_assigned');
        } elseif ($state === 'unassigned') {
            $status = Lang::get('common.Unassigned');
            $notification = $user->getMeta('receive_event_assigned');
        } elseif ($state === 'completed') {
            $status = Lang::get('common.Completed');
            $notification = false;
        } else {
            $status = '';
            $notification = false;
        }

        //return view('emails.event-status', compact('event', 'client', 'person', 'status', 'date', 'time', 'attachment'));
        
        $mail = Mail::send('emails.event-status', compact('event', 'person', 'client', 'status', 'date', 'time', 'attachment'), function ($message) use ($event, $person, $client, $status, $state, $attachment, $notification) {
            
            // Compose subject line.
            $subject = Lang::get('common.StatusChange') . ' | ' . $event->alias . ' | ' . $status . ' (' . $person->last_name . ')' . ' | ' . Carbon::parse($event->start_date)->format('d.m.Y') . ' - ' . Carbon::parse($event->end_date)->format('d.m.Y');

            if($notification) {
                // New mail to the client himself. Real recipients are bcc.
                $message->to($person->email, $person->last_name)->subject($subject);
                // Send a copy of email to logged in user (could be different then clients email address).
                $message->cc([Auth()->user()->email, $this->sender]);
            } else {
                $message->to(Auth()->user()->email, Auth()->user()->name)->subject($subject);
                $message->cc($client->email);
            }

            // Send attachment only in state confirmed and if attachment is not null.
            if ($state == 'confirmed' && $attachment) {
                //$message->attach(response()->download($attachment));
                $message->attach($attachment);
            }

            // Set mail header data.
            $message->replyTo($this->sender, $this->from);

            $message->from($this->sender, $this->from);
        });

        return $mail;
    }

    public function eventCreated($id = 41)
    {
        $event = Event::findOrFail($id);
        $client = Auth()->user()->client;
        $this->sender = $client->email;
        $this->from = $client->name;
        //$recipients = (new CourseController)->personsBasedOnSkills($event->course_id)->pluck('email')->toArray();
        //dd($recipients);
        
        //return view('emails.tender', compact('event', 'client', 'recipients'));
        
        $mail = Mail::send('emails.tender', compact('event', 'client'), function ($message) use ($event, $client) {
            
            // Get all recipient email addresses (persons based on skills)
            $recipients = (new CourseController)->personsBasedOnSkills($event->course_id)->pluck('email')->toArray();
            
            // Compose subject line.
            $subject = Lang::get('common.NewTender') . ' | ' . $event->alias . ' | ' . Carbon::parse($event->start_date)->format('d.m.Y') . ' - ' . Carbon::parse($event->end_date)->format('d.m.Y');
            
            // New message addressed to the client himself because we want to use bcc for real recipients.
            $message->to($client->email, $client->name)->subject($subject);
            
            // Send a copy of email to logged in user (could be different then clients email address).
            $message->cc(Auth()->user()->email);

            // Mask recipients with bcc.
            $message->bcc($recipients);

            // Set reply to information.
            $message->replyTo($this->sender, $this->from);

            // Set from information (see top of this file)
            $message->from($this->sender, $this->from);
        });

        return $mail;
    }

    public function userForPersonCreated($person, $user, $client)
    {
        //return view('emails.userforperson', compact('client', 'person', 'user'));
        
        $mail = Mail::send('emails.userforperson', compact('client', 'person', 'user'), function ($message) use ($client, $person, $user) {
            $subject = Lang::get('common.UserCreated') . ' | ' . $user->email . ' | ' . $user->name;
            $message->to($user->email, $user->name)->subject($subject);
            $message->replyTo($this->sender, $this->from);
            $message->from($this->sender, $this->from);
        });

        return $mail;
    }

    public function send()
    {
        $demo = new \stdClass();
        $demo->demo_one = 'Demo One Value';
        $demo->demo_two = 'Demo Two Value';
        $demo->sender = 'SenderUserName';
        $demo->receiver = 'ReceiverUserName';

        Mail::to('nermin.elkas@gmail.com')->send(new DemoEmail($demo));
    }

    
    public function basic()
    {
        $data = array('name'=>"Virat Gandhi");
     
        Mail::send(['text'=>'emails.mail'], $data, function ($message) {
            $message->to('nermin.elkas@gmail.com', 'Message to Nermin Elkasovic')->subject('Laravel Basic Testing Mail');
            $message->from($this->sender, $this->from);
        });
        //echo "Basic Email Sent. Check your inbox.";
    }
    public function html()
    {
        $data = array('name'=>"Virat Gandhi");
        Mail::send('emails.mail', $data, function ($message) {
            $message->to('nermin.elkas@gmail.com', 'Message to Nermin Elkasovic')->subject('Laravel HTML Testing Mail');
            $message->from($this->sender, $this->from);
        });
        //echo "HTML Email Sent. Check your inbox.";
    }
    public function attachment()
    {
        $data = array('name'=>"Virat Gandhi");
        Mail::send('emails.mail', $data, function ($message) {
            $message->to('nermin.elkas@gmail.com', 'Message to Nermin Elkasovic')->subject('Laravel Testing Mail with Attachment');
            //$message->attach('C:\laravel-master\laravel\public\uploads\image.png');
            //$message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
            $message->from($this->sender, $this->from);
        });
        //echo "Email Sent with attachment. Check your inbox.";
    }
}
