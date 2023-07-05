<!DOCTYPE html>
<html lang="pt-BR">
<head>

    <title>Mercadinho</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="assets/fonts/flaticon/font/flaticon.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" >
	
       <!-- Custom Stylesheet -->

    <link type="text/css" rel="stylesheet" href="assets/css/style.css">
    <script type="text/javascript" src="funcs.js"></script>
    <script>
    function updateIndicator() {
      document.getElementById('indicator').textContent = navigator.onLine ? CloseModal() :  OpenBootstrapPopup();
    }
    </script>
    <style>
      .container2 {

height: 640px;
width: 100%;
overflow-y: scroll;
overflow-x: hidden;
}

.embaixo{
  position: absolute;
  left: 5%;
  bottom: 20px;
  width: 90%;
}

.container2 .card{
  padding-bottom: 40px;
}
    </style>
</head>

<body id="top" onload="updateIndicator()" ononline="updateIndicator()" onoffline="updateIndicator()">
