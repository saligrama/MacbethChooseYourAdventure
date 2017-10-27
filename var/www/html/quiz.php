<?php

require(__DIR__ . "/../includes/functions.php");
session_start();
$conn = dbConnect();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	//var_dump($_POST);
	$q = (int) $_POST["q"];
	$end = isset($_POST["end"]) ? 1 : 0;
	$score_change_row = dbQuery($conn, "SELECT * FROM response_indices WHERE qid=:qid AND answer_yes=:a", ["qid" => $q, "a" => !$end]);
	// happens only once
	foreach ($score_change_row as $row) {
		$_SESSION["power_score"] += $row["power"];
		$_SESSION["turnover_score"] += $row["turnover"];
		$_SESSION["morality_score"] += $row["morality"];
	}
	//var_dump($_SESSION);
	if ($end) {
		if ($_POST["register_results"] === true) {
			dbQuery($conn, "INSERT INTO final_scores SET power=:p, turnover=:t, morality=:m", ["p" => $_SESSION["power_score"], "t" => $_SESSION["turnover_score"], "m" => $_SESSION["morality_score"]]);
		}
		exit;
	}

	$next_q = (string) $q+1;
	if (!$end && $q == 4)
		redirectTo("/quiz.php?q=6");
	else
		redirectTo("/quiz.php?q=" . $next_q);
} else {
	$q = $_GET["q"];
	if ($q == 1) {
                $_SESSION["power_score"] = 0;
                $_SESSION["turnover_score"] = 0;
                $_SESSION["morality_score"] = 0;
	}

	$disprow = dbQuery($conn, "SELECT text FROM scenarios WHERE question = :qid AND type = 'display'", ["qid" => $q]);
	$endrow = dbQuery($conn, "SELECT text FROM scenarios WHERE question = :qid AND type = 'end_mes'", ["qid" => $q]);
	if ($q == 7) {
		$nextrow = dbQuery($conn, "SELECT text FROM scenarios WHERE question = :qid AND type = 'end_mes'", ["qid" => $q]);
		render("quiz_form.php", ["disprow" => $disprow, "endrow" => $endrow, "nextrow" => $nextrow]);
	} else {
		render("quiz_form.php", ["disprow" => $disprow, "endrow" => $endrow]);
	}
}

?>
