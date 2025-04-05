<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Invoices</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 0;
            font-size: 14px;
            background: white;
            transition: all 0.3s ease;
        }

        body.rtl {
            direction: rtl;
            font-family: 'Cairo', 'Segoe UI', Tahoma, sans-serif;
        }

        .creditnote-container {
            background: white;
            padding: 30px;
            box-sizing: border-box;
            max-width: 800px;
            margin: 0 auto 30px auto;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .creditnote-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .header {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #d5d5d5;
        }

        .headerWrapper {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .creditnote-title-section {
            align-items: center;
            gap: 15px;
        }

        .company-logo {
            height: 70px;
            width: auto;
        }

        .creditnote-title {
            font-size: 26px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .creditnote-number {
            font-size: 15px;
            color: #7f8c8d;
        }

        .details-section {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 17px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 1px solid #f1f1f1;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 12px;
            margin-bottom: 10px;
        }

        body.rtl .details-grid {
            grid-template-columns: 1fr 500px;
        }

        .details-label {
            font-weight: 600;
            color: #555;
        }

        .details-value {
            padding: 2px 0;
        }

        .amount-display {
            font-size: 20px;
            font-weight: 700;
            margin: 25px 0;
            text-align: right;
            padding: 15px;
            background-color: #efefef;
            margin-bottom: 0;
            /* padding-bottom: 0; */
        }

        body.rtl .amount-display {
            text-align: left;
        }

        h3.creditnoteTitle {
            padding: 0;
            margin: 15px 0 5px 0;
            font-size: 22px;
        }

        h3.comPanyName {
            padding: 0;
            margin: 0 0 5px 0;
            font-size: 22px;
        }

        .addressLine {
            margin: 0;
            margin-top: 5px;
        }



        .toggle-layout {
            position: fixed;
            bottom: 20px;
            padding: 12px 18px;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            z-index: 1000;
            font-size: 16px;
        }

        .no-print {
            right: 20px;
        }

        .toggle-layout {
            right: 120px;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
        }

        .signature-box {
            width: 45%;
            text-align: center;
            padding: 5px;
        }

        .signature-image {
            height: 85px;
        }

        .signature-line {
            border-top: 1px solid #333;
            font-weight: 600;
        }

        .signature-value {
            min-height: 40px;
            margin-top: 10px;
            word-break: break-all;
            padding-top: 25px;
            font-size: 15px;
        }

        .footer-notes {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px dashed #ddd;
            font-size: 12px;
            color: #777;
            line-height: 1.6;
            text-align: center;
        }

        .bill-to {
            margin-bottom: 30px;
            padding: 15px;
            background-color: #efefef;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .items-table th,
        .items-table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .items-table th {
            font-weight: bold;
        }

        body.rtl .items-table th,
        body.rtl .items-table td {
            text-align: right;
        }

        .items-table .description {
            padding-bottom: 5px;
        }

        .items-table .subtext {
            font-size: 12px;
            color: #777;
            display: block;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            body {
                background: white;
                padding: 0;
                margin: 0;
            }

            .creditnote-container {
                height: 277mm;
                width: 100%;
                padding: 15mm;
                margin: 0 auto 10mm auto;
                position: relative;
            }

            .no-print,
            .toggle-layout {
                display: none;
            }

            html,
            body {
                width: 210mm;
                height: 297mm;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
    @foreach ($forms as $form)
        <div class="creditnote-container">
            <div class="creditnote-content">
                <div>
                    <div class="header">
                        <div class="headerWrapper">
                            <div class="creditnote-title-section">
                                <h3 class="creditnoteTitle" data-en="INVOICE ID: {{ $form->invoice_id }}"
                                    data-ar="رقم الفاتورة: {{ $form->invoice_id }}">INVOICE ID: {{ $form->invoice_id }}
                                </h3>
                            </div>
                            <img src="{{ asset('assets/logo.png') }}" alt="Company Logo" class="company-logo" />
                        </div>
                        <h3 class="creditnoteTitle comPanyName"
                            data-en="Technical Support Secure Websites & Electronic Accounts"
                            data-ar="الدعم الفني لتأمين المواقع والحسابات الإلكترونية">
                            Technical Support Secure Websites & Electronic Accounts
                        </h3>
                    </div>

                    <div class="bill-to">
                        <div class="section-title" data-en="BILL TO" data-ar="فاتورة إلى">BILL TO</div>
                        <div class="details-grid">
                            <div class="details-label" data-en="Customer:" data-ar="العميل:">Customer:</div>
                            <div class="details-value">{{ $form->customer_name }}</div>

                            <div class="details-label" data-en="Address:" data-ar="العنوان:">Address:</div>
                            <div class="details-value">
                                {{ $form->address_line_1 . ' ' }}
                                {{ $form->address_city }}, {{ $form->address_country }}
                            </div>

                            <div class="details-label" data-en="Phone:" data-ar="الهاتف:">Phone:</div>
                            <div class="details-value">{{ $form->phone_number }}</div>
                            <div class="details-label" data-en="E-Signature:" data-ar="التوقيع الإلكتروني:">E-Signature:
                            </div>
                            <div class="details-value">{{ $form->electronic_signature }}</div>
                        </div>
                    </div>


                    <div class="details-grid" style="margin-bottom: 10px">
                        <div>
                            <div class="details-label" data-en="Date Issued:" data-ar="تاريخ الإصدار:">Date Issued:
                            </div>
                            <div class="details-value">
                                {{ \Carbon\Carbon::parse($form->service_submission_date)->format('F j, Y') }}</div>
                        </div>
                    </div>

                    <div class="section-title" data-en="SERVICE DESCRIPTION" data-ar="وصف الخدمة">SERVICE DESCRIPTION
                    </div>
                    <table class="items-table">
                        <thead>
                            <tr>
                                <th data-en="TYPE" data-ar="النوع">TYPE</th>
                                <th data-en="ELECTRONIC ACCOUNT" data-ar="الحساب الإلكتروني">ELECTRONIC ACCOUNT</th>
                                <th data-en="AGREED TO TERMS" data-ar="الموافقة على الشروط">AGREED TO TERMS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="description">{{ $form->type }}</td>
                                <td>{{ $form->electronic_account_name }}</td>
                                <td>{{ ucfirst($form->agreed_to_terms) }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="amount-display">
                        <span data-en="TOTAL :" data-ar="المجموع :">TOTAL :</span>
                        {{ number_format($form->amount_previously_paid, 2) }}
                    </div>
                    <p class="addressLine" data-en="United Arab Emirates - Sharjah PO Box no 35000"
                        data-ar="الإمارات العربية المتحدة - الشارقة - ص ب ٣٥٠٠٠">
                        United Arab Emirates - Sharjah PO Box no 35000
                    </p>
                    @if ($form->comments)
                        <div class="" style="margin-top: 10px; margin-bottom: 10px">
                            <div>
                                <div class="details-label" data-en="Comment:" data-ar="تعليق:">Comment:</div>
                                <div class="details-value">{{ $form->comments }}</div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="signature-section">
                    <div></div>
                    <div class="signature-box">
                        <img src="{{ asset('images/signature/' . Auth::user()->signature) }}" alt="Signature"
                            class="signature-image" />
                        <div class="signature-line" data-en="Authorized Signature" data-ar="التوقيع المعتمد">
                            Authorized Signature
                        </div>
                    </div>
                </div>

                <div>
                    <div class="footer-notes">
                        <p data-en="Thank you for your business. This invoice reflects the transaction details mentioned above."
                            data-ar="شكرًا لتعاملكم معنا. تعكس هذه الفاتورة تفاصيل المعاملة المذكورة أعلاه.">
                            Thank you for your business. This invoice reflects the transaction details mentioned above.
                        </p>

                        <p data-en="For any questions or concerns, please contact our customer support at admin@uaesos.com or +971562002001."
                            data-ar="لأية أسئلة أو استفسارات، يرجى التواصل مع دعم العملاء على admin@uaesos.com أو +971562002001.">
                            For any questions or concerns, please contact our customer support at admin@uaesos.com or
                            +971562002001.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="toggle-layout no-print" style="display: flex; gap: 10px; right: 20px;">
        <button onclick="window.print()"
            style="background-color: #4CAF50; color: white; border: none; border-radius: 4px; padding: 10px 15px; cursor: pointer; font-size: 14px; transition: background-color 0.3s;">Print
            Invoices</button>
        <button onclick="toggleLayout()"
            style="background-color: #2196F3; color: white; border: none; border-radius: 4px; padding: 10px 15px; cursor: pointer; font-size: 14px; transition: background-color 0.3s;">Change
            Language</button>
    </div>
    <script>
        function toggleLayout() {
            const body = document.body;
            const isRTL = body.classList.toggle('rtl');
            const elements = document.querySelectorAll('[data-en][data-ar]');
            const toggleBtn = document.querySelector('.toggle-btn');

            elements.forEach(element => {
                element.textContent = isRTL ? element.dataset.ar : element.dataset.en;
            });

            toggleBtn.textContent = isRTL ? 'Change Language' : 'Change Language';
        }

        window.onafterprint = function() {
            setTimeout(function() {
                // window.close();
            }, 500);
        };
    </script>
</body>

</html>
