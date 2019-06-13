<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link href="/mvc/public/styles/global.css" rel="stylesheet" type="text/css">

    <link href="/mvc/public/styles/pages/index.css" rel="stylesheet" type="text/css">
    <link href="/mvc/public/styles/pages/home.css" rel="stylesheet" type="text/css">
    <link href="/mvc/public/styles/pages/trip.css" rel="stylesheet" type="text/css">
    <link href="/mvc/public/styles/pages/dashboard.css" rel="stylesheet" type="text/css">

    <link href="/mvc/public/styles/modules/topbar.css" rel="stylesheet" type="text/css">
    <link href="/mvc/public/styles/modules/searchbar.css" rel="stylesheet" type="text/css">
    <link href="/mvc/public/styles/modules/flightbar.css" rel="stylesheet" type="text/css">

    <link href="/mvc/public/styles/modules/triplist.css" rel="stylesheet" type="text/css">
    <link href="/mvc/public/styles/modules/tripinfo.css" rel="stylesheet" type="text/css">
    <link href="/mvc/public/styles/modules/tripinfo.css" rel="stylesheet" type="text/css">
    <link href="/mvc/public/styles/modules/userpanel.css" rel="stylesheet" type="text/css">

    <link href="/mvc/public/styles/modules/footer.css" rel="stylesheet" type="text/css">
    <title>InspireMe!</title>
</head>

<script>
    var userName = <?php echo isset($_SESSION['username']) ? "'{$_SESSION['username']}'" : 'null'; ?>;
</script>

<script src="/mvc/public/scripts/app.js"></script>

<body>