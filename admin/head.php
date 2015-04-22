<?php 
  ini_set('display_errors', 'ON');
  error_reporting(E_PARSE);
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin ZombieSide</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/summernote.css" rel="stylesheet">
    <link href="/css/summernote-bs3.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
      /*
       * Base structure
       */

      /* Move down content because we have a fixed navbar that is 50px tall */
      body {
        padding-top: 50px;
      }


      /*
       * Global add-ons
       */

      .sub-header {
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
      }

      /*
       * Top navigation
       * Hide default border to remove 1px line.
       */
      .navbar-fixed-top {
        border: 0;
      }

      /*
       * Sidebar
       */

      /* Hide for mobile, show later */
      .sidebar {
        display: none;
      }
      @media (min-width: 768px) {
        .sidebar {
          position: fixed;
          top: 51px;
          bottom: 0;
          left: 0;
          z-index: 1000;
          display: block;
          padding: 20px;
          overflow-x: hidden;
          overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
          background-color: #f5f5f5;
          border-right: 1px solid #eee;
        }
      }

      /* Sidebar navigation */
      .nav-sidebar {
        margin-right: -21px; /* 20px padding + 1px border */
        margin-bottom: 20px;
        margin-left: -20px;
      }
      .nav-sidebar > li > a {
        padding-right: 20px;
        padding-left: 20px;
      }
      .nav-sidebar > .active > a,
      .nav-sidebar > .active > a:hover,
      .nav-sidebar > .active > a:focus {
        color: #fff;
        background-color: #428bca;
      }


      /*
       * Main content
       */

      .main {
        padding: 20px;
      }
      @media (min-width: 768px) {
        .main {
          padding-right: 40px;
          padding-left: 40px;
        }
      }
      .main .page-header {
        margin-top: 0;
      }


      /*
       * Placeholder dashboard ideas
       */

      .placeholders {
        margin-bottom: 30px;
        text-align: center;
      }
      .placeholders h4 {
        margin-bottom: 0;
      }
      .placeholder {
        margin-bottom: 20px;
      }
      .placeholder img {
        display: inline-block;
        border-radius: 50%;
      }
    </style>
  </head>
<body>