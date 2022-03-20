<!DOCTYPE html>
<html lang="pl">
<head>
<title>Nazwa szkoły - InfoKiosk</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<style>
* {
  box-sizing: border-box;
}

.row::after {
  content: "";
  clear: both;
  display: table;
}

[class*="col-"] {
  float: left;
  padding: 15px;
}

.col-1 {width: 8.33%;}
.col-2 {width: 16.66%;}
.col-3 {width: 25%;}
.col-4 {width: 33.33%;}
.col-5 {width: 41.66%;}
.col-6 {width: 50%;}
.col-7 {width: 58.33%;}
.col-8 {width: 66.66%;}
.col-9 {width: 75%;}
.col-10 {width: 83.33%;}
.col-11 {width: 91.66%;}
.col-12 {width: 100%;}

html {
  font-family: "Lucida Sans", sans-serif;
}

.header {
  background-color: orange;
  color: #ffffff;
  padding: 15px;
}

.menu ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

.header p {
    margin-bottom: -15px;
}

.menu li {
  padding: 8px;
  margin-bottom: 7px;
  background-color: #33b5e5;
  color: #ffffff;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

.menu li:hover {
  background-color: #0099cc;
}
</style>
</head>
<body>

<div class="header">
  <h1>Nazwa szkoły</h1>
  <p align="right">10:00:00</p>
  <p align="right">Dziś jest niedziela, 20 marca 2022.</p>
  <p align="right">Imieniny obchodzą: </p>
</div>

<div class="row">
  <div class="col-3 menu">
    <ul>
      <li>Archiwum</li>
      <li>Administracja</li>
    </ul>
  </div>

  <div class="col-9">
    <h1>Nagłówek</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse blandit blandit neque a luctus. Sed ullamcorper lectus vel quam cursus lobortis. Vivamus congue erat ac eros dictum, eget aliquet dui efficitur. Duis ante eros, tincidunt vitae metus eu, dapibus elementum eros. Cras varius eleifend nulla, non suscipit justo auctor nec. Donec hendrerit orci magna. Ut mollis, magna sed maximus porttitor, tortor tellus euismod enim, sit amet facilisis felis risus sit amet odio. Maecenas varius id sem vitae maximus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Praesent ornare interdum bibendum. Aenean ultrices ornare ipsum, vitae sagittis ipsum malesuada vel. Integer non interdum sapien, nec consectetur dui. Praesent elementum justo augue, eu iaculis magna pulvinar non. Nunc a convallis orci.</p>
    <p>Curabitur ut nisl in massa ornare vehicula. Nam et mauris sit amet dui dictum suscipit id in dolor. Integer id ante et ligula accumsan euismod. Integer efficitur sem ac malesuada ornare. Proin ut nisl quis nisl vulputate convallis. Duis in tempus sem. Quisque sit amet dolor quis enim vestibulum accumsan et vel lacus. Integer ultricies, tortor et ornare pulvinar, neque elit posuere justo, at vestibulum mauris libero sollicitudin purus. Cras posuere neque ornare, consequat nulla non, pulvinar velit. Nunc erat libero, laoreet in enim in, fringilla dignissim mauris.</p>
  </div>
</div>

</body>
</html>
