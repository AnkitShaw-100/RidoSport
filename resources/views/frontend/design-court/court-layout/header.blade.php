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

    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('style')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div class="loadingOverlay"></div>

    <div class="container">