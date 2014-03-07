			<div class="row" style="margin-top: 50px" id="adjective-list">
				<!-- ОЦЕНКИ -->
					<?php foreach ($User->Adjectives as $Adjective) : ?>
					<div class="adjective-row">	
						<span class="adjective-toptext"><?= $Adjective->formatAdjective() ?></span>
						<div class="adj-vote-block pull-right trans">
							<span onclick="voteFor(<?= $Adjective->id ?>)" class="glyphicon glyphicon-thumbs-up text-white adj-vote for <?=($Adjective->checkVote() == 1 ? "voted" : "")?>" id="vote-for-<?= $Adjective->id ?>"></span>
							<span style="font-size: 16px" id="vote-for-count-<?= $Adjective->id ?>"><?= $Adjective->countVotes(1) ?></span>
							<span onclick="voteAgainst(<?= $Adjective->id ?>)" style="margin-left: 15px" class="glyphicon glyphicon-thumbs-down text-white adj-vote against <?=($Adjective->checkVote() == 0 ? "voted" : "")?>" id="vote-against-<?= $Adjective->id ?>"></span>
							<span style="font-size: 16px" id="vote-against-count-<?= $Adjective->id ?>"><?= $Adjective->countVotes(0) ?></span>
						</div>
						<div class="adjective-bar progress-primary" style="margin: 2px 0 20px">
					<!-- Может так голосовать оригинальнее? Если что удалить и почистить в style.css
							<button class="btn btn-danger btn-adjrate"><span class="glyphicon glyphicon-thumbs-down text-white"></span></button>
							<button class="btn btn-success btn-adjrate plus"><span class="glyphicon glyphicon-thumbs-up text-white"></span></button>
					-->
							<div id="bar-<?= $Adjective->id ?>" class="bar" style="width: <?= $Adjective->positivePercent() ?>%;"></div>
						</div>
					</div>
					<?php endforeach; ?>
				<!-- КОНЕЦ ОЦЕНКИ -->
			</div>