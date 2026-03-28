<?php

declare(strict_types=1);

namespace App\Http\Controllers\Fund;

use App\Helpers\TenantContext;
use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $members = collect();
        $tenant = TenantContext::get();

        if ($tenant) {
            $query = Member::where('tenant_id', $tenant->id);

            if ($request->search) {
                $query->where(function ($q) use ($request) {
                    $q->where('first_name', 'like', "%{$request->search}%")
                        ->orWhere('last_name', 'like', "%{$request->search}%")
                        ->orWhere('member_code', 'like', "%{$request->search}%")
                        ->orWhere('phone', 'like', "%{$request->search}%");
                });
            }

            if ($request->status) {
                $query->where('status', $request->status);
            }

            $members = $query->orderBy('member_code')->paginate(20);
        }

        return view('fund.members.index', compact('members'));
    }

    public function create()
    {
        return view('fund.members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:20',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'national_id' => 'nullable|string|size:13',
            'phone' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string|max:1000',
            'occupation' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:5120',
        ], [
            'first_name.required' => 'กรุณากรอกชื่อ',
            'last_name.required' => 'กรุณากรอกนามสกุล',
            'national_id.size' => 'เลขบัตรประชาชนต้อง 13 หลัก',
            'photo.image' => 'ไฟล์ต้องเป็นรูปภาพ',
            'photo.max' => 'รูปภาพต้องไม่เกิน 5MB',
        ]);

        $tenant = TenantContext::get();
        if (! $tenant) {
            return back()->with('error', 'ไม่พบข้อมูลกองทุน');
        }

        // Generate member code
        $lastMember = Member::withoutGlobalScopes()
            ->where('tenant_id', $tenant->id)
            ->orderByDesc('member_code')
            ->first();
        $lastNum = $lastMember ? (int) str_replace('M-', '', $lastMember->member_code) : 0;
        $memberCode = 'M-'.str_pad((string) ($lastNum + 1), 3, '0', STR_PAD_LEFT);

        // Handle photo upload and convert to webp
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $this->uploadAsWebp($request->file('photo'), "members/{$tenant->id}");
        }

        // Encrypt national ID for PDPA compliance
        $nationalIdEncrypted = null;
        if ($validated['national_id'] ?? null) {
            $nationalIdEncrypted = encrypt($validated['national_id']);
        }

        Member::create([
            'tenant_id' => $tenant->id,
            'member_code' => $memberCode,
            'title' => $validated['title'] ?? null,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'national_id_encrypted' => $nationalIdEncrypted,
            'phone' => $validated['phone'] ?? null,
            'birth_date' => $validated['birth_date'] ?? null,
            'address' => $validated['address'] ?? null,
            'occupation' => $validated['occupation'] ?? null,
            'photo_path' => $photoPath,
            'joined_date' => now()->toDateString(),
            'status' => 'active',
        ]);

        return redirect()->route('fund.members.index')
            ->with('success', "เพิ่มสมาชิก {$validated['first_name']} {$validated['last_name']} เรียบร้อยแล้ว");
    }

    public function show(int $id)
    {
        $member = Member::findOrFail($id);

        return view('fund.members.show', compact('member'));
    }

    public function edit(int $id)
    {
        $member = Member::findOrFail($id);

        return view('fund.members.edit', compact('member'));
    }

    public function update(Request $request, int $id)
    {
        $member = Member::findOrFail($id);

        $validated = $request->validate([
            'title' => 'nullable|string|max:20',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string|max:1000',
            'occupation' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:5120',
            'status' => 'nullable|in:active,inactive,suspended,resigned',
        ], [
            'first_name.required' => 'กรุณากรอกชื่อ',
            'last_name.required' => 'กรุณากรอกนามสกุล',
            'photo.image' => 'ไฟล์ต้องเป็นรูปภาพ',
            'photo.max' => 'รูปภาพต้องไม่เกิน 5MB',
        ]);

        $updateData = collect($validated)->except(['photo'])->toArray();

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($member->photo_path) {
                Storage::disk('public')->delete($member->photo_path);
            }
            $tenant = TenantContext::get();
            $updateData['photo_path'] = $this->uploadAsWebp(
                $request->file('photo'),
                'members/'.($tenant?->id ?? 0)
            );
        }

        $member->update($updateData);

        return redirect()->route('fund.members.index')
            ->with('success', "อัพเดทข้อมูล {$member->first_name} {$member->last_name} เรียบร้อยแล้ว");
    }

    /**
     * Upload image and convert to webp format.
     */
    private function uploadAsWebp(UploadedFile $file, string $folder): string
    {
        $filename = uniqid().'.webp';
        $path = "{$folder}/{$filename}";

        // Convert to webp using GD
        $image = match ($file->getMimeType()) {
            'image/jpeg' => imagecreatefromjpeg($file->getPathname()),
            'image/png' => imagecreatefrompng($file->getPathname()),
            'image/gif' => imagecreatefromgif($file->getPathname()),
            'image/webp' => imagecreatefromwebp($file->getPathname()),
            default => imagecreatefromjpeg($file->getPathname()),
        };

        if ($image === false) {
            // Fallback: store original file
            return $file->store($folder, 'public');
        }

        // Resize if too large (max 800px width)
        $width = imagesx($image);
        $height = imagesy($image);
        if ($width > 800) {
            $newWidth = 800;
            $newHeight = (int) ($height * (800 / $width));
            $resized = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($resized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            imagedestroy($image);
            $image = $resized;
        }

        // Save as webp
        $fullPath = storage_path("app/public/{$path}");
        $dir = dirname($fullPath);
        if (! is_dir($dir)) {
            mkdir($dir, 0775, true);
        }
        imagewebp($image, $fullPath, 85);
        imagedestroy($image);

        return $path;
    }
}
