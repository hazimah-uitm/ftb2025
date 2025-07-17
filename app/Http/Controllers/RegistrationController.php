<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\User;
use App\Notifications\NewRegistrationSubmitted;
use App\Notifications\RegistrationStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:View Participation')->only('show');
        $this->middleware('permission:View List Participation')->only(['index', 'search']);
        $this->middleware('permission:Add Participation')->only(['create', 'store']);
        $this->middleware('permission:Edit Participation')->only(['edit', 'update']);
        $this->middleware('permission:Delete Participation')->only(['destroy', 'trashList', 'restore', 'forceDelete']);
    }

    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);

        $registrationList = Registration::latest()->paginate($perPage);

        return view('pages.registration.index', [
            'registrationList' => $registrationList,
            'perPage' => $perPage,
        ]);
    }

    public function userDashboard()
    {
        $user = User::find(auth()->id());

        $registration = Registration::where('user_id', $user->id)->first();

        $totalRegistrations = null;
        $pendingRegistrations = null;
        $approvedRegistrations = null;

        if ($user->hasRole('Admin') || $user->hasRole('Superadmin')) {
            $totalRegistrations = Registration::count();
            $pendingRegistrations = Registration::where('status', 'Submitted & waiting for approval')->count();
            $approvedRegistrations = Registration::where('status', 'Approved')->count();
        }

        return view('pages.registration.dashboard', compact(
            'user',
            'registration',
            'totalRegistrations',
            'pendingRegistrations',
            'approvedRegistrations'
        ));
    }

    public function create()
    {
        $user = Auth::user();

        return view('pages.registration.create', [
            'save_route' => route('registration.store'),
            'str_mode' => 'Register',
            'user_id' => $user->id,
            'institution_name' => $user->institution_name,
            'email' => $user->email,
            'phone_no' => $user->phone_no,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'group_name' => 'required|string|max:255',
            'traditional_dance_name' => 'required|string|max:255',
            'creative_dance_name' => 'required|string|max:255',
            'koreografer_name' => 'required|string|max:255',
            'assistant_koreografer_name' => 'nullable|string|max:255',
            'address' => 'required|string',
            'sinopsis_traditional' => 'required|string',
            'sinopsis_creative' => 'required|string',
            'fax_no' => 'nullable|string|max:50',
            'doc_link' => 'nullable|string|max:255',
            'members' => 'required|array|min:1',
            'members.*.name' => 'required|string|max:255',
            'members.*.ic_no' => 'required|string|max:255',
            'members.*.peranan' => 'required|string|max:255',
            'members.*.jantina' => 'required|string',
            'members.*.saiz_baju' => 'required|string',

            'escort_officers' => 'nullable|array',
            'escort_officers.*.name' => 'required|string|max:255',

            'payment.payment_type' => 'required|string|max:255',
            'payment.date' => 'required|date',
            'payment.payment_file' => 'nullable|file|max:2048',
        ], [
            'group_name.required' => 'Sila isi nama kumpulan',
            'traditional_dance_name.required' => 'Sila isi nama tarian tradisional',
            'creative_dance_name.required' => 'Sila isi nama tarian kreatif',
            'koreografer_name.required' => 'Sila isi nama koreografer',
            'address.required' => 'Sila isi alamat',
            'sinopsis_traditional.required' => 'Sila isi sinopsis tradisional',
            'sinopsis_creative.required' => 'Sila isi sinopsis kreatif',
        ]);

        $registration = new Registration();
        $registration->user_id = Auth::id();
        $registration->fill($request->except(['members', 'escort_officers', 'payment']));
        $registration->status = 'Submitted & waiting for approval';
        $registration->remarks_submitter = $request->input('remarks_submitter');
        $registration->submitted_by = Auth::id();
        $registration->submitted_at = now();
        $registration->save();

        // Save Members
        foreach ($request->members as $memberData) {
            $registration->members()->create($memberData);
        }

        // Save Escort Officers
        if ($request->has('escort_officers')) {
            foreach ($request->escort_officers as $officerData) {
                $registration->escortOfficers()->create($officerData);
            }
        }

        // Save Payment
        if ($request->has('payment')) {
            $paymentData = $request->payment;
            if ($request->hasFile('payment.payment_file')) {
                $paymentData['payment_file'] = $request->file('payment.payment_file')->store('payment_files', 'public');
            }
            $registration->payments()->create($paymentData);
        }

        // Hantar notification ke semua Admin/Superadmin
        $admins = User::role('Admin')->get();
        if ($admins->isNotEmpty()) {
            foreach ($admins as $admin) {
                $admin->notify(new NewRegistrationSubmitted($registration));
            }
        } else {
            Log::error('Tiada Admin ditemui dalam sistem untuk menerima notifikasi permohonan ruang.');
        }

        $user = User::find(auth()->id());
        if ($user->hasRole('Pengguna')) {
            return redirect()->route('registration.view', $registration->id)
                ->with('success', 'Maklumat berjaya disimpan');
        } else {
            return redirect()->route('registration')
                ->with('success', 'Maklumat berjaya disimpan');
        }
    }

    public function approval(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Approved,Rejected',
            'remarks_checker' => 'nullable|string',
        ]);

        $registration = Registration::findOrFail($id);
        $registration->status = $request->status;
        $registration->remarks_checker = $request->remarks_checker;
        $registration->checked_by = Auth::id();
        $registration->checked_at = now();
        $registration->save();

        $registration->user->notify(new RegistrationStatusUpdated($registration));

        return redirect()->route('registration')->with('success', 'Permohonan telah ' . strtolower($request->status));
    }

    public function show($id)
    {
        $registration = Registration::findOrFail($id);
        $user = User::find(auth()->id());

        // If not admin/superadmin, check ownership
        if (!$user->hasAnyRole(['Admin', 'Superadmin']) && $registration->user_id !== $user->id) {
            abort(403, 'You are not authorized to view this registration.');
        }

        return view('pages.registration.view', [
            'registration' => $registration,
        ]);
    }

    public function edit($id)
    {
        $registration = Registration::findOrFail($id);

        return view('pages.registration.edit', [
            'save_route' => route('registration.update', $id),
            'str_mode' => 'Kemas Kini',
            'registration' => $registration,
            'user_id' => $registration->user_id,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'group_name' => 'required|string|max:255',
            'traditional_dance_name' => 'required|string|max:255',
            'creative_dance_name' => 'required|string|max:255',
            'koreografer_name' => 'required|string|max:255',
            'assistant_koreografer_name' => 'nullable|string|max:255',
            'address' => 'required|string',
            'sinopsis_traditional' => 'required|string',
            'sinopsis_creative' => 'required|string',
            'fax_no' => 'nullable|string|max:50',
            'doc_link' => 'nullable|string|max:255',
        ], [
            'group_name.required' => 'Sila isi nama kumpulan',
            'traditional_dance_name.required' => 'Sila isi nama tarian tradisional',
            'creative_dance_name.required' => 'Sila isi nama tarian kreatif',
            'koreografer_name.required' => 'Sila isi nama koreografer',
            'address.required' => 'Sila isi alamat',
            'sinopsis_traditional.required' => 'Sila isi sinopsis tradisional',
            'sinopsis_creative.required' => 'Sila isi sinopsis kreatif',
        ]);

        $registration = Registration::findOrFail($id);
        $registration->fill($request->except('user_id'));
        $registration->save();

        return redirect()->route('registration')->with('success', 'Maklumat berjaya dikemaskini');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $query = Registration::query();

        if ($search) {
            $query->where('group_name', 'LIKE', "%$search%");
        }

        $registrationList = $query->with('user')->latest()->paginate(10);

        return view('pages.registration.index', [
            'registrationList' => $registrationList,
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);

        $registration->delete();

        return redirect()->route('registration')->with('success', 'Maklumat berjaya dihapuskan');
    }

    public function trashList()
    {
        $trashList = Registration::onlyTrashed()->latest()->paginate(10);

        return view('pages.registration.trash', [
            'trashList' => $trashList,
        ]);
    }

    public function restore($id)
    {
        Registration::withTrashed()->where('id', $id)->restore();

        return redirect()->route('registration')->with('success', 'Maklumat berjaya dikembalikan');
    }


    public function forceDelete($id)
    {
        $registration = Registration::withTrashed()->findOrFail($id);

        $registration->forceDelete();

        return redirect()->route('registration.trash')->with('success', 'Maklumat berjaya dihapuskan sepenuhnya');
    }
}
