<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Quote Details</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        td, th { padding: 8px; text-align: left; }
        .text-danger { color: red; }
        .table-primary { background-color: #f5f5f5; }
        .table-secondary { background-color: #f9f9f9; }
        .btn-close { background: none; border: none; cursor: pointer; }
        .btn-close:focus { outline: none; }
    </style>
</head>
<body>
    <table style="width:800px; margin:auto;" >
        <tr>
            <td>
                <table align="center" width="800px" border="0" cellpadding="10" cellspacing="0">
                    <tr>
                        <td style="width: 50%; vertical-align: top;">
                            <table border="0" cellpadding="5" cellspacing="0">
                                <tr>
                                    <td>
                                        <img src="{{ $details['site_logo'] }}" alt="Logo" width="200" style="display: block;">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-danger">
                                        {!! $details['qc_company_name_html'] !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ $details['site_phone'] }}<br>
                                        {{ $details['qc_booking_email'] }}<br>
                                        {{ $details['site_url'] }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 50%; vertical-align: top;">
                            <table border="1" cellpadding="5" cellspacing="0" class="table-primary">
                                <thead>
                                    <tr>
                                        <th colspan="2">Quote Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Quote Number:</td>
                                        <td>Q#{{ $details['id'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Issue Date:</td>
                                        <td>{{ date('dS M Y', strtotime($details['date'])) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Job Date:</td>
                                        <td>{{ ($details['booking_date'] != '0000-00-00') ? date('dS M Y', strtotime($details['booking_date'])) : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Amount:</td>
                                        <td>$AUD {{ number_format($details['amount'], 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            To<br>
                                            {!! $details['to'] !!}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>

                <h3>Items Details</h3>
                <table border="1" cellpadding="5" cellspacing="0" class="table-primary">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody class="table-secondary">
                        @foreach($jobDecData as $key => $jobD)
                        <tr>
                            <td><strong>{{ $key }} : </strong> {!! $jobD['desc'] !!}</td>
                            <td>{{ $jobD['amount'] }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td><strong>Total</strong></td>
                            <td>AUD {{ $details['amount'] }}</td>
                        </tr>
                    </tbody>
                </table>
              
              @if(!empty($details['oto_amt_show_text'])) 
                <p style="font-size: 12px;font-weight: 600;padding-top: 11px;color: #b01045;">{!! $details['oto_amt_show_text'] !!}</p>
              @endif

              <p style="font-size: 17px;font-weight: 600;background-color:#ffffff;">Call us on <a href="tel:{{ $details['site_phone']; }}">{{ $details['site_phone'] }}</a> to 
              Save 10% to Book these other services with us </p>


                <h3>Additional Services</h3>
                <table border="1" cellpadding="5" cellspacing="0">
                    @if(in_array(11, $checkQUotetype))
                        <tr>
                            <td style="color: red;">Bond Cleaning</td>
                            <td style="color: red;">Gardening</td>
                            <td style="color: red;">Domestic Cleaning</td>
                        </tr>
                        <tr>
                            <td>Packaging Service</td>
                            <td>Packaging Boxes</td>
                            <td>Rubbish Removal</td>
                        </tr>
                        <tr>
                            <td>Piano Moving</td>
                            <td>Pool Table Moving</td>
                            <td>Heavy Item Moving</td>
                        </tr>
                        <tr>
                            <td>Assembling</td>
                            <td>Disassembling</td>
                            <td>Removal Insurance</td>
                        </tr>
                    @else
                        <tr>
                            <td style="color: red;">Removal</td>
                            <td style="color: red;">Gardening</td>
                            <td style="color: red;">Handyman</td>
                        </tr>
                        <tr>
                            <td>Mould Cleaning</td>
                            <td>Carpet Steam Cleaning</td>
                            <td>Pest Control</td>
                        </tr>
                        <tr>
                            <td>Professional Blind Wash</td>
                            <td>Carpet Deodoriser</td>
                            <td>Wall Washing</td>
                        </tr>
                        <tr>
                            <td>Outside Window Cleaning</td>
                            <td>Rubbish Removal</td>
                            <td>Pressure Cleaning</td>
                        </tr>
                        <tr>
                            <td>Upholstery Cleaning</td>
                            <td>Grout Cleaning</td>
                            <td>Oil Stain Cleaning</td>
                        </tr>
                    @endif
                </table>

                <h3>Please Note</h3>
                @if($details['step'] == '2' || $details['step'] == '3' || $details['step'] == '4')
                <p>
                    @if($details['ssecret'] != '')
                    <a href="{{ $details['url'] }}" style="text-decoration: none; color: #000; margin-bottom: 10px; display: inline-block; border-radius: 4px;">
                        <img src="https://www.bcic.com.au/admin/images/book_online.png" alt="Book Online">
                    </a>
                    @endif
                </p>
                @endif

                <p>{!! $getemailNotes !!}</p>

                <h3>Payment Options</h3>
                <table border="1" cellpadding="5" cellspacing="0">
                    <tr>
                        <td style="width: 50%; background-color: #ebebeb;">
                            <strong>Direct Debit Details</strong>
                            <table border="0" cellpadding="5" cellspacing="0">
                                <tr>
                                    <td>Account Name:</td>
                                    <td><strong>{{ $details['qc_company_name'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td>BSB:</td>
                                    <td><strong>{{ $details['qc_bsb'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Account Number:</td>
                                    <td><strong>295683522</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Please enter your Quote Number <strong>(Q#{{ $details['id'] }})</strong> for reference</td>
                                </tr>
                            </table>
                            <p>Please make sure that you send us the paid receipt of bank transfer 2 days prior to your Booking Date.</p>
                        </td>
                        <td style="width: 50%; background-color: #ebebeb;">
                            <strong>Credit Card:</strong>
                            <p>To pay by card, please call the office number to secure your booking.</p>
                            <p><strong>Office Number:</strong> {{ $details['site_phone'] }}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
