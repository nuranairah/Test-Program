<?php
	//create an array of cards
	$cards = array('A', '2', '3', '4', '5', '6', '7', '8', '9', 'X', 'J', 'Q', 'K');
	$suits  = array('S', 'H', 'D', 'C');
	
	//generate a deck of cards
	$decks = array();
	foreach ($suits as $suit) {
		foreach ($cards as $card) {
			$decks[] = $card . '-' . $suit;
		}
	}
	
	//shuffles an array of cards
	Shuffle($decks);

	//get value of player
	if (isset($_POST["submit"])) {
		$player = intval($_POST['player']);
	}
	else {
		$player = 0;
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shuffle Cards With PHP Example</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<style>
		.content {
			width: 95%;
			margin: 0 auto 50px;
		}

		.form {
			box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 
						0 1px 10px 0 rgba(0,0,0,0.12), 
						0 2px 4px -1px rgba(0,0,0,0.3);
		}
		.scrollbar {
			position: relative;
			height: 285px;
			overflow: auto;
		}
		.table-wrapper-scroll-y {
			display: block;
		}
	</style>
  </head>
  <body>
	<div class="content py-3">
		<div class="content__inner">
			<div class="container">
				<div class="row">
					<div class="col-lg-7 m-auto">
						<form class="form p-4 bg-light" method="post" action="PlayingCards.php">
							<h3 class="text-center mb-3">Shuffle Cards</h3>
							<div class="form-group">
								<label for="player">Number of player(s)</label>
								<div class="input-group">
									<input type="number" class="form-control" id="player" name="player" min="1" placeholder="Please enter number of player(s)">
								</div>
							</div>
							<div class="form-group">
								<input id="submit" name="submit" type="submit" value="Submit" class="btn btn-primary">
							</div>
							<div class="form-group table-wrapper-scroll-y scrollbar">
								<?php
									if($player > 0) {	
										$playerNo = 0;
										$totalCards = count($decks);
										$tmpArr = array();
										$chunk = array_chunk($decks, $player);
										
										//always distribute to only player equal totalCards and receive only 1 card per player
										if ($player > 52) { 
											$player = $totalCards;
											$cardPerPlayer = 1;
										}
										else { 
											$cardPerPlayer = floor($totalCards/$player); 
										}
										
										for ($j=0; $j < $player; $j++)
										{ 
											for ($i=0; $i < $cardPerPlayer; $i++)
											{ 
												array_push($tmpArr, $chunk[$i][$j]);
											}
										}

										$tmpArr = array_chunk($tmpArr, $cardPerPlayer);
										
										$playerCards = array_map(fn($item) => implode(', ', $item), $tmpArr);
										
										echo '<table class="table table-striped">';
										echo '<thead class="thead-dark">';
										echo '<tr>';
										echo '<th class="col-xs-3">Player</th>';
										echo '<th class="col-xs-9">Cards</th>';
										echo '</tr>';
										echo '</thead>';
										echo '<tbody>';
										
										//display the shuffle cards
										foreach($playerCards as $i){
											$playerNo = $playerNo+1;
											echo '<tr>';
											echo '<td class="col-xs-3">';
											echo "Player ".$playerNo." gets <b>$cardPerPlayer</b> card(s)<br>";
											echo "</td>";
											echo '<td class="col-xs-9">';
											echo $i;
											echo "</td>";
											echo '</tr>';
										}
										
										echo '</tbody>';
										echo '</table>';
									}
								?>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>