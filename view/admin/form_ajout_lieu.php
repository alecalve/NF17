				<form class="form-horizontal" method="post" action="">
					<input type="hidden" name="type" value="lieu">
					<div class="control-group">
						<label class="control-label" for="nom">Nom du lieu</label>
						<div class="controls">
							<input type="text" id="nom" name="nom">
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<label class="radio">
								<input type="radio" name="genre" value="ville">
								Ville
							</label>
							<label class="radio">
								<input type="radio" name="genre" value="massif">
								Massif
							</label>
							<button class="btn btn-primary" type="submit">Créer le lieu</button>
						</div>
					</div>
				</form>
