<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::where('type', '!=', 'WHATSAPP')->get();
        $contact_regions = Contact::where('type', 'WHATSAPP')
            ->where('region_id', Auth::user()->region_id)->get();
        return $this->sendSuccessResponse([
            'contacts' => $contacts,
            'contact_regions' => $contact_regions,
        ]);
    }
}
