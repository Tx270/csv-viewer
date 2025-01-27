<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel='stylesheet' type='text/css' href='style.css'>
</head>
<body>
  <form action="index.php" method="get" autocomplete="off">
    <div id="pageForm">
      <div>
        <input type="hidden" name="file" id="file">
        <select onchange="changeFile(this.value);">
          <?php require "files.php"; ?>
        </select>
      </div>
      <div>
        <input type="hidden" name="page" id="page">
        <button onclick="submitForm(-1)" id="buttonPrevious" style="font-weight: 900;"> << </button>
        <span id="current">-</span>
        <button onclick="submitForm(1)" id="buttonNext" style="font-weight: 900;"> >> </button>
      </div>
      <div style="width: 350px">
        <button id="clearFilters"> Clear Filters </button>
        <button onclick="submitForm()"> Submit Filters </button>
      </div>
    </div>

    <table>
      <?php require "table.php"; ?>
    </table>
  </form>

  <script src="scripts.js"></script>
</body>
</html>