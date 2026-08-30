<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>E-Ticket {{ $booking['pnr'] }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 13px; color: #222; }
        .ticket { border: 2px solid #1f2a44; border-radius: 8px; padding: 24px; }
        .header { display: flex; justify-content: space-between; border-bottom: 2px dashed #1f2a44; padding-bottom: 12px; margin-bottom: 16px; }
        .header h1 { font-size: 20px; margin: 0; color: #1f2a44; }
        .pnr { font-size: 22px; font-weight: bold; letter-spacing: 2px; color: #d4a017; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
        table td { padding: 6px 4px; vertical-align: top; }
        .label { color: #666; font-size: 11px; text-transform: uppercase; }
        .value { font-size: 15px; font-weight: bold; }
        .route { font-size: 18px; font-weight: bold; margin: 10px 0; }
        .footer-note { margin-top: 20px; font-size: 11px; color: #777; border-top: 1px solid #ddd; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="header">
            <h1>Air Ticketing System<br><span style="font-size:12px;font-weight:normal;">Electronic Ticket / Boarding Confirmation</span></h1>
            <div class="pnr">{{ $booking['pnr'] }}</div>
        </div>

        <table>
            <tr>
                <td width="50%">
                    <div class="label">Passenger</div>
                    <div class="value">{{ $booking['passenger_name'] }}</div>
                </td>
                <td width="50%">
                    <div class="label">Contact</div>
                    <div class="value">{{ $booking['passenger_email'] }} / {{ $booking['passenger_phone'] }}</div>
                </td>
            </tr>
        </table>

        <div class="route">
            {{ $booking['schedule']['origin']['city'] }} ({{ $booking['schedule']['origin']['code'] }})
            &rarr;
            {{ $booking['schedule']['destination']['city'] }} ({{ $booking['schedule']['destination']['code'] }})
        </div>

        <table>
            <tr>
                <td width="25%">
                    <div class="label">Flight No.</div>
                    <div class="value">{{ $booking['schedule']['flight_number'] }}</div>
                </td>
                <td width="25%">
                    <div class="label">Airline</div>
                    <div class="value">{{ $booking['schedule']['airline'] ?? '—' }}</div>
                </td>
                <td width="25%">
                    <div class="label">Departure</div>
                    <div class="value">{{ $booking['schedule']['departure_time'] }}</div>
                </td>
                <td width="25%">
                    <div class="label">Arrival</div>
                    <div class="value">{{ $booking['schedule']['arrival_time'] }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="label">Aircraft</div>
                    <div class="value">{{ $booking['schedule']['airplane'] ?? '—' }}</div>
                </td>
                <td>
                    <div class="label">Seats</div>
                    <div class="value">{{ implode(', ', $booking['seats']) }}</div>
                </td>
                <td>
                    <div class="label">Payment</div>
                    <div class="value">{{ ucfirst(str_replace('_', ' ', $booking['payment_method'])) }}</div>
                </td>
                <td>
                    <div class="label">Total Paid</div>
                    <div class="value">৳{{ number_format($booking['total_amount'], 2) }}</div>
                </td>
            </tr>
        </table>

        <div class="footer-note">
            Booked on {{ $booking['booked_at'] }}. Please carry a valid photo ID matching the passenger name
            above along with this ticket at the airport. This is a system-generated document and does not
            require a signature.
        </div>
    </div>
</body>
</html>
