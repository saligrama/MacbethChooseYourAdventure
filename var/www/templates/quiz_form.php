<!DOCTYPE html>

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

  <script>

    function clickNo ()
    {
      var qn = parseInt(<?= $_GET["q"] ?>);
      if (qn != 4) {
        <?php foreach ($endrow as $row): ?>
          document.getElementById("mes").innerHTML = '<?= $row["text"] ?>';
        <?php endforeach; ?>

        document.getElementById("end").checked = true;
        document.getElementById("register_results").style.display = "";
        document.getElementById("rrlabel").style.display = "";
      } else {
        document.getElementById("4_next").value = 6;
      }

      document.getElementById("sub").style.display = "";
      document.getElementById("sub").value = "End";
      document.getElementById("no").style.display = "none";
      document.getElementById("yes").style.display = "none";
    }


    function clickYes ()
    {
      var qn = parseInt(<?= $_GET["q"] ?>);
      if (qn == 7) {
        <?php foreach ($nextrow as $row): ?>
          document.getElementById("mes").innerHTML = '<?= $row["text"] ?>';
        <?php endforeach; ?>
        document.getElementById("end").checked = true;
        document.getElementById("register_results").style.display = "";
        document.getElementById("rrlabel").style.display = "";
        document.getElementById("sub").value = "End";
      }

      if (qn == 4) {
        document.getElementById("4_next").value = 5;
      }

      document.getElementById("sub").style.display = "";
      document.getElementById("no").style.display = "none"
      document.getElementById("yes").style.display = "none";
    }

    //document.getElementById("no").addEventListener("click", clickNo, false);
    //document.getElementById("yes").addEventListener("click", clickYes, false);
  </script>

  <title>Choose your adventure</title>

  <style>
    body {
      background: #2B303B;
      color: #c0c5ce;
      font-family: Average, serif;
    }
    h1 {
      color: #c0c5ce;
      text-align: center;
      font-family: Average, serif;
    }
    h4 {
      color: #c0c5ce;
      text-align: center;
      font-family: Average, serif;
    }
    div {
      text-align: center;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1><b>Choose your adventure</b></h1>
    <h4><b>Based on <i>Macbeth</i> by William Shakespeare</b></h4>

    <div class="container" id="scenario">
      <?php foreach ($disprow as $row): ?>
        <p><?= $row["text"] ?></p>
      <?php endforeach; ?>
    </div>

    <div class="container" id="choices">
      <button id="no" class="btn btn-secondary" onclick="clickNo()">No</button>
      <button id="yes" class="btn btn-secondary" onclick="clickYes()">Yes</button>
    </div>

    <div class="container" id="end_disp">
      <p id="mes"></p>
    </div>

   <div class="container" id="scores">
     <p id="power">Power score: <?= $_SESSION["power_score"] ?></p>
     <p id="turnover">Turnover score: <?= $_SESSION["turnover_score"] ?></p>
     <p id="moral">Morality score: <?= $_SESSION["morality_score"] ?></p>
   </div>

    <form name="data" id="form" method="post" action="quiz.php" enctype="application/x-www-form-urlencoded">
      <input id="end" name="end" type="checkbox" style="display:none;" />
      <br />
      <input id="4_next" name="4_next" type="number" style="display:none;" />
      <input id="q" name="q" type="number" value=<?= $_GET["q"] ?> style="display:none;"/>
      <br />
      <label id="rrlabel" for="register_results" style="display:none;">Add results to database for analysis of trends (anonymous)</label>
      <input id="register_results" name="register_results" type="checkbox" style="display:none;" />
      <br />
      <input id="sub" name="submit" type="submit" class="btn btn-secondary" value="Next question" style="display:none;" />
    </form>
  </div>
</body>

</html>
