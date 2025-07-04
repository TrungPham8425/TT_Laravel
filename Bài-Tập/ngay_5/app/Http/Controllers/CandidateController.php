<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCandidateRequest;
use App\Models\Candidate;
use Illuminate\Support\Facades\Storage;
use App\Mail\CandidateSubmitted;
use Illuminate\Support\Facades\Mail;

class CandidateController extends Controller
{
    public function create()
    {
        return view('candidates.create');
    }

    public function store(StoreCandidateRequest $request)
    {
        $data = $request->validated();
        $avatarPath = $request->file('avatar')?->store('candidates', 'public');
        $cvPath = $request->file('cv')->store('candidates', 'public');
        $candidate = Candidate::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'birthday' => $data['birthday'],
            'avatar_path' => $avatarPath,
            'cv_path' => $cvPath,
            'bio' => $data['bio'] ?? null,
        ]);
        // Gửi email thông báo
        Mail::to($candidate->email)->send(new CandidateSubmitted($candidate));
        session()->flash('success', 'Hồ sơ đã được gửi thành công!');
        return redirect()->route('candidates.create');
    }
}
