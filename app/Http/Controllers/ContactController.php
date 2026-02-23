<?php

namespace App\Http\Controllers;

use App\Mail\InvitationRequestMail;
use App\Models\Contact;
use App\Models\InvitationRequest;
use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Http\Request;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        try {
            
            // Manual validation (best for AJAX inside try/catch)
            $form_type = $request->input('form_type') ?? 'investor_list';

            if($form_type === 'business_over_tea_invitation') {
                $validator = Validator::make($request->all(), [
                    'name'      => 'required|string|max:255',
                    'email'     => 'required|email|max:255',
                    'phone'     => 'required|string|max:15',
                    'location'  => 'required|string|max:255',
                    'company'   => 'required|string|max:255',
                    'role'      => 'required|string|max:255',
                    'industry'  => 'required|string|max:255',
                    'no_of_employee' => 'required|string|max:50',
                ]);

                // If validation fails → return JSON errors with status 422
                if ($validator->fails()) {
                    return response()->json([
                        'status' => false,
                        'errors' => $validator->errors()
                    ], 422);
                }

                $validated = $validator->validated();

                // Send Email
                Mail::to('bizovertea@nuvantagroupltd.com')->send(new InvitationRequestMail($validated));
                //  Notification::route('mail', 'bizovertea@nuvantagroupltd.com')
                //     ->notify(new SystemNotification(
                //         'New Business Over Tea Invitation Request',
                //         $validated,
                //         'Go to Dashboard',
                //         route('investor.dashboard'),
                //         true,
                //         'emails.invitation_request'
                //     ));
                // Save to DB
                InvitationRequest::create($validated);

                return response()->json([
                    'status'  => true,
                    'message' => 'Your invitation request has been submitted!'
                ], 200);
            }else{
                $validator = Validator::make($request->all(), [
                    'name'      => 'required|string|max:255',
                    'email'     => 'required|email|max:255',
                    'isd_code'  => 'required',
                    'phone'     => 'required|string|max:15',
                    'interested_in' => 'required|string',
                    'country'   => 'required|string',
                ]);

                // If validation fails → return JSON errors with status 422
                if ($validator->fails()) {
                    return response()->json([
                        'status' => false,
                        'errors' => $validator->errors()
                    ], 422);
                }

                $validated = $validator->validated();

                // Send Email
                Mail::to('invest@nuvantagroupltd.com')->send(new ContactMail($validated));
              
                // Notification::route('mail', 'invest@nuvantagroupltd.com')
                // ->notify(new SystemNotification(
                //     'New Contact Request',
                //     $validated,
                //     'Go to Dashboard',
                //     route('investor.dashboard'),
                //     true,
                //     'website.emails.email'
                // ));

                // Save to DB
                Contact::create($validated);

                return response()->json([
                    'status'  => true,
                    'message' => 'Your contact details have been saved!'
                ], 200);
                }

        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
