<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lending System</title>
    <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css"
    rel="stylesheet"
    />
    <style>
        body{
            overflow-y: hidden; /* Hide vertical scrollbar */
  overflow-x: hidden; /* Hide horizontal scrollbar */

        }
        .tableFixHead {
            overflow-y: auto; /* make the table scrollable if height is more than 200 px  */
            height: 350px; /* gives an initial height of 200px to the table */
        }

        .tablebigFixHead {
            overflow-y: auto; /* make the table scrollable if height is more than 200 px  */
            height: 800px; /* gives an initial height of 200px to the table */
        }


        .PostFix {
            overflow: hidden;
            overflow-y: auto; /* make the table scrollable if height is more than 200 px  */
            height: 840px; /* gives an initial height of 200px to the table */
        }

        .tableFixHead thead th {
            position: sticky; /* make the table heads sticky */
            top: 0px; /* table head will be placed from the top of the table and sticks to it */
        }

        
        .tablebigFixHead thead th {
            position: sticky; /* make the table heads sticky */
            top: 0px; /* table head will be placed from the top of the table and sticks to it */
        }


        table {
            border-collapse: collapse; /* make the table borders collapse to each other */
            width: 100%;
        }
        th,
        td {
            padding: 8px 16px;
            border: 1px solid #ccc;
        }
        th {
            background: #000;
        }

        ::-webkit-scrollbar {
    display: none;
    }



    </style>

</head>
<body>
    {{ $slot }}
</body>
    <!-- MDB -->
    <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"
    ></script>
</html>