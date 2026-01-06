# Payment Integration Setup

## Current Implementation

The payment system is currently set up with a basic payment method selection (Card or Pay at Hotel). For production use, you'll need to integrate a real payment gateway.

## Payment Flow

1. User fills booking form on hotel page
2. Booking data is stored in session
3. User is redirected to payment page
4. User selects payment method and completes payment
5. Reservation is created with payment status
6. User is redirected to reservations page

## Database Changes

Run the migration to add payment fields:
```bash
php artisan migrate
```

This adds:
- `payment_status` - Status of payment (pending, paid, failed)
- `payment_intent_id` - Payment gateway transaction ID
- `payment_method` - Payment method used (card, cash, etc.)
- `paid_at` - Timestamp when payment was completed

## Stripe Integration (Recommended for Production)

### Step 1: Install Stripe PHP SDK
```bash
composer require stripe/stripe-php
```

### Step 2: Add Stripe Keys to .env
```env
STRIPE_KEY=pk_test_your_publishable_key
STRIPE_SECRET=sk_test_your_secret_key
STRIPE_WEBHOOK_SECRET=whsec_your_webhook_secret
```

### Step 3: Update Payment Controller

In `ReservationController::processPayment()`, replace the demo code with:

```php
use Stripe\Stripe;
use Stripe\PaymentIntent;

// Set your secret key
Stripe::setApiKey(config('services.stripe.secret'));

// Create payment intent
$paymentIntent = PaymentIntent::create([
    'amount' => (int)($bookingData['total_price'] * 100), // Convert to cents
    'currency' => 'usd',
    'payment_method' => $request->payment_method_id,
    'confirm' => true,
    'return_url' => route('payment.success'),
]);

// Create reservation with payment details
$reservation = Reservation::create([
    // ... other fields
    'payment_status' => $paymentIntent->status === 'succeeded' ? 'paid' : 'pending',
    'payment_intent_id' => $paymentIntent->id,
    'payment_method' => 'card',
    'paid_at' => $paymentIntent->status === 'succeeded' ? now() : null,
]);
```

### Step 4: Add Stripe.js to Payment View

Add to `resources/views/payment/show.blade.php`:

```html
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ config('services.stripe.key') }}');
    // Add Stripe Elements for card input
</script>
```

## Alternative Payment Methods

- **PayPal**: Use `laravel/paypal` package
- **Square**: Use Square Payment API
- **Cash on Delivery**: Already implemented as "Pay at Hotel"

## Testing

For testing without real payments:
- Use Stripe test mode with test cards
- Test card: `4242 4242 4242 4242`
- Any future expiry date and CVC

## Security Notes

- Never store full card numbers
- Use HTTPS in production
- Validate all payment data server-side
- Implement webhook handlers for payment status updates
- Log all payment transactions

