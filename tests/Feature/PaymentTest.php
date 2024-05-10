<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use App\Models\Movie;
use App\Models\Booking;
use App\Models\PaymentDetail;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentTest extends TestCase
{
    public function testPaymentProcess()
    {
        // Create a new user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a new booking
        $booking = Booking::factory()->create([
            'user_id' => $user->id,
            'status' => 'failed',
            'grand_total' => 100,
        ]);

        // Mock HTTP response
        Http::fake([
            'https://api.sandbox.checkout.com/payments' => Http::response([
                'approved' => true,
                'id' => 'payment_id_123',
            ], 200),
        ]);

        // Simulate payment process
        $response = $this->post(route('bookings.paymentProcess', ['booking' => $booking]), [
            'cardToken' => 'token123', // Mock card token
        ]);

        // Assert response status
        $response->assertStatus(200);

        // Assert booking and payment details were updated
        $this->assertEquals('paid', $booking->fresh()->status);

        $paymentDetail = PaymentDetail::where('booking_id', $booking->id)->first();
        $this->assertNotNull($paymentDetail);
        $this->assertEquals('paid', $paymentDetail->status);
        $this->assertEquals('payment_id_123', $paymentDetail->payment_id);
    }
}
