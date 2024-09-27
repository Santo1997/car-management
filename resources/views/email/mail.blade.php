<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            margin: 0 auto;
            padding: 5px;
            font-family: 'PT Sans', sans-serif;
        }

        @page {
            size: 2.8in 11in;
            margin-top: 0cm;
            margin-left: 0cm;
            margin-right: 0cm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        tr {
            width: 100%;
        }

        h1 {
            text-align: center;
            vertical-align: middle;
        }

        .items thead {
            text-align: center;
        }

        .center-align {
            text-align: center !important;
        }

        .left-align {
            text-align: left !important;
        }

        .bill-details td {
            font-size: 12px;
        }

        .receipt {
            font-size: medium;
        }

        .items .heading {
            font-size: 12.5px;
            text-transform: uppercase;
            border-top: 1px solid black;
            margin-bottom: 4px;
            border-bottom: 1px solid black;
            vertical-align: middle;
        }

        .items thead tr th:first-child,
        .items tbody tr td:first-child {
            width: 47%;
            min-width: 47%;
            max-width: 47%;
            word-break: break-all;
            text-align: left;
        }

        .items td {
            font-size: 12px;
            text-align: right;
            vertical-align: bottom;
        }

        .price::before {
            content: "\20B9";
            font-family: Arial;
            text-align: right;
        }

        .sum-up {
            text-align: right !important;
        }

        .total {
            font-size: 13px;
            border-top: 1px dashed black !important;
            border-bottom: 1px dashed black !important;
        }

        .total.text, .total.price {
            text-align: right;
        }

        .total.price::before {
            content: "\20B9";
        }

        p {
            padding: 1px;
            margin: 0;
        }

        section {
            font-size: 12px;
        }
    </style>
</head>

<body>

<p>Rental ID : {{$data['id']}}</p>
<table class="bill-details">
    <tbody>
    <tr>
        <td>Customer Name : <span>{{$data['user']['name']}}</span></td>
        <td>Date : <span>{{$data['created_at']}}</span></td>
    </tr>
    <tr></tr>
    <tr>
        <th class="center-align" colspan="2"><span class="receipt">Original Receipt</span></th>
    </tr>
    </tbody>
</table>

<table class="items">
    <thead>
    <tr>
        <th class="heading left-align">Selection</th>
        <th class="heading center-align">Start Date</th>
        <th class="heading center-align">End Date</th>
        <th class="heading sum-up">Amount</th>
    </tr>
    </thead>

    <tbody>
    <tr>
        <td class="left-align"> {{$data['car']['name']}} ( {{$data['car']['model']}} )</td>
        <td class="center-align">{{$data['start_date']}}</td>
        <td class="center-align">{{$data['end_date']}}</td>
        <td class="price"> {{$data['total_cost']}} </td>
    </tr>


    <tr>
        <th colspan="3" class="total text">Total</th>
        <th class="total price">{{$data['total_cost']}}</th>
    </tr>
    </tbody>
</table>
<section>
    <p>
        Paid by : <span>CASH</span>
    </p>
    <p style="text-align:center">
        Thank you for your visit!
    </p>
</section>
</body>

</html>
