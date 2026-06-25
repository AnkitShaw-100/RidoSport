<!DOCTYPE html>
<html>
<head>
    @stack('title')
    <link rel="stylesheet" href="{{url('court-design/assets/css/custom.css')}}"/>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{url('court-design/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{url('court-design/css/lightbox.css')}}" rel="stylesheet">
    <style>
        h1 {
            font-size: 36px;
            font-weight: 900;
            color: #fff;
            padding-bottom: 20px;
            font-family: Arial, Helvetica, sans-serif;
        }
        #outer_div{
            padding: 15px;
            width: 130%;
        }
        #colorbig p {
            font-size: 36px;
            font-family: Arial, sans-serif;
        }
        .loadingOverlay {
            display:none;
            position:fixed;
            z-index:1000;
            top: 0;
            left:0;
            height:100%;
            width:100%;
            background: rgba( 255, 255, 255, .8 );
        } 
        body{
          color: #641722;
          font-weight: 200   
        }
        #colorbig {
            position: relative;
            height: auto;
            text-align: center;
            margin: 0 auto;
        }
    
        #colorbig img {
            background: #0078be;
            width: 100%;
            height: auto; /* Maintain aspect ratio */
        }
        #colorbig{
            padding: 20px
        }
        #main_div {
            max-width: 800px; /* Limit max width */
            width: 100%; /* Full width on small screens */
            background: #a04647;
            margin: 0 auto; /* Center the div */
        }
        .header-items{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            flex-wrap: nowrap;
        }
    
        /* Flexbox to display items in a row */
        .overview {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            list-style-type: none;
            padding: 0;
            margin: 0;
            justify-content: space-evenly;
        }
    
        .overview li {
            display: flex;
            justify-content: space-between;
            width: 160px;
            align-content: center;
            flex-wrap: wrap;
            flex-direction: row;
            align-items: center;
        }
    
        .Basketball {
            display: flex;
            flex-direction: row;
            align-items: center;
            text-align: center;
            flex-wrap: nowrap;
        }
    
        .color-preview {
            display: inline-block;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }
    
        .custom-checkbox {
            margin-right: 10px;
        }
		input[type=checkbox]{
			margin: 0 5px 0 0;
			line-height: normal;
		}
        /* Optional: Make the list take up full width */
        .row {
            width: 100%;
        }        

        .error-message {
            font-size: 0.875em;
            color: red;
            margin-top: 5px;
        }

        html {
            background: #f7f8fb;
        }

        body {
            background:
                radial-gradient(circle at 6% 22%, rgba(151, 23, 54, .08) 0 2px, transparent 3px) 0 0 / 24px 24px,
                linear-gradient(180deg, #ffffff 0%, #f7f8fb 42%, #f7f8fb 100%) !important;
            color: #071126 !important;
            font-family: Arial, Helvetica, sans-serif;
            min-height: 100vh;
        }

        body > .container {
            max-width: 1180px;
            width: calc(100% - 36px);
            margin: 28px auto 70px;
            padding: 0;
        }

        body > .container > .row:first-child {
            background: linear-gradient(135deg, #071126 0%, #233e50 100%);
            border-radius: 16px;
            box-shadow: 0 18px 42px rgba(5, 10, 30, .14);
            color: #fff;
            margin: 0 0 26px;
            overflow: hidden;
            padding: 30px 36px;
            position: relative;
            text-align: left;
        }

        body > .container > .row:first-child::after {
            background: radial-gradient(circle, rgba(255, 255, 255, .13), transparent 58%);
            content: "";
            height: 220px;
            position: absolute;
            right: -80px;
            top: -90px;
            width: 260px;
        }

        body > .container > .row:first-child > a {
            display: none !important;
        }

        body > .container > .row:first-child > a::before {
            content: none;
        }

        body > .container > .row:first-child .text-center {
            position: relative;
            text-align: left !important;
            z-index: 1;
        }

        body > .container > .row:first-child h2 {
            color: #fff;
            font-size: 42px;
            font-weight: 700;
            letter-spacing: 0;
            line-height: 1.18;
            margin: 0 0 12px;
            text-align: left !important;
        }

        body > .container > .row:first-child p {
            margin: 0;
        }

        body > .container > .row:first-child u {
            background: rgba(151, 23, 54, .9);
            border-radius: 999px;
            color: #fff;
            display: inline-flex;
            font-size: 15px !important;
            font-weight: 800 !important;
            letter-spacing: .02em;
            padding: 9px 16px;
            text-decoration: none !important;
        }

        body > .container > hr {
            display: none;
        }

        .header-items {
            background: #fff;
            border: 1px solid rgba(151, 23, 54, .14);
            border-radius: 16px 16px 0 0;
            box-shadow: 0 14px 32px rgba(5, 10, 30, .06);
            gap: 18px;
            margin: 0 !important;
            padding: 20px 24px;
        }

        .header-items .col {
            flex: 1 1 auto;
        }

        .header-items p {
            color: #071126;
            font-size: 14px;
            font-weight: 800 !important;
            letter-spacing: .08em;
            margin: 0;
            text-transform: uppercase;
        }

        .header-items input[type="radio"] {
            accent-color: #971736;
            margin: 0 7px 0 0;
            transform: translateY(1px);
        }

        .header-items label {
            color: #233e50;
            font-weight: 800;
            margin: 0 16px 0 0;
        }

        #download {
            background: var(--theme-color1, #971736) !important;
            border: 0 !important;
            border-radius: 999px !important;
            box-shadow: 0 10px 22px rgba(151, 23, 54, .18);
            color: #fff !important;
            font-size: 13px;
            font-weight: 800;
            min-height: 42px;
            padding: 10px 24px !important;
            text-transform: uppercase;
        }

        #download:hover {
            background: #071126 !important;
            color: #fff !important;
        }

        body > .container > .row:nth-of-type(3) {
            background: #fff;
            border: 1px solid rgba(151, 23, 54, .14);
            border-top: 0;
            border-radius: 0 0 16px 16px;
            box-shadow: 0 18px 42px rgba(5, 10, 30, .08);
            margin: 0 0 28px !important;
            padding: 28px;
        }

        #outer_div {
            padding: 0 !important;
            width: 100% !important;
        }

        #main_div {
            background: #a04647;
            border-radius: 14px;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .2);
            margin: 0 auto !important;
            max-width: 900px !important;
            overflow: hidden;
            padding: 28px;
            width: 100% !important;
        }

        #colorbig {
            align-items: center;
            background: transparent;
            display: flex;
            justify-content: center;
            padding: 0 !important;
        }

        #colorbig img {
            border: 4px solid rgba(255, 255, 255, .92);
            border-radius: 4px;
            display: block;
            max-height: 470px;
            object-fit: contain;
            width: 100%;
        }

        body > .container > .row:has(> .col-6) {
            align-items: flex-start;
            display: flex !important;
            gap: 24px;
            justify-content: center;
            margin: 0 !important;
            width: 100%;
        }

        body > .container > .row:has(> .col-6)::before,
        body > .container > .row:has(> .col-6)::after {
            content: none !important;
            display: none !important;
        }

        .col-6 {
            background: #fff;
            border: 1px solid rgba(151, 23, 54, .14);
            border-radius: 16px;
            box-shadow: 0 14px 32px rgba(5, 10, 30, .06);
            flex: 1 1 0;
            float: none !important;
            max-width: 578px;
            min-width: 0;
            padding: 24px;
            width: 100% !important;
        }

        .col-6 > .row:first-child {
            margin: 0 0 18px;
            width: 100%;
        }

        .col-6 h4 {
            border-bottom: 1px solid rgba(151, 23, 54, .14);
            color: #071126;
            font-size: 19px;
            font-weight: 800;
            margin: 0;
            padding-bottom: 14px;
            text-decoration: none !important;
        }

        .col-6 h4 u,
        .col-6 u {
            text-decoration: none !important;
        }

        .overview {
            gap: 12px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            justify-content: stretch !important;
            width: 100%;
        }

        #pu-surface-colors[style*="display: flex"],
        #pu-border-colors[style*="display: flex"],
        #acrylic-surface-colors[style*="display: flex"],
        #acrylic-border-colors[style*="display: flex"] {
            display: grid !important;
        }

        .overview li {
            width: auto !important;
        }

        .Basketball {
            background: #fbfcff;
            border: 1px solid rgba(151, 23, 54, .1);
            border-radius: 12px;
            color: #233e50;
            justify-content: flex-start;
            min-height: 54px;
            padding: 10px 12px;
            text-align: left;
            width: 100%;
        }

        .Basketball span:last-child {
            font-size: 14px;
            font-weight: 700;
            line-height: 1.25;
        }

        .color-preview {
            border: 2px solid #fff;
            border-radius: 999px !important;
            box-shadow: 0 0 0 1px rgba(7, 17, 38, .12);
            flex: 0 0 auto;
            height: 34px !important;
            margin: 0 10px 0 0 !important;
            width: 34px !important;
        }

        .custom-checkbox {
            accent-color: #971736;
            flex: 0 0 auto;
            height: 16px;
            margin: 0 9px 0 0 !important;
            width: 16px;
        }

        .modal-content {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
        }

        .modal-header {
            background: #071126;
            color: #fff;
        }

        .modal-title {
            color: #fff;
            font-size: 18px;
            font-weight: 800;
        }

        #confirm-download {
            background: #971736;
            border: 0;
            border-radius: 999px;
            font-weight: 800;
            padding: 10px 22px;
        }

        @media (max-width: 991px) {
            body > .container > .row:has(> .col-6) {
                flex-direction: column;
            }

            .overview {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            body > .container > .row:first-child h2 {
                font-size: 34px;
            }
        }

        @media (max-width: 640px) {
            body > .container {
                width: calc(100% - 24px);
                margin-top: 18px;
            }

            body > .container > .row:first-child {
                padding: 24px 22px;
            }

            body > .container > .row:first-child h2 {
                font-size: 28px;
            }

            .header-items {
                align-items: flex-start;
                flex-direction: column;
                padding: 18px;
            }

            body > .container > .row:nth-of-type(3) {
                padding: 18px;
            }

            #main_div {
                padding: 14px;
            }

            .overview {
                grid-template-columns: 1fr;
            }
        }

        a,
        button,
        input[type="button"],
        input[type="submit"],
        input[type="reset"],
        .btn,
        [role="button"],
        [tabindex] {
            -webkit-tap-highlight-color: transparent;
        }

        a:focus,
        a:active,
        a:focus-visible,
        button:focus,
        button:active,
        button:focus-visible,
        input[type="button"]:focus,
        input[type="button"]:active,
        input[type="button"]:focus-visible,
        input[type="submit"]:focus,
        input[type="submit"]:active,
        input[type="submit"]:focus-visible,
        input[type="reset"]:focus,
        input[type="reset"]:active,
        input[type="reset"]:focus-visible,
        .btn:focus,
        .btn:active,
        .btn:focus-visible,
        [role="button"]:focus,
        [role="button"]:active,
        [role="button"]:focus-visible,
        [tabindex]:focus,
        [tabindex]:active,
        [tabindex]:focus-visible {
            outline: 0 !important;
            text-decoration: none !important;
        }

        button:focus,
        button:active,
        input[type="button"]:focus,
        input[type="button"]:active,
        input[type="submit"]:focus,
        input[type="submit"]:active,
        input[type="reset"]:focus,
        input[type="reset"]:active,
        .btn:focus,
        .btn:active,
        .btn:focus-visible {
            box-shadow: none !important;
        }

        button::-moz-focus-inner,
        input::-moz-focus-inner {
            border: 0 !important;
        }

    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('style')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div class="loadingOverlay"></div>

    <div class="container">
