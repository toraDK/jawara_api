<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentChannel\StorePaymentChannelRequest;
use App\Models\PaymentChannel;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class PaymentChannelController extends Controller
{
    /**
     * 1. GET List Payment Channels (Ringkas)
     */
    public function index(): JsonResponse
    {
        // Hanya ambil yang aktif
        $channels = PaymentChannel::where('is_active', true)
            // PERBAIKAN: Tambahkan 'qr_code' di dalam select
            ->select('id', 'channel_name', 'type', 'account_name', 'thumbnail', 'qr_code')
            ->get();

        return response()->json([
            'status' => 'success',
            'data'   => $channels
        ]);
    }

    /**
     * 2. GET Detail Payment Channel
     */
    public function show($id): JsonResponse
    {
        $channel = PaymentChannel::find($id);

        if (!$channel) {
            return response()->json(['status' => 'error', 'message' => 'Channel not found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $channel
        ]);
    }

    /**
     * 3. POST Create Payment Channel
     */
    public function store(StorePaymentChannelRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // Handle Upload Thumbnail
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('payment_channels', 'public');
        }

        // Handle Upload QR Code
        $qrCodePath = null;
        if ($request->hasFile('qr_code')) {
            $qrCodePath = $request->file('qr_code')->store('payment_qr', 'public');
        }

        // Simpan ke Database
        $channel = PaymentChannel::create([
            'channel_name'   => $validated['channel_name'],
            'type'           => $validated['type'],
            'account_number' => $validated['account_number'],
            'account_name'   => $validated['account_name'],
            'thumbnail'      => $thumbnailPath,
            'qr_code'        => $qrCodePath,
            'notes'          => $validated['notes'] ?? null,
            'is_active'      => true,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Payment channel created successfully',
            'data'    => $channel
        ], 201);
    }
}
