<?php

require(__DIR__ . "../includes/functions.php");

$conn = dbConnect();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$score_change_row = dbQuery($conn, "SELECT * FROM response_indices WHERE qid=:qid AND answer_yes=:a", ["qid" => $_POST["qid"], "a" => $_POST["answer_yes"]]);
	// happens only once
	foreach ($score_change_row as $row) {
		$_SESSION["power_score"] += $row["power"];
		$_SESSION["turnover_score"] += $row["turnover"];
		$_SESSION["morality_score"] += $row["morality"];
	}
	if ($_POST["end"] && $_POST["register_results"] === true) {
		dbQuery($conn, "INSERT INTO final_scores SET power=:p, turnover=:t, morality=:m", ["p" => $_SESSION["power_score"], "t" => $_SESSION["turnover_score"], "m" => $_SESSION["morality_score"]]);
	}
	if ($_POST["end"] === false && $_POST["q"] == 4)
		redirectTo("quiz.php?q=6");
	else
		redirectTo("quiz.php?q=" . $_POST["q"]+1);
} else {
	$q = $_GET['q'];
	$disprow = dbQuery("SELECT text,quote FROM scenarios WHERE question = :qid AND type = 'display'", ["qid" => $q]);
	$endrow = dbQuery("SELECT text FROM scenarios WHERE question = :qid AND type = 'end_mes'", ["qid" => $q]);
	if ($q == 7) {
		$nextrow = dbQuery("SELECT text FROM scenarios WHERE question = :qid AND type = 'end_mes'", ["qid" = $q]);
		render(__DIR__ . "../templates/chooseyouradventure_form.php", ["disprow" => $disprow, "endrow" => $endrow, "nextrow" => $nextrow]);
	}
	render(__DIR__ . "../templates/chooseyouradventure_form.php", ["textrow" => $textrow]);
}

?>
