<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title>Sammy.js</title>

  <style type="text/css" media="screen"></style>

  <script src="js/jquery.js" type="text/javascript" charset="utf-8"></script>
  <script src="js/sammy.js" type="text/javascript" charset="utf-8"></script>
  <script src="js/route.js"></script>
  <style>
    body {
      font-family: sans-serif;
      min-height: 100vh;
      position: relative;
      margin: 0;
      padding: 0;
    }

    ul {
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: white;
      padding: 15px;
      width: 95%;
      margin: 5px auto;
      border-radius: 5px;
      list-style: none;
      box-shadow: 1px 1px 5px grey;
    }

    li {
      font-size: 1.5rem;
      margin: 0px 10px;
      font-weight: bold;
      color: dodgerblue;
    }

    a {
      text-decoration: none;
      width: 100%;
      cursor: pointer;
    }

    a:hover {
      color: rgb(13, 228, 13);
    }

    footer {
      position: absolute;
      left: 0;
      bottom: 0;
      right: 0;
      width: 100%;
      min-height: 100px;
      background-color: royalblue;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 1.5rem;
      color: white;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <ul id="link">
    <li><a href="" id="startPage">Home</a></li>
    <li><a href="#/about">About</a></li>
    <li><a href="#/test/1">Test1</a></li>
    <li><a href="#/test/2">Test2</a></li>
  </ul>
  <div id="body"></div>

  <footer>
    footer here
  </footer>
</body>

</html>