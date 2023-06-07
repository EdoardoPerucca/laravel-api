<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $formData = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'description' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,

                'errors' => $validator->errors()
            ]);
        }

        $new_lead = new Lead();
        $new_lead->fill($formData);
        $new_lead->save();

        Mail::to('edoardo.perucca@hotmail.com')->send(new NewContact($new_lead));

        return redirect()->route('home');
    }
}
