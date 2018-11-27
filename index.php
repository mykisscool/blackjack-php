<?php
require_once('src/actionController.php');
?>

<!doctype html>
<html>
<head>
<title>Blackjack-php</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="/public/css/style.css" />
</head>

<body>
   <div class="container">
      <div class="row">
         <div class="col-12">
            <h1>Blackjack-php</h1>
            <?php if (isset($_SESSION['flash'])) : ?>
            <div class="alert alert-<?php echo $_SESSION['flash']['type']; ?>">
               <strong><?php echo $_SESSION['flash']['message']; ?></strong>
            </div>
            <?php endif; ?>
         </div>
      </div>
      <div id="table" class="row">
         <div class="cards col-sm-12 col-md-6">
            <div class="cards box">
               Player: <?php echo $playerHand; ?>
            </div>
         </div>
         <div class="cards col-sm-12 col-md-6">
            <div class="cards box">
               Dealer: <?php echo $dealerHand; ?>
            </div>
         </div>
      </div>

      <div id="buttons" class="row">
         <div class="col-12 col-sm-4">
         <?php if (isset($_SESSION['activeGame']) && $activeHand) : ?>
            <a class="btn btn-warning" href="?action=hit">Hit</a>
         <?php endif; ?>
         </div>
         <div class="col-12 col-sm-4">
         <?php if (isset($_SESSION['activeGame']) && $activeHand) : ?>
            <a class="btn btn-warning" href="?action=stand">Stand</a>
         <?php else : ?>
            <a class="btn btn-primary" href="?action=new">New Game</a>
         <?php endif; ?>
         </div>
         <div class="col-12 col-sm-4">
         <?php if (isset($_SESSION['activeGame']) && !$activeHand) : ?>
            <a class="btn btn-danger" href="?action=end">End Game</a>   
         <?php endif; ?>
         </div>
      </div>

      <div id="score-board" class="row">
         <div class="col-12">
            <div class="table-responsive">
               <table class="table table-striped">
                  <thead>
                     <tr>
                        <th>&nbsp;</th>
                        <th class="text-right">Current Card Total</th>
                        <th class="text-right">Total Wins</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><strong>Player</strong></td>
                        <td class="text-right"><?php echo $playerScore; ?></td>
                        <td class="text-right"><?php echo $playerWins; ?></td>
                     </tr>
                     <tr>
                        <td><strong>Dealer</strong></td>
                        <td class="text-right"><?php echo $dealerScore; ?></td>
                        <td class="text-right"><?php echo $dealerWins; ?></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</body>
</html>