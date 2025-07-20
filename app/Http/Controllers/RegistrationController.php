<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\User;
use App\Notifications\NewRegistrationSubmitted;
use App\Notifications\RegistrationStatusUpdated;
use App\Notifications\UpdatedRegistrationInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Lihat Penyertaan')->only('show');
        $this->middleware('permission:Lihat Senarai Penyertaan')->only(['index', 'search']);
        $this->middleware('permission:Tambah Penyertaan')->only(['create', 'store']);
        $this->middleware('permission:Edit Penyertaan')->only(['edit', 'update']);
        $this->middleware('permission:Padam Penyertaan')->only(['destroy', 'trashList', 'restore', 'forceDelete']);
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

        $approvedRegistrations = Registration::where('status', 'Diluluskan')->count();

        // Hanya Admin/Superadmin boleh tengok total & pending
        $totalRegistrations = null;
        $pendingRegistrations = null;

        if ($user->hasRole('Admin') || $user->hasRole('Superadmin')) {
            $totalRegistrations = Registration::count();
            $pendingRegistrations = Registration::where('status', 'Menunggu Kelulusan')->count();
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
            'str_mode' => 'Hantar',
            'user_id' => $user->id,
            'institution_name' => $user->institution_name,
            'email' => $user->email,
            'phone_no' => $user->phone_no,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'group_name' => 'required|string|max:255',
            'traditional_dance_name' => 'required|string|max:255',
            'creative_dance_name' => 'required|string|max:255',
            // 'koreografer_name' => 'required|string|max:255',
            // 'assistant_koreografer_name' => 'nullable|string|max:255',
            'address' => 'required|string',
            'sinopsis_traditional' => 'required|string',
            'sinopsis_creative' => 'required|string',
            'doc_link' => 'nullable|string|max:255',
            'members' => 'required|array|min:1',
            'members.*.name' => 'required|string|max:255',
            'members.*.ic_no' => 'required|string|max:255',
            'members.*.peranan' => 'required|string|max:255',
            'members.*.jantina' => 'required|string',
            'members.*.saiz_baju' => 'required|string',
            'members.*.student_id' => 'nullable|string|max:100',

            // 'escort_officers' => 'nullable|array',
            // 'escort_officers.*.name' => 'required|string|max:255',

            'payment.payment_type' => 'required|string|max:255',
            'payment.date' => 'required|date',
            'payment.payment_file' => 'nullable|file|max:2048',
        ], [
            'group_name.required' => 'Sila isi nama kumpulan',
            'traditional_dance_name.required' => 'Sila isi nama tarian tradisional',
            'creative_dance_name.required' => 'Sila isi nama tarian kreatif',
            // 'koreografer_name.required' => 'Sila isi nama koreografer',
            'address.required' => 'Sila isi alamat',
            'sinopsis_traditional.required' => 'Sila isi sinopsis tradisional',
            'sinopsis_creative.required' => 'Sila isi sinopsis kreatif',
            'members.*.name.required' => 'Sila isi nama penuh untuk setiap ahli kumpulan.',
            'members.*.ic_no.required' => 'Sila isi nombor IC/Passport setiap ahli kumpulan.',
            'members.*.peranan.required' => 'Sila pilih peranan untuk setiap ahli kumpulan.',
            'members.*.jantina.required' => 'Sila pilih jantina untuk setiap ahli kumpulan.',
            'members.*.saiz_baju.required' => 'Sila pilih saiz baju untuk setiap ahli kumpulan.',
            'payment.payment_file.file' => 'Sila pilih fail yang sah.',
            'payment.payment_file.max' => 'Saiz fail terlalu besar. Maksimum 2MB.',
        ]);

        // Simpan fail jika ada, sebelum validation
        if ($request->hasFile('payment.payment_file')) {
            $tempPath = $request->file('payment.payment_file')->store('temp_payment_files', 'public');
            session()->put('uploaded_payment_file', $tempPath);
        }

        // Jika validation fail
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // WAJIB fail jika tiada fail lama dalam session
        if (!session()->has('uploaded_payment_file') && !$request->hasFile('payment.payment_file')) {
            return back()->withErrors(['payment.payment_file' => 'Sila muat naik bukti pembayaran (PDF).'])->withInput();
        }

        $registration = new Registration();
        $registration->user_id = Auth::id();
        $registration->fill($request->except(['members', 'payment']));
        $registration->status = 'Menunggu Kelulusan';
        $registration->remarks_submitter = $request->input('remarks_submitter');
        $registration->submitted_by = Auth::id();
        $registration->submitted_at = now();
        $registration->save();

        // Save Members
        foreach ($request->members as $memberData) {
            $registration->members()->create($memberData);
        }

        // Save Escort Officers
        // if ($request->has('escort_officers')) {
        //     foreach ($request->escort_officers as $officerData) {
        //         $registration->escortOfficers()->create($officerData);
        //     }
        // }

        $paymentData = $request->input('payment', []);

        if (session('uploaded_payment_file')) {
            $finalPath = str_replace('temp_payment_files/', 'payment_files/', session('uploaded_payment_file'));
            Storage::disk('public')->move(session('uploaded_payment_file'), $finalPath);
            $paymentData['payment_file'] = $finalPath;
        } elseif ($request->hasFile('payment.payment_file')) {
            $paymentData['payment_file'] = $request->file('payment.payment_file')->store('payment_files', 'public');
        } else {
            return back()->withErrors(['payment.payment_file' => 'Sila muat naik bukti pembayaran (PDF).'])->withInput();
        }

        $registration->payments()->create($paymentData);

        session()->forget('uploaded_payment_file');

        // Hantar notification ke semua Admin/Superadmin
        $admins = User::role(['Admin', 'Superadmin'])->get();

        if ($admins->isNotEmpty()) {
            foreach ($admins as $admin) {
                $admin->notify(new NewRegistrationSubmitted($registration));
            }
        } else {
            Log::error('Tiada Admin atau Superadmin ditemui dalam sistem untuk menerima notifikasi permohonan ruang.');
        }

        $user = User::find(auth()->id());
        if ($user->hasRole('Peserta')) {
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
            'status' => 'required|in:Diluluskan,Dibatalkan',
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
        $registration = Registration::with(['user', 'members', 'payments'])->findOrFail($id);

        return view('pages.registration.edit', [
            'save_route' => route('registration.update', $id),
            'str_mode' => 'Kemas Kini',
            'registration' => $registration,
            'user_id' => $registration->user_id,
            'institution_name' => $registration->user->institution_name,
            'email' => $registration->user->email,
            'phone_no' => $registration->user->phone_no,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'group_name' => 'required|string|max:255',
            'traditional_dance_name' => 'required|string|max:255',
            'creative_dance_name' => 'required|string|max:255',
            // 'koreografer_name' => 'required|string|max:255',
            // 'assistant_koreografer_name' => 'nullable|string|max:255',
            'address' => 'required|string',
            'sinopsis_traditional' => 'required|string',
            'sinopsis_creative' => 'required|string',
            'doc_link' => 'nullable|string|max:255',
            'members' => 'required|array|min:1',
            'members.*.name' => 'required|string|max:255',
            'members.*.ic_no' => 'required|string|max:255',
            'members.*.peranan' => 'required|string|max:255',
            'members.*.jantina' => 'required|string',
            'members.*.saiz_baju' => 'required|string',
            'members.*.student_id' => 'nullable|string|max:100',
        ], [
            'group_name.required' => 'Sila isi nama kumpulan',
            'traditional_dance_name.required' => 'Sila isi nama tarian tradisional',
            'creative_dance_name.required' => 'Sila isi nama tarian kreatif',
            'koreografer_name.required' => 'Sila isi nama koreografer',
            'address.required' => 'Sila isi alamat',
            'sinopsis_traditional.required' => 'Sila isi sinopsis tradisional',
            'sinopsis_creative.required' => 'Sila isi sinopsis kreatif',
            'members.*.name.required' => 'Sila isi nama penuh untuk setiap ahli kumpulan.',
            'members.*.ic_no.required' => 'Sila isi nombor IC/Passport setiap ahli kumpulan.',
            'members.*.peranan.required' => 'Sila pilih peranan untuk setiap ahli kumpulan.',
            'members.*.jantina.required' => 'Sila pilih jantina untuk setiap ahli kumpulan.',
            'members.*.saiz_baju.required' => 'Sila pilih saiz baju untuk setiap ahli kumpulan.',
        ]);

        $registration = Registration::findOrFail($id);
        $registration->fill($request->except('user_id'));
        $registration->save();

        // KEMASKINI AHLI KUMPULAN
        if ($request->has('members')) {
            $registration->members()->delete();
            foreach ($request->members as $memberData) {
                $registration->members()->create($memberData);
            }
        }

        // Hantar notification ke semua Admin/Superadmin
        $admins = User::role(['Admin', 'Superadmin'])->get();

        $user = User::find(auth()->id());

        // Hanya hantar notifikasi jika bukan Admin/Superadmin
        if (!$user->hasRole(['Admin', 'Superadmin'])) {
            $admins = User::role(['Admin', 'Superadmin'])->get();

            if ($admins->isNotEmpty()) {
                foreach ($admins as $admin) {
                    $admin->notify(new UpdatedRegistrationInfo($registration));
                }
            } else {
                Log::error('Tiada Admin atau Superadmin ditemui dalam sistem untuk menerima notifikasi permohonan ruang.');
            }
        }

        $user = User::find(auth()->id());
        if ($user->hasRole('Peserta')) {
            return redirect()->route('registration.view', $registration->id)
                ->with('success', 'Maklumat berjaya disimpan');
        } else {
            return redirect()->route('registration')
                ->with('success', 'Maklumat berjaya disimpan');
        }
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

    public function exportPdf($id)
    {
        $registration = Registration::with(['user', 'members', 'payments'])->findOrFail($id);
        $user = auth()->user(); // pengguna semasa
        $timestamp = now()->format('d/m/Y H:i'); // waktu semasa

        $path = public_path('assets/images/logo-ftb1.png');
        $logoData = base64_encode(file_get_contents($path));
        $logoMimeType = mime_content_type($path);
        
        $pdfView = view('pages.registration.pdf', [
            'registration' => $registration,
            'logoBase64' => "data:{$logoMimeType};base64,{$logoData}",
        ])->render();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($pdfView);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Dapatkan kanvas
        $canvas = $dompdf->getCanvas();
        $canvasHeight = $canvas->get_height();
        $canvasWidth = $canvas->get_width();

        // Footer kiri: dijana oleh
        $canvas->page_text(
            30,
            $canvasHeight - 40,
            "Dijana oleh: {$user->name} pada {$timestamp}",
            null,
            9,
            [0, 0, 0]
        );

        // Footer kanan: muka surat (laras ke dalam)
        $canvas->page_text(
            $canvasWidth - 50,
            $canvasHeight - 40,
            "{PAGE_NUM}", // hanya nombor
            null,
            9,
            [0, 0, 0]
        );

        // Nama fail
        $filename = preg_replace('/[^A-Za-z0-9 _.-]/', '', $registration->user->institution_name)
            . ' - Dokumen Penyertaan FTB2025.pdf';

        return Response::make($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);

        $registration->forceDelete();

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
