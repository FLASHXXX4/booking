<x-app-layout>
    <div class="bg-gradient-to-br from-blue-50 to-white py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Complete Your Payment</h1>
            <p class="text-gray-600">Review your booking details and proceed to payment</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Booking Summary -->
            <div class="lg:col-span-2">
                <div class="bg-white border border-gray-200 rounded-xl p-6 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Booking Summary</h2>
                    
                    <!-- Hotel Info -->
                    <div class="flex items-start gap-4 mb-6 pb-6 border-b border-gray-200">
                        @if($hotel->image)
                        <img src="{{ $hotel->image }}" alt="{{ $hotel->name }}" class="w-24 h-24 object-cover rounded-lg">
                        @endif
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $hotel->name }}</h3>
                            <p class="text-gray-600 mb-2">{{ $hotel->city }}</p>
                            <p class="text-sm text-gray-500">{{ $hotel->address }}</p>
                        </div>
                    </div>

                    <!-- Booking Details -->
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Check-in</span>
                            <span class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($booking['check_in'])->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Check-out</span>
                            <span class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($booking['check_out'])->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Number of Nights</span>
                            <span class="font-semibold text-gray-900">{{ $booking['nights'] }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Guests</span>
                            <span class="font-semibold text-gray-900">{{ $booking['guests'] }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                            <span class="text-lg font-semibold text-gray-900">Total Amount</span>
                            <span class="text-2xl font-bold text-blue-600">${{ number_format($booking['total_price'], 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Form -->
            <div class="lg:col-span-1">
                <div class="bg-white border-2 border-gray-200 rounded-xl p-6 sticky top-24">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Payment Method</h2>
                    
                    <form method="POST" action="{{ route('payment.process', $hotel) }}" id="payment-form">
                        @csrf
                        
                        <!-- Payment Method Selection -->
                        <div class="space-y-4 mb-6">
                            <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 transition payment-method-option" data-method="card">
                                <input type="radio" name="payment_method" value="card" id="payment_card" class="mr-3 payment-radio" checked required>
                                <div class="flex-1">
                                    <div class="font-semibold text-gray-900">Credit/Debit Card</div>
                                    <div class="text-sm text-gray-500">Pay securely with card</div>
                                </div>
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                            </label>
                            
                            <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 transition payment-method-option" data-method="cash">
                                <input type="radio" name="payment_method" value="cash" id="payment_cash" class="mr-3 payment-radio" required>
                                <div class="flex-1">
                                    <div class="font-semibold text-gray-900">Pay at Hotel</div>
                                    <div class="text-sm text-gray-500">Pay when you arrive</div>
                                </div>
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </label>
                        </div>

                        @error('payment_method')
                        <p class="text-sm text-red-600 mb-4">{{ $message }}</p>
                        @enderror

                        <!-- Credit Card Form (shown when card is selected) -->
                        <div id="card-form" class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <h3 class="text-sm font-semibold text-gray-900 mb-4">Card Information</h3>
                            
                            <div class="space-y-4">
                                <!-- Card Number -->
                                <div>
                                    <label for="card_number" class="block text-sm font-medium text-gray-700 mb-2">
                                        Card Number
                                    </label>
                                    <input 
                                        type="text" 
                                        id="card_number" 
                                        name="card_number" 
                                        placeholder="1234 5678 9012 3456"
                                        maxlength="19"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                    >
                                    @error('card_number')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Cardholder Name -->
                                <div>
                                    <label for="card_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Cardholder Name
                                    </label>
                                    <input 
                                        type="text" 
                                        id="card_name" 
                                        name="card_name" 
                                        placeholder="John Doe"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                    >
                                    @error('card_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Expiry and CVV -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="card_expiry" class="block text-sm font-medium text-gray-700 mb-2">
                                            Expiry Date
                                        </label>
                                        <input 
                                            type="text" 
                                            id="card_expiry" 
                                            name="card_expiry" 
                                            placeholder="MM/YY"
                                            maxlength="5"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                        >
                                        @error('card_expiry')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="card_cvv" class="block text-sm font-medium text-gray-700 mb-2">
                                            CVV
                                        </label>
                                        <input 
                                            type="text" 
                                            id="card_cvv" 
                                            name="card_cvv" 
                                            placeholder="123"
                                            maxlength="4"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                        >
                                        @error('card_cvv')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Security Note -->
                                <div class="flex items-start gap-2 pt-2">
                                    <svg class="w-5 h-5 text-green-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    <p class="text-xs text-gray-500">Your payment information is secure and encrypted</p>
                                </div>
                            </div>
                        </div>

                        <!-- Total -->
                        <div class="border-t border-gray-200 pt-4 mb-6">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="text-gray-900">${{ number_format($booking['total_price'], 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center text-lg font-bold">
                                <span>Total</span>
                                <span class="text-blue-600">${{ number_format($booking['total_price'], 2) }}</span>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" id="submit-payment" class="w-full px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg transition transform hover:scale-105">
                            Complete Payment
                        </button>

                        <p class="text-xs text-gray-500 text-center mt-4">
                            By completing this payment, you agree to our terms and conditions
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Get fresh CSRF token from meta tag
        function updateCsrfToken() {
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (token) {
                const csrfInput = document.querySelector('input[name="_token"]');
                if (csrfInput) {
                    csrfInput.value = token;
                }
            }
        }

        // Show/hide card form based on payment method selection
        document.addEventListener('DOMContentLoaded', function() {
            const cardForm = document.getElementById('card-form');
            const paymentRadios = document.querySelectorAll('.payment-radio');
            
            function toggleCardForm() {
                const selectedMethod = document.querySelector('input[name="payment_method"]:checked').value;
                if (selectedMethod === 'card') {
                    cardForm.style.display = 'block';
                    // Make card fields required
                    document.getElementById('card_number').required = true;
                    document.getElementById('card_name').required = true;
                    document.getElementById('card_expiry').required = true;
                    document.getElementById('card_cvv').required = true;
                } else {
                    cardForm.style.display = 'none';
                    // Remove required from card fields
                    document.getElementById('card_number').required = false;
                    document.getElementById('card_name').required = false;
                    document.getElementById('card_expiry').required = false;
                    document.getElementById('card_cvv').required = false;
                }
            }
            
            // Add event listeners
            paymentRadios.forEach(radio => {
                radio.addEventListener('change', toggleCardForm);
            });
            
            // Initial state
            toggleCardForm();
            
            // Format card number with spaces
            const cardNumberInput = document.getElementById('card_number');
            cardNumberInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\s/g, '');
                let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
                e.target.value = formattedValue;
            });
            
            // Format expiry date
            const cardExpiryInput = document.getElementById('card_expiry');
            cardExpiryInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length >= 2) {
                    value = value.substring(0, 2) + '/' + value.substring(2, 4);
                }
                e.target.value = value;
            });
            
            // Only allow numbers for CVV
            const cardCvvInput = document.getElementById('card_cvv');
            cardCvvInput.addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/\D/g, '');
            });
            
            // Update CSRF token on page load
            updateCsrfToken();
            
            // Handle form submission
            const paymentForm = document.getElementById('payment-form');
            paymentForm.addEventListener('submit', function(e) {
                // Ensure CSRF token is up to date
                updateCsrfToken();
            });
        });
    </script>
</x-app-layout>

