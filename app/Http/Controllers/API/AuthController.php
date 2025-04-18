<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BusinessAdmin;
use App\Models\Guardian;
use App\Models\SchoolAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required',
            'user_type' => 'required|in:school,guardian,business',
            'device_name' => 'required',
        ]);

        $user = match ($request->user_type) {
            'school' => SchoolAdmin::where('phone', $request->phone)->first(),
            'guardian' => Guardian::where('phone', $request->phone)->first(),
            'business' => BusinessAdmin::where('phone', $request->phone)->first(),
        };

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'phone' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user->tokens()->where('name', $request->device_name)->delete();

        $token = $user->createToken($request->device_name, [$request->user_type]);

        return response()->json([
            'token' => $token->plainTextToken,
            'user' => $user,
            'user_type' => $request->user_type,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        $userType = $user->tokens->first()->abilities[0] ?? null;

        return response()->json([
            'user' => $user,
            'user_type' => $userType
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();
        $userType = $user->tokens->first()->abilities[0] ?? null;

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|unique:' . $userType . '_admins,phone,' . $user->id,
        ]);

        $user->update($request->only([
            'first_name',
            'last_name',
            'phone',
        ]));

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The provided password is incorrect.'],
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Revoke all tokens
        $user->tokens()->delete();

        return response()->json([
            'message' => 'Password changed successfully. Please login again.'
        ]);
    }

    public function revokeAllTokens(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'All devices have been logged out'
        ]);
    }

    public function refreshToken(Request $request)
    {
        $user = $request->user();
        $userType = $user->tokens->first()->abilities[0] ?? null;
        
        // Create new token
        $newToken = $user->createToken($request->device_name ?? 'refresh_token', [$userType]);
        
        // Delete current token
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'token' => $newToken->plainTextToken,
        ]);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'user_type' => 'required|in:school,guardian,business',
        ]);

        $user = match ($request->user_type) {
            'school' => SchoolAdmin::where('phone', $request->phone)->first(),
            'guardian' => Guardian::where('phone', $request->phone)->first(),
            'business' => BusinessAdmin::where('phone', $request->phone)->first(),
        };

        if (!$user) {
            throw ValidationException::withMessages([
                'phone' => ['No account found with this phone number.'],
            ]);
        }

        // Generate OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Store OTP in cache for 5 minutes
        Cache::put(
            "password_reset_{$request->user_type}_{$request->phone}",
            $otp,
            now()->addMinutes(5)
        );

        // TODO: Send OTP via SMS
        // You'll need to implement your SMS service here

        return response()->json([
            'message' => 'Reset code has been sent to your phone number.',
            'expires_in' => 300 // 5 minutes in seconds
        ]);
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'user_type' => 'required|in:school,guardian,business',
            'otp' => 'required|string|size:6',
        ]);

        $cachedOTP = Cache::get("password_reset_{$request->user_type}_{$request->phone}");

        if (!$cachedOTP || $cachedOTP !== $request->otp) {
            throw ValidationException::withMessages([
                'otp' => ['The verification code is invalid or has expired.'],
            ]);
        }

        // Generate reset token
        $resetToken = Str::random(60);
        Cache::put(
            "reset_token_{$request->user_type}_{$request->phone}",
            $resetToken,
            now()->addMinutes(10)
        );

        return response()->json([
            'reset_token' => $resetToken,
            'expires_in' => 600 // 10 minutes in seconds
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'user_type' => 'required|in:school,guardian,business',
            'reset_token' => 'required|string',
            'password' => 'required|min:8|confirmed',
        ]);

        $cachedToken = Cache::get("reset_token_{$request->user_type}_{$request->phone}");

        if (!$cachedToken || $cachedToken !== $request->reset_token) {
            throw ValidationException::withMessages([
                'reset_token' => ['The reset token is invalid or has expired.'],
            ]);
        }

        $user = match ($request->user_type) {
            'school' => SchoolAdmin::where('phone', $request->phone)->first(),
            'guardian' => Guardian::where('phone', $request->phone)->first(),
            'business' => BusinessAdmin::where('phone', $request->phone)->first(),
        };

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Clear all reset tokens and OTPs
        Cache::forget("password_reset_{$request->user_type}_{$request->phone}");
        Cache::forget("reset_token_{$request->user_type}_{$request->phone}");
        
        // Revoke all tokens
        $user->tokens()->delete();

        return response()->json([
            'message' => 'Password has been reset successfully. Please login with your new password.'
        ]);
    }
}
