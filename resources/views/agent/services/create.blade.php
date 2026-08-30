@extends('agent.master')
@push('styles')
    <style>
        .seat-grid { display: flex; flex-direction: column; align-items: center; gap: 8px; }
        .seat-row { display: flex; justify-content: center; }
        .btn-check + label.seat-btn { width: 42px; height: 38px; margin: 3px; padding: 0; display: inline-flex; align-items: center; justify-content: center; }
        .seat-gap { width: 24px; display: inline-block; }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Book Flight for Customer</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('agent.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('agent.services.index') }}">Available Services</a></li>
                            <li class="breadcrumb-item active">Book</li>
                        </ol>
                    </div>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('agent.services.store', $schedule->id) }}" id="bookingForm">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">
                                {{ $schedule->flight_number }} &middot;
                                {{ $schedule->route->originAirport->city ?? '—' }} &rarr;
                                {{ $schedule->route->destinationAirport->city ?? '—' }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-3">
                                Departure {{ $schedule->departure_time }} &middot; Arrival
                                {{ $schedule->arrival_time }} &middot; Aircraft:
                                {{ $schedule->airplane->name }} &middot; Price per seat: ৳{{ number_format((float) $schedule->price, 2) }}
                            </p>

                            <div class="mb-3">
                                <span class="badge" style="background:#e5e5e5;color:#333;">&nbsp;&nbsp;</span> Available
                                &nbsp;
                                <span class="badge bg-primary">&nbsp;&nbsp;</span> Selected
                                &nbsp;
                                <span class="badge bg-secondary">&nbsp;&nbsp;</span> Booked
                            </div>

                            <div class="seat-grid">
                                @php
                                    $rows = [];
                                    foreach ($seats as $code) {
                                        preg_match('/^(\d+)/', $code, $m);
                                        $rows[$m[1]][] = $code;
                                    }
                                    ksort($rows, SORT_NUMERIC);
                                    $leftCount = (int) ceil($schedule->airplane->seat_columns / 2);
                                @endphp
                                @foreach ($rows as $rowSeats)
                                    <div class="seat-row">
                                        @foreach ($rowSeats as $i => $code)
                                            @if ($i === $leftCount)
                                                <span class="seat-gap"></span>
                                            @endif
                                            @php $isBooked = in_array($code, $bookedSeats); @endphp
                                            <input type="checkbox" class="btn-check seat-checkbox" name="seats[]"
                                                value="{{ $code }}" id="seat_{{ $code }}"
                                                {{ $isBooked ? 'disabled' : '' }} autocomplete="off">
                                            <label class="btn {{ $isBooked ? 'btn-secondary' : 'btn-outline-secondary' }} btn-sm seat-btn"
                                                for="seat_{{ $code }}">{{ $code }}</label>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div><!--end card-->
                </div><!--end col-->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Customer Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Customer Email</label>
                                <input type="email" name="customer_email" class="form-control"
                                    value="{{ old('customer_email') }}" required>
                                <small class="text-muted">If this email has no account, a new customer account is
                                    created automatically.</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Passenger Full Name</label>
                                <input type="text" name="passenger_name" class="form-control"
                                    value="{{ old('passenger_name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Passenger Phone</label>
                                <input type="text" name="passenger_phone" class="form-control"
                                    value="{{ old('passenger_phone') }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Payment Method</label>
                                <select name="payment_method" class="form-select" required>
                                    <option value="cash_on_counter">Cash at counter</option>
                                    <option value="bkash">bKash</option>
                                    <option value="card">Credit / Debit card</option>
                                </select>
                            </div>

                            <hr>
                            <p class="mb-1">Selected seats: <strong id="selectedSeatsText">none</strong></p>
                            <p class="mb-3">Total: <strong id="totalPriceText">৳0.00</strong></p>

                            <button type="submit" class="btn btn-primary w-100" id="submitBtn" disabled>Confirm
                                Booking</button>
                        </div>
                    </div><!--end card-->
                </div><!--end col-->
            </div><!--end row-->
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        (function () {
            const price = {{ (float) $schedule->price }};
            const checkboxes = document.querySelectorAll('.seat-checkbox');
            const selectedText = document.getElementById('selectedSeatsText');
            const totalText = document.getElementById('totalPriceText');
            const submitBtn = document.getElementById('submitBtn');

            function update() {
                const selected = Array.from(checkboxes).filter(c => c.checked).map(c => c.value);
                selectedText.textContent = selected.length ? selected.join(', ') : 'none';
                totalText.textContent = '৳' + (price * selected.length).toFixed(2);
                submitBtn.disabled = selected.length === 0;
            }

            checkboxes.forEach(c => c.addEventListener('change', update));
            update();
        })();
    </script>
@endpush
