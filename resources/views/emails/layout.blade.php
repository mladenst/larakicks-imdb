<!DOCTYPE html>
<html>
<head>
    <style>
        html{
            color : #4a4a4a;

        }
        .custom-container{
            margin-left : 25%;
            width : 50%;
            font-family: BlinkMacSystemFont,-apple-system,"Segoe UI",Roboto,Oxygen,Ubuntu,Cantarell,"Fira Sans","Droid Sans","Helvetica Neue",Helvetica,Arial,sans-serif !important;
            -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important; margin-left : 25%; width : 50%;  /* Safari 3-4, iOS 4.0.2 - 4.2, Android 2.3+ */
            -moz-box-shadow:    0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important; margin-left : 25%; width : 50%;  /* Firefox 3.5 - 3.6 */
            box-shadow:         0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important; margin-left : 25%; width : 50%;  /* Opera 10.5, IE 9, Firefox 4+, Chrome 6+, iOS 5 */
        }
        h1{
            color : #00d1b2 !important;
            font-size : 2rem !important;
            font-weight : 600 !important;
            line-height : 1.125 !important;
        }
        .custom-is-text-centered{
            text-align : center !important;
        }
        .custom-column{
            padding : 10px !important;
        }
        .custom-is-black{
            background-color : #3d4351 !important;
        }
        .custom-subtitle{
            color : #fff !important;
            font-size: 1.25rem !important;
            font-weight: 400 !important;
            line-height: 1.25 !important;
        }
        .custom-mb5{
            margin-bottom : 5px;
        }
        .custom-mt5{
            margin-top : 5px;
        }
        .custom-h3{
            display: block;
            font-size: 1.17em !important;
            -webkit-margin-before: 1em !important;
            -webkit-margin-after: 1em !important;
            -webkit-margin-start: 0px !important;
            -webkit-margin-end: 0px !important;
            font-weight: bold !important;
        }
        .custom-button{
            text-decoration: none !important;
            -webkit-appearance: none !important;
            border: 1px solid transparent !important;
            border-radius: 4px !important;
            display: inline-flex !important;
            line-height: 1.5 !important;
            padding-bottom: 6px !important;
            padding-left: 10px !important;
            padding-right: 10px !important;
            padding-top: 6px !important;
            background-color: #00d1b2 !important;
            color: #fff !important;
        }
        .custom-button:hover {
            background-color: #00c4a7 !important;
            border-color: transparent !important;
            color: #fff !important;
        }
        hr{
            display: block !important;
            unicode-bidi: isolate !important;
            -webkit-margin-before: 0.5em !important;
            -webkit-margin-after: 0.5em !important;
            -webkit-margin-start: auto !important;
            -webkit-margin-end: auto !important;
            overflow: hidden !important;
            border-style: inset !important;
            border-width: 1px !important;
            height: 1px !important;
        }
        h5{
            margin-bottom: 0px !important;
        }

    </style>
</head>
<body>
    <div class="custom-container">
        @yield('content')
    </div>
</body>
</html>